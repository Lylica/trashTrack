<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de informações "sobre" do site TrashTracker</title>
    <meta name="description" content="Página de informações 'sobre' do site TrashTracker, usado para disponibilização das informações acerca das motivações e mostrar um pouco sobre os colaboradores">
    <link rel="stylesheet" href="css/sobre.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet">

    <!-- Media query -->
    <link rel="stylesheet" media="screen and (min-width: 480px) and (max-width: 960px)" href="css/sobre.css" />
    
    <!-- Meta Tags das redes sociais -->
    <meta property="og:title" content="Página de informações 'sobre' do site TrashTracker">
    <meta property="og:description" content="Página de informações 'sobre' do site TrashTracker, usado para disponibilização das informações acerca das motivações e mostrar um pouco sobre os colaboradores">
    <meta property="og:image" content="images/icone.png">
    <meta property="og:url" content="https://srv1074333.hstgr.cloud/">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />

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

    <!-- seção principal -->
    <section class="section-main">
        <div>
            <h1 class="sobre-tt">Sobre o TrashTracker</h1>
            <p>O TrashTracker
                surgiu como uma projeto para que a população pudesse ter acesso ao nível das lixeiras próximas a suas
                casas e acabou se tornando um projeto ainda maior. Nosso objetivo é de diminuir o tempo que se gasta
                procurando uma lixeira com uma visualização simples e prática, além de diminuir a poluição e o gasto de
                combustível. <br><br>
                Queremos ser a mudança no seu dia a dia!
            </p>
        </div>
    </section>

    <!-- motivações-->
    <section id="section-motivações" >
        <h1>Motivações</h1>
        <!--motivações 1-->
        <div class="motivacao-item menos-lixo">
            <div class="motivacao-texto">
            <h3>Menos lixo nas ruas</h3>
            <p>Diminuir o lixo nas ruas é uma das
                nossas motivações para a criação desse projeto!</p>
            </div>    
        </div>
        <!--motivações 2-->
        <div class="motivacao-item menos-tempo">
            <div class="motivacao-texto">
            <h3>Menos tempo perdido</h3>
            <p>Tempo perdido procurando uma lixeira
                vazia para descartar seu lixo? Viemos para acabar com isso!</p>
            </div>
        </div>
        <!--motivações 3-->
        <div class="motivacao-item participacao">
            <div class="motivacao-texto">
            <h3>Mais participação da população</h3>
            <p>Ouvir as sugestões e críticas da população para melhorar cada vez mais é um dos nossos princípios!</p>
            </div>
        </div>    
    </section>

    <!--colaboradores-->
    <section id="colaboradores-section">
        <h1 style="font-family: Inter; color: rgb(194, 197, 170)">Colaboradores</h1>
        <!--Colaborador 1-->
        <div class="colaboradores-container">
            <div class="colaborador-card">
                <div class="nome-container">
                    <picture>
                        <source type="image/webp" srcset="images/trash.webp">
                        <img src="images/trash.jpg" alt="Logo">
                    </picture>
                    <h2>Aylla Alves</h2>
                </div>    
                    <p class="bio">Estudante de engenharia da computação do segundo
                    semestre.</p>
                    <a href="https://www.linkedin.com/in/aylla-alves-206629251/">
                        <picture>
                            <source type="image/webp" srcset="images/linkedin.webp">
                            <img id="lata-lixo" src="images/linkedin.jpg" alt="Logo" style="height: 25px; width: 25px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                        <span class="linkedin-link">Linkedin</span>
                    </a>
            </div>
        
        <!--Colaborador 2-->
            <div class="colaborador-card">
                <div class="nome-container">
                    <picture>
                        <source type="image/webp" srcset="images/trash.webp">
                        <img src="images/trash.jpg" alt="Logo">
                    </picture>
                    <h2>Bianca Vidal</h2>
                </div>    
                    <p class="bio">Estudante de engenharia da computação do segundo
                    semestre.</p>
                    <a href="https://www.linkedin.com/in/bividal/">
                        <picture>
                            <source type="image/webp" srcset="images/linkedin.webp">
                            <img id="lata-lixo" src="images/linkedin.jpg" alt="Logo" style="height: 25px; width: 25px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                    <span class="linkedin-link">Linkedin</span>
                    </a>
            </div>
        <!--Colaborador 3-->
            <div class="colaborador-card">
                <div class="nome-container">
                    <picture>
                        <source type="image/webp" srcset="images/trash.webp">
                        <img src="images/trash.jpg" alt="Logo">
                    </picture>
                    <h2>Clara Rondello</h2>
                </div>     
                    <p class="bio">Estudante de engenharia mecatrônica do segundo semestre.</p>
                    <a href="https://www.linkedin.com/in/clara-rondello/">
                        <picture>
                            <source type="image/webp" srcset="images/linkedin.webp">
                            <img id="lata-lixo" src="images/linkedin.jpg" alt="Logo" style="height: 25px; width: 25px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                    <span class="linkedin-link">Linkedin</span>
                    </a>
            </div>
        <!--Colaborador 4-->
            <div class="colaborador-card">
                <div class="nome-container">
                    <picture>
                        <source type="image/webp" srcset="images/trash.webp">
                        <img src="images/trash.jpg" alt="Logo">
                    </picture>
                    <h2>Letícia Lopes</h2>
                </div>    
                    <p class="bio">Estudante de engenharia da computação do segundo
                    semestre.</p>
                    <a href="https://www.linkedin.com/in/leticia-malagola-lopes/">
                        <picture>
                            <source type="image/webp" srcset="images/linkedin.webp">
                            <img id="lata-lixo" src="images/linkedin.jpg" alt="Logo" style="height: 25px; width: 25px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                    <span class="linkedin-link">Linkedin</span>
                    </a>
            </div>
        <!--Colaborador 5-->
            <div class="colaborador-card">
                <div class="nome-container">
                    <picture>
                        <source type="image/webp" srcset="images/trash.webp">
                        <img src="images/trash.jpg" alt="Logo">
                    </picture>
                    <h2>Murilo Cortez</h2>
                </div>
                    <p class="bio">Estudante de engenharia da computação do segundo
                    semestre.</p>
                    <a href="https://www.linkedin.com/in/murilo-cortez-092673351/">
                        <picture>
                            <source type="image/webp" srcset="images/linkedin.webp">
                            <img id="lata-lixo" src="images/linkedin.jpg" alt="Logo" style="height: 25px; width: 25px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                    <span class="linkedin-link">Linkedin</span>
                    </a>
            </div>
        <!--Colaborador 6-->
            <div class="colaborador-card">
                <div class="nome-container">
                    <picture>
                        <source type="image/webp" srcset="images/trash.webp">
                        <img src="images/trash.jpg" alt="Logo">
                    </picture>
                    <h2>Pedro Dias</h2>
                </div>
                    <p class="bio">Estudante de engenharia da computação do segundo
                    semestre.</p>
                    <a href="https://www.linkedin.com/in/phsdias/">
                        <picture>
                            <source type="image/webp" srcset="images/linkedin.webp">
                            <img id="lata-lixo" src="images/linkedin.jpg" alt="Logo" style="height: 25px; width: 25px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                    <span class="linkedin-link">Linkedin</span>
                    </a>
            </div>
        <!--Colaborador 7-->
            <div class="colaborador-card">
                <div class="nome-container">
                    <picture>
                        <source type="image/webp" srcset="images/trash.webp">
                        <img src="images/trash.jpg" alt="Logo">
                    </picture>
                    <h2>Yasmin Souza</h2>
                </div>    
                    <p class="bio">Estudante de engenharia da computação do segundo
                    semestre.</p>
                    <a href="https://www.linkedin.com/in/yasmin-souza-santos-/">
                        <picture>
                            <source type="image/webp" srcset="images/linkedin.webp">
                            <img id="lata-lixo" src="images/linkedin.jpg" alt="Logo" style="height: 25px; width: 25px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                    <span class="linkedin-link">Linkedin</span>
                    </a>
            </div>
        </div>    
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

</body>

</html>