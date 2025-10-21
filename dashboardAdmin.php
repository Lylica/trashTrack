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
    <title>Página do dashboard de administrador do site TrashTracker</title>
    <meta name="description" content="Página do dashboard de administrador do site TrashTracker, utilizado para visualização do dashboard e de rotas inteligentes de coleta para administradores">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/dashboardAdmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
        
    <!-- Media query -->
    <link rel="stylesheet" media="screen and (min-width: 480px) and (max-width: 960px)" href="css/dashboardAdmin.css" />
    
    <!-- Meta Tags das redes sociais -->
    <meta property="og:title" content="Página do dashboard de administrador do site TrashTracker">
    <meta property="og:description" content="Página do dashboard de administrador do site TrashTracker, utilizado para visualização do dashboard e de rotas inteligentes de coleta para administradores">
    <meta property="og:image" content="images/icone.png">
    <meta property="og:url" content="https://srv1074333.hstgr.cloud">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />

    <!-- Google Analytics-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B7BYK41L1B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-B7BYK41L1B');
    </script>
</head>

<body>
     <!-- cabeçalho -->
    <header class="header-admin">

        <!-- logo -->
        <picture id="link-logo" href="index.php">
            <source type="image/webp" srcset="images/logo.webp">
            <img id="lata-lixo" src="images/logo.jpg" alt="Logo">
        </picture>
        
        <div class="header-title">
            <h1 id="trashtracker">TrashTracker</h1>
        </div>
        <div class="nav">
            <a class="menu-bar" href="index.php">INÍCIO</a>
            <a class="menu-bar" href="sobre.php">SOBRE</a>
            <a class="menu-bar" href="porque.php">PORQUE NÓS?</a>
            <a class="menu-bar" href="dashboard.php">DASHBOARD</a>
            <a class="menu-bar" href="forum.php">FORÚM</a>
        </div>
        <div class="header-user">
            <?php if(isset($_SESSION['usuario'])): ?>
            <img src="avatares/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar">
            <span>Olá,
                <?php echo htmlspecialchars($_SESSION['usuario']); ?>!
            </span>
            <a href="logout.php"><button>Sair</button></a>
            <?php else: ?>
            <a href="login.php"><button id="btn-login-header">Login</button></a>
            <?php endif; ?>
        </div>
    </header>

    <main class="dashboard-main">
        <aside class="barra-lateral">
            <h2 class="titulo-dashboard">
            <picture>
                <source type="image/webp" srcset="images/dashboard_icon.webp">
                <img src="images/dashboard_icon.jpg" alt="Ícone do Dashboard">
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

                <div id="lixeira-container">
                    <div id="lixeira">
                        <div id="nivel"></div>
                    </div>
                    <p id="percentual">0%</p>
                </div>
            </div>

            <div id="info-bloco" class="info-bloco">
                <p><strong>Última atualização:</strong> <span id="ultima-atualizacao">--:--</span></p>
                <p><strong>Nível atual:</strong> <span id="nivel-atual">0%</span></p>
                <p><strong>Status:</strong> <span id="status-lixeira">--</span></p>
            </div>

            <div class="container-rotas">
    <div class="rota-info info-bloco">
        <h2>ROTA INTELIGENTE</h2>
        <p><strong>Tempo de rota:</strong> <span>1 hora</span></p>
        <p><strong>Qtd de lixeiras:</strong> <span>20</span></p>
        <p><strong>Distância total:</strong> <span>20km</span></p>
        <p><strong>Rota inteligente:</strong> <span>20km</span></p>
        <p><strong>Combustível rota comum:</strong> <span>8L</span></p>
        <p><strong>Combustível rota inteligente:</strong> <span>3,2L</span></p>
        <p><strong>Combustível economizado:</strong> <span>4,8L</span></p>
    </div>

    <div class="mapa-rotas-container info-bloco">
        <picture>
            <source type="image/webp" srcset="images/maps.webp">
            <img src="images/maps.jpg" alt="Mapa da Rota" class="mapa-rotas">
        </picture>
    </div>
</div>

    <footer class="footer">
        <picture>
            <source type="image/webp" srcset="images/trash.webp">
            <img id="lata-lixo" src="images/trash.jpg" alt="Logo" style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
        </picture>
        <h2>TrashTracker - Todos os direitos reservados ℗</h2>
    </footer>

    <script src="js/dashboard.js"></script>
</body>
</html>