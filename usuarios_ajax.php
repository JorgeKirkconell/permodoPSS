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
    $usuario  = $db->quote($_GET['usuario']);
    $contraseña = $db->quote($_GET['contraseña']);
	$idColaborador = $db->quote($_GET['idColaborador']);
	$idTipoUsuario = $db->quote($_GET['idTipoUsuario']);
	$activo = $db->quote($_GET['estado']);
  $usuarioc = $_SESSION['id'];

  $query = "INSERT INTO usuarios(idColaborador, usuarios, clave, idTipoUsuario, activo,fechaCreacion, usuarioCreacion) values($idColaborador,$usuario ,MD5($contraseña) ,$idTipoUsuario, $activo, NOW(),'$usuarioc')";

  //echo $query;

	  $query = $db->prepare($query);
    $query->execute();
    $ultimo=0;
    $ultimo = $db->lastInsertId();
    if($ultimo>0){
    	/*$query = $db->prepare("SELECT * from usuarios where id = '$ultimo';");
    	$query->execute();
    	$datos = $query->fetch(PDO::FETCH_OBJ);*/
    	$mensaje="<div class=\"alert alert-success\" role=\"alert\">
      			      <strong>Exito!</strong> El registro de guardo sin problemas.
      			  </div>";
      registra_vitacora("Guardar", "Usuarios", $ultimo, $usuarioc);
//}
?>
  	<?php echo $mensaje;?>
      <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>Usuarios</h2>
                            </div>
                            <form id="formulario">
                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Pertenece a</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idColaborador", "colaboradores", "nombreCompleto","0000-0000-00000");?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Usuario</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="usuario" name="usuario" placeholder="Usuario" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Contraseña</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="password" class="form-control input-sm" id="contraseña" name="contraseña" placeholder="············" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Tipo de usuario</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idTipoUsuario", "tipoUsuarios", "nombreTipo",7);?>
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
                            
                           
                            </form>
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
                                <h2>Usuarios en el sistema</h2>
                                <p>Usuarios creados en el Sistema al día de hoy</p>
                            </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pertence a</th>
                                            <th>Username</th>
                                            <th>Tipo Usuario</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT * FROM  usuarios";
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
                                            <td><?php echo traduce_id($row["idColaborador"],"colaboradores", "nombreCompleto");?></td>
                                            <td><?php echo $row["usuarios"];?></td>
                                            <td><?php echo traduce_id($row["idTipoUsuario"],"tipousuarios", "nombreTipo");?></td>
                                            <td><?php echo traduce_id($row["activo"],"activoinactivo", "estado");?></td>
                                            <td>
                                               
                                <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo('<?php  echo ($row['id']);?>');"><i class="notika-icon notika-edit"></i></a> 
                                <a class="btn btn-warning cyan-icon-notika btn-reco-mg btn-button-mg" title="Activar / Desactivar" onclick="activar_nombreTipo(<?php echo $row['id'].",".$row['activo'];?>);"><i class="notika-icon notika-checked"></i></a>
                                <a class="btn btn-danger cyan-icon-notika btn-reco-mg btn-button-mg" title="Eliminar" onclick="eliminar_nombreTipo('<?php echo $row['id'];?>');" ><i class="notika-icon notika-close"></i></a>
                                            </td>
                                        </tr>  
                                        <?php $n++;} ?>                                      
                                    </tbody>
                                </table>
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
	$query = $db->prepare("SELECT * from usuarios where id = $id;");
	$query->execute();
	$datos = $query->fetch(PDO::FETCH_OBJ);
//}
?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>Usuarios</h2>
                            </div>
                            <form id="formulario">
                            
                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Pertenece a</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idColaborador", "colaboradores", "nombreCompleto",$datos->idColaborador);?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Usuario</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo $datos->usuarios;?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Contraseña</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="password" class="form-control input-sm" id="contraseña" name="contraseña" placeholder="" value="<?php echo $datos->clave;?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Tipo de usuario</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idTipoUsuario", "tipoUsuarios", "nombreTipo",$datos->idTipoUsuario);?>
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
                                                <?php llena_combo("activo", "activoinactivo", "estado",$datos->activo);?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                           
                            </form>
                            <div class="form-example-int mg-t-15">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <button class="btn btn-success notika-btn-success" onclick="actualiza_nombreTipo(<?php echo $datos->id;?>);">Guardar</button>
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
                                <h2>Usuarios en el sistema</h2>
                                <p>Usuarios creados en el Sistema al día de hoy</p>
                            </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pertence a</th>
                                            <th>Username</th>
                                            <th>Tipo Usuario</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT * FROM  usuarios";
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
                                            <td><?php echo traduce_id($row["idColaborador"],"colaboradores", "nombreCompleto");?></td>
                                            <td><?php echo $row["usuarios"];?></td>
                                            <td><?php echo traduce_id($row["idTipoUsuario"],"tipousuarios", "nombreTipo");?></td>
                                            <td><?php echo traduce_id($row["activo"],"activoinactivo", "estado");?></td>
                                            <td>
                                               
                                <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo('<?php  echo ($row['id']);?>');"><i class="notika-icon notika-edit"></i></a> 
                                <a class="btn btn-warning cyan-icon-notika btn-reco-mg btn-button-mg" title="Activar / Desactivar" onclick="activar_nombreTipo(<?php echo $row['id'].",".$row['activo'];?>);"><i class="notika-icon notika-checked"></i></a>
                                <a class="btn btn-danger cyan-icon-notika btn-reco-mg btn-button-mg" title="Eliminar" onclick="eliminar_nombreTipo('<?php echo $row['id'];?>');" ><i class="notika-icon notika-close"></i></a>
                                            </td>
                                        </tr>  
                                        <?php $n++;} ?>                                      
                                    </tbody>
                                </table>
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
    $id  = $db->quote($_GET['id']); $nid = ($_GET['id']);
	//tomamos los parametros para almacenar la data
	$usuario  = $db->quote($_GET['usuario']);
    $contraseña = $db->quote($_GET['contraseña']);
	$idColaborador = $db->quote($_GET['idColaborador']);
	$idTipoUsuario = $db->quote($_GET['idTipoUsuario']);
	$activo = $db->quote($_GET['estado']);
    $usuarioc = $_SESSION['id'];

	$query = "
		UPDATE usuarios set
        idColaborador = $idColaborador,
        usuarios = $usuario,
		clave = $contraseña,
        idTipoUsuario = $idTipoUsuario,
		activo = $activo, 
        fechaEdicion = NOW(),
        usuarioEdicion = $usuarioc
		where id = $id;
	";	
  //echo $query;

	  $query = $db->prepare($query);
    $query->execute();
    $filas = $query->rowCount();
    if($filas>0){
    	$query = $db->prepare("SELECT * from usuarios where id = $id;");
    	$query->execute();
    	$datos = $query->fetch(PDO::FETCH_OBJ);
    	$mensaje="<div class=\"alert alert-success\" role=\"alert\">
			      <strong>Exito!</strong> El registro de actualizo sin problemas.
			  </div>";
      registra_vitacora("Actualizar", "Usuarios", $nid, $usuarioc);
//}
?>
 <div class="container-fluid py-4">
 	<?php echo $mensaje;?>
     <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>Usuarios</h2>
                            </div>
                            <form id="formulario">
                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Pertenece a</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idColaborador", "colaboradores", "nombreCompleto","0000-0000-00000");?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Usuario</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="usuario" name="usuario" placeholder="Usuario" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Contraseña</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="password" class="form-control input-sm" id="contraseña" name="contraseña" placeholder="············" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Tipo de usuario</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idTipoUsuario", "tipoUsuarios", "nombreTipo",7);?>
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
                            
                           
                            </form>
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
                                <h2>Usuarios en el sistema</h2>
                                <p>Usuarios creados en el Sistema al día de hoy</p>
                            </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pertence a</th>
                                            <th>Username</th>
                                            <th>Tipo Usuario</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT * FROM  usuarios";
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
                                            <td><?php echo traduce_id($row["idColaborador"],"colaboradores", "nombreCompleto");?></td>
                                            <td><?php echo $row["usuarios"];?></td>
                                            <td><?php echo traduce_id($row["idTipoUsuario"],"tipousuarios", "nombreTipo");?></td>
                                            <td><?php echo traduce_id($row["activo"],"activoinactivo", "estado");?></td>
                                            <td>
                                               
                                <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo('<?php  echo ($row['id']);?>');"><i class="notika-icon notika-edit"></i></a> 
                                <a class="btn btn-warning cyan-icon-notika btn-reco-mg btn-button-mg" title="Activar / Desactivar" onclick="activar_nombreTipo(<?php echo $row['id'].",".$row['activo'];?>);"><i class="notika-icon notika-checked"></i></a>
                                <a class="btn btn-danger cyan-icon-notika btn-reco-mg btn-button-mg" title="Eliminar" onclick="eliminar_nombreTipo('<?php echo $row['id'];?>');" ><i class="notika-icon notika-close"></i></a>
                                            </td>
                                        </tr>  
                                        <?php $n++;} ?>                                      
                                    </tbody>
                                </table>
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
	$id = $db->quote($_GET['id']);$usuarioc = $_SESSION['id'];
    $nid = ($_GET['id']);
	$query = $db->prepare("UPDATE usuarios set activo = 1 where id = $id;");
	$query->execute();

      $mensaje="<div class=\"alert alert-success\" role=\"alert\">
            <strong>Exito!</strong> El registro de activo sin problemas.
        </div>";
      registra_vitacora("Activar", "Usuarios", $nid, $usuarioc);
//}
?>
 <div class="container-fluid py-4">  
  <?php echo $mensaje;?>
  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>Usuarios</h2>
                            </div>
                            <form id="formulario">
                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Pertenece a</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idColaborador", "colaboradores", "nombreCompleto","0000-0000-00000");?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Usuario</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="usuario" name="usuario" placeholder="Usuario" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Contraseña</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="password" class="form-control input-sm" id="contraseña" name="contraseña" placeholder="············" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Tipo de usuario</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idTipoUsuario", "tipoUsuarios", "nombreTipo",7);?>
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
                            
                           
                            </form>
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
                                <h2>Usuarios en el sistema</h2>
                                <p>Usuarios creados en el Sistema al día de hoy</p>
                            </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pertence a</th>
                                            <th>Username</th>
                                            <th>Tipo Usuario</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT * FROM  usuarios";
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
                                            <td><?php echo traduce_id($row["idColaborador"],"colaboradores", "nombreCompleto");?></td>
                                            <td><?php echo $row["usuarios"];?></td>
                                            <td><?php echo traduce_id($row["idTipoUsuario"],"tipousuarios", "nombreTipo");?></td>
                                            <td><?php echo traduce_id($row["activo"],"activoinactivo", "estado");?></td>
                                            <td>
                                               
                                <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo('<?php  echo ($row['id']);?>');"><i class="notika-icon notika-edit"></i></a> 
                                <a class="btn btn-warning cyan-icon-notika btn-reco-mg btn-button-mg" title="Activar / Desactivar" onclick="activar_nombreTipo(<?php echo $row['id'].",".$row['activo'];?>);"><i class="notika-icon notika-checked"></i></a>
                                <a class="btn btn-danger cyan-icon-notika btn-reco-mg btn-button-mg" title="Eliminar" onclick="eliminar_nombreTipo('<?php echo $row['id'];?>');" ><i class="notika-icon notika-close"></i></a>
                                            </td>
                                        </tr>  
                                        <?php $n++;} ?>                                      
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
  $id = $db->quote($_GET['id']);$usuarioc = $_SESSION['id'];
  $nid = ($_GET['id']);
  $query = $db->prepare("UPDATE usuarios set activo = 2 where id = $id;");
  $query->execute();
  $query = $db->prepare("SELECT * FROM usuarios where id = $id;");
  $query->execute();
  $datos = $query->fetch(PDO::FETCH_OBJ);

      $mensaje="<div class=\"alert alert-success\" role=\"alert\">
            <strong>Exito!</strong> El registro de desactivo sin problemas.
        </div>";
      registra_vitacora("Desactivar", "Usuarios", $nid, $usuarioc);
//}
?>
 <div class="container-fluid py-4">  
  <?php echo $mensaje;?>
  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>Usuarios</h2>
                            </div>
                            <form id="formulario">
                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Pertenece a</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idColaborador", "colaboradores", "nombreCompleto","0000-0000-00000");?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Usuario</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="usuario" name="usuario" placeholder="Usuario" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Contraseña</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="password" class="form-control input-sm" id="contraseña" name="contraseña" placeholder="············" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Tipo de usuario</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idTipoUsuario", "tipoUsuarios", "nombreTipo",7);?>
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
                            
                           
                            </form>
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
                                <h2>Usuarios en el sistema</h2>
                                <p>Usuarios creados en el Sistema al día de hoy</p>
                            </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pertence a</th>
                                            <th>Username</th>
                                            <th>Tipo Usuario</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT * FROM  usuarios";
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
                                            <td><?php echo traduce_id($row["idColaborador"],"colaboradores", "nombreCompleto");?></td>
                                            <td><?php echo $row["usuarios"];?></td>
                                            <td><?php echo traduce_id($row["idTipoUsuario"],"tipousuarios", "nombreTipo");?></td>
                                            <td><?php echo traduce_id($row["activo"],"activoinactivo", "estado");?></td>
                                            <td>
                                               
                                <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo('<?php  echo ($row['id']);?>');"><i class="notika-icon notika-edit"></i></a> 
                                <a class="btn btn-warning cyan-icon-notika btn-reco-mg btn-button-mg" title="Activar / Desactivar" onclick="activar_nombreTipo(<?php echo $row['id'].",".$row['activo'];?>);"><i class="notika-icon notika-checked"></i></a>
                                <a class="btn btn-danger cyan-icon-notika btn-reco-mg btn-button-mg" title="Eliminar" onclick="eliminar_nombreTipo('<?php echo $row['id'];?>');" ><i class="notika-icon notika-close"></i></a>
                                            </td>
                                        </tr>  
                                        <?php $n++;} ?>                                      
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
  $id = $db->quote($_GET['id']);$usuarioc = $_SESSION['id'];
  $nid = ($_GET['id']);
  $query = $db->prepare("DELETE FROM usuarios where id = $id;");
  $query->execute();
  //$datos = $query->fetch(PDO::FETCH_OBJ);

      $mensaje="<div class=\"alert alert-success\" role=\"alert\">
            <strong>Exito!</strong> El registro de elimino sin problemas.
        </div>";
      registra_vitacora("Eliminar", "Usuarios", $nid, $usuarioc);
//}
?>
 <div class="container-fluid py-4">
  <?php echo $mensaje;?>
      
  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>Usuarios</h2>
                            </div>
                            <form id="formulario">
                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Pertenece a</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idColaborador", "colaboradores", "nombreCompleto","0000-0000-00000");?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Usuario</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="usuario" name="usuario" placeholder="Usuario" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Contraseña</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="password" class="form-control input-sm" id="contraseña" name="contraseña" placeholder="············" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Tipo de usuario</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idTipoUsuario", "tipoUsuarios", "nombreTipo",7);?>
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
                            
                           
                            </form>
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
                                <h2>Usuarios en el sistema</h2>
                                <p>Usuarios creados en el Sistema al día de hoy</p>
                            </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pertence a</th>
                                            <th>Username</th>
                                            <th>Tipo Usuario</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT * FROM  usuarios";
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
                                            <td><?php echo traduce_id($row["idColaborador"],"colaboradores", "nombreCompleto");?></td>
                                            <td><?php echo $row["usuarios"];?></td>
                                            <td><?php echo traduce_id($row["idTipoUsuario"],"tipousuarios", "nombreTipo");?></td>
                                            <td><?php echo traduce_id($row["activo"],"activoinactivo", "estado");?></td>
                                            <td>
                                               
                                <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo('<?php  echo ($row['id']);?>');"><i class="notika-icon notika-edit"></i></a> 
                                <a class="btn btn-warning cyan-icon-notika btn-reco-mg btn-button-mg" title="Activar / Desactivar" onclick="activar_nombreTipo(<?php echo $row['id'].",".$row['activo'];?>);"><i class="notika-icon notika-checked"></i></a>
                                <a class="btn btn-danger cyan-icon-notika btn-reco-mg btn-button-mg" title="Eliminar" onclick="eliminar_nombreTipo('<?php echo $row['id'];?>');" ><i class="notika-icon notika-close"></i></a>
                                            </td>
                                        </tr>  
                                        <?php $n++;} ?>                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
  <?php
} // fin de eliminar

?>