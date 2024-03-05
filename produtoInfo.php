<?php
    include 'Class/ProdutoInfo.php';
    session_start();
    if(isset($_SESSION['idUser']) && $_SESSION['idUser'] === ""){
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="CSS/produtoInfo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>
<body id="bodyContainer">

    <div class="removeProductMessage" id="removeProductMessage" style="display: none;">
        <div class="removeContainer" id="removeContainer" >
            <div class="insideContainerRemove">
                <p>Você tem certeza que quer excluir este produto?</p>
                <div class="containerRemoveButtons">
                    <input type="button" value="Sim" id="changeConfirmationButtonYes" onclick="showYesOptionMessage()">
                    <input type="button" value="Não" id="changeConfirmationButtonNo" onclick="hideRemoveContainer()">
                </div>
            </div>
        </div>
        <div style="display: none;" class="containerRemovedMessage" id="containerRemovedMessage">
            <p>Produto removido com sucesso!</p>
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
        <div class="removeProductButtonContainer">
            <input type="button" value="Remover produto" id="removeProductButton" onclick="removeProductMessage()">
        </div>
        <div class="containerCenter">
            <div class="containerImgProduct">
                <h2>Imagem do produto:</h2>
                <img src="<?php echo $ProdutoInfo->imgURL;?>" alt="Imagem do produto">
                <div class="editImageProduct">
                    <input type="button" value="Alterar imagem do produto" id="editImageProduct" onclick="showOptions('containerChangeImage', 'flex')">

                    <p style="display: none;" id="imageProductMessage"></p>
                    <div class="containerChangeImage" id="containerChangeImage" style="display: none;">
                        <input type="file" accept="image/*" id="changeFileInput">
                        <input type="button" value="Alterar" id="changeImageButton" onclick="changeProductImage()">
                        <p>Nova imagem:</p>
                        <img src="" alt="nova imagem" id="newImageProduct" style="display: none;">
                    </div>
                </div>
            </div>
            <div class="containerTextProduct">
                <div class="textLine">
                    <h2>Nome do produto:</h2>
                    <p><?php echo $ProdutoInfo->productInfoData[0]['nome'];?></php>
                    <input type="button" value="Editar nome" id="editNameButton" onclick="showOptions('containerChangeName', 'block')">

                    <p style="display: none;" id="nameProductMessage"></p>
                    <div class="containerChangeName" id="containerChangeName" style="display: none;">
                        <input type="text" placeholder="Insira o novo nome" maxlength="254" id="nameChangedValue" class="textInputs">
                        <input type="button" value="Alterar" id="changeNameButton" onclick="changeName()">
                    </div>
                </div>
                <div class="textLine">
                    <h2>Preço do produto</h2>
                    <p>R$ <span><?php echo $ProdutoInfo->formatedPrice;?></span></p>
                    <input type="button" value="Editar preço" id="editPriceButton" onclick="showOptions('containerChangePrice', 'flex')">

                    <p style="display: none;" id="priceProductMessage"></p>
                    <div class="containerChangePrice" id="containerChangePrice" style="display: none;">
                        <label for="priceChangedValueInt">Insira o valor inteiro. (exemplo: 1, 34, 923)</label>
                        <input type="text" placeholder="Valor inteiro" maxlength="20" id="priceChangedValueInt" class="textInputs priceValueInput">

                        <label for="priceChangedValueDec">Insira o valor decimal. (Exemplo: 02, 12, 23)</label>
                        <input type="text" placeholder="Valor decimal" maxlength="2" id="priceChangedValueDec" class="textInputs priceValueInput">
                        <input type="button" value="Alterar" id="changepriceButton" onclick="changePrice()">
                    </div>
                </div>
                <div class="textLine">
                    <h2>Descrição do produto:</h2>
                    <p><?php echo $ProdutoInfo->productInfoData[0]['descricao'];?></php>
                    <input type="button" value="Editar descrição" id="editDescButton" onclick="showOptions('containerChangeDesc', 'block')">
      
                    <p style="display: none;" id="descProductMessage"></p>
                    <div class="containerChangeDesc" id="containerChangeDesc" style="display: none;">
                        <textarea type="text" placeholder="Insira a nova descrição" maxlength="254" id="descChangedValue" class="textInputs" cols="30" rows="10"></textarea>
                        <input type="button" value="Alterar" id="changeDescButton" onclick="changeDesc()">
                    </div>
                </div>
                <div class="textLine">
                    <h2>Quantidade atual em estoque:</h2>
                    <p>
                        <span id="amountText">
                            <?php echo $ProdutoInfo->productInfoData[0]['quantidade'];?>
                        </span> unidade(s)
                    </p>
                    <input type="button" value="Editar quantidade" id="editAmountButton" onclick="showOptions('containerChangeAmount', 'block')">
                    
                    <p style="display: none;" id="amountProductMessage"></p>
                    <div class="containerChangeAmount" id="containerChangeAmount" style="display: none;">
                        <input type="text" placeholder="Insira a nova quantidade" maxlength="15" id="amountChangedValue" class="textInputs">
                        <input type="button" value="Alterar" id="changeAmountButton" onclick="changeAmount()">
                    </div>
                </div>
                <div class="textLine" id="currentyProductSituation">
                    <h2>Situação atual do produto</h2>
                    <p id="textCurrentSituation"><?php echo $ProdutoInfo->productInfoData[0]['situacaoAtual'];?></p>
                    <input type="button" value="Editar situação do produto" id="editCurrentyButton" onclick="showOptions('containerChangeSituation', 'block')">
                    
                    <p style="display: none;" id="messageCurrentySituation"></p>
                    <div class="containerChangeSituation" id="containerChangeSituation" style="display: none;">
                        <select name="currentySituation" id="currentySituation">
                            <option value="0" selected disabled>Escolha uma opção</option>
                            <option value="Indisponível">Indisponível</option>
                            <option value="Disponível">Disponível</option>
                        </select>
                        <input type="button" value="Salvar alteração" id="saveCurrentySituationButton" onclick="changeSituation()">
                    </div>   
                </div>
                <div class="textLine">
                    <h2>Última atualização:</h2>
                    <p><?php echo $ProdutoInfo->lastDateModifiedData;?></php>
                </div>
                <div class="textLine">
                    <h2>Quantidade retirada no último mês:</h2>
                    <p><span><?php echo $ProdutoInfo->lastMonthAmount?></span> unidade(s)</p>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="containerCopyRight">
            <p><span>&copy;Stock Hub</span></p>
        </div>
    </footer>
    <script src="Scripts/produtoInfo.js"></script>
</body>
</html>