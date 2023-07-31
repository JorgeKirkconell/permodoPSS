<?php 
require_once "conexion.php";

$mensaje="";
if(isset($_POST['usuario']) and isset($_POST['clave'])){
    $usuario =$db->quote($_POST['usuario']);
    $clave =$db->quote($_POST['clave']);

    //$password = md5($password); //encriptamos el password para buscarlo en la base de datos
   
    //echo "SELECT * from usuarios where usuarios = $usuario and clave =$clave;";

    $query = $db->prepare("SELECT * from usuarios where usuarios = $usuario and clave =$clave;");
    $query->execute();
    $filas = $query->rowCount();
    //echo $filas;
    if($filas){//si se encontraron filas
        echo $filas;
        //$datos = mysqli_fetch_assoc($res);
        $datos = $query->fetch(PDO::FETCH_OBJ);
        echo $datos->usuarios;
        if($datos->activo==0){
            
            $mensaje = "<div class=\"alert alert-danger\" role=\"alert\">
                            <b>Lo sentimos ".$datos->nombre."!</b><br>
                            Su cuenta aun no ha sido activada. Pongase en contacto con el administrador.
                        </div>";
             header("Location: cuentainactiva.php"); //no activo           
        }else{
            session_start();
            $_SESSION['id']   = $datos->id;
            $_SESSION['usuario']  = $datos->usuarios;
            $_SESSION['perfil'] = $datos->idTipoUsuario;}

            //$_SESSION['id_obra'] = $datos['id_obra']; 61ed3d9a32717a1f68726f29a4b0a48e

            $query = "INSERT INTO vitacora(idUsuario,entidad,identificador,accion,fechaCreacion) values('".$datos->id."','Login','".$datos->id."','Inicio de sesión',NOW());";
            $query = $db->prepare($query);
            $query->execute();
            $filas = $query->rowCount();
            if ($filas<1) {
              header("Location: errorvitacora.php");
            }
          
            header("Location: inicio.php?modulo=principal");
        }
    }else{
        header("Location: usuarioincorrecto.php");}
        exit;

?>