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
    <title>Cadastro</title>
    <link rel="stylesheet" href="CSS/cadastro.css">
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
    <div class="containerVerify" id="containerVerify" style="display: none;">
        <div class="containerGif">
            <h1>Cadastro realizado</h1>
            <img src="imgs/verificado_sem_fundo.gif" alt="Verificação">
        </div>
    </div>

    <main>
        <a href="index.php" id="homeLink">
            <img src="imgs/Icone_casa.png" alt="link início" title="Voltar ao início">
        </a>
        <h1 id="tittleMain">Crie sua conta</h1>
        <form id="formCadastro">
            <h2>Cadastro</h2>
            <div class="formLine">
                <label for="user">Usuário:</label>
                <input type="text" name="user" id="user" minlength="5" maxlength="254" placeholder="Insira um nome de usuário">
            </div>
            <div class="formLine">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required maxlength="254" placeholder="Insira um e-mail">
            </div>
            <div class="formLine">
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" minlength="5" maxlength="254" placeholder="Informe uma senha">
            </div>
            <div class="containerButton">
                <input type="submit" value="Cadastrar-se" name="submitButton" id="submitButton">
            </div>
            <div class="externalLinksForm">
                <ul>
                    <li>
                        <a href="login.php">Já tem uma conta?</a>
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
    <script src="Scripts/cadastro.js"></script>
</body>

</html>