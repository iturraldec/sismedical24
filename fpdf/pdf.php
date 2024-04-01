<?php
define('FPDF_FONTPATH','fpdf/font/');
define('EURO', chr(128));
require 'pdf_js.php';

############## VARIABLE PARA TAMA�O DE LOGO HORIZONTAL ##############
$GLOBALS['logo1_horizontal_X'] = 20;
$GLOBALS['logo1_horizontal_Y'] = 4;
$GLOBALS['logo1_horizontal'] = 55;

$GLOBALS['logo2_horizontal_X'] = 20;
$GLOBALS['logo2_horizontal_Y'] = 4;
$GLOBALS['logo2_horizontal'] = 65;
############## VARIABLE PARA TAMA�O DE LOGO HORIZONTAL ##############

############## VARIABLE PARA TAMA�O DE LOGO VERTICAL ##############
$GLOBALS['logo1_vertical_X'] = 10;
$GLOBALS['logo1_vertical_Y'] = 8;
$GLOBALS['logo1_vertical'] = 35;

$GLOBALS['logo2_vertical_X'] = 8;
$GLOBALS['logo2_vertical_Y'] = 8;
$GLOBALS['logo2_vertical'] = 44;
############## VARIABLE PARA TAMA�O DE LOGO VERTICAL ##############
 

class PDF extends PDF_JavaScript
{
var $widths;
var $aligns;
var $flowingBlockAttr;
//$Tamhoriz = 88;


########################### FUNCION PARA MOSTRAR EL FOOTER ###########################
function Footer() 
{
  if($this->PageNo() != 1){
  //footer code
  $this->Ln();
  $this->SetY(-12);
  //Courier B 10
  $this->SetFont('courier','B',10);
  //Titulo de Footer
  $this->Cell(190,5,'SOFTWARE CLINICO','T',0,'L');
  //$this->AliasNbPages();
  //Numero de Pagina
  $this->Cell(0,5,'Pagina '.$this->PageNo(),'T',1,'R'); 

  }
}
########################## FUNCION PARA MOSTRAR EL FOOTER ############################
    
######################## FUNCION PARA CARGAR AUTOPRINTF ########################
function AutoPrint($printer='')
{
    // Open the print dialog
    if($printer)
    {
        $printer = str_replace('\\', '\\\\', $printer);
        $script = "var pp = getPrintParams();";
        $script .= "pp.interactive = pp.constants.interactionLevel.full;";
        $script .= "pp.printerName = '$printer'";
        $script .= "print(pp);";
    }
    else
        $script = 'print(true);';
    $this->IncludeJS($script);
}
######################## FUNCION PARA CARGAR AUTOPRINT ########################

 





############################################ REPORTES DE USUARIOS ############################################

########################## FUNCION LISTAR USUARIOS ##############################
function TablaListarUsuarios()
   {
    
    $tra = new Login();
    $reg = $tra->ListarUsuarios();
    
    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
   ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE USUARIOS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(30,8,'N� DOCUMENTO',1,0,'C', True);
    $this->Cell(75,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
    $this->Cell(25,8,'SEXO',1,0,'C', True);
    $this->Cell(40,8,'N� DE TEL�FONO',1,0,'C', True);
    $this->Cell(55,8,'EMAIL',1,0,'C', True);
    $this->Cell(40,8,'USUARIO',1,0,'C', True);
    $this->Cell(55,8,'NIVEL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,30,75,25,40,55,40,55));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){  

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["dni"]),utf8_decode($reg[$i]["nombres"]),utf8_decode($reg[$i]["sexo"]),utf8_decode($reg[$i]["telefono"]),utf8_decode($reg[$i]["email"]),utf8_decode($reg[$i]["usuario"]),utf8_decode($reg[$i]["nivel"])));
       }
    }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR USUARIOS ##############################

########################## FUNCION LISTAR LOGS DE USUARIOS ##############################
 function TablaListarLogs()
   {
    
    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE LOGS DE ACCESO DE USUARIOS',0,0,'C');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(35,8,'IP EQUIPO',1,0,'C', True);
    $this->Cell(45,8,'TIEMPO ENTRADA',1,0,'C', True);
    $this->Cell(145,8,'NAVEGADOR DE ACCESO',1,0,'C', True);
    $this->Cell(60,8,'P�GINAS DE ACCESO',1,0,'C', True);
    $this->Cell(35,8,'USUARIO',1,1,'C', True);
    

    $tra = new Login();
    $reg = $tra->ListarLogs();

    if($reg==""){
    echo "";      
    } else {
    
    /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,35,45,145,60,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["ip"]),utf8_decode($reg[$i]["tiempo"]),utf8_decode($reg[$i]["detalles"]),utf8_decode($reg[$i]["paginas"]),utf8_decode($reg[$i]["usuario"])));
       }
   }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
   }
########################## FUNCION LISTAR LOGS DE USUARIOS ##############################

############################################ REPORTES DE USUARIOS ############################################
















############################################ REPORTES DE CONFIGURACION ############################################

########################## FUNCION LISTAR TIPOS DE DOCUMENTOS ##########################
function TablaListarDocumentos()
{
    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->SetX(6);
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(200,10,'LISTADO DE DOCUMENTOS TRIBUTARIOS',0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'N�',1,0,'C', True);
    $this->Cell(50,8,'NOMBRE DE DOCUMENTO',1,0,'C', True);
    $this->Cell(135,8,'DESCRIPCI�N DE DOCUMENTO',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarDocumentos();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,50,135));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetX(6);
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["documento"]),utf8_decode($reg[$i]["descripcion"])));
       }
   }


    $this->Ln(12); 
    $this->SetX(6);
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->SetX(6);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR TIPOS DE DOCUMENTOS ##########################


########################## FUNCION LISTAR SEGUROS ##########################
function TablaListarSeguros()
{
    
    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->SetX(6);
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(200,10,'LISTADO DE SEGUROS',0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(50,8,'NOMBRE DE SEGURO',1,0,'C', True);
    $this->Cell(25,8,'TELEFONO #1',1,0,'C', True);
    $this->Cell(25,8,'TELEFONO #2',1,0,'C', True);
    $this->Cell(90,8,'DIRECCI�N DE SEGURO',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarSeguros();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,50,25,25,90));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetX(6);
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,portales(utf8_decode($reg[$i]["nomseguro"])),utf8_decode($reg[$i]["tlfseguro1"]),utf8_decode($reg[$i]['tlfseguro2'] == "" ? "**********" : $reg[$i]['tlfseguro2']),utf8_decode($reg[$i]["direcseguro"])));
       }
   }


    $this->Ln(12); 
    $this->SetX(6);
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->SetX(6);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR SEGUROS ##########################


########################## FUNCION LISTAR ESPECIALIDADES ##########################
function TablaListarEspecialidades()
{
    
    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->SetX(6);
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(190,10,'LISTADO DE ESPECIALIDADES',0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'N�',1,0,'C', True);
    $this->Cell(185,8,'NOMBRE DE ESPECIALIDAD',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarEspecialidades();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,185));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetX(6);
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["nomespecialidad"])));
       }
   }


    $this->Ln(12); 
    $this->SetX(6);
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->SetX(6);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR ESPECIALIDADES ##########################


########################## FUNCION LISTAR SUCURSALES ##############################
function TablaListarSucursales()
{
    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE SUCURSALES',0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(35,8,'N� DE REGISTRO',1,0,'C', True);
    $this->Cell(50,8,'NOMBRE DE SUCURSAL',1,0,'C', True);
    $this->Cell(30,8,'PARROQUIA',1,0,'C', True);
    $this->Cell(30,8,'CANT�N',1,0,'C', True);
    $this->Cell(30,8,'PROVINCIA',1,0,'C', True);
    $this->Cell(50,8,'DIRECCI�N',1,0,'C', True);
    $this->Cell(40,8,'N� DE TEL�FONO',1,0,'C', True);
    $this->Cell(55,8,'ENCARGADO',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarSucursales();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,35,50,30,30,30,50,40,55));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["cuitsucursal"]),portales(utf8_decode($reg[$i]["nomsucursal"])),
        strtoupper(portales(utf8_decode($reg[$i]['idparroquia'] == '0' ? "********" : $reg[$i]['parroquia']))),
        strtoupper(portales(utf8_decode($reg[$i]['idcanton'] == '0' ? "********" : $reg[$i]['canton']))),
        strtoupper(portales(utf8_decode($reg[$i]['idprovincia'] == '0' ? "********" : $reg[$i]['provincia']))),
        portales(utf8_decode($reg[$i]["direcsucursal"])),
        utf8_decode($reg[$i]["tlfsucursal"]),
        portales(utf8_decode($reg[$i]["nomencargado"]))));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR SUCURSALES ##############################

########################## FUNCION LISTAR PLANTILLAS ECOGRAFICAS ##############################
function TablaListarPlantillasEcograficas()
{
    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE PLANTILLAS ECOGRAFICAS',0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(50,8,'NOMBRE DE PLANTILLA',1,0,'C', True);
    $this->Cell(55,8,'PROCEDIMIENTO ECOGRAFICO',1,0,'C', True);
    $this->Cell(220,8,'DESCRIPCI�N DE PLANTILLA',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarPlantillasEcograficas();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,50,55,220));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        utf8_decode($reg[$i]["nombreplantillaecografia"]),
        portales(utf8_decode($reg[$i]["procedimientoecografia"])),
        portales(utf8_decode($reg[$i]["descripcionecografia"]))));
       }
   }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR PLANTILLAS ECOGRAFICAS ##############################

########################## FUNCION LISTAR PLANTILLAS LECTURA RX ##############################
function TablaListarPlantillasLecturaRx()
{
    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE PLANTILLAS LECTURA RX',0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(50,8,'NOMBRE DE PLANTILLA',1,0,'C', True);
    $this->Cell(55,8,'PROCEDIMIENTO LECTURA RX',1,0,'C', True);
    $this->Cell(220,8,'DESCRIPCI�N DE PLANTILLA',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarPlantillasLecturaRx();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,50,55,220));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        utf8_decode($reg[$i]["nombreplantillalecturarx"]),
        portales(utf8_decode($reg[$i]["procedimientolecturarx"])),
        portales(utf8_decode($reg[$i]["descripcionlecturarx"]))));
       }
   }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR PLANTILLAS LECTURA RX ##############################

############################################ REPORTES DE CONFIGURACION ############################################





























############################### REPORTES DE MEDICOS ##############################

########################## FUNCION LISTAR MEDICOS ##############################
function TablaListarMedicos()
{

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE M�DICOS',0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(35,8,'N� DOCUMENTO',1,0,'C', True);
    $this->Cell(60,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
    $this->Cell(30,8,'PARROQUIA',1,0,'C', True);
    $this->Cell(30,8,'CANT�N',1,0,'C', True);
    $this->Cell(30,8,'PROVINCIA',1,0,'C', True);
    $this->Cell(60,8,'DIRECCI�N',1,0,'C', True);
    $this->Cell(35,8,'ESPECIALIDAD',1,0,'C', True);
    $this->Cell(45,8,'SUCURSAL',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarMedicos();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,35,60,30,30,30,60,35,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOC" : $reg[$i]['documento'])." ".$reg[$i]["cedmedico"]),portales(utf8_decode($reg[$i]["nommedico"])),
        strtoupper(portales(utf8_decode($reg[$i]['idparroquia'] == '0' ? "********" : $reg[$i]['parroquia']))),
        strtoupper(portales(utf8_decode($reg[$i]['idcanton'] == '0' ? "********" : $reg[$i]['canton']))),
        strtoupper(portales(utf8_decode($reg[$i]['idprovincia'] == '0' ? "********" : $reg[$i]['provincia']))),
        portales(utf8_decode($reg[$i]["direcmedico"])),utf8_decode($reg[$i]["nomespecialidad"]),portales(utf8_decode($reg[$i]["nomsucursal"]))));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR MEDICOS ##############################

########################## FUNCION LISTAR MEDICOS POR SUCURSAL ##############################
function TablaListarMedicosxSucursal()
{
    $busqueda = new Login();
    $reg = $busqueda->BusquedaMedicosxSucursal();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE M�DICOS POR SUCURSAL',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(35,8,'N� DOCUMENTO',1,0,'C', True);
    $this->Cell(60,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
    $this->Cell(30,8,'PARROQUIA',1,0,'C', True);
    $this->Cell(30,8,'CANT�N',1,0,'C', True);
    $this->Cell(30,8,'PROVINCIA',1,0,'C', True);
    $this->Cell(60,8,'DIRECCI�N',1,0,'C', True);
    $this->Cell(35,8,'ESPECIALIDAD',1,0,'C', True);
    $this->Cell(45,8,'MPS',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,35,60,30,30,30,60,35,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOC" : $reg[$i]['documento'])." ".$reg[$i]["cedmedico"]),portales(utf8_decode($reg[$i]["nommedico"])),
        strtoupper(portales(utf8_decode($reg[$i]['idparroquia'] == '0' ? "********" : $reg[$i]['parroquia']))),
        strtoupper(portales(utf8_decode($reg[$i]['idcanton'] == '0' ? "********" : $reg[$i]['canton']))),
        strtoupper(portales(utf8_decode($reg[$i]['idprovincia'] == '0' ? "********" : $reg[$i]['provincia']))),
        portales(utf8_decode($reg[$i]["direcmedico"])),utf8_decode($reg[$i]["nomespecialidad"]),portales(utf8_decode($reg[$i]["mps"]))));
       }
   }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR MEDICOS POR SUCURSAL ##############################

########################## FUNCION LISTAR HORARIOS DE MEDICOS ##############################
function TablaListarHorarios()
{
    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE HORARIOS DE M�DICOS',0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(35,8,'N� DOCUMENTO',1,0,'C', True);
    $this->Cell(60,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
    $this->Cell(35,8,'ESPECIALIDAD',1,0,'C', True);
    $this->Cell(85,8,'DIAS LABORALES',1,0,'C', True);
    $this->Cell(30,8,'HORA DESDE',1,0,'C', True);
    $this->Cell(30,8,'HORA HASTA',1,0,'C', True);
    $this->Cell(45,8,'SUCURSAL',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarHorarios();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,35,60,35,85,30,30,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOC" : $reg[$i]['documento'])." ".$reg[$i]["cedmedico"]),portales(utf8_decode($reg[$i]["nommedico"])),utf8_decode($reg[$i]["nomespecialidad"]),portales(utf8_decode(Dias($reg[$i]['dias_laborales']))),portales(utf8_decode($reg[$i]['hora_desde'])),portales(utf8_decode($reg[$i]["hora_hasta"])),portales(utf8_decode($reg[$i]["nomsucursal"]))));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR HORARIOS DE MEDICOS ##############################

############################### REPORTES DE MEDICOS ##############################


















############################### REPORTES DE PACIENTES ##############################

########################## FUNCION LISTAR PACIENTES ##############################
function TablaListarPacientes()
{

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE PACIENTES',0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(30,8,'N� HISTORIA',1,0,'C', True);
    $this->Cell(30,8,'N� DOCUMENTO',1,0,'C', True);
    $this->Cell(40,8,'NOMBRES',1,0,'C', True);
    $this->Cell(40,8,'APELLIDOS',1,0,'C', True);
    $this->Cell(50,8,'PARROQUIA',1,0,'C', True);
    $this->Cell(25,8,'CANTON',1,0,'C', True);
    $this->Cell(25,8,'PROVINCIA',1,0,'C', True);
    $this->Cell(55,8,'DIRECCI�N',1,0,'C', True);
    $this->Cell(30,8,'GRUPO SANG',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarPacientes();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,30,30,40,40,50,25,25,55,30));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,portales(utf8_decode($reg[$i]['numerohistoria'])),utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOC" : $reg[$i]['documento'])." ".$reg[$i]["cedpaciente"]),portales(utf8_decode($reg[$i]['pnompaciente']." ".$reg[$i]['snompaciente'])),portales(utf8_decode($reg[$i]['papepaciente']." ".$reg[$i]['sapepaciente'])),
        strtoupper(portales(utf8_decode($reg[$i]['idparroquia'] == '0' ? "********" : $reg[$i]['parroquia']))),
        strtoupper(portales(utf8_decode($reg[$i]['idcanton'] == '0' ? "********" : $reg[$i]['canton']))),
        strtoupper(portales(utf8_decode($reg[$i]['idprovincia'] == '0' ? "********" : $reg[$i]['provincia']))),
        portales(utf8_decode($reg[$i]["direcpaciente"])),portales(utf8_decode($reg[$i]["gruposapaciente"]))));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR PACIENTES ##############################

############################### REPORTES DE PACIENTES ##############################




















############################### REPORTES DE CITAS MEDICAS ##############################

########################## FUNCION LISTAR CITAS MEDICAS ##############################
function TablaListarCitasMedicas()
{

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE CITAS MEDICAS',0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(55,8,'MOTIVO DE CITA',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(25,8,'STATUS',1,0,'C', True);
    $this->Cell(30,8,'REGISTRADO',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarCitas();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,55,35,25,30,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    if($reg[$i]["statuscita"]==1){
        $status = "ATENDIDA";
    } elseif($reg[$i]["statuscita"]==2){
        $status = "PENDIENTE";
    } elseif($reg[$i]["statuscita"]==3){
        $status = "CANCELADA";
    } elseif($reg[$i]["statuscita"]==4){
        $status = "VENCIDA";
    }

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['pacientes'])),portales(utf8_decode($reg[$i]['descripcion'])),utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechacita']))),utf8_decode($status),utf8_decode(date("d-m-Y",strtotime($reg[$i]['ingresocita']))),portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR CITAS MEDICAS ##############################

########################## FUNCION LISTAR CITAS MEDICAS POR FECHAS ##############################
function TablaListarCitasMedicasxFechas()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarCitasxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE CITAS MEDICAS POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(75,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(75,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(75,8,'MOTIVO DE CITA',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(25,8,'STATUS',1,0,'C', True);
    $this->Cell(30,8,'REGISTRADO',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,75,75,75,45,25,30));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    if($reg[$i]["statuscita"]==1){
        $status = "ATENDIDA";
    } elseif($reg[$i]["statuscita"]==2){
        $status = "PENDIENTE";
    } elseif($reg[$i]["statuscita"]==3){
        $status = "CANCELADA";
    } elseif($reg[$i]["statuscita"]==4){
        $status = "VENCIDA";
    }

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['pacientes'])),portales(utf8_decode($reg[$i]['descripcion'])),utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechacita']))),utf8_decode($status),utf8_decode(date("d-m-Y",strtotime($reg[$i]['ingresocita'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR CITAS MEDICAS POR FECHAS ##############################

########################## FUNCION LISTAR CITAS MEDICAS POR MEDICO ##############################
function TablaListarCitasMedicasxMedicos()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarCitasxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE CITAS MEDICAS POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(40,8,'N� DOCUMENTO',1,0,'C', True);
    $this->Cell(90,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(85,8,'MOTIVO DE CITA',1,0,'C', True);
    $this->Cell(50,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(30,8,'STATUS',1,0,'C', True);
    $this->Cell(30,8,'REGISTRADO',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,40,90,85,50,30,30));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    if($reg[$i]["statuscita"]==1){
        $status = "ATENDIDA";
    } elseif($reg[$i]["statuscita"]==2){
        $status = "PENDIENTE";
    } elseif($reg[$i]["statuscita"]==3){
        $status = "CANCELADA";
    } elseif($reg[$i]["statuscita"]==4){
        $status = "VENCIDA";
    }

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'])),portales(utf8_decode($reg[$i]['pacientes'])),portales(utf8_decode($reg[$i]['descripcion'])),utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechacita']))),utf8_decode($status),utf8_decode(date("d-m-Y",strtotime($reg[$i]['ingresocita'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR CITAS MEDICAS POR MEDICO ##############################

########################## FUNCION LISTAR CITAS MEDICAS POR PACIENTE ##############################
function TablaListarCitasMedicasxPacientes()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarCitasxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE CITAS MEDICAS POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["pacientes"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(40,8,'N� DOCUMENTO',1,0,'C', True);
    $this->Cell(90,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(85,8,'MOTIVO DE CITA',1,0,'C', True);
    $this->Cell(50,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(30,8,'STATUS',1,0,'C', True);
    $this->Cell(30,8,'REGISTRADO',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,40,90,85,50,30,30));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    if($reg[$i]["statuscita"]==1){
        $status = "ATENDIDA";
    } elseif($reg[$i]["statuscita"]==2){
        $status = "PENDIENTE";
    } elseif($reg[$i]["statuscita"]==3){
        $status = "CANCELADA";
    } elseif($reg[$i]["statuscita"]==4){
        $status = "VENCIDA";
    }

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'])),portales(utf8_decode($reg[$i]['nommedico'])),portales(utf8_decode($reg[$i]['descripcion'])),utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechacita']))),utf8_decode($status),utf8_decode(date("d-m-Y",strtotime($reg[$i]['ingresocita'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR CITAS MEDICAS POR PACIENTE ##############################

############################### REPORTES DE CITAS MEDICAS ##############################
















############################### REPORTES DE APERTURAS DE HISTORIA ##############################

############################### FUNCION PARA MOSTRAR APERTURAS DE HISTORIA ################################# 
function TablaApertura()
  {
    $tra = new Login();
    $reg = $tra->AperturasPorId();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'APERTURA DE HISTORIA M�DICA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    //$this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,"lnacpaciente",1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    //$this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,"nacpaciente",1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    /*$this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(20,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(20,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(20,4,'CANT�N',1,0,'C');
    $this->CellFitSpace(20,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(20,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(25,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(30,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->CellFitSpace(25,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(30,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(15,4,'EDAD',1,0,'C');
    $this->CellFitSpace(15,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(40,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(25,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->CellFitSpace(25,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(15,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(15,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();*/


    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'MOTIVO DE CONSULTA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',12).portales(utf8_decode($reg[0]['motivoconsulta'])),1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'TA(mm/Hg)',1,0,'C');
    $this->CellFitSpace(40,4,'TEMP:(�C)',1,0,'C');
    $this->CellFitSpace(40,4,'FC(por minuto)',1,0,'C');
    $this->CellFitSpace(40,4,'FR(por minuto)',1,0,'C');
    $this->CellFitSpace(40,4,'PESO(Kg)',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ta'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['temperatura'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['fc'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['fr'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['peso'])),1,0,'L');
    $this->Ln();

    if($reg[0]['sexopaciente'] == "FEMENINO"){

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'FECHA ULTIMA CITOLOG�A',1,0,'C');
    $this->CellFitSpace(40,4,'EMBARAZADA',1,0,'C');
    $this->CellFitSpace(40,4,'FECHA ULTIMA MESTRUACI�N',1,0,'C');
    $this->CellFitSpace(40,4,'SEMANAS DE GESTACI�N',1,0,'C');
    $this->CellFitSpace(40,4,'FECHA PROBABLE DE PARTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($variable = ($reg[0]['fechacitologia'] == '0000-00-00' ? "*******" : date("d-m-Y", strtotime($reg[0]['fechacitologia']))))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['embarazada'] == '' ? "*******" : $reg[0]['embarazada'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($variable = ($reg[0]['fechamestruacion'] == '0000-00-00' ? "*******" : date("d-m-Y", strtotime($reg[0]['fechamestruacion']))))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['semanas'] == '' ? "*******" : $reg[0]['semanas'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($variable = ($reg[0]['fechaparto'] == '0000-00-00' ? "*******" : date("d-m-Y", strtotime($reg[0]['fechaparto']))))),1,0,'L');
    $this->Ln();
        
    }

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'EXAMEN FISICO',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11).portales(utf8_decode($reg[0]['examenfisico'])),1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'ENFERMEDAD ACTUAL',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11).portales(utf8_decode($reg[0]['enfermedadpaciente'])),1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'ANTECEDENTES CLINICOS',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."PERSONALES: ".portales(utf8_decode($reg[0]['antecedentepaciente'])),1,'L');

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."FAMILIARES: ".portales(utf8_decode($reg[0]['antecedentefamiliares'])),1,'L');

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."AL�RGICOS: ".portales(utf8_decode($reg[0]['antecedentealergico'])),1,'L');

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."PATOL�GICOS: ".portales(utf8_decode($reg[0]['antecedentepatologico'])),1,'L');

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."QUIR�RGICOS: ".portales(utf8_decode($reg[0]['antecedentequirurgico'])),1,'L');

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."FARMACOL�GICOS: ".portales(utf8_decode($reg[0]['antecedentefarmacologico'])),1,'L');

    if($reg[0]['sexopaciente'] == "FEMENINO"){

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."GINECOL�GICOS: ".portales(utf8_decode($reg[0]['antecedenteginecologico'])),1,'L');

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."HISTORIAL GESTACIONAL: ".portales(utf8_decode($reg[0]['historialgestacional'])),1,'L');

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."PLANIFICACI�N FAMILIAR: ".portales(utf8_decode($reg[0]['planificacionfamiliar'])),1,'L');

    }

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'IMPRESI�N DIAGN�STICA',1,1,'C', True);

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['dxpresuntivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciepresuntivo,$presuntivo,$observacionpresuntivo) = explode("/",$explode[$cont]);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',10).$idciepresuntivo == '' ? "" : "".$a++.". ".$presuntivo.". \nOBSERVACI�N: ".utf8_decode(trim($observacionpresuntivo)),1,'J');
    
    endfor;

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'IDENTIFICACI�N DEL ORIGEN DE LA ENFERMEDAD',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11).portales(utf8_decode($reg[0]['origenenfermedad'])),1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'CONDUCTA O PLAN DE TRATAMIENTO',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11).portales(utf8_decode($reg[0]['tratamiento'])),1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DIAGN�STICO DEFINITIVO',1,1,'C', True);

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['dxdefinitivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciedefinitivo,$definitivo,$observaciondefinitivo) = explode("/",$explode[$cont]);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',10).$idciedefinitivo == '' ? "" : "".$a++.". ".$definitivo.". \nOBSERVACI�N: ".utf8_decode(trim($observaciondefinitivo)),1,'J');
    
    endfor;

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaapertura'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaapertura'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaapertura'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaapertura'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    ########################## AQUI MUESTRO REMISION ##########################
    if (isset($reg[0]['remision'])) {

    $this->AddPage();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'REMISI�N',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'REMISI�N',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',12).portales(utf8_decode($reg[0]['remision'])),1,'L');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    }
    ########################## AQUI MUESTRO REMISION ##########################




    ########################## AQUI MUESTRO FORMULA MEDICAS ##########################
    if (isset($reg[0]['formulamedica'])) {

    $this->AddPage();

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['formulamedica'])));

    # Recorremos el array
    for($cont = 0, $s = sizeof($explode); $cont < $s; $cont++):
   
    # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
    list($idcieformula,$formula,$observacionformula) = explode("/",$explode[$cont]);

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'F�RMULA M�DICA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'F�RMULA M�DICA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."DX: ".portales(utf8_decode($formula))." \nF�RMULA: ".utf8_decode(trim($observacionformula)),1,'J');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    if($cont != $s - 1) {
            $this->AddPage();
                                  } ##fin de if
                                                   endfor; ##fin de for*/
    }
    ########################## AQUI MUESTRO FORMULA MEDICAS ##########################





    ########################## AQUI MUESTRO ORDENES MEDICAS ##########################
    if (isset($reg[0]['ordenmedica'])) {

    $this->AddPage();

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['ordenmedica'])));

    # Recorremos el array
    for($cont = 0, $s = sizeof($explode); $cont < $s; $cont++):
   
    # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
    list($idcieorden,$orden,$observacionorden) = explode("/",$explode[$cont]);

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'�RDEN M�DICA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'�RDEN M�DICA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."DX: ".portales(utf8_decode($orden))." \nF�RMULA: ".utf8_decode(trim($observacionorden)),1,'J');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    if($cont != $s - 1) {
            $this->AddPage();
                                  } ##fin de if
                                                   endfor; ##fin de for*/

    }
    ########################## AQUI MUESTRO ORDENES MEDICAS ##########################
}
############################### FUNCION PARA MOSTRAR APERTURAS DE HISTORIA #################################

########################## FUNCION LISTAR APERTURAS DE HISTORIAS ##############################
function TablaListarAperturas()
{

    $tra = new Login();
    $reg = $tra->ListarAperturas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE APERTURAS DE HISTORIAS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(60,8,'ENFERMEDAD ACTUAL',1,0,'C', True);
    $this->Cell(50,8,'ANTECEDENTES',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,60,50,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['enfermedadpaciente'])),
        portales(utf8_decode($reg[$i]['antecedentepaciente'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaapertura']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR APERTURAS DE HISTORIAS ##############################

########################## FUNCION LISTAR APERTURAS DE HISTORIAS POR FECHAS ##############################
function TablaListarAperturasxFechas()
{

    $tra = new Login();
    $reg = $tra->BuscarAperturasxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE APERTURAS DE HISTORIAS POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(75,8,'ENFERMEDAD ACTUAL',1,0,'C', True);
    $this->Cell(75,8,'ANTECEDENTES',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,70,70,75,75,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['enfermedadpaciente'])),
        portales(utf8_decode($reg[$i]['antecedentepaciente'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaapertura'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR APERTURAS DE HISTORIAS POR FECHAS ##############################

########################## FUNCION LISTAR APERTURAS DE HISTORIAS POR MEDICO ##############################
function TablaListarAperturasxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarAperturasxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE APERTURAS DE HISTORIAS POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(90,8,'ENFERMEDAD ACTUAL',1,0,'C', True);
    $this->Cell(90,8,'ANTECEDENTES',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,90,90,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['enfermedadpaciente'])),
        portales(utf8_decode($reg[$i]['antecedentepaciente'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaapertura'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR APERTURAS DE HISTORIAS POR MEDICO ##############################

########################## FUNCION LISTAR APERTURAS DE HISTORIAS POR PACIENTE ##############################
function TablaListarAperturasxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarAperturasxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE APERTURAS DE HISTORIAS POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(90,8,'ENFERMEDAD ACTUAL',1,0,'C', True);
    $this->Cell(90,8,'ANTECEDENTES',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,90,90,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($reg[$i]['enfermedadpaciente'])),
        portales(utf8_decode($reg[$i]['antecedentepaciente'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaapertura'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR APERTURAS DE HISTORIAS POR PACIENTE ##############################

############################### REPORTES DE APERTURAS DE HISTORIA ##############################






















############################### REPORTES DE HOJA EVOLUTIVA ##############################

############################### FUNCION PARA MOSTRAR HOJAS EVOLUTIVAS ################################# 
function TablaHojaEvolutiva()
  {
    $tra = new Login();
    $reg = $tra->HojasEvolutivasPorId();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'HOJA EVOLUTIVA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'MOTIVO DE CONSULTA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',12).portales(utf8_decode($reg[0]['motivoconsulta'])),1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'TA(mm/Hg)',1,0,'C');
    $this->CellFitSpace(40,4,'TEMP:(�C)',1,0,'C');
    $this->CellFitSpace(40,4,'FC(por minuto)',1,0,'C');
    $this->CellFitSpace(40,4,'FR(por minuto)',1,0,'C');
    $this->CellFitSpace(40,4,'PESO(Kg)',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ta'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['temperatura'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['fc'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['fr'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['peso'])),1,0,'L');
    $this->Ln();

    if($reg[0]['sexopaciente'] == "FEMENINO"){

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'FECHA ULTIMA CITOLOG�A',1,0,'C');
    $this->CellFitSpace(40,4,'EMBARAZADA',1,0,'C');
    $this->CellFitSpace(40,4,'FECHA ULTIMA MESTRUACI�N',1,0,'C');
    $this->CellFitSpace(40,4,'SEMANAS DE GESTACI�N',1,0,'C');
    $this->CellFitSpace(40,4,'FECHA PROBABLE DE PARTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($variable = ($reg[0]['fechacitologia'] == '0000-00-00' ? "*******" : date("d-m-Y", strtotime($reg[0]['fechacitologia']))))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['embarazada'] == '' ? "*******" : $reg[0]['embarazada'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($variable = ($reg[0]['fechamestruacion'] == '0000-00-00' ? "*******" : date("d-m-Y", strtotime($reg[0]['fechamestruacion']))))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['semanas'] == '' ? "*******" : $reg[0]['semanas'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($variable = ($reg[0]['fechaparto'] == '0000-00-00' ? "*******" : date("d-m-Y", strtotime($reg[0]['fechaparto']))))),1,0,'L');
    $this->Ln();
        
    }

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'EXAMEN FISICO',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11).portales(utf8_decode($reg[0]['examenfisico'])),1,'L');

    if($reg[0]['codprocedimiento'] == 0){

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'ATENCI�N ACTIVIDAD Y/O PROCEDIMIENTO',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11).portales(utf8_decode($reg[0]['atenproced'])),1,'L');

    }

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'IMPRESI�N DIAGN�STICA',1,1,'C', True);

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['dxpresuntivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciepresuntivo,$presuntivo,$observacionpresuntivo) = explode("/",$explode[$cont]);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',10).$idciepresuntivo == '' ? "" : "".$a++.". ".$presuntivo.". \nOBSERVACI�N: ".utf8_decode(trim($observacionpresuntivo)),1,'J');
    
    endfor;

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'IDENTIFICACI�N DEL ORIGEN DE LA ENFERMEDAD',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11).portales(utf8_decode($reg[0]['origenenfermedad'])),1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'CONDUCTA O PLAN DE TRATAMIENTO',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11).portales(utf8_decode($reg[0]['tratamiento'])),1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DIAGN�STICO DEFINITIVO',1,1,'C', True);

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['dxdefinitivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciedefinitivo,$definitivo,$observaciondefinitivo) = explode("/",$explode[$cont]);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',10).$idciedefinitivo == '' ? "" : "".$a++.". ".$definitivo.". \nOBSERVACI�N: ".utf8_decode(trim($observaciondefinitivo)),1,'J');
    
    endfor;

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechahoja'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechahoja'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechahoja'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechahoja'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }



    ########################## AQUI MUESTRO REMISION ##########################
    if (isset($reg[0]['remision'])) {

    $this->AddPage();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'REMISI�N',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'REMISI�N',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',12).portales(utf8_decode($reg[0]['remision'])),1,'L');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    }
    ########################## AQUI MUESTRO REMISION ##########################




    ########################## AQUI MUESTRO FORMULA MEDICAS ##########################
    if (isset($reg[0]['formulamedica'])) {

    $this->AddPage();

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['formulamedica'])));

    # Recorremos el array
    for($cont = 0, $s = sizeof($explode); $cont < $s; $cont++):
   
    # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
    list($idcieformula,$formula,$observacionformula) = explode("/",$explode[$cont]);

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'F�RMULA M�DICA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'F�RMULA M�DICA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."DX: ".portales(utf8_decode($formula))." \nF�RMULA: ".utf8_decode(trim($observacionformula)),1,'J');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    if($cont != $s - 1) {
            $this->AddPage();
                                  } ##fin de if
                                                   endfor; ##fin de for*/
    }
    ########################## AQUI MUESTRO FORMULA MEDICAS ##########################





    ########################## AQUI MUESTRO ORDENES MEDICAS ##########################
    if (isset($reg[0]['ordenmedica'])) {

    $this->AddPage();

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['ordenmedica'])));

    # Recorremos el array
    for($cont = 0, $s = sizeof($explode); $cont < $s; $cont++):
   
    # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
    list($idcieorden,$orden,$observacionorden) = explode("/",$explode[$cont]);

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'�RDEN M�DICA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'�RDEN M�DICA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."DX: ".portales(utf8_decode($orden))." \nF�RMULA: ".utf8_decode(trim($observacionorden)),1,'J');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    if($cont != $s - 1) {
            $this->AddPage();
                                  } ##fin de if
                                                   endfor; ##fin de for*/

    }
    ########################## AQUI MUESTRO ORDENES MEDICAS ##########################

}
############################### FUNCION PARA MOSTRAR HOJA EVOLUTIVA #################################

########################## FUNCION LISTAR HOJAS EVOLUTIVAS ##############################
function TablaListarHojasEvolutivas()
{

    $tra = new Login();
    $reg = $tra->ListarHojasEvolutivas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE HOJAS EVOLUTIVAS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(60,8,'MOTIVO CONSULTA',1,0,'C', True);
    $this->Cell(50,8,'EXAMEN FISICO',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,60,50,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['motivoconsulta'])),
        portales(utf8_decode($reg[$i]['examenfisico'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechahoja']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR HOJAS EVOLUTIVAS ##############################

########################## FUNCION LISTAR HOJAS EVOLUTIVAS POR FECHAS ##############################
function TablaListarHojasEvolutivasxFechas()
{

    $tra = new Login();
    $reg = $tra->BuscarHojasEvolutivasxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE HOJAS EVOLUTIVAS POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(75,8,'MOTIVO CONSULTA',1,0,'C', True);
    $this->Cell(75,8,'EXAMEN FISICO',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,70,70,75,75,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['motivoconsulta'])),
        portales(utf8_decode($reg[$i]['examenfisico'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechahoja'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR HOJAS EVOLUTIVAS POR FECHAS ##############################

########################## FUNCION LISTAR HOJAS EVOLUTIVAS POR MEDICO ##############################
function TablaListarHojasEvolutivasxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarHojasEvolutivasxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE HOJAS EVOLUTIVAS POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(90,8,'MOTIVO CONSULTA',1,0,'C', True);
    $this->Cell(90,8,'EXAMEN FISICO',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,90,90,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['motivoconsulta'])),
        portales(utf8_decode($reg[$i]['examenfisico'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechahoja'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR HOJAS EVOLUTIVAS POR MEDICO ##############################

########################## FUNCION LISTAR HOJAS EVOLUTIVAS POR PACIENTE ##############################
function TablaListarHojasEvolutivasxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarHojasEvolutivasxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE HOJAS EVOLUTIVAS POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(90,8,'MOTIVO CONSULTA',1,0,'C', True);
    $this->Cell(90,8,'EXAMEN FISICO',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,90,90,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($reg[$i]['motivoconsulta'])),
        portales(utf8_decode($reg[$i]['examenfisico'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechahoja'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR HOJAS EVOLUTIVAS POR PACIENTE ##############################

############################### REPORTES DE HOJA EVOLUTIVA ##############################






















############################### REPORTES DE REMISIONES ##############################

############################### FUNCION PARA MOSTRAR REMISIONES ################################# 
function TablaRemisiones()
  {
    $tra = new Login();
    $reg = $tra->RemisionesPorId();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'REMISI�N',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(25,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(30,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->CellFitSpace(25,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(30,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(15,4,'EDAD',1,0,'C');
    $this->CellFitSpace(15,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(40,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(25,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->CellFitSpace(25,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(15,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(15,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'REMISI�N',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',12).portales(utf8_decode($reg[0]['remision'])),1,'L');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);


    ########################## AQUI MUESTRO FORMULA MEDICAS ##########################
    if (isset($reg[0]['formulamedica'])) {

    $this->AddPage();

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['formulamedica'])));

    # Recorremos el array
    for($cont = 0, $s = sizeof($explode); $cont < $s; $cont++):
   
    # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
    list($idcieformula,$formula,$observacionformula) = explode("/",$explode[$cont]);

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'F�RMULA M�DICA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'F�RMULA M�DICA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."DX: ".portales(utf8_decode($formula))." \nF�RMULA: ".utf8_decode(trim($observacionformula)),1,'J');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    if($cont != $s - 1) {
            $this->AddPage();
                                  } ##fin de if
                                                   endfor; ##fin de for*/
    }
    ########################## AQUI MUESTRO FORMULA MEDICAS ##########################





    ########################## AQUI MUESTRO ORDENES MEDICAS ##########################
    if (isset($reg[0]['ordenmedica'])) {

    $this->AddPage();

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['ordenmedica'])));

    # Recorremos el array
    for($cont = 0, $s = sizeof($explode); $cont < $s; $cont++):
   
    # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
    list($idcieorden,$orden,$observacionorden) = explode("/",$explode[$cont]);

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'�RDEN M�DICA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'�RDEN M�DICA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."DX: ".portales(utf8_decode($orden))." \nF�RMULA: ".utf8_decode(trim($observacionorden)),1,'J');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    if($cont != $s - 1) {
            $this->AddPage();
                                  } ##fin de if
                                                   endfor; ##fin de for*/

    }
    ########################## AQUI MUESTRO ORDENES MEDICAS ##########################

}
############################### FUNCION PARA MOSTRAR REMISIONES #################################

########################## FUNCION LISTAR REMISIONES ##############################
function TablaListarRemisiones()
{

    $tra = new Login();
    $reg = $tra->ListarRemisiones();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE REMISIONES',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(110,8,'REMISI�N',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,110,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['remision'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fecharemision']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR REMISIONES ##############################

########################## FUNCION LISTAR REMISIONES POR FECHAS ##############################
function TablaListarRemisionesxFechas()
{

    $tra = new Login();
    $reg = $tra->BuscarRemisionesxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE REMISIONES POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(150,8,'REMISI�N',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,70,70,150,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['remision'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fecharemision'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR REMISIONES POR FECHAS ##############################

########################## FUNCION LISTAR REMISIONES POR MEDICO ##############################
function TablaListarRemisionesxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarRemisionesxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE REMISIONES POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(180,8,'REMISI�N',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,180,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['remision'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fecharemision'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR REMISIONES POR MEDICO ##############################

########################## FUNCION LISTAR REMISIONES POR PACIENTE ##############################
function TablaListarRemisionesxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarRemisionesxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE REMISIONES POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(180,8,'REMISI�N',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,180,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($reg[$i]['remision'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fecharemision'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR REMISIONES POR PACIENTE ##############################

############################### REPORTES DE REMISIONES ##############################























############################### REPORTES DE FORMULAS MEDICAS ##############################

############################### FUNCION PARA MOSTRAR FORMULAS MEDICAS ################################# 
function TablaFormulasMedicas()
  {
    $tra = new Login();
    $reg = $tra->FormulasMedicasPorId();

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['formulamedica'])));

    # Recorremos el array
    for($cont = 0, $s = sizeof($explode); $cont < $s; $cont++):
   
    # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
    list($idcieformula,$formula,$observacionformula) = explode("/",$explode[$cont]);

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'F�RMULA M�DICA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'F�RMULA M�DICA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."DX: ".portales(utf8_decode($formula))." \nF�RMULA: ".utf8_decode(trim($observacionformula)),1,'J');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    if($cont != $s - 1) {
            $this->AddPage();
                                  } ##fin de if
                                                   endfor; ##fin de for*/

    ########################## AQUI MUESTRO ORDENES MEDICAS ##########################
    if (isset($reg[0]['ordenmedica'])) {

    $this->AddPage();

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['ordenmedica'])));

    # Recorremos el array
    for($cont = 0, $s = sizeof($explode); $cont < $s; $cont++):
   
    # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
    list($idcieorden,$orden,$observacionorden) = explode("/",$explode[$cont]);

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'�RDEN M�DICA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'�RDEN M�DICA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."DX: ".portales(utf8_decode($orden))." \nF�RMULA: ".utf8_decode(trim($observacionorden)),1,'J');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    if($cont != $s - 1) {
            $this->AddPage();
                                  } ##fin de if
                                                   endfor; ##fin de for*/

    }
    ########################## AQUI MUESTRO ORDENES MEDICAS ##########################

}
############################### FUNCION PARA MOSTRAR FORMULA MEDICA #################################

########################## FUNCION LISTAR FORMULAS MEDICAS ##############################
function TablaListarFormulasMedicas()
{

    $tra = new Login();
    $reg = $tra->ListarFormulasMedicas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE F�RMULAS M�DICAS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(110,8,'F�RMULAS M�DICAS',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,110,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $explode = explode(",,",$reg[$i]['formulamedica']); 
    $replace = str_replace(",,","\n", $reg[$i]['formulamedica']);
    $formulas = str_replace("/",":", $replace);

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode(strtoupper($formulas))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR FORMULAS MEDICAS ##############################

########################## FUNCION LISTAR FORMULAS MEDICAS POR FECHAS ##############################
function TablaListarFormulasMedicasxFechas()
{

    $tra = new Login();
    $reg = $tra->BuscarFormulasMedicasxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE F�RMULAS M�DICAS POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(150,8,'F�RMULAS M�DICAS',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,70,70,150,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $replace = str_replace(",,","\n", $reg[$i]['formulamedica']);
    $formulas = str_replace("/",":", $replace);

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode(strtoupper($formulas))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR FORMULAS MEDICAS POR FECHAS ##############################

########################## FUNCION LISTAR FORMULAS MEDICAS POR MEDICO ##############################
function TablaListarFormulasMedicasxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarFormulasMedicasxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE F�RMULAS M�DICAS POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(180,8,'F�RMULAS M�DICAS',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,180,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $replace = str_replace(",,","\n", $reg[$i]['formulamedica']);
    $formulas = str_replace("/",":", $replace);

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode(strtoupper($formulas))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR FORMULAS MEDICAS POR MEDICO ##############################

########################## FUNCION LISTAR FORMULAS MEDICAS POR PACIENTE ##############################
function TablaListarFormulasMedicasxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarFormulasMedicasxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE F�RMULAS M�DICAS POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(180,8,'F�RMULAS M�DICAS',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,180,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $replace = str_replace(",,","\n", $reg[$i]['formulamedica']);
    $formulas = str_replace("/",":", $replace);

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode(strtoupper($formulas))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR FORMULAS MEDICAS POR PACIENTE ##############################

############################### REPORTES DE FORMULAS MEDICAS ##############################
























############################### REPORTES DE ORDENES MEDICAS ##############################

############################### FUNCION PARA MOSTRAR ORDENES MEDICAS ################################# 
function TablaOrdenesMedicas()
  {
    $tra = new Login();
    $reg = $tra->OrdenesMedicasPorId();

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['ordenmedica'])));

    # Recorremos el array
    for($cont = 0, $s = sizeof($explode); $cont < $s; $cont++):
   
    # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
    list($idcieorden,$orden,$observacionorden) = explode("/",$explode[$cont]);

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'�RDEN M�DICA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(25,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(30,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->CellFitSpace(25,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(30,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(15,4,'EDAD',1,0,'C');
    $this->CellFitSpace(15,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(40,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(25,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->CellFitSpace(25,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(15,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(15,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'�RDEN M�DICA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."DX: ".portales(utf8_decode($orden))." \nF�RMULA: ".utf8_decode(trim($observacionorden)),1,'J');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    if($cont != $s - 1) {
            $this->AddPage();
                        } ##fin de if
    endfor; ##fin de for*/


    ########################## AQUI MUESTRO FORMULA MEDICAS ##########################
    if (isset($reg[0]['formulamedica'])) {

    $this->AddPage();

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['formulamedica'])));

    # Recorremos el array
    for($cont = 0, $s = sizeof($explode); $cont < $s; $cont++):
   
    # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
    list($idcieformula,$formula,$observacionformula) = explode("/",$explode[$cont]);

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'F�RMULA M�DICA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'F�RMULA M�DICA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."DX: ".portales(utf8_decode($formula))." \nF�RMULA: ".utf8_decode(trim($observacionformula)),1,'J');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    if($cont != $s - 1) {
            $this->AddPage();
                                  } ##fin de if
                                                   endfor; ##fin de for*/
    }
    ########################## AQUI MUESTRO FORMULA MEDICAS ##########################

}
############################### FUNCION PARA MOSTRAR ORDENES MEDICAS #################################

########################## FUNCION LISTAR ORDENES MEDICAS ##############################
function TablaListarOrdenesMedicas()
{

    $tra = new Login();
    $reg = $tra->ListarOrdenesMedicas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE �RDENES M�DICAS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(110,8,'�RDENES M�DICAS',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,110,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $explode = explode(",,",$reg[$i]['ordenmedica']); 
    $replace = str_replace(",,","\n", $reg[$i]['ordenmedica']);
    $ordenes = str_replace("/",":", $replace);

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode(strtoupper($ordenes))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaorden']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR ORDENES MEDICAS ##############################

########################## FUNCION LISTAR ORDENES MEDICAS POR FECHAS ##############################
function TablaListarOrdenesMedicasxFechas()
{

    $tra = new Login();
    $reg = $tra->BuscarOrdenesMedicasxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE �RDENES M�DICAS POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(150,8,'�RDENES M�DICAS',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,70,70,150,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $replace = str_replace(",,","\n", $reg[$i]['ordenmedica']);
    $ordenes = str_replace("/",":", $replace);

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode(strtoupper($ordenes))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaorden'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR ORDENES MEDICAS POR FECHAS ##############################

########################## FUNCION LISTAR ORDENES MEDICAS POR MEDICO ##############################
function TablaListarOrdenesMedicasxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarOrdenesMedicasxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE �RDENES M�DICAS POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(180,8,'�RDENES M�DICAS',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,180,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $replace = str_replace(",,","\n", $reg[$i]['ordenmedica']);
    $ordenes = str_replace("/",":", $replace);

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode(strtoupper($ordenes))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaorden'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR ORDENES MEDICAS POR MEDICO ##############################

########################## FUNCION LISTAR ORDENES MEDICAS POR PACIENTE ##############################
function TablaListarOrdenesMedicasxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarOrdenesMedicasxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE �RDENES M�DICAS POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(180,8,'�RDENES M�DICAS',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,180,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $replace = str_replace(",,","\n", $reg[$i]['ordenmedica']);
    $ordenes = str_replace("/",":", $replace);

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode(strtoupper($ordenes))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaorden'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR ORDENES MEDICAS POR PACIENTE ##############################

############################### REPORTES DE ORDENES MEDICAS ##############################

















############################### REPORTES DE FORMULAS DE TERAPIAS ##############################

############################### FUNCION PARA MOSTRAR FORMULAS DE TERAPIAS ################################# 
function TablaFormulasTerapias()
  {
    $tra = new Login();
    $reg = $tra->FormulasTerapiasPorId();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'F�RMULAS DE TERAPIAS',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

   $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'F�RMULAS DE TERAPIAS',1,1,'C', True);

    $this->SetX(6);
    $this->SetFont('Courier','B',11);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(100,5,'TERAPIAS RESPIRATORIAS' ,1,0,'L');
    $this->Cell(30,5,'SERIES' ,1,0,'L');
    $this->SetFont('Courier','',11); 
    $this->Cell(30,5,$reg[0]['terapiasrespiratorias'],1,0,'L');
    $this->SetFont('Courier','B',11); 
    $this->Cell(40,5,'DX' ,1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','B',11);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(100,5,'TERAPIAS FISICAS' ,1,0,'L');
    $this->Cell(30,5,'SERIES' ,1,0,'L');
    $this->SetFont('Courier','',11); 
    $this->Cell(30,5,$reg[0]['terapiasfisicas'],1,0,'L');
    $this->SetFont('Courier','B',11); 
    $this->Cell(40,5,'DX' ,1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','B',11);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(100,5,'MICRONEBULIZACIONES' ,1,0,'L');
    $this->Cell(30,5,'' ,1,0,'L');
    $this->SetFont('Courier','',11); 
    $this->Cell(30,5,$reg[0]['micronebulizaciones'],1,0,'L');
    $this->SetFont('Courier','B',11); 
    $this->Cell(40,5,'DIAS' ,1,1,'L');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

}
############################### FUNCION PARA MOSTRAR FORMULAS DE TERAPIAS #################################

########################## FUNCION LISTAR FORMULAS DE TERAPIAS ##############################
function TablaListarFormulasTerapias()
{

    $tra = new Login();
    $reg = $tra->ListarFormulasTerapias();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE F�RMULAS DE TERAPIAS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(30,8,'RESPIRATORIAS',1,0,'C', True);
    $this->Cell(30,8,'FISICAS',1,0,'C', True);
    $this->Cell(50,8,'MICRONEBULIZACIONES',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,30,30,50,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['terapiasrespiratorias'])),
        portales(utf8_decode($reg[$i]['terapiasfisicas'])),
        portales(utf8_decode($reg[$i]['micronebulizaciones'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR FORMULAS DE TERAPIAS ##############################

########################## FUNCION LISTAR FORMULAS DE TERAPIAS POR FECHAS ##############################
function TablaListarFormulasTerapiasxFechas()
{

    $tra = new Login();
    $reg = $tra->BuscarFormulasTerapiasxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE FORMULAS DE TERAPIAS POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(50,8,'RESPIRATORIAS',1,0,'C', True);
    $this->Cell(50,8,'FISICAS',1,0,'C', True);
    $this->Cell(50,8,'MICRONEBULIZACIONES',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,70,70,50,50,50,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['terapiasrespiratorias'])),
        portales(utf8_decode($reg[$i]['terapiasfisicas'])),
        portales(utf8_decode($reg[$i]['micronebulizaciones'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR FORMULAS DE TERAPIAS POR FECHAS ##############################

########################## FUNCION LISTAR FORMULAS DE TERAPIAS POR MEDICO ##############################
function TablaListarFormulasTerapiasxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarFormulasTerapiasxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE FORMULAS DE TERAPIAS POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(120,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(50,8,'RESPIRATORIAS',1,0,'C', True);
    $this->Cell(50,8,'FISICAS',1,0,'C', True);
    $this->Cell(50,8,'MICRONEBULIZACIONES',1,0,'C', True);
    $this->Cell(55,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,120,50,50,50,55));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['terapiasrespiratorias'])),
        portales(utf8_decode($reg[$i]['terapiasfisicas'])),
        portales(utf8_decode($reg[$i]['micronebulizaciones'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR FORMULAS DE TERAPIAS POR MEDICO ##############################

########################## FUNCION LISTAR FORMULAS DE TERAPIAS POR PACIENTE ##############################
function TablaListarFormulasTerapiasxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarFormulasTerapiasxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE FORMULAS DE TERAPIAS POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(120,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(50,8,'RESPIRATORIAS',1,0,'C', True);
    $this->Cell(50,8,'FISICAS',1,0,'C', True);
    $this->Cell(50,8,'MICRONEBULIZACIONES',1,0,'C', True);
    $this->Cell(55,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,120,50,50,50,55));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($reg[$i]['terapiasrespiratorias'])),
        portales(utf8_decode($reg[$i]['terapiasfisicas'])),
        portales(utf8_decode($reg[$i]['micronebulizaciones'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR FORMULAS DE TERAPIAS POR PACIENTE ##############################

############################### REPORTES DE FORMULAS DE TERAPIAS ##############################


















############################### REPORTES DE SOLICITUD EXAMENES ##############################

############################### FUNCION PARA MOSTRAR SOLICITUD EXAMENES ################################# 
function TablaSolicitudExamenes()
  {
    $tra = new Login();
    $reg = $tra->SolicitudExamenesPorId();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'SOLICITUD EX�MENES',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetFont('Courier','B',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(45,4,'N�MERO DE IDENTIFICACI�N: ',0,0,'L');
    $this->SetFont('Courier','',8); 
    $this->CellFitSpace(70,4,$reg[0]['cedpaciente'],0,0,'L');

    $this->SetFont('Courier','B',8); 
    $this->CellFitSpace(40,4,'TIPO DE IDENTIFICACI�N: ',0,0,'L');
    $this->SetFont('Courier','',8); 
    $this->CellFitSpace(35,4,$reg[0]['documento4'],0,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','B',8);  
    $this->CellFitSpace(45,4,'NOMBRES Y APELLIDOS: ',0,0,'L');
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(70,4,utf8_decode($reg[0]['nompaciente'].' '.$reg[0]['apepaciente']),0,0,'L');


    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(40,4,'ESTADO CIVIL: ',0,0,'L');
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(35,4,utf8_decode($reg[0]['estadopaciente']),0,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','B',8);  
    $this->CellFitSpace(45,4,'FECHA DE NACIMIENTO: ',0,0,'L');
    $this->SetFont('Courier','',8);  
    $this->CellFitSpace(70,4,$fecha_nacimiento = ($reg[0]['fnacpaciente'] == '0000-00-00' ? "**********" : date("d-m-Y", strtotime($reg[0]['fnacpaciente']))),0,0,'L');

    $this->SetFont('Courier','B',8); 
    $this->CellFitSpace(40,4,'EDAD: ',0,0,'L');
    $this->SetFont('Courier','',8); 
    $this->CellFitSpace(35,4,edad($reg[0]['fnacpaciente']).' A�OS',0,0,'L');
    $this->Ln();

    $this->SetFont('Courier','B',8);  
    $this->CellFitSpace(45,4,'GRUPO SANGUINEO: ',0,0,'L');
    $this->SetFont('Courier','',8);  
    $this->CellFitSpace(70,4,$reg[0]['gruposapaciente'],0,0,'L');

    $this->SetFont('Courier','B',8); 
    $this->CellFitSpace(40,4,'FECHA ELABORACI�N: ',0,0,'L');
    $this->SetFont('Courier','',8); 
    $this->CellFitSpace(35,4,date("d-m-Y H:i:s", strtotime($reg[0]['fechasolicitud'])),0,0,'L');
    $this->Ln(6);

    
    $this->Ln();
    $this->SetFont('Courier','B',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'HEMATOLOGIA',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Cell(20,5,'',0,0,'L');
    $this->Cell(70,5,'MICROSCOPIA',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->Cell(70,5,'CUADRO HEMATICO',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['cuadrohepatico'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->SetFont('Courier','',9);
    $this->Cell(70,5,'PARCIAL DE ORINA',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['parcialorina'],1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'HEMATOCRITO',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['hematocrito'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->SetFont('Courier','',9);
    $this->Cell(70,5,'COPROLOGICO/MATERIA FECAL',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['materiafecal'],1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'HEMOGLOBINA',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['hemoglobina'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->SetFont('Courier','',9);
    $this->Cell(70,5,'BACILOSCOPIA ESPUTO',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['basiloscopia'],1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'VSG',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['vsg'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->SetFont('Courier','',9);
    $this->Cell(70,5,'KOH',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['koh'],1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'ESP',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['esp'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->SetFont('Courier','',9);
    $this->Cell(70,5,'FROTIS FLUJO VAGINAL',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['flujovaginal'],1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'EXT. GOTA GRUESA',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['gotagruesa'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->Cell(70,5,'',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'GRUPO O FACTOR RH',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['factorrh'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->Cell(70,5,'',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Cell(20,5,'',0,0,'L');
    $this->Cell(70,5,'',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','B',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'QU�MICA SANGU�NEA',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Cell(20,5,'',0,0,'L');
    $this->Cell(70,5,'INMUNOLOGIA',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Cell(20,5,'',0,0,'L');
    $this->Cell(70,5,'',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'GLICEMIA',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['glicemia'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->SetFont('Courier','',9);
    $this->Cell(70,5,'GRAVINDEX/PRUEBA DE EMBARAZO',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['embarazo'],1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'COLESTEROL TOTAL',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['colesteroltotal'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->SetFont('Courier','',9);
    $this->Cell(70,5,'SEROLOGIA VDRL',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['serologia'],1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'COLESTEROL HDL',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['colesterolhdl'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->Cell(70,5,'',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'COLESTEROL LDL',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['colesterolldl'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(70,5,'OTROS',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['otros'],1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'TRIGLICERIDOS',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['trigliceridos'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->Cell(70,5,'',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'CREATININA',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['creatinina'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->Cell(70,5,'',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'BUN',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['bun'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->Cell(70,5,'',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'UREA',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['urea'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->Cell(70,5,'',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'�CIDO �RICO',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['acidourico'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->Cell(70,5,'',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(70,5,'GLICEMIA PRE Y POST',1,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(15,5,$reg[0]['gliecemiapre'],1,0,'C');
    $this->Cell(20,5,'',0,0,'L');
    $this->Cell(70,5,'',1,0,'L');
    $this->Cell(15,5,'',1,0,'L');
    $this->Ln(12);
    
    $this->SetFont('Courier','B',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(50,5,'EX�MENES DE SANGRE:',1,0,'C');
    $this->Cell(140,5,'AYUNO APROXIMADO DE 8 HORAS',1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','B',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(50,5,'PARCIAL DE ORINA:',1,0,'C');
    $this->Cell(140,5,'PRIMERA ORINA DE LA MA�ANA NO DEBE TENER MAS DE 2 HORAS DE RECOLECCI�N',1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','B',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(50,5,'',1,0,'C');
    $this->Cell(140,5,'NO TENER RELACIONES SEXUALES MINIMO 3 DIAS',1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','B',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(50,5,'FROTIS FLUJO:',1,0,'C');
    $this->Cell(140,5,'NO APLICARSE CREMA U OVULOS',1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','B',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(50,5,'',1,0,'L');
    $this->Cell(140,5,'NO REALIARSE DUCHAS VAGINALES',1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','B',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(50,5,'KOH:',1,0,'C');
    $this->Cell(140,5,'NO APLICARSE CREMAS EL DIA ANTERIOR',1,0,'C');
    $this->Ln();
    
    $this->Ln();
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(190,5,'DX: '.utf8_decode(strtoupper($reg[0]['codcie'].": ".$reg[0]['nombrecie'])),0,0,'L');

    $this->Ln(18); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechasolicitud'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechasolicitud'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechasolicitud'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechasolicitud'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

}
############################### FUNCION PARA MOSTRAR SOLICITUD EXAMENES #################################

########################## FUNCION LISTAR SOLICITUD EXAMENES ##############################
function TablaListarSolicitudExamenes()
{

    $tra = new Login();
    $reg = $tra->ListarSolicitudExamenes();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE SOLICITUD EX�MENES',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(110,8,'DESCRIPCI�N DE CIE',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,110,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode(strtoupper($reg[$i]['codcie'].": ".$reg[$i]['nombrecie']))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechasolicitud']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR SOLICITUD EXAMENES ##############################

########################## FUNCION LISTAR SOLICITUD EXAMENES POR FECHAS ##############################
function TablaListarSolicitudExamenesxFechas()
{

    $tra = new Login();
    $reg = $tra->BuscarSolicitudExamenesxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE SOLICITUD EX�MENES POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(150,8,'DESCRIPCI�N DE CIE',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,70,70,150,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode(strtoupper($reg[$i]['codcie'].": ".$reg[$i]['nombrecie']))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechasolicitud'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR SOLICITUD EXAMENES POR FECHAS ##############################

########################## FUNCION LISTAR SOLICITUD EXAMENES POR MEDICO ##############################
function TablaListarSolicitudExamenesxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarSolicitudExamenesxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE SOLICITUD EX�MENES POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(180,8,'DESCRIPCI�N DE CIE',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,180,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode(strtoupper($reg[$i]['codcie'].": ".$reg[$i]['nombrecie']))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechasolicitud'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR SOLICITUD EXAMENES POR MEDICO ##############################

########################## FUNCION LISTAR SOLICITUD EXAMENES POR PACIENTE ##############################
function TablaListarSolicitudExamenesxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarSolicitudExamenesxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE SOLICITUD EX�MENES POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(180,8,'DESCRIPCI�N DE CIE',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,180,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode(strtoupper($reg[$i]['codcie'].": ".$reg[$i]['nombrecie']))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechasolicitud'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR SOLICITUD EXAMENES POR PACIENTE ##############################

############################### REPORTES DE SOLICITUD EXAMENES ##############################






















############################### REPORTES DE CRIOCAUTERIZACIONES ##############################

############################### FUNCION PARA MOSTRAR CRIOCAUTERIZACIONES ################################# 
function TablaCriocauterizaciones()
  {
    $tra = new Login();
    $reg = $tra->CriocauterizacionesPorId();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'CRIOCAUTERIZACI�N',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'MOTIVO DE CONSULTA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',12).portales(utf8_decode($reg[0]['motivoconsulta'])),1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'ATENCI�N ACTIVIDAD Y/O PROCEDIMIENTO',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11).portales(utf8_decode($reg[0]['atenproced'])),1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'IMPRESI�N DIAGN�STICA',1,1,'C', True);

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['dxpresuntivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciepresuntivo,$presuntivo,$observacionpresuntivo) = explode("/",$explode[$cont]);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',10).$idciepresuntivo == '' ? "" : "".$a++.". ".$presuntivo.". \nOBSERVACI�N: ".utf8_decode(trim($observacionpresuntivo)),1,'J');
    
    endfor;

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'IDENTIFICACI�N DEL ORIGEN DE LA ENFERMEDAD',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11).portales(utf8_decode($reg[0]['origenenfermedad'])),1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'CONDUCTA O PLAN DE TRATAMIENTO',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11).portales(utf8_decode($reg[0]['tratamiento'])),1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DIAGN�STICO DEFINITIVO',1,1,'C', True);

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['dxdefinitivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciedefinitivo,$definitivo,$observaciondefinitivo) = explode("/",$explode[$cont]);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',10).$idciedefinitivo == '' ? "" : "".$a++.". ".$definitivo.". \nOBSERVACI�N: ".utf8_decode(trim($observaciondefinitivo)),1,'J');
    
    endfor;

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechacriocauterizacion'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechacriocauterizacion'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechacriocauterizacion'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechacriocauterizacion'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }



    ########################## AQUI MUESTRO REMISION ##########################
    if (isset($reg[0]['remision'])) {

    $this->AddPage();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'REMISI�N',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'REMISI�N',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',12).portales(utf8_decode($reg[0]['remision'])),1,'L');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fecharemision'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    }
    ########################## AQUI MUESTRO REMISION ##########################




    ########################## AQUI MUESTRO FORMULA MEDICAS ##########################
    if (isset($reg[0]['formulamedica'])) {

    $this->AddPage();

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['formulamedica'])));

    # Recorremos el array
    for($cont = 0, $s = sizeof($explode); $cont < $s; $cont++):
   
    # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
    list($idcieformula,$formula,$observacionformula) = explode("/",$explode[$cont]);

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'F�RMULA M�DICA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'F�RMULA M�DICA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."DX: ".portales(utf8_decode($formula))." \nF�RMULA: ".utf8_decode(trim($observacionformula)),1,'J');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaformula'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    if($cont != $s - 1) {
            $this->AddPage();
                                  } ##fin de if
                                                   endfor; ##fin de for*/
    }
    ########################## AQUI MUESTRO FORMULA MEDICAS ##########################





    ########################## AQUI MUESTRO ORDENES MEDICAS ##########################
    if (isset($reg[0]['ordenmedica'])) {

    $this->AddPage();

    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['ordenmedica'])));

    # Recorremos el array
    for($cont = 0, $s = sizeof($explode); $cont < $s; $cont++):
   
    # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
    list($idcieorden,$orden,$observacionorden) = explode("/",$explode[$cont]);

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'�RDEN M�DICA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'EN CASO NECESARIO AVISAR A',1,0,'C');
    $this->CellFitSpace(40,4,'PARENTESCO AFINIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'DIRECCI�N',1,0,'C');
    $this->CellFitSpace(40,4,'N� TEL�FONO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['nomacompana'] == '' ? "*******" : $reg[0]['nomacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['parentescoacompana'] == '' ? "*******" : $reg[0]['parentescoacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['direcacompana'] == '' ? "*******" : $reg[0]['direcacompana'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['tlfacompana'] == '' ? "*******" : $reg[0]['tlfacompana'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'�RDEN M�DICA',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',11)."DX: ".portales(utf8_decode($orden))." \nF�RMULA: ".utf8_decode(trim($observacionorden)),1,'J');

    $this->Ln(12); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,$this->Image($img, $this->GetX()+135, $this->GetY()-10, 35), 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    } else {

    $this->SetX(6);
    $this->SetFont('Courier','BI',11);
    $this->Cell(200, 4,'', 0, 1, "JPG" );
    
    $this->SetX(6);
    $this->Cell(100, 4,'FECHA ELABORACI�N: '.date("d-m-Y", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'HORA ELABORACI�N: '.date("H:i:s", strtotime($reg[0]['fechaorden'])), 0, 0);
    $this->Cell(100,4,portales(utf8_decode($reg[0]['nomespecialidad'])),0,1,'C');

    $this->SetX(6);
    $this->Cell(100, 4,'', 0, 0);
    $this->Cell(100,4,'M.P.S. '.utf8_decode($reg[0]['mps']),0,1,'C');

    }

    $this->Ln(8);
    $this->SetFont('Courier','B',8);
    $this->Cell(190,0,'- - - - - - - - - - -  - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);

    if($cont != $s - 1) {
            $this->AddPage();
                                  } ##fin de if
                                                   endfor; ##fin de for*/

    }
    ########################## AQUI MUESTRO ORDENES MEDICAS ##########################

}
############################### FUNCION PARA MOSTRAR CRIOCAUTERIZACIONES #################################

########################## FUNCION LISTAR CRIOCAUTERIZACIONES ##############################
function TablaListarCriocauterizaciones()
{

    $tra = new Login();
    $reg = $tra->ListarCriocauterizaciones();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE CRIOCAUTERIZACIONES',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(60,8,'MOTIVO CONSULTA',1,0,'C', True);
    $this->Cell(50,8,'ATENCI�N / ACTIVIDAD',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,60,50,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['motivoconsulta'])),
        portales(utf8_decode($reg[$i]['atenproced'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechacriocauterizacion']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR CRIOCAUTERIZACIONES ##############################

########################## FUNCION LISTAR CRIOCAUTERIZACIONES POR FECHAS ##############################
function TablaListarCriocauterizacionesxFechas()
{

    $tra = new Login();
    $reg = $tra->BuscarCriocauterizacionesxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE CRIOCAUTERIZACIONES POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(75,8,'MOTIVO CONSULTA',1,0,'C', True);
    $this->Cell(75,8,'ATENCI�N / ACTIVIDAD',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,70,70,75,75,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['motivoconsulta'])),
        portales(utf8_decode($reg[$i]['atenproced'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechacriocauterizacion'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR CRIOCAUTERIZACIONES POR FECHAS ##############################

########################## FUNCION LISTAR CRIOCAUTERIZACIONES POR MEDICO ##############################
function TablaListarCriocauterizacionesxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarCriocauterizacionesxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE CRIOCAUTERIZACIONES POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(90,8,'MOTIVO CONSULTA',1,0,'C', True);
    $this->Cell(90,8,'ATENCI�N / ACTIVIDAD',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,90,90,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['motivoconsulta'])),
        portales(utf8_decode($reg[$i]['atenproced'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechacriocauterizacion'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR CRIOCAUTERIZACIONES POR MEDICO ##############################

########################## FUNCION LISTAR CRIOCAUTERIZACIONES POR PACIENTE ##############################
function TablaListarCriocauterizacionesxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarCriocauterizacionesxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE CRIOCAUTERIZACIONES POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(90,8,'MOTIVO CONSULTA',1,0,'C', True);
    $this->Cell(90,8,'ATENCI�N / ACTIVIDAD',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,90,90,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($reg[$i]['motivoconsulta'])),
        portales(utf8_decode($reg[$i]['atenproced'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechacriocauterizacion'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR CRIOCAUTERIZACIONES POR PACIENTE ##############################

############################### REPORTES DE CRIOCAUTERIZACIONES ##############################

















############################### REPORTES DE COLPOSCOPIAS ##############################

############################### FUNCION PARA MOSTRAR COLPOSCOPIAS ################################# 
function TablaColposcopia()
  {
    $tra = new Login();
    $reg = $tra->ColposcopiasPorId();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'COLPOSCOPIA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(200,90,$this->Image('./fotos/img_colpos.png', $this->GetX()+0.1, $this->GetY()+0.1, 200), 1, 0, "PNG" );
    $this->Ln();

    $this->Ln(0.1);
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'RESULTADO DE COLPOSCOPIA',1,0,'C', True);
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(74,5,'1.EPITELIO ORIGINAL CAPILAR FINA:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['epiteliooriginal']),1,0,'L');
    $this->CellFitSpace(94,5,'- Zona de Transformaci�n T�pica:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['transformaciontipica']),1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(74,5,'2. ASPECTO INFLAMATORIO:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['aspectoinflamatorio']),1,0,'L');
    $this->CellFitSpace(94,5,'- Zona de Transformaci�n At�pica:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['transformacionatipica']),1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(74,5,'- Aumento red vascular y/o vasos dilatados:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['aumentoredvascular']),1,0,'L');
    $this->CellFitSpace(94,5,'- Mosaico:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['mosaico']),1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(74,5,'3. IMAGENES ATIPICAS:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['imagenesatipicas']),1,0,'L');
    $this->CellFitSpace(94,5,'- Vasos at�picos(hormquilla, sacacorchos, astenosis, dilataciones):',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['vasosatipicos']),1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(74,5,'- Epitelio Acetoblanco:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['epitelioacetoblanco']),1,0,'L');
    $this->CellFitSpace(94,5,'- Condiloma:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['condiloma']),1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(74,5,'- Base o punteado:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['baseopunteado']),1,0,'L');
    $this->CellFitSpace(94,5,'- Severas alteraciones vasculares y/o aumento de la distancia intercapilar:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['alteracionesvasculares']),1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(74,5,'4. ASPECTO TUMORAL:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['aspectotumoral']),1,0,'L');
    $this->CellFitSpace(94,5,'- VPH:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['vph']),1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(74,5,'- Ulcerativo:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['ulcerativo']),1,0,'L');
    $this->CellFitSpace(94,5,'- NIC:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['nic']),1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(74,5,'- Proliferativo:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['proliferativo']),1,0,'L');
    $this->CellFitSpace(94,5,'- Ca. Invasor:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['cainvasor']),1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(74,5,'5. IMPRESI�N DIAGNOSTICA:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['impresiondiagnostica']),1,0,'L');
    $this->CellFitSpace(94,5,'- Normal:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['impresionnormal']),1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(74,5,'- Inflamatoria:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['impresioninflamatoria']),1,0,'L');
    $this->Cell(94,5,'',1,0,'L');
    $this->Cell(16,5,'',1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'OBSERVACI�N',1,0,'C', True);
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,portales(utf8_decode($reg[0]['observacionesimpresion'])),1,'J');

    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(100,5,'1. LA UNI�N ESCAMOCOLUMNAR ES VISIBLE? '.$reg[0]['tunion'],1,0,'L');
    $this->Cell(100,5,'2. LA LESI�N ES COMPLETAMENTE VISIBLE? '.$reg[0]['tlesion'],1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',8).'OTROS: '.utf8_decode($reg[0]['otros']),1,'L');
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',8).'SITIO DE LA BIOPSIA: '.utf8_decode($reg[0]['biopsia']),1,'L');
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(74,5,'- Exocervix:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['exocervix']),1,0,'L');
    $this->CellFitSpace(94,5,'- Vagina:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['vagina']),1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(74,5,'- Uniones escamoculumnar:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['escamoculumnar']),1,0,'L');
    $this->CellFitSpace(94,5,'- Endocervix:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['endocervix']),1,0,'L');
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(74,5,'- Endometrio:',1,0,'L');
    $this->Cell(16,5,utf8_decode($reg[0]['endometrio']),1,0,'L');
    $this->Cell(94,5,'',0,0,'L');
    $this->Cell(16,5,'',0,0,'L');
    $this->Ln(20);
    
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetFont('Courier','BI',12);
    $this->Cell(0, 0,$this->Image($img, $this->GetX()+150, $this->GetY()-15, 35), 0, 0, "JPG" );
    $this->Ln(4);
    $this->Cell(300,0,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,portales(utf8_decode($reg[0]['nomespecialidad'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,'M.P.S. '.utf8_decode($reg[0]['mps']),'',1,'C');

    } else {

    $this->SetFont('Courier','BI',12);
    $this->Cell(0, 0,'', 0, 0, "JPG" );
    $this->Ln(4);
    $this->Cell(300,0,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,portales(utf8_decode($reg[0]['nomespecialidad'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,'M.P.S. '.utf8_decode($reg[0]['mps']),'',1,'C');
    }

}
############################### FUNCION PARA MOSTRAR COLPOSCOPIAS ################################# 

########################## FUNCION LISTAR COLPOSCOPIAS ##############################
function TablaListarColposcopias()
{

    $tra = new Login();
    $reg = $tra->ListarColposcopias();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE COLPOSCOPIAS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(60,8,'IMPRESI�N DIAGNOSTICA',1,0,'C', True);
    $this->Cell(50,8,'SITIO DE BIOPSIA',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,60,50,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['impresiondiagnostica'] == '' ? "************" : $reg[$i]['impresiondiagnostica'])),
        portales(utf8_decode($reg[$i]['biopsia'] == '' ? "************" : $reg[$i]['biopsia'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechacolposcopia']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR COLPOSCOPIAS ##############################

########################## FUNCION LISTAR COLPOSCOPIAS POR FECHAS ##############################
function TablaListarColposcopiasxFechas()
{

    $tra = new Login();
    $reg = $tra->BuscarColposcopiasxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE COLPOSCOPIAS POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(75,8,'IMPRESI�N DIAGNOSTICA',1,0,'C', True);
    $this->Cell(75,8,'SITIO DE BIOPSIA',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,70,70,75,75,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['impresiondiagnostica'] == '' ? "************" : $reg[$i]['impresiondiagnostica'])),
        portales(utf8_decode($reg[$i]['biopsia'] == '' ? "************" : $reg[$i]['biopsia'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechacolposcopia'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR COLPOSCOPIAS POR FECHAS ##############################

########################## FUNCION LISTAR COLPOSCOPIAS POR MEDICO ##############################
function TablaListarColposcopiasxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarColposcopiasxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE COLPOSCOPIAS POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(90,8,'IMPRESI�N DIAGNOSTICA',1,0,'C', True);
    $this->Cell(90,8,'SITIO DE BIOPSIA',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,90,90,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['impresiondiagnostica'] == '' ? "************" : $reg[$i]['impresiondiagnostica'])),
        portales(utf8_decode($reg[$i]['biopsia'] == '' ? "************" : $reg[$i]['biopsia'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechacolposcopia'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR COLPOSCOPIAS POR MEDICO ##############################

########################## FUNCION LISTAR COLPOSCOPIAS POR PACIENTE ##############################
function TablaListarColposcopiasxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarColposcopiasxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE COLPOSCOPIAS POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(90,8,'IMPRESI�N DIAGNOSTICA',1,0,'C', True);
    $this->Cell(90,8,'SITIO DE BIOPSIA',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,90,90,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($reg[$i]['impresiondiagnostica'] == '' ? "************" : $reg[$i]['impresiondiagnostica'])),
        portales(utf8_decode($reg[$i]['biopsia'] == '' ? "************" : $reg[$i]['biopsia'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechacolposcopia'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR COLPOSCOPIAS POR PACIENTE ##############################

############################### REPORTES DE COLPOSCOPIAS ##############################















############################### REPORTES DE ECOGRAFIAS ##############################

############################### FUNCION PARA MOSTRAR ECOGRAFIAS ################################# 
function TablaEcografia()
  {
    $tra = new Login();
    $reg = $tra->EcografiasPorId();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'ECOGRAF�A',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->Ln(0.1);
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'PROCEDIMIENTO ECOGR�FICO',1,0,'C', True);
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,portales(utf8_decode($reg[0]['procedimiento'])),1,'J');
    
    
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DESCRIPCI�N ECOGR�FICA',1,0,'C', True);
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,portales(utf8_decode($reg[0]['diagnostico'])),1,'J');
    $this->Ln(20);
    
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetFont('Courier','BI',12);
    $this->Cell(0, 0,$this->Image($img, $this->GetX()+150, $this->GetY()-15, 35), 0, 0, "JPG" );
    $this->Ln(4);
    $this->Cell(300,0,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,portales(utf8_decode($reg[0]['nomespecialidad'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,'M.P.S. '.utf8_decode($reg[0]['mps']),'',1,'C');

    } else {

    $this->SetFont('Courier','BI',12);
    $this->Cell(0, 0,'', 0, 0, "JPG" );
    $this->Ln(4);
    $this->Cell(300,0,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,portales(utf8_decode($reg[0]['nomespecialidad'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,'M.P.S. '.utf8_decode($reg[0]['mps']),'',1,'C');
    
    }

    $directory="fotos/ecografias/".$reg[0]['codecografia'];
    
    if (is_dir($directory)) {

    $this->AddPage();

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'IM�GENES ECOGRAFICAS',0,0,'C');
    $this->Ln(10);


    $dirint = dir($directory);
    $p=1;
    $rows = 0;
    while (($archivo = $dirint->read()) !== false)
    {

        if (substr_count($archivo , ".gif")==1 || substr_count($archivo , ".jpg")==1 || substr_count($archivo , ".png")==1 ){
    
    $this->SetFont('Arial','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    //$this->Cell(35,35,$this->Image($directory."/".$archivo, $this->GetX()+10, $this->GetY()+1, 30), 0, 0, "" );
    $this->Cell(49,50,$this->Image($directory."/".$archivo, $this->GetX()+1, $this->GetY()+1, 45), 1, 0, "");

        ######## FUNCION SALTO DE LINEA ########
        $rows++;
        if ($rows == 4) {
            $rows = 0;
            $this->Ln();
            //$this->AddPage();
        }
        ######## FUNCION SALTO DE LINEA ########

                }
            }
        $dirint->close();

    }//FIN MOSTRAR PAGINA IMAGENES
}
############################### FUNCION PARA MOSTRAR ECOGRAFIAS ################################# 

########################## FUNCION LISTAR ECOGRAFIAS ##############################
function TablaListarEcografias()
{

    $tra = new Login();
    $reg = $tra->ListarEcografias();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE ECOGRAFIAS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(110,8,'PROCEDIMIENTO ECOGR�FICO',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,110,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['procedimiento'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaecografia']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR ECOGRAFIAS ##############################

########################## FUNCION LISTAR ECOGRAFIAS POR FECHAS ##############################
function TablaListarEcografiasxFechas()
{

    $tra = new Login();
    $reg = $tra->BuscarEcografiasxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE ECOGRAFIAS POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(150,8,'PROCEDIMIENTO ECOGR�FICO',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,70,70,150,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['procedimiento'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaecografia'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR ECOGRAFIAS POR FECHAS ##############################

########################## FUNCION LISTAR ECOGRAFIAS POR MEDICO ##############################
function TablaListarEcografiasxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarEcografiasxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE ECOGRAFIAS POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(180,8,'PROCEDIMIENTO ECOGR�FICO',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,180,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['procedimiento'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaecografia'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR ECOGRAFIAS POR MEDICO ##############################

########################## FUNCION LISTAR ECOGRAFIAS POR PACIENTE ##############################
function TablaListarEcografiasxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarEcografiasxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE ECOGRAFIAS POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(180,8,'PROCEDIMIENTO ECOGR�FICO',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,180,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($reg[$i]['procedimiento'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaecografia'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR ECOGRAFIAS POR PACIENTE ##############################

############################### REPORTES DE ECOGRAFIAS ##############################

















############################### REPORTES DE EXAMENES DE LABORATORIOS ##############################

############################### FUNCION PARA MOSTRAR EX�MEN DE LABORATORIO ################################# 
function TablaLaboratorio()
  {
    $tra = new Login();
    $reg = $tra->LaboratoriosPorId();

    $valor = new Login();
    $valor = $valor->ValoresPorId();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################
    
    $this->Ln();
    $this->SetFont('Courier','B',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(45,4,'N�MERO DE IDENTIFICACI�N: ',0,0,'L');
    $this->SetFont('Courier','',8); 
    $this->CellFitSpace(70,4,$reg[0]['cedpaciente'],0,0,'L');

    $this->SetFont('Courier','B',8); 
    $this->CellFitSpace(40,4,'TIPO DE IDENTIFICACI�N: ',0,0,'L');
    $this->SetFont('Courier','',8); 
    $this->CellFitSpace(35,4,$reg[0]['documento4'],0,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','B',8);  
    $this->CellFitSpace(45,4,'NOMBRES Y APELLIDOS: ',0,0,'L');
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(70,4,utf8_decode($reg[0]['nompaciente'].' '.$reg[0]['apepaciente']),0,0,'L');


    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(40,4,'ESTADO CIVIL: ',0,0,'L');
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(35,4,utf8_decode($reg[0]['estadopaciente']),0,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','B',8);  
    $this->CellFitSpace(45,4,'FECHA DE NACIMIENTO: ',0,0,'L');
    $this->SetFont('Courier','',8);  
    $this->CellFitSpace(70,4,$fecha_nacimiento = ($reg[0]['fnacpaciente'] == '0000-00-00' ? "**********" : date("d-m-Y", strtotime($reg[0]['fnacpaciente']))),0,0,'L');

    $this->SetFont('Courier','B',8); 
    $this->CellFitSpace(40,4,'EDAD: ',0,0,'L');
    $this->SetFont('Courier','',8); 
    $this->CellFitSpace(35,4,edad($reg[0]['fnacpaciente']).' A�OS',0,0,'L');
    $this->Ln();

    $this->SetFont('Courier','B',8);  
    $this->CellFitSpace(45,4,'GRUPO SANGUINEO: ',0,0,'L');
    $this->SetFont('Courier','',8);  
    $this->CellFitSpace(70,4,$reg[0]['gruposapaciente'],0,0,'L');

    $this->SetFont('Courier','B',8); 
    $this->CellFitSpace(40,4,'FECHA ELABORACI�N: ',0,0,'L');
    $this->SetFont('Courier','',8); 
    $this->CellFitSpace(35,4,date("d-m-Y H:i:s", strtotime($reg[0]['fechalaboratorio'])),0,0,'L');
    $this->Ln(6);
    
    
    $this->SetFont('Courier','B',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(95,4,'HEMATOLOG�A' ,1,0,'C');
    $this->Cell(101,4,'QUIM�CA SANGU�NEA' ,1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'EX�MEN' ,1,0,'C');
    $this->Cell(31,4,'RESULTADO' ,1,0,'C');
    $this->Cell(31,4,'VALOR NORMAL',1,0,'C');
    $this->Cell(33,4,'EX�MEN' ,1,0,'C');
    $this->Cell(31,4,'RESULTADO' ,1,0,'C');
    $this->Cell(37,4,'VALOR NORMAL',1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'HEMATOCRITO' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['hematocrito'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(15,4,$valor[0]['hematocritov'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(33,4,'GLUCOSA' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['glucosa'],1,0,'R');
    $this->Cell(16,4,'mg/dl',1,0,'R');
    $this->Cell(15,4,$valor[0]['glucosav'],1,0,'R');
    $this->Cell(22,4,'mg/dl',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'HEMOGLOBINA' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['hemoglobina'],1,0,'R');
    $this->Cell(16,4,'gr/dl',1,0,'R');
    $this->Cell(15,4,$valor[0]['hemoglobinav'],1,0,'R');
    $this->Cell(16,4,'gr/dl',1,0,'R');
    $this->Cell(33,4,'COLESTEROL TOTAL' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['colesteroltotal'],1,0,'R');
    $this->Cell(16,4,'mg/dl',1,0,'R');
    $this->Cell(15,4,portales(utf8_decode($valor[0]['colesteroltotalv'])),1,0,'R');
    $this->Cell(22,4,'mg/dl',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'LEUCOCITOS' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['leucocitos'],1,0,'R');
    $this->Cell(16,4,'mm3',1,0,'R');
    $this->Cell(15,4,$valor[0]['leucocitosv'],1,0,'R');
    $this->Cell(16,4,'mm3',1,0,'R');
    $this->Cell(33,4,'COLESTEROL HDL' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['colesterolhdl'],1,0,'R');
    $this->Cell(16,4,'mg/dl',1,0,'R');
    $this->Cell(15,4,$valor[0]['colesterolhdlv'],1,0,'R');
    $this->Cell(22,4,'mg/dl',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'NEUTROFILOS' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['neutrofilos'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(15,4,$valor[0]['neutrofilosv'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(33,4,'COLESTEROL LDL' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['colesterolhdl'],1,0,'R');
    $this->Cell(16,4,'mg/dl',1,0,'R');
    $this->Cell(15,4,$valor[0]['colesterolhdlv'],1,0,'R');
    $this->Cell(22,4,'mg/dl',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'LINFOCITOS' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['linfocitos'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(15,4,$valor[0]['linfocitosv'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(33,4,'TRIGLICERIDOS' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['trigliceridos'],1,0,'R');
    $this->Cell(16,4,'mg/dl',1,0,'R');
    $this->Cell(15,4,$valor[0]['trigliceridosv'],1,0,'R');
    $this->Cell(22,4,'mg/dl',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'EOSINOFILOS' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['eosinofilos'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(15,4,$valor[0]['eosinofilosv'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(33,4,'ACIDO �RICO' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['acidourico'],1,0,'R');
    $this->Cell(16,4,'mg/dl',1,0,'R');
    $this->Cell(15,4,$valor[0]['acidouricov'],1,0,'R');
    $this->Cell(22,4,'mg/dl',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'MONOCITOS' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['monositos'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(15,4,$valor[0]['monositosv'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(33,4,'NITROGENO UREICO' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['nitrogenoureico'],1,0,'R');
    $this->Cell(16,4,'mg/dl',1,0,'R');
    $this->Cell(15,4,$valor[0]['nitrogenoureicov'],1,0,'R');
    $this->Cell(22,4,'mg/dl',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'BASOFILOS' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['basofilos'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(15,4,$valor[0]['basofilosv'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(33,4,'CREATININA' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['creatinina'],1,0,'R');
    $this->Cell(16,4,'mg/dl',1,0,'R');
    $this->Cell(15,4,$valor[0]['creatininav'],1,0,'R');
    $this->Cell(22,4,'mg/dl',1,0,'R');
    $this->Ln();
    
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'CAYADOS' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['cayados'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(15,4,$valor[0]['cayadosv'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(33,4,'PROTEINAS TOTALES' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['proteinastotales'],1,0,'R');
    $this->Cell(16,4,'mg/dl',1,0,'R');
    $this->Cell(15,4,$valor[0]['proteinastotalesv'],1,0,'R');
    $this->Cell(22,4,'mg/dl',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'PLAQUETAS' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['plaquetas'],1,0,'R');
    $this->Cell(16,4,'mm3',1,0,'R');
    $this->Cell(15,4,$valor[0]['plaquetasv'],1,0,'R');
    $this->Cell(16,4,'mm3',1,0,'R');
    $this->Cell(33,4,'ALB�MINA' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['albumina'],1,0,'R');
    $this->Cell(16,4,'mg/dl',1,0,'R');
    $this->Cell(15,4,$valor[0]['albuminav'],1,0,'R');
    $this->Cell(22,4,'mg/dl',1,0,'R');
    $this->Ln();
    
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'RETICULOCITOS' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['reticulositos'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(15,4,$valor[0]['reticulositosv'],1,0,'R');
    $this->Cell(16,4,'%',1,0,'R');
    $this->Cell(33,4,'GLOBULINAS' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['globulina'],1,0,'R');
    $this->Cell(16,4,'mg/dl',1,0,'R');
    $this->Cell(15,4,$valor[0]['globulinav'],1,0,'R');
    $this->Cell(22,4,'mg/dl',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'V.S.G' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['vsg'],1,0,'R');
    $this->Cell(16,4,'mm/hr',1,0,'R');
    $this->Cell(15,4,$valor[0]['vsgv'],1,0,'R');
    $this->Cell(16,4,'mm/hr',1,0,'R');
    $this->Cell(33,4,'BILIRRUBINA TOTAL' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['bilirrubinatotal'],1,0,'R');
    $this->Cell(16,4,'mg/dl',1,0,'R');
    $this->Cell(15,4,$valor[0]['bilirrubinatotalv'],1,0,'R');
    $this->Cell(22,4,'mg/dl',1,0,'R');
    $this->Ln();
    
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'PT' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['pt'],1,0,'R');
    $this->Cell(16,4,'seg. CD',1,0,'R');
    $this->Cell(15,4,$valor[0]['ptv'],1,0,'R');
    $this->Cell(16,4,'seg. CD',1,0,'R');
    $this->Cell(33,4,'BILIRRUBINA DIRECTA' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['bilirrubinadirecta'],1,0,'R');
    $this->Cell(16,4,'mg/dl',1,0,'R');
    $this->Cell(15,4,$valor[0]['bilirrubinadirectav'],1,0,'R');
    $this->Cell(22,4,'mg/dl',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'PTT' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['ptt'],1,0,'R');
    $this->Cell(16,4,'seg. CD',1,0,'R');
    $this->Cell(15,4,$valor[0]['pttv'],1,0,'R');
    $this->Cell(16,4,'seg. CD',1,0,'R');
    $this->Cell(33,4,'BILIRRUBINA INDIRECTA' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['bilirrubinaindirecta'],1,0,'R');
    $this->Cell(16,4,'mg/dl',1,0,'R');
    $this->Cell(15,4,$valor[0]['bilirrubinaindirectav'],1,0,'R');
    $this->Cell(22,4,'mg/dl',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(33,4,'HEMOCLASIFICACION' ,1,0,'L');
    $this->Cell(15,4,'GRUPO',1,0,'R');
    $this->Cell(16,4,$reg[0]['clasifgrupo'],1,0,'R');
    $this->Cell(15,4,'RH:',1,0,'R');
    $this->Cell(16,4,$reg[0]['clasifrh'],1,0,'R');
    $this->Cell(33,4,'FOSFATASA ALCALINA' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['fosfatasaalcalina'],1,0,'R');
    $this->Cell(16,4,'UI/L',1,0,'R');
    $this->Cell(15,4,$valor[0]['fosfatasaalcalinav'],1,0,'R');
    $this->Cell(22,4,'UI/L',1,0,'R');
    $this->Ln();
        
    $this->Cell(95,4,'',0,0,'R');
    $this->Cell(33,4,'TGO/AST' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['tgo'],1,0,'R');
    $this->Cell(16,4,'UI/L',1,0,'R');
    $this->Cell(15,4,$valor[0]['tgov'],1,0,'R');
    $this->Cell(22,4,'UI/L',1,0,'R');
    $this->Ln();
    
    $this->Cell(95,4,'',0,0,'R');
    $this->Cell(33,4,'TGP/ALT' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['tgp'],1,0,'R');
    $this->Cell(16,4,'UI/L',1,0,'R');
    $this->Cell(15,4,$valor[0]['tgpv'],1,0,'R');
    $this->Cell(22,4,'UI/L',1,0,'R');
    $this->Ln();
    
    $this->Cell(95,4,'',0,0,'R');
    $this->Cell(33,4,'AMILASA' ,1,0,'L');
    $this->Cell(15,4,$reg[0]['amilasa'],1,0,'R');
    $this->Cell(16,4,'UI/L',1,0,'R');
    $this->Cell(15,4,$valor[0]['amilasav'],1,0,'R');
    $this->Cell(22,4,'UI/L',1,0,'R');
    $this->Ln(6);

    $this->SetFont('Courier','B',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(95,4,'UROAN�LISIS' ,1,0,'C');
    $this->Cell(101,4,'INMUNOLOG�A' ,1,0,'C');
    $this->Ln();
    
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(45,4,'EX�MEN QUIMICO',1,0,'C');
    $this->Cell(40,4,'EX�MEN MICROSCOPICO' ,1,0,'C');
    $this->Cell(10,4,'XC',1,0,'C');
    $this->Cell(33,4,'EX�MEN' ,1,0,'C');
    $this->Cell(31,4,'RESULTADO' ,1,0,'C');
    $this->Cell(37,4,'VALOR NORMAL',1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(25,4,'COLOR',1,0,'L');
    $this->Cell(20,4,$reg[0]['colorquimico'],1,0,'R');
    $this->Cell(40,4,'CELULAS EPITELIALES BAJAS',1,0,'L');
    $this->Cell(10,4,$reg[0]['celulasepibajas'],1,0,'R');
    $this->Cell(33,4,'PRUEBA DE EMBARAZO',1,0,'L');
    $this->Cell(31,4,$reg[0]['pruebaembarazo'],1,0,'R');
    $this->Cell(37,4,'',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(25,4,'ASPECTO',1,0,'L');
    $this->Cell(20,4,$reg[0]['aspectoquimico'],1,0,'R');
    $this->Cell(40,4,'CELULAS EPITELIALES ALTAS',1,0,'L');
    $this->Cell(10,4,$reg[0]['celulasepialtas'],1,0,'R');
    $this->Cell(33,4,'RPR- SISFILIS',1,0,'L');
    $this->Cell(31,4,$reg[0]['rprsisfilis'],1,0,'R');
    $this->Cell(37,4,'',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(25,4,'PH',1,0,'L');
    $this->Cell(20,4,$reg[0]['phquimico'],1,0,'R');
    $this->Cell(20,4,'BACTERIAS',1,0,'L');
    $this->Cell(20,4,$reg[0]['bacteriasmicroscopico'],1,0,'R');
    $this->Cell(10,4,'',1,0,'R');
    $this->Cell(33,4,'RA TEST',1,0,'L');
    $this->Cell(31,4,$reg[0]['ratest'],1,0,'R');
    $this->Cell(37,4,'',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(25,4,'DENSIDAD',1,0,'L');
    $this->Cell(20,4,$reg[0]['phquimico'],1,0,'R');
    $this->Cell(20,4,'LEUCOCITOS',1,0,'L');
    $this->Cell(20,4,$reg[0]['bacteriasmicroscopico'],1,0,'R');
    $this->Cell(10,4,'',1,0,'R');
    $this->Cell(33,4,'ASTOS',1,0,'L');
    $this->Cell(31,4,$reg[0]['astos'],1,0,'R');
    $this->Cell(37,4,'',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(25,4,'PROTEINA',1,0,'L');
    $this->Cell(20,4,$reg[0]['proteinaquimico'],1,0,'R');
    $this->Cell(20,4,'HEMATIES',1,0,'L');
    $this->Cell(20,4,$reg[0]['hematiesmicroscopico'],1,0,'R');
    $this->Cell(10,4,'',1,0,'R');
    $this->Ln();
    
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(25,4,'GLUCOSA',1,0,'L');
    $this->Cell(20,4,$reg[0]['glucosaquimico'],1,0,'R');
    $this->Cell(20,4,'CRISTALES',1,0,'L');
    $this->Cell(20,4,$reg[0]['cristalesmicroscopico'],1,0,'R');
    $this->Cell(10,4,'',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(25,4,'CETONAS',1,0,'L');
    $this->Cell(20,4,$reg[0]['cetonaquimico'],1,0,'R');
    $this->Cell(20,4,'',1,0,'L');
    $this->Cell(20,4,'',1,0,'L');
    $this->Cell(10,4,'',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(25,4,'BILIRRUBINAS',1,0,'L');
    $this->Cell(20,4,$reg[0]['bilirrubinaquimico'],1,0,'R');
    $this->Cell(20,4,'CILINDROS',1,0,'L');
    $this->Cell(20,4,$reg[0]['cilindrosmicroscopico'],1,0,'R');
    $this->Cell(10,4,'',1,0,'L');
    $this->SetFont('Courier','B',7);
    $this->Cell(101,4,'COPROPARASITOLOG�A',1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(25,4,'UROBILINOGENO',1,0,'L');
    $this->Cell(20,4,$reg[0]['urobilinogenoquimico'],1,0,'R');
    $this->Cell(20,4,'',1,0,'L');
    $this->Cell(20,4,'',1,0,'L');
    $this->Cell(10,4,'',1,0,'R');
    $this->Cell(33,4,'COLOR',1,0,'L');
    $this->Cell(16,4,$reg[0]['colorparasitologia'],1,0,'R');
    $this->Cell(15,4,'QUISTE',1,0,'R');
    $this->Cell(37,4,'Blastocystis hominis',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(25,4,'SANGRE',1,0,'L');
    $this->Cell(20,4,$reg[0]['sangrequimico'],1,0,'R');
    $this->Cell(20,4,'MOCO',1,0,'L');
    $this->Cell(20,4,$reg[0]['mocomicroscopico'],1,0,'R');
    $this->Cell(10,4,'',1,0,'R');
    $this->Cell(33,4,'CONSISTENCIA',1,0,'L');
    $this->Cell(16,4,$reg[0]['consistenciaparasitologia'],1,0,'R');
    $this->Cell(15,4,'QUISTE',1,0,'R');
    $this->Cell(37,4,'Endolimax nana',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(25,4,'LEUCOCITOS',1,0,'L');
    $this->Cell(20,4,$reg[0]['leucocitosquimico'],1,0,'R');
    $this->Cell(20,4,'',1,0,'L');
    $this->Cell(20,4,'',1,0,'L');
    $this->Cell(10,4,'',1,0,'R');
    $this->Cell(33,4,'PH',1,0,'L');
    $this->Cell(16,4,$reg[0]['phparasitologia'],1,0,'R');
    $this->Cell(15,4,'QUISTE',1,0,'R');
    $this->Cell(37,4,'Entamoeba coli',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(25,4,'NITRITOS',1,0,'L');
    $this->Cell(20,4,$reg[0]['nitritosquimico'],1,0,'R');
    $this->Cell(20,4,'',1,0,'L');
    $this->Cell(20,4,'',1,0,'L');
    $this->Cell(10,4,'',1,0,'R');
    $this->Cell(33,4,'SANGRE OCULTA',1,0,'L');
    $this->Cell(16,4,$reg[0]['sangreocultaparasitologia'],1,0,'R');
    $this->Cell(15,4,'QUISTE',1,0,'R');
    $this->Cell(37,4,'Entamoeba hitolytica',1,0,'R');
    $this->Ln();
    
    //$this->MultiCellText(95,4,"OBSERVACIONES: ".portales(utf8_decode($reg[0]['observacionesuroanalisis'])),1,'J');
    $this->Cell(95,4,'',0,0,'L');
    $this->Cell(33,4,'AZUCARES REDUCTORES',1,0,'L');
    $this->Cell(16,4,$reg[0]['azucaresparasitologia'],1,0,'R');
    $this->Cell(15,4,'QUISTE',1,0,'R');
    $this->Cell(37,4,'Giardia lamblia',1,0,'R');
    $this->Ln();
    
    $this->Cell(95,4,'',0,0,'L');
    $this->Cell(33,4,'ALMIDONES SIN DIGERIR',1,0,'L');
    $this->Cell(16,4,$reg[0]['almidonesparasitologia'],1,0,'R');
    $this->Cell(15,4,'HUEVO',1,0,'R');
    $this->Cell(37,4,'Ascaris lumbricoides',1,0,'R');
    $this->Ln();
    
    $this->Cell(95,4,'',0,0,'L');
    $this->Cell(33,4,'HONGOS',1,0,'L');
    $this->Cell(16,4,$reg[0]['hongosparasitologia'],1,0,'R');
    $this->Cell(15,4,'HUEVO',1,0,'R');
    $this->Cell(37,4,'Uncinaria',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','B',9); 
    $this->Cell(95,4,'FROTIS DE FLUJO VAGINAL',1,0,'C');
    $this->SetFont('Courier','',7); 
    $this->Cell(33,4,'',1,0,'L');
    $this->Cell(16,4,'',1,0,'R');
    $this->Cell(15,4,'HUEVO',1,0,'R');
    $this->Cell(37,4,'Tricocefalo',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7); 
    $this->Cell(43,4,'EX�MEN FRESCO',1,0,'C');
    $this->Cell(52,4,'GRAM',1,0,'C'); 
    $this->Cell(33,4,'Trichomonas hominis',1,0,'L');
    $this->Cell(16,4,$reg[0]['trichomonaparasitologia'],1,0,'R');
    $this->Cell(15,4,'HUEVO',1,0,'R');
    $this->Cell(37,4,'Tenia sp',1,0,'R');
    $this->Ln();
    
    
    $this->SetFont('Courier','',7); 
    $this->Cell(23,4,'PH',1,0,'L');
    $this->Cell(20,4,$reg[0]['phfresco'],1,0,'R');
    $this->Cell(38,4,'BACILOS GRAM POSITIVO',1,0,'L');
    $this->Cell(14,4,$reg[0]['basilosgranpositivo'],1,0,'R'); 
    $this->Cell(33,4,'Iodamoeba butslii',1,0,'L');
    $this->Cell(16,4,$reg[0]['iodamoebaparasitologia'],1,0,'R');
    $this->Cell(15,4,'HUEVO',1,0,'R');
    $this->Cell(37,4,'Hymenolepis nana',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7); 
    $this->Cell(23,4,'CELULAS GUIA',1,0,'L');
    $this->Cell(20,4,$reg[0]['celulasfresco'],1,0,'R');
    $this->Cell(38,4,'BACILOS GRAM NEGATIVO',1,0,'L');
    $this->Cell(14,4,$reg[0]['basilosgrannegativo'],1,0,'R'); 
    $this->Cell(33,4,'OTROS',1,0,'L');
    $this->Cell(16,4,$reg[0]['iodamoebaparasitologia'],1,0,'R');
    $this->Cell(15,4,'HUEVO',1,0,'R');
    $this->Cell(37,4,'otrosparasitologia',1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7); 
    $this->Cell(23,4,'TEST AMINAS',1,0,'L');
    $this->Cell(20,4,$reg[0]['testaminafresco'],1,0,'R');
    $this->Cell(38,4,'COCOBACILO GRAM VARIAB.',1,0,'L');
    $this->Cell(14,4,$reg[0]['cocobacilogran'],1,0,'R'); 
    $this->Cell(33,4,'',1,0,'L');
    $this->Cell(16,4,'',1,0,'R');
    $this->Cell(15,4,'',1,0,'R');
    $this->Cell(37,4,'',1,0,'R');
    $this->Ln();
    
    
    $this->SetFont('Courier','',7); 
    $this->Cell(23,4,'HONGOS',1,0,'L');
    $this->Cell(20,4,$reg[0]['hongosfresco'],1,0,'R');
    $this->Cell(38,4,'DIPLOCOCO GRAM NEGATIVO',1,0,'L');
    $this->Cell(14,4,$reg[0]['diplococogran'],1,0,'R'); 
    $this->SetFont('Courier','B',7);
    $this->Cell(101,4,'MICROBIOLOG�A',1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','',7); 
    $this->Cell(23,4,'TRICHOMONAS',1,0,'L');
    $this->Cell(20,4,$reg[0]['trichomonafresco'],1,0,'R');
    $this->Cell(38,4,'BLASTOCONIDIAS',1,0,'L');
    $this->Cell(14,4,$reg[0]['blastoconidiasgran'],1,0,'R'); 
    $this->Cell(33,4,'KOH',1,0,'L');
    $this->Cell(68,4,$reg[0]['kohmicro'],1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7); 
    $this->Cell(23,4,'LEUCOCITOS',1,0,'L');
    $this->Cell(20,4,$reg[0]['leucitofresco'],1,0,'R');
    $this->Cell(38,4,'PSEUDOMICELIO',1,0,'L');
    $this->Cell(14,4,$reg[0]['pseudomiceliogran'],1,0,'R'); 
    $this->Cell(33,4,'BACILOSOCOPIA',1,0,'L');
    $this->Cell(68,4,$reg[0]['baciloscopiamicro'],1,0,'R');
    $this->Ln();
    
    $this->SetFont('Courier','',7); 
    $this->Cell(23,4,'HEMATIES',1,0,'L');
    $this->Cell(20,4,$reg[0]['hematiesfresco'],1,0,'R');
    $this->Cell(38,4,'PMN',1,0,'L');
    $this->Cell(14,4,$reg[0]['pmngran'],1,0,'R'); 
    $this->Cell(33,4,'',1,0,'L');
    $this->Cell(68,4,'',1,0,'R');
    $this->Ln(6);

    if($reg[0]['observacioneshematologia'] != ""){
    $this->MultiCell(196,4,$this->SetFont('Courier','B',8)."OBSERVACIONES HEMATOLOG�A: ".portales(utf8_decode($reg[0]['observacioneshematologia'])),0,'L');
    $this->Ln();
    }

    if($reg[0]['observacionesquimica'] != ""){
    $this->MultiCell(196,4,$this->SetFont('Courier','B',8)."OBSERVACIONES QU�MICA: ".portales(utf8_decode($reg[0]['observacionesquimica'])),0,'L');
    $this->Ln();
    }
    
    if($reg[0]['observacionesuroanalisis'] != ""){
    $this->MultiCell(196,4,$this->SetFont('Courier','B',8)."OBSERVACIONES UROAN�LISIS: ".portales(utf8_decode($reg[0]['observacionesuroanalisis'])),0,'L');
    $this->Ln();
    }

    if($reg[0]['observacionesfrotis'] != ""){
    $this->MultiCell(196,4,$this->SetFont('Courier','B',8)."OBSERVACIONES FLUJO VAGINAL: ".portales(utf8_decode($reg[0]['observacionesfrotis'])),0,'L');
    $this->Ln();
    }

    if($reg[0]['observacionesinmunologia'] != ""){
    $this->MultiCell(196,4,$this->SetFont('Courier','B',8)."OBSERVACIONES INMUNOLOGIA: ".portales(utf8_decode($reg[0]['observacionesinmunologia'])),0,'L');
    $this->Ln();
    }
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->Ln(5); 
    $this->SetFont('Courier','BI',12);
    $this->Cell(0, 0,$this->Image($img, $this->GetX()+150, $this->GetY()-5, 25), 0, 0, "JPG" );
    $this->Ln(4);
    $this->Cell(300,0,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,portales(utf8_decode($reg[0]['nomespecialidad'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,'M.P.S. '.utf8_decode($reg[0]['mps']),'',1,'C');

    } else {

    $this->Ln(5); 
    $this->SetFont('Courier','BI',12);
    $this->Cell(0, 0,'', 0, 0, "JPG" );
    $this->Ln(4);
    $this->Cell(300,0,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,portales(utf8_decode($reg[0]['nomespecialidad'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,'M.P.S. '.utf8_decode($reg[0]['mps']),'',1,'C');
    }

}
############################### FUNCION PARA MOSTRAR EX�MEN DE LABORATORIO ################################# 

########################## FUNCION LISTAR EXAMENES DE LABORATORIOS ##############################
function TablaListarLaboratorios()
{

    $tra = new Login();
    $reg = $tra->ListarLaboratorios();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE EX�MENES DE LABORATORIOS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(55,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(55,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(45,8,'HEMATOLOGIA',1,0,'C', True);
    $this->Cell(45,8,'QU�MICA SANGUINEA',1,0,'C', True);
    $this->Cell(40,8,'UROAN�LISIS',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,55,55,45,45,40,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['observacioneshematologia'] == '' ? "************" : $reg[$i]['observacioneshematologia'])),
        portales(utf8_decode($reg[$i]['observacionesquimica'] == '' ? "************" : $reg[$i]['observacionesquimica'])),
        portales(utf8_decode($reg[$i]['observacionesuroanalisis'] == '' ? "************" : $reg[$i]['observacionesuroanalisis'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechalaboratorio']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR EXAMENES DE LABORATORIOS ##############################

########################## FUNCION LISTAR EXAMENES DE LABORATORIOS POR FECHAS ##############################
function TablaListarLaboratoriosxFechas()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarLaboratoriosxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE EX�MENES DE LABORATORIOS POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(55,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(55,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(60,8,'HEMATOLOGIA',1,0,'C', True);
    $this->Cell(60,8,'QU�MICA SANGUINEA',1,0,'C', True);
    $this->Cell(60,8,'UROAN�LISIS',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,55,55,60,60,60,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['observacioneshematologia'] == '' ? "************" : $reg[$i]['observacioneshematologia'])),
        portales(utf8_decode($reg[$i]['observacionesquimica'] == '' ? "************" : $reg[$i]['observacionesquimica'])),
        portales(utf8_decode($reg[$i]['observacionesuroanalisis'] == '' ? "************" : $reg[$i]['observacionesuroanalisis'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechalaboratorio'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR EXAMENES DE LABORATORIOS POR FECHAS ##############################

########################## FUNCION LISTAR EXAMENES DE LABORATORIOS POR MEDICO ##############################
function TablaListarLaboratoriosxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarLaboratoriosxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE EX�MENES DE LABORATORIOS POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(75,8,'HEMATOLOGIA',1,0,'C', True);
    $this->Cell(75,8,'QU�MICA SANGUINEA',1,0,'C', True);
    $this->Cell(75,8,'UROAN�LISIS',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,75,75,75,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['observacioneshematologia'] == '' ? "************" : $reg[$i]['observacioneshematologia'])),
        portales(utf8_decode($reg[$i]['observacionesquimica'] == '' ? "************" : $reg[$i]['observacionesquimica'])),
        portales(utf8_decode($reg[$i]['observacionesuroanalisis'] == '' ? "************" : $reg[$i]['observacionesuroanalisis'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechalaboratorio'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR EXAMENES DE LABORATORIOS POR MEDICO ##############################

########################## FUNCION LISTAR EXAMENES DE LABORATORIOS POR PACIENTE ##############################
function TablaListarLaboratoriosxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarLaboratoriosxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE EX�MENES DE LABORATORIOS POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(75,8,'HEMATOLOGIA',1,0,'C', True);
    $this->Cell(75,8,'QU�MICA SANGUINEA',1,0,'C', True);
    $this->Cell(75,8,'UROAN�LISIS',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,75,75,75,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($reg[$i]['observacioneshematologia'] == '' ? "************" : $reg[$i]['observacioneshematologia'])),
        portales(utf8_decode($reg[$i]['observacionesquimica'] == '' ? "************" : $reg[$i]['observacionesquimica'])),
        portales(utf8_decode($reg[$i]['observacionesuroanalisis'] == '' ? "************" : $reg[$i]['observacionesuroanalisis'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechalaboratorio'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR EXAMENES DE LABORATORIOS POR PACIENTE ##############################

############################### REPORTES DE EXAMENES DE LABORATORIOS ##############################





















############################### REPORTES DE RADIOLOGIAS ##############################

############################### FUNCION PARA MOSTRAR RADIOLOGIAS ################################# 
function TablaRadiologia()
  {
    $tra = new Login();
    $reg = $tra->RadiologiasPorId();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'LECTURA RX',0,0,'C');
    $this->Ln(6);
    
    $this->Ln(4);
    $this->SetX(6);
    $this->SetFont('Courier','B',11);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(60,5,'N� DE IDENTIFICACI�N: ',0,0,'L');
    $this->SetFont('Courier','',12);  
    $this->CellFitSpace(140,5,utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente']),0,0,'L');
    
    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',11);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(60,5,'NOMBRE DEL PACIENTE: ',0,0,'L');
    $this->SetFont('Courier','',12);  
    $this->CellFitSpace(140,5,utf8_decode($reg[0]['nompaciente'].' '.$reg[0]['apepaciente']),0,0,'L');
    
    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',11);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(60,5,'FECHA DE NACIMIENTO: ',0,0,'L');
    $this->SetFont('Courier','',12);  
    $this->CellFitSpace(140,5,date("d-m-Y", strtotime($reg[0]['fnacpaciente'])),0,0,'L');

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',11);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(60,5,'GRUPO SANGUINEO: ',0,0,'L');
    $this->SetFont('Courier','',12);  
    $this->CellFitSpace(140,5,$reg[0]['gruposapaciente'] == '' ? "************" : $reg[0]['gruposapaciente'],0,0,'L');
    
    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',11);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(60,5,'EDAD: ',0,0,'L');
    $this->SetFont('Courier','',12);  
    $this->CellFitSpace(140,5,edad($reg[0]['fnacpaciente']).' A�OS',0,0,'L');
    
    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',11);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(60,5,'ESTADO CIVIL: ',0,0,'L');
    $this->SetFont('Courier','',12);  
    $this->CellFitSpace(140,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "************" : $reg[0]['estadopaciente'])),0,0,'L');

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',11);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(60,5,'FECHA DE ELABORACI�N: ',0,0,'L');
    $this->SetFont('Courier','',12);  
    $this->CellFitSpace(140,5,date("d-m-Y H:i:s", strtotime($reg[0]['fecharadiologia'])),0,0,'L');
    $this->Ln();

    $this->Ln(8);
    $this->SetX(6);
    $this->SetFont('Courier','BI',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,portales(utf8_decode($reg[0]['tipoestudio'])),0,0,'L');
    $this->Ln(6);
    
    $this->SetX(6);
    $this->SetFont('Courier','',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',9).portales(utf8_decode($reg[0]['diagnostico'])),0,'J');
    $this->Ln(20); 
    
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetFont('Courier','BI',12);
    $this->Cell(0, 0,$this->Image($img, $this->GetX()+150, $this->GetY()-15, 35), 0, 0, "JPG" );
    $this->Ln(4);
    $this->Cell(300,0,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,portales(utf8_decode($reg[0]['nomespecialidad'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,'M.P.S. '.utf8_decode($reg[0]['mps']),'',1,'C');

    } else {

    $this->SetFont('Courier','BI',12);
    $this->Cell(0, 0,'', 0, 0, "JPG" );
    $this->Ln(4);
    $this->Cell(300,0,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,portales(utf8_decode($reg[0]['nomespecialidad'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,'M.P.S. '.utf8_decode($reg[0]['mps']),'',1,'C');
    }

}
############################### FUNCION PARA MOSTRAR RADIOLOGIAS ################################# 

########################## FUNCION LISTAR RADIOLOGIAS ##############################
function TablaListarRadiologias()
{

    $tra = new Login();
    $reg = $tra->ListarRadiologias();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE RADIOLOGIAS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(30,8,'LECTURA RX',1,0,'C', True);
    $this->Cell(80,8,'TIPO DE ESTUDIO',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,30,80,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($lectura = ($reg[$i]['lectura'] == 1 ? "SI" : "NO"))),
        portales(utf8_decode($reg[$i]['tipoestudio'] == '' ? "************" : $reg[$i]['tipoestudio'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fecharadiologia']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR RADIOLOGIAS ##############################

########################## FUNCION LISTAR RADIOLOGIAS POR FECHAS ##############################
function TablaListarRadiologiasxFechas()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarRadiologiasxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE RADIOLOGIAS POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(80,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(80,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(30,8,'LECTURA RX',1,0,'C', True);
    $this->Cell(100,8,'TIPO DE ESTUDIO',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,80,80,30,100,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($lectura = ($reg[$i]['lectura'] == 1 ? "SI" : "NO"))),
        portales(utf8_decode($reg[$i]['tipoestudio'] == '' ? "************" : $reg[$i]['tipoestudio'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fecharadiologia'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR RADIOLOGIAS POR FECHAS ##############################

########################## FUNCION LISTAR RADIOLOGIAS POR MEDICO ##############################
function TablaListarRadiologiasxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarRadiologiasxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE RADIOLOGIAS POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(30,8,'LECTURA RX',1,0,'C', True);
    $this->Cell(150,8,'TIPO DE ESTUDIO',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,30,150,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($lectura = ($reg[$i]['lectura'] == 1 ? "SI" : "NO"))),
        portales(utf8_decode($reg[$i]['tipoestudio'] == '' ? "************" : $reg[$i]['tipoestudio'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fecharadiologia'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR RADIOLOGIAS POR MEDICO ##############################

########################## FUNCION LISTAR RADIOLOGIAS POR PACIENTE ##############################
function TablaListarRadiologiasxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarRadiologiasxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE RADIOLOGIAS POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(30,8,'LECTURA RX',1,0,'C', True);
    $this->Cell(150,8,'TIPO DE ESTUDIO',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,30,150,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($lectura = ($reg[$i]['lectura'] == 1 ? "SI" : "NO"))),
        portales(utf8_decode($reg[$i]['tipoestudio'] == '' ? "************" : $reg[$i]['tipoestudio'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fecharadiologia'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR RADIOLOGIAS POR PACIENTE ##############################

############################### REPORTES DE RADIOLOGIAS ##############################






















############################### REPORTES DE TERAPIAS ##############################

############################### FUNCION PARA MOSTRAR TERAPIAS ################################# 
function TablaTerapia()
  {
    $tra = new Login();
    $reg = $tra->TerapiasPorId();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'HOJA EVOLUCI�N DE TERAPIAS',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DIAGN�STICO',1,1,'C', True);

    $this->SetX(6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,5,$this->SetFont('Courier','',12).portales(utf8_decode($reg[0]['diagnostico'])),1,'L');

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'CICLO DE TERAPIAS',1,1,'C', True);

    $this->SetX(6);
    $this->SetFont('Courier','B',9);    
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(10,4,'N� ',1,0,'C');
    $this->CellFitSpace(40,4,'FECHA/HORA',1,0,'C');
    $this->CellFitSpace(105,4,'ATENCION, ACTIVIDAD Y/O PROCEDIMIENTO',1,0,'C');
    $this->CellFitSpace(45,4,'FIRMA DEL PROFESIONAL',1,1,'C');

    $this->SetWidths(array(10,40,105,45));

    if(!empty($reg[0]['detalles_terapias'])){

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $explode = explode(",,",$reg[0]['detalles_terapias']);
    $a=1;
    # Recorremos el array para despues separar en 3 epa espera aqui hay un errro ya jejejjevariables lo que se requiere.
    for($cont=0; $cont<COUNT($explode); $cont++):
    # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
    list($idterapia,$tratamiento,$fechaciclo) = explode("/",$explode[$cont]);
    
    $this->SetX(6);
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array(
        $a++,
        utf8_decode(date("d-m-Y H:i:s", strtotime($fechaciclo))),
        portales(utf8_decode($tratamiento)),
        "",));
    endfor;

    }

    if (isset($reg[0]['observaciones'])) {

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->Cell(200,4,'OBSERVACIONES',0,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,4,portales(utf8_decode($this->SetFont('Courier','',8).$reg[0]['observaciones'])),0,'J');

   }

    $this->Ln(20); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetFont('Courier','BI',12);
    $this->Cell(0, 0,$this->Image($img, $this->GetX()+150, $this->GetY()-15, 35), 0, 0, "JPG" );
    $this->Ln(4);
    $this->Cell(300,0,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,portales(utf8_decode($reg[0]['nomespecialidad'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,'M.P.S. '.utf8_decode($reg[0]['mps']),'',1,'C');

    } else {

    $this->SetFont('Courier','BI',12);
    $this->Cell(0, 0,'', 0, 0, "JPG" );
    $this->Ln(4);
    $this->Cell(300,0,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,portales(utf8_decode($reg[0]['nomespecialidad'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,'M.P.S. '.utf8_decode($reg[0]['mps']),'',1,'C');
    }

}
############################### FUNCION PARA MOSTRAR TERAPIAS ################################# 

########################## FUNCION LISTAR TERAPIAS ##############################
function TablaListarTerapias()
{

    $tra = new Login();
    $reg = $tra->ListarTerapias();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE TERAPIAS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(80,8,'DIAGN�STICO',1,0,'C', True);
    $this->Cell(30,8,'CICLO',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,80,30,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['diagnostico'])),
        portales(utf8_decode($ciclo = ($reg[$i]['ciclo'] == 1 ? "CULMINADO" : "EN PROCESO"))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaterapia']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR TERAPIAS ##############################

########################## FUNCION LISTAR TERAPIAS POR FECHAS ##############################
function TablaListarTerapiasxFechas()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarTerapiasxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE TERAPIAS POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(75,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(75,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(110,8,'DIAGN�STICO',1,0,'C', True);
    $this->Cell(30,8,'CICLO',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,75,75,110,30,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['diagnostico'])),
        portales(utf8_decode($ciclo = ($reg[$i]['ciclo'] == 1 ? "CULMINADO" : "EN PROCESO"))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaterapia'])))));
       }
    }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR TERAPIAS POR FECHAS ##############################

########################## FUNCION LISTAR TERAPIAS POR MEDICO ##############################
function TablaListarTerapiasxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarTerapiasxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE TERAPIAS POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(110,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(140,8,'DIAGN�STICO',1,0,'C', True);
    $this->Cell(30,8,'CICLO',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,110,140,30,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['diagnostico'])),
        portales(utf8_decode($ciclo = ($reg[$i]['ciclo'] == 1 ? "CULMINADO" : "EN PROCESO"))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaterapia'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR TERAPIAS POR MEDICO ##############################

########################## FUNCION LISTAR TERAPIAS POR PACIENTE ##############################
function TablaListarTerapiasxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarTerapiasxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE TERAPIAS POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(110,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(140,8,'DIAGN�STICO',1,0,'C', True);
    $this->Cell(30,8,'CICLO',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,110,140,30,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($reg[$i]['diagnostico'])),
        portales(utf8_decode($ciclo = ($reg[$i]['ciclo'] == 1 ? "CULMINADO" : "EN PROCESO"))),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaterapia'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR TERAPIAS POR PACIENTE ##############################

############################### REPORTES DE TERAPIAS ##############################

















############################### REPORTES DE ODONTOLOGIAS ##############################

############################### FUNCION PARA MOSTRAR ODONTOLOGIAS ################################# 
function TablaOdontologia()
  {
    $tra = new Login();
    $reg = $tra->OdontologiasPorId();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'FICHA ODONTOLOG�CA',0,0,'C');
    $this->Ln(4);

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(200,6,'DATOS PERSONALES DEL PACIENTE',1,1,'C', True);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'APELLIDO PATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'APELLIDO MATERNO',1,0,'C');
    $this->CellFitSpace(40,4,'PRIMER NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'SEGUNDO NOMBRE',1,0,'C');
    $this->CellFitSpace(40,4,'N� DE DOCUMENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['papepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['sapepaciente'] == '' ? "*******" : $reg[0]['sapepaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['pnompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['snompaciente'] == '' ? "*******" : $reg[0]['snompaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['documento4']." ".$reg[0]['cedpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(80,4,'DIRECCI�N DE RESIDENCIA HABITUAL(CALLE Y N� MANZANA Y CASA)',1,0,'C');
    $this->CellFitSpace(40,4,'BARRIO',1,0,'C');
    $this->CellFitSpace(40,4,'PARROQUIA',1,0,'C');
    $this->CellFitSpace(40,4,'CANT�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(80,5,portales(utf8_decode($reg[0]['direcpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['barriopaciente'] == '' ? "*******" : $reg[0]['barriopaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idparroquia2'] == '' ? "*******" : strtoupper($reg[0]['parroquia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idcanton2'] == '' ? "*******" : strtoupper($reg[0]['canton']))),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'PROVINCIA',1,0,'C');
    $this->CellFitSpace(40,4,'ZONA(UR)',1,0,'C');
    $this->CellFitSpace(20,4,'N� TEL�FONO',1,0,'C');
    $this->CellFitSpace(30,4,'FECHA NACIMIENTO',1,0,'C');
    $this->CellFitSpace(70,4,'LUGAR NACIMIENTO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['idprovincia2'] == '' ? "*******" : strtoupper($reg[0]['provincia']))),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['zonapaciente'] == '' ? "*******" : $reg[0]['zonapaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*******" : $reg[0]['tlfpaciente'])),1,0,'L');
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fnacpaciente'])),1,0,'L');
    $this->CellFitSpace(70,5,portales(utf8_decode($reg[0]['lnacpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(40,4,'NACIONALIDAD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO CULTURAL',1,0,'C');
    $this->CellFitSpace(20,4,'EDAD',1,0,'C');
    $this->CellFitSpace(20,4,'SEXO',1,0,'C');
    $this->CellFitSpace(20,4,'ESTADO CIVIL',1,0,'C');
    $this->CellFitSpace(60,4,'GRADO INSTRUCCI�N',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['nacpaciente'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['enfoquepaciente'])),1,0,'L');
    $this->CellFitSpace(20,5,edad($reg[0]['fnacpaciente'])." A�OS",1,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($reg[0]['sexopaciente']),1,0,'L');
    $this->CellFitSpace(20,5,portales(utf8_decode($reg[0]['estadopaciente'] == '' ? "*******" : $reg[0]['estadopaciente'])),1,0,'L');
    $this->CellFitSpace(60,5,portales(utf8_decode($reg[0]['instruccionpaciente'] == '' ? "*******" : $reg[0]['instruccionpaciente'])),1,0,'L');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(30,4,'FECHA DE ADMISI�N',1,0,'C');
    $this->CellFitSpace(40,4,'OCUPACI�N',1,0,'C');
    $this->CellFitSpace(45,4,'EMPRESA DONDE TRABAJA',1,0,'C');
    $this->CellFitSpace(45,4,'TIPO DE SEGURO DE SALUD',1,0,'C');
    $this->CellFitSpace(40,4,'GRUPO SANGUINERO',1,0,'C');
    $this->Ln();

    $this->SetX(6);
    $this->SetFont('Courier','',8.5);
    $this->CellFitSpace(30,5,date("d-m-Y",strtotime($reg[0]['fecha_admision'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['ocupacionpaciente'] == '' ? "*******" : $reg[0]['ocupacionpaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['trabajapaciente'] == '' ? "*******" : $reg[0]['trabajapaciente'])),1,0,'L');
    $this->CellFitSpace(45,5,portales(utf8_decode($reg[0]['codseguro'] == 0 ? "*******" : $reg[0]['nomseguro'])),1,0,'L');
    $this->CellFitSpace(40,5,portales(utf8_decode($reg[0]['gruposapaciente'] == '' ? "*******" : $reg[0]['gruposapaciente'])),1,0,'L');
    $this->Ln();

    $this->Ln(2);
    $this->SetX(6);
    $this->SetFont('Courier','B',6);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(15,5,'MENOR DE 1',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,5,$variable = ($reg[0]['menor_1'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(11,5,'1-4 A�OS',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,5,$variable = ($reg[0]['1_4'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(28,5,'5-9 A�OS PROGRAMADO',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,5,$variable = ($reg[0]['5_9'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(28,5,'5-14 A�OS NO PROGRAMADO',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,5,$variable = ($reg[0]['5_14'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(28,5,'10-14 A�OS PROGRAMADO',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,5,$variable = ($reg[0]['10_14'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(15,5,'15-19 A�OS',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,5,$variable = ($reg[0]['15_19'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(20,5,'MAYOR DE 20 A�OS',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,5,$variable = ($reg[0]['mayor_20'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(15,5,'EMBARAZADA',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,5,$variable = ($reg[0]['embarazada'] == 'X' ? "X" : ""),1,1,'C');

    $this->Ln(2);
    $this->SetX(6);
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'1. MOTIVO DE CONSULTA',1,1,'L', True);

    $this->SetX(6);
    $this->MultiCell(200,5,$this->SetFont('Courier','',8).utf8_decode($reg[0]['motivo_consulta']),1,'L');

    $this->Ln(2);
    $this->SetX(6);
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'2. ENFERMEDAD O PROBLEMA ACTUAL',1,1,'L', True);

    $this->SetX(6);
    $this->MultiCell(200,5,$this->SetFont('Courier','',8).utf8_decode($reg[0]['problema_actual']),1,'L');

    $this->Ln(2);
    $this->SetX(6);
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'3. ANTECEDENTES PERSONALES Y FAMILIARES',1,1,'L', True);

    $this->SetX(6);
    $this->SetFont('Courier','B',6);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(35,4,'1. ALERGIA ANTIBI�TICO',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['alergia_antibiotico'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(35,4,'2. ALERGIA ANESTESIA',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['alergia_anestesia'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(35,4,'3. HEMORRAGIAS',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['hemorragias'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(35,4,'4. VIH/SIDA',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['vih'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(35,4,'5. TUBERCULOSIS',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['tuberculosis'] == 'X' ? "X" : ""),1,1,'C');

    $this->SetX(6);
    $this->SetFont('Courier','B',6);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(35,4,'6. ASMA',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['asma'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(35,4,'7. DIABETES',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['diabetes'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(35,4,'8. HIPERTENSI�N',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['hipertension'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(35,4,'9. ENF. CARDIACA',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['enfermedad_cardiaca'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(35,4,'10. OTRO',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['otro_antecedentes'] == 'X' ? "X" : ""),1,1,'C');

    $this->SetX(6);
    $this->MultiCell(200,4,$this->SetFont('Courier','',8).utf8_decode($reg[0]['observaciones_antecedentes']),1,'L');

    $this->Ln(2);
    $this->SetX(6);
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'4. SIGNOS VITALES',1,1,'L', True);

    $this->SetX(6);
    $this->SetFont('Courier','B',6);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(40,5,'PRESI�N ARTERIAL',1,0,'C');
    $this->Cell(10,5,$variable = ($reg[0]['presion_arterial'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(40,5,'FRECUENCIA CARDIACA min.',1,0,'C');
    $this->Cell(10,5,$variable = ($reg[0]['frecuencia_cardiaca'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(40,5,'TEMPERATURA �C',1,0,'C');
    $this->Cell(10,5,$variable = ($reg[0]['temperatura'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(40,5,'F. RESPIRAT. min.',1,0,'C');
    $this->Cell(10,5,$variable = ($reg[0]['frecuencia_respiratoria'] == 'X' ? "X" : ""),1,1,'C');

    $this->Ln(2);
    $this->SetX(6);
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'5. EXAMEN DEL SISTEMA ESTOMATOGN�TICO',1,1,'L', True);

    $this->SetX(6);
    $this->SetFont('Courier','B',6);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(25,4,'1. LABIOS',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['labios'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(25,4,'2. MEJILLAS',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['mejillas'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(35,4,'3. MAXILAR SUPERIOR',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['maxilar_superior'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(35,4,'4. MAXILAR INFERIOR',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['maxilar_inferior'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(25,4,'5. LENGUA',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['lengua'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(25,4,'6. PALADAR',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['paladar'] == 'X' ? "X" : ""),1,1,'C');

    $this->SetX(6);
    $this->SetFont('Courier','B',6);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(25,4,'7. PISO',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['piso'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(25,4,'8. CARRILLOS',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['carrillos'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(35,4,'9. GL�NDULAS SALIVALES',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['glandulas'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(35,4,'10. ORO FARINGE',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['faringe'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(25,4,'11. A. T. M.',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['atm'] == 'X' ? "X" : ""),1,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(25,4,'12. GANGLIOS',1,0,'C');
    $this->SetFont('Courier','B',8);
    $this->Cell(5,4,$variable = ($reg[0]['ganglios'] == 'X' ? "X" : ""),1,1,'C');

    $this->SetX(6);
    $this->MultiCell(200,4,$this->SetFont('Courier','',8).utf8_decode($reg[0]['observaciones_antecedentes']),1,'L');
    
    $this->Ln(2);
    $this->SetX(6);
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(200,5,'6. ODONTOGRAMA',1,1,'L', True);
    
    $odontograma = "./fotos/odontograma/O_".$reg[0]['codpaciente']."_".$reg[0]['codsucursal'].".png";
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(200,70,$this->Image($odontograma, $this->GetX()+20, $this->GetY()+0.5, 140), 1, 0, "PNG" );
    $this->Ln();
    
    $this->SetX(6);
    $this->SetFont('Courier','B',7);  
    $this->CellFitSpace(20,4,'N�',1,0,'C');
    $this->CellFitSpace(48,4,'DIENTE',1,0,'C');
    $this->CellFitSpace(48,4,'CARA DIENTE',1,0,'C');
    $this->CellFitSpace(84,4,'REFERENCIAS',1,0,'C');
    $this->Ln();
    
     $explode = explode("__",$reg[0]['estados']);
     $listaSimple = array_values(array_unique($explode));
     # Recorremos el array para despues separar en 3 epa espera aqui hay un errro ya jejejjevariables lo que se requiere.
     $Conteo = 0;
     $a=1;

     for($cont=0; $cont<COUNT($listaSimple); $cont++):
     # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
     list($diente,$caradiente,$referencias) = explode("_",$listaSimple[$cont]);
     $Conteo += $a;
     
     if($caradiente=="C1") { $cara = "VESTIBULAR"; } elseif($caradiente=="C2") { $cara = "DISTAL"; } elseif($caradiente=="C3") { $cara = "PALATINO"; } elseif($caradiente=="C4") { $cara = "MESIAL"; } elseif($caradiente=="C5") { $cara = "OCLUSAL"; }
     
    $this->SetX(6);
    $this->SetFont('Courier','',6);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(20,3,$cont+1,1,0,'C');
    $this->CellFitSpace(48,3,utf8_decode($diente),1,0,'C');
    $this->CellFitSpace(48,3,utf8_decode($cara),1,0,'C');
    $this->CellFitSpace(84,3,utf8_decode(substr($referencias, 2)),1,0,'C');
    $this->Ln();

    endfor;

    //$this->AddPage(); // AQUI HACEMOS SALTO DE PAGINA

    if($Conteo <= 2){
        $this->AddPage();
    } elseif($Conteo == 3){
        $this->AddPage();
    } else {
        $this->Ln(2);
    }

    $this->SetX(6);
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(140,5,'7. INDICADORES DE SALUD BUCAL',1,0,'L', True);
    $this->Cell(2,5,'',0,0,'L');
    $this->CellFitSpace(58,5,'8. �NDICES CPO-ceo',1,1,'L', True);

    $this->SetX(6);
    $this->SetFont('Courier','B',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(75,5,'HIGIENE ORAL SIMPLIFICADA',1,0,'C');
    $this->SetFont('Courier','B',7);
    $this->CellFitSpace(25,5,'ENF.PERIODONTAL',1,0,'C');
    $this->CellFitSpace(20,5,'MAL OCLUSI�N',1,0,'C');
    $this->CellFitSpace(20,5,'FLUOROSIS',1,0,'C');
    $this->Cell(2,5,'',0,0,'L');
    $this->Cell(10,5,'D',1,0,'L');
    $this->Cell(10,5,'C',1,0,'L');
    $this->Cell(10,5,'P',1,0,'L');
    $this->Cell(10,5,'O',1,0,'L');
    $this->Cell(18,5,'TOTAL',1,1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(30,5,'PIEZAS DENTALES',1,0,'C');
    $this->CellFitSpace(15,5,'PLACA',1,0,'C');
    $this->CellFitSpace(15,5,'C�LCULO',1,0,'C');
    $this->CellFitSpace(15,5,'GINGIVITIS',1,0,'C');
    $this->SetFont('Courier','B',7);
    $this->CellFitSpace(20,5,'LEVE',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['periodontal'] == 'LEVE' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(15,5,'ANGLE I',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['oclusion'] == 'I' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(15,5,'LEVE',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['fluorosis'] == 'LEVE' ? "X" : ""),1,0,'C');
    $this->Cell(2,5,'',0,0,'L');
    $this->Cell(10,5,'',1,0,'L');
    $this->Cell(10,5,$reg[0]['cpo_1_c'],1,0,'L');
    $this->Cell(10,5,$reg[0]['cpo_1_p'],1,0,'L');
    $this->Cell(10,5,$reg[0]['cpo_1_o'],1,0,'L');
    $this->Cell(18,5,$reg[0]['cpo_1_c']+$reg[0]['cpo_1_p']+$reg[0]['cpo_1_o'],1,1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(5,5,'16',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_16'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(5,5,'17',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_17'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(5,5,'55',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_55'] == 'X' ? "X" : ""),1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_1_placa'],1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_1_calculo'],1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_1_gingivitis'],1,0,'C');
    $this->SetFont('Courier','B',7);
    $this->CellFitSpace(20,5,'MODERADA',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['periodontal'] == 'MODERADA' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(15,5,'ANGLE II',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['oclusion'] == 'II' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(15,5,'MODERADA',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['fluorosis'] == 'MODERADA' ? "X" : ""),1,0,'C');
    $this->Cell(2,5,'',0,0,'L');
    $this->Cell(10,5,'d',1,0,'L');
    $this->Cell(10,5,'c',1,0,'L');
    $this->Cell(10,5,'e',1,0,'L');
    $this->Cell(10,5,'o',1,0,'L');
    $this->Cell(18,5,'TOTAL',1,1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(5,5,'11',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_11'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(5,5,'21',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_21'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(5,5,'51',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_51'] == 'X' ? "X" : ""),1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_2_placa'],1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_2_calculo'],1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_2_gingivitis'],1,0,'C');
    $this->SetFont('Courier','B',7);
    $this->CellFitSpace(20,5,'SEVERA',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['periodontal'] == 'SEVERA' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(15,5,'ANGLE II',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['oclusion'] == 'III' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(15,5,'SEVERA',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['fluorosis'] == 'SEVERA' ? "X" : ""),1,0,'C');
    $this->Cell(2,5,'',0,0,'L');
    $this->Cell(10,5,'',1,0,'L');
    $this->Cell(10,5,$reg[0]['cpo_2_c'],1,0,'L');
    $this->Cell(10,5,$reg[0]['cpo_2_e'],1,0,'L');
    $this->Cell(10,5,$reg[0]['cpo_2_o'],1,0,'L');
    $this->Cell(18,5,$reg[0]['cpo_2_c']+$reg[0]['cpo_2_e']+$reg[0]['cpo_2_o'],1,1,'L');

    $this->SetX(6);
    $this->SetFont('Courier','B',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(5,5,'26',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_26'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(5,5,'27',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_27'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(5,5,'65',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_65'] == 'X' ? "X" : ""),1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_3_placa'],1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_3_calculo'],1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_3_gingivitis'],1,1,'C');

    $this->SetX(6);
    $this->SetFont('Courier','B',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(5,5,'36',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_36'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(5,5,'37',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_37'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(5,5,'75',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_75'] == 'X' ? "X" : ""),1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_4_placa'],1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_4_calculo'],1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_4_gingivitis'],1,1,'C');

    $this->SetX(6);
    $this->SetFont('Courier','B',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(5,5,'31',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_31'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(5,5,'41',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_41'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(5,5,'71',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_71'] == 'X' ? "X" : ""),1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_5_placa'],1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_5_calculo'],1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_5_gingivitis'],1,1,'C');

    $this->SetX(6);
    $this->SetFont('Courier','B',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(5,5,'46',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_46'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(5,5,'47',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_47'] == 'X' ? "X" : ""),1,0,'C');
    $this->CellFitSpace(5,5,'85',1,0,'C');
    $this->Cell(5,5,$variable = ($reg[0]['pieza_85'] == 'X' ? "X" : ""),1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_6_placa'],1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_6_calculo'],1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_6_gingivitis'],1,1,'C');

    $this->SetX(6);
    $this->SetFont('Courier','B',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(30,5,'TOTALES',1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_1_placa']+$reg[0]['pieza_2_placa']+$reg[0]['pieza_3_placa']+$reg[0]['pieza_4_placa']+$reg[0]['pieza_5_placa']+$reg[0]['pieza_6_placa'],1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_1_calculo']+$reg[0]['pieza_2_calculo']+$reg[0]['pieza_3_calculo']+$reg[0]['pieza_4_calculo']+$reg[0]['pieza_5_calculo']+$reg[0]['pieza_6_calculo'],1,0,'C');
    $this->Cell(15,5,$reg[0]['pieza_1_gingivitis']+$reg[0]['pieza_2_gingivitis']+$reg[0]['pieza_3_gingivitis']+$reg[0]['pieza_4_gingivitis']+$reg[0]['pieza_5_gingivitis']+$reg[0]['pieza_6_gingivitis'],1,1,'C');


    $this->Ln(2);
    $this->SetX(6);
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es VERDE)
    $this->CellFitSpace(200,5,'9. PLANES DE DIAGN�STICO, TERAP�UTICO Y EDUCACIONAL',1,1,'L', True);

    $this->SetX(6);
    $this->SetFont('Courier','B',6);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->SetFillColor(204,255,204); // establece el color del fondo de la celda (en este caso es VERDE)
    $this->CellFitSpace(45,4,'BIOMETRIA',1,0,'C', True);
    $this->SetFillColor(255,255,153); // establece el color del fondo de la celda (en este caso es AMARILLO)
    $this->Cell(5,4,$variable = ($reg[0]['biometria'] == 'X' ? "X" : ""),1,0,'C', True);
    $this->SetFillColor(204,255,204); // establece el color del fondo de la celda (en este caso es VERDE)
    $this->CellFitSpace(45,4,'QUIMICA SANGUINEA',1,0,'C', True);
    $this->SetFillColor(255,255,153); // establece el color del fondo de la celda (en este caso es AMARILLO)
    $this->Cell(5,4,$variable = ($reg[0]['quimica'] == 'X' ? "X" : ""),1,0,'C', True);
    $this->SetFillColor(204,255,204); // establece el color del fondo de la celda (en este caso es VERDE)
    $this->CellFitSpace(45,4,'RAYOS - X',1,0,'C', True);
    $this->SetFillColor(255,255,153); // establece el color del fondo de la celda (en este caso es AMARILLO)
    $this->Cell(5,4,$variable = ($reg[0]['rayosx'] == 'X' ? "X" : ""),1,0,'C', True);
    $this->SetFillColor(204,255,204); // establece el color del fondo de la celda (en este caso es VERDE)
    $this->CellFitSpace(45,4,'OTROS',1,0,'C', True);
    $this->SetFillColor(255,255,153); // establece el color del fondo de la celda (en este caso es AMARILLO)
    $this->Cell(5,4,$variable = ($reg[0]['otros_planes'] == 'X' ? "X" : ""),1,1,'C', True);

    $this->SetX(6);
    $this->MultiCell(200,4,$this->SetFont('Courier','',8).utf8_decode($reg[0]['observaciones_planes']),1,'L');
    
    $this->Ln(2);
    $this->SetX(6);
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es VERDE)
    $this->CellFitSpace(200,5,'10. DIAGN�STICO',1,1,'L', True);

    $this->SetX(6);
    $this->SetFont('Courier','B',8); 
    $this->SetFillColor(204,255,204); // establece el color del fondo de la celda (en este caso es VERDE)
    $this->CellFitSpace(200,5,'PRESUNTIVO',1,1,'L', True);
    
    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['presuntivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciepresuntivo,$presuntivo) = explode("/",$explode[$cont]);

    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,4,$idciepresuntivo == '' ? "" : "".$a++.". ".$presuntivo,1,'J');
    
    endfor;

    $this->SetX(6);
    $this->SetFont('Courier','B',8); 
    $this->SetFillColor(204,255,204); // establece el color del fondo de la celda (en este caso es VERDE)
    $this->CellFitSpace(200,5,'DEFINITIVO',1,1,'L', True);
    
    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['definitivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciedefinitivo,$definitivo) = explode("/",$explode[$cont]);
    
    $this->SetX(6);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->MultiCell(200,4,$idciedefinitivo == '' ? "" : "".$a++.". ".$definitivo,1,'J');
    
    endfor;

    $this->Ln(1);
    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(135,3,'',0,0,'C');
    $this->Cell(15,3,'CODIGO',0,0,'C');
    $this->Cell(50,3,'',0,1,'C');

    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es VERDE)
    $this->CellFitSpace(25,5,'FECHA DE APERTURA',1,0,'C', True);
    $this->SetFont('Courier','',6.5);
    $this->Cell(15,5,date("d-m-Y", strtotime($reg[0]['fechaodontologia'])),1,0,'C');
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(25,5,'FECHA DE CONTROL',1,0,'C', True);
    $this->SetFont('Courier','',6.5);
    $this->Cell(15,5,date("d-m-Y", strtotime($reg[0]['fechaodontologia'])),1,0,'C');
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(20,5,'PROFESIONAL',1,0,'C', True);
    $this->SetFont('Courier','',6.5);
    $this->CellFitSpace(37,5,portales(utf8_decode($reg[0]['nommedico'])),1,0,'C');
    $this->Cell(15,5,'',1,0,'C');
    $this->SetFont('Courier','B',6.5);
    $this->CellFitSpace(10,5,'FIRMA',1,0,'C', True);
    $this->Cell(15,5,"",1,0,'C');
    $this->CellFitSpace(15,5,'N� DE HOJA',1,0,'C', True);
    $this->SetFont('Courier','B',6.5);
    $this->Cell(8,5,portales(utf8_decode($reg[0]['cododontologia'])),1,1,'C');

    $this->Ln(2);
    $this->SetX(6);
    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es VERDE)
    $this->CellFitSpace(200,5,'11. TRATAMIENTO',1,1,'L', True);

    $this->Ln(1);
    $this->SetX(6);
    $this->SetFont('Courier','B',6.5);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->SetFillColor(204,255,204); // establece el color del fondo de la celda (en este caso es VERDE)
    $this->CellFitSpace(26,5,'SESI�N : FECHA',1,0,'C', True);
    $this->CellFitSpace(48,5,'DIAGNOSTICOS Y COMPLICACIONES',1,0,'C', True);
    $this->CellFitSpace(48,5,'PROCEDIMIENTOS',1,0,'C', True);
    $this->CellFitSpace(48,5,'PRESCRIPCIONES',1,0,'C', True);
    $this->CellFitSpace(30,5,'C�DIGO Y FIRMA',1,1,'C', True);

    $detalle = new Login();
    $detalle = $detalle->VerDetallesOdontologia();

    if($detalle==""){

    echo "";      

    } else {

    $this->SetWidths(array(26,48,48,48,30));

    for($i=0;$i<sizeof($detalle);$i++):

    $this->SetX(6);
    $this->SetFont('Courier',"",7);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array(
        utf8_decode($detalle[$i]["codsesion"]." : ".date("d-m-Y",strtotime($detalle[$i]['fecha_detalle']))),
        portales(utf8_decode($detalle[$i]['diagnostico'])),
        portales(utf8_decode($detalle[$i]['procedimientos'])),
        portales(utf8_decode($detalle[$i]['prescripciones'])),
        portales(utf8_decode(""))
    ));

    //$this->Ln();
    endfor;

    } 


    $this->Ln(20); 
    
    $img = "./fotos/firmasdigitales/".$reg[0]['codmedico'].".jpg";

    if (file_exists($img)) {
     
    $this->SetFont('Courier','BI',12);
    $this->Cell(0, 0,$this->Image($img, $this->GetX()+150, $this->GetY()-15, 35), 0, 0, "JPG" );
    $this->Ln(4);
    $this->Cell(300,0,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,portales(utf8_decode($reg[0]['nomespecialidad'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,'M.P.S. '.utf8_decode($reg[0]['mps']),'',1,'C');

    } else {

    $this->SetFont('Courier','BI',12);
    $this->Cell(0, 0,'', 0, 0, "JPG" );
    $this->Ln(4);
    $this->Cell(300,0,'DR. '.portales(utf8_decode($reg[0]['nommedico'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,portales(utf8_decode($reg[0]['nomespecialidad'])),'',1,'C');
    $this->Ln(4);
    $this->Cell(300,0,'M.P.S. '.utf8_decode($reg[0]['mps']),'',1,'C');
    }

}
############################### FUNCION PARA MOSTRAR ODONTOLOGIAS ################################# 

########################## FUNCION LISTAR ODONTOLOGIAS ##############################
function TablaListarOdontologias()
{

    $tra = new Login();
    $reg = $tra->ListarOdontologias();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE ODONTOLOGIAS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(70,8,'MOTIVO DE CONSULTA',1,0,'C', True);
    $this->Cell(40,8,'PROBLEMA ACTUAL',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,70,40,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['motivo_consulta'])),
        portales(utf8_decode($reg[$i]['problema_actual'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaodontologia']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR ODONTOLOGIAS ##############################

########################## FUNCION LISTAR ODONTOLOGIAS POR FECHAS ##############################
function TablaListarOdontologiasxFechas()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarOdontologiasxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE ODONTOLOGIAS POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(75,8,'MOTIVO DE CONSULTA',1,0,'C', True);
    $this->Cell(75,8,'PROBLEMA ACTUAL',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,70,70,75,75,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['motivo_consulta'])),
        portales(utf8_decode($reg[$i]['problema_actual'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaodontologia'])))));
       }
    }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR ODONTOLOGIAS POR FECHAS ##############################

########################## FUNCION LISTAR ODONTOLOGIAS POR MEDICO ##############################
function TablaListarOdontologiasxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarOdontologiasxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE ODONTOLOGIAS POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(90,8,'MOTIVO DE CONSULTA',1,0,'C', True);
    $this->Cell(90,8,'PROBLEMA ACTUAL',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,90,90,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($reg[$i]['motivo_consulta'])),
        portales(utf8_decode($reg[$i]['problema_actual'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaodontologia'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR ODONTOLOGIAS POR MEDICO ##############################

########################## FUNCION LISTAR ODONTOLOGIAS POR PACIENTE ##############################
function TablaListarOdontologiasxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarOdontologiasxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE ODONTOLOGIAS POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(100,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(90,8,'MOTIVO DE CONSULTA',1,0,'C', True);
    $this->Cell(90,8,'PROBLEMA ACTUAL',1,0,'C', True);
    $this->Cell(45,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,100,90,90,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($reg[$i]['motivo_consulta'])),
        portales(utf8_decode($reg[$i]['problema_actual'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaodontologia'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR ODONTOLOGIAS POR PACIENTE ##############################

############################### REPORTES DE ODONTOLOGIAS ##############################


















############################### REPORTES DE CONSENTIMIENTOS INFORMADOS ##############################

############################### FUNCION PARA MOSTRAR CONSENTIMIENTO ################################# 
function TablaConsentimientoInformado()
  {
    $tra = new Login();
    $reg = $tra->ConsentimientosPorId();

    ################################# MEMBRETE A4 #################################
    $logo = ( file_exists("./fotos/sucursales/".$reg[0]['cuitsucursal'].".png") == "" ? "./assets/img/null.png" : "./fotos/sucursales/".$reg[0]['cuitsucursal'].".png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png"); 

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(55,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_vertical_X'], $this->GetY()+$GLOBALS['logo1_vertical_Y'], $GLOBALS['logo1_vertical']),0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['nomsucursal'])),0,0,'C');
    $this->Cell(55,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_vertical_X'], $this->GetY()+$GLOBALS['logo2_vertical_Y'], $GLOBALS['logo2_vertical']),0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['documsucursal'] == '0' ? "" : $reg[0]['documento'])." ".utf8_decode($reg[0]['cuitsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    if($reg[0]['idprovincia']!='0'){

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->Cell(90,5,strtoupper(portales(utf8_decode($parroquia = ($reg[0]['idparroquia'] == '0' ? "" : $reg[0]['parroquia'])." ".$canton = ($reg[0]['idcanton'] == '0' ? "" : $reg[0]['canton'])." ".$provincia = ($reg[0]['idprovincia'] == '0' ? "" : $reg[0]['provincia'])))),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    } 

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,portales(utf8_decode($reg[0]['direcsucursal'])),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');


    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,"N� TLF: ".utf8_decode($reg[0]['tlfsucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');

    $this->Ln();
    $this->SetX(6);
    $this->Cell(55,5,"",0,0,'C');
    $this->CellFitSpace(90,5,utf8_decode($reg[0]['correosucursal']),0,0,'C');
    $this->Cell(55,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE A4 #################################

    $this->Ln();
    $this->SetX(6);
    $this->SetFont('Courier','B',16);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

    switch($reg[0]["tipoconsentimiento"]){
    case 1:
    $this->CellFitSpace(200,5,'CONSENTIMIENTO INFORMADO PARA CONSULTORIO',0,0,'C');
    break;
    case 2:
    $this->CellFitSpace(200,5,'CONSENTIMIENTO INFORMADO PARA GINECOLOGIA',0,0,'C');
    break;
    case 3:
    $this->CellFitSpace(200,5,'CONSENTIMIENTO INFORMADO PARA LABORATORIO',0,0,'C');
    break;
    case 4:
    $this->CellFitSpace(200,5,'CONSENTIMIENTO INFORMADO PARA RADIOLOGIA',0,0,'C');
    break;
    case 5:
    $this->CellFitSpace(200,5,'CONSENTIMIENTO INFORMADO PARA TERAPEUTA',0,0,'C');
    break;
    case 6:
    $this->CellFitSpace(200,5,'CONSENTIMIENTO INFORMADO PARA ODONTOLOGIA',0,0,'C');
    break;
    }//end switch
    $this->Ln(4);

    $this->Ln(3);
    $this->SetFont('Courier','',8);  
    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier','',9); 
    $this->WriteFlowingBlock('PARA SATISFACCI�N DE LOS ');
    $this->SetFont('Courier', 'B', 9);
    $this->WriteFlowingBlock('DERECHOS DEL PACIENTE, ');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('COMO INSTRUMENTO FAVORECEDOR DEL CORRECTO USO DE LOS PROCEDIMIENTOS TERAP�UTICOS Y DIAGN�STICOS' );
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier','',9); 
    $this->WriteFlowingBlock('YO D/D� ');
    $this->SetFont('Courier', 'B', 9);
    $this->WriteFlowingBlock(portales(utf8_decode($reg[0]['nompaciente'].' '.$reg[0]['apepaciente'])));
    $this->SetFont('Courier', 'B', 9);
    $this->WriteFlowingBlock(portales(utf8_decode($variable = ( edad($reg[0]['fnacpaciente']) >= '18' ? ", MAYOR DE EDAD" : ", MENOR DE EDAD"))));

    $this->SetFont('Courier','',9); 
    $this->WriteFlowingBlock(', CON ');
    $this->SetFont('Courier', 'B', 9);
    $this->WriteFlowingBlock($reg[0]['documento']." N� ".$reg[0]['cedpaciente']);
    $this->SetFont('Courier','',9); 
    $this->WriteFlowingBlock(', Y CON ');
    $this->SetFont('Courier', 'B', 9);
    $this->WriteFlowingBlock(portales(utf8_decode('HCL: '.$reg[0]['numerohistoria'])));

    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock(' COMO PACIENTE O ');
    $this->SetFont('Courier', 'B', 9);
    $this->WriteFlowingBlock(portales(utf8_decode($responsable = ($reg[0]['nomresponsable'] == "" ? "**********" : $reg[0]['nomresponsable']))));
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock(' COMO SU REPRESENTANTE EN PLENO USO DE MIS FACULTADES, LIBRE Y VOLUNTARIAMENTE');
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier','B',9);
    $this->WriteFlowingBlock('DECLARO');
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier','',9);
    $this->WriteFlowingBlock('QUE EL/LA DR/DRA ');
    $this->SetFont('Courier', 'B', 9);
    $this->WriteFlowingBlock(portales(utf8_decode($reg[0]['nommedico'])));
    $this->SetFont('Courier','',9);
    $this->WriteFlowingBlock(', CON PROFESI�N O ESPECIALIDAD ');
    $this->SetFont('Courier', 'B', 9);
    $this->WriteFlowingBlock(portales(utf8_decode($reg[0]['nomespecialidad'])));
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock(' ME HA EXPLICADO, EN T�RMINOS ASEQUIBLES, LA NATURALEZA EXACTA DE LA INTERVENCI�N O PROCEDIMIENTO QUE SE ME VA A REALIZAR Y SU NECESIDAD. HE TENIDO LA OPORTUNIDAD DE DISCUTIR CON EL FACULTATIVO C�MO SE VA A EFECTUAR, SU PROP�SITO, LAS ALTERNATIVAS RAZONABLES, LAS POSIBLES CONSECUENCIAS DE NO HACER ESTE TRATAMIENTO Y TODOS LOS RIESGOS Y POSIBLES COMPLICACIONES QUE DE �L PUEDAN DERIVARSE. ');
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('COMPRENDO TAMBI�N QUE UN RESULTADO INDESEABLE NO NECESARIAMENTE IMPLICA UN ERROR EN ESE JUICIO, POR LO QUE BUSCANDO LOS MEJORES RESULTADOS CONF�O EN QUE EL CONOCIMIENTO Y LAS DECISIONES DEL PROFESIONAL DURANTE EL PROCEDIMIENTO O INTERVENCI�N ESTAR�N BASADOS SOBRE LOS HECHOS HASTA ENTONCES CONOCIDOS, BUSCANDO SIEMPRE MI MAYOR BENEFICIO.');
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('ME HA EXPLICADO QUE EL TRATAMIENTO QUE SE VA A HACER SE EFECTUAR� BAJO ANESTESIA LOCAL, O GENERAL EN LOS CASOS QUE REQUIEREN HOSPITALIZACI�N. SU FINALIDAD ES BLOQUEAR, DE FORMA REVERSIBLE, LA TRANSMISI�N DE LOS IMPULSOS NERVIOSOS, PARA PODER REALIZAR LA INTERVENCI�N SIN DOLOR.');
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('SI BIEN A PARTIR DE MIS ANTECEDENTES PERSONALES NO SE DEDUCEN POSIBLES ALERGIAS O HIPERSENSIBILIDAD A LOS COMPONENTES DE LA SOLUCI�N ANEST�SICA, ELLO NO EXCLUYE LA POSIBILIDAD DE QUE, A PESAR DE SER MUY IMPROBABLE, PUEDAN PRESENTARSE MANIFESTACIONES AL�RGICAS DEL TIPO URTICARIA, DERMATITIS DE CONTACTO, ASMA, EDEMA ANGIONEUR�TICO, Y EN CASOS EXTREMOS SHOCK ANAFIL�CTICO, QUE PUEDEN REQUERIR TRATAMIENTO URGENTE.');
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('LAS SUSTANCIAS QUE CONTIENE LA SOLUCI�N ANEST�SICA PUEDEN ORIGINAR LEVES ALTERACIONES DEL PULSO Y DE LA TENSI�N ARTERIAL. SE ME HA INFORMADO QUE, A�N EN EL CASO DE QUE NO SE DEDUZCA NING�N TIPO DE PATOLOG�A CARDIOVASCULAR DE MIS ANTECEDENTES, LA PRESENCIA DE ADRENALINA PUEDE FAVORECER, AUNQUE DE FORMA MUY INUSUAL, LA APARICI�N DE ARRITMIAS LEVES.');
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier','',9);
    $this->WriteFlowingBlock('HE SIDO INFORMADO DE:');
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier','',9);
    $this->WriteFlowingBlock('� QUE ESTAS COMPLICACIONES GENERALES PUEDEN REQUERIR TRATAMIENTOS M�DICO-QUIR�RGICOS ADICIONALES Y QUE, RARAMENTE, ALGUNAS PUEDEN DEJAR SECUELAS DEFINITIVAS.');
    $this->finishFlowingBlock();

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier','',9);
    $this->WriteFlowingBlock('� LA BIOPSIA CONSISTE EN LA TOMA DE UNA MUESTRA REPRESENTATIVA DE LA LESI�N. ESTE PROCEDIMIENTO ANALIZADO POR EL PAT�LOGO, NOS DA EL DIAGN�STICO DEFINITIVO DE LA LESI�N, LO QUE DAR� PASO AL COMIENZO DEL TRATAMIENTO CONCRETO DE LA MISMA. LAS COMPLICACIONES POTENCIALES DE ESTE TRATAMIENTO QUIR�RGICO, SON, APARTE DE LAS MENCIONADAS PREVIAMENTE:');
    $this->finishFlowingBlock();

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier','',9);
    $this->WriteFlowingBlock('- NECESIDAD DE REPETIR LA BIOPSIA, SI EL PAT�LOGO NECESITARA OTRA MUESTRA PARA UN AN�LISIS HISTOL�GICO M�S DETALLADO');
    $this->finishFlowingBlock();

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier','',9);
    $this->WriteFlowingBlock('- INFECCI�N POSTQUIR�RGICA DE LA ZONA BIOPSIADA.');
    $this->finishFlowingBlock();

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier','',9);
    $this->WriteFlowingBlock('- HEMORRAGIA DURANTE LAS PRIMERAS HORAS POSTINTERVENCI�N.');
    $this->finishFlowingBlock();

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier','',9);
    $this->WriteFlowingBlock('- DEHISCENCIA DE LA SUTURA.');
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('CONSIENTO EN QUE SE TOMEN FOTOGRAF�AS O REGISTROS EN OTROS TIPOS DE SOPORTE AUDIOVISUAL, ANTES, DURANTE Y DESPU�S DE LA INTERVENCI�N QUIR�RGICA, PARA FACILITAR EL AVANCE DEL CONOCIMIENTO CIENT�FICO Y LA DOCENCIA. EN TODOS LOS CASOS SER� RESGUARDADA LA IDENTIDAD DEL/DE LA PACIENTE.');
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('HE COMPRENDIDO LAS EXPLICACIONES QUE SE ME HAN FACILITADO, Y EL FACULTATIVO ME HA PERMITIDO REALIZAR TODAS LAS OBSERVACIONES Y ME HA ACLARADO TODAS LAS DUDAS QUE LE HE PLANTEADO.');
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('SI SURGIERA CUALQUIER SITUACI�N INESPERADA DURANTE LA INTERVENCI�N, AUTORIZO A MI ESPECIALISTA A REALIZAR CUALQUIER PROCEDIMIENTO O MANIOBRA QUE, EN SU JUICIO CL�NICO, ESTIME OPORTUNA PARA MI MEJOR TRATAMIENTO.');
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('TAMBI�N COMPRENDO, QUE EN CUALQUIER MOMENTO Y SIN NECESIDAD DE DAR NINGUNA EXPLICACI�N, PUEDO REVOCAR EL CONSENTIMIENTO QUE AHORA PRESTO.');
    $this->finishFlowingBlock();
    $this->Ln(4);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('POR ELLO, ME CONSIDERO EN CONDICIONES DE PONDERAR DEBIDAMENTE TANTO LOS RIESGOS COMO LA UTILIDAD Y BENEFICIO QUE PUEDO OBTENER DEL TRATAMIENTO; AS� PUES, MANIFIESTO QUE ESTOY SATISFECHO/A CON LA INFORMACI�N RECIBIDA Y POR ELLO,');

    $this->SetFont('Courier', 'B', 9);
    $this->WriteFlowingBlock('YO DOY MI CONSENTIMIENTO, ');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('PARA LA REALIZACI�N DEL PROCEDIMIENTO');
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->SetFont('Courier', 'B', 9);
    $this->MultiCell(190,4,portales(utf8_decode($reg[0]['procedimiento'])),0,'J'); 
    $this->Ln(3);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('BAJO ANESTESIA');
    $this->finishFlowingBlock();
    $this->Ln(1);

    $this->SetFont('Courier', 'B', 9);
    $this->MultiCell(190,4,portales(utf8_decode($reg[0]['anestesia'])),0,'J'); 
    $this->Ln(3);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('ENFERMEDAD');
    $this->finishFlowingBlock();
    $this->Ln(1);

    $this->SetFont('Courier', 'B', 9);
    $this->MultiCell(190,4,portales(utf8_decode($reg[0]['enfermedad'])),0,'J'); 
    $this->Ln(3);

    $this->SetFont('Courier', 'B', 9);
    $this->MultiCell(190,4,$observacion = ($reg[0]['observaciones'] == "" ? "" : "OBSERVACIONES: ".portales(utf8_decode($reg[0]['observaciones']))),0,'J'); 
    $this->Ln(3);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('Y PARA QUE AS� CONSTE, FIRMO EL PRESENTE ORIGINAL DESPU�S DE LE�DO.');
    $this->finishFlowingBlock();
    $this->Ln(2);

    $this->newFlowingBlock(190, 4, 0, 'J');
    $this->SetFont('Courier', '', 9);
    $this->WriteFlowingBlock('EN ');
    $this->SetFont('Courier', 'B', 9);
    $this->WriteFlowingBlock(convertir(date("m", strtotime($reg[0]['fechaconsentimiento']))));
    $this->WriteFlowingBlock(' A LOS ');
    $this->SetFont('Courier', 'B', 9);
    $this->WriteFlowingBlock(date("d", strtotime($reg[0]['fechaconsentimiento'])));
    $this->WriteFlowingBlock(' DIAS DEL A�O ');
    $this->SetFont('Courier', 'B', 9);
    $this->WriteFlowingBlock(date("Y", strtotime($reg[0]['fechaconsentimiento'])));
    $this->finishFlowingBlock();
    $this->Ln(6); 
    
    $this->SetFont('Courier','B',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(80,4,'FIRMA DEL PACIENTE Y DNI',0,0,'L');
    $this->Cell(30,5,'',0,0,'L');
    $this->CellFitSpace(80,4,'FIRMA DEL M�DICO/'.portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','B',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(80,4,'(O REPRESENTANTE LEGAL)',0,0,'L');
    $this->SetFont('Courier','',9);
    $this->Cell(30,5,'',0,0,'L');
    $this->CellFitSpace(80,4,portales(utf8_decode($reg[0]['nommedico'])),0,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(80,4,portales($nombre = (edad($reg[0]['fnacpaciente']) >= '18' ? utf8_decode($reg[0]['nompaciente'].' '.$reg[0]['apepaciente']) : utf8_decode($reg[0]['nomresponsable']))),0,0,'L');
    $this->Cell(30,5,'',0,0,'L');
    $this->CellFitSpace(80,4,'M.P.S. '.$reg[0]['mps'],0,0,'L');
    $this->Ln();
    
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(80,4,portales($cedula = (edad($reg[0]['fnacpaciente']) >= '18' ? utf8_decode($reg[0]['documento4']).' N� '.$reg[0]['cedpaciente'] : "**********")),0,0,'L');
    $this->Cell(30,4,'',0,0,'L');
    $this->Cell(80,4,'',0,0,'L');
    $this->Ln();
}
############################### FUNCION PARA MOSTRAR CONSENTIMIENTO ################################# 

########################## FUNCION LISTAR CONSENTIMIENTOS ##############################
function TablaListarConsentimientos()
{

    $tra = new Login();
    $reg = $tra->ListarConsentimientos();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE CONSENTIMIENTOS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(60,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(60,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(60,8,'TIPO',1,0,'C', True);
    $this->Cell(60,8,'PROCEDIMIENTO',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,0,'C', True);
    $this->Cell(50,8,'SUCURSAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,60,60,60,60,35,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){

    switch($reg[$i]['tipoconsentimiento']){
    case 1:
    $informado = "CONSENTIMIENTO INFORMADO PARA CONSULTORIO";
    break;
    case 2:
    $informado = "CONSENTIMIENTO INFORMADO PARA GINECOLOGIA";
    break;
    case 3:
    $informado = "CONSENTIMIENTO INFORMADO PARA LABORATORIO";
    break;
    case 4:
    $informado = "CONSENTIMIENTO INFORMADO PARA RADIOLOGIA";
    break;
    case 5:
    $informado = "CONSENTIMIENTO INFORMADO PARA TERAPEUTA";
    break;
    case 6:
    $informado = "CONSENTIMIENTO INFORMADO PARA ODONTOLOGIA";
    break;
    }//end switch 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($informado)),
        portales(utf8_decode($reg[$i]['procedimiento'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaconsentimiento']))),
        portales(utf8_decode($reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR CONSENTIMIENTOS ##############################

########################## FUNCION LISTAR CONSENTIMIENTOS POR FECHAS ##############################
function TablaListarConsentimientosxFechas()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarConsentimientosxFechas();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE CONSENTIMIENTOS POR FECHAS',0,0,'C');

    $this->Ln();
    $this->Cell(335,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Ln();
    $this->Cell(335,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(65,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(55,8,'TIPO',1,0,'C', True);
    $this->Cell(50,8,'PROCEDIMIENTO',1,0,'C', True);
    $this->Cell(50,8,'ENFERMEDAD',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,65,55,50,50,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){

    switch($reg[$i]['tipoconsentimiento']){
    case 1:
    $informado = "CONSENTIMIENTO INFORMADO PARA CONSULTORIO";
    break;
    case 2:
    $informado = "CONSENTIMIENTO INFORMADO PARA GINECOLOGIA";
    break;
    case 3:
    $informado = "CONSENTIMIENTO INFORMADO PARA LABORATORIO";
    break;
    case 4:
    $informado = "CONSENTIMIENTO INFORMADO PARA RADIOLOGIA";
    break;
    case 5:
    $informado = "CONSENTIMIENTO INFORMADO PARA TERAPEUTA";
    break;
    case 6:
    $informado = "CONSENTIMIENTO INFORMADO PARA ODONTOLOGIA";
    break;
    }//end switch  

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($informado)),
        portales(utf8_decode($reg[$i]['procedimiento'])),
        portales(utf8_decode($reg[$i]['enfermedad'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaconsentimiento'])))));
       }
    }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR CONSENTIMIENTOS POR FECHAS ##############################

########################## FUNCION LISTAR CONSENTIMIENTOS POR MEDICO ##############################
function TablaListarConsentimientosxMedico()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarConsentimientosxMedico();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE CONSENTIMIENTOS POR MEDICO',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3'])).": ".utf8_decode($reg[0]["cedmedico"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]["nommedico"])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"ESPECIALIDAD: ".portales(utf8_decode($reg[0]['nomespecialidad'])),0,0,'L');

    $this->Ln();
    $this->Cell(335,6,"DESDE: ".date("d-m-Y", strtotime($_GET["desde"])),0,0,'L');
    $this->Ln();
    $this->Cell(335,6,"HASTA: ".date("d-m-Y", strtotime($_GET["hasta"])),0,0,'L'); 
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE PACIENTE',1,0,'C', True);
    $this->Cell(60,8,'TIPO',1,0,'C', True);
    $this->Cell(80,8,'PROCEDIMIENTO',1,0,'C', True);
    $this->Cell(80,8,'ENFERMEDAD',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,70,60,80,80,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){

    switch($reg[$i]['tipoconsentimiento']){
    case 1:
    $informado = "CONSENTIMIENTO INFORMADO PARA CONSULTORIO";
    break;
    case 2:
    $informado = "CONSENTIMIENTO INFORMADO PARA GINECOLOGIA";
    break;
    case 3:
    $informado = "CONSENTIMIENTO INFORMADO PARA LABORATORIO";
    break;
    case 4:
    $informado = "CONSENTIMIENTO INFORMADO PARA RADIOLOGIA";
    break;
    case 5:
    $informado = "CONSENTIMIENTO INFORMADO PARA TERAPEUTA";
    break;
    case 6:
    $informado = "CONSENTIMIENTO INFORMADO PARA ODONTOLOGIA";
    break;
    }//end switch  

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente'])),
        portales(utf8_decode($informado)),
        portales(utf8_decode($reg[$i]['procedimiento'])),
        portales(utf8_decode($reg[$i]['enfermedad'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaconsentimiento'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR CONSENTIMIENTOS POR MEDICO ##############################

########################## FUNCION LISTAR CONSENTIMIENTOS POR PACIENTE ##############################
function TablaListarConsentimientosxPaciente()
{
    $busqueda = new Login();
    $reg = $busqueda->BuscarConsentimientosxPaciente();

    ################################# MEMBRETE LEGAL #################################
    $logo = ( file_exists("./fotos/logo_principal.png") == "" ? "./assets/img/null.png" : "./fotos/logo_principal.png");
    $logo2 = ( file_exists("./fotos/logo_pdf.png") == "" ? "./assets/img/null.png" : "./fotos/logo_pdf.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(90,5,$this->Image($logo, $this->GetX()+$GLOBALS['logo1_horizontal_X'], $this->GetY()+$GLOBALS['logo1_horizontal_Y'], $GLOBALS['logo1_horizontal']),0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['nomsucursal'])),0,0,'C');
    $this->Cell(90,5,$this->Image($logo2, $this->GetX()+$GLOBALS['logo2_horizontal_X'], $this->GetY()+$GLOBALS['logo2_horizontal_Y'], $GLOBALS['logo2_horizontal']),0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['documsucursal'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['cuitsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    

    if($con[0]['idprovincia']!='0'){

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,strtoupper(portales(utf8_decode($parroquia = ($con[0]['idparroquia'] == '0' ? "" : $con[0]['parroquia'])." ".$canton = ($con[0]['idcanton'] == '0' ? "" : $con[0]['canton'])." ".$provincia = ($con[0]['idprovincia'] == '0' ? "" : $con[0]['provincia'])))),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    }

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,portales(utf8_decode($con[0]['direcsucursal'])),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,"N� TLF: ".utf8_decode($con[0]['tlfsucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(90,5,"",0,0,'C');
    $this->Cell(150,5,utf8_decode($con[0]['correosucursal']),0,0,'C');
    $this->Cell(90,5,"",0,0,'C');
    $this->Ln(5);
    ################################# MEMBRETE LEGAL #################################
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE CONSENTIMIENTOS POR PACIENTE',0,0,'C');

    $this->Ln();
    $this->Cell(168,6,"N� ".utf8_decode($reg[0]['documento2'])." SUCURSAL: ".utf8_decode($reg[0]["cuitsucursal"]),0,0,'L');
    $this->Cell(167,6,"N� ".utf8_decode($documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4'])).": ".utf8_decode($reg[0]["cedpaciente"]),0,0,'L');

    $this->Ln();
    $this->Cell(168,6,"SUCURSAL: ".portales(utf8_decode($reg[0]["nomsucursal"])),0,0,'L'); 
    $this->Cell(167,6,"NOMBRES: ".portales(utf8_decode($reg[0]['nompaciente']." ".$reg[0]['apepaciente'])),0,0,'L'); 

    $this->Ln();
    $this->Cell(168,6,"ENCARGADO SUCURSAL: ".portales(utf8_decode($reg[0]["nomencargado"])),0,0,'L');
    $this->Cell(167,6,"N� DE TELEFONO: ".portales(utf8_decode($reg[0]['tlfpaciente'] == '' ? "*********" : $reg[0]['tlfpaciente'])),0,0,'L');
    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(30, 116, 172); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE M�DICO',1,0,'C', True);
    $this->Cell(60,8,'TIPO',1,0,'C', True);
    $this->Cell(80,8,'PROCEDIMIENTO',1,0,'C', True);
    $this->Cell(80,8,'ENFERMEDAD',1,0,'C', True);
    $this->Cell(35,8,'FECHA | HORA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,70,60,80,80,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 

    switch($reg[$i]['tipoconsentimiento']){
    case 1:
    $informado = "CONSENTIMIENTO INFORMADO PARA CONSULTORIO";
    break;
    case 2:
    $informado = "CONSENTIMIENTO INFORMADO PARA GINECOLOGIA";
    break;
    case 3:
    $informado = "CONSENTIMIENTO INFORMADO PARA LABORATORIO";
    break;
    case 4:
    $informado = "CONSENTIMIENTO INFORMADO PARA RADIOLOGIA";
    break;
    case 5:
    $informado = "CONSENTIMIENTO INFORMADO PARA TERAPEUTA";
    break;
    case 6:
    $informado = "CONSENTIMIENTO INFORMADO PARA ODONTOLOGIA";
    break;
    }//end switch 

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        portales(utf8_decode($documento = ($reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3'])." ".$reg[$i]['cedmedico'].": ".$reg[$i]['nommedico'])),
        portales(utf8_decode($informado)),
        portales(utf8_decode($reg[$i]['procedimiento'])),
        portales(utf8_decode($reg[$i]['enfermedad'])),
        utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]['fechaconsentimiento'])))));
       }
    }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR CONSENTIMIENTOS POR PACIENTE ##############################

############################### REPORTES DE CONSENTIMIENTOS INFORMADOS ##############################

 // FIN Class PDF
}
?>