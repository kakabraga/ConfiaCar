<?php

class Cliente
{
    public int $id;
    public string$nome;
    public string $email;
    public string $cpf;
}

interface ClientesDAOInterface
{
    public function buildCliente($data);
    public function listCliente();
    public function create(Cliente $data);
    public function update(Cliente $data);
    public function del($id);
    public function clienteToArray(Cliente $data);
    public function totalCliente();
}
