<?php

include "plantilla.php";
session_start();

if(!isset($_SESSION['id'])){
	header("Location: login.html");
}else{
    arriba();
    include "contenido.php";
    abajo();
}
?>