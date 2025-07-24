<?php
header('Content-Type: application/json');
include '../config/db.php';
include '../DAO/FornecedorDAO.php';
include '../Util/sendJsonResponse.php';

$db            = new Database;
$fornecedorDAO = new FornecedorDAO($db->connect());
$fornecedor    = new Fornecedor;

if ($_SERVER['REQUEST_METHOD'] === 'GET'  && isset($_GET['action']) && $_GET['action'] === 'fetch') {
    $fornecedores = $fornecedorDAO->listFornecedor();
    echo json_encode($fornecedores);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] == 'del') {
    $data = json_decode(file_get_contents('php://input'), true); // Decodifica o JSON do corpo da requisição
    if (json_last_error() !== JSON_ERROR_NONE) {
        sendJsonResponse(false, "JSON inválido na requisição.");
        exit();
    }
    $id_fornecedor = $data['fornecedorId'] ?? null;
    if ($id_fornecedor) {
        // Altere 'del' para o nome correto do seu método de exclusão no DAO, por exemplo 'deleteCliente'
        $result = $fornecedorDAO->del($id_fornecedor);
        if ($result) {
            sendJsonResponse(true, "Cliente excluído com sucesso.");
        } else {
            sendJsonResponse(false, "Falha ao excluir cliente. ID não encontrado ou erro no banco.");
        }
    } else {
        sendJsonResponse(false, "ID do cliente não fornecido para exclusão.");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] == 'dep') {
    $data = json_decode(file_get_contents('php://input'), true); // Decodifica o JSON do corpo da requisição
    if (json_last_error() !== JSON_ERROR_NONE) {
        sendJsonResponse(false, "JSON inválido na requisição.");
        exit();
    }
    $id_fornecedor = $data['fornecedorId'] ?? null;
    if ($id_fornecedor) {
        // Altere 'del' para o nome correto do seu método de exclusão no DAO, por exemplo 'deleteCliente'
        $result = $fornecedorDAO->hasFornecimentos($id_fornecedor);
        if ($result) {
            sendJsonResponse(true, "O fornecedor tem fornecimentos, por isso não pode ser excluído.");
        } else {
            sendJsonResponse(false, "O fornecedor não tem fornecimentos.");
        }
    } else {
        sendJsonResponse(false, "ID do fornecedor não fornecido para verificação de dependencias.");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET'  && isset($_GET['action']) && $_GET['action'] === 'dep') {
    $fornecedores = $fornecedorDAO->listFornecedor();
    $dados_formatados = [];
    foreach ($fornecedores as $fornecedor) {
        $fornecedorId = $fornecedor->id;
        $hasFornecimentos = $fornecedorDAO->hasFornecimentos($fornecedorId);
        $fornecedorParaJson = [
            'id' => $fornecedorId,
            'nome' => $fornecedor->nome,
            'email' => $fornecedor->email,
            'cnpj' => $fornecedor->cnpj,
            'hasFornecimentos' => $hasFornecimentos
        ];
        $dadosFormatados[] = $fornecedorParaJson;
    }
    echo json_encode($dadosFormatados);
}