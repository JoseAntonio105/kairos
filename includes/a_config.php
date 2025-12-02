<?php
	switch ($_SERVER["SCRIPT_NAME"]) {
		case "/index.php":
			$CURRENT_PAGE = "index"; 
			$PAGE_TITLE = "Kairos - Tu página de claves";
			break;
		case "/conocenos.php":
			$CURRENT_PAGE = "conocenos"; 
			$PAGE_TITLE = "Conócenos";
			break;
		case "/trabaja_con_nosotros.php":
			$CURRENT_PAGE = "trabaja_con_nosotros"; 
			$PAGE_TITLE = "Trabaja con Nosotros";
			break;
		case "/terminos_condiciones.php":
			$CURRENT_PAGE = "terminos_condiciones"; 
			$PAGE_TITLE = "Términos y Condiciones";
			break;
		case "/plataformas.php":
			$CURRENT_PAGE = "plataformas"; 
			$PAGE_TITLE = "Plataformas";
			break;
		case "/steam.php":
			$CURRENT_PAGE = "steam"; 
			$PAGE_TITLE = "Kairos - Tu página de claves";
			break;
		case "/playstation.php":
			$CURRENT_PAGE = "playstation"; 
			$PAGE_TITLE = "Kairos - Tu página de claves";
			break;
		case "/xbox.php":
			$CURRENT_PAGE = "xbox"; 
			$PAGE_TITLE = "Kairos - Tu página de claves";
			break;
		case "/nintendo.php":
			$CURRENT_PAGE = "nintendo"; 
			$PAGE_TITLE = "Kairos - Tu página de claves";
			break;
		case "/soporte.php":
			$CURRENT_PAGE = "soporte"; 
			$PAGE_TITLE = "Soporte";
			break;
		case "/recibos.php":
			$CURRENT_PAGE = "recibos"; 
			$PAGE_TITLE = "Recibos";
			break;
		case "/devoluciones.php":
			$CURRENT_PAGE = "devoluciones"; 
			$PAGE_TITLE = "Devoluciones";
			break;
		case "/login.php":
			$CURRENT_PAGE = "login"; 
			$PAGE_TITLE = "Kairos - Tu página de claves";
			break;
		case "/registro.php":
			$CURRENT_PAGE = "registro"; 
			$PAGE_TITLE = "Kairos - Tu página de claves";
			break;
		// case "/carrito.php":
		// 	$CURRENT_PAGE = "carrito"; 
		// 	$PAGE_TITLE = "Carrito";
		// 	break;
		case "/zonapago.php":
			$CURRENT_PAGE = "zonapago"; 
			$PAGE_TITLE = "Zona de Pago";
			break;
		default:
			$CURRENT_PAGE = "index";
			$PAGE_TITLE = "Kairos - Tu página de claves";
	}
?>