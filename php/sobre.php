<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - TrashTracker</title>
</head>
<body>
    <!-- cabeçalho -->
    <header style="background-color: rgb(220, 218, 190); height: auto; width: auto; padding: 6px; display: flex">
        <a href="index.php">
            <img  style="height: 40px; width: 40px; margin-top: 20px; margin-right: 10px; margin-left: auto;" src="../images/trash.png">
        </a>
        <div>
                <h1 style="font-family: Inter; color: rgb(65, 72, 51)">TrashTracker</h1>
        </div>
        <div style="margin-top: 2%; margin-left: 2%;">
            <a href="index.php" style="font-family: Inter; font-size: 22px; font-weight: bold;">INÍCIO</a>
            <a href="sobre.php" style="font-family: Inter; font-size: 22px; font-weight: bold;">SOBRE</a>
            <a href="porque.php" style="font-family: Inter; font-size: 22px; font-weight: bold;">PORQUE NÓS?</a>
            <a href="dashboard.php" style="font-family: Inter; font-size: 22px; font-weight: bold;">DASHBOARD</a>
            <a href="forum.php" style="font-family: Inter; font-size: 22px; font-weight: bold;">FORÚM</a>
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

    <!-- seção principal -->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 60px;"> 
        <div>
            <h1 style="color: rgb(194, 197, 170); font-family: Inter">Sobre o TrashTracker</h1>
            <p style="font-family: Inter; color: rgb(194, 197, 170); font-weight: 500; font-size: 20px;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...
            </p>
        </div>
    </section>

    <!-- motivações -->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 40px;">
        <h1 style="font-family: Inter; color: rgb(194, 197, 170)">Motivações</h1>
        <?php for($i=1; $i<=3; $i++): ?>
        <div style="background: rgb(220, 218, 190); height: 100px; width: auto; padding: 5px; margin-bottom: 15px; border-radius: 20px;">
            <p style="font-family: Inter; padding: 2px; margin-left: auto;">MOTIVAÇÃO <?php echo $i; ?></p>
            <p style="font-family: Inter; margin-left: auto; margin-bottom: auto;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry...
            </p>
        </div>
        <?php endfor; ?>
    </section>

</body>
</html>
