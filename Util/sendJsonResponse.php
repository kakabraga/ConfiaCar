<?php
// Util/sendJsonResponse.php

/**
 * Envia uma resposta JSON padronizada para o cliente e encerra a execução do script.
 *
 * @param bool $success Indica se a operação foi bem-sucedida.
 * @param string $message Uma mensagem descritiva sobre o resultado da operação.
 * @param mixed $data Opcional. Os dados a serem retornados (ex: array de clientes, objeto de cliente).
 * @param int $statusCode Opcional. O código de status HTTP a ser enviado (padrão: 200 OK).
 */
function sendJsonResponse(bool $response, string $message, $data = null, int $statusCode = 200) {
    // Define o cabeçalho Content-Type para JSON
    header('Content-Type: application/json');
    // Define o código de status HTTP
    http_response_code($statusCode);

    // Constrói o array da resposta
    $response = [
        'response' => $response,
        'message' => $message,
    ];

    // Adiciona os dados apenas se fornecidos e não forem nulos
    if ($data !== null) {
        $response['data'] = $data;
    }

    // Codifica o array para JSON e o imprime
    echo json_encode($response);

    // Encerra a execução do script para garantir que nada mais seja enviado após o JSON
    exit();
}