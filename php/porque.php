<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porque nós? - TrashTracker</title>
    <link rel="stylesheet" href="../css/porque.css">
</head>
<body>
    <!-- cabeçalho -->
    <header class="header-admin">
        <a href="index.php">
            <img src="../images/trash.png" alt="Logo" class="logo">
        </a>
        <div class="header-title"><h1>TrashTracker</h1></div>
        <nav class="header-nav">
            <a href="index.php">INÍCIO</a>
            <a href="sobre.php">SOBRE</a>
            <a href="porque.php">PORQUE NÓS?</a>
            <a href="dashboard.php">DASHBOARD</a>
            <a href="forum.php">FORÚM</a>
        </nav>
        <div class="header-user">
            <?php if(!empty($_SESSION['usuario'])): ?>
                <img src="../php/avatares/<?php echo htmlspecialchars($_SESSION['avatar'] ?? 'avatar1.png'); ?>" alt="Avatar" class="avatar">
                <span>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span>
            <?php else: ?>
                <span>Olá, visitante!</span>
            <?php endif; ?>
        </div>
    </header>

    <!-- primeira seção -->
    <section class="section-main">
        <div>
            <h1>Porque nós?</h1>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...
            </p>
        </div>
    </section>

    <!-- diferenciais título -->
    <section class="section-title">
        <h1>Diferenciais</h1>
    </section>

    <!-- diferenciais -->
    <section class="section-diferenciais">
        <?php for($i=1; $i<=3; $i++): ?>
        <div class="diferencial-box">
            <p class="diferencial-title">DIFERENCIAL <?php echo $i; ?></p>
            <p class="diferencial-text">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry...
            </p>
        </div>
        <?php endfor; ?>
    </section>
</body>
</html>
