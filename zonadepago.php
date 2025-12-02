<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona de pago</title>
        <?php
        include_once 'includes/head-tag-contents.php';
    ?>
</head>
<body>
    <div class="zona-de-pago-pc">
    <?php
    include 'includes/navigation.php';
    ?>
    <?php include("includes/carrito.php"); ?>

<div class="carrito2">
    <div class="frame-9">
      <!-- Sección de Productos (Izquierda) - Se mantiene corta y compacta -->
      <div class="frame-5">
        <div class="elemento-carrito">
          <div class="imagen">
            <img class="car-tula" src="assets/img/fc26.jpg" onerror="this.src='https://placehold.co/55x55/5e3a8b/ffffff?text=P1'" />
          </div>
          <div class="texto">
            <div class="titulo">
              <div class="producto-1">Producto 1</div>
            </div>
            <div class="_99">99$</div>
          </div>
          <div class="botones">
            <div class="_1">1</div>
            <!-- He reemplazado los SVG de Group-4 con un texto simple para la flecha, que es más seguro si el SVG no se encuentra -->
            <div class="quantity-control">
                <div class="up-arrow">▲</div> 
                <div class="down-arrow">▼</div> 
            </div>
          </div>
          <div class="frame-7">
            🗑️
          </div>
        </div>
        <div class="elemento-carrito">
          <div class="imagen">
            <img class="car-tula" src="assets/img/fc26.jpg" onerror="this.src='https://placehold.co/55x55/5e3a8b/ffffff?text=P2'" />
          </div>
          <div class="texto">
            <div class="titulo">
              <div class="producto-1">Producto 2</div>
            </div>
            <div class="_99">99$</div>
          </div>
          <div class="botones">
            <div class="_1">1</div>
            <div class="quantity-control">
                <div class="up-arrow">▲</div> 
                <div class="down-arrow">▼</div> 
            </div>
          </div>
          <div class="frame-7">
            🗑️
          </div>
        </div>
        <div class="elemento-carrito">
          <div class="imagen">
            <img class="car-tula" src="assets/img/fc26.jpg" onerror="this.src='https://placehold.co/55x55/5e3a8b/ffffff?text=P3'" />
          </div>
          <div class="texto">
            <div class="titulo">
              <div class="producto-1">Producto 3</div>
            </div>
            <div class="_99">99$</div>
          </div>
          <div class="botones">
            <div class="_1">1</div>
            <div class="quantity-control">
                <div class="up-arrow">▲</div> 
                <div class="down-arrow">▼</div> 
            </div>
          </div>
          <div class="frame-7">🗑️
          </div>
        </div>
      </div>
      
      <!-- Resumen del Pedido (Derecha) - Estructura limpia -->
      <div class="frame-25">
        <div class="frame-26">
          
          <!-- Título: Resumen del pedido -->
          <div class="resumen-del-pedido">Resumen del pedido</div>
          
          <!-- Fila 1: Subtotal -->
          <div class="frame-28 summary-row">
            <div class="subtotal-x-productos">Subtotal (3 productos)</div>
            <div class="_992 price-text">$297</div>
          </div>
          
          <!-- Fila 2: Envío -->
          <div class="frame-29 summary-row">
            <div class="env-o-estimado">Envío estimado</div>
            <div class="gratuito price-text">Gratuito</div>
          </div> 
          
          <!-- Fila 3: Devolución (Sin valor, solo texto informativo) -->
          <div class="frame-30 summary-row info-row">
            <div class="devoluci-n-gratuita-en-30-d-as">
              Devolución gratuita en 30 días
            </div>
          </div>

          <!-- Fila Final: Total (El divisor lo manejará el CSS con un border-top y bottom) -->
          <div class="frame-33 summary-row total-row">
            <div class="total-del-pedido">Total del pedido:</div>
            <div class="_993 price-text total-price">€297</div>
          </div>
        </div>
        
        <!-- Botón de Confirmar Pedido -->
        <div class="frame-72 action-button">
          <div class="confirmar-pedido">Confirmar pedido</div>
        </div>
      </div>
    </div>
  </div>
      <?php
        include_once 'includes/footer.php';
    ?>
</div>
	<script src="js/scripts.js"></script>

</body>
</html>