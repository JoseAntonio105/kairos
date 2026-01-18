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
  <div class="videoplayer" id="player-hero" data-youtube-id="bM7Z88vwpl0">
    <div class="ratio ratio-21x9 bg-dark">
      <div class="video"></div>
    </div>

    <div class="controls controls-dark">
      <button class="btn btn-lg btn-video-playpause" type="button">
        <i class="bi bi-play-fill"></i><i class="bi bi-pause-fill d-none"></i>
      </button>

      <div class="px-1 w-100">
        <div class="progress w-100">
          <div class="progress-bar"></div>
        </div>
    </div>

    <button class="btn btn-lg btn-video-pip" type="button"><i class="bi bi-pip"></i></button>
    <button class="btn btn-lg btn-video-fullscreen" type="button"><i class="bi bi-arrows-fullscreen"></i></button>

    <div class="dropup">
      <button class="btn btn-lg btn-video-volume" data-bs-toggle="dropdown" type="button">
        <i class="bi bi-volume-down-fill"></i>
      </button>
      <div class="dropdown-menu dropdown-menu-end dropup-volume dropdown-menu-dark">
        <input class="form-range form-range-volume" type="range" value="0">
      </div>
    </div>
  </div>
</div>


    <div class="products">
      <?php
      for ($i = 0; $i < count($productos); $i++) {
          $producto = $productos[$i];
          include("includes/product-card.php");
      }
      ?>
    </div>
  </main>

  <footer><?php include("includes/footer.php");?></footer>
  <script src="js/scripts.js"></script>
  <script src="js/videoplayer.js"></script>
  <script src="js/videoplayer-init.js"></script>
</body>
</html>