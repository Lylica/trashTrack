<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - TrashTracker</title>
    <link rel="stylesheet" href="../css/forum.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
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

    <!-- seção principal -->
    <section class="section-main">
        <div>
            <h1 class="sobre-tt">Sobre o TrashTracker</h1>
            <p style="font-family: Inter; color: rgb(194, 197, 170); font-weight: 500; font-size: 20px;">O TrashTracker
                surgiu como uma projeto para que a população pudesse ter acesso ao nível das lixeiras próximas a suas
                casas e acabou se tornando um projeto ainda maior. Nosso objetivo é de diminuir o tempo que se gasta
                procurando uma lixeira com uma visualização simples e prática, além de diminuir a poluição e o gasto de
                combustível. <br><br>
                Queremos ser a mudança no seu dia a dia!
            </p>
        </div>
    </section>

    <!-- motivações-->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 40px;">
        <h1 style="font-family: Inter; color: rgb(194, 197, 170)">Motivações</h1>
        <!--motivações 1-->
        <div
            style="background: rgb(220, 218, 190); height: 100px; width: auto; padding: 5px; margin-bottom: 15px; border-radius: 20px;">
            <p style="font-family: Inter; padding: 2px; margin-left: auto; font-weight: bold;">Menos lixo nas ruas</p>
            <p style="font-family: Inter; margin-left: auto; margin-bottom: auto;">Diminuir o lixo nas ruas é uma das
                nossas motivações para a criação desse projeto!</p>
        </div>
        <!--motivações 2-->
        <div
            style="background: rgb(220, 218, 190); height: 100px; width: auto; padding: 5px; margin-bottom: 15px; border-radius: 20px;">
            <p style="font-family: Inter; padding: 2px; margin-left: auto; font-weight: bold;">Menos tempo perdido</p>
            <p style="font-family: Inter; margin-left: auto; margin-bottom: auto;">Tempo perdido procurando uma lixeira
                vazia para descartar seu lixo? Viemos para acabar com isso!</p>
        </div>
        <!--motivações 3-->
        <div
            style="background: rgb(220, 218, 190); height: 100px; width: auto; padding: 5px; margin-bottom: 15px; border-radius: 20px;">
            <p style="font-family: Inter; padding: 2px; margin-left: auto; font-weight: bold;">Mais participação da
                população</p>
            <p style="font-family: Inter; margin-left: auto; margin-bottom: auto;">Ouvir as sugestões e críticas da
                população para melhorar cada vez mais é um dos nossos princípios!</p>
        </div>
    </section>

    <!--colaboradores-->
    <section style="background-color: rgb(101, 109, 74); height: auto; width: auto; padding: 40px;">
        <h1 style="font-family: Inter; color: rgb(194, 197, 170)">Colaboradores</h1>
        <!--Colaborador 1-->
        <div>
            <img style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
                src="../images/trash.png">
            <h2 style="font-family: Inter; color: rgb(194, 197, 170)">Aylla Alves</h2>
            <p style="font-family: Inter; color: rgb(0, 0, 0)">Estudante de engenharia da computação do segundo
                semestre.</p>
            <a href="https://www.linkedin.com/in/aylla-alves-206629251/">
                <img style="height: 25px; width: 25px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
                    src="../images/linkedin.png">
                <p>Linkedin</p>
            </a>
        </div>
        <!--Colaborador 2-->
        <div>
            <img style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
                src="../images/trash.png">
            <h2 style="font-family: Inter; color: rgb(194, 197, 170)">Bianca Vidal</h2>
            <p style="font-family: Inter; color: rgb(0, 0, 0)">Estudante de engenharia da computação do segundo
                semestre.</p>
            <a href="https://www.linkedin.com/in/bividal/">
                <img style="height: 25px; width: 25px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
                    src="../images/linkedin.png">
                <p>Linkedin</p>
            </a>
        </div>
        <!--Colaborador 3-->
        <div>
            <img style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
                src="../images/trash.png">
            <h2 style="font-family: Inter; color: rgb(194, 197, 170)">Clara Rondello</h2>
            <p style="font-family: Inter; color: rgb(0, 0, 0)">Estudante de engenharia mecatrônica do segundo semestre.
            </p>
            <a href="https://www.linkedin.com/in/clara-rondello/">
                <img style="height: 25px; width: 25px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
                    src="../images/linkedin.png">
                <p>Linkedin</p>
            </a>
        </div>
        <!--Colaborador 4-->
        <div>
            <img style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
                src="../images/trash.png">
            <h2 style="font-family: Inter; color: rgb(194, 197, 170)">Leticia Lopes</h2>
            <p style="font-family: Inter; color: rgb(0, 0, 0)">Estudante de engenharia da computação do segundo
                semestre.</p>
            <a href="https://www.linkedin.com/in/leticia-malagola-lopes/">
                <img style="height: 25px; width: 25px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
                    src="../images/linkedin.png">
                <p>Linkedin</p>
            </a>
        </div>
        <!--Colaborador 5-->
        <div>
            <img style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
                src="../images/trash.png">
            <h2 style="font-family: Inter; color: rgb(194, 197, 170)">Murilo Cortez</h2>
            <p style="font-family: Inter; color: rgb(0, 0, 0)">Estudante de engenharia da computação do segundo
                semestre.</p>
            <a href="https://www.linkedin.com/in/murilo-cortez-092673351/">
                <img style="height: 25px; width: 25px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
                    src="../images/linkedin.png">
                <p>Linkedin</p>
            </a>
        </div>
        <!--Colaborador 6-->
        <div>
            <img style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
                src="../images/trash.png">
            <h2 style="font-family: Inter; color: rgb(194, 197, 170)">Pedro Dias</h2>
            <p style="font-family: Inter; color: rgb(0, 0, 0)">Estudante de engenharia da computação do segundo
                semestre.</p>
            <a href="https://www.linkedin.com/in/phsdias/">
                <img style="height: 25px; width: 25px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
                    src="../images/linkedin.png">
                <p>Linkedin</p>
            </a>
        </div>
        <!--Colaborador 7-->
        <div>
            <img style="height: 30px; width: 30px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
                src="../images/trash.png">
            <h2 style="font-family: Inter; color: rgb(194, 197, 170)">Yasmin Souza</h2>
            <p style="font-family: Inter; color: rgb(0, 0, 0)">Estudante de engenharia da computação do segundo
                semestre.</p>
            <a href="https://www.linkedin.com/in/yasmin-souza-santos-/">
                <img style="height: 25px; width: 25px; margin-top: 20px; margin-right: 10px; margin-left: auto;"
                    src="../images/linkedin.png">
                <p>Linkedin</p>
            </a>
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