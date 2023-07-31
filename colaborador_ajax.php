<?php 
  include "conexion.php";
	include "funciones.php";
  $mensaje = "";
	session_start();
    
if(isset($_GET['guardar'])){
	$mensaje="<div class=\"alert alert-danger\" role=\"alert\">
			      <strong>Lo Sentimos!</strong> Se presento un error al guardar el registro.
			  </div>";
	//tomamos los parametros para almacenar la data
  $id  = $db->quote($_GET['identidad']);
  $nombre  = $db->quote($_GET['nombre']);
	$email  = $db->quote($_GET['email']);
	$telefono = $db->quote($_GET['telefono']);
	$direccion = $db->quote($_GET['direccion']);
	$idCargo = $db->quote($_GET['cargo']);
  $usuarioc = $_SESSION['id'];

  $query = "INSERT INTO colaboradores(id, nombreCompleto, email, telefono, direccion, idCargo, fechaCreacion, usuarioCreacion) values($id, $nombre,$email,$telefono, $direccion, $idCargo, NOW(),'$usuarioc')";

  //echo $query;

	$query = $db->prepare($query);
    $query->execute();
    $ultimo=0;
    $ultimo = $db->lastInsertId();
    if($ultimo!==0){
    	/*$query = $db->prepare("SELECT * from colaboradores where id = '$ultimo';");
    	$query->execute();
    	$datos = $query->fetch(PDO::FETCH_OBJ);*/
    	$mensaje="<div class=\"alert alert-success\" role=\"alert\">
      			      <strong>Exito!</strong> El registro de guardo sin problemas.
      			  </div>";
      registra_vitacora("Guardar", "Colaboradores", "$ultimo", $usuarioc);
//}
?>
  	<?php echo $mensaje;?>
             <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>Colaboradores</h2>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">ID</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="identidad" name="identidad" placeholder="0000-0000-00000" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Nombre completo</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="nombre" name="nombre" placeholder="Nombre del colaborador" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">E-MAIL</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="email" class="form-control input-sm" id="correo" name="correo" placeholder="example@perdomoyasociados.com" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Telefono</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="telefono" name="telefono" placeholder="Telefono del colaborador" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Dirección</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" id="direccion" name="direccion" class="form-control input-sm" placeholder="Dirección del colaborador" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Cargo</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idCargo", "tipocargos", "nombreTipo",1);?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int mg-t-15">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <button class="btn btn-success notika-btn-success" onclick="guardar();">Guardar</button>
                                        <button class="btn btn-danger notika-btn-success" onclick="cancelar();">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="normal-table-list">
                            <div class="basic-tb-hd">
                                <h2>Colaboradors en el sistema</h2>
                                <p>Colaboradores creados en el Sistema al día de hoy</p>
                            </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Numero Identidad</th>
                                            <th>Nombre Completo</th>
                                            <th>E-MAIL</th>
                                            <th>Telefono</th>
                                            <th>Dirección</th>
                                            <th>Cargo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT * FROM  colaboradores";
                                            //echo $consulta;
                                            $consulta = $db->prepare($consulta);
                                            //$consulta->bindValue(':activo',1);
                                            $consulta->execute();
                                            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
                                            $n=1;
                                            //var_dump($datos);
                                            foreach ($datos as $link => $row) {
                                                //echo "entro al for";
                                        ?>
                                        <tr class="">
                                            <td><?php echo $n;?></td>
                                            <td><?php echo $row["id"];?></td>
                                            <td><?php echo $row["nombreCompleto"];?></td>
                                            <td><?php echo $row["email"];?></td>
                                            <td><?php echo $row["telefono"];?></td>
                                            <td><?php echo $row["direccion"];?></td>
                                            <td><?php echo traduce_id($row["idCargo"],"tipocargos", "nombreTipo");?></td>
                                            <td>
                                                
                                            <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo('<?php  echo ($row['id']);?>');"><i class="notika-icon notika-edit"></i></a> 
                                <a class="btn btn-danger cyan-icon-notika btn-reco-mg btn-button-mg" title="Eliminar" onclick="eliminar_nombreTipo('<?php echo $row['id'];?>');" ><i class="notika-icon notika-close"></i></a>
                                            </td>
                                        </tr>  
                                        <?php $n++;}?>                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	<?php
	}
	//echo "metodo guardar;";
}//fin de guardar



if(isset($_GET['editar'])){
	$mensaje="<div class=\"alert alert-danger\" role=\"alert\">
            <strong>Lo Sentimos!</strong> Se presento un error al editar el registro.
        </div>";
	//tomamos los parametros para almacenar la data
	$id = $db->quote($_GET['id']);$nid = ($_GET['id']);$usuarioc = $_SESSION['id'];
    echo $id;
	$query = $db->prepare("SELECT * from colaboradores where id = $id;");
	$query->execute();
	$datos = $query->fetch(PDO::FETCH_OBJ);
//}
?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>Colaboradores</h2>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">ID</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="identidad" name="identidad" placeholder="0000-0000-00000" value="<?php echo $datos->id;?>" >
                                         
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Nombre completo</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="nombre" name="nombre" placeholder="Nombre del colaborador" value="<?php echo $datos->nombreCompleto;?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">E-MAIL</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="email" class="form-control input-sm" id="correo" name="correo" placeholder="example@perdomoyasociados.com" value="<?php echo $datos->email;?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Telefono</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="telefono" name="telefono" placeholder="Telefono del colaborador" value="<?php echo $datos->telefono;?> ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Dirección</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" id="direccion" name="direccion" class="form-control input-sm" placeholder="Dirección del colaborador" value="<?php echo $datos->direccion;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Cargo</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idCargo", "tipocargos", "nombreTipo",$datos->idCargo);?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int mg-t-15">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <button class="btn btn-success notika-btn-success" onclick="actualiza_nombreTipo();">Guardar</button>
                                        <button class="btn btn-danger notika-btn-success" onclick="cancelar();">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="normal-table-list">
                            <div class="basic-tb-hd">
                                <h2>Colaboradors en el sistema</h2>
                                <p>Colaboradores creados en el Sistema al día de hoy</p>
                            </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Numero Identidad</th>
                                            <th>Nombre Completo</th>
                                            <th>E-MAIL</th>
                                            <th>Telefono</th>
                                            <th>Dirección</th>
                                            <th>Cargo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT * FROM  colaboradores";
                                            //echo $consulta;
                                            $consulta = $db->prepare($consulta);
                                            //$consulta->bindValue(':activo',1);
                                            $consulta->execute();
                                            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
                                            $n=1;
                                            //var_dump($datos);
                                            foreach ($datos as $link => $row) {
                                                //echo "entro al for";
                                        ?>
                                        <tr class="">
                                            <td><?php echo $n;?></td>
                                            <td><?php echo $row["id"];?></td>
                                            <td><?php echo $row["nombreCompleto"];?></td>
                                            <td><?php echo $row["email"];?></td>
                                            <td><?php echo $row["telefono"];?></td>
                                            <td><?php echo $row["direccion"];?></td>
                                            <td><?php echo traduce_id($row["idCargo"],"tipocargos", "nombreTipo");?></td>
                                            <td>
                                                
                                <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo('<?php  echo ($row['id']);?>');"><i class="notika-icon notika-edit"></i></a>       
                                <a class="btn btn-danger cyan-icon-notika btn-reco-mg btn-button-mg" title="Eliminar" onclick="eliminar_nombreTipo(<?php echo $row['id'];?>);" ><i class="notika-icon notika-close"></i></a>
                                            </td>
                                        </tr>  
                                        <?php $n++;}?>                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	<?php
} // fin de editar



if(isset($_GET['actualizar'])){
	$mensaje="<div class=\"alert alert-danger\" role=\"alert\">
			      <strong>Lo Sentimos!</strong> Se presento un error al actualizar el registro.
			  </div>";
	//tomamos los parametros para almacenar la data
	$id  = $db->quote($_GET['identidad']); $nid = ($_GET['identidad']);
    $nombre  = $db->quote($_GET['nombre']);
	$email  = $db->quote($_GET['email']);
	$telefono = $db->quote($_GET['telefono']);
	$direccion = $db->quote($_GET['direccion']);
	$idCargo = $db->quote($_GET['cargo']);
    $usuarioc = $_SESSION['id'];
	$query = "
		UPDATE colaboradores set
        id = $id,
        nombreCompleto = $nombre,
		email = $email,
		telefono = $telefono, 
		direccion = $direccion, 
		idCargo = $idCargo, 
        fechaEdicion = NOW(),
        usuarioEdicion = $usuarioc
		where id = $id;
	";	
  //echo $query;

	  $query = $db->prepare($query);
    $query->execute();
    $filas = $query->rowCount();
    if($filas>0){
    	$query = $db->prepare("SELECT * from colaboradores where id = $id;");
    	$query->execute();
    	$datos = $query->fetch(PDO::FETCH_OBJ);
    	$mensaje="<div class=\"alert alert-success\" role=\"alert\">
			      <strong>Exito!</strong> El registro de actualizo sin problemas.
			  </div>";
      registra_vitacora("Actualizar", "Colaboradores", "$nid", $usuarioc);
//}
?>
 <div class="container-fluid py-4">
 	<?php echo $mensaje;?>
     <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>Colaboradores</h2>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">ID</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="identidad" name="identidad" placeholder="0000-0000-00000" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Nombre completo</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="nombre" name="nombre" placeholder="Nombre del colaborador" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">E-MAIL</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="email" class="form-control input-sm" id="correo" name="correo" placeholder="example@perdomoyasociados.com" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Telefono</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="telefono" name="telefono" placeholder="Telefono del colaborador" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Dirección</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" id="direccion" name="direccion" class="form-control input-sm" placeholder="Dirección del colaborador" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Cargo</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idCargo", "tipocargos", "nombreTipo",1);?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int mg-t-15">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <button class="btn btn-success notika-btn-success" onclick="guardar();">Guardar</button>
                                        <button class="btn btn-danger notika-btn-success" onclick="cancelar();">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="normal-table-list">
                            <div class="basic-tb-hd">
                                <h2>Colaboradors en el sistema</h2>
                                <p>Colaboradores creados en el Sistema al día de hoy</p>
                            </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Numero Identidad</th>
                                            <th>Nombre Completo</th>
                                            <th>E-MAIL</th>
                                            <th>Telefono</th>
                                            <th>Dirección</th>
                                            <th>Cargo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT * FROM  colaboradores";
                                            //echo $consulta;
                                            $consulta = $db->prepare($consulta);
                                            //$consulta->bindValue(':activo',1);
                                            $consulta->execute();
                                            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
                                            $n=1;
                                            //var_dump($datos);
                                            foreach ($datos as $link => $row) {
                                                //echo "entro al for";
                                        ?>
                                        <tr class="">
                                            <td><?php echo $n;?></td>
                                            <td><?php echo $row["id"];?></td>
                                            <td><?php echo $row["nombreCompleto"];?></td>
                                            <td><?php echo $row["email"];?></td>
                                            <td><?php echo $row["telefono"];?></td>
                                            <td><?php echo $row["direccion"];?></td>
                                            <td><?php echo traduce_id($row["idCargo"],"tipocargos", "nombreTipo");?></td>
                                            <td>
                                                
                                <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo('<?php  echo ($row['id']);?>');"><i class="notika-icon notika-edit"></i></a> 
                                <a class="btn btn-danger cyan-icon-notika btn-reco-mg btn-button-mg" title="Eliminar" onclick="eliminar_nombreTipo('<?php echo $row['id'];?>');" ><i class="notika-icon notika-close"></i></a>
                                            </td>
                                        </tr>  
                                        <?php $n++;}?>                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	<?php
	}
	//echo "metodo guardar;";
}//fin de actualizar

if(isset($_GET['activar'])){
	$mensaje="<div class=\"alert alert-danger\" role=\"alert\">
            <strong>Lo Sentimos!</strong> Se presento un error al activar el registro.
        </div>";
	//tomamos los parametros para almacenar la data
	$id = $db->quote($_GET['id']);$nid =($_GET['id']);$usuarioc = $_SESSION['id'];
	$query = $db->prepare("UPDATE colaboradores set activo = 1 where id = $id;");
	$query->execute();

      $mensaje="<div class=\"alert alert-success\" role=\"alert\">
            <strong>Exito!</strong> El registro de activo sin problemas.
        </div>";
      registra_vitacora("Activar", "Colaboradores", "$nid", $usuarioc);
//}
?>
 <div class="container-fluid py-4">  
  <?php echo $mensaje;?>
      <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-example-wrap mg-t-30">
                        <div class="cmp-tb-hd cmp-int-hd">
                            <h2>Tipos de Cargos del Sistema</h2>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Tipo de usuario</label>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control input-sm" id="nombreTipo" name="nombreTipo" placeholder="Nombre del tipo de usuario" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental mg-t-15">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Descripcion</label>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                            <input type="text" id="descripcion" name="descripcion" class="form-control input-sm" placeholder="Descripcion adicional del tipo de usuario" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Activo</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("activo", "activoinactivo", "estado",1);?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="form-example-int mg-t-15">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <button class="btn btn-success notika-btn-success" onclick="guarda_nombreTipo();">Guardar</button>
                                    <button class="btn btn-danger notika-btn-success" onclick="cancelar();">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="normal-table-list">
                        <div class="basic-tb-hd">
                            <h2>Tipos de Cargos Creados</h2>
                            <p>Tipos de Cargos creados en el Sistema al día de hoy</p>
                        </div>
                        <div class="bsc-tbl">
                            <table class="table table-sc-ex table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tipo de Usuario</th>
                                        <th>Observaciones</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $consulta = "SELECT * FROM colaboradores";
                                        //echo $consulta;
                                        $consulta = $db->prepare($consulta);
                                        //$consulta->bindValue(':activo',1);
                                        $consulta->execute();
                                        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
                                        $n=1;
                                        //var_dump($datos);
                                        foreach ($datos as $link => $row) {
                                            //echo "entro al for";
                                    ?>
                                    <tr class="">
                                        <td><?php echo $n;?></td>
                                        <td><?php echo $row["nombreTipo"];?></td>
                                        <td><?php echo $row["descripcion"];?></td>
                                        <td><?php echo traduce_id($row["activo"],"activoinactivo", "estado");?></td>
                                        <td>
                                            
                            <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo('<?php  echo ($row['id']);?>');"><i class="notika-icon notika-edit"></i></a>                             
                            
                            <a class="btn btn-danger cyan-icon-notika btn-reco-mg btn-button-mg" title="Eliminar" onclick="eliminar_nombreTipo(<?php echo $row['id'];?>);" ><i class="notika-icon notika-close"></i></a>
                                        </td>
                                    </tr>  
                                    <?php $n++;}?>                                      
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
	<?php
} // fin de activar

if(isset($_GET['desactivar'])){
  $mensaje="<div class=\"alert alert-danger\" role=\"alert\">
            <strong>Lo Sentimos!</strong> Se presento un error al activar el registro.
        </div>";
  //tomamos los parametros para almacenar la data
  $id = $db->quote($_GET['id']);$nid =($_GET['id']);$usuarioc = $_SESSION['id'];
  $query = $db->prepare("UPDATE colaboradores set activo = 2 where id = $id;");
  $query->execute();
  $query = $db->prepare("SELECT * FROM colaboradores where id = $id;");
  $query->execute();
  $datos = $query->fetch(PDO::FETCH_OBJ);

      $mensaje="<div class=\"alert alert-success\" role=\"alert\">
            <strong>Exito!</strong> El registro de desactivo sin problemas.
        </div>";
      
        registra_vitacora("Desactivar", "Colaboradores", "$nid", $usuarioc);
//}
?>
 <div class="container-fluid py-4">  
  <?php echo $mensaje;?>
      <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-example-wrap mg-t-30">
                        <div class="cmp-tb-hd cmp-int-hd">
                            <h2>Tipos de Cargos del Sistema</h2>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Tipo de usuario</label>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control input-sm" id="nombreTipo" name="nombreTipo" placeholder="Nombre del tipo de usuario" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental mg-t-15">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Descripcion</label>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                            <input type="text" id="descripcion" name="descripcion" class="form-control input-sm" placeholder="Descripcion adicional del tipo de usuario" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Activo</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("activo", "activoinactivo", "estado",1);?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="form-example-int mg-t-15">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <button class="btn btn-success notika-btn-success" onclick="guarda_nombreTipo();">Guardar</button>
                                    <button class="btn btn-danger notika-btn-success" onclick="cancelar();">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="normal-table-list">
                        <div class="basic-tb-hd">
                            <h2>Tipos de Cargos Creados</h2>
                            <p>Tipos de Cargos creados en el Sistema al día de hoy</p>
                        </div>
                        <div class="bsc-tbl">
                            <table class="table table-sc-ex table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tipo de Usuario</th>
                                        <th>Observaciones</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $consulta = "SELECT * FROM colaboradores";
                                        //echo $consulta;
                                        $consulta = $db->prepare($consulta);
                                        //$consulta->bindValue(':activo',1);
                                        $consulta->execute();
                                        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
                                        $n=1;
                                        //var_dump($datos);
                                        foreach ($datos as $link => $row) {
                                            //echo "entro al for";
                                    ?>
                                    <tr class="">
                                        <td><?php echo $n;?></td>
                                        <td><?php echo $row["nombreTipo"];?></td>
                                        <td><?php echo $row["descripcion"];?></td>
                                        <td><?php echo traduce_id($row["activo"],"activoinactivo", "estado");?></td>
                                        <td>
                                            
                            <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo('<?php  echo ($row['id']);?>');"><i class="notika-icon notika-edit"></i></a>                             
                            
                            <a class="btn btn-danger cyan-icon-notika btn-reco-mg btn-button-mg" title="Eliminar" onclick="eliminar_nombreTipo(<?php echo $row['id'];?>);" ><i class="notika-icon notika-close"></i></a>
                                        </td>
                                    </tr>  
                                    <?php $n++;}?>                                      
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
  <?php
}//fin de desactivar


if(isset($_GET['eliminar'])){
  $mensaje="<div class=\"alert alert-danger\" role=\"alert\">
            <strong>Lo Sentimos!</strong> Se presento un error al eliminar el registro.
        </div>";
  //tomamos los parametros para almacenar la data
  $id = $db->quote($_GET['id']);$nid =($_GET['id']);$usuarioc = $_SESSION['id'];
  $query = $db->prepare("DELETE FROM colaboradores where id = $id;");
  $query->execute();
  //$datos = $query->fetch(PDO::FETCH_OBJ);

      $mensaje="<div class=\"alert alert-success\" role=\"alert\">
            <strong>Exito!</strong> El registro de elimino sin problemas.
        </div>";
      //registra_vitacora("eliminar", "Tipo Cargos", $id, $usuarioc);
      registra_vitacora("Eliminar", "Colaboradores", "$nid", $usuarioc);

//}
?>
 <div class="container-fluid py-4">
  <?php echo $mensaje;?>
  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>Colaboradores</h2>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">ID</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="identidad" name="identidad" placeholder="0000-0000-00000" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Nombre completo</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="nombre" name="nombre" placeholder="Nombre del colaborador" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">E-MAIL</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="email" class="form-control input-sm" id="correo" name="correo" placeholder="example@perdomoyasociados.com" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Telefono</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="telefono" name="telefono" placeholder="Telefono del colaborador" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Dirección</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" id="direccion" name="direccion" class="form-control input-sm" placeholder="Dirección del colaborador" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Cargo</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idCargo", "tipocargos", "nombreTipo",1);?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int mg-t-15">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <button class="btn btn-success notika-btn-success" onclick="guardar();">Guardar</button>
                                        <button class="btn btn-danger notika-btn-success" onclick="cancelar();">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="normal-table-list">
                            <div class="basic-tb-hd">
                                <h2>Colaboradors en el sistema</h2>
                                <p>Colaboradores creados en el Sistema al día de hoy</p>
                            </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Numero Identidad</th>
                                            <th>Nombre Completo</th>
                                            <th>E-MAIL</th>
                                            <th>Telefono</th>
                                            <th>Dirección</th>
                                            <th>Cargo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT * FROM  colaboradores";
                                            //echo $consulta;
                                            $consulta = $db->prepare($consulta);
                                            //$consulta->bindValue(':activo',1);
                                            $consulta->execute();
                                            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
                                            $n=1;
                                            //var_dump($datos);
                                            foreach ($datos as $link => $row) {
                                                //echo "entro al for";
                                        ?>
                                        <tr class="">
                                            <td><?php echo $n;?></td>
                                            <td><?php echo $row["id"];?></td>
                                            <td><?php echo $row["nombreCompleto"];?></td>
                                            <td><?php echo $row["email"];?></td>
                                            <td><?php echo $row["telefono"];?></td>
                                            <td><?php echo $row["direccion"];?></td>
                                            <td><?php echo traduce_id($row["idCargo"],"tipocargos", "nombreTipo");?></td>
                                            <td>
                                                
                                <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo('<?php  echo ($row['id']);?>');"><i class="notika-icon notika-edit"></i></a> 
                                <a class="btn btn-danger cyan-icon-notika btn-reco-mg btn-button-mg" title="Eliminar" onclick="eliminar_nombreTipo('<?php echo $row['id'];?>');" ><i class="notika-icon notika-close"></i></a>
                                            </td>
                                        </tr>  
                                        <?php $n++;}?>                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
  <?php
} // fin de eliminar

?>