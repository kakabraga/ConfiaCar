<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Home - Meu Sistema</title>
    <style>
        body {
            background-color: #d3d3d3;
            /* Se o seu header.php for fixed-top, adicione um padding-top ao body.
               Isso empurra o conteúdo (incluindo a sidebar) para baixo do header.
               Ex: padding-top: 70px; (ajuste conforme a altura real da sua navbar) */
        }
    </style>
</head>

<body>
    <?php include "components/header.php"; ?>

    <div class="container-fluid d-flex flex-column main-content-wrapper">
        <div class="row flex-grow-1">
            <?php include "components/dashboard_card.php"?>
        </div>
        
    </div>

    <?php include 'components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>