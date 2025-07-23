<?php
include('../globals.php');
require_once('../models/Cliente.php');

class ClienteDAO implements ClientesDAOInterface
{

    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function buildCliente($data)
    {
        $cliente = new Cliente();
        $cliente->id           = $data["id_cliente"];
        $cliente->nome         = $data["nome"];
        $cliente->email        = $data["email"];
        $cliente->cpf          = $data["cpf"];
        return $cliente;
    }

    public function create(Cliente $data)
    {
        $stmt = $this->conn->prepare("INSERT INTO tb_cliente (nome, cpf, email) VALUES(:nome, :cpf, :email)");
        $stmt->bindParam(":nome", $data->nome);
        $stmt->bindParam(":cpf", $data->cpf);
        $stmt->bindParam(":email", $data->email);
        $resultado = $stmt->execute();

        return $resultado ? true : false;
    }
    public function listCliente()
    {
        $stmt = $this->conn->prepare("SELECT id_cliente, nome, email, cpf FROM tb_cliente");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dados = [];
        
        if ($stmt->rowCount() > 0) {
            foreach($result as $row) {
                $dados[] = $this->buildCliente($row);
            }
            return $dados;
        } else {
            return false;
        }
    }
    public function update(Cliente $data)
    {
        $stmt = $this->conn->prepare("UPDATE tb_cliente SET nome = :nome, email = :email, cpf = :cpf WHERE id_cliente = :id");
        $stmt->bindParam(":id", $data->id);
        $stmt->bindParam(":nome", $data->nome);
        $stmt->bindParam(":email", $data->email);
        $stmt->bindParam(":cpf", $data->cpf);
        $resultado = $stmt->execute();
        
        return $resultado ? true : false;
    }
    public function del($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_cliente WHERE id_cliente = :id");
        $stmt->bindParam(":id", $id);
        $result = $stmt->execute();
        return $result ? true : false;
    }
    public function clienteToArray(Cliente $data)
    {
            $array_data = [
                'id' => $data->id,
                'nome' => $data->nome,
                'email' => $data->email,
                'cpf' => $data->cpf
            ];
            return $array_data;
        }
    
}
