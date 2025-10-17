<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome    = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email   = $_POST['email'];
    $senha   = md5($_POST['senha']);
    $avatar  = $_POST['avatar'] ?? 'avatar1.png'; // se não escolher, pega o padrão

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

<!-- HTML -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro - trashTrack</title>
    <link rel="stylesheet" href="../css/forum.css">
</head>

<body>
    <!-- cabeçalho -->
    <header>
        <!--Logo volta pro inicio-->
        <a id="link-logo" href="index2.php">
            <img id="lata-lixo" src="../images/trash.png" alt="Logo">
        </a>
        <div class="header-title">
            <h1 id="trashtracker">TrashTracker</h1>
        </div>
        <div class="nav">
            <a class="menu-bar" href="index2.php">INÍCIO</a>
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
            <a href="logout.php"><button>Sair</button></a>
            <?php else: ?>
            <a href="login.php"><button id="btn-login-header">Login</button></a>
            <?php endif; ?>
        </div>
    </header>

    <!--Cadastro-->
    <div class="cadastro-container">
        <h2>Cadastro</h2>
        <?php if(!empty($erro)) echo "<p class='erro'>$erro</p>"; ?>
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
                    <img id="avatarDisplay" src="avatares/avatar1.png" alt="Avatar" class="avatar">
                    <button type="button" class="arrow right">&#10095;</button>
                </div>
                <input type="hidden" name="avatar" id="avatarInput" value="avatar1.png">
            </div>

            <button type="submit">Cadastrar</button>
            <div class="extra-actions">
                <p>Já possui uma conta?</p>
                <a href="login.php" class="btn-login">Login</a>
            </div>
        </form>
    </div>

    <!--rodapé-->
    <footer style="background-color: rgb(220, 218, 190); height: 80px; width: auto; padding: 5px;">
        <img style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
            src="../images/trash.png">
        <h2 style="font-family: Inter; color: rgb(65, 72, 51)">TrashTracker - Todos os direitos reservados ℗ </h2>
    </footer>

    <!-- JS separado -->
    <script src="cadastro.js"></script>

</body>

</html>