<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <?php
        include_once 'includes/head-tag-contents.php';
        ?>

    </head>
    <body>

        <div class="login-pc">
            <div class="frame-11">
                <!-- Se asume que el logo es un elemento de cabecera -->
                <img class="logo" src="assets/img/kairos.png" onerror="this.src='https://placehold.co/150x50/1c0538/ffffff?text=Kairos'" alt="Kairos Logo"/>
            </div>
            
            <!-- Contenedor del Formulario (Registro/Login) -->
            <div class="registro">
                <form class="frame-9">
                    <div class="frame-20">
                        <div class="bienvenido-a-kairos">¡Bienvenido a Kairos!</div>
                    </div>
                    
                    <div class="frame-12">
                        
                        <!-- Campo Email -->
                        <div class="frame-18">
                            <label for="email-input" class="label-field">Email:</label>
                            <input type="email" id="email-input" class="frame-17" placeholder="Introduce tu email" required />
                        </div>
                        
                        <!-- Campo Contraseña -->
                        <div class="frame-18">
                            <label for="password-input" class="label-field">Contraseña:</label>
                            <input type="password" id="password-input" class="frame-17" placeholder="Introduce tu contraseña" required />
                        </div>
                        
                        <!-- Botón Log In -->
                        <div class="frame-24">
                            <button type="submit" class="frame-23">
                                <div class="log-in">Log in</div>
                            </button>
                        </div>
                        
                        <!-- Enlace de registro -->
                        <div class="frame-202">
                            <div class="a-n-no-tienes-cuenta-registrate-aqu">
                                <a href="register.php">
                                    ¿Aún no tienes cuenta? Regístrate aquí
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>