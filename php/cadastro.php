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

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro - trashTrack</title>
  <link rel="stylesheet" href="../css/cadastro.css">
</head>
<body>
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

<!-- JS separado -->
<script src="cadastro.js"></script>

</body>
</html>