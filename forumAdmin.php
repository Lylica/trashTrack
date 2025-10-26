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
            <img style="width: 220px; height: 80px" id="lata-lixo" src="images/logoTT.jpg" alt="Logo">
        </picture>

        <!-- páginas -->
        <div class="nav">
            <!-- forúm -->
                <a href="admin.php">
                    <button class="botao-header">MENU ADMIN</button>
                </a>
                <!-- dashboard -->
                <a href="dashboardAdmin.php">
                    <button class="botao-header">DASHBOARD</button>
                </a>
                <!-- forúm -->
                <a href="forumAdmin.php">
                    <button class="botao-header">FORÚM</button>
                </a>
        </div>

        <!-- botões de login/cadastro -->
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

    <style>
        /* Remove o marcador (seta/triângulo) para a maioria dos navegadores */
        summary {
            list-style: none;
        }

    /* Remove o marcador para navegadores baseados em WebKit (Chrome, Safari, Edge) */
        summary::-webkit-details-marker {
            display: none;
        }

    </style>

    <!-- FORMULÁRIO DE POSTAGEM -->
    <section class="form-section">
        <form method="post" action="processa_post.php">
            <!-- <h2>POST FÓRUM</h2> -->
            <details>
            <summary style="font-family: inter; font-weight: bold; color: #414533; text-align: center; margin-bottom: 10px;">DEIXE SEU COMENTÁRIO
                <p style="font-weight: 500;">(clique aqui)</p>
            </summary>
            <label for="title">Título da postagem</label>
            <input type="text" id="title" name="title" required>

            <label for="autor">Postagem feita por:</label>
            <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($_SESSION['usuario']); ?>" readonly>

            <label for="conteudo">Conteúdo</label>
            <textarea id="conteudo" name="conteudo" required></textarea>

            <input id="btn-enviar" type="submit" value="Enviar">
            </details>
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
    <div class="footer-inner">
        <div class="footer-col">
            <picture>
                <source type="image/webp" srcset="images/logoTT.webp">
                <img src="images/logoTT.jpg" alt="Logo TrashTracker" class="footer-logo">
            </picture>
            <p class="footer-descricao">Sua solução para o descarte incorreto de lixo doméstico!</p>
        </div>

        <div class="footer-col">
            <h3>Páginas</h3>
            <ul>
                <li><a href="index.php">INÍCIO</a></li>
                <li><a href="sobre.php">SOBRE</a></li>
                <li><a href="porque.php">PORQUE NÓS?</a></li>
                <li><a href="dashboard.php">DASHBOARD</a></li>
                <li><a href="forum.php">FÓRUM</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h3>Contato</h3>
            <ul>
                <li><a href="mailto:aylla.aoliveira@gmail.com">Email</a></li>
                <li><a href="https://github.com/Lylica/trashTrack" target="_blank">Repositório do Projeto</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h3>Siga-nos</h3>
            <div class="footer-socials">
                <a href="#" target="_blank" aria-label="Link para o Instagram">
                    Instagram
                </a>
                <a href="#" target="_blank" aria-label="Link para o Facebook">
                    Facebook
                </a>
                <a href="#" target="_blank" aria-label="Link para o Twitter">
                    Twitter
                </a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2025 TrashTracker. Todos os direitos reservados.</p>
    </div>
</footer>

    <!-- JS 
    <script src="js/index.js"></script>
    -->
</body>
</html>
