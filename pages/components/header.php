<?php
require_once 'globals.php'; 
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">
           ConfiaCar
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="clientesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                        <i class="bi bi-person-fill-add"></i> Cliente </a>
                    <ul class="dropdown-menu" aria-labelledby="clientesDropdown">
                        <li><h6 class="dropdown-header">Gerenciar Clientes</h6></li> <li><a class="dropdown-item" href="<?= $BASE_URL?>clientes.php">Listar / Cadastrar Clientes</a></li>
                        <li><a class="dropdown-item" href="#">Outra Ação de Cliente</a></li>
                        <li><hr class="dropdown-divider"></li> <li><a class="dropdown-item" href="#">Relatórios de Cliente</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="fornecedoresDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-building"></i> Fornecedor </a>
                    <ul class="dropdown-menu" aria-labelledby="fornecedoresDropdown">
                        <li><h6 class="dropdown-header">Gerenciar Fornecedores</h6></li>
                        <li><a class="dropdown-item" href="<?= $BASE_URL ?>fornecedores.php">Listar / Cadastrar Fornecedores</a></li>
                        <li><a class="dropdown-item" href="#">Outra Ação de Fornecedor</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= $BASE_URL ?>index.php"><i class="bi bi-house-fill"></i> Início</a>
                </li>
            </ul>
        </div>
    </div>
</nav>