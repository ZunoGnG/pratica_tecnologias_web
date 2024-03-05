<?php
include 'Model.php';
class Privacidade extends Model
{
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
}
$Privacidade = new Privacidade();
?>