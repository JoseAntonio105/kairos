//
// Poner aquí los scripts 
// 

window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    
    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

});

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('cartModal');
    const openButton = document.getElementById('openCartModal'); 
    const closeButton = document.getElementById('closeCartModal');
    const productList = document.getElementById('productList');
    const subtotalElement = document.getElementById('subtotalPrice');
    const removeAllButton = document.getElementById('removeAllItems');

    // --- Funciones del Drawer ---
    function openDrawer() {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        modal.classList.remove('active');
        setTimeout(() => {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }, 300);
    }

    if (openButton) {
        openButton.addEventListener('click', () => {
            modal.style.display = 'block';
            updateSubtotal();
            requestAnimationFrame(openDrawer);
        });
    }

    if (closeButton) {
        closeButton.addEventListener('click', closeDrawer);
    }

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeDrawer();
        }
    });

    document.addEventListener('keydown', function(e) {
        if ((e.key === "Escape" || e.key === "Esc") && modal && modal.classList.contains('active')) {
            closeDrawer();
        }
    });


    // --- Lógica de Cantidad y Carrito ---

    function updateSubtotal() {
        const productList = document.getElementById('productList');
        const subtotalElement = document.getElementById('subtotalPrice');

        if (!productList || !subtotalElement) {
            return; // no estamos en una página con carrito
        }
        let total = 0;
        const items = productList.querySelectorAll('.elemento-carrito');
        
        items.forEach(item => {
            const price = parseFloat(item.getAttribute('data-price'));
            const quantityDisplay = item.querySelector('[data-quantity]');
            const quantity = parseInt(quantityDisplay.textContent, 10);
            
            if (!isNaN(price) && !isNaN(quantity)) {
                total += price * quantity;
            }
        });

        subtotalElement.textContent = `${total}€`;
    }

    document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('cartModal');
    const openButton = document.getElementById('openCartModal');
    const closeButton = document.getElementById('closeCartModal');
    const productList = document.getElementById('productList');
    const subtotalElement = document.getElementById('subtotalPrice');
    const removeAllButton = document.getElementById('removeAllItems');

    // Si no existe el layout del carrito en esta página, salimos sin hacer nada
    if (!modal || !productList || !subtotalElement) {
        return;
    }

    // --- Funciones del Drawer ---
    function openDrawer() {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        modal.classList.remove('active');
        setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
        }, 300);
    }
    });


    if (removeAllButton) {
        removeAllButton.addEventListener('click', () => {
            productList.innerHTML = ''; 
            updateSubtotal();
        });
    }

    updateSubtotal();


    // 🗑️ --- ELIMINACIÓN DE RECIBOS (SIN PHP, ANIMADO) ---
    const botonesEliminarRecibo = document.querySelectorAll(".eliminar-recibo");

    botonesEliminarRecibo.forEach(boton => {
        boton.addEventListener("click", () => {
            const tarjeta = boton.closest(".tarjeta-recibo");
            tarjeta.classList.add("eliminando");

            setTimeout(() => {
                tarjeta.remove();
            }, 300);
        });
    });

});
