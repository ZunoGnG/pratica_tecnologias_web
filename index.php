<?php
    session_start();
    if(isset($_SESSION['idUser']) && $_SESSION['idUser'] !== ""){
        header('Location: perfil.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <header>
        <div class="logoContainer">
            <img src="imgs/Logo_menor.png" alt="Logo">
            <p>Stock Hub</p>
        </div>
        <nav>
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="cadastro.php">Cadastro</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Stock Hub</h1>
        <h2>Faça o controle de estoque da sua empresa</h2>
        <div class="containterImgCentral">
            <img src="imgs/Logo.png" alt="Imagem de fundo">
        </div>
    </main>
    <footer>
        <div class="containerExternalLinks">
            <ul><a href="sobreNos.php">Sobre nos</a></ul>
        </div>
        <div class="containerCopyRight">
            <p><span>&copy;Stock Hub</span></p>
        </div>
    </footer>
    <script src="Scripts/index.js"></script>
</body>

</html>