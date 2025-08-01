<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <title>Gerenciamento de Fornecedores</title>
    <style>
        body {
            background-color: #d3d3d3;
        }

    </style>
</head>

<body>
    <?php include "components/header.php"; ?>
    <div class="container-fluid main-layout-area">
        <div class="row flex-nowrap">
            <?php include "components/menu_fornecedor.php"; ?>

            <div class="col py-3 content-area-wrapper">
                <div class="container py-4">
                    <div class="card mb-5 border border-dark shadow-lg">
                        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                            <h2 class="text-center text-white"> Gerenciamento de Fornecedores</h2>
                            <button type="button" class="btn btn-outline-light btn-sm float-end" id="btn-adicionar-fornecedor" data-bs-toggle="modal" data-bs-target="#FornecedorFormModal">
                                <i class="bi bi-person-plus-fill me-1"></i> Cadastrar
                            </button>
                        </div>
                        <div id="fornecedor"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="FornecedorFormModal" tabindex="-1" aria-labelledby="fornecedorFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="fornecedorFormModalLabel">Cadastrar Novo Fornecedor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_fornecedor" action="#" method="POST">
                        <input type="hidden" name="idFornecedor" id="fornecedor-id" value="">

                        <div class="mb-3">
                            <label for="Fornecedor-nome" class="form-label">Nome do Fornecedor</label>
                            <input type="text" class="form-control form-control-sm" name="nome" id="fornecedor-nome" placeholder="Digite o nome do Fornecedor" required>
                        </div>

                        <div class="mb-3">
                            <label for="Fornecedor-cnpj" class="form-label">CNPJ do Fornecedor</label>
                            <input type="text" class="form-control form-control-sm" name="cnpj" id="fornecedor-cpnj" placeholder="Digite o CNPJ do Fornecedor" required>
                        </div>

                        <div class="mb-3">
                            <label for="Fornecedor-email" class="form-label">E-mail do Fornecedor</label>
                            <input type="email" class="form-control form-control-sm" name="email" id="fornecedor-email" placeholder="Digite o e-mail do Fornecedor" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-sm" id="btn-submit-form" name="enviar">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="../public/js/api/fornecedor_api.js"></script>

    <script src="../public/js/forms/fornecedor_form_modal.js"></script>

    <script src="../public/js/pages/fornecedores_main.js"></script>
    <?php include 'components/footer.php'; ?>
</body>

</html>