<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataformas</title>
    <?php include_once 'includes/head-tag-contents.php'?>
</head>


<body>

<?php include_once 'includes/navigation.php' ?>
<?php include_once 'includes/carrito.php' ?>

<div class="plataformas-pc">

    <div class="titulo-plataformas">PLATAFORMAS</div>

    <div class="grid-plataformas">

        <a href="playstation.php" class="product-card plataforma">
            <div class="product-card-inner">
                <div class="product-card-media">
                    <img class="product-card-cover" src="assets/img/platforms/playstationBig.png" alt="PlayStation">
                </div>
                <div class="product-card-bottom">
                    <div class="product-card-price">PLAYSTATION</div>
                </div>
            </div>
        </a>

        <a href="nintendo.php" class="product-card plataforma">
            <div class="product-card-inner">
                <div class="product-card-media">
                    <img class="product-card-cover" src="assets/img/platforms/nintendoBig.png" alt="Nintendo">
                </div>
                <div class="product-card-bottom">
                    <div class="product-card-price">NINTENDO</div>
                </div>
            </div>
        </a>

        <a href="xbox.php" class="product-card plataforma">
            <div class="product-card-inner">
                <div class="product-card-media">
                    <img class="product-card-cover" src="assets/img/platforms/xboxBig.png" alt="Xbox">
                </div>
                <div class="product-card-bottom">
                    <div class="product-card-price">XBOX</div>
                </div>
            </div>
        </a>

        <a href="steam.php" class="product-card plataforma">
            <div class="product-card-inner">
                <div class="product-card-media">
                    <img class="product-card-cover" src="assets/img/platforms/steamBig.png" alt="Steam">
                </div>
                <div class="product-card-bottom">
                    <div class="product-card-price">STEAM</div>
                </div>
            </div>
        </a>

    </div>

</div>

<?php include_once 'includes/footer.php'?>
<script src="js/scripts.js"></script>
</body>
</html>
