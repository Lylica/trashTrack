<?php
session_start();

// Redireciona se usuário não estiver logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de visualização do dashboard do site TrashTracker</title>
    <meta name="description" content="Página dashboard padrão do site TrashTracker, utilizado para visualização do dashboard que mostra o nível das lixeiras mais próximas ao usuário cadastrado">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/forum.css">

    <!-- Media query -->
    <link rel="stylesheet" media="screen and (min-width: 480px) and (max-width: 960px)" href="dashboard.css" />
    
    <!-- Meta Tags das redes sociais -->
    <meta property="og:title" content="Página de visualização do dashboard do site TrashTracker">
    <meta property="og:description" content="Página dashboard padrão do site TrashTracker, utilizado para visualização do dashboard que mostra o nível das lixeiras mais próximas ao usuário cadastrado">
    <meta property="og:image" content="images/icone.png">
    <meta property="og:url" content="https://srv1074333.hstgr.cloud/trashTrack/dashboard.php">

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
    <main class="conteudo">

        <!-- cabeçalho -->
        <header
            style="background-color: rgb(220, 218, 190); height: auto; width: auto; padding: 6px; display: flex; align-items: center;">
            
        <!-- logo -->
        <picture id="link-logo" href="index.php">
            <source type="image/webp" srcset="logo.webp">
            <img id="lata-lixo" src="images/logo.jpg" alt="Logo">
        </picture>

            <div>
                <h1 style="font-family: Inter; color: rgb(65, 72, 51)">TrashTracker</h1>
            </div>
            <div style="margin-left: 2%;">
                <a href="index.php" style="font-family: Inter; font-size: 22px; font-weight: bold;">INÍCIO</a>
                <a href="sobre.php" style="font-family: Inter; font-size: 22px; font-weight: bold;">SOBRE</a>
                <a href="porque.php" style="font-family: Inter; font-size: 22px; font-weight: bold;">PORQUE NÓS?</a>
                <a href="dashboard.php" style="font-family: Inter; font-size: 22px; font-weight: bold;">DASHBOARD</a>
                <a href="forum.php" style="font-family: Inter; font-size: 22px; font-weight: bold;">FORÚM</a>
            </div>

            <div style="margin-left: auto; display: flex; align-items: center; gap: 10px;">
                <div style="display:flex; align-items:center; gap:10px; margin-right:10px;">
                    <?php if(!empty($_SESSION['avatar'])): ?>
                    <img src="avatares/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar"
                        style="width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid #555;">
                    <?php else: ?>
                    <picture>
                        <source type="image/webp" srcset="avatar1.webp">
                        <img id="avatarDisplay" src="avatares/avatar1.jpg" alt="Avatar padrão" class="avatar" style="width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid #555;">
                    </picture>
                    <?php endif; ?>
                    <span>Olá,
                        <?php echo htmlspecialchars($_SESSION['usuario']); ?>!
                    </span>
                </div>

            </div>
        </header>

        <aside class="barra-lateral">
        <h2 class="titulo-dashboard">
        <picture>
            <source type="image/webp" srcset="dashboard_icon.webp">
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


        <h2 id="data-titulo">Nível da Lixeira</h2>

        <div class="container">
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

    </main>

    <!--rodapé-->
    <footer style="background-color: rgb(220, 218, 190); height: 80px; width: auto; padding: 5px;">
        <picture>
            <source type="image/webp" srcset="trash.webp">
            <img id="lata-lixo" src="images/trash.jpg" alt="Logo" style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
        </picture>
        <h2 style="font-family: Inter; color: rgb(65, 72, 51)">TrashTracker - Todos os direitos reservados ℗ </h2>
    </footer>

    <script src="js/dashboard.js"></script>
</body>

</html>