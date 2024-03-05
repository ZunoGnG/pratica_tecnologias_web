<?php
session_start();
class Logout
{
    public function __construct()
    {
        $request = json_decode(file_get_contents('php://input'), true);
        if($request['action'] === 'logout' && $request['confirmation'] == true){
            $_SESSION['idUser'] = "";
            echo json_encode(true);
        }
    }
}
$Logout = new Logout();
?>