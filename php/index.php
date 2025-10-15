<?php
session_start();
include 'db.php'; // Conexão com o banco

// Redireciona apenas admins, só se 'tipo' estiver definido
if (isset($_SESSION['usuario']) && isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin') {
    header("Location: admin.php");
    exit;
}

// Usuários comuns logados continuam na página inicial
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <!-- cabeçalho -->
    <header>
        <a href="index.php">
            <img src="../images/trash.png" alt="Logo">
        </a>
        <div class="header-title">
            <h1>TrashTracker</h1>
        </div>
        <div class="header-nav">
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

    <!-- primeira seção -->
    <section class="section-main">
        <div class="section-text">
            <h1 id="titulo-corpo-pagina">Trash Tracker</h1>
            <p>Sua solução para o descarte incorreto de lixo!</p>
            <?php if(!isset($_SESSION['usuario'])): ?>
                <a href="login.php"><button class="btn-login">Login</button></a>
            <?php endif; ?>
            <a href="dashboard.php"><button class="btn-dashboard">Dashboard</button></a>
        </div>
        <img src="../images/dashboard.png" alt="Dashboard">
    </section>

    <!-- destaques -->
    <section class="section-title">
        <h1>Destaques</h1>
    </section>

    <!-- conteúdo principal -->
    <section class="section-content">
        <div class="content-box sobre">
            <img src="../images/4-semfundo.png" alt="Sobre">
            <h2>SOBRE</h2>
            <p>Lorem ipsum</p>
        </div>

        <div class="content-box porque">
            <img src="../images/1-semfundo.png" alt="Porque">
            <h2>PORQUE?</h2>
            <p>Lorem ipsum</p>
        </div>

        <div class="content-box dashboard-box">
            <img src="../images/2-semfundo.png" alt="Dashboard">
            <h2>DASHBOARD</h2>
            <p>Lorem ipsum</p>
        </div>
    </section>

    <!-- depoimentos -->
    <section class="section-title">
        <h1>Depoimentos</h1>
    </section>

    <!-- seção fórum -->
    <section class="section-forum">
    <?php
    $sql = "SELECT f.*, u.avatar FROM forum f 
            LEFT JOIN usuarios u ON f.autor = u.usuario
            ORDER BY f.data_criacao DESC 
            LIMIT 3";
    $result = $conn->query($sql);

    if ($result->num_rows > 0):
        while($row = $result->fetch_assoc()):
            $avatar = $row['avatar'] ?? 'avatar1.png';
    ?>
        <div class="post-card">
            <img src="avatares/<?php echo htmlspecialchars($avatar); ?>" alt="Avatar">
            <div class="post-content">
                <p><?php echo nl2br(htmlspecialchars($row['conteudo'])); ?></p>
                <cite><?php echo htmlspecialchars($row['autor']); ?> - <?php echo date('d/m/Y H:i', strtotime($row['data_criacao'])); ?></cite>
            </div>
        </div>
    <?php
        endwhile;
    else:
        echo "<p class='no-posts'>Ainda não há comentários.</p>";
    endif;
    ?>
    </section>

    <!-- botão 'Ver todos' -->
    <div class="btn-ver-todos">
        <a href="forum.php">Ver todos</a>
    </div>
</body>
</html>
