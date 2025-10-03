<?php
session_start();
include("db.php");

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Excluir
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM usuarios WHERE id=$id");
    header("Location: admin.php");
    exit;
}

// Editar
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

// Pesquisar
$pesquisa = "";
if (isset($_GET['pesquisa'])) {
    $pesquisa = $conn->real_escape_string($_GET['pesquisa']);
    $usuarios = $conn->query("SELECT * FROM usuarios WHERE usuario LIKE '%$pesquisa%'");
} else {
    $usuarios = $conn->query("SELECT * FROM usuarios");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Admin - Gerenciar Usuários</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
  <h2>Bem-vindo, <?php echo $_SESSION['usuario']; ?> (Admin)</h2>
  <a href="logout.php">Sair</a>

  <h3>Pesquisar Usuário</h3>
  <form method="get" action="admin.php">
    <input type="text" name="pesquisa" value="<?php echo $pesquisa; ?>" placeholder="Digite o usuário...">
    <button type="submit">Pesquisar</button>
  </form>

  <h3>Lista de Usuários</h3>
  <table>
    <tr>
      <th>ID</th><th>Nome</th><th>Usuário</th><th>Email</th><th>Tipo</th><th>Senha (criptografada)</th><th>Ações</th>
    </tr>
    <?php while($row = $usuarios->fetch_assoc()){ ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['nome']; ?></td>
      <td><?php echo $row['usuario']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['tipo']; ?></td>
      <td><small><?php echo $row['senha']; ?></small></td>
      <td>
        <?php if($row['tipo'] != 'admin'){ ?>
          <a href="admin.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Excluir este usuário?')">Excluir</a>
          |
          <a href="#" onclick="editarUsuario('<?php echo $row['id']; ?>','<?php echo $row['nome']; ?>','<?php echo $row['usuario']; ?>','<?php echo $row['email']; ?>','<?php echo $row['tipo']; ?>')">Editar</a>
        <?php } ?>
      </td>
    </tr>
    <?php } ?>
  </table>

  <!-- Formulário de edição escondido -->
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

  <script>
    function editarUsuario(id, nome, usuario, email, tipo){
      document.getElementById('form-editar').style.display = 'block';
      document.getElementById('edit-id').value = id;
      document.getElementById('edit-nome').value = nome;
      document.getElementById('edit-usuario').value = usuario;
      document.getElementById('edit-email').value = email;
      document.getElementById('edit-tipo').value = tipo;
      window.scrollTo(0,document.body.scrollHeight);
    }
  </script>
</body>
</html>
