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
    <title>Dashboard - TrashTracker</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
     <!-- cabeçalho -->
    <header class="header-admin">
        <a id="link-logo" href="index.php">
            <img id="lata-lixo" src="../images/logo.png" alt="Logo">
        </a>
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
                <img src="../images/dashboard_icon.png" alt="Ícone">
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
        </section>
    </main>

    <!-- rodapé -->
    <footer class="footer">
        <img src="../images/trash.png">
        <h2>TrashTracker - Todos os direitos reservados ℗ </h2>
    </footer>

    <script src="../js/dashboard.js"></script>
</body>
</html>
