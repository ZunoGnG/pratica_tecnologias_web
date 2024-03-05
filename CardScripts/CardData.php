<?php
include './Class/Model.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class CardData extends Model
{    
    public function __construct(){
        $_SESSION['productsDataArray'] = $this->getProductUserInfo($_SESSION['idUser']);
    }
}
$CardData = new CardData();
?>