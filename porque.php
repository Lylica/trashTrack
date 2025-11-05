<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de informações "por que nós?" do site TrashTracker</title>
    <meta name="description"
        content="Página de informações 'porque nós?' do site TrashTracker, usado para disponibilização das informações acerca dos diferenciais e alguns retornos visiveis">
    <link rel="stylesheet" href="css/porque.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- Media query -->
    <link rel="stylesheet" media="screen and (min-width: 480px) and (max-width: 960px)" href="css/porque.css" />

    <!-- Meta Tags das redes sociais -->
    <meta property="og:title" content="Página de informações 'porque nós?' do site TrashTracker">
    <meta property="og:description"
        content="Página de informações 'porque nós?' do site TrashTracker, usado para disponibilização das informações acerca dos diferenciais e alguns retornos visiveis">
    <meta property="og:image" content="images/icone.png">
    <meta property="og:url" content="https://srv1074333.hstgr.cloud">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />

    <!-- Google Analytics-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B7BYK41L1B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
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
                <button class="botao-header">POR QUE NÓS?</button>
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

    <!-- primeira seção -->
    <section class="section-main">
        <div>
            <h1 style="margin-bottom: 30px">Por que nós?</h1>
            <p>A TrashTracker é a melhor escolha quando se trata de monitoramento de lixo. Somos diferentes do mercado
                convencional,
                porque temos como foco nós conectar com as empresas e prefeituras, mas também com o dia a dia da
                população. Viemos para ajudar você a economizar tempo! <br> <br>

                Nossa solução é diferente porque pensa tanto em você cidadão, quanto nos órgãos governamentais.
                Nosso site tem dois tipos de visualização, a comum para <strong>você cidadão</strong> e outro para
                <strong>você prefeitura/governo</strong>. Assim o cidadão pode ter acesso a lixeira vazia mais perto na
                palma da mão
                e os órgãos governamentais a dados estratégicos. Além do nosso fórum aberto, que tem o intuito de
                receber sugestões,
                críticas e depoimentos, tudo para trazer a melhor solução. <br> <br>

                Abaixo você pode ler um pouco melhor sobre os nossos diferenciais e sobre alguns números que o projeto
                visa trazer,
                sempre pensando em sustentabilidade.
            </p>
        </div>
    </section>

    <section class="section-main">
        <div>
            <picture>
                <source type="image/webp" srcset="images/ods-11.webp">
                <img src="images/ods-11.jpg" alt="ods-11">
            </picture>
        </div>
        <div>
            <picture>
                <source type="image/webp" srcset="images/ods-12.webp">
                <img src="images/ods-12.jpg" alt="ods-12">
            </picture>
        </div>
    </section>

    <!-- caixa diferenciais-->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 20px; ">
        <h1 id="diferenciais">Diferenciais</h1>
        <div class="cards-container">
            <!--diferenciais-->
            <div class="card">
                <div class="card-texto tabela-comparativa">
                    <h3 class="tabela-header" style="text-align: left;">TÓPICO</h3>
                    <h3 class="tabela-header">NÓS</h3>
                    <h3 class="tabela-header">CONCORRENTES</h3>

                    <p style="font-family: 'Inter', sans-serif; font-size: 1.1rem; color: #C2C5AA; text-align: left;">
                    Dashboard público</p>

                    <div class="tabela-check">
                        <picture>
                            <source type="image/webp" srcset="images/check.webp">
                            <img src="images/check.jpg" alt="Sim">
                        </picture>
                    </div>
                    <div class="tabela-x">
                        <picture>
                            <source type="image/webp" srcset="images/x.webp">
                            <img src="images/x.jpg" alt="Não">
                        </picture>
                    </div>

                    <p style="font-family: 'Inter', sans-serif; font-size: 1.1rem; color: #C2C5AA; text-align: left;">
                    Custo benefício</p>
                    <div class="tabela-check">
                        <picture>
                            <source type="image/webp" srcset="images/check.webp">
                            <img src="images/check.jpg" alt="Sim">
                        </picture>
                    </div>
                    <div class="tabela-x">
                        <picture>
                            <source type="image/webp" srcset="images/x.webp">
                            <img src="images/x.jpg" alt="Não">
                        </picture>
                    </div>

                    <p style="font-family: 'Inter', sans-serif; font-size: 1.1rem; color: #C2C5AA; text-align: left;">
                    Fórum aberto</p>
                    <div class="tabela-check">
                        <picture>
                            <source type="image/webp" srcset="images/check.webp">
                            <img src="images/check.jpg" alt="Sim">
                        </picture>
                    </div>
                    <div class="tabela-x">
                        <picture>
                            <source type="image/webp" srcset="images/x.webp">
                            <img src="images/x.jpg" alt="Não">
                        </picture>
                    </div>
                </div>
            </div>
    </section>

    <!--dados-->
    <section id="section-dados">
        <h1 style="margin-bottom: 30px">Dados</h1>
        <div class="dados-container">
            <!--dado 1-->
            <div class="dado-item co2">
                <div class="dado-texto">
                    <details>
                        <summary style="font-family: inter; font-weight: bold; color: #C2C5AA;">MENOS CO2 DISSIPADO
                        </summary>
                        <p style="margin-top: 15px; color: #C2C5AA;">Com o TrashTracker,
                            estimamos uma redução de cerca de 1 tonelada de CO₂ a menos gerada por mês por caminhão,
                            contribuindo para a menor geração de gases poluentes para o meio ambiente.</p>
                    </details>
                </div>
            </div>
            <!--dado 2-->
            <div class="dado-item combustivel">
                <div class="dado-texto">
                    <details>
                        <summary style="font-family: inter; font-weight: bold; color: #C2C5AA;">MAIS ECONOMIA DE
                            COMBUSTÍVEL</summary>
                        <p style="margin-top: 15px; color: #C2C5AA;"> Com o nosso sistema inteligente de rotas,
                            poupamos cerca de 375 litros de combustível por mês por caminhão.
                            Além de representar um gasto a menos para a cidade,
                            essa economia também contribui para a redução da geração de gases poluentes.
                    </details>
                </div>
            </div>
            <!--dado 3-->
            <div class="dado-item rotas">
                <div class="dado-texto">
                    <details>
                        <summary style="font-family: inter; font-weight: bold; color: #C2C5AA;">ROTAS MENORES</summary>
                        <p style="margin-top: 15px; color: #C2C5AA;">O nosso sistema de rotas inteligentes contribui
                            para a otimização da coleta, focando em pontos específicos nos quais as lixeiras estão mais
                            cheias,
                            e impacta diretamente na economia de combustível e na redução dessas emissões.</p>
                    </details>
                </div>
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