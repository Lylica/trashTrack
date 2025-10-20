<?php
session_start();
include("db.php");

// Redireciona caso não seja admin
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'admin') {
    header("Location: login.php");
    exit;
}

/* =============================
// AÇÕES DO ADMIN
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

// Pesquisa usuários
$pesquisa = "";
if (isset($_GET['pesquisa'])) {
    $pesquisa = $conn->real_escape_string($_GET['pesquisa']);
    $usuarios = $conn->query("SELECT * FROM usuarios WHERE usuario LIKE '%$pesquisa%'");
} else {
    $usuarios = $conn->query("SELECT * FROM usuarios");
}

// Pegar todas as lixeiras
$lixeiras = $conn->query("SELECT * FROM lixeiras");

// Pegar todos os depoimentos
$depoimentos = $conn->query("SELECT f.id, f.autor, f.conteudo, f.data_criacao, u.avatar 
                             FROM forum f 
                             LEFT JOIN usuarios u ON f.autor = u.usuario
                             ORDER BY f.data_criacao DESC");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Admin TrashTracker</title>
  <style>
body {
    background-color: rgb(101, 109, 74);
    color: rgb(194, 197, 170);
    font-family: 'Inter', sans-serif;
    margin: 0;
    padding: 0;
}
header {
    background-color: rgb(220, 218, 190);
    display: flex;
    align-items: center;
    padding: 10px 20px;
    gap: 12px;
}
header img { height: 60px; width: 60px; }
.header-title h1 { margin: 0; color: rgb(65, 72, 51); }
.header-user {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 10px;
}
.header-user img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #555; }
.header-user button {
    background-color: #44633F;
    color: #F5F0DC;
    border: none;
    border-radius: 8px;
    padding: 6px 12px;
    cursor: pointer;
}
.header-user button:hover { background-color: #5A7A52; }
h2, h3 { margin-left: 20px; }

/* ======== MENU CENTRALIZADO ======== */
.menu-admin {
    margin: 20px;
    display: flex;
    justify-content: center; /* centraliza horizontalmente */
    gap: 10px;
}
.menu-admin button {
    padding: 8px 16px;
    border-radius: 12px; /* borda arredondada */
    border: none;
    background-color: #44633F;
    color: #F5F0DC;
    font-weight: bold;
    cursor: pointer;
}
.menu-admin button:hover { background-color: #5A7A52; }

/* ======== SECÕES ======== */
.secao-admin { display: none; margin-top:20px; }

/* ======== TABELA BRANCA COM BORDAS ARREDONDADAS ======== */
table {
    width: 95%;
    margin: 10px auto;
    border-collapse: separate; /* para bordas arredondadas funcionarem */
    border-spacing: 0;
    background-color: #fff; /* fundo branco */
    color: #000; /* texto preto */
    border-radius: 12px; /* borda arredondada da tabela */
    overflow: hidden;
}
th, td {
    border-bottom: 1px solid #ccc;
    padding: 8px 10px;
    text-align: left;
    font-size: 14px;
}
th {
    background-color: #44633F;
    color: #F5F0DC;
}
td img { max-width: 40px; max-height: 40px; border-radius: 50%; object-fit: cover; }

/* Formulários compactos com borda arredondada */
#form-editar, #form-nova-lixeira {
    display: none;
    background-color: #f5f5f5;
    padding: 15px;
    margin: 10px auto;
    border-radius: 12px;
    width: 400px;
    color: #000;
}
input, select {
    padding: 6px 8px;
    margin-bottom: 8px;
    width: 100%;
    border-radius: 8px;
    border: 1px solid #ccc;
}
button { cursor: pointer; }
a { color: #44633F; text-decoration: none; }
a:hover { text-decoration: underline; }

/* Pesquisa de usuário menor */
form input[name="pesquisa"] {
    padding:5px 8px;
    width:200px;
    border-radius:5px;
    border:1px solid #ccc;
    font-size:14px;
}
form button[type="submit"] {
    padding:5px 10px;
    border-radius:5px;
    border:none;
    background-color:#44633F;
    color:#F5F0DC;
    cursor:pointer;
    font-size:14px;
}
form button[type="submit"]:hover { background-color:#5A7A52; }
</style>


</head>
<body>

<header>
    <a href="admin.php"><img src="../images/logo.png" alt="Logo"></a>
    <div class="header-title"><h1>TrashTracker - Admin</h1></div>
    <div class="header-user">
        <img src="avatares/<?php echo htmlspecialchars($_SESSION['avatar'] ?? 'avatar1.png'); ?>">
        <span><?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
        <a href="logout.php"><button>Sair</button></a>
    </div>
</header>

<h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>

<div class="menu-admin">
    <button onclick="mostrarSecao('usuarios')">Usuários</button>
    <button onclick="mostrarSecao('lixeiras')">Lixeiras</button>
    <button onclick="mostrarSecao('depoimentos')">Depoimentos</button>
</div>

<!-- ================= USUÁRIOS ================= -->
<div id="usuarios" class="secao-admin">
   <h3>Pesquisar Usuário</h3>
<form method="get" action="admin.php" style="margin-left:20px;">
    <input type="text" name="pesquisa" value="<?php echo htmlspecialchars($pesquisa); ?>" placeholder="Usuário..." 
           style="padding:5px 8px; width:200px; border-radius:5px; border:1px solid #ccc; font-size:14px;">
    <button type="submit" style="padding:5px 10px; border-radius:5px; border:none; background-color:#44633F; color:#F5F0DC; cursor:pointer; font-size:14px;">Pesquisar</button>
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
        <?php while($row = $usuarios->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><img src="avatares/<?php echo htmlspecialchars($row['avatar'] ?? 'avatar1.png'); ?>"></td>
            <td><?php echo htmlspecialchars($row['nome']); ?></td>
            <td><?php echo htmlspecialchars($row['usuario']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['tipo']); ?></td>
            <td>
                <?php if($row['tipo'] != 'admin'): ?>
                <a href="admin.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Excluir este usuário?')">Excluir</a> |
                <a href="#" onclick="editarUsuario('<?php echo $row['id']; ?>','<?php echo $row['nome']; ?>','<?php echo $row['usuario']; ?>','<?php echo $row['email']; ?>','<?php echo $row['tipo']; ?>')">Editar</a> |
                <a href="#" onclick="verDepoimentos('<?php echo $row['usuario']; ?>')">Ver Depoimentos</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Formulário de edição -->
    <div id="form-editar">
        <h3>Editar Usuário</h3>
        <form method="post" action="admin.php">
            <input type="hidden" name="id" id="edit-id">
            <label>Nome:</label><input type="text" name="nome" id="edit-nome">
            <label>Usuário:</label><input type="text" name="usuario" id="edit-usuario">
            <label>Email:</label><input type="text" name="email" id="edit-email">
            <label>Tipo:</label>
            <select name="tipo" id="edit-tipo">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" name="editar">Salvar Alterações</button>
        </form>
    </div>
</div>

<!-- ================= LIXEIRAS ================= -->
<div id="lixeiras" class="secao-admin">
    <h3>Lixeiras</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Localização</th>
            <th>Ações</th>
        </tr>
        <?php while($lixeira = $lixeiras->fetch_assoc()): ?>
        <tr>
            <td><?php echo $lixeira['id']; ?></td>
            <td><?php echo $lixeira['nome']; ?></td>
            <td><?php echo $lixeira['localizacao']; ?></td>
            <td>
                <a href="dashboardAdmin.php?id=<?php echo $lixeira['id']; ?>&nome=<?php echo urlencode($lixeira['nome']); ?>&localizacao=<?php echo urlencode($lixeira['localizacao']); ?>" class="btn-dashboard">Ver Dashboard</a> |
                <a href="admin.php?deleteLixeira=<?php echo $lixeira['id']; ?>" onclick="return confirm('Excluir lixeira?')">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <button onclick="toggleNovaLixeira()">Cadastrar Nova Lixeira</button>
    <div id="form-nova-lixeira">
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
<div id="depoimentos" class="secao-admin">
    <h3>Depoimentos</h3>
    <table id="tabela-depoimentos">
        <tr>
            <th>Usuário</th>
            <th>Depoimento</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        <?php foreach($depoimentos as $dep): ?>
        <tr class="dep-row" data-usuario="<?php echo htmlspecialchars($dep['autor']); ?>">
            <td><?php echo htmlspecialchars($dep['autor']); ?></td>
            <td><?php echo htmlspecialchars($dep['conteudo']); ?></td>
            <td><?php echo htmlspecialchars($dep['data_criacao']); ?></td>
            <td><a href="admin.php?deleteDep=<?php echo $dep['id']; ?>" onclick="return confirm('Excluir este depoimento?')">Excluir</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<script>
function mostrarSecao(secao) {
    document.querySelectorAll('.secao-admin').forEach(div => div.style.display = 'none');
    document.getElementById(secao).style.display = 'block';
}

// Toggle formulário nova lixeira
function toggleNovaLixeira() {
    const f = document.getElementById('form-nova-lixeira');
    f.style.display = f.style.display === 'block' ? 'none' : 'block';
}

// Formulário de edição
function editarUsuario(id,nome,usuario,email,tipo){
    const f = document.getElementById('form-editar');
    f.style.display = 'block';
    document.getElementById('edit-id').value = id;
    document.getElementById('edit-nome').value = nome;
    document.getElementById('edit-usuario').value = usuario;
    document.getElementById('edit-email').value = email;
    document.getElementById('edit-tipo').value = tipo;
}

// Mostrar depoimentos por usuário
function verDepoimentos(usuario){
    mostrarSecao('depoimentos');
    document.querySelectorAll('.dep-row').forEach(r=>{
        r.style.display = r.dataset.usuario===usuario ? '' : 'none';
    });
}
</script>

</body>
</html>
