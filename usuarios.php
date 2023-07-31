<div id="div_cambiante">
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
            </div>
            <script type="text/javascript">
                /*$(document).ready(function() { Baiz4pl.123
                    $('.buscador').select2();
                });*/

                function guardar(){
                  //alert("AGREGANDO usuario");
                  var form = document.getElementById('formulario');

// Check if the form is valid
        if (form.checkValidity()) {
            var url = "usuarios_ajax.php";
                                url += "?guardar=1";
                                url += "&idColaborador=" + document.getElementById("idColaborador").value;
                                url += "&usuario=" + document.getElementById("usuario").value;
                                url += "&contraseña=" + document.getElementById("contraseña").value;
                                url += "&idTipoUsuario=" + document.getElementById("idTipoUsuario").value;
                                url += "&estado=" + document.getElementById("activo").value;
                                //url += "&impuesto=" + document.getElementById("impuesto").value;

                                //alert(url);

                                var eldiv = "div_cambiante";
                                
                                //alert(url);
                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {                    
                                        document.getElementById(eldiv).innerHTML = this.responseText;
                                    }
                                };
                                xmlhttp.open("GET", url, true);
                                xmlhttp.send();
            } else {
                // If the form is not valid, show an error message or handle it as needed
                alert('Verifique que no haya campos vacios');
            }

                        
                        }

                function actualiza_nombreTipo(id){
                  //alert("actualizando USUARIO");
                    var url = "usuarios_ajax.php";
                        url += "?actualizar=1";
                        url += "&id=" + id;
                        url += "&idColaborador=" + document.getElementById("idColaborador").value;
                        url += "&usuario=" + document.getElementById("usuario").value;
                        url += "&contraseña=" + document.getElementById("contraseña").value;
                        url += "&idTipoUsuario=" + document.getElementById("idTipoUsuario").value;
                        url += "&estado=" + document.getElementById("activo").value;
                        

                        //alert(url);
                        var eldiv = "div_cambiante";
                        
                        //alert(url);
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {                    
                                document.getElementById(eldiv).innerHTML = this.responseText;
                            }
                        };
                        xmlhttp.open("GET", url, true);
                        xmlhttp.send();
                }

                function eliminar_nombreTipo(id){
                  //CONFIRMAMOS EL BORRADO ANTES DE HACERLO
                  if(confirm("¿Esta Seguro de eliminar el registro?")){
                      var url = "usuarios_ajax.php";
                        url += "?eliminar=1";
                        url += "&id=" + id;

                        //alert(url);

                        var eldiv = "div_cambiante";
                        
                        //alert(url);
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {                    
                                document.getElementById(eldiv).innerHTML = this.responseText;
                            }
                        };
                        xmlhttp.open("GET", url, true);
                        xmlhttp.send();
                  } 
                }

                function activar_nombreTipo(id, estado){
                  //alert(estado);
                  
                    var url = "usuarios_ajax.php";
                        if(estado == '2'){url += "?activar=1";}else{url += "?desactivar=1";}
                        url += "&id=" + id;
                        
                        var eldiv = "div_cambiante";
                        
                        //alert(url);
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {                    
                                document.getElementById(eldiv).innerHTML = this.responseText;
                            }
                        };
                        xmlhttp.open("GET", url, true);
                        xmlhttp.send();
                }

                function editar_nombreTipo(id){
                  //alert("Editanto USUARIO"+ id);
                //alert(id);
                
                    var url = "usuarios_ajax.php";
                        url += "?editar=1";
                        url += "&id=" + id;
                        //alert(url);

                        var eldiv = "div_cambiante";
                        
                        //alert(url);
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {                    
                                document.getElementById(eldiv).innerHTML = this.responseText;
                            }
                        };
                        xmlhttp.open("GET", url, true);
                        xmlhttp.send();
                }

                 function imprimir_nombreTipo(id){
                  //alert("Editanto USUARIO");
                  
                    window.open("nombreTipo_reportes.php?act=ficha&id="+id, "Imprimiendo ficha de usuario", "width=300, height=200")
                }

                function cancelar(){
                  //nos vamos al inicio
                  
                    window.location.href = "inicio.php?modulo=usuarios";
                }
             </script>