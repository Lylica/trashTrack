<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porque nós? - TrashTracker</title>
    <link rel="stylesheet" href="../css/porque.css">
</head>

<body>
    <!-- cabeçalho -->
    <header class="header-admin">
        <a href="index.php">
            <img src="../images/trash.png" alt="Logo" class="logo">
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
            <?php if(!empty($_SESSION['usuario'])): ?>
            <img src="../php/avatares/<?php echo htmlspecialchars($_SESSION['avatar'] ?? 'avatar1.png'); ?>"
                alt="Avatar" class="avatar">
            <span>Olá,
                <?php echo htmlspecialchars($_SESSION['usuario']); ?>!
            </span>
            <?php else: ?>
            <a href="login.php"><button>Login</button></a>
            <?php endif; ?>
        </div>
    </header>

    <!-- primeira seção -->
    <section class="section-main">
        <div>
            <h1>Porque nós?</h1>
            <p>A TrashTracker é a melhor escolha quando se trata de monitoramento de lixo. Somos diferentes do mercado convencional,
                porque temos como foco nós conectar com as empresas e prefeituras, mas também com o dia a dia da
                população. Viemos para ajudar você a economizar tempo!</p>
        </div>
    </section>

    <!--diferenciais-->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 20px; ">
        <h1 id="diferenciais">Diferenciais</h1>
        <div class="cards-container">
            <!--diferencial 1-->
            <div class="card">
                <div class="card-texto">
                    <h3>
                    Acesso ao nível de lixo</h3>
                    <p >
                    Acesso a % de lixo de qualquer lixeira próxima a você, independente de onde você esteja!</p>
                 </div>
                 <div class="card-imagem-textura"></div>
             </div>
            <!--diferencial 2-->
            <div class="card">
                <div class="card-texto">
                <h3>Dados estratégicos</h3>
                <p> Dados estratégicos para que empresas e órgãos governamentais tenham mais produtividade na coleta!</p>
                </div>
                <div class="card-imagem-textura"></div>
            </div>
            <!--diferencial 3-->
            <div class="card">
                <div class="card-texto">
                <h3>Forúm</h3>
                <p>No forúm você pode deixar sugestões de melhorias, feedbacks e interagir com a comunidade!</p>
                </div>
                <div class="card-imagem-textura"></div>
            </div>
    </section>

    <!--dados-->
    <section id="section-dados">
        <h1>Dados</h1>
        <div class="dados-container">
            <!--dado 1-->
            <div class="dado-item co2">
                <div class="dado-texto">
                    <h3>MENOS CO2 DISSIPADO</h3>
                    <p>
                    Cerca de 1 tonelada de CO2 a menos no meio ambiente!</p>
                </div>
            </div>
            <!--dado 2-->
            <div class="dado-item combustivel">
                <div class="dado-texto">
                    <h3>MAIS ECONOMIA DE COMBUSTÍVEL</h3>
                    <p>
                    Cerca de 375 litros de combustível economizados por mês! </p>
                </div>
            </div>
            <!--dado 3-->
            <div class="dado-item rotas">
                <div class="dado-texto">
                    <h3>ROTAS MENORES</h3>
                    <p>Cerca de 936 quilometros a menos nas rotas da coleta!</p>
                </div>    
            </div>
        </div>
    </section>

    <!--rodapé-->
    <footer class="footer">
        <img src="../images/trash.png">
        <h2>TrashTracker - Todos os direitos reservados ℗ </h2>
    </footer>

</body>

</html>