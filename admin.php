<?php
session_start();
include("db.php");

// Redireciona se não for admin
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Excluir usuário
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM usuarios WHERE id = $id");
    header("Location: admin.php");
    exit;
}

// Excluir lixeira
if (isset($_GET['delete_lixeira'])) {
    $id = intval($_GET['delete_lixeira']);
    $conn->query("DELETE FROM lixeiras WHERE id = $id");
    header("Location: admin.php");
    exit;
}

// Pesquisa usuários
$pesquisa = $_GET['pesquisa'] ?? '';
$usuarios = $conn->query("SELECT * FROM usuarios WHERE usuario LIKE '%".$conn->real_escape_string($pesquisa)."%'");

// Pesquisa lixeiras
$pesquisa_lixeira = $_GET['pesquisa_lixeira'] ?? '';
$lixeiras = $conn->query("SELECT * FROM lixeiras WHERE nome LIKE '%".$conn->real_escape_string($pesquisa_lixeira)."%'");

$depoimentos = $conn->query("SELECT * FROM forum");

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
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Admin - TrashTracker</title>
<link rel="stylesheet" href="css/index.css">
<style>
/* ======== MENU ADMIN ======== */
.menu-admin {
  background-color: #44633F;
  padding: 14px 0;
  display: flex;
  justify-content: center;
  gap: 20px;
}
.menu-admin button {
  background-color: #5A7A52;
  color: #F5F0DC;
  border: none;
  border-radius: 10px;
  padding: 12px 28px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
}
.menu-admin button:hover {
  background-color: #44633F;
  transform: scale(1.05);
}

/* ======== CONTAINER ======== */
.container {
  background-color: rgb(220, 218, 190);
  width: 85%;
  margin: 25px auto;
  border-radius: 12px;
  padding: 20px 30px;
  box-shadow: 0 4px 14px rgba(0,0,0,0.15);
  position: relative;
}

/* ======== FORMULÁRIOS PEQUENOS ======== */
.form-canto {
  display: flex;
  justify-content: space-between; /* pesquisa à esquerda, botão à direita */
  align-items: center;
  gap: 10px;
  margin-bottom: 15px;
  width: 100%;
}
.form-canto form {
  display: flex;
  gap: 5px;
}
.form-canto input {
  padding: 8px 12px;
  border-radius: 10px;
  border: 1px solid #555;
  font-family: 'Inter', sans-serif;
  font-size: 0.9rem;
}
.form-canto button {
  padding: 8px 14px;
  border-radius: 10px;
  border: none;
  background-color: #44633F;
  color: #F5F0DC;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}
.form-canto button:hover {
  background-color: #5A7A52;
}

/* ======== FORMULÁRIO NOVA LIXEIRA ======== */
#form-nova-lixeira {
  display: none;
  flex-direction: column;
  gap: 10px;
  margin-bottom: 15px;
  background-color: #d6d3b7;
  padding: 15px;
  border-radius: 12px;
}
#form-nova-lixeira input, #form-nova-lixeira select {
  padding: 8px 12px;
  border-radius: 10px;
  border: 1px solid #555;
}
#form-nova-lixeira button {
  width: fit-content;
  padding: 8px 14px;
  border-radius: 10px;
  border: none;
  background-color: #582F0E;
  color: #DCDABE;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}
#form-nova-lixeira button:hover {
  background-color: #7A4414;
}

/* ======== TABELAS ======== */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}
th {
  background-color: #5A7A52;
  color: #F5F0DC;
  text-align: left;
  padding: 10px;
  font-weight: bold;
}
td {
  padding: 10px;
  border-bottom: 1px solid #ccc;
  color: #000;
  vertical-align: middle;
}
td img {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  object-fit: cover;
}
td a {
  color: #44633F;
  font-weight: bold;
  text-decoration: none;
  display: inline-block;
  margin-right: 10px;
}
td a:hover {
  text-decoration: underline;
}

/* ======== SECÕES ======== */
.secao-admin {
  display: none;
  animation: fadeIn 0.4s ease;
}
.secao-admin.ativa {
  display: block;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

/* ======== RODAPÉ ======== */
footer {
  background-color: rgb(220,218,190);
  padding: 12px 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  flex-wrap: wrap;
  position: relative;
  bottom: 0;
  width: 100%;
}
footer img {
  height: 30px;
  width: 30px;
}
footer h2 {
  color: rgb(65,72,51);
  margin: 0;
  font-size: 16px;
}

/* Botões cadastrar */
.btn-cadastrar {
  background-color: #582F0E;
  color: #DCDABE;
  border:none;
  border-radius:10px;
  padding:8px 14px;
  font-weight: bold;
  cursor:pointer;
  transition:0.3s;
}
.btn-cadastrar:hover {
  background-color:#7A4414;
}

/* Botões dentro da tabela */
.btn-dashboard {
  background-color: #44633F;
  color: #F5F0DC;
  padding: 4px 8px;
  border-radius: 6px;
  text-decoration: none;
  font-size: 0.85rem;
  font-weight: bold;
  transition: 0.3s;
}
.btn-dashboard:hover {
  background-color: #5A7A52;
}


/* ======== CABEÇALHO ======== */
header {
    background-color: rgb(220, 218, 190);
    display: flex;
    align-items: center;
    padding: 6px 20px;
    gap: 12px;
}

header img {
    height: 60px;
    width: 60px;
}

.header-title h1 {
    font-family: Inter, sans-serif;
    color: rgb(65, 72, 51);
    margin: 0;
}

.nav {
    margin-left: 2%;
    display: flex;
    gap: 10px;
}

.nav a {
    font-family: Inter, sans-serif;
    font-size: 22px;
    font-weight: bold;
    color: rgb(65,72,51);
    text-decoration: none;
    transition: 0.3s;
}

.nav a:hover {
    color: rgb(101, 109, 74);
}

/* Usuário no canto direito */
.header-user {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 10px;
}

.header-user img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #555;
}

.header-user button {
    background-color: #44633F;
    color: #F5F0DC;
    border: none;
    border-radius: 8px;
    padding: 8px 12px;
    cursor: pointer;
    transition: 0.3s;
}

.header-user button:hover {
    background-color: #5A7A52;
}

.header-user span {
    font-family: 'Inter', sans-serif;
    color: #000;
}


/* ======== RODAPÉ ======== */
/* ======== BODY E RODAPÉ ======== */
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* garante altura mínima da tela */
    margin: 0;
}

main {
    flex: 1; /* faz o conteúdo ocupar o espaço restante */
}

/* RODAPÉ */
footer.footer {
    background-color: #DCDABE;
    padding: 12px 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: auto; /* empurra para o final */
}

footer.footer img {
    height: 30px;
    width: 30px;
}

footer.footer h2 {
    color: rgb(65, 72, 51);
    margin: 0;
    font-size: 16px;
}


</style>
</head>
<body>

<header>
    <picture id="link-logo" href="index.php">
        <source type="image/webp" srcset="images/logo.webp">
        <img id="lata-lixo" src="images/logo.jpg" alt="Logo">
    </picture>
    <div class="header-title">
        <h1>TrashTracker ADMIN</h1>
    </div>
    <div class="nav">
        <a class="menu-bar" href="index.php">INÍCIO</a>
        <a class="menu-bar" href="dashboardAdmin.php">DASHBOARD</a>
        <a class="menu-bar" href="forum.php">FORÚM</a>
    </div>
    <div class="header-user">
        <img src="avatares/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar">
        <span>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span>
        <a href="logout.php"><button id="btn-sair-header">Sair</button></a>
    </div>
</header>

<div class="menu-admin">
  <button onclick="mostrarSecao('usuarios')">Usuários</button>
  <button onclick="mostrarSecao('lixeiras')">Lixeiras</button>
  <button onclick="mostrarSecao('depoimentos')">Depoimentos</button>
</div>

<!-- USUÁRIOS -->
<div id="usuarios" class="container secao-admin ativa">
  <div class="form-canto">
    <form method="get" action="admin.php" style="display:flex; gap:5px;">
      <input type="text" name="pesquisa" placeholder="Pesquisar usuário" value="<?= htmlspecialchars($pesquisa); ?>">
      <button type="submit">Pesquisar</button>
    </form>
    
  </div>

  <table>
    <tr>
      <th>ID</th>
      <th>AVATAR</th>
      <th>NOME</th>
      <th>USUÁRIO</th>
      <th>EMAIL</th>
      <th>TIPO</th>
      <th>AÇÕES</th>
    </tr>
    <?php while($u = $usuarios->fetch_assoc()): ?>
    <tr>
      <td><?= $u['id'] ?></td>
      <td><img src="avatares/<?= htmlspecialchars($u['avatar'] ?? 'avatar1.png') ?>"></td>
      <td><?= htmlspecialchars($u['nome']) ?></td>
      <td><?= htmlspecialchars($u['usuario']) ?></td>
      <td><?= htmlspecialchars($u['email']) ?></td>
      <td><?= htmlspecialchars($u['tipo']) ?></td>
      <td>
        <a href="admin.php?delete=<?= $u['id'] ?>" onclick="return confirm('Excluir usuário?')">Excluir</a>
        <a href="#">Editar</a>
        <a href="#">Ver Posts</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<!-- LIXEIRAS -->
<div id="lixeiras" class="container secao-admin">
  <div class="form-canto">
    <form method="get" action="admin.php" style="display:flex; gap:5px;">
      <input type="text" name="pesquisa_lixeira" placeholder="Pesquisar lixeira" value="<?= htmlspecialchars($pesquisa_lixeira); ?>">
      <button type="submit">Pesquisar</button>
    </form>
    <button class="btn-cadastrar" onclick="toggleNovaLixeira()">Cadastrar Nova Lixeira</button>
  </div>

  <!-- FORMULÁRIO NOVA LIXEIRA -->
  <form id="form-nova-lixeira" method="post" action="admin.php">
    <input type="text" name="nome_lixeira" placeholder="Nome da Lixeira" required>
    <input type="text" name="localizacao" placeholder="Localização" required>
    <input type="number" name="nivel" placeholder="Nível (0-100)" min="0
" max="100" required>
    <select name="status" required>
      <option value="ativa">Ativa</option>
      <option value="inativa">Inativa</option>
    </select>
    <button type="submit" name="nova_lixeira">Cadastrar Lixeira</button>
  </form>

  <table>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Localização</th>
      <th>Ações</th>
    </tr>
    <?php while($l = $lixeiras->fetch_assoc()): ?>
    <tr>
      <td><?= $l['id'] ?></td>
      <td><?= htmlspecialchars($l['nome']) ?></td>
      <td><?= htmlspecialchars($l['localizacao']) ?></td>
      <td>
        <a href="dashboardAdmin.php?id=<?= $l['id']; ?>&nome=<?= urlencode($l['nome']); ?>&localizacao=<?= urlencode($l['localizacao']); ?>">Ver Dashboard</a>
        <a href="admin.php?delete_lixeira=<?= $l['id']; ?>" onclick="return confirm('Excluir lixeira?')">Excluir</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<!-- DEPOIMENTOS -->
<div id="depoimentos" class="container secao-admin">
  <table>
    <tr>
      <th>ID</th>
      <th>Autor</th>
      <th>Conteúdo</th>
      <th>Data</th>
      <th>Ações</th>
    </tr>
    <?php while($d = $depoimentos->fetch_assoc()): ?>
    <tr>
      <td><?= $d['id'] ?></td>
      <td><?= htmlspecialchars($d['autor']) ?></td>
      <td><?= htmlspecialchars($d['conteudo']) ?></td>
      <td><?= htmlspecialchars($d['data_criacao']) ?></td>
      <td><a href="#">Excluir</a></td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<footer class="footer">
        <picture>
            <source type="image/webp" srcset="images/trash.webp">
            <img id="lata-lixo" src="images/trash.jpg" alt="Logo" style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
        </picture>
        <h2>TrashTracker - Todos os direitos reservados ℗</h2>
    </footer>

<script>
function mostrarSecao(secao) {
  document.querySelectorAll('.secao-admin').forEach(s => s.classList.remove('ativa'));
  document.getElementById(secao).classList.add('ativa');
}

// Mostra/esconde o formulário de cadastro de lixeira
function toggleNovaLixeira() {
  const form = document.getElementById('form-nova-lixeira');
  form.style.display = form.style.display === 'flex' ? 'none' : 'flex';
}
</script>
</body>
</html>
