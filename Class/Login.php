<?php
session_start();
include "Model.php";
class Login extends Model{
    public function __construct()
    {
        $dados = $_POST;

        $loginResquest = $this->loginRequest($dados['email'], $dados['password']);


        if($loginResquest){
            echo json_encode(true);

            $_SESSION['userInfo'] = $this->getUserInfo($dados['email']);

            $_SESSION['idUser'] = $_SESSION['userInfo'][0]['id'];
        }

        else{
            echo json_encode("notAccount");
        }
    }
}
$Login = new Login();
?>