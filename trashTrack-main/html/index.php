<?php
session_start();

// se já estiver logado, redireciona direto
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['tipo'] == 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: dashboard.php");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/index.css">
  <title>Bem-vindo - trashTrack</title>
</head>
<body>
  <div class="index-container">
    <h1>trashTrack</h1>
    <p>Gerencie e acompanhe suas lixeiras de forma inteligente.</p>

    <div class="btn-group">
      <a href="login.php" class="btn">Fazer Login</a>
      <a href="cadastro.php" class="btn">Criar Conta</a>
    </div>
  </div>
</body>
</html>
