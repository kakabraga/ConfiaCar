<?php 
require_once '../config/db.php';
require_once '../DAO/ClienteDAO.php';
require_once '../DAO/FornecedorDAO.php';

$db = new Database();

$clienteDAO = new ClienteDAO($db->connect());
$fornecedorDAO = new FornecedorDAO($db->connect());

$qtd_clientes = $clienteDAO->totalCliente();
$qtd_fornecedores = $fornecedorDAO->totalFornecedor();
?>

<style>
    .main-content-wrapper {
        /* Calcula 100% da altura da viewport menos a altura do header e footer */
        min-height: calc(100vh - var(--header-height, 0px) - var(--footer-height, 0px));
        flex-grow: 1;
        /* Permite que este elemento cresça para preencher o espaço disponível */
    }

    /* Se você quiser um padding na área de conteúdo para que não cole no menu */
    .content-area-wrapper {
        padding-left: 1rem;
        /* Adiciona um pequeno padding à esquerda, separando do menu */
    }

    /* Opcional: Estilo para os cards de dashboard, se for usá-los */
    .dashboard-card {
        min-height: 150px;
        /* Garante uma altura mínima para os cards */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
</style>

<main class="col py-3 content-area-wrapper">
    <div class="container py-4 border border-dark rounded bg-white shadow">
        <h1 class="mb-4 text-center text-dark">Painel Principal</h1>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card bg-primary text-white dashboard-card">
                    <div class="card-body">
                        <i class="bi bi-people-fill fs-1 mb-2"></i>
                        <h5 class="card-title">Total de Clientes</h5>
                        <p class="card-text fs-3"><?= $qtd_clientes ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card bg-success text-white dashboard-card">
                    <div class="card-body">
                        <i class="bi bi-truck fs-1 mb-2"></i>
                        <h5 class="card-title">Total de Fornecedores</h5>
                        <p class="card-text fs-3"><?= $qtd_fornecedores ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card bg-info text-white dashboard-card">
                    <div class="card-body">
                        <i class="bi bi-box-seam fs-1 mb-2"></i>
                        <h5 class="card-title">Total de Produtos</h5>
                        <p class="card-text fs-3">789</p>
                    </div>
                </div>
            </div>
        </div>
        <p class="mt-4 text-center">
            Explore as opções no menu lateral para gerenciar seu sistema.
        </p>
    </div>
</main>