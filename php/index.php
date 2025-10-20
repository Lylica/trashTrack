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
    <title>Página principal, inicial e padrão do site TrashTracker</title>
    <meta name="description" contento="Página principal do site TrashTracker, onde estão linkadas todas as outras páginas de acesso geral ou de administrador, sendo duas tendo necessidade de login">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    
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
        <a id="link-logo" href="index.php">
            <img id="lata-lixo" src="../images/logo.png" alt="Logo">
        </a>
        <div class="header-title">
            <h1 id="trashtracker">TrashTracker</h1>
        </div>
        <div class="nav">
            <a class="menu-bar" href="index.php">INÍCIO</a>
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
            <a href="logout.php"><button id="btn-sair-header">Sair</button></a>
            <?php else: ?>
            <a href="login.php"><button id="btn-login-header">Login</button></a>
            <?php endif; ?>
        </div>
    </header>

    <!-- primeira seção-->
    <section class="corpo-do-site">
        <div class="section-text">
            <h1 id="titulo-corpo-pagina">Trash Tracker</h1>
            <p id="introdução">Sua solução para o descarte incorreto de lixo!</p>
            <?php if(!isset($_SESSION['usuario'])): ?>
            <a href="login.php"><button class="btn-login">Login</button></a>
            <?php endif; ?>
            <a href="dashboard.php"><button class="btn-dashboard">Dashboard</button></a>
        </div>
        <img id="dashboard-img" src="../images/logo.png" alt="logo">
    </section>

    <!-- seção de destaques -->
    <section id="section-lixeiras">
        <div class="content-box sobre">
            <img class="lixo" src="../images/4-semfundo.png" alt="Sobre">
            <h2 id="sobre">SOBRE</h2>
            <p class="descrição">Na página “sobre”, você conhecerá um pouco mais do projeto, das nossas motivações e
                dos colaboradores do projeto!</p>
        </div>
        <div class="content-box porque">
        <img class="lixo" src="../images/1-semfundo.png" alt="Porque">
            <h2 id="porque">PORQUE?</h2>
            <p class="descrição">Na página “porque?” você entenderá o porque da TrashTracker se a melhor solução,
                com foco nos nossos diferenciais e com dados reais!</p>
        </div>
        <div class="content-box dashboard-box">
            <img class="lixo" src="../images/2-semfundo.png" alt="Dashboard">
            <h2 id="dashboard">DASHBOARD</h2>
            <p class="descrição">Na página “dashboard”, você terá acesso ao nível de lixo das lixeiras que estiverem
                mais perto de você, aonde quer que você esteja!</p>
        </div>
    </section>

    <!-- carrossel de depoimentos -->
    <section id="carrossel-wrapper">
        <section id="carrossel-depoimentos">
            <?php
            $sql = "SELECT f.*, u.avatar FROM forum f 
                    LEFT JOIN usuarios u ON f.autor = u.usuario
                    ORDER BY f.data_criacao DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0):
                while($row = $result->fetch_assoc()):
                    $avatar = $row['avatar'] ?? 'avatar1.png';
            ?>
            <div class="div-depoimentos">
                <div class="post-text-wrapper">
                    <p>
                        <?php echo nl2br(htmlspecialchars($row['conteudo'])); ?>
                    </p>
                </div>
                <div class="post-user">
                    <img src="avatares/<?php echo htmlspecialchars($avatar); ?>" alt="Avatar">
                    <cite>
                        <?php echo htmlspecialchars($row['autor']); ?> - 
                        <?php echo date('d/m/Y H:i', strtotime($row['data_criacao'])); ?>
                    </cite>
                </div>
            </div>
            <?php
                endwhile;
            else:
                echo "<p class='no-posts'>Ainda não há comentários.</p>";
            endif;
            ?>
        </section>
    </section>

   

    <!-- rodapé -->
    <footer class="footer">
        <img src="../images/trash.png">
        <h2>TrashTracker - Todos os direitos reservados ℗ </h2>
    </footer>

    <!-- JS -->
   <script src="../js/index.js"></script>
</body>

</html>
