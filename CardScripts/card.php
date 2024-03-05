<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "CardData.php";
?>
<div class="productCard">
    <div class="productImgContainer">
        <img src="<?php echo $_SESSION['currentyImageURL']?>" alt="Imagem do produto">
    </div>
    <div class="productInfoContainer">
        <h2><?php echo $_SESSION['currentyProductInformations']['nome'];?></h2>

        <h3>Quantidade atual:</h3>
        <p><span><?php echo $_SESSION['currentyProductInformations']['quantidade'];?></span> unidades</p>

        <h3>Última alteração:</h3>
        <p><span>18/04/23</span></p><!--Colocar as informaçoes vindas do banco de dados aqui-->
    </div>
    <div class="productCardButtons">
        <input type="button" value="Ver mais" onclick="showProductInfo(<?php echo $_SESSION['currentyProductInformations']['id'];?>,<?php echo $_SESSION['idUser'];?>)"><!--Colocar o Id do usuario junto com o id do produto-->
    </div>
</div>