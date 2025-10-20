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
    <meta name="description" contento="Página dashboard padrão do site TrashTracker, utilizado para visualização do dashboard que mostra o nível das lixeiras mais próximas ao usuário cadastrado">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/forum.css">

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
            <a href="index.php">
                <img style="height: 40px; width: 40px; margin-right: 10px;" src="../images/trash.png">
            </a>

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
                    <img src="../php/avatares/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar"
                        style="width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid #555;">
                    <?php else: ?>
                    <img src="../php/avatares/avatar1.png" alt="Avatar padrão"
                        style="width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid #555;">
                    <?php endif; ?>
                    <span>Olá,
                        <?php echo htmlspecialchars($_SESSION['usuario']); ?>!
                    </span>
                </div>

            </div>
        </header>

        <aside class="barra-lateral">
        <h2 class="titulo-dashboard">
            <img src="../images/dashboard_icon.png" alt="Ícone do Dashboard">
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
        <img style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
            src="../images/trash.png">
        <h2 style="font-family: Inter; color: rgb(65, 72, 51)">TrashTracker - Todos os direitos reservados ℗ </h2>
    </footer>

    <script src="../js/dashboard.js"></script>
</body>

</html>