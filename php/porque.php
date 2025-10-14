<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porque nós? - TrashTracker</title>
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
          <div style="display:flex; align-items:center; gap:10px; margin-right:10px;">
    <?php if(!empty($_SESSION['avatar'])): ?>
        <img src="../php/avatares/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" 
             alt="Avatar" 
             style="width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid #555;">
    <?php else: ?>
        <img src="../php/avatares/avatar1.png" 
             alt="Avatar padrão" 
             style="width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid #555;">
    <?php endif; ?>
    <span>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span>
</div>

        </div>
    </header>

    <!-- primeira seção -->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 60px;"> 
        <div>
            <h1 style="color: rgb(194, 197, 170); font-family: Inter">Porque nós?</h1>
            <p style="font-family: Inter; color: rgb(194, 197, 170); font-weight: 500; font-size: 20px;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...
            </p>
        </div>
    </section>

    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 20px; ">
        <h1 style="font-family: Inter; color: rgb(194, 197, 170); margin-left: 50px;">Diferenciais</h1>
    </section>

    <!-- diferenciais -->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 40px; display: flex;">
        <?php for($i=1; $i<=3; $i++): ?>
        <div style="background: rgb(220, 218, 190); height: 600px; width: 500px; padding: 10px; margin-left: 100px; border-radius: 30px;">
            <p style="font-family: Inter; padding: 5px; margin-left: auto; font-size: 25px; font-weight: bold;">DIFERENCIAL <?php echo $i; ?></p>
            <p style="font-family: Inter; margin-left: auto; padding: 5px; margin-bottom: auto; font-size: 22px;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry...
            </p>
        </div>
        <?php endfor; ?>
    </section>

</body>
</html>
