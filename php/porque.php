<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porque nós? - TrashTracker</title>
    <link rel="stylesheet" href="../css/forum.css">
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
            <p style="font-family: Inter; color: rgb(194, 197, 170); font-weight: 500; font-size: 20px;">A TrashTracker
                é a melhor escolha quando se trata de monitoramento de lixo. Somos diferentes do mercado convencional,
                porque temos como foco nós conectar com as empresas e prefeituras, mas também com o dia a dia da
                população. Viemos para ajudar você a economizar tempo!</p>
        </div>
    </section>

    <!--diferenciais-->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 20px; ">
        <h1 style="font-family: Inter; color: rgb(194, 197, 170); margin-left: 50px;">Diferenciais</h1>
        <div style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 40px; display: flex;">
            <!--diferencial 1-->
            <div
                style="background: rgb(220, 218, 190); height: 350px; width: 450px; padding: 10px; margin-left: 100px; border-radius: 30px;">
                <p style="font-family: Inter; padding: 5px; margin-left: auto; font-size: 25px; font-weight: bold;">
                    Acesso ao nível de lixo</p>
                <p style="font-family: Inter; margin-left: auto; padding: 5px; margin-bottom: auto; font-size: 22px;">
                    Acesso a % de lixo de qualquer lixeira próxima a você, independente de onde você esteja!</p>
            </div>
            <!--diferencial 2-->
            <div
                style="background: rgb(220, 218, 190); height: 350px; width: 450px; padding: 10px; margin-left: 100px; border-radius: 30px;">
                <p style="font-family: Inter; padding: 5px; margin-left: auto; font-size: 25px; font-weight: bold;">
                    Dados estratégicos</p>
                <p style="font-family: Inter; margin-left: auto; padding: 5px; margin-bottom: auto; font-size: 22px;">
                    Dados estratégicos para que empresas e órgãos governamentais tenham mais produtividade na coleta!
                </p>
            </div>
            <!--diferencial 3-->
            <div
                style="background: rgb(220, 218, 190); height: 350px; width: 450px; padding: 10px; margin-left: 100px; border-radius: 30px;">
                <p style="font-family: Inter; padding: 5px; margin-left: auto; font-size: 25px; font-weight: bold;">
                    Forúm</p>
                <p style="font-family: Inter; margin-left: auto; padding: 5px; margin-bottom: auto; font-size: 22px;">No
                    forúm você pode deixar sugestões de melhorias, feedbacks e interagir com a comunidade!</p>
            </div>
        </div>
    </section>

    <!--dados-->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 20px; ">
        <h1 style="font-family: Inter; color: rgb(194, 197, 170); margin-left: 50px;">Dados</h1>
        <div style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 40px; display: flex;">
            <!--dado 1-->
            <div
                style="background: rgb(220, 218, 190); height: 350px; width: 450px; padding: 10px; margin-left: 100px; border-radius: 30px;">
                <p style="font-family: Inter; padding: 5px; margin-left: auto; font-size: 25px; font-weight: bold;">
                    MENOS CO2 DISSIPADO</p>
                <p style="font-family: Inter; margin-left: auto; padding: 5px; margin-bottom: auto; font-size: 22px;">
                    Cerca de 1 tonelada de CO2 a menos no meio ambiente!</p>
            </div>
            <!--dado 2-->
            <div
                style="background: rgb(220, 218, 190); height: 350px; width: 450px; padding: 10px; margin-left: 100px; border-radius: 30px;">
                <p style="font-family: Inter; padding: 5px; margin-left: auto; font-size: 25px; font-weight: bold;">MAIS
                    ECONOMIA DE COMBUSTÍVEL</p>
                <p style="font-family: Inter; margin-left: auto; padding: 5px; margin-bottom: auto; font-size: 22px;">
                    Cerca de 375 litros de combustível economizados por mês! </p>
            </div>
            <!--dado 3-->
            <div
                style="background: rgb(220, 218, 190); height: 350px; width: 450px; padding: 10px; margin-left: 100px; border-radius: 30px;">
                <p style="font-family: Inter; padding: 5px; margin-left: auto; font-size: 25px; font-weight: bold;">
                    ROTAS MENORES</p>
                <p style="font-family: Inter; margin-left: auto; padding: 5px; margin-bottom: auto; font-size: 22px;">
                    Cerca de 936 quilometros a menos nas rotas da coleta!</p>
            </div>
        </div>
    </section>

    <!--rodapé-->
    <footer style="background-color: rgb(220, 218, 190); height: 80px; width: auto; padding: 5px;">
        <img style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
            src="../images/trash.png">
        <h2 style="font-family: Inter; color: rgb(65, 72, 51)">TrashTracker - Todos os direitos reservados ℗ </h2>
    </footer>

</body>

</html>