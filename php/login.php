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
  <link rel="stylesheet" href="../css/forum.css">
  <title>Login - trashTrack</title>
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

  <!--Login-->
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

  <!--rodapé-->
  <footer style="background-color: rgb(220, 218, 190); height: 80px; width: auto; padding: 5px;">
    <img style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
      src="../images/trash.png">
    <h2 style="font-family: Inter; color: rgb(65, 72, 51)">TrashTracker - Todos os direitos reservados ℗ </h2>
  </footer>

</body>

</html>