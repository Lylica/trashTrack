<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha   = md5($_POST['senha']); // md5 só pra teste, ideal seria password_hash

    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND senha='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['tipo']    = $row['tipo'];

        if ($row['tipo'] == 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
 <link rel="stylesheet" href="../css/login.css">
  <title>Login - trashTrack</title>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <?php if(!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
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
</body>
</html>
