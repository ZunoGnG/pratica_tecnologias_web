<?php
include 'Model.php';
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
class Privacidade extends Model
{
    public function __construct()
    {   
        $userId = $_SESSION['idUser'];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imgType = '';
            $imageData = '';
            $newImage = '';

            if (!$_FILES) {
                $data = json_decode(file_get_contents('php://input'), true);
            } else {
                $imgType = $_POST['imgType'];
                $imageData = file_get_contents($_FILES['newImg']['tmp_name']);
                $newImage = base64_encode($imageData);
                
                $data['infoUpdate'] = $_POST['infoUpdate'];
            }

            $userInfos = $this->getUserInfoByID($_SESSION['idUser']);

            switch($data['infoUpdate']){
                case 'name':
                    $this->updateUsername($userId, $data['newName']);

                    $this->registerUserPerfilChange(
                        $userInfos[0]['email'],
                        $userInfos[0]['usuario'],
                        $data['newName'],
                        $userInfos[0]['senha'],
                        $userInfos[0]['senha'],
                        $userInfos[0]['imagemPerfil'],
                        $userInfos[0]['imagemPerfil'],
                        'alterarNome',
                        $userId,
                    );

                    echo json_encode(true);
                    break;
                
                case 'password':
                    $passwordCriptografied = $this->passwordCryptography($data['newPassword']);

                    $this->updateUserPassword($userId, $passwordCriptografied);

                    $this->registerUserPerfilChange(
                        $userInfos[0]['email'],
                        $userInfos[0]['usuario'],
                        $userInfos[0]['usuario'],
                        $userInfos[0]['senha'],
                        $passwordCriptografied,
                        $userInfos[0]['imagemPerfil'],
                        $userInfos[0]['imagemPerfil'],
                        'alterarSenha',
                        $userId,
                    );

                    echo json_encode(true);
                    break;

                case 'image':
                    $this->updateUserPerfilImage($userId, $newImage, $imgType);

                    $this->registerUserPerfilChange(
                        $userInfos[0]['email'],
                        $userInfos[0]['usuario'],
                        $userInfos[0]['usuario'],
                        $userInfos[0]['senha'],
                        $userInfos[0]['senha'],
                        $userInfos[0]['imagemPerfil'],
                        $newImage,
                        'alterarImagem',
                        $userId,
                    );

                    echo json_encode(true);
                    break;

                case 'deleteAccount':
                    $this->deleteUserAccount($userId);

                    $this->registerUserPerfilChange(
                        $userInfos[0]['email'],
                        $userInfos[0]['usuario'],
                        $userInfos[0]['usuario'],
                        $userInfos[0]['senha'],
                        $userInfos[0]['senha'],
                        $userInfos[0]['imagemPerfil'],
                        $userInfos[0]['imagemPerfil'],
                        'deletarConta',
                        $userId,
                    );

                    echo json_encode(true);
                    break;
                default:
                    echo json_encode("?");
                    break;
            }
        }
    }
}
$Privacidade = new Privacidade();
?>