<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome    = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email   = $_POST['email'];
    $senha   = md5($_POST['senha']);

    $sql = "INSERT INTO usuarios (nome, usuario, email, senha) 
            VALUES ('$nome','$usuario','$email','$senha')";
    
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
 <link rel="stylesheet" href="../css/cadastro.css">
  <title>Cadastro - trashTrack</title>
</head>
<body>
  <div class="cadastro-container">
    <h2>Cadastro</h2>
    <?php if(!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
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
      <button type="submit">Cadastrar</button>
    </form>
    <div class="extra-actions">
      <p>Já tem conta?</p>
      <a href="login.php" class="btn-login">Fazer login</a>
    </div>
  </div>
</body>
</html>
