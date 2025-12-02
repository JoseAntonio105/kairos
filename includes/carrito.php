<div id="cartModal" class="modal-backdrop">
    <div class="modal-content">
        
        <div class="drawer-header">
            <div class="drawer-title">Tu Carrito</div>
            <button id="closeCartModal" class="close-button" aria-label="Cerrar carrito">×</button>
        </div>

        <!-- Contenedor para los productos con ID para JS -->
        <div class="product-list" id="productList">
            
            <!-- Producto de ejemplo 1 -->
            <div class="elemento-carrito" data-product-id="1" data-price="99">
                <div class="producto-media">
                    <div class="imagen">
                        <!-- Imagen local del usuario -->
                        <img class="car-tula" src="assets/img/fc26.jpg" alt="EA Sports FC 26">
                    </div>
                    <div class="texto">
                        <div class="producto-1">EA Sports FC 26</div>
                        <div class="_99 product-price">99€</div>
                    </div>
                </div>
                <div class="item-actions">
                    <!-- CONTROL DE CANTIDAD CON FLECHAS (NUEVO) -->
                    <div class="item-quantity">
                        <span class="quantity-display" data-quantity>1</span>
                        <div class="quantity-controls">
                            <button class="quantity-btn increment-btn" aria-label="Aumentar cantidad">▲</button>
                            <button class="quantity-btn decrement-btn" aria-label="Disminuir cantidad">▼</button>
                        </div>
                    </div>
                    <!-- FIN CONTROL DE CANTIDAD -->
                    <div class="trash-icon remove-item-btn">🗑️</div>
                </div>
            </div>

            <!-- Producto de ejemplo 2 -->
            <div class="elemento-carrito" data-product-id="2" data-price="49">
                <div class="producto-media">
                    <div class="imagen">
                        <img class="car-tula" src="assets/img/fc26.jpg" alt="God of War">
                    </div>
                    <div class="texto">
                        <div class="producto-1">God of War</div>
                        <div class="_99 product-price">49€</div>
                    </div>
                </div>
                <div class="item-actions">
                    <div class="item-quantity">
                        <span class="quantity-display" data-quantity>2</span>
                        <div class="quantity-controls">
                            <button class="quantity-btn increment-btn" aria-label="Aumentar cantidad">▲</button>
                            <button class="quantity-btn decrement-btn" aria-label="Disminuir cantidad">▼</button>
                        </div>
                    </div>
                    <div class="trash-icon remove-item-btn">🗑️</div>
                </div>
            </div>

            <!-- Producto de ejemplo 3 -->
            <div class="elemento-carrito" data-product-id="3" data-price="19">
                <div class="producto-media">
                    <div class="imagen">
                        <img class="car-tula" src="assets/img/fc26.jpg" alt="The Witcher 3">
                    </div>
                    <div class="texto">
                        <div class="producto-1">The Witcher 3</div>
                        <div class="_99 product-price">19€</div>
                    </div>
                </div>
                <div class="item-actions">
                    <div class="item-quantity">
                        <span class="quantity-display" data-quantity>1</span>
                        <div class="quantity-controls">
                            <button class="quantity-btn increment-btn" aria-label="Aumentar cantidad">▲</button>
                            <button class="quantity-btn decrement-btn" aria-label="Disminuir cantidad">▼</button>
                        </div>
                    </div>
                    <div class="trash-icon remove-item-btn">🗑️</div>
                </div>
            </div>

        </div>
        
        <!-- Pie del Drawer (Subtotal y Botones) -->
        <div class="drawer-footer">
            
            <div class="subtotal-row">
                <span class="subtotal-text">Subtotal:</span>
                <span class="subtotal-price" id="subtotalPrice">0€</span>
            </div>

            <div class="action-buttons-container">
                <a class="action-button comprar" href="zonadepago.php">COMPRAR</a>
                <button class="action-button eliminar" id="removeAllItems">ELIMINAR TODOS</button>
            </div>
        </div>
    </div>
</div>