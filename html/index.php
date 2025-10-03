<?php
session_start();

// Redireciona apenas admins
if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 'admin') {
    header("Location: admin.php");
    exit;
}

// Usuários comuns logados continuam na página inicial
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

    <?php if(isset($_SESSION['usuario'])): ?>
      <p>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</p>
      <a href="logout.php" class="logout-link">Sair</a>
      <div class="btn-group">
        <a href="dashboard.php" class="btn">Ir para Dashboard</a>
      </div>
    <?php else: ?>
      <div class="btn-group">
        <a href="login.php" class="btn">Fazer Login</a>
        <a href="cadastro.php" class="btn">Criar Conta</a>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
