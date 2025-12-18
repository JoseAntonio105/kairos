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
    <div class="products">
        <?php
            for ($i = 0; $i < count($productos); $i++) {

                if (
                    isset($productos[$i]["platform"]) &&
                    $productos[$i]["platform"] === "playstation"
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