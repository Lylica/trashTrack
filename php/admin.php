<?php
session_start();
include("db.php");

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'admin') {
    header("Location: login.php");
    exit;
}

/* =============================
   AÇÕES DO ADMIN
============================= */

// Excluir usuário
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM usuarios WHERE id=$id");
    header("Location: admin.php");
    exit;
}

// Editar usuário
if (isset($_POST['editar'])) {
    $id = intval($_POST['id']);
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];
    $conn->query("UPDATE usuarios SET nome='$nome', usuario='$usuario', email='$email', tipo='$tipo' WHERE id=$id");
    header("Location: admin.php");
    exit;
}

// Cadastrar nova lixeira
if (isset($_POST['nova_lixeira'])) {
    $nome = $_POST['nome_lixeira'];
    $localizacao = $_POST['localizacao'];
    $nivel = intval($_POST['nivel']);
    $status = $_POST['status'];
    $conn->query("INSERT INTO lixeiras (nome, localizacao, nivel, status) VALUES ('$nome', '$localizacao', $nivel, '$status')");
    header("Location: admin.php");
    exit;
}

// Excluir lixeira
if (isset($_GET['deleteLixeira'])) {
    $idLixeira = intval($_GET['deleteLixeira']);
    $conn->query("DELETE FROM lixeiras WHERE id=$idLixeira");
    header("Location: admin.php");
    exit;
}


// Excluir depoimento
if (isset($_GET['deleteDep'])) {
    $idDep = intval($_GET['deleteDep']);
    $conn->query("DELETE FROM forum WHERE id=$idDep");
    header("Location: admin.php");
    exit;
}

// Pesquisar usuários
$pesquisa = "";
if (isset($_GET['pesquisa'])) {
    $pesquisa = $conn->real_escape_string($_GET['pesquisa']);
    $usuarios = $conn->query("SELECT * FROM usuarios WHERE usuario LIKE '%$pesquisa%'");
} else {
    $usuarios = $conn->query("SELECT * FROM usuarios");
}

// Pegar todos os depoimentos
$depoimentos = $conn->query("SELECT f.id, f.autor, f.conteudo, f.data_criacao FROM forum f ORDER BY f.data_criacao DESC");
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Painel Administrativo</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
  <h2>Bem-vindo,
    <?php echo htmlspecialchars($_SESSION['usuario']); ?> (Admin)
  </h2>
  <a href="logout.php">Sair</a>

  <!-- menu principal -->
  <div class="menu-admin">
    <button onclick="mostrarSecao('usuarios')">Usuários</button>
    <button onclick="mostrarSecao('lixeiras')">Lixeiras</button>
    <button onclick="mostrarSecao('depoimentos')">Depoimentos</button>
  </div>

  <hr>
  <!-- ================= USUÁRIOS ================= -->
  <div id="usuarios" class="secao-admin">
    <h3>Pesquisar Usuário</h3>
    <form method="get" action="admin.php">
      <input type="text" name="pesquisa" value="<?php echo $pesquisa; ?>" placeholder="Digite o usuário...">
      <button type="submit">Pesquisar</button>
    </form>

    <h3>Lista de Usuários</h3>
    <table>
      <tr>
        <th>ID</th>
        <th>Avatar</th>
        <th>Nome</th>
        <th>Usuário</th>
        <th>Email</th>
        <th>Tipo</th>
        <th>Ações</th>
      </tr>
      <?php while($row = $usuarios->fetch_assoc()){ ?>
      <tr>
        <td>
          <?php echo $row['id']; ?>
        </td>
        <td>
          <img src="avatares/<?php echo htmlspecialchars($row['avatar'] ?? 'avatar1.png'); ?>"
            style="width:40px; height:40px; border-radius:50%; object-fit:cover;">
        </td>
        <td>
          <?php echo htmlspecialchars($row['nome']); ?>
        </td>
        <td>
          <?php echo htmlspecialchars($row['usuario']); ?>
        </td>
        <td>
          <?php echo htmlspecialchars($row['email']); ?>
        </td>
        <td>
          <?php echo htmlspecialchars($row['tipo']); ?>
        </td>
        <td>
          <?php if($row['tipo'] != 'admin'){ ?>
          <a href="admin.php?delete=<?php echo $row['id']; ?>"
            onclick="return confirm('Excluir este usuário?')">Excluir</a> |
          <a href="#"
            onclick="editarUsuario('<?php echo $row['id']; ?>','<?php echo $row['nome']; ?>','<?php echo $row['usuario']; ?>','<?php echo $row['email']; ?>','<?php echo $row['tipo']; ?>')">Editar</a>
          |
          <a href="#" onclick="verDepoimentos('<?php echo $row['usuario']; ?>')">Ver Depoimentos</a>
          <?php } ?>
        </td>
      </tr>
      <?php } ?>
    </table>

    <!-- Formulário de edição -->
    <div id="form-editar" style="display:none; margin-top:20px;">
      <h3>Editar Usuário</h3>
      <form method="post" action="admin.php">
        <input type="hidden" name="id" id="edit-id">
        <label>Nome:</label><input type="text" name="nome" id="edit-nome"><br>
        <label>Usuário:</label><input type="text" name="usuario" id="edit-usuario"><br>
        <label>Email:</label><input type="text" name="email" id="edit-email"><br>
        <label>Tipo:</label>
        <select name="tipo" id="edit-tipo">
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select><br>
        <button type="submit" name="editar">Salvar Alterações</button>
      </form>
    </div>
  </div>

  <!-- ================= LIXEIRAS ================= -->
  <div id="lixeiras" class="secao-admin" style="display:none;">
    <h3>Gerenciamento de Lixeiras</h3>
    <table>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Localização</th>
        <th>Ações</th>
      </tr>
      <?php
        $lixeiras = $conn->query("SELECT * FROM lixeiras");
        while($lixeira = $lixeiras->fetch_assoc()){
        ?>
      <tr>
        <td>
          <?php echo $lixeira['id']; ?>
        </td>
        <td>
          <?php echo $lixeira['nome']; ?>
        </td>
        <td>
          <?php echo $lixeira['localizacao']; ?>
        </td>

        <td>
          <a href="dashboardAdmin.php?id=<?php echo $lixeira['id']; ?>&nome=<?php echo urlencode($lixeira['nome']); ?>&localizacao=<?php echo urlencode($lixeira['localizacao']); ?>"
            class="btn-dashboard">
            Ver Dashboard
          </a> |

          <a href="admin.php?deleteLixeira=<?php echo $lixeira['id']; ?>"
            onclick="return confirm('Excluir lixeira?')">Excluir</a> |
        </td>
      </tr>
      <?php } ?>
    </table>

    <!-- cadastro de lixeira -->
    <button id="btnNovaLixeira" onclick="toggleNovaLixeira()">Cadastrar Nova Lixeira</button>

    <div id="form-nova-lixeira" style="display:none;">
      <h4>Nova Lixeira</h4>
      <form method="post" action="admin.php">
        <input type="text" name="nome_lixeira" placeholder="Nome da lixeira" required>
        <input type="text" name="localizacao" placeholder="Localização" required>
        <input type="number" name="nivel" placeholder="Nível inicial (%)" min="0" max="100">
        <select name="status">
          <option value="Ativa">Ativa</option>
          <option value="Inativa">Inativa</option>
        </select>
        <button type="submit" name="nova_lixeira">Salvar</button>
      </form>
    </div>
  </div>

  <!-- ================= DEPOIMENTOS ================= -->
  <div id="depoimentos" class="secao-admin" style="display:none;">
    <h3>Depoimentos dos Usuários</h3>
    <table id="tabela-depoimentos">
      <tr>
        <th>Usuário</th>
        <th>Depoimento</th>
        <th>Data</th>
        <th>Ações</th>
      </tr>
      <?php
        foreach($depoimentos as $dep){
        ?>
      <tr class="dep-row" data-usuario="<?php echo htmlspecialchars($dep['autor']); ?>">
        <td>
          <?php echo htmlspecialchars($dep['autor']); ?>
        </td>
        <td>
          <?php echo htmlspecialchars($dep['conteudo']); ?>
        </td>
        <td>
          <?php echo htmlspecialchars($dep['data_criacao']); ?>
        </td>
        <td>
          <a href="admin.php?deleteDep=<?php echo $dep['id']; ?>"
            onclick="return confirm('Excluir este depoimento?')">Excluir</a>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>

  <!-- ================= SCRIPTS ================= -->
  <script src="../js/admin.js"></script>

</body>

</html>