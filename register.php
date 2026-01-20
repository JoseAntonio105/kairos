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
          ¡Regístrate rellenando el formulario!
        </div>
      </div>
      
      <div class="frame-12">
        <!-- Campos del Formulario -->

        <div class="frame-13 frame-input-group">
          <label for="username" class="label-field">Nombre de usuario:</label>
          <input type="text" id="username" class="frame-17" placeholder="Introduce un nombre de usuario" required />
        </div>

        <div class="frame-13 frame-input-group">
          <label for="name" class="label-field">Nombre:</label>
          <input type="text" id="name" class="frame-17" placeholder="Introduce tu nombre" required />
        </div>
        
        <div class="frame-25 frame-input-group">
          <label for="lastName" class="label-field">Apellidos:</label>
          <input type="text" id="lastName" class="frame-17" placeholder="Introduce tus apellidos" required />
        </div>
        
        <div class="frame-25 frame-input-group">
          <label for="country" class="label-field">País:</label>
          <select id="country" name="country" class="frame-17" required>
            <option value="">Selecciona tu país</option>
          <!-- aquí se cargarán los países desde la BBDD -->
          </select>
        </div>

        <div class="frame-25 frame-input-group">
          <label for="postalCode" class="label-field">Código postal:</label>
          <input type="text" id="postalCode" class="frame-17" placeholder="Introduce tu código postal" required />
        </div>

        <div class="frame-25 frame-input-group">
          <label for="phone" class="label-field">Teléfono:</label>
          <input type="text" id="phone" class="frame-17" placeholder="Introduce tu teléfono" required />
        </div>

        <div class="frame-26 frame-input-group">
          <label for="email" class="label-field">Email:</label>
          <input type="email" id="email" class="frame-17" placeholder="Introduce tu email" required />
        </div>
        
        <div class="frame-27 frame-input-group">
          <label for="password" class="label-field">Contraseña:</label>
          <input type="password" id="password" class="frame-17" placeholder="Crea una contraseña" required />
        </div>
        
        <div class="frame-24">
          <button type="submit" class="frame-23">
            <div class="log-in" id="google-register">Registrarse con Google</div>
          </button>
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