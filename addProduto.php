<?php
    session_start();
    if(isset($_SESSION['idUser']) && $_SESSION['idUser'] === ""){
        header('Location: index.php');
    }
    include 'Class/Perfil.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="CSS/addProduto.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>

<body id="bodyContainer">
    <div class="addProductMessage" id="addProductMessage" style="display: none;">
        <div class="addContainer" id="addContainer" >
            <div class="insideContainerAdd">
                <p>Você tem certeza que quer prosseguir?</p>
                <div class="containerAddButtons">
                    <input type="button" value="Sim" id="changeConfirmationButtonYes" onclick="showYesOptionMessage()">
                    <input type="button" value="Não" id="changeConfirmationButtonNo" onclick="hideAddContainer()">
                </div>
            </div>
        </div>
        <div style="display: none;" class="containerAddMessage" id="containerAddMessage">
            <p>Produto adicionado com sucesso!</p>
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
        <div class="containerCenter">
            <div class="containerImgProduct">
                <h2>Imagem do produto:</h2>
                <div class="imageProduct">
                    <div class="containerImage" id="containerImage">
                        <input type="file" accept="image/*" id="FileInput">
                    </div>
                </div>
                <input type="button" value="Adicionar produto" id="addProductButton" onclick="addProduct()">
                <img src="" id="showImage">
                <p style="display: none;" id="addMessage"></p>
            </div>
            <div class="containerTextProduct">
                <div class="textLine">
                    <h2>Nome do produto:</h2>
                    <div class="containerName" id="containerName">
                        <input type="text" placeholder="Insira o nome do produto" maxlength="254" id="nameValue"
                            class="textInputs">
                    </div>
                </div>
                <div class="textLine">
                    <h2>Preço do produto</h2>
                    <div class="containerPrice" id="containerPrice">
                        <label for="priceValueInt">Insira o valor inteiro. (exemplo: 1, 34, 923)</label>
                        <input type="text" placeholder="Valor inteiro" maxlength="20" id="priceValueInt"
                            class="textInputs priceValueInput">

                        <label for="priceValueDec">Insira o valor decimal. (Exemplo: 02, 12, 23)</label>
                        <input type="text" placeholder="Valor decimal" maxlength="2" id="priceValueDec"
                            class="textInputs priceValueInput">

                        <p>Preço formatado: R$<span id="formattedPrice"></span></p>
                    </div>
                </div>
                <div class="textLine">
                    <h2>Descrição do produto:</h2>
                    <div class="containerDesc" id="containerDesc">
                        <textarea type="text" placeholder="Insira descrição do produto" maxlength="254" id="descValue"
                            class="textInputs" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="textLine">
                    <h2>Quantidade em estoque:</h2>
                    <div class="containerAmount" id="containerAmount">
                        <input type="text" placeholder="Insira quantidade do produto" maxlength="15" id="amountValue"
                            class="textInputs">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="containerCopyRight">
            <p><span>&copy;Stock Hub</span></p>
        </div>
    </footer>
    <script src="Scripts/addProduto.js"></script>
</body>

</html>