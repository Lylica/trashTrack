<?php
session_start();

// Redireciona se usuário não estiver logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Redireciona admins para a página de admin
if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin') {
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>trashTrack - Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>

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

<main class="conteudo">

    <!-- cabeçalho -->
    <header style="background-color: rgb(220, 218, 190); height: auto; width: auto; padding: 6px; display: flex">
        <a href="index.php">
            <img style="height: 40px; width: 40px; margin-top: 20px; margin-right: 10px; margin-left: auto;" src="../images/trash.png">
        </a>
        <div>
            <h1 style="font-family: Inter; color: rgb(65, 72, 51)">TrashTracker</h1>
        </div>
        <div style="margin-top: 2%; margin-left: 2%;">
            <a href="index.php" style="font-family: Inter; font-size: 22px; font-weight: bold;">INÍCIO</a>
            <a href="sobre.html" style="font-family: Inter; font-size: 22px; font-weight: bold;">SOBRE</a>
            <a href="porque.html" style="font-family: Inter; font-size: 22px; font-weight: bold;">PORQUE NÓS?</a>
            <a href="dashboard.php" style="font-family: Inter; font-size: 22px; font-weight: bold;">DASHBOARD</a>
            <a href="forum.html" style="font-family: Inter; font-size: 22px; font-weight: bold;">FORÚM</a>
        </div>
        <div style="margin-top: 1%; margin-left: auto;">
            <?php if(isset($_SESSION['usuario'])): ?>
                <span style="margin-right:10px;">Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span>
                <a href="logout.php"><button style="width: 100px; height: 50px;">Sair</button></a>
            <?php else: ?>
                <a href="login.php"><button style="width: 100px; height: 50px;">Login</button></a>
            <?php endif; ?>
        </div>
    </header>

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

<script src="../js/dashboard.js"></script>
</body>
</html>
