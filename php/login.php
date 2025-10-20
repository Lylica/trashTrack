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

  <link rel="stylesheet" href="../css/login.css">
  <title>Login - TrashTracker</title>

  <link rel="stylesheet" href="../css/forum.css">
  <title>Página de login do usuário cadastrado do site TrashTracker</title>
  <meta name="description" contento="Página de login do usuário cadastrado do site TrashTracker, usado para login de conta de usuários cadastrados para visualização do dashboard e liberação do forúm">  

</head>
<body>
  <!-- Cabeçalho -->
  <header>
      <a id="link-logo" href="index.php">
          <img id="lata-lixo" src="../images/logo.png" alt="Logo">
      </a>
      <div class="header-title">
          <h1>TrashTracker</h1>
      </div>
      <div class="nav">
          <a href="index.php">INÍCIO</a>
          <a href="sobre.php">SOBRE</a>
          <a href="porque.php">PORQUE NÓS?</a>
          <a href="dashboard.php">DASHBOARD</a>
          <a href="forum.php">FORÚM</a>
      </div>
      <div class="header-user">
          <?php if(isset($_SESSION['usuario'])): ?>
          <img src="avatares/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar">
          <span>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span>
          <a href="logout.php"><button>Sair</button></a>
          <?php else: ?>
          <a href="login.php"><button>Login</button></a>
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

  <!-- Rodapé -->
  <footer>
      <img src="../images/trash.png" alt="Logo">
      <h2>TrashTracker - Todos os direitos reservados ℗</h2>
  </footer>
</body>
</html>
