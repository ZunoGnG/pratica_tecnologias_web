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
    <link rel="stylesheet" href="CSS/sobreNos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <header>
        <a href="index.php" id="homeLogo">
            <div class="logoContainer">
                <img src="imgs/Logo_menor.png" alt="Logo">
                <p>Stock Hub</p>
            </div>
        </a>
        <nav>
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="cadastro.php">Cadastro</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <a href="index.php" id="homeLink">
            <img src="imgs/Icone_casa.png" alt="link início" title="Voltar ao início">
        </a>
        <h1>Stock Hub</h1>
        <h2>Sobre nos:</h2>
        <p>Somos uma empresa que fornece uma solução para sua empresa controlar o estoque de produtos.</p>
        <div class="containterImgCentral">
            <img src="imgs/Logo.png" alt="Imagem de fundo">
        </div>
    </main>
    <footer>
        <div class="containerCopyRight">
            <p><span>&copy;Stock Hub</span></p>
        </div>
    </footer>
</body>
</html>