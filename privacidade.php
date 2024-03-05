<?php
    session_start();
    if(isset($_SESSION['idUser']) && $_SESSION['idUser'] === ""){
        header('Location: index.php');
    }
    include 'Class/Privacidade.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="CSS/privacidade.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>
<body id="body">
    <div id="containerDeleteMessage" style="display: none;">
        <div class="containerDeleteMessage">
            <p>Sua conta foi deletada com sucesso!</p>
            <input type="button" value="Sair" onclick="logoutDeleteAc()">
        </div>
    </div>
    <div class="confirmMessagePage" id="confirmMessagePage" style="display: none;">
        <div class="containerInside">
            <div class="containerConfirmMessage">
                <h1 id="confirmMessage"></h1>
                <div class="buttonContainer">
                    <input type="button" value="Sim" id="yesButton">
                    <input type="button" value="Não" id="notButton">
                </div>
            </div>
        </div>
    </div>
    <header>
        <div class="logoContainer">
            <img src="imgs/Logo_menor.png" alt="Logo">
            <p>Stock Hub</p>
        </div>
        <div class="containerLogoutButton">
            <input type="button" value="Sair" onclick="logout()">
        </div>
    </header>
    <main>
        <a href="perfil.php" id="goPerfilLink">Voltar</a>
        <section class="leftContainer">
            <div class="userInfos perfilImageContainer">
                <p>Imagem do usuário:</p>
                
                <img src="<?php echo $Privacidade->imgURL;?>" alt="Imagem do usuario" id="userImage" class="images">
                <input type="button" value="Alterar imagem" onclick="showOptions('updateImageValues', 'flex')">
                <p id="updateImageMessage" style="display: none;"></p>
                <div class="updateImageValues" id="updateImageValues" style="display: none;">
                    <input type="file" accept="image/*" id="newImageInput">
                    <input type="button" value="Alterar" onclick="changeImage()">
                    <label for="newImage">Nova imagem:</label>
                    <img src="" alt="newPerfilImage" id="newImage" class="images" style="display: none;">
                </div>
            </div>
        </section>
        <section class="rightContainer">
            <div class="userInfos usernameContainer">
                <p>Nome do usuário:</p>
                <p>
                    <span>
                        <?php
                            echo $Privacidade->userInfos[0]['usuario'];
                        ?>
                    </span>
                </p>
                <input type="button" value="Alterar nome" onclick="showOptions('updateNameValues', 'flex')">
                <p id="updateNameMessage" style="display: none;"></p>
                <div class="updateNameValues" id="updateNameValues" style="display: none;">
                    <label for="newName">Novo nome:</label>
                    <input type="text" placeholder="Insira o novo nome" maxlength="255" id="newName">
                    <input type="button" value="Alterar" onclick="changeName()">
                </div>
            </div>
            <div class="userInfos passwordContainer">
                <p>Alterar senha:</p>
                <input type="button" value="Alterar senha" onclick="showOptions('updatePasswordValues', 'flex')">

                <p id="updatePasswordMessage" style="display: none;"></p>

                <div class="updatePasswordValues" id="updatePasswordValues" style="display: none;">
                    <div class="passwordValuesLine">
                        <label for="newPassword">Nova senha:</label>
                        <input type="password" placeholder="Insira a nova senha" maxlength="255" id="newPassword">
                    </div>
                    <div class="passwordValuesLine">
                        <label for="newPasswordConfirm">Confirmação de senha:</label>
                        <input type="password" placeholder="Confirme a nova senha" maxlength="255" id="newPasswordConfirm">
                    </div>
                    <input type="button" value="Alterar" onclick="changePassword()">
                </div>
            </div>
            <div class="deleteAccountContainer">
                <input type="button" value="Deletar conta" onclick="deleteAccount()">
            </div>
        </section>
    </main>
    <footer>
        <div class="containerCopyRight">
            <p><span>&copy;Stock Hub</span></p>
        </div>
    </footer>
    <script src="Scripts/privacidade.js"></script>
</body>
</html>