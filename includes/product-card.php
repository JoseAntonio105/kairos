<?php
$titulo = "";
$cover = "";
$platformIcon = "";
$platformAlt = "";
$discount = "";
$price = "";
$detailsUrl = "";
$addUrl = "";

if (isset($producto["titulo"])) $titulo = $producto["titulo"];
if (isset($producto["cover"])) $cover = $producto["cover"];
if (isset($producto["platform_icon"])) $platformIcon = $producto["platform_icon"];
if (isset($producto["platform_alt"])) $platformAlt = $producto["platform_alt"];
if (isset($producto["discount"])) $discount = $producto["discount"];
if (isset($producto["price"])) $price = $producto["price"];
if (isset($producto["details_url"])) $detailsUrl = $producto["details_url"];
if (isset($producto["add_url"])) $addUrl = $producto["add_url"];
?>

<div class="product-card">
    <div class="product-card-inner">

        <a href="<?php echo htmlspecialchars($detailsUrl); ?>" class="product-card-media">
            <div class="product-card-platform">
                <img src="<?php echo htmlspecialchars($platformIcon); ?>" alt="<?php echo htmlspecialchars($platformAlt); ?>">
            </div>

            <div class="product-card-discount">
                <?php echo htmlspecialchars($discount); ?>
            </div>

            <img class="product-card-cover" src="<?php echo htmlspecialchars($cover); ?>" alt="<?php echo htmlspecialchars($titulo); ?>">
        </a>

        <div class="product-card-bottom">
            <div class="product-card-price">
                <?php echo htmlspecialchars($price); ?>
            </div>

            <a class="product-card-button" href="<?php echo htmlspecialchars($addUrl); ?>">
                AÑADIR AL CARRITO
            </a>
        </div>

    </div>
</div>
