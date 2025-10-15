<?php
session_start();
include 'db.php'; // adiciona conexão com o banco

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
    <style>
        /* estilos mínimos embarcados só pra ficar apresentável */
        header { background-color: rgb(220, 218, 190); padding: 12px; display:flex; align-items:center; gap:12px; }
        header img { height:40px; width:40px; }
        nav a { margin-right:12px; font-family:Inter; font-weight:700; color: rgb(65,72,51); text-decoration:none; }
        .user-area { margin-left:auto; display:flex; align-items:center; gap:10px; }
        .section-top { background-color: rgb(101, 109, 74); padding: 40px; color: rgb(194,197,170); }
        .container { padding: 24px; max-width: 1000px; margin: 0 auto; }
        .btn-adicionar { background-color:#44633F; color:#F5F0DC; padding:10px 16px; border-radius:8px; border:none; cursor:pointer; }
        .post-card { background: rgb(220, 218, 190); border-radius:16px; padding:15px; display:flex; gap:12px; margin-bottom:14px; align-items:flex-start; }
        .post-card img { width:40px;height:40px;border-radius:50%; object-fit:cover; border:2px solid #555; }
        .form-post { background: rgb(220, 218, 190); padding:20px; border-radius:20px; max-width:700px; margin: 16px 0; display:none; flex-direction:column; gap:10px; }
        .form-post textarea { width:100%; height:160px; resize:none; font-size:16px; padding:8px; border-radius:8px; border:1px solid #ccc; }
        .form-post input[type="text"] { width:100%; padding:8px; border-radius:8px; border:1px solid #ccc; font-size:16px; }
        .form-post input[type="submit"] { background:#28a745; color:#fff; padding:10px 14px; border-radius:12px; border:none; cursor:pointer; align-self:flex-end; }
        .ver-todos { display:inline-block; margin-top:12px; background:#DCDABE; color:#414833; padding:8px 14px; border-radius:10px; text-decoration:none; }
    </style>
</head>
<body>
    <!-- cabeçalho -->
    <header>
        <a href="index.php"><img src="../images/trash.png" alt="Logo"></a>
        <div><h1 style="font-family: Inter; color: rgb(65, 72, 51); margin:0;">TrashTracker</h1></div>
        <nav style="margin-left:20px;">
            <a href="index.php">INÍCIO</a>
            <a href="sobre.php">SOBRE</a>
            <a href="porque.php">PORQUE NÓS?</a>
            <a href="dashboard.php">DASHBOARD</a>
            <a href="forum.php">FÓRUM</a>
        </nav>

        <div class="user-area">
            <?php if (!empty($_SESSION['avatar'])): ?>
                <img src="avatares/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar">
            <?php else: ?>
                <img src="avatares/avatar1.png" alt="Avatar padrão">
            <?php endif; ?>

            <span>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span>
            <a href="logout.php"><button style="padding:8px 12px; border-radius:8px; margin-left:8px;">Sair</button></a>
        </div>
    </header>

    <!-- seção principal -->
    <section class="section-top">
        <div class="container">
            <h2 style="margin:0; font-family:Inter; color: rgb(194, 197, 170);">FÓRUM</h2>
            <p style="font-family:Inter; color: rgb(194,197,170); margin-top:8px;">
                Bem-vindo ao fórum! Aqui você pode enviar comentários e interagir com outros usuários.
            </p>
        </div>
    </section>

    <main class="container">
        <!-- botão que mostra/esconde o formulário -->
        <div style="display:flex; gap:12px; align-items:center; margin-bottom:12px;">
            <button id="btn-adicionar" class="btn-adicionar">+ Adicionar postagem</button>
            <a class="ver-todos" href="index.php">Voltar</a>
        </div>

        <!-- formulário (inicialmente escondido) -->
        <form id="form-post" class="form-post" method="post" action="processa_post.php">
            <label for="title" style="font-weight:700; color:#414833;">Título da postagem</label>
            <input type="text" id="title" name="title" required>

            <label for="conteudo" style="font-weight:700; color:#414833;">Conteúdo</label>
            <textarea id="conteudo" name="conteudo" required></textarea>

            <!-- autor preenchido automaticamente (campo oculto) -->
            <input type="hidden" name="autor" value="<?php echo htmlspecialchars($_SESSION['usuario']); ?>">

            <input type="submit" value="Enviar">
        </form>

        <!-- lista de posts -->
        <section>
            <?php
            // Recupera todos os posts do fórum (mais recentes primeiro)
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
                    <div>
                        <h3 style="margin:0 0 6px 0; color:#414833;"><?php echo htmlspecialchars($row['titulo']); ?></h3>
                        <p style="margin:0 0 8px 0; color:#333;"><?php echo nl2br(htmlspecialchars($row['conteudo'])); ?></p>
                        <small style="color:#555;"><?php echo htmlspecialchars($row['autor']); ?> — <?php echo date('d/m/Y H:i', strtotime($row['data_criacao'])); ?></small>
                    </div>
                </article>
            <?php
                endwhile;
            else:
                echo "<p style='color:#F5F0DC;'>Ainda não há comentários.</p>";
            endif;
            ?>
        </section>
    </main>

    <script>
    // Mostrar/esconder formulário de postagem
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('btn-adicionar');
        const form = document.getElementById('form-post');

        btn.addEventListener('click', () => {
            if (form.style.display === 'flex' || form.style.display === 'block') {
                form.style.display = 'none';
                btn.textContent = '+ Adicionar postagem';
            } else {
                form.style.display = 'flex';
                btn.textContent = 'Cancelar';
                // rola a página até o formulário (opcional)
                form.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    });
    </script>
</body>
</html>
