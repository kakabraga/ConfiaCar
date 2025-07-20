<?php
header('Content-Type: application/json');
include '../config/db.php';
include '../DAO/ClienteDAO.php';
include '../Util/sendJsonResponse.php';
$db = new Database;
$clienteDAO  = new ClienteDAO($db->connect());
$cliente     = new Cliente;
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'fetch') {
    $clientes    = $clienteDAO->listCliente();
    echo json_encode($clientes);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] == 'del') {
    $data = json_decode(file_get_contents('php://input'), true); // Decodifica o JSON do corpo da requisição
    if (json_last_error() !== JSON_ERROR_NONE) {
        sendJsonResponse(false, "JSON inválido na requisição.");
        exit();
    }

    $id_cliente = $data['idCliente'] ?? null;
    if ($id_cliente) {
        // Altere 'del' para o nome correto do seu método de exclusão no DAO, por exemplo 'deleteCliente'
        $success = $clienteDAO->del($id_cliente);

        if ($success) {
            sendJsonResponse(true, "Cliente excluído com sucesso.");
        } else {
            sendJsonResponse(false, "Falha ao excluir cliente. ID não encontrado ou erro no banco.");
        }
    } else {
        sendJsonResponse(false, "ID do cliente não fornecido para exclusão.");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'save') {
    $data = json_decode(file_get_contents('php://input'), true); // Decodifica o JSON do corpo da requisição
    if (json_last_error() !== JSON_ERROR_NONE) {
        sendJsonResponse(false, "JSON inválido na requisição.");
        exit();
    }

    $id_cliente    =  $data['id'] ?? null;
    $nome          =  $data['nome'];
    $email         =  $data['email'];
    $cpf           =  $data['cpf'];
    $cliente->id       = $id_cliente;
    $cliente->nome     = $nome;
    $cliente->email    = $email;
    $cliente->cpf      = $cpf;
    if($id_cliente == null) {
        $success = $clienteDAO->create($cliente);
    } else {
        $success = $clienteDAO->update($cliente);
    }
    if ($success) {
        sendJsonResponse(true, "Cliente cadastrado com sucesso.", 200);
    } else {
        sendJsonResponse(false, "Falha ao excluir cliente. ID não encontrado ou erro no banco.");
    }
} else {
    sendJsonResponse(false, "Requisição inválida ou ação não suportada.");
}
