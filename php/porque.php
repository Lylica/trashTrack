<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de informações "porque nós?" do site TrashTracker</title>
    <meta name="description" contento="Página de informações 'porque nós?' do site TrashTracker, usado para disponibilização das informações acerca dos diferenciais e alguns retornos visiveis">
    <link rel="stylesheet" href="../css/porque.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet">

</head>

<body>
    <!-- cabeçalho -->
    <header class="header-admin">
        <!--Logo volta pro inicio-->
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
            <a href="logout.php"><button>Sair</button></a>
            <?php else: ?>
            <a href="login.php"><button id="btn-login-header">Login</button></a>
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