<?php

class Cliente
{
    public $id;
    public $nome;
    public $email;
    public $cpf;
}

interface ClientesDAOInterface
{
    public function buildCliente($data);
    public function listCliente();
    public function create(Cliente $data);
    public function update(Cliente $data);
    public function del($id);
    public function clienteToArray(Cliente $data);
}
