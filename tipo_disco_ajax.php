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
  $nombreTipo  = $db->quote($_GET['nombreTipo']);
	$descripcion  = $db->quote($_GET['descripcion']);
  $usuarioc = $_SESSION['id'];

  $query = "INSERT INTO tipodisco(tipo, descripcion,  fechaCreacion, usuarioCreacion) values($nombreTipo, $descripcion, NOW(),'$usuarioc')";

  //echo $query;

	  $query = $db->prepare($query);
    $query->execute();
    $ultimo=0;
    $ultimo = $db->lastInsertId();
    if($ultimo>0){
    	/*$query = $db->prepare("SELECT * from tipodisco where id = '$ultimo';");
    	$query->execute();
    	$datos = $query->fetch(PDO::FETCH_OBJ);*/
    	$mensaje="<div class=\"alert alert-success\" role=\"alert\">
      			      <strong>Exito!</strong> El registro de guardo sin problemas.
      			  </div>";
      registra_vitacora("Guardar", "Tipo Disco", $ultimo, $usuarioc);
//}
?>
  	<?php echo $mensaje;?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>Tipos de disco</h2>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Tipo de disco</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="nombreTipo" name="nombreTipo" placeholder="Nombre del tipo de disco" required>
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
                                                <input type="text" id="descripcion" name="descripcion" class="form-control input-sm" placeholder="Descripcion adicional del tipo de disco" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental mg-t-15">
                                
                            </div>
                            <div class="form-example-int mg-t-15">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <button class="btn btn-success notika-btn-success" onclick="guarda_nombreTipo();">Guardar</button>
                                        <button class="btn btn-danger notika-btn-success">Cancelar</button>
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
                                <h2>Tipos de Discos Creados</h2>
                                <p>Tipos de Discos creados en el Sistema al día de hoy</p>
                            </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tipo de Disco</th>
                                            <th>Descripcion</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT * FROM tipodisco";
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
                                            <td><?php echo $row["tipo"];?></td>
                                            <td><?php echo $row["descripcion"];?></td>
                                            
                                            <td>
                                                
                                <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo(<?php echo $row['id'];?>);"><i class="notika-icon notika-edit"></i></a>                            
                                
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
	}
	//echo "metodo guardar;";
}//fin de guardar

if(isset($_GET['editar'])){
	$mensaje="<div class=\"alert alert-danger\" role=\"alert\">
            <strong>Lo Sentimos!</strong> Se presento un error al editar el registro.
        </div>";
	//tomamos los parametros para almacenar la data
	$id = $db->quote($_GET['id']);$nid = ($_GET['id']);$usuarioc = $_SESSION['id'];
	$query = $db->prepare("SELECT * from tipodisco where id = $id;");
	$query->execute();
	$datos = $query->fetch(PDO::FETCH_OBJ);
//}
?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>Tipos de disco</h2>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Tipo de disco</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="nombreTipo" name="nombreTipo" placeholder="Nombre del tipo de disco" value="<?php echo $datos->tipo;?>">
                                                <input type="hidden" name="id" id="id" value="<?php echo $datos->id;?>">
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
                                                <input type="text" id="descripcion" name="descripcion" class="form-control input-sm" placeholder="Descripcion adicional del tipo de disco" value="<?php echo $datos->descripcion;?>">
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
                                        <button class="btn btn-danger notika-btn-success">Cancelar</button>
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
                                <h2>Tipos de Discos Creados</h2>
                                <p>Tipos de Discos creados en el Sistema al día de hoy</p>
                            </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tipo de Disco</th>
                                            <th>Descripcion</th>
                                        
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT * FROM tipodisco";
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
                                            <td><?php echo $row["tipo"];?></td>
                                            <td><?php echo $row["descripcion"];?></td>
                                            
                                            <td>
                                                
                                <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo(<?php echo $row['id'];?>);"><i class="notika-icon notika-edit"></i></a>                            
                                
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
} // fin de editar

if(isset($_GET['actualizar'])){
	$mensaje="<div class=\"alert alert-danger\" role=\"alert\">
			      <strong>Lo Sentimos!</strong> Se presento un error al actualizar el registro.
			  </div>";
	//tomamos los parametros para almacenar la data
	$id = $db->quote($_GET['id']);$nid =($_GET['id']);$usuarioc = $_SESSION['id'];
  $nombreTipo = $db->quote($_GET['tipo']);
	$descripcion = $db->quote($_GET['descripcion']);
	$activo = $db->quote($_GET['activo']);
  $usuarioc = $_SESSION['id'];

	$query = "
		UPDATE tipodisco set
    nombreTipo = $nombreTipo,
		descripcion = $descripcion,
    fechaEdicion = NOW(),
    usuarioEdicion = $usuarioc
		where id = $id;
	";	
  //echo $query;

	  $query = $db->prepare($query);
    $query->execute();
    $filas = $query->rowCount();
    if($filas>0){
    	$query = $db->prepare("SELECT * from tipodisco where id = $id;");
    	$query->execute();
    	$datos = $query->fetch(PDO::FETCH_OBJ);
    	$mensaje="<div class=\"alert alert-success\" role=\"alert\">
			      <strong>Exito!</strong> El registro de actualizo sin problemas.
			  </div>";
      registra_vitacora("Actualizar", "Tipo Disco", $nid, $usuarioc);
//}
?>
 <div class="container-fluid py-4">
 	<?php echo $mensaje;?>
      <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-example-wrap mg-t-30">
                        <div class="cmp-tb-hd cmp-int-hd">
                            <h2>Tipos de disco</h2>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Tipo de disco</label>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control input-sm" id="nombreTipo" name="nombreTipo" placeholder="Nombre del tipo de disco" required>
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
                                            <input type="text" id="descripcion" name="descripcion" class="form-control input-sm" placeholder="Descripcion adicional del tipo de disco" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental mg-t-15">
                                
                            </div>
                        <div class="form-example-int mg-t-15">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <button class="btn btn-success notika-btn-success" onclick="guarda_nombreTipo();">Guardar</button>
                                    <button class="btn btn-danger notika-btn-success">Cancelar</button>
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
                            <h2>Tipos de Discos Creados</h2>
                            <p>Tipos de Discos creados en el Sistema al día de hoy</p>
                        </div>
                        <div class="bsc-tbl">
                            <table class="table table-sc-ex table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tipo de Disco</th>
                                        <th>Descripcion</th>
                                        
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $consulta = "SELECT * FROM tipodisco";
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
                                        <td><?php echo $row["tipo"];?></td>
                                        <td><?php echo $row["descripcion"];?></td>
                                        
                                        <td>
                                            
                            <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo(<?php echo $row['id'];?>);"><i class="notika-icon notika-edit"></i></a>                            
                            
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
	}
	//echo "metodo guardar;";
}//fin de actualizar

if(isset($_GET['activar'])){
	$mensaje="<div class=\"alert alert-danger\" role=\"alert\">
            <strong>Lo Sentimos!</strong> Se presento un error al activar el registro.
        </div>";
	//tomamos los parametros para almacenar la data
	$id = $db->quote($_GET['id']);$nid =($_GET['id']);$usuarioc = $_SESSION['id'];
	$query = $db->prepare("UPDATE tipodisco set activo = 1 where id = $id;");
	$query->execute();

      $mensaje="<div class=\"alert alert-success\" role=\"alert\">
            <strong>Exito!</strong> El registro de activo sin problemas.
        </div>";
      registra_vitacora("Activar", "Tipo Disco", $nid, $usuarioc);
//}
?>
 <div class="container-fluid py-4">  
  <?php echo $mensaje;?>
      <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-example-wrap mg-t-30">
                        <div class="cmp-tb-hd cmp-int-hd">
                            <h2>Tipos de disco</h2>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Tipo de disco</label>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control input-sm" id="nombreTipo" name="nombreTipo" placeholder="Nombre del tipo de disco" required>
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
                                            <input type="text" id="descripcion" name="descripcion" class="form-control input-sm" placeholder="Descripcion adicional del tipo de disco" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental mg-t-15">
                                <
                            </div>
                        <div class="form-example-int mg-t-15">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <button class="btn btn-success notika-btn-success" onclick="guarda_nombreTipo();">Guardar</button>
                                    <button class="btn btn-danger notika-btn-success">Cancelar</button>
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
                            <h2>Tipos de Discos Creados</h2>
                            <p>Tipos de Discos creados en el Sistema al día de hoy</p>
                        </div>
                        <div class="bsc-tbl">
                            <table class="table table-sc-ex table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tipo de Disco</th>
                                        <th>Descripcion</th>
                                        
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $consulta = "SELECT * FROM tipodisco";
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
                                        <td><?php echo $row["tipo"];?></td>
                                        <td><?php echo $row["descripcion"];?></td>
                                        
                                        <td>
                                            
                            <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo(<?php echo $row['id'];?>);"><i class="notika-icon notika-edit"></i></a>                            
                            
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
  $query = $db->prepare("UPDATE tipodisco set activo = 2 where id = $id;");
  $query->execute();
  $query = $db->prepare("SELECT * FROM tipodisco where id = $id;");
  $query->execute();
  $datos = $query->fetch(PDO::FETCH_OBJ);

      $mensaje="<div class=\"alert alert-success\" role=\"alert\">
            <strong>Exito!</strong> El registro de desactivo sin problemas.
        </div>";
      
        registra_vitacora("Desactivar", "Tipo Disco", $nid, $usuarioc);
//}
?>
 <div class="container-fluid py-4">  
  <?php echo $mensaje;?>
      <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-example-wrap mg-t-30">
                        <div class="cmp-tb-hd cmp-int-hd">
                            <h2>Tipos de disco</h2>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Tipo de disco</label>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control input-sm" id="nombreTipo" name="nombreTipo" placeholder="Nombre del tipo de disco" required>
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
                                            <input type="text" id="descripcion" name="descripcion" class="form-control input-sm" placeholder="Descripcion adicional del tipo de disco" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental mg-t-15">
                                
                            </div>
                        <div class="form-example-int mg-t-15">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <button class="btn btn-success notika-btn-success" onclick="guarda_nombreTipo();">Guardar</button>
                                    <button class="btn btn-danger notika-btn-success">Cancelar</button>
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
                            <h2>Tipos de Discos Creados</h2>
                            <p>Tipos de Discos creados en el Sistema al día de hoy</p>
                        </div>
                        <div class="bsc-tbl">
                            <table class="table table-sc-ex table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tipo de Disco</th>
                                        <th>Descripcion</th>
                                        
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $consulta = "SELECT * FROM tipodisco";
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
                                        <td><?php echo $row["tipo"];?></td>
                                        <td><?php echo $row["descripcion"];?></td>
                                        
                                        <td>
                                            
                            <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo(<?php echo $row['id'];?>);"><i class="notika-icon notika-edit"></i></a>                            
                            
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
  $query = $db->prepare("DELETE FROM tipodisco where id = $id;");
  $query->execute();
  //$datos = $query->fetch(PDO::FETCH_OBJ);

      $mensaje="<div class=\"alert alert-success\" role=\"alert\">
            <strong>Exito!</strong> El registro de elimino sin problemas.
        </div>";
      //registra_vitacora("eliminar", "Tipo Disco", $id, $usuarioc);
      registra_vitacora("Eliminar", "Tipo Disco", $nid, $usuarioc);

//}
?>
 <div class="container-fluid py-4">
  <?php echo $mensaje;?>
      <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-example-wrap mg-t-30">
                        <div class="cmp-tb-hd cmp-int-hd">
                            <h2>Tipos de disco</h2>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Tipo de disco</label>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control input-sm" id="nombreTipo" name="nombreTipo" placeholder="Nombre del tipo de disco" required>
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
                                            <input type="text" id="descripcion" name="descripcion" class="form-control input-sm" placeholder="Descripcion adicional del tipo de disco" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental mg-t-15">
                                
                            </div>
                        <div class="form-example-int mg-t-15">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <button class="btn btn-success notika-btn-success" onclick="guarda_nombreTipo();">Guardar</button>
                                    <button class="btn btn-danger notika-btn-success">Cancelar</button>
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
                            <h2>Tipos de Discos Creados</h2>
                            <p>Tipos de Discos creados en el Sistema al día de hoy</p>
                        </div>
                        <div class="bsc-tbl">
                            <table class="table table-sc-ex table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tipo de Disco</th>
                                        <th>Descripcion</th>
                                        
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $consulta = "SELECT * FROM tipodisco";
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
                                        <td><?php echo $row["tipo"];?></td>
                                        <td><?php echo $row["descripcion"];?></td>
                                        
                                        <td>
                                            
                            <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Editar " onclick="editar_nombreTipo(<?php echo $row['id'];?>);"><i class="notika-icon notika-edit"></i></a>                            
                            
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
} // fin de eliminar

?>