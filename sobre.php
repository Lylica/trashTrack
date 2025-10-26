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
            <img style="width: 220px; height: 80px" id="lata-lixo" src="images/logoTT.jpg" alt="Logo">
        </picture>

        <!-- páginas -->
        <div class="nav">
                <!-- início -->
                <a href="index.php">
                    <button class="botao-header">INÍCIO</button>
                </a>
                <!-- sobre -->
                <a href="sobre.php">
                    <button class="botao-header">SOBRE</button>
                </a>
                <!-- porque nós? -->
                <a href="porque.php">
                    <button class="botao-header">PORQUE NÓS?</button>
                </a>
                <!-- dashboard -->
                <a href="dashboard.php">
                    <button class="botao-header">DASHBOARD</button>
                </a>
                <!-- forúm -->
                <a href="forum.php">
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

    <!-- seção principal -->
    <section class="section-main">
        <div>
            <h1 class="sobre-tt">Sobre o TrashTracker</h1>
            <p>O TrashTracker nasceu de um problema, lixeiras de bairro cheias, 
            gerando a necessidade de sempre gastar tempo verificando as lixeiras até encontrar uma vazia. 
            Nosso projeto tem o intuito de facilitar o dia a dia da população, 
            deixando esse tipo de dado na palma da sua mão!
            Nosso site possui diversas informações sobre o projeto como colaboradores, 
            diferenciais, demonstração de dados e dashboard. 
            Além de um fórum aberto para que a população possa deixar depoimentos, 
            sugestões e críticas. <br> <br>
            </p>
        </div>
    </section>

    <!--colaboradores-->
    <section id="colaboradores-section">
        <h1>Colaboradores</h1>
        <!--Colaborador 1-->
        <div class="colaboradores-container">
            <div class="colaborador-card">
                <div class="nome-container">
                    <!-- logo -->
                    <picture>
                        <source type="image/webp" srcset="images/trash.webp">
                        <img src="images/trash.jpg" alt="Logo">
                    </picture>
                    <h2>Aylla Alves</h2>
                </div>    
                    <!-- foto -->
                    <picture>
                        <source type="image/webp" srcset="images/icone.webp">
                        <img style="width: 150px; height: 150px; border-radius: 100px;" src="images/icone.jpg" alt="foto-aylla">
                    </picture>
                    <!-- bio -->
                    <p class="bio">Estudante de engenharia da computação do segundo
                    semestre.</p>
                    <!-- linkedin -->
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
                    <!-- logo -->
                    <picture>
                        <source type="image/webp" srcset="images/trash.webp">
                        <img src="images/trash.jpg" alt="Logo">
                    </picture>
                    <h2>Bianca Vidal</h2>
                </div>    
                    <!-- foto -->
                    <picture>
                        <source type="image/webp" srcset="images/icone.webp">
                        <img style="width: 150px; height: 150px; border-radius: 100px;" src="images/icone.jpg" alt="foto-bianca">
                    </picture>
                    <!-- bio -->
                    <p class="bio">Estudante de engenharia da computação do segundo
                    semestre.</p>
                    <!-- linkedin -->
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
                    <!-- logo -->
                    <picture>
                        <source type="image/webp" srcset="images/trash.webp">
                        <img src="images/trash.jpg" alt="Logo">
                    </picture>
                    <h2>Clara Rondello</h2>
                </div>
                    <!-- foto -->
                    <picture>
                        <source type="image/webp" srcset="images/icone.webp">
                        <img style="width: 150px; height: 150px; border-radius: 100px;" src="images/icone.jpg" alt="foto-clara">
                    </picture>
                    <!-- bio --> 
                    <p class="bio">Estudante de engenharia mecatrônica do segundo semestre.</p>
                    <!-- linkedin -->
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
                    <!-- foto -->
                    <picture>
                        <source type="image/webp" srcset="images/icone.webp">
                        <img style="width: 150px; height: 150px; border-radius: 100px;" src="images/icone.jpg" alt="foto-le-lopes">
                    </picture>
                    <!-- bio --> 
                    <p class="bio">Estudante de engenharia da computação do segundo
                    semestre.</p>
                    <!-- linkedin -->
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
                    <!-- foto -->
                    <picture>
                        <source type="image/webp" srcset="images/icone.webp">
                        <img style="width: 150px; height: 150px; border-radius: 100px;" src="images/icone.jpg" alt="foto-murilo">
                    </picture>
                    <!-- bio --> 
                    <p class="bio">Estudante de engenharia da computação do segundo
                    semestre.</p>
                    <!-- linkedin -->
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
                    <!-- foto -->
                    <picture>
                        <source type="image/webp" srcset="images/icone.webp">
                        <img style="width: 150px; height: 150px; border-radius: 100px;" src="images/icone.jpg" alt="foto-dias">
                    </picture>
                    <!-- bio --> 
                    <p class="bio">Estudante de engenharia da computação do segundo
                    semestre.</p>
                    <!-- linkedin -->
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
                    <!-- foto -->
                    <picture>
                        <source type="image/webp" srcset="images/icone.webp">
                        <img style="width: 150px; height: 150px; border-radius: 100px;" src="images/icone.jpg" alt="foto-yasmin">
                    </picture>
                    <!-- bio -->    
                    <p class="bio">Estudante de engenharia da computação do segundo
                    semestre.</p>
                    <!-- linkedin -->
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

</body>

</html>