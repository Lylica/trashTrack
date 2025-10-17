<?php
session_start();

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
    <title>Fórum - TrashTracker</title>
    <link rel="stylesheet" href="../css/forum.css">
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
        <nav class="header-nav">
            <a href="index.php">INÍCIO</a>
            <a href="sobre.php">SOBRE</a>
            <a href="porque.php">PORQUE NÓS?</a>
            <a href="dashboard.php">DASHBOARD</a>
            <a href="forum.php">FORÚM</a>
        </nav>
        <div class="header-user">
            <?php if(!empty($_SESSION['avatar'])): ?>
            <img src="../php/avatares/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar">
            <?php else: ?>
            <img src="../php/avatares/avatar1.png" alt="Avatar padrão">
            <?php endif; ?>
            <span>Olá,
                <?php echo htmlspecialchars($_SESSION['usuario']); ?>!
            </span>
            <a href="logout.php"><button>Sair</button></a>
        </div>
    </header>

    <!-- seção principal -->
    <section class="section-top">
        <h1>FÓRUM</h1>
        <p>Boas-vindas ao forúm, aqui você pode escrever e ler sobre sugestões, reclamações e muitos outros comentários
            da comunidade TrashTracker. Sinta-se a vontade para compartilhar conosco a sua ideia ou opinião!</p>
    </section>

    <!-- botão adicionar postagem -->
    <div class="btn-add-wrapper">
        <button id="btn-form">+ Adicionar postagem</button>
    </div>

    <!-- formulário de postagem -->
    <section class="form-section">
        <form method="post" action="processa_post.php">
            <label for="title">Título da postagem</label>
            <input type="text" id="title" name="title" required>

            <label for="autor">Postagem feita por:</label>
            <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($_SESSION['usuario']); ?>"
                readonly>

            <label for="conteudo">Conteúdo</label>
            <textarea id="conteudo" name="conteudo" required></textarea>

            <input type="submit" value="Enviar">
        </form>
    </section>

    <!-- lista de posts -->
    <main class="container-posts">
        <?php
        include 'db.php';
        $sql = "SELECT f.*, u.avatar FROM forum f 
                LEFT JOIN usuarios u ON f.autor = u.usuario
                ORDER BY f.data_criacao DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
                $avatar = !empty($row['avatar']) ? $row['avatar'] : 'avatar1.png';
        ?>
        <article class="post-card">
            <img src="avatares/<?php echo htmlspecialchars($avatar); ?>" alt="Avatar">
            <div class="post-content">
                <h3>
                    <?php echo htmlspecialchars($row['titulo']); ?>
                </h3>
                <p>
                    <?php echo nl2br(htmlspecialchars($row['conteudo'])); ?>
                </p>
                <small>
                    <?php echo htmlspecialchars($row['autor']); ?> —
                    <?php echo date('d/m/Y H:i', strtotime($row['data_criacao'])); ?>
                </small>
            </div>
        </article>
        <?php
            endwhile;
        else:
            echo "<p class='no-posts'>Ainda não há comentários.</p>";
        endif;
        ?>
    </main>

    <!--rodapé-->
    <footer style="background-color: rgb(220, 218, 190); height: 80px; width: auto; padding: 5px;">
        <img style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
            src="../images/trash.png">
        <h2 style="font-family: Inter; color: rgb(65, 72, 51)">TrashTracker - Todos os direitos reservados ℗ </h2>
    </footer>

    <script src="../js/forum.js"></script>
</body>

</html>