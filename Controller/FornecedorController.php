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
        $success = $fornecedorDAO->del($id_fornecedor);
        if ($success) {
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
        $success = $fornecedorDAO->hasFornecimentos($id_fornecedor);
        echo $success;
        if ($success) {
            sendJsonResponse(true, "Cliente tem dependencias.");
        } else {
            sendJsonResponse(false, "Falha ao excluir cliente. ID não encontrado ou erro no banco.");
        }
    } else {
        sendJsonResponse(false, "ID do cliente não fornecido para exclusão.");
    }
}
