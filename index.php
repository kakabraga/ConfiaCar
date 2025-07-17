<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Home</title>
    <style>
        body {
            background-color: #d3d3d3;
        }
    </style>
</head>

<body>
    <?php include "pages/components/header.php"; ?>
    <div class="d-flex flex-column min-vh-100">
        <div class="container-fluid flex-grow-1">
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
        <?php include 'pages/components/footer.php'; ?>
    </div>
</body>

</html>