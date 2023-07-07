<?php

if(isset($_GET['modulo']) and $_GET['modulo']=="principal"){
	include "principal.php";
}else if(isset($_GET['modulo']) and $_GET['modulo']=="usuarios"){
	include "usuarios.php";
} else if(isset($_GET['modulo']) and $_GET['modulo']=="unidad_medida"){
	include "unidad_medida.php";
} else if(isset($_GET['modulo']) and $_GET['modulo']=="tipo_usuario"){
	include "tipo_usuario.php";
} else if(isset($_GET['modulo']) and $_GET['modulo']=="tipo_cargo"){
	include "tipo_cargo.php";
} else if(isset($_GET['modulo']) and $_GET['modulo']=="tipo_disco"){
	include "tipo_disco.php";
} else if(isset($_GET['modulo']) and $_GET['modulo']=="tipo_ram"){
	include "tipo_ram.php";
} else if(isset($_GET['modulo']) and $_GET['modulo']=="bitacora"){
	include "bitacora.php";
} else if(isset($_GET['modulo']) and $_GET['modulo']=="tipo_mantenimiento"){
	include "tipo_mantenimientos.php";
}	else if(isset($_GET['modulo']) and $_GET['modulo']=="unidadMedida"){
	include "unidad_medida.php";
}


else{
	//si la pagina no se encuentra nos enviara a esta de error
    include "404.php";
}

?>