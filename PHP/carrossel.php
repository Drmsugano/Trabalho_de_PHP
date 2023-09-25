<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carrossel</title>
</head>
<script>
    const carousel = new bootstrap.Carousel('#myCarousel')
</script>
<style>
    /* Classe base do carousel */
    .carousel {
        margin-bottom: 4rem;
    }

    /* Já que usamos posicionamento de imagens, precisaremos fazer alguns ajustes na legenda */
    .carousel-caption {
        bottom: 3rem;
        z-index: 10;
    }

    /* Declaramos alturas, devido ao posicionamento do elemento img */
    .carousel-item {
        height: 38rem;
        background-color: #777;
    }

    .carousel-item>img {
        position: relative;
        top: 0;
        left: 0;
        min-width: 100%;
        height: 38rem;
    }
</style>

<body>
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="uploadUser\carrossel\wp1958104-php-wallpapers.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Trabalho de WEB 2</h5>
                    <p>do 2º bimestre</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="uploadUser\carrossel\pxfuel(1).jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="uploadUser\carrossel\pxfuel(2).jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Proximo</span>
        </button>
    </div>
</body>

</html>