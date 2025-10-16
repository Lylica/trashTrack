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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
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
                <a href="login.php"><button>Login</button></a>
            <?php endif; ?>
        </div>
    </header>

    <!-- seção principal -->
    <section class="section-main">
        <div>
            <h1 class="sobre-tt" >Sobre o TrashTracker</h1>
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
