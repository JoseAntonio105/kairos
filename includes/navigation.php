<!-- Fase 2: ERROR GRAVE: no usáis boostrap, componentes como navbar, modales, botones y clases auxiliares de todo tipo!-->

<nav class="kairos-header fixed-top" style="padding-bottom: 5px;">
    <div class="kairos-header-container">

        <!-- Logo -->
        <a class="kairos-logo" href="index.php">
            <img src="assets/img/logo150.png" alt="Kairos Logo">
        </a>

        <!-- Barra grande: menú + buscador + lupa -->
        <div class="kairos-bar">
            <div class="kairos-menu-wrapper dropdown">
                <button class="kairos-menu-btn dropdown-toggle" type="button"
                        id="kairosMenuDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                </button>

                <ul class="dropdown-menu kairos-menu-dropdown" aria-labelledby="kairosMenuDropdown">
                    <li><a class="dropdown-item" href="plataformas.php">Ver todas las plataformas</a></li>
                    <li><a class="dropdown-item" href="minijuego-konva/index.html">Juega a Konva Commerce Game!</a></li>
                    <li><a class="dropdown-item" href="terminoslegales.php">Términos legales</a></li>
                </ul>
            </div>

            <div class="kairos-search">
                <input type="text" placeholder="Busca tus juegos favoritos...">
            </div>

            <button class="kairos-search-btn" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!-- Barra pequeña: login + carrito -->
        <div class="kairos-actions-bar">
            <a class="kairos-action-btn" href="login.php">
                <i class="fas fa-user"></i>
            </a>
            <a class="kairos-action-btn" href="wishlist.php">
                <i class="fas fa-star"></i>
            </a>
            <a class="kairos-action-btn" id="openCartModal">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <a class="kairos-action-btn" href="recibos.php">
                <i class="fas fa-receipt"></i>
            </a>
            <a class="kairos-action-btn" href="devoluciones.php">
                <i class="fas fa-box-open"></i>
            </a>
        </div>

    </div>
</nav>