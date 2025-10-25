<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome    = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email   = $_POST['email'];
    $senha   = md5($_POST['senha']);
    $avatar  = $_POST['avatar'] ?? 'avatar1.png'; // padrão

    $sql = "INSERT INTO usuarios (nome, usuario, email, senha, avatar) 
            VALUES ('$nome','$usuario','$email','$senha','$avatar')";
    
    if ($conn->query($sql)) {
        header("Location: login.php");
        exit;
    } else {
        $erro = "Erro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/cadastro.css">
    <title>Página de cadastro do usuário do site TrashTracker</title>
    <meta name="description" content="Página de cadastro do usuário do site TrashTracker, usado para criação de conta para novos usuários para visualização do dashboard e liberação do forúm">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Media query -->
    <link rel="stylesheet" media="screen and (min-width: 480px) and (max-width: 960px)" href="css/cadastro.css" />
    
    <!-- Meta Tags das redes sociais -->
    <meta property="og:title" content="Página de cadastro do usuário do site TrashTracker">
    <meta property="og:description" content="Página de cadastro do usuário do site TrashTracker, usado para criação de conta para novos usuários para visualização do dashboard e liberação do forúm">
    <meta property="og:image" content="images/icone.png">
    <meta property="og:url" content="https://srv1074333.hstgr.cloud">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />

    <!-- Google Analytics-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B7BYK41L1B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
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
            <img style="width: 220px; height: 80px" id="lata-lixo" src="images/logoTT.jpg" alt="Logo">
        </picture>

        <!-- páginas -->
        <div class="nav">
                <!-- início -->
                <a href="index.php">
                    <button class="botao-header">INÍCIO</button>
                </a>
                <!-- sobre -->
                <a href="sobre.php">
                    <button class="botao-header">SOBRE</button>
                </a>
                <!-- porque nós? -->
                <a href="porque.php">
                    <button class="botao-header">PORQUE NÓS?</button>
                </a>
                <!-- dashboard -->
                <a href="dashboard.php">
                    <button class="botao-header">DASHBOARD</button>
                </a>
                <!-- forúm -->
                <a href="forum.php">
                    <button class="botao-header">FORÚM</button>
                </a>
        </div>

        <!-- botões de login/cadastro -->
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

<!-- Cadastro -->
<div class="login-container">
    <h2>Cadastro</h2>
    <?php if(!empty($erro)) echo "<p class='erro-login'>$erro</p>"; ?>
    <form method="POST">
        <div class="input-group">
            <label>Nome Completo</label>
            <input type="text" name="nome" required>
        </div>

        <div class="input-group">
            <label>Usuário</label>
            <input type="text" name="usuario" required>
        </div>

        <div class="input-group">
            <label>E-mail</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Senha</label>
            <input type="password" name="senha" required>
        </div>

        <div class="input-group">
            <label>Escolha seu avatar</label>
            <div class="avatar-carousel">
                <button type="button" class="arrow left">&#10094;</button>
                    <img id="avatarDisplay" src="avatares/avatar1.jpg" alt="avatar" class="avatar">
                <button type="button" class="arrow right">&#10095;</button>
            </div>
            <input type="hidden" name="avatar" id="avatarInput" value="avatar1.png">
        </div>

        <button type="submit">Cadastrar</button>

         <div class="extra-actions">
          <p>Já possui uma conta?</p>
          <a href="login.php" class="btn-cadastro">Login</a>
      </div>
  </div>
    </form>
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
                <a href="mailto:aylla.aoliveira@gmail.com">Email</a> 
        </div>
        <!--Integrantes-->
        <div> 
            <h3 style="color: black;">Páginas</h3>
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

<script src="js/cadastro.js"></script>

</body>
</html>
