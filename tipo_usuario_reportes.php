<?php
session_start();

require_once "conexion.php";
require_once "funciones.php";
require_once "mc_table.php";
//require_once "../../classes/funciones.php";
//$connect= mysqli_connect("localhost","root","","blintec");

if ($_GET['act']=='todos') {
        
        $fecha = date("d-m-Y H:i:s");
        $pdf = new PDF_MC_Table('L','mm','Letter'); //Creamos un objeto de la librería
        $pdf->AddPage(); //Agregamos una Pagina        
        $pdf->SetAuthor('MGVHN');
        $pdf->SetTitle('Tipos de Usuario del sistema a la fecha');
        //encabezado de la Hoja -------------------------------------------------------------------------->>>>>>>>>
        $pdf->SetMargins(20, 20, 20, false); 
        $pdf->SetAutoPageBreak(true, 20); 
        $pdf->SetFont('helvetica', 'B', 22);
        $pdf->Image('assets/img/dmc_logo.png',20,5,25);
        //$pdf->Image('../../images/marcadeaguablintec.png',30,100,180);
        $pdf->Cell(0,0,'    Tipos de Usuario del Sistema',0,1,'C');//titulo principal de la hoja
        $pdf->Ln(4);
        $pdf->SetFont('helvetica', 'B', 16); //tipo de letra y negrita con la B
        $pdf->Cell(0,10,traduce_id($_SESSION['id_empresa'],"empresas","nombre"),0,1,'C'); //subtitulo de la hoja
        $pdf->Cell(0,6,traduce_id($_SESSION['id_sucursal'],"sucursales","nombre"),0,1,'C'); 
        $pdf->SetFont('courier', 'B', 12); //tipo de letra y negrita con la B//subtitulo de la hoja
        $pdf->Cell(0,6,$fecha,0,1,'R'); //subtitulo de la hoja
        $pdf->Image('assets/img/linea.png',12,36,255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetMargins(20, 20, 20, false);  
        $pdf->Ln(10);
       
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetMargins(12, 5); 
        $pdf->Ln(10);
        $pdf->SetFillColor(200, 200, 200);
        
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(15,6,'No.',1,0,'C',1);
        $pdf->Cell(60,6,utf8_decode('Tipo de Usuario'),1,0,'C',1);
        $pdf->Cell(40,6,utf8_decode('Activo / Inactivo'),1,0,'C',1);
        $pdf->Cell(40,6,utf8_decode('Fecha de Creación'),1,0,'C',1);
        
        $pdf->SetFont('helvetica', '', 10);
        $num = 1;
        //consultas de datos -------------------------------------------------------------------------------->>>>>>
        $query = "SELECT * from tipo_usuario";
        $query = $db->prepare($query);
        $query->execute();
        while($datos = $query->fetchObject()) 
        {
            $pdf->Ln(6);
            $pdf->Cell(15,6,$num,1,0,'C');
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->Cell(60,6,$datos->tipo_usuario,1,0,'C');
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Cell(40,6,traduce_id($datos->activo,"activo_inactivo","estado"),1,0,'C');
            $pdf->Cell(40,6,$datos->creado,1,0,'C');            
            $num++;
        }
        $pdf->Ln(5);
        
        $fechal = date("dmYHis");       
        $pdf->Output("tipo_usuario_todos_$fechal.pdf", 'I'); 
    /*
    if ($query) {
        header("location: ../../inicio.php?module=solicitud_materiales");
    }
    */
     
}  

if ($_GET['act']=='ficha') {
        $id = $db->quote($_GET['id']);
        $fecha = date("d-m-Y H:i:s");
        $pdf = new PDF_MC_Table('P','mm','Letter'); //Creamos un objeto de la librería
        $pdf->AddPage(); //Agregamos una Pagina        
        $pdf->SetAuthor('MGVHN');
        $pdf->SetTitle('Tipos de Usuario del sistema a la fecha');
        //encabezado de la Hoja -------------------------------------------------------------------------->>>>>>>>>
        $pdf->SetMargins(20, 20, 20, false); 
        $pdf->SetAutoPageBreak(true, 20); 
        $pdf->SetFont('helvetica', 'B', 22);
        $pdf->Image('assets/img/dmc_logo_completo.png',20,5,25);
        $pdf->Image('assets/img/dmc_logo_completo_ma.png',70,100,100);
        $pdf->Cell(0,0,'    Ficha de Tipos de Usuario',0,1,'C');//titulo principal de la hoja
        $pdf->Ln(4);
        $pdf->SetFont('helvetica', 'B', 16); //tipo de letra y negrita con la B
        $pdf->Cell(0,10,traduce_id($_SESSION['id_empresa'],"empresas","nombre"),0,1,'C'); //subtitulo de la hoja
        $pdf->Cell(0,6,traduce_id($_SESSION['id_sucursal'],"sucursales","nombre"),0,1,'C'); 
        $pdf->SetFont('courier', 'B', 12); //tipo de letra y negrita con la B//subtitulo de la hoja
        $pdf->Cell(0,6,$fecha,0,1,'R'); //subtitulo de la hoja
        $pdf->Image('assets/img/linea.png',12,36,255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetMargins(20, 20, 20, false);  
        $pdf->Ln(10);
       
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetMargins(12, 5); 
        $pdf->Ln(10);
        $pdf->SetFillColor(200, 200, 200);
        //consultas de datos -------------------------------------------------------------------------------->>>>>>
        $query = "SELECT * from tipo_usuario where id= $idw";
        $query = $db->prepare($query);
        $query->execute();
        $datos = $query->fetchObject();        
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(60,6,'ID',1,0,'R',1);        
        $pdf->Cell(100,6,$datos->id,1,0,'C');
        $pdf->Ln(6);
        $pdf->Cell(60,6,'Tipo de Usuario',1,0,'R',1);        
        $pdf->Cell(100,6,$datos->tipo_usuario,1,0,'C');
        $pdf->Ln(6);
        $pdf->Cell(60,6,'Fecha de Creacion',1,0,'R',1);        
        $pdf->Cell(100,6,$datos->creado,1,0,'C');
        $pdf->Ln(40);

        $pdf->Cell(0,6,'Impreso por '.traduce_id($_SESSION['id'],"usuarios","nombre"),0,0,'R',0);
        
        $fechal = date("dmYHis");       
        $pdf->Output("tipo_usuario_ficha_$fechal.pdf", 'I'); 
    /*
    if ($query) {
        header("location: ../../inicio.php?module=solicitud_materiales");
    }
    */
     
}  





 
function numtoletras($xcifra)
{
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                            
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                            
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                            
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO CON $xdecimales/100";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN PESO $xdecimales/100  ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " CON $xdecimales/100 "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}

// END FUNCTION

function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}

         
         ?>  