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
    <title>Login</title>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <header>
        <a href="index.php">
            <div class="logoContainer">
                <img src="imgs/Logo_menor.png" alt="Logo">
                <p>Stock Hub</p>
            </div>
        </a>
    </header>
    <main>
        <a href="index.php" id="homeLink">
            <img src="imgs/Icone_casa.png" alt="link início" title="Voltar ao início">
        </a>
        <h1>Entre na sua conta</h1>
        <form id="formLogin">
            <h2>Login</h2>
            <div class="formLine">
                <label for="user">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="Informe o e-mail">
            </div>
            <div class="formLine">
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" placeholder="Informe a senha">
            </div>
            <div class="containerButton">
                <input type="submit" value="Entrar">
            </div>
            <div class="externalLinksForm">
                <ul>
                    <li>
                        <a href="cadastro.php">Não tem uma conta?</a>
                    </li>
                </ul>
            </div>
        </form> 
        <div class="containerError" id="containerError" style="display: none;">
            <div class="containerInfo">
                <div class="containerText">
                    <h1><span id="errorTittle"></span></h1>
                    <p><span id="errorMessage"></span></p>
                </div>
                <div class="containerIcon">
                    <p>X</p>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="containerExternalLinks">
            <ul><a href="#">Sobre nos</a></ul>
        </div>
        <div class="containerCopyRight">
            <p><span>&copy;Stock Hub</span></p>
        </div>
    </footer>
    <script src="Scripts/login.js"></script>
</body>

</html>