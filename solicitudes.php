


<div id="div_cambiante">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-example-wrap mg-t-30">
                            <div class="cmp-tb-hd cmp-int-hd">
                                <h2>Solicitudes</h2>
                            </div>
                            <form id="formulario">
                            
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Usuario Solicitante</label>
                                        </div>
                                        <div class="col-lg-3 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="solicitante" name="solicitante" placeholder="username" value="<?php echo traduce_id($_SESSION['id'],"usuarios", "usuarios")?>" disabled required>
                                            </div>
                                        </div>
                                    
                           
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Tipo de prestamo</label>
                                        </div>
                                        <div class="col-lg-3 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idTipoPrestamo", "tipoprestamo", "nombreTipo","1");?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental mg-t-15">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Equipo</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="bootstrap-select fm-cmp-mg">
                                                <?php llena_combo("idEquipo", "equipos", "nombre","0");?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Fecha de inicio</label>
                                        </div>
                                        <div class="col-lg-3 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="date" class="form-control input-sm" id="fechaInicio" name="fechaInicio"  required>
                                            </div>
                                        </div>
                                    
                           
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Fecha final</label>
                                        </div>
                                        <div class="col-lg-3 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="date" class="form-control input-sm" id="fechaFinal" name="fechaFinal"  required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Estado</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="estado" name="estado" placeholder="username" value="<?php echo traduce_id(2,"estadocotizaciones", "estado")?>" disabled required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                            <label class="hrzn-fm">Solicitud revisada por</label>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="usuarioRevision"  name="usuarioRevision" placeholder="ESPERE LA REVISIÓN DEL EQUIPO DE IT" disabled>
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
                                <h2>Solicitudes en el sistema</h2>
                                <p>Solicitudes creadas en el Sistema al día de hoy</p>
                            </div>
                            <div class="bsc-tbl">
                                <table class="table table-sc-ex table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Solicitante</th>
                                            <th>Equipo solicitado</th>
                                            <th>Fecha de inicio</th>
                                            <th>Fecha final</th>
                                            <th>Tipo Prestamo</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT * FROM  solicitudes";
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
                                            <td><?php echo traduce_id($row["IdSolicitante"],"usuarios", "usuarios");?></td>
                                            <td><?php echo traduce_id($row["idEquipo"],"equipos", "nombre");?></td>
                                            <td><?php echo $row["fechaInicio"];?></td>
                                            <td><?php echo $row["fechaFinal"];?></td>
                                            <td><?php echo traduce_id($row["idTipoPrestamo"],"tipoprestamo", "nombreTipo");?></td>
                                            <td><?php echo traduce_id($row["estado"],"estadocotizaciones", "estado");?></td>
                                            
                                            <td>
                                <a class="btn btn-info info-icon-notika btn-reco-mg btn-button-mg" title="Revisar solicitud " onclick=""><i class="notika-icon notika-edit"></i></a> 
                                
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
            var url = "cotizaciones_ajax.php";
                                url += "?guardar=1";
                                url += "&solicitante=" + document.getElementById("solicitante").value;
                                url += "&subtotal=" + document.getElementById("subtotal").value;
                                url += "&isv=" + document.getElementById("isv").value;
                                url += "&total=" + document.getElementById("total").value;
                                url += "&proveedor=" + document.getElementById("proveedor").value;
                                url += "&estado=" + document.getElementById("estado").value;
                                url += "&observacion=" + document.getElementById("observacion").value;

                                
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
                alert('Verifique que los campos requeridos no estén vacios');
            }

                        
                        }

                function actualiza_nombreTipo(id){
                  //alert("Hola")
                    var url = "cotizaciones_ajax.php";
                        url += "?actualizar=1";
                        url += "&id=" + id;
                                url += "&solicitante=" + document.getElementById("solicitante").value;
                                url += "&subtotal=" + document.getElementById("subtotal").value;
                                url += "&isv=" + document.getElementById("isv").value;
                                url += "&total=" + document.getElementById("total").value;
                                url += "&proveedor=" + document.getElementById("proveedor").value;
                                url += "&estado=" + document.getElementById("estado").value;
                                url += "&observacion=" + document.getElementById("observacion").value;
                                

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
                      var url = "cotizaciones_ajax.php";
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
                  
                    var url = "cotizaciones_ajax.php";
                        if(estado == '2' || estado == '3'){url += "?activar=1";}else{url += "?desactivar=1";}
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
                
                    var url = "cotizaciones_ajax.php";
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
                  
                    window.location.href = "inicio.php?modulo=cotizaciones";
                }
             </script>

<script>
    // Obtenemos los elementos de los campos de entrada
    const subtotalInput = document.getElementById('subtotal');
    const isvInput = document.getElementById('isv');
    const totalInput = document.getElementById('total');

    // Creamos una función para actualizar el campo "Total"
    function actualizarTotal() {
        // Obtenemos los valores de los campos "ISV" y "SubTotal"
        const subtotal = parseFloat(subtotalInput.value) || 0; // Si no se ingresa ningún valor, consideramos 0
        const isv = parseFloat(isvInput.value) || 0;

        // Realizamos la suma
        const total = subtotal + isv;

        // Actualizamos el valor del campo "Total" con el resultado
        totalInput.value = total.toFixed(2); // Mostramos solo dos decimales
    }

    // Agregamos los controladores de eventos "input" a los campos "ISV" y "SubTotal"
    subtotalInput.addEventListener('input', actualizarTotal);
    isvInput.addEventListener('input', actualizarTotal);
</script>