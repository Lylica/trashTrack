<?php
session_start();
include 'db.php'; // conexão com o banco

// Só permite acesso se o usuário estiver logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fórum TrashTracker</title>
    <meta name="description" content="Página de visualização e uso do fórum do site TrashTracker">
    <link rel="stylesheet" href="css/forum.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
</head>

<body>
    <!-- cabeçalho -->
    <header class="header-admin">
        
        <!-- logo -->
        <picture id="link-logo" href="index.php">
            <source type="image/webp" srcset="images/logoTT.webp">
            <img style="width: 220px; height: 80px" id="lata-lixo" src="images/logoTT.webp" alt="Logo">
        </picture>

        <div class="header-title">
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


    <!-- SEÇÃO PRINCIPAL -->
    <section class="section-main">
        <h1>Fórum</h1>
        <p>
            Boas-vindas ao fórum! Aqui você pode escrever e ler sobre sugestões, reclamações e comentários
            da comunidade TrashTracker. Sinta-se à vontade para compartilhar a sua ideia ou opinião!
        </p>
    </section>

    <!-- FORMULÁRIO DE POSTAGEM -->
    <section class="form-section">
        <form method="post" action="processa_post.php">
            <h2>POST FÓRUM</h2>

            <label for="title">Título da postagem</label>
            <input type="text" id="title" name="title" required>

            <label for="autor">Postagem feita por:</label>
            <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($_SESSION['usuario']); ?>" readonly>

            <label for="conteudo">Conteúdo</label>
            <textarea id="conteudo" name="conteudo" required></textarea>

            <input id="btn-enviar" type="submit" value="Enviar">
        </form>
    </section>

    <!-- CARROSSEL DE DEPOIMENTOS -->
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
                    <p><?php echo nl2br(htmlspecialchars($row['conteudo'])); ?></p>
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
        <picture>
            <source type="image/webp" srcset="images/trash.webp">
            <img id="lata-lixo" src="images/trash.jpg" alt="Logo" style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
        </picture>
        <h2>TrashTracker - Todos os direitos reservados ℗ </h2>
        <!--Contato-->
        <div>
            <h3 style="color: black;">Contate-nos</h3>
            <p style="color: black;">Número <br>
                Email <br>
                Instagram 
            </p>
        </div>
        <!--Integrantes-->
        <div> 
            <h3 style="color: black;">Integrantes</h3>
            <p style="color: black;"> 
                <a href="index.php">INÍCIO</a> <br>
                <a href="sobre.php">SOBRE</a> <br>
                <a href="porque.php">PORQUE NÓS?</a> <br>
                <a href="dashboard.php">DASHBOARD</a> <br>
                <a href="forum.php">FORÚM</a>
            </p>
        </div>
        <!--Repositório-->
        <div>
            <h3 style="color: black;">Repositório</h3>
                <a href="https://github.com/Lylica/trashTrack"> Acesse o repositório do projeto</a> 
        </div>
    </footer>

    <!-- JS -->
    <script src="js/index.js"></script>
</body>
</html>
