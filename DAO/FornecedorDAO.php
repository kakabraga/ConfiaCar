<?php
include '../Models/Fornecedor.php';

class FornecedorDAO implements FornecedorDAOInterface
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function buildFornecedor($data)
    {
        $fornecedor          = new Fornecedor();
        $fornecedor->id      = $data['id_fornecedor'];
        $fornecedor->nome    = $data['nome'];
        $fornecedor->cnpj    = $data['cnpj'];
        $fornecedor->email   = $data['email'];
        return $fornecedor;
    }
    public function create(Fornecedor $data)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_fornecedor (nome, cnpj, email) VALUES (:nome, :cnpj, :email)");
        $stmt->bindParam(":nome", $data->nome);
        $stmt->bindParam(":cnpj", $data->cnpj);
        $stmt->bindParam(":email", $data->email);
        $result = $stmt->execute();

        return $result ? true : false;
    }
    public function listFornecedor()
    {
        $stmt = $this->conn->prepare("SELECT id_fornecedor, nome, cnpj, email FROM tb_fornecedor WHERE data_exclusao IS NULL");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dados = [];
        if ($stmt->rowCount() > 0) {
            foreach ($result as $r) {
                $dados[]  = $this->buildFornecedor($r);
            }
            return $dados;
        } else {
            return false;
        }
    }
    public function update(Fornecedor $data)
    {
        $stmt   = $this->conn->prepare("UPDATE tb_fornecedor SET nome = :nome, cnpj = :cnpj, email = :email WHERE id_fornecedor = :id");
        $stmt->bindParam(":id", $data->id);
        $stmt->bindParam(":nome", $data->nome);
        $stmt->bindParam(":cnpj", $data->cnpj);
        $stmt->bindParam(":email", $data->email);
        $result = $stmt->execute();

        return $result ? true : false;
    }
    public function del($id)
    {
        $stmt = $this->conn->prepare("UPDATE tb_fornecedor SET data_exclusao = NOW() WHERE id_fornecedor = :id");
        $stmt->bindParam(":id", $id);
        $result = $stmt->execute();
        return $result ? true : false;
    }
    public function FornecedorToArray(Fornecedor $data)
    {
        $array_dados = [
            "id"    => $data->id,
            "nome"  => $data->nome,
            "cpnj"  => $data->cnpj,
            "email" => $data->email
        ];
        $result = is_null($array_dados) ? false : $array_dados;
        return $result;
    }

    public function hasFornecimentos($id)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM tb_fornecimento WHERE id_fornecedor = :id_fornecedor");
        $stmt->bindParam(":id_fornecedor", $id);
        $stmt->execute();
        return $stmt->fetchColumn() > 0 ? true : false;
    }
}
