<?php
session_start();
include("db.php"); 

// ===================================
// REDIRECIONAMENTO DE SEGURANÇA
// ===================================
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'admin') {
    header("Location: index.php");
    exit;
}

// =========================
// FUNÇÕES DE EXCLUSÃO
// =========================
if (isset($_GET['delete_user'])) {
    $id = intval($_GET['delete_user']);
    $conn->query("DELETE FROM usuarios WHERE id = $id");
    header("Location: admin.php?modal=usuarios"); 
    exit;
}
if (isset($_GET['delete_lixeira'])) {
    $id = intval($_GET['delete_lixeira']);
    $conn->query("DELETE FROM lixeiras WHERE id = $id");
    header("Location: admin.php?modal=lixeiras"); 
    exit;
}
if (isset($_GET['delete_depo'])) { 
    $id = intval($_GET['delete_depo']);
    $conn->query("DELETE FROM forum WHERE id = $id");
    header("Location: admin.php?modal=depoimentos"); 
    exit;
}

// =========================
// NOVA LIXEIRA
// =========================
if (isset($_POST['nova_lixeira'])) {
    $nome = $conn->real_escape_string($_POST['nome_lixeira']);
    $localizacao = $conn->real_escape_string($_POST['localizacao']);
    $nivel = intval($_POST['nivel']);
    $status = $conn->real_escape_string($_POST['status']);
    $conn->query("INSERT INTO lixeiras (nome, localizacao, nivel, status) VALUES ('$nome', '$localizacao', $nivel, '$status')");
    header("Location: admin.php?modal=lixeiras"); 
    exit;
}

// =========================
// SALVAR ALTERAÇÕES DO USUÁRIO
// =========================
if (isset($_POST['editar_usuario'])) {
    $id = intval($_POST['id']);
    $nome = $conn->real_escape_string($_POST['nome']);
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $email = $conn->real_escape_string($_POST['email']);
    $tipo = $conn->real_escape_string($_POST['tipo']);

    $conn->query("UPDATE usuarios SET nome='$nome', usuario='$usuario', email='$email', tipo='$tipo' WHERE id=$id");
    header("Location: admin.php?modal=usuarios&form_user={$id}"); 
    exit;
}

// =========================
// BUSCAR POSTS DE UM USUÁRIO 
// =========================
$posts_usuario = [];
$usuario_modal = '';
$mostrar_modal_posts = false; 
if (isset($_GET['ver_posts'])) {
    $usuario_post = $conn->real_escape_string($_GET['ver_posts']);
    $res = $conn->query("SELECT * FROM forum WHERE autor='$usuario_post' ORDER BY data_criacao DESC");
    while ($p = $res->fetch_assoc()) {
        $posts_usuario[] = $p;
    }
    $usuario_modal = $usuario_post;
    $mostrar_modal_posts = true; 
}

// =========================
// BUSCAS
// =========================
$usuarios = $conn->query("SELECT * FROM usuarios ORDER BY id DESC");
$lixeiras = $conn->query("SELECT * FROM lixeiras ORDER BY id DESC");
$depoimentos = $conn->query("SELECT * FROM forum ORDER BY data_criacao DESC");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - TrashTracker</title>
<link rel="stylesheet" href="css/index.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="images/favicon.ico" />

<style>
/* Reset de body para o admin (se necessário, pois o index.css já define) */
body {
    background-color: rgb(101, 109, 74); 
}

/* Força o display flex para o header-admin */
.header-admin {
    display: flex !important; 
    width: 100%;
    box-sizing: border-box;
    /* Herda o background-color: rgb(220, 218, 190); do index.css */
}

/* Estilo para a logo no Header do Admin */
.logo-admin img {
    width: 150px !important; 
    height: 55px !important; 
    object-fit: contain; 
}

/* ======================================= */
/* CORREÇÃO DE RESPONSIVIDADE DO HEADER */
/* ======================================= */
@media (max-width: 900px) {
    /* 1. Faz o header empilhar os elementos */
    .header-admin {
        flex-direction: column !important;
        align-items: center !important;
        gap: 8px !important; 
        padding: 10px 20px !important; 
        height: auto !important; /* Permite o crescimento */
    }

    /* 2. Garante que os botões DASHBOARD e FORÚM fiquem visíveis (anula o display: none do index.css) */
    .header-admin .nav {
        display: flex !important; 
        flex-direction: column; /* Empilha os botões */
        align-items: center;
        gap: 5px; 
    }

    /* 3. Ajusta o bloco de usuário (Olá, admin! + Sair) para ficar centralizado */
    .header-admin .header-user {
        margin-left: 0 !important; /* Remove alinhamento à direita */
        justify-content: center;
    }
}


/* CARDS PRINCIPAIS DO ADMIN */
#section-admin{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:2em;
    padding:60px 40px; 
    background-color: rgb(101, 109, 74);
    min-height: calc(100vh - 80px - 140px);
    /* Garante que os itens no grid se expandam para ter a mesma altura */
    align-items: stretch; 
}

.admin-card{
    position:relative;
    background:rgb(220, 218, 190); 
    border-radius:16px;
    padding:40px 20px;
    text-align:center;
    cursor:pointer;
    transition: transform 0.3s, box-shadow 0.3s;
    /* Usa min-height para garantir altura mínima, mas permite que o grid alinhe */
    min-height: 180px; 
    color: #582F0E;
    display: flex;
    flex-direction: column;
    justify-content: center; /* Centraliza o texto verticalmente */
}
.admin-card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 20px rgba(0,0,0,0.2);
}
.admin-card h2{
    font-size:1.5rem;
    margin-bottom:10px;
    color:#44633F;
}

/* MODAIS GERAIS */
.modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background: rgba(0,0,0,0.6);justify-content:center;align-items:center;z-index:999;}
.modal.active{display:flex;}
.modal-content{background:#F5F0DC;padding:20px;border-radius:16px;max-width:600px;width:90%;max-height:90%;overflow-y:auto;position:relative;}
.close-modal{position:absolute;top:10px;right:15px;font-size:1.5rem;font-weight:bold;cursor:pointer;color:#582F0E;}
.modal-content h3 { color: #582F0E; margin-bottom: 20px;}

/* LISTAS DENTRO DOS MODAIS */
.lista-item{
    background:#E5E2C9;
    padding:10px;
    margin-bottom:10px;
    border-radius:10px;
    display:flex; 
    flex-direction:column; 
    cursor:pointer;
}
.lista-item span{font-weight:bold;color:#44633F;}

/* Correção para o container de informações (Avatar + Texto) */
.info-block {
    display: flex;
    align-items: center;
    margin-bottom: 10px; 
    color: #000;
}
.info-block p {
    color: #000;
}

/* Estilo para os botões dentro de lista-item */
.lista-item button { 
    background-color:#44633F;
    color:#F5F0DC;
    border:none;
    padding:8px 12px;
    border-radius:10px;
    cursor:pointer;
    transition:0.3s;
    margin-top:5px; 
}
.lista-item button:hover{background-color:#5A7A52;}

/* ESTILO PADRÃO DOS INPUTS (300px) */
form input:not(#inputPesquisaUsuario):not([type="submit"]):not([type="hidden"]), 
form select {
    width: 100%;
    max-width: 300px;
    margin-bottom:10px;
    padding:8px 12px;
    border-radius:10px;
    border:1px solid #555;
    display: block; 
    background-color: #ffffff; 
    color: #000;
}

/* Estilo para o campo de pesquisa de usuário (400px) */
#inputPesquisaUsuario {
    width: 100%;
    max-width: 400px; 
    padding: 10px 12px;
    border-radius: 8px;
    border: 2px solid #DCDABE; 
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: border-color 0.3s, box-shadow 0.3s;
    background-color: #ffffff; 
    display: block; 
    margin: 0 auto 20px auto; 
    color: #000;
}

#inputPesquisaUsuario:focus {
    border-color: #44633F; 
    box-shadow: 0 0 5px rgba(68, 99, 63, 0.5);
    outline: none; 
}

/* Estilo para os botões dentro de forms (Cadastrar/Salvar) */
form button{
    padding:10px 20px;
    border-radius:10px;
    border:none;
    background-color:#582F0E;
    color:#DCDABE;
    font-weight:bold;
    cursor:pointer;
    width: auto; 
    margin-top: 10px;
    transition: all 0.3s ease;
}
form button:hover{background-color:#78451C; transform: scale(1.05);}

/* Botões de Cadastrar Lixeira (Ação principal) */
.button-style {
    background-color:#582F0E; 
    color:#DCDABE; 
    border:none;
    padding:10px 20px;
    border-radius:10px;
    cursor:pointer;
    transition:0.3s;
    font-weight:bold;
}
.button-style:hover {
    background-color:#78451C;
    transform: scale(1.05);
}

.avatar{width:50px;height:50px;border-radius:50%;border:2px solid #555;object-fit:cover;margin-right:10px;}
</style>
</head>
<body>

<header class="header-admin">
    
    <picture id="link-logo" class="logo-admin">
        <source type="image/webp" srcset="images/logoTT.webp">
        <img id="lata-lixo" src="images/logoTT.jpg" alt="Logo">
    </picture>
    
    <!-- páginas -->
        <div class="nav">
            <!-- forúm -->
                <a href="admin.php">
                    <button class="botao-header">MENU ADMIN</button>
                </a>
                <!-- dashboard -->
                <a href="dashboardAdmin.php">
                    <button class="botao-header">DASHBOARD</button>
                </a>
                <!-- forúm -->
                <a href="forumAdmin.php">
                    <button class="botao-header">FORÚM</button>
                </a>
        </div>

    <div class="header-user">
        <img src="avatares/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar">
        <span>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span>
        <a href="logout.php"><button id="btn-sair-header">Sair</button></a> 
    </div>
</header>

<section id="section-admin">
    <div class="admin-card" onclick="abrirModal('modal-usuarios')"><h2>Usuários</h2><p>Gerenciar todos os usuários</p></div>
    <div class="admin-card" onclick="abrirModal('modal-lixeiras')"><h2>Lixeiras</h2><p>Visualizar, cadastrar e excluir lixeiras</p></div>
    <div class="admin-card" onclick="abrirModal('modal-depoimentos')"><h2>Depoimentos</h2><p>Visualizar e excluir posts do fórum</p></div>
</section>

<footer class="footer">
    <picture>
        <source type="image/webp" srcset="images/trash.webp">
        <img id="lata-lixo" src="images/trash.jpg" alt="Logo" style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
    </picture>
    <h2>TrashTracker - Todos os direitos reservados ℗ </h2>
    <div>
        <h3 style="color: black;">Contate-nos</h3>
        <a href="mailto:aylla.aoliveira@gmail.com">Email</a> 
    </div>
    <div> 
        <h3 style="color: black;">Páginas</h3>
        <p style="color: black;"> 
            <a href="index.php">INÍCIO</a> <br>
            <a href="sobre.php">SOBRE</a> <br>
            <a href="porque.php">PORQUE NÓS?</a> <br>
            <a href="dashboard.php">DASHBOARD</a> <br>
            <a href="forum.php">FORÚM</a>
        </p>
    </div>
    <div>
        <h3 style="color: black;">Repositório</h3>
        <a href="https://github.com/Lylica/trashTrack"> Acesse o repositório do projeto</a> 
    </div>
</footer>

<div class="modal" id="modal-usuarios">
<div class="modal-content">
<span class="close-modal" onclick="fecharModal('modal-usuarios')">&times;</span>
<h3>Gerenciar Usuários</h3>

<input type="text" id="inputPesquisaUsuario" onkeyup="filtrarUsuarios()" placeholder="Pesquisar por Nome ou Usuário...">

<div id="listaUsuarios">
<?php 
if ($usuarios->num_rows > 0) {
    $usuarios->data_seek(0);
}
while($u = $usuarios->fetch_assoc()): 
?>
<div class="lista-item usuario-item" id="user-item-<?php echo $u['id']; ?>">
<span onclick="toggleDetalhes('detalhes-user-<?php echo $u['id']; ?>')"><?php echo htmlspecialchars($u['nome'].' ('.$u['usuario'].')'); ?></span>

<div id="detalhes-user-<?php echo $u['id']; ?>" style="display:none; margin-top:10px;">
    <div class="info-block">
        <img src="avatares/<?php echo htmlspecialchars($u['avatar']); ?>" class="avatar">
        <div>
            <p style="margin: 0 0 5px 0;"><strong>Email:</strong> <?php echo htmlspecialchars($u['email']); ?></p>
            <p style="margin: 0;"><strong>Tipo:</strong> <?php echo htmlspecialchars($u['tipo']); ?></p>
        </div>
    </div>
    
    <div style="display:flex; gap:5px; margin-top:10px;">
        <button onclick="abrirFormEditar(<?php echo $u['id']; ?>)">Editar</button>
        <button onclick="abrirModalPosts('<?php echo $u['usuario']; ?>')">Ver Posts</button>
        <a href="admin.php?delete_user=<?php echo $u['id']; ?>" onclick="return confirm('Excluir usuário?')"><button>Excluir</button></a>
    </div>

    <div id="form-editar-<?php echo $u['id']; ?>" style="display:none; margin-top:10px;">
        <form method="post" action="admin.php">
            <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
            <input type="text" name="nome" value="<?php echo htmlspecialchars($u['nome']); ?>" required>
            <input type="text" name="usuario" value="<?php echo htmlspecialchars($u['usuario']); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($u['email']); ?>" required>

            <input type="hidden" name="tipo" value="<?php echo htmlspecialchars($u['tipo']); ?>">

            <button type="submit" name="editar_usuario">Salvar Alterações</button>
        </form>
    </div>
</div>
</div>
<?php endwhile; ?>
</div>
</div>
</div>

<div class="modal" id="modal-lixeiras">
<div class="modal-content">
<span class="close-modal" onclick="fecharModal('modal-lixeiras')">&times;</span>
<h3>Gerenciar Lixeiras</h3>
<button class="button-style" onclick="toggleFormLixeira()" style="margin-bottom: 20px;">Cadastrar Lixeira</button> 

<form id="form-lixeira" method="post" action="admin.php" style="display:none;"> 
<input type="text" name="nome_lixeira" placeholder="Nome da lixeira" required>
<input type="text" name="localizacao" placeholder="Localização" required>
<input type="number" name="nivel" placeholder="Nível (0-100)" min="0" max="100" required>
<select name="status" required>
<option value="vazia">Vazia</option>
<option value="meia">Meia</option>
<option value="cheia">Cheia</option>
</select>
<button type="submit" name="nova_lixeira">Cadastrar</button>
</form>

<?php 
if ($lixeiras->num_rows > 0) {
    $lixeiras->data_seek(0);
}
while($l = $lixeiras->fetch_assoc()): 
?>
<div class="lista-item">
<span onclick="toggleDetalhes('detalhes-<?php echo $l['id']; ?>')"><?php echo htmlspecialchars($l['nome']); ?></span>
<div id="detalhes-<?php echo $l['id']; ?>" style="display:none; margin-top:10px;">
<p style="color: #000;"><strong>Localização:</strong> <?php echo htmlspecialchars($l['localizacao']); ?></p>
<p style="color: #000;"><strong>Nível:</strong> <?php echo intval($l['nivel']); ?></p>
<p style="color: #000;"><strong>Status:</strong> <?php echo htmlspecialchars($l['status']); ?></p>
<div style="display:flex; gap:10px; margin-top:5px;">
<a href="dashboard.php?lixeira=<?php echo $l['id']; ?>"><button>Ver Dashboard</button></a>
<a href="admin.php?delete_lixeira=<?php echo $l['id']; ?>" onclick="return confirm('Excluir lixeira?')"><button>Excluir</button></a>
</div>
</div>
</div>
<?php endwhile; ?>
</div>
</div>

<div class="modal" id="modal-depoimentos">
<div class="modal-content">
<span class="close-modal" onclick="fecharModal('modal-depoimentos')">&times;</span>
<h3>Gerenciar Depoimentos</h3>
<?php 
if ($depoimentos->num_rows > 0) {
    $depoimentos->data_seek(0);
}
while($d = $depoimentos->fetch_assoc()): 
?>
<div class="lista-item">
<span onclick="toggleDetalhes('detalhes-depo-<?php echo $d['id']; ?>')"><?php echo htmlspecialchars($d['titulo'].' - '.$d['autor']); ?></span>
<div id="detalhes-depo-<?php echo $d['id']; ?>" style="display:none; margin-top:10px;">
<p style="color: #000;"><strong>Conteúdo:</strong> <?php echo nl2br(htmlspecialchars($d['conteudo'])); ?></p>
<p style="color: #000;"><strong>Data:</strong> <?php echo $d['data_criacao']; ?></p>
<a href="admin.php?delete_depo=<?php echo $d['id']; ?>" onclick="return confirm('Excluir depoimento?')"><button>Excluir</button></a>
</div>
</div>
<?php endwhile; ?>
</div>
</div>

<div class="modal <?php if($mostrar_modal_posts) echo 'active'; ?>" id="modal-ver-posts">
<div class="modal-content">
<span class="close-modal" onclick="fecharModal('modal-ver-posts')">&times;</span>
<h3>Posts do usuário <?php echo htmlspecialchars($usuario_modal); ?></h3>

<?php if(!empty($posts_usuario)): ?>
    <?php foreach($posts_usuario as $p): ?>
    <div class="lista-item" style="cursor: default;"> 
    <p style="color: #000;"><strong><?php echo htmlspecialchars($p['titulo']); ?></strong></p>
    <p style="color: #000;"><?php echo nl2br(htmlspecialchars($p['conteudo'])); ?></p>
    <p style="color: #000;"><small><?php echo $p['data_criacao']; ?></small></p>
    <a href="admin.php?delete_depo=<?php echo $p['id']; ?>" onclick="return confirm('Excluir post?')"><button>Excluir</button></a>
    </div>
    <?php endforeach; ?>
<?php else: ?>
    <p style="color: #000;">Este usuário não possui posts.</p>
<?php endif; ?>

</div>
</div>

<script>
function abrirModal(id){document.getElementById(id).classList.add('active');}
function fecharModal(id){
    document.getElementById(id).classList.remove('active');
    // Para limpar o parâmetro ver_posts da URL quando o modal de posts é fechado
    if (id === 'modal-ver-posts') {
        const url = new URL(window.location.href);
        url.searchParams.delete('ver_posts');
        window.history.pushState({}, '', url.toString());
    }
}
function toggleDetalhes(id){
    const e = document.getElementById(id); 
    e.style.display = e.style.display === 'none' ? 'block' : 'none'; 
} 
function toggleFormLixeira(){const f=document.getElementById('form-lixeira'); f.style.display=f.style.display==='none'?'block':'none';}
function abrirFormEditar(id){const f=document.getElementById('form-editar-'+id); f.style.display=f.style.display==='none'?'block':'none';}
function abrirModalPosts(usuario){
    window.location.href='admin.php?modal=usuarios&ver_posts='+encodeURIComponent(usuario);
}

// Função de pesquisa de usuários
function filtrarUsuarios() {
    const input = document.getElementById('inputPesquisaUsuario');
    const filtro = input.value.toLowerCase();
    const itens = document.querySelectorAll('.usuario-item');
    let encontrou = false;

    itens.forEach(item => {
        const texto = item.querySelector('span').textContent.toLowerCase();
        
        if (texto.includes(filtro)) {
            item.style.display = 'flex'; 
            encontrou = true;
        } else {
            item.style.display = 'none'; 
        }
    });
}


// REABRE OS MODAIS APÓS AÇÕES, INCLUINDO O MODAL DE POSTS
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const modalId = urlParams.get('modal');
    const formUserId = urlParams.get('form_user');
    const verPosts = urlParams.get('ver_posts'); 

    if (modalId) {
        abrirModal(modalId);
        
        if (modalId === 'modal-usuarios' && formUserId) {
            const detalhes = document.getElementById('detalhes-user-' + formUserId);
            const formEditar = document.getElementById('form-editar-' + formUserId);
            if (detalhes) {
                detalhes.style.display = 'block'; 
            }
            if (formEditar) {
                formEditar.style.display = 'block'; 
            }
        }
    }
    
    // Força a abertura do modal de posts
    if (verPosts) {
        abrirModal('modal-ver-posts');
    }
}
</script>

</body>
</html>