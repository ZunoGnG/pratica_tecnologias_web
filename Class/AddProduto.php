<?php
include 'Model.php';
session_start();
class Addproduto extends Model
{
    public function __construct()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){  
            $imageData = file_get_contents($_FILES['image']['tmp_name']);
            $image = base64_encode($imageData);

            $name = $_POST['name'];
            $description = $_POST['desc'];
            $amount = $_POST['amount'];
            $totalPrice = $_POST['price'];
            $imgType = $_POST['imageType'];         
            
            
            $this->addProductOnDB($image, $name, $totalPrice, $description, $amount, $_SESSION['idUser'], $imgType);
            
            $lastProductId = $this->getLastAddProductId($_SESSION['idUser']);

            $this->makeRegister($amount, $amount, $description, $description, 'Disponível', 'Disponível', $totalPrice, $totalPrice, $lastProductId[0]['id'], $image, $image, $name, $name, 'addProduto');

            echo json_encode(true);
        }
    }
}
$AddProduto = new Addproduto();
?>