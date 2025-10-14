<?php
session_start();

// Redireciona apenas admins, só se 'tipo' estiver definido
if (isset($_SESSION['usuario']) && isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin') {
    header("Location: admin.php");
    exit;
}

// Usuários comuns logados continuam na página inicial
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial</title>
</head>
<body>
    <!-- cabeçalho -->
    <header style="background-color: rgb(220, 218, 190); height: auto; width: auto; padding: 6px; display: flex; align-items: center;">
        <a href="index.php">
            <img style="height: 40px; width: 40px; margin-top: 20px; margin-right: 10px; margin-left: auto;" src="../images/trash.png" alt="Logo">
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
        <div class="header-user">
          <?php if(isset($_SESSION['usuario'])): ?>
    <img src="avatares/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" 
         alt="Avatar" 
         style="width:40px; height:40px; border-radius:50%; margin-right:10px; object-fit: cover;">
    <span style="margin-right:10px;">Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span>
    <a href="logout.php"><button style="width: 100px; height: 50px;">Sair</button></a>
<?php else: ?>
    <a href="login.php"><button style="width: 100px; height: 50px;">Login</button></a>
<?php endif; ?>


        </div>
    </header>

    <!-- primeira seção -->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 20px; display: flex;"> 
        <div>
            <h1 style="color: rgb(194, 197, 170); font-family: Inter; margin-top: 100px; margin-left: 100px;">Trash Tracker</h1>
            <p style="font-family: Inter; color: rgb(194, 197, 170); font-weight: 500; margin-left: 100px;">Sua solução para o descarte incorreto de lixo!</p>
            <?php if(!isset($_SESSION['usuario'])): ?>
                <a href="login.php"><button style="margin-left: 100px;">Login</button></a>
            <?php endif; ?>
            <a href="dashboard.php"><button style="margin-left: 10px;">Dashboard</button></a>  
        </div>
        <img style="width: 500px; height: 300px; margin-left: 500px; margin-top: 20px;" src="../images/dashboard.png" alt="Dashboard">
    </section>

    <!-- destaques -->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 20px;">
        <h1 style="font-family: Inter; color: rgb(194, 197, 170)">Destaques</h1>
    </section>

    <!-- conteúdo principal -->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 20px; display: flex;">
        <div>
            <img  style="height: 200px; width: 200px; margin: 20px; margin-left: 100px;" src="../images/4-semfundo.png" alt="Sobre">
            <h2 style="color: rgb(88, 47, 14); font-family: Inter; margin-left: 100px;">SOBRE</h2>
            <p style="font-family: Inter; color: rgb(194, 197, 170); font-weight: 500; margin-left: 100px;">Lorem ipsum</p>
        </div>

        <div>
            <img  style="height: 200px; width: 200px; margin: 20px; margin-left: 100px;" src="../images/1-semfundo.png" alt="Porque">
            <h2 style="color: rgb(166, 138, 100); font-family: Inter; margin-left: 100px;">PORQUE?</h2>
            <p style="font-family: Inter; color: rgb(194, 197, 170); font-weight: 500; margin-left: 100px;">Lorem ipsum</p>
        </div>

        <div>
            <img  style="height: 200px; width: 200px; margin: 20px; margin-left: 100px;" src="../images/2-semfundo.png" alt="Dashboard">
            <h2 style="color: rgb(220, 218, 190); font-family: Inter; margin-left: 100px;">DASHBOARD</h2>
            <p style="font-family: Inter; color: rgb(194, 197, 170); font-weight: 500; margin-left: 100px;">Lorem ipsum</p>
        </div>
    </section>

    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 20px;">
        <h1 style="font-family: Inter ; color: rgb(194, 197, 170)">Depoimentos</h1>
    </section>

    <!-- footer/depoimentos -->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 20px; margin: auto; display: flex">
        <div style="background: rgb(220, 218, 190); height: 140px; width: 400px; border-radius: 20px;  margin-left: 100px; margin-bottom: 30px;">
            <p style="font-family: Inter; padding: 15px;">texto</p>
            <cite style="font-family: Inter; padding: 10px">Anônimo - Salto de Pirapora</cite>
        </div>
        <div style="background: rgb(220, 218, 190); height: 140px; width: 400px; border-radius: 20px; margin-left: 100px; margin-bottom: 30px;">
            <p style="font-family: Inter; padding: 15px">texto</p>
            <cite style="font-family: Inter; padding: 10px">Anônimo - Sorocaba</cite>
        </div>
        <div style="background: rgb(220, 218, 190); height: 140px; width: 400px; border-radius: 20px; margin-left: 100px; margin-bottom: 30px;">
            <p style="font-family: Inter; padding: 15px">texto</p>
            <cite style="font-family: Inter; padding: 10px">Anônimo - Itu</cite>
        </div>
    </section>

</body>
</html>
