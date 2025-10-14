<?php
session_start();

// Só permite acesso se o usuário estiver logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fórum - TrashTracker</title>
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

    <!-- seção principal -->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 60px;"> 
        <div>
            <h1 style="color: rgb(194, 197, 170); font-family: Inter">FÓRUM</h1>
            <p style="font-family: Inter; color: rgb(194, 197, 170); font-weight: 500; font-size: 20px;">Bem-vindo ao fórum! Aqui você pode enviar comentários e interagir com outros usuários.</p>
        </div>
    </section>

    <!-- formulário de postagem -->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 40px;">
        <form method="post" action="processa_post.php">
            <div style="background: rgb(220, 218, 190); height: auto; width: 500px; padding: 20px; margin-left: 35%; margin-bottom: 15px; border-radius: 20px;">
                
                <label for="title" style="color: rgb(65, 72, 51); font-family: Inter; font-size: 25px;">Título da postagem</label> <br>
                <input style="height: 10%; width: 100%; font-size: 22px;" type="text" id="title" name="title" required> <br><br>
                
                <label for="autor" style="color: rgb(65, 72, 51); font-family: Inter; font-size: 25px;">Postagem feita por: </label> <br>
                <!-- usuário logado já preenchido e readonly -->
                <input style="height: 10%; width: 100%; font-size: 22px;" type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($_SESSION['usuario']); ?>" readonly> <br><br>

                <label for="conteudo" style="color: rgb(65, 72, 51); font-family: Inter; font-size: 25px;">Conteúdo</label> <br>
                <textarea style="height: 200px; width: 100%; resize: none; font-size: 18px;" id="conteudo" name="conteudo" required></textarea> <br><br>
                
                <input style="height: 50px; width: 500px; border-radius: 60px;" type="submit" value="Enviar"> 
            </div>
        </form>
    </section>
</body>
</html>
