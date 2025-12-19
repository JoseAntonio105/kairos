<!-- Fase 2: ERROR GRAVE: no usáis boostrap, componentes como navbar, modales, botones y clases auxiliares de todo tipo!-->

<?php include("includes/a_config.php");?>
<!DOCTYPE html>
<html>
<head>
  <?php include("includes/head-tag-contents.php");?>
</head>
<body>
  <header>
	<?php include("includes/navigation.php");?>
  <?php include("includes/carrito.php"); ?>
  <?php include("includes/products.php"); ?>
  </header>

  <main>
    <div class="hero-video">
      <iframe
        src="https://www.youtube.com/embed/gp9aY09li1s?autoplay=1&mute=1&controls=0&rel=0&modestbranding=1&playsinline=1&loop=1&playlist=gp9aY09li1s"
        frameborder="0"
        allow="autoplay; encrypted-media; picture-in-picture"
        allowfullscreen>
      </iframe>
    </div>

    <div class="products">
        <?php
            for ($i = 0; $i < count($productos); $i++) {

                if (
                    isset($productos[$i]["platform"]) &&
                    $productos[$i]["platform"] === "nintendo"
                ) {
                    $producto = $productos[$i];
                    include("includes/product-card.php");
                }

            }
        ?>
    </div>
  </main>

  <footer><?php include("includes/footer.php");?></footer>
  <script src="js/scripts.js"></script>

</body>
</html>