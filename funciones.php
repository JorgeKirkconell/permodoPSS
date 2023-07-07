<?php


function registra_vitacora($accion, $seccion, $referencia, $usuario){
	include "conexion.php";
	$q = "INSERT into vitacora(accion, entidad, identificador, idUsuario, fechaCreacion) values('$accion', '$seccion', '$referencia', '$usuario', NOW());";
	$query = $db->prepare($q);
    $query->execute();
}

function llena_combo($nombre, $tabla, $campo, $seleccionado=0, $campoid="id"){
	include "conexion.php";
	$q = "SELECT $campoid, $campo from $tabla";
	$query = $db->prepare($q);
    $query->execute();
    $datos = $query->fetchAll(PDO::FETCH_ASSOC);
	?>
	<select class="form-control" id="<?php echo $nombre;?>" name="<?php echo $nombre;?>">
		<option value="0">SELECCIONE UNO</option>
		<?php foreach ($datos as $link => $reg) {?>
        <option value="<?php echo $reg['id'];?>" <?php if($reg['id']==$seleccionado){echo "selected";}?>><?php echo $reg[$campo];?></option>
        <?php }?>                                
    </select>
	<?php
}

function traduce_id($valor,$tabla,$campo,$campoid="id"){
	include "conexion.php";
	//$mysqli= mysqli_connect("localhost","root","Blintec2019","blintec");
	//include "config.php";
	//$mysqli2 = mysqli_connect($server, $username, $password, $database);
	$query = "SELECT $campo from $tabla where $campoid='$valor'";
	$query = $db->prepare($query);
    $query->execute();
    $filas = $query->rowCount();
	if($filas>0){
		$datos = $query->fetch(PDO::FETCH_ASSOC);
		return $datos[$campo];
	}else{
		return "N/E";
	}

}


?>