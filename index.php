<?php
session_start();
include 'db.php'; // Conexão com o banco

// Redireciona apenas admins, só se 'tipo' estiver definido
if (isset($_SESSION['usuario']) && isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin') {
    header("Location: admin.php");
    exit;
}

// Usuários comuns logados continuam na página inicial
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashTracker - Sua solução para o descarte incorreto de lixo</title>
    <meta name="description"
        content="Página principal do site TrashTracker, onde estão linkadas todas as outras páginas de acesso geral ou de administrador, sendo duas tendo necessidade de login">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- Media query -->
    <link rel="stylesheet" media="screen and (min-width: 480px) and (max-width: 960px)" href="css/index.css" />

    <!-- Meta Tags das redes sociais -->
    <meta property="og:title" content="TrashTracker - Sua solução para o descarte incorreto de lixo">
    <meta property="og:description"
        content="Página principal do site TrashTracker, onde estão linkadas todas as outras páginas de acesso geral ou de administrador, sendo duas tendo necessidade de login">
    <meta property="og:image" content="images/icone.png">
    <meta property="og:url" content="https://srv1074333.hstgr.cloud">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />

    <!-- Google Analytics-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B7BYK41L1B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-B7BYK41L1B');
    </script>
</head>

<body>
    <!-- cabeçalho -->
    <header class="header-admin">

        <!-- logo -->
        <picture id="link-logo" href="index.php">
            <source type="image/webp" srcset="images/logoTT.webp">
            <img style="width: 220px; height: 80px" id="lata-lixo" src="images/logoTT.jpg" alt="Logo">
        </picture>

        <!-- páginas -->
        <div class="nav">
            <!-- início -->
            <a href="index.php">
                <button class="botao-header">INÍCIO</button>
            </a>
            <!-- sobre -->
            <a href="sobre.php">
                <button class="botao-header">SOBRE</button>
            </a>
            <!-- porque nós? -->
            <a href="porque.php">
                <button class="botao-header">PORQUE NÓS?</button>
            </a>
            <!-- dashboard -->
            <a href="dashboard.php">
                <button class="botao-header">DASHBOARD</button>
            </a>
            <!-- forúm -->
            <a href="forum.php">
                <button class="botao-header">FORÚM</button>
            </a>
        </div>

        <!-- botões de login/cadastro -->
        <div class="header-user">
            <?php if(isset($_SESSION['usuario'])): ?>
            <img src="avatares/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar">
            <span>Olá,
                <?php echo htmlspecialchars($_SESSION['usuario']); ?>!
            </span>
            <a href="logout.php"><button id="btn-sair-header">Sair</button></a>
            <?php else: ?>
            <a href="login.php"><button id="btn-login-header">Login</button></a>
            <?php endif; ?>
        </div>
    </header>

    <!-- primeira seção-->
    <section class="corpo-do-site">
        <div class="section-text">
            <h1 id="titulo-corpo-pagina">Trash Tracker</h1>
            <p id="introdução">Sua solução para o descarte incorreto de lixo doméstico!</p>
        </div>
        <picture>
            <source type="image/webp" srcset="images/dashboard.webp">
            <img id="dashboard-img" src="images/dashboard.jpg" alt="dashboard">
        </picture>
    </section>

    <!-- seção de destaques -->
    <section id="section-lixeiras">

        <a href="sobre.php" class="content-box card-sobre">
            <h2 id="sobre">SOBRE</h2>
        </a>

        <a href="porque.php" class="content-box card-porque">
            <h2 id="porque">PORQUE?</h2>
        </a>  

        <a href="dashboard.php" class="content-box card-dashboard">
            <h2 id="dashboard">DASHBOARD</h2>
        </a>

    </section>

    <!-- rodapé -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-col">
                <picture>
                    <source type="image/webp" srcset="images/logoTT.webp">
                    <img src="images/logoTT.jpg" alt="Logo TrashTracker" class="footer-logo">
                </picture>
                <p class="footer-descricao">Sua solução para o descarte incorreto de lixo doméstico!</p>
            </div>

            <div class="footer-col">
                <h3>Páginas</h3>
                <ul>
                    <li><a href="index.php">INÍCIO</a></li>
                    <li><a href="sobre.php">SOBRE</a></li>
                    <li><a href="porque.php">PORQUE NÓS?</a></li>
                    <li><a href="dashboard.php">DASHBOARD</a></li>
                    <li><a href="forum.php">FÓRUM</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Contato</h3>
                <ul>
                    <li><a href="mailto:aylla.aoliveira@gmail.com">Email</a></li>
                    <li><a href="https://github.com/Lylica/trashTrack" target="_blank">Repositório do Projeto</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Siga-nos</h3>
                <div class="footer-socials">
                    <a href="#" target="_blank" aria-label="Link para o Instagram">
                        Instagram
                    </a>
                    <a href="#" target="_blank" aria-label="Link para o Facebook">
                        Facebook
                    </a>
                    <a href="#" target="_blank" aria-label="Link para o Twitter">
                        Twitter
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 TrashTracker. Todos os direitos reservados.</p>
        </div>
    </footer>
    <!-- JS -->
    <script src="js/index.js"></script>
</body>

</html>