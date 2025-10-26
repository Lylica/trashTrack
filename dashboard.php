<?php
session_start();

// Redireciona se usuário não estiver logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | TrashTracker</title>
    <meta name="description" content="Dashboard do TrashTracker, mostrando o nível das lixeiras próximas ao usuário.">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <meta property="og:title" content="Dashboard | TrashTracker">
    <meta property="og:description" content="Visualize níveis de lixeiras próximas em tempo real.">
    <meta property="og:image" content="images/icone.png">
    <meta property="og:url" content="https://srv1074333.hstgr.cloud">

    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B7BYK41L1B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-B7BYK41L1B');
    </script>
</head>

<body>

<header class="header-admin">
    <a id="link-logo" href="index.php">
        <picture>
            <source type="image/webp" srcset="images/logoTT.webp">
            <img src="images/logoTT.webp" alt="Logo TrashTracker" width="220" height="80">
        </picture>
    </a>

    <nav class="nav">
        <a class="menu-bar" href="index.php">INÍCIO</a>
        <a class="menu-bar" href="sobre.php">SOBRE</a>
        <a class="menu-bar" href="porque.php">PORQUE NÓS?</a>
        <a class="menu-bar" href="dashboard.php">DASHBOARD</a>
        <a class="menu-bar" href="forum.php">FÓRUM</a>
    </nav>

    <div class="header-user">
        <?php if(isset($_SESSION['usuario'])): ?>
            <div class="desktop-only-user-info">
                <img src="avatares/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar do usuário">
                <span id="user-greeting">Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span>
            </div>
            
            <a href="logout.php" class="desktop-only-logout-container">
                <button id="btn-sair-header">Sair</button>
            </a>
            
            <?php else: ?>
            <a href="login.php"><button id="btn-login-header">Login</button></a>
        <?php endif; ?>
    </div>

    <button id="btn-mobile-menu" class="mobile-menu-button">☰</button>
</header>

<nav id="sidebar-mobile" class="sidebar-mobile">
    <button id="close-sidebar" class="close-sidebar">×</button>

    <?php if(isset($_SESSION['usuario'])): ?>
        <div class="sidebar-user-profile">
            <img src="avatares/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar do usuário">
            <span id="user-greeting-mobile">Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span>
        </div>
        
        <div class="mobile-only-logout-container" style="width: 100%; margin-bottom: 15px;">
            <a href="logout.php" style="width: 100%;"><button id="btn-sair-mobile">Sair</button></a>
        </div>

        <hr>
    <?php endif; ?>

    <a href="index.php">INÍCIO</a>
    <a href="sobre.php">SOBRE</a>
    <a href="porque.php">PORQUE NÓS?</a>
    <a href="dashboard.php">DASHBOARD</a>
    <a href="forum.php">FÓRUM</a>

    <hr>

    <h3>Selecionar Dia</h3>
    <select id="selecionar-dia-mobile"></select>

    <h3>Tipo de Gráfico</h3>
    <div class="btn-group">
        <button data-tipo="bar">Bar</button>
        <button data-tipo="step">Step</button>
    </div>

    <button id="btnCSV-mobile">Exportar CSV</button>

    </nav>

<main class="dashboard-main">

    <aside class="barra-lateral">
        <h2 class="titulo-dashboard">
            <picture>
                <source type="image/webp" srcset="images/dashboard_icon.webp">
                <img src="images/dashboard_icon.jpg" alt="Ícone Dashboard">
            </picture>
            Dashboard
        </h2>

        <div class="config-grafico">
            <h3>Selecionar Dia</h3>
            <select id="selecionar-dia">
                <option disabled selected>Carregando dias...</option>
            </select>

            <h3>Tipo de Gráfico</h3>
            <div class="btn-group">
                <button data-tipo="bar" class="active">Bar</button>
                <button data-tipo="step">Step</button>
            </div>

            <button id="btnCSV">Exportar CSV</button>
        </div>
    </aside>

    <section class="conteudo-dashboard">
        <h2 id="data-titulo">Nível da Lixeira</h2>

        <div class="container-graficos">
            <canvas id="chart"></canvas>
        </div>

        <div id="info-bloco" class="info-bloco">
            <p><strong>Última atualização:</strong> <span id="ultima-atualizacao">--:--</span></p>
            <p><strong>Nível atual:</strong> <span id="nivel-atual">0%</span></p>
            <p><strong>Status:</strong> <span id="status-lixeira">--</span></p>
        </div>
    </section>

</main>

<footer class="footer">
    <h2>TrashTracker - Todos os direitos reservados ℗</h2>

    <div class="footer-content-wrapper">
        <div>
            <h3>Contate-nos</h3>
            <p>Número<br>Email<br>Instagram</p>
        </div>

        <div>
            <h3>Repositório</h3>
            <a href="https://github.com/Lylica/trashTrack" target="_blank">Acesse o repositório do projeto</a>
        </div>
    </div>
</footer>

<script src="js/dashboard.js"></script>

</body>
</html>