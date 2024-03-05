<?php
include "Model.php";
class Cadastro extends Model{
    public function __construct()
    {
        $dados = $_POST;

        if(!$this->testExitence($dados['email'])){
            $this->createAccount($dados['user'], $dados['email'], $dados['password']);
            
            echo json_encode(true);
        }
        else{
            echo json_encode(false);  
        }

    }
}
$Cadastro = new Cadastro();
?>