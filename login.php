<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND senha='$senha'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $user = $resultado->fetch_assoc();
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['tipo'] = $user['tipo'];
        $_SESSION['avatar'] = $user['avatar'];
        header("Location: index.php");
        exit;
    } else {
        $erro = "Usuário ou senha incorretos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de login do usuário cadastrado do site TrashTracker</title>
    <meta name="description" content="Página de login do usuário cadastrado do site TrashTracker, usado para login de conta de usuários com conta para visualização do dashboard e liberação do forúm">

    <!-- Media query -->
    <link rel="stylesheet" media="screen and (min-width: 480px) and (max-width: 960px)" href="css/login.css" />
    
    <!-- Meta Tags das redes sociais -->
    <meta property="og:title" content="Página de login do usuário cadastrado do site TrashTracker">
    <meta property="og:description" content="ágina de login do usuário cadastrado do site TrashTracker, usado para login de conta de usuários com conta para visualização do dashboard e liberação do forúm">
    <meta property="og:image" content="images/icone.png">
    <meta property="og:url" content="https://srv1074333.hstgr.cloud">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico"/>

    <!-- Google Analytics-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B7BYK41L1B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-B7BYK41L1B');
    </script>
</head>

<body>
  <!-- cabeçalho -->
    <header class="header-admin">
        
        <!-- logo -->
        <picture id="link-logo" href="index.php">
            <source type="image/webp" srcset="images/logoTT.webp">
            <img style="width: 220px; height: 80px" id="lata-lixo" src="images/logoTT.webp" alt="Logo">
        </picture>

        <div class="header-title">
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
            <a href="logout.php"><button id="btn-sair-header">Sair</button></a>
            <?php else: ?>
            <a href="login.php"><button id="btn-login-header">Login</button></a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Login -->
    <div class="login-container">
        <h2>Login</h2>
        <?php if(!empty($erro)) echo "<p class='erro-login'>$erro</p>"; ?>
        <form method="POST">
            <div class="input-group">
                <label>Usuário</label>
                <input type="text" name="usuario" required>
            </div>
            <div class="input-group">
                <label>Senha</label>
                <input type="password" name="senha" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
        <div class="extra-actions">
            <p>Não tem conta?</p>
            <a href="cadastro.php" class="btn-cadastro">Cadastrar</a>
        </div>
    </div>

    <!-- rodapé -->
    <footer class="footer">
        <picture>
            <source type="image/webp" srcset="images/trash.webp">
            <img id="lata-lixo" src="images/trash.jpg" alt="Logo" style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
        </picture>
        <h2>TrashTracker - Todos os direitos reservados ℗ </h2>
        <!--Contato-->
        <div>
            <h3 style="color: black;">Contate-nos</h3>
            <p style="color: black;">Número <br>
                Email <br>
                Instagram 
            </p>
        </div>
        <!--Integrantes-->
        <div> 
            <h3 style="color: black;">Integrantes</h3>
            <p style="color: black;"> 
                <a href="index.php">INÍCIO</a> <br>
                <a href="sobre.php">SOBRE</a> <br>
                <a href="porque.php">PORQUE NÓS?</a> <br>
                <a href="dashboard.php">DASHBOARD</a> <br>
                <a href="forum.php">FORÚM</a>
            </p>
        </div>
        <!--Repositório-->
        <div>
            <h3 style="color: black;">Repositório</h3>
                <a href="https://github.com/Lylica/trashTrack"> Acesse o repositório do projeto</a> 
        </div>
    </footer>

</body>

</html>