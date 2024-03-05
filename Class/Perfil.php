<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'CardScripts/CardData.php';
class Perfil extends Model{
    public $userInfos;
    public $imgURL;
    
    public function __construct()
    {
        $this->userInfos = $this->getUserInfoByID($_SESSION['idUser']);
        if(!$this->userInfos[0]['imagemPerfil']){
            $this->imgURL = 'imgs/teste.png';
        }
        else{
            $this->imgURL = 'data:'.$this->userInfos[0]['tipoImagem'].';base64,'. $this->userInfos[0]['imagemPerfil'];
        }
    }

    public function showProductCards(){
        if(isset($_SESSION['productsDataArray']) && count($_SESSION['productsDataArray']) > 0){
            for ($i = 0; $i < count($_SESSION['productsDataArray']); $i++){
                $_SESSION['currentyProductInformations'] = $_SESSION['productsDataArray'][$i];

                $currentyImage = $_SESSION['currentyProductInformations']['img'];

                $_SESSION['currentyImageURL'] = 'data:'.$_SESSION['currentyProductInformations']['tipoImagem'].';base64,'. $currentyImage;
                include 'CardScripts/card.php';
            }
        }
    }
}
$Perfil = new Perfil();
?>