<?php 

Class Fornecedor {
    public int $id;
    public string $nome;
    public string $cnpj;
    public string $email;
}

interface FornecedorDAOInterface {
    public function buildFornecedor($data);
    public function create(Fornecedor $data);
    public function update(Fornecedor $data);
    public function listFornecedor();
    public function del($id);
    public function FornecedorToArray(Fornecedor $data);
    public function hasFornecimentos($id);
    public function totalFornecedor();
}