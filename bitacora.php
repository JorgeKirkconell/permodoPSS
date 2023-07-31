<div id="div_cambiante">

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="normal-table-list">
                            <div class="basic-tb-hd">
                                <h2>Registros del sistema</h2>
                                <p>Registros del sistema realizados al día de hoy</p>
                            </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex table-hover">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Fecha de acción</th>
                                            <th>Usuario</th>
                                            <th>Entidad</th>
                                            <th>Identificador</th>
                                            <th>Acción</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include "conexion.php";
                                            $consulta = "SELECT * FROM vitacora";
                                            //echo $consulta;
                                            $consulta = $db->prepare($consulta);
                                            //$consulta->bindValue(':activo',1);
                                            $consulta->execute();
                                            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
                                            $datosPRUEBA = array_reverse($datos);
                                            $n=1;
                                            //var_dump($datos);
                                            foreach ($datosPRUEBA as $link => $row) {
                                                //echo "entro al for";
                                        ?>
                                        <tr class="">
                                        <td><?php echo $n;?></td>
                                        <td><?php echo $row["fechaCreacion"];?></td>
                                            <td><?php echo traduce_id($row["idUsuario"],"usuarios", "usuarios");?></td>
                                            <td><?php echo $row["entidad"];?></td>
                                            <td><?php echo $row["identificador"];?></td>
                                            <td><?php echo $row["accion"];?></td>
                                            
                                            
                                        </tr>  
                                        <?php $n++;}?>                                      
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

                function guarda_nombreTipo(){
                  //alert("AGREGANDO usuario");
                    var url = "tipo_ram_ajax.php";
                        url += "?guardar=1";
                        url += "&nombreTipo=" + document.getElementById("tipo").value;
                        url += "&descripcion=" + document.getElementById("descripcion").value;
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
                }

                function actualiza_nombreTipo(){
                  //alert("actualizando USUARIO");
                    var url = "tipo_ram_ajax.php";
                        url += "?actualizar=1";
                        url += "&id=" + document.getElementById("id").value;
                        url += "&nombreTipo=" + document.getElementById("tipo").value;
                        url += "&descripcion=" + document.getElementById("descripcion").value;

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
                      var url = "tipo_ram_ajax.php";
                        url += "?eliminar=1";
                        url += "&id=" + id;
                        
                        //url += "&descuento=" + document.getElementById("descuento").value;
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
                  } 
                }

                function activar_nombreTipo(id, estado){
                  //alert(estado);
                  
                    var url = "tipo_ram_ajax.php";
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
                  //alert("Editanto USUARIO");
                  
                    var url = "tipo_ram_ajax.php";
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
                  
                    window.location.href = "inicio.php?modulo=principal";
                }
             </script>