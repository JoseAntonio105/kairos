<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <?php
        include_once 'includes/head-tag-contents.php';
    ?>
</head>
<body>
<div class="registro-pc">
  <div class="frame-11">
    <img class="logo" src="assets/img/kairos.png" onerror="this.src='https://placehold.co/150x50/1c0538/ffffff?text=Kairos'" alt="Kairos Logo"/>
  </div>
  
  <!-- Contenedor del Formulario -->
  <div class="registro">
    <form class="frame-9">
      <div class="frame-20">
        <div class="a-n-no-tienes-cuenta-registate">
          ¡Registrate rellenando el formulario!
        </div>
      </div>
      
      <div class="frame-12">
        <!-- Campo Nombre -->
        <div class="frame-13 frame-input-group">
          <label for="nombre-input" class="label-field">Nombre:</label>
          <input type="text" id="nombre-input" class="frame-17" placeholder="Introduce tu nombre" required />
        </div>
        
        <!-- Campo Apellidos -->
        <div class="frame-25 frame-input-group">
          <label for="apellidos-input" class="label-field">Apellidos:</label>
          <input type="text" id="apellidos-input" class="frame-17" placeholder="Introduce tus apellidos" required />
        </div>
        
        <!-- Campo Email -->
        <div class="frame-26 frame-input-group">
          <label for="email-input" class="label-field">Email:</label>
          <input type="email" id="email-input" class="frame-17" placeholder="Introduce tu email" required />
        </div>
        
        <!-- Campo Contraseña -->
        <div class="frame-27 frame-input-group">
          <label for="password-input" class="label-field">Contraseña:</label>
          <input type="password" id="password-input" class="frame-17" placeholder="Crea una contraseña" required />
        </div>
        
        <!-- Botones Aceptar/Cancelar -->
        <div class="frame-24">
          <button type="submit" class="frame-23">
            <div class="aceptar">Aceptar</div>
          </button>
          <a href="login.php" class="frame-22">
            <div class="cancelar">Cancelar</div>
          </a>
        </div>
      </div>
    </form>
  </div>
</div>

</body>
</html>