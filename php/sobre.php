<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - TrashTracker</title>
    <link rel="stylesheet" href="../css/sobre.css">
</head>
<body>
    <!-- cabeçalho -->
    <header>
        <a href="index.php"><img src="../images/trash.png" alt="Logo"></a>
        <div class="header-title"><h1>TrashTracker</h1></div>
        <nav class="header-nav">
            <a href="index.php">INÍCIO</a>
            <a href="sobre.php">SOBRE</a>
            <a href="porque.php">PORQUE NÓS?</a>
            <a href="dashboard.php">DASHBOARD</a>
            <a href="forum.php">FORÚM</a>
        </nav>
        <div class="user-area">
            <?php if(!empty($_SESSION['avatar'])): ?>
                <img src="../php/avatares/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar">
            <?php else: ?>
                <img src="../php/avatares/avatar1.png" alt="Avatar padrão">
            <?php endif; ?>
            <span>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span>
        </div>
    </header>

    <!-- seção principal -->
    <section class="section-main">
        <div>
            <h1>Sobre o TrashTracker</h1>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...
            </p>
        </div>
    </section>

    <!-- motivações -->
    <section class="section-motivacoes">
        <h1>Motivações</h1>
        <?php for($i=1; $i<=3; $i++): ?>
        <div class="motivacao-box">
            <p class="motivacao-title">MOTIVAÇÃO <?php echo $i; ?></p>
            <p class="motivacao-text">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry...
            </p>
        </div>
        <?php endfor; ?>
    </section>
</body>
</html>
