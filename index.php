<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Home</title>
    <style>
        body {
            background-color: #d3d3d3;
            /* Se o seu header.php for fixed-top, adicione um padding-top ao body para que o conteúdo não fique por baixo dele.
               Ajuste o valor '56px' para a altura real do seu header.
            */
            
        }

        /* Estilo para a área principal que conterá o menu e o conteúdo.
           Isso garante que ela ocupe todo o espaço vertical disponível.
           Ajuste a altura do header e footer nos comentários abaixo, se for usar.
        */

        /* O min-vh-100 no menu.php já deve cuidar da altura da sidebar.
           Se o header for fixed-top, o menu precisará de um padding-top para começar abaixo dele.
           Você pode adicionar isso diretamente no CSS do menu, ou criar uma classe aqui.
        */
        /* Exemplo de CSS se precisar ajustar o padding-top do menu para header fixo */
        .col-auto.bg-dark { /* Mirando na div principal do menu */
             padding-top: 20px; /* Adiciona um padding extra para não colar no header, se o header NÃO for fixo */
             /* Se o header FOR fixed-top, essa div já estaria 'presa' ao topo, então o padding-top dela
                precisaria ser ajustado para empurrar o *conteúdo interno* do menu para baixo do header.
                No seu menu.php, a classe 'pt-2' já faz um pequeno padding.
                Se o header é fixed-top, a sidebar precisa ser 'fixed' também ou ajustar seu topo.
                A solução atual usa flexbox e colunas, o que é mais simples do que fixed-top para sidebar.
             */
        }
    </style>
</head>

<body>
    <?php include "./header.php"; ?>

    <div class="container-fluid main-layout-area">
        <div class="row flex-nowrap">
            <?php include "pages/components/menu.php"; ?>
            <div class="col py-3">
                <div class="container py-4 border border-dark">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" >
                        <div class="carousel-inner">
                            <div class="carousel-item active" width = "200px">
                                <img src="public/img/logo.png" class="d-block w-100" alt="..." height="600px">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>First slide label</h5>
                                    <p>Some representative placeholder content for the first slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="public/img/logo.png" class="d-block w-100" alt="..." height="600">
                            </div>
                            <div class="carousel-item">
                                <img src="public/img/logo.png" class="d-block w-100" alt="..." height="600">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include './footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>