<?php
include 'Model.php';
class Processes extends Model
{
    public function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageData = '';
            $image = '';
            $imgType = '';
            $productInfo = '';

            if (!$_FILES) {
                $data = json_decode(file_get_contents('php://input'), true);
                $productInfo = $this->getSpecificProductInfo($data['userId'], $data['productId']);
            } else {
                $imageData = file_get_contents($_FILES['newImg']['tmp_name']);
                $image = base64_encode($imageData);
                $imgType = $_POST['imageType'];

                $data['productId'] = $_POST['productId'];
                $data['userId'] = $_POST['userId'];
                $data['process'] = $_POST['process'];

                $productInfo = $this->getSpecificProductInfo($data['userId'], $data['productId']);
            }

            switch ($data['process']) {
                case 'changeImage':
                    $this->updateImage($data['productId'], $image, $imgType);

                    $this->makeRegister(
                        $productInfo[0]['quantidade'],
                        $productInfo[0]['quantidade'],
                        $productInfo[0]['descricao'],
                        $productInfo[0]['descricao'],
                        $productInfo[0]['situacaoAtual'],
                        $productInfo[0]['situacaoAtual'],
                        $productInfo[0]['preco'],
                        $productInfo[0]['preco'],
                        $data['productId'],
                        $productInfo[0]['img'],
                        $image,
                        $productInfo[0]['nome'],
                        $productInfo[0]['nome'],
                        'alterarInformacao_img'
                    );

                    echo json_encode(true);
                    break;

                case 'changeName':
                    $this->updateName($data['productId'], $data['newName']);

                    $this->makeRegister(
                        $productInfo[0]['quantidade'],
                        $productInfo[0]['quantidade'],
                        $productInfo[0]['descricao'],
                        $productInfo[0]['descricao'],
                        $productInfo[0]['situacaoAtual'],
                        $productInfo[0]['situacaoAtual'],
                        $productInfo[0]['preco'],
                        $productInfo[0]['preco'],
                        $data['productId'],
                        $productInfo[0]['img'],
                        $productInfo[0]['img'],
                        $productInfo[0]['nome'],
                        $data['newName'],
                        'alterarInformacao_nome'
                    );

                    echo json_encode(true);
                    break;

                case 'changePrice':
                    $this->updatePrice($data['productId'], $data['newPrice']);

                    $this->makeRegister(
                        $productInfo[0]['quantidade'],
                        $productInfo[0]['quantidade'],
                        $productInfo[0]['descricao'],
                        $productInfo[0]['descricao'],
                        $productInfo[0]['situacaoAtual'],
                        $productInfo[0]['situacaoAtual'],
                        $productInfo[0]['preco'],
                        $data['newPrice'],
                        $data['productId'],
                        $productInfo[0]['img'],
                        $productInfo[0]['img'],
                        $productInfo[0]['nome'],
                        $productInfo[0]['nome'],
                        'alterarInformacao_preco'
                    );

                    echo json_encode(true);
                    break;

                case 'changeDesc':
                    $this->updateDesc($data['productId'], $data['newDesc']);

                    $this->makeRegister(
                        $productInfo[0]['quantidade'],
                        $productInfo[0]['quantidade'],
                        $productInfo[0]['descricao'],
                        $data['newDesc'],
                        $productInfo[0]['situacaoAtual'],
                        $productInfo[0]['situacaoAtual'],
                        $productInfo[0]['preco'],
                        $productInfo[0]['preco'],
                        $data['productId'],
                        $productInfo[0]['img'],
                        $productInfo[0]['img'],
                        $productInfo[0]['nome'],
                        $productInfo[0]['nome'],
                        'alterarInformacao_preco'
                    );

                    echo json_encode(true);
                    break;

                case 'changeAmount':
                    $this->updateAmount($data['productId'], $data['newAmount']);

                    $this->makeRegister(
                        $productInfo[0]['quantidade'],
                        $data['newAmount'],
                        $productInfo[0]['descricao'],
                        $productInfo[0]['descricao'],
                        $productInfo[0]['situacaoAtual'],
                        $productInfo[0]['situacaoAtual'],
                        $productInfo[0]['preco'],
                        $productInfo[0]['preco'],
                        $data['productId'],
                        $productInfo[0]['img'],
                        $productInfo[0]['img'],
                        $productInfo[0]['nome'],
                        $productInfo[0]['nome'],
                        'alterarInformacao_quantidade'
                    );

                    echo json_encode(true);
                    break;

                case 'changeSituation':
                    $this->updateCurrentySituation($data['productId'], $data['newSituation']);

                    $this->makeRegister(
                        $productInfo[0]['quantidade'],
                        $productInfo[0]['quantidade'],
                        $productInfo[0]['descricao'],
                        $productInfo[0]['descricao'],
                        $productInfo[0]['situacaoAtual'],
                        $data['newSituation'],
                        $productInfo[0]['preco'],
                        $productInfo[0]['preco'],
                        $data['productId'],
                        $productInfo[0]['img'],
                        $productInfo[0]['img'],
                        $productInfo[0]['nome'],
                        $productInfo[0]['nome'],
                        'alterarInformacao_situacao'
                    );

                    echo json_encode(true);
                    break;

                case 'deleteProduct':
                    $this->deleteProduct($data['productId']);

                    $this->makeRegister(
                        $productInfo[0]['quantidade'],
                        $productInfo[0]['quantidade'],
                        $productInfo[0]['descricao'],
                        $productInfo[0]['descricao'],
                        $productInfo[0]['situacaoAtual'],
                        $productInfo[0]['situacaoAtual'],
                        $productInfo[0]['preco'],
                        $productInfo[0]['preco'],
                        $data['productId'],
                        $productInfo[0]['img'],
                        $productInfo[0]['img'],
                        $productInfo[0]['nome'],
                        $productInfo[0]['nome'],
                        'deletarProduto'
                    );
                    echo json_encode(true);
                    break;
            }
        }
    }
}
$Processes = new Processes();
