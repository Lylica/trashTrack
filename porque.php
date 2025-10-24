<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de informações "porque nós?" do site TrashTracker</title>
    <meta name="description" content="Página de informações 'porque nós?' do site TrashTracker, usado para disponibilização das informações acerca dos diferenciais e alguns retornos visiveis">
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
    <meta property="og:description" content="Página de informações 'porque nós?' do site TrashTracker, usado para disponibilização das informações acerca dos diferenciais e alguns retornos visiveis">
    <meta property="og:image" content="images/icone.png">
    <meta property="og:url" content="https://srv1074333.hstgr.cloud">

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

    <!-- primeira seção -->
    <section class="section-main">
        <div>
            <h1>Porque nós?</h1>
            <p>A TrashTracker é a melhor escolha quando se trata de monitoramento de lixo. Somos diferentes do mercado convencional,
                porque temos como foco nós conectar com as empresas e prefeituras, mas também com o dia a dia da
                população. Viemos para ajudar você a economizar tempo!</p>
        </div>
    </section>

    <!-- caixa diferenciais-->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 20px; ">
        <h1 id="diferenciais">Diferenciais</h1>
        <div class="cards-container">
            <!--diferenciais-->
            <div class="card">
                <div class="card-texto">
                    <h3 style="text-align: center;">TÓPICO</h3>
                    <p style="margin-top: 15px; color: #C2C5AA;">Diferencial 1</p>
                    <p style="margin-top: 15px; color: #C2C5AA;">Diferencial 1</p>
                    <p style="margin-top: 15px; color: #C2C5AA;">Diferencial 1</p>
                    <p style="margin-top: 15px; color: #C2C5AA;">Diferencial 1</p>
                    
                    <h3 style="text-align: center;">NÓS</h3>
                    <!-- diferencial 1 -->
                    <div>
                        <picture>
                            <source type="image/webp" srcset="images/check.webp">
                            <img id="lata-lixo" src="images/check.jpg" alt="Logo" style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                    </div>
                    <!-- diferencial 2 -->
                    <div>
                        <picture>
                            <source type="image/webp" srcset="images/check.webp">
                            <img id="lata-lixo" src="images/check.jpg" alt="Logo" style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                    </div>
                    <!-- diferencial 3 -->
                    <div>
                        <picture>
                            <source type="image/webp" srcset="images/check.webp">
                            <img id="lata-lixo" src="images/check.jpg" alt="Logo" style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                    </div>
                    <!-- diferencial 4 -->
                    <div>
                        <picture>
                            <source type="image/webp" srcset="images/check.webp">
                            <img id="lata-lixo" src="images/check.jpg" alt="Logo" style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                    </div>
                
                    <!-- concorrentes -->
                    <h3 style="text-align: center;">CONCORRENTES</h3>
                    <!-- diferencial 1 -->
                    <div>
                        <picture>
                            <source type="image/webp" srcset="images/X.webp">
                            <img id="lata-lixo" src="images/X.jpg" alt="Logo" style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                    </div>
                    <!-- diferencial 2 -->
                    <div>
                        <picture>
                            <source type="image/webp" srcset="images/x.webp">
                            <img id="lata-lixo" src="images/x.jpg" alt="Logo" style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                    </div>
                    <!-- diferencial 3 -->
                    <div>
                        <picture>
                            <source type="image/webp" srcset="images/x.webp">
                            <img id="lata-lixo" src="images/x.jpg" alt="Logo" style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                    </div>
                    <!-- diferencial 4 -->
                    <div>
                        <picture>
                            <source type="image/webp" srcset="images/x.webp">
                            <img id="lata-lixo" src="images/x.jpg" alt="Logo" style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;">
                        </picture>
                    </div>
                </div>
            </div>
    </section>

    <!--dados-->
    <section id="section-dados">
        <h1>Dados</h1>
        <div class="dados-container">
            <!--dado 1-->
            <div class="dado-item co2">
                <div class="dado-texto">
                    <details>
                    <summary style="font-family: inter; font-weight: bold; color: #C2C5AA;">MENOS CO2 DISSIPADO</summary>
                    <p style="margin-top: 15px; color: #C2C5AA;">Nosso impacto ambiental é real e mensurável. Com o TrashTracker, 
                        estimamos uma redução de aproximadamente 1 tonelada de CO₂ a menos no meio ambiente por mês por caminhão. 
                        Isso significa um ar mais limpo para todos e um passo significativo para cidades mais verdes e sustentáveis, 
                        combatendo ativamente as mudanças climáticas.</p>
                    </details>
                </div>
            </div>
            <!--dado 2-->
            <div class="dado-item combustivel">
                <div class="dado-texto">
                    <details>
                    <summary style="font-family: inter; font-weight: bold; color: #C2C5AA;">MAIS ECONOMIA DE COMBUSTÍVEL</summary>
                    <p style="margin-top: 15px; color: #C2C5AA;">A eficiência do TrashTracker se traduz diretamente em economia. 
                        Ao otimizar as rotas de coleta, evitamos viagens desnecessárias, 
                        resultando em uma poupança estimada de cerca de 375 litros de combustível por mês por caminhão. 
                        Essa economia é um alívio para o orçamento municipal e um testemunho da inteligência aplicada à gestão de resíduos.</p>
                    </details>
                </div>
            </div>
            <!--dado 3-->
            <div class="dado-item rotas">
                <div class="dado-texto">
                    <details>
                    <summary style="font-family: inter; font-weight: bold; color: #C2C5AA;">ROTAS MENORES</summary>
                    <p style="margin-top: 15px; color: #C2C5AA;">Chega de rotas longas e improdutivas! Com o monitoramento inteligente, 
                        nossos caminhões percorrem caminhos significativamente mais curtos. 
                        Calculamos que isso representa aproximadamente 936 quilômetros a menos nas rotas de coleta por mês por caminhão. 
                        Menos quilômetros rodados significam menos desgaste veicular, mais tempo para outras tarefas e, claro, 
                        um impacto positivo direto no meio ambiente.</p>
                    </details>
                </div>    
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
                <a href="mailto:aylla.aoliveira@gmail.com">Email</a> 
        </div>
        <!--Integrantes-->
        <div> 
            <h3 style="color: black;">Páginas</h3>
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