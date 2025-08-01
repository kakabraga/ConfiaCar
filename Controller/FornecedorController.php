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
        // Altere 'del' para o nome correto do seu método de exclusão no DAO, por exemplo 'deletefornecedor'
        $result = $fornecedorDAO->del($id_fornecedor);
        if ($result) {
            sendJsonResponse(true, "fornecedor excluído com sucesso.");
        } else {
            sendJsonResponse(false, "Falha ao excluir fornecedor. ID não encontrado ou erro no banco.");
        }
    } else {
        sendJsonResponse(false, "ID do fornecedor não fornecido para exclusão.");
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
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_GET['action']) && $_GET['action'] === 'save') {
    $data = json_decode(file_get_contents('php://input'), true); // Decodifica o JSON do corpo da requisição
    if (json_last_error() !== JSON_ERROR_NONE) {
        sendJsonResponse(false, "JSON inválido na requisição.");
        exit();
    }

    $id_fornecedor = $data['id'] ?? null;
    $fornecedor->id   = $id_fornecedor;
    $fornecedor->nome = $data['nome'];
    $fornecedor->cnpj = $data['cnpj'];
    $fornecedor->email = $data['email'];
    if ($id_fornecedor == null) {
        $success = $fornecedorDAO->create($fornecedor);
    } else {
        $success = $fornecedorDAO->update($fornecedor);
    }
    if ($success) {
        sendJsonResponse(true, "Fornecedor cadastrado com sucesso.", 200);
    } else {
        sendJsonResponse(false, "Falha ao excluir fornecedor. ID não encontrado ou erro no banco.");
    }
}
