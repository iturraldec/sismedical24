<?php
require_once("class/class.php");
    if (isset($_SESSION['acceso'])) {
       if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION['acceso'] == "enfermera" || $_SESSION["acceso"]=="medico") {

$con = new Login();
$con = $con->ConfiguracionPorId();

$tipo = decrypt($_GET['tipo']);
$documento = decrypt($_GET['documento']);
$extension = $documento == 'EXCEL' ? '.xls' : '.doc';

switch($tipo)
{
################################## MODULO DE USUARIOS ##################################

case 'USUARIOS': 

$tra = new Login();
$reg = $tra->ListarUsuarios();

$archivo = str_replace(" ", "_","LISTADO DE USUARIOS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>TIPO DE DOCUMENTO</th>
           <th>Nº DE DOCUMENTO</th>
           <th>NOMBRES Y APELLIDOS</th>
<?php if ($documento == "EXCEL") { ?>
           <th>SEXO</th>
           <th>Nº DE TELEFÓNO</th>
           <th>Nº DE CELULAR</th>
           <th>DIRECCIÓN DOMICILIARIA</th>
           <th>DISTRITO</th>
           <th>PROVINCIA</th>
           <th>DEPARTAMENTO</th>
           <th>CORREO ELECTRONICO</th>
           <th>FECHA NACIMIENTO</th>
<?php } ?>
           <th>USUARIO</th>
           <th>NIVEL</th>
           <th>STATUS</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['documusuario'] == '0' ? "*********" : $reg[$i]['documento']; ?></td>
           <td><?php echo $reg[$i]['dni']; ?></td>
           <td><?php echo $reg[$i]['nombres']; ?></td>
<?php if ($documento == "EXCEL") { ?>
           <td><?php echo $reg[$i]['sexo']; ?></td>
           <td><?php echo $reg[$i]['telefono'] == '0' ? "*********" : $reg[$i]['telefono']; ?></td>
           <td><?php echo $reg[$i]['celular'] == '0' ? "*********" : $reg[$i]['celular']; ?></td>
           <td><?php echo $reg[$i]['direccion']; ?></td>
           <td><?php echo strtoupper($reg[$i]['idparroquia'] == '0' ? "*********" : $reg[$i]['parroquia']); ?></td>
          <td><?php echo strtoupper($reg[$i]['idcanton'] == '0' ? "*********" : $reg[$i]['canton']); ?></td>
          <td><?php echo strtoupper($reg[$i]['idprovincia'] == '0' ? "*********" : $reg[$i]['provincia']); ?></td>
           <td><?php echo $reg[$i]['email']; ?></td>
           <td><?php echo $reg[$i]['fnacimiento'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fnacimiento'])); ?></td>
<?php } ?>
           <td><?php echo $reg[$i]['usuario']; ?></td>
           <td><?php echo $reg[$i]['nivel']; ?></td>
           <td><?php echo $status = ( $reg[$i]['status'] == 1 ? "<span style='font-size:12px;color:#0b1379;font-weight:bold;'> ACTIVO</span>" : "<span style='font-size:12px;color:#e7515a;font-weight:bold;'> INACTIVO</span>"); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'LOGS': 

$archivo = str_replace(" ", "_","LISTADO LOGS DE ACCESO");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>IP EQUIPO</th>
           <th>TIEMPO DE ENTRADA</th>
           <th>NAVEGADOR DE ACCESO</th>
           <th>PÁGINAS DE ACCESO</th>
           <th>USUARIOS</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarLogs();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['ip']; ?></td>
           <td><?php echo $reg[$i]['tiempo']; ?></td>
           <td><?php echo $reg[$i]['detalles']; ?></td>
           <td><?php echo $reg[$i]['paginas']; ?></td>
           <td><?php echo $reg[$i]['usuario']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

################################ MODULO DE USUARIOS ##############################



############################### MODULO DE CONFIGURACIONES ###############################
case 'DOCUMENTOS': 

$archivo = str_replace(" ", "_","LISTADO DE DOCUMENTOS TRIBUTARIOS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE DOCUMENTO</th>
           <th>DESCRIPCIÓN DE DOCUMENTO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarDocumentos();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['documento']; ?></td>
           <td><?php echo $reg[$i]['descripcion']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'SEGUROS': 

$archivo = str_replace(" ", "_","LISTADO DE SEGUROS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE SEGURO</th>
           <th>DIRECCIÓN DE SEGURO</th>
           <th>Nº DE TELEFONO #1</th>
           <th>Nº DE TELEFONO #2</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarSeguros();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nomseguro']; ?></td>
           <td><?php echo $reg[$i]['direcseguro']; ?></td>
           <td><?php echo $reg[$i]['tlfseguro1']; ?></td>
           <td><?php echo $reg[$i]['tlfseguro2'] == "" ? "**********" : $reg[$i]['tlfseguro2']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'ESPECIALIDADES': 

$archivo = str_replace(" ", "_","LISTADO DE ESPECIALIDADES");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE ESPECIALIDAD</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarEspecialidades();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nomespecialidad']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'PROVINCIAS': 

$archivo = str_replace(" ", "_","LISTADO DE PROVINCIAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PROVINCIAS</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarProvincias();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $reg[$i]['codprovincia']; ?></td>
           <td><?php echo $reg[$i]['nomprovincia']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'CIUDADES': 

$archivo = str_replace(" ", "_","LISTADO DE CIUDADES");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PROVINCIA</th>
           <th>NOMBRE DE CIUDAD</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarCiudades();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $reg[$i]['codciudas']; ?></td>
           <td><?php echo $reg[$i]['nomprovincia']; ?></td>
           <td><?php echo $reg[$i]['nomciudad']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'SUCURSALES': 

$archivo = str_replace(" ", "_","LISTADO DE SUCURSALES");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE SUCURSAL</th>
           <th>NOMBRE DE SUCURSAL</th>
<?php if ($documento == "EXCEL") { ?>
           <th>DIRECCIÓN</th>
           <th>DISTRITO</th>
           <th>PROVINCIA</th>
           <th>DEPARTAMENTO</th>
<?php } ?>
           <th>CORREO ELECTRONICO</th>
           <th>Nº DE TELÉFONO</th>
<?php if ($documento == "EXCEL") { ?>
           <th>MONEDA NACIONAL</th>
           <th>Nº DOC. ENCARGADO</th>
<?php } ?>
           <th>NOMBRE DE ENCARGADO</th>
<?php if ($documento == "EXCEL") { ?>
           <th>Nº DE TELÉFONO ENCARGADO</th>
<?php } ?>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarSucursales();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['documento'].": ".$reg[$i]['cuitsucursal']; ?></td>
           <td><?php echo $reg[$i]['nomsucursal']; ?></td>
<?php if ($documento == "EXCEL") { ?>
           <td><?php echo $reg[$i]['direcsucursal']; ?></td>
           <td><?php echo strtoupper($reg[$i]['idparroquia'] == '0' ? "*********" : $reg[$i]['parroquia']); ?></td>
          <td><?php echo strtoupper($reg[$i]['idcanton'] == '0' ? "*********" : $reg[$i]['canton']); ?></td>
          <td><?php echo strtoupper($reg[$i]['idprovincia'] == '0' ? "*********" : $reg[$i]['provincia']); ?></td>
<?php } ?>
          <td><?php echo $reg[$i]['correosucursal']; ?></td>
          <td><?php echo $reg[$i]['tlfsucursal']; ?></td>
<?php if ($documento == "EXCEL") { ?>
           <td><?php echo $reg[$i]['codmoneda'] == '0' ? "*********" : $reg[$i]['moneda']; ?></td>
           <td><?php echo $reg[$i]['documento2'].": ".$reg[$i]['dniencargado']; ?></td>
<?php } ?>
          <td><?php echo $reg[$i]['nomencargado']; ?></td>
<?php if ($documento == "EXCEL") { ?>
           <td><?php echo $reg[$i]['tlfencargado'] == '' ? "*********" : $reg[$i]['tlfencargado']; ?></td>
<?php } ?>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'PLANTILLASECOGRAFICAS': 

$archivo = str_replace(" ", "_","LISTADO DE PLANTILLAS ECOGRAFICAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PLANTILLA</th>
           <th>PROCEDIMIENTO ECOGRAFICO</th>
           <th>DESCRIPCIÓN DE PLANTILLA</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarPlantillasEcograficas();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nombreplantillaecografia']; ?></td>
           <td><?php echo $reg[$i]['procedimientoecografia']; ?></td>
           <td><?php echo nl2br($reg[$i]['descripcionecografia']); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'PLANTILLASLECTURARX': 

$archivo = str_replace(" ", "_","LISTADO DE PLANTILLAS LECTURA RX");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PLANTILLA</th>
           <th>PROCEDIMIENTO DE ELCTURA RX</th>
           <th>DESCRIPCIÓN DE PLANTILLA</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarPlantillasLecturaRx();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nombreplantillalecturarx']; ?></td>
           <td><?php echo $reg[$i]['procedimientolecturarx']; ?></td>
           <td><?php echo nl2br($reg[$i]['descripcionlecturarx']); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;
############################### MODULO DE CONFIGURACIONES ##############################









############################### MODULO DE MEDICOS ###################################
case 'MEDICOS': 

$archivo = str_replace(" ", "_","LISTADO DE MEDICOS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>TIPO DE DOCUMENTO</th>
           <th>Nº DE DOCUMENTO</th>
           <th>NOMBRES Y APELLIDOS</th>
           <th>SEXO</th>
           <th>Nº DE TELEFONO</th>
           <th>Nº DE CELULAR</th>
<?php if ($documento == "EXCEL") { ?>
           <th>DIRECCIÓN</th>
           <th>DISTRITO</th>
           <th>PROVINCIA</th>
           <th>DEPARTAMENTO</th>
           <th>CORREO ELECTRONICO</th>
           <th>MPS</th>
           <th>ESPECIALIDAD</th>
           <th>FECHA NACIMIENTO</th>
<?php } ?>
           <th>SUCURSAL</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarMedicos();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['docummedico'] == '0' ? "*********" : $reg[$i]['documento']; ?></td>
          <td><?php echo $reg[$i]['cedmedico']; ?></td>
          <td><?php echo $reg[$i]['nommedico']; ?></td>
          <td><?php echo $reg[$i]['sexomedico']; ?></td>
          <td><?php echo $reg[$i]['tlfmedico'] == '' ? "*********" : $reg[$i]['tlfmedico']; ?></td>
          <td><?php echo $reg[$i]['celmedico'] == '' ? "*********" : $reg[$i]['celmedico']; ?></td>
<?php if ($documento == "EXCEL") { ?>
          <td><?php echo $reg[$i]['direcmedico']; ?></td>
          <td><?php echo strtoupper($reg[$i]['idparroquia'] == '0' ? "*********" : $reg[$i]['parroquia']); ?></td>
          <td><?php echo strtoupper($reg[$i]['idcanton'] == '0' ? "*********" : $reg[$i]['canton']); ?></td>
          <td><?php echo strtoupper($reg[$i]['idprovincia'] == '0' ? "*********" : $reg[$i]['provincia']); ?></td>
          <td><?php echo $reg[$i]['correomedico']; ?></td>
          <td><?php echo $reg[$i]['mps']; ?></td>
          <td><?php echo $reg[$i]['nomespecialidad']; ?></td>
          <td><?php echo $reg[$i]['fnacmedico'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fnacmedico'])); ?></td>
<?php } ?>
          <td><?php echo $reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'MEDICOSXSUCURSAL': 

 $busqueda = new Login();
 $reg = $busqueda->BusquedaMedicosxSucursal();

$archivo = str_replace(" ", "_","LISTADO DE MEDICOS DE (SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>TIPO DE DOCUMENTO</th>
           <th>Nº DE DOCUMENTO</th>
           <th>NOMBRES Y APELLIDOS</th>
           <th>SEXO</th>
           <th>Nº DE TELEFONO</th>
           <th>Nº DE CELULAR</th>
<?php if ($documento == "EXCEL") { ?>
           <th>DIRECCIÓN</th>
           <th>DISTRITO</th>
           <th>PROVINCIA</th>
           <th>DEPARTAMENTO</th>
           <th>CORREO ELECTRONICO</th>
           <th>MPS</th>
           <th>ESPECIALIDAD</th>
           <th>FECHA NACIMIENTO</th>
<?php } ?>
         </tr>
<?php 
if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['docummedico'] == '0' ? "*********" : $reg[$i]['documento']; ?></td>
          <td><?php echo $reg[$i]['cedmedico']; ?></td>
          <td><?php echo $reg[$i]['nommedico']; ?></td>
          <td><?php echo $reg[$i]['sexomedico']; ?></td>
          <td><?php echo $reg[$i]['tlfmedico'] == '' ? "*********" : $reg[$i]['tlfmedico']; ?></td>
          <td><?php echo $reg[$i]['celmedico'] == '' ? "*********" : $reg[$i]['celmedico']; ?></td>
<?php if ($documento == "EXCEL") { ?>
          <td><?php echo $reg[$i]['direcmedico']; ?></td>
          <td><?php echo strtoupper($reg[$i]['idparroquia'] == '0' ? "*********" : $reg[$i]['parroquia']); ?></td>
          <td><?php echo strtoupper($reg[$i]['idcanton'] == '0' ? "*********" : $reg[$i]['canton']); ?></td>
          <td><?php echo strtoupper($reg[$i]['idprovincia'] == '0' ? "*********" : $reg[$i]['provincia']); ?></td>
          <td><?php echo $reg[$i]['correomedico']; ?></td>
          <td><?php echo $reg[$i]['mps']; ?></td>
          <td><?php echo $reg[$i]['nomespecialidad']; ?></td>
          <td><?php echo $reg[$i]['fnacmedico'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fnacmedico'])); ?></td>
<?php } ?>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'HORARIOS': 

$archivo = str_replace(" ", "_","LISTADO DE HORARIOS DE MEDICOS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE DOCUMENTO</th>
           <th>NOMBRES Y APELLIDOS</th>
           <th>ESPECIALIDAD</th>
           <th>DIAS LABORALES</th>
           <th>HORA DESDE</th>
           <th>HORA HASTA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarHorarios();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['documento']." ".$reg[$i]['cedmedico']; ?></td>
          <td><?php echo $reg[$i]['nommedico']; ?></td>
          <td><?php echo $reg[$i]['nomespecialidad']; ?></td>
          <td><?php echo Dias($reg[$i]['dias_laborales']); ?></td>
          <td><?php echo $reg[$i]['hora_desde']; ?></td>
          <td><?php echo $reg[$i]['hora_hasta']; ?></td>
          <td><?php echo $reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;
############################### MODULO DE MEDICOS ###################################











############################### MODULO DE PACIENTES ###################################
case 'PACIENTES': 

$archivo = str_replace(" ", "_","LISTADO DE PACIENTES");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE HISTORIA</th>
           <th>TIPO DE DOCUMENTO</th>
           <th>Nº DE DOCUMENTO</th>
           <th>NOMBRES</th>
           <th>APELLIDOS</th>
           <th>FECHA NACIMIENTO</th>
           <th>Nº DE TELEFONO</th>
           <th>CORREO ELECTRONICO</th>
           <th>GRUPO SANGUINEO</th>
           <th>SEGURO</th>
           <th>ESTADO CIVIL</th>
           <th>OCUPACIÓN</th>
           <th>SEXO</th>
           <th>ENFOQUE</th>
<?php if ($documento == "EXCEL") { ?>
           <th>DIRECCIÓN</th>
           <th>DISTRITO</th>
           <th>PROVINCIA</th>
           <th>DEPARTAMENTO</th>
           <th>NOMBRE DE ACOMPAÑANTE</th>
           <th>DIRECCIÓN DE ACOMPAÑANTE</th>
           <th>Nº DE TELÉFONO</th>
           <th>PARENTESCO DE ACOMPAÑANTE</th>
           <th>NOMBRE DE RESPONSABLE</th>
           <th>DIRECCIÓN DE RESPONSABLE</th>
           <th>Nº DE TELÉFONO</th>
           <th>PARENTESCO DE RESPONSABLE</th>
<?php } ?>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarPacientes();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['numerohistoria']; ?></td>
           <td><?php echo $reg[$i]['documpaciente'] == '0' ? "*********" : $reg[$i]['documento']; ?></td>
          <td><?php echo $reg[$i]['cedpaciente']; ?></td>
          <td><?php echo $reg[$i]['pnompaciente']." ".$reg[$i]['snompaciente']; ?></td>
          <td><?php echo $reg[$i]['papepaciente']." ".$reg[$i]['sapepaciente']; ?></td>
          <td><?php echo $reg[$i]['fnacpaciente'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fnacpaciente'])); ?></td>
          <td><?php echo $reg[$i]['tlfpaciente'] == '' ? "*********" : $reg[$i]['tlfpaciente']; ?></td>
          <td><?php echo $reg[$i]['emailpaciente'] == '' ? "*********" : $reg[$i]['emailpaciente']; ?></td>
          <td><?php echo $reg[$i]['gruposapaciente'] == '' ? "*********" : $reg[$i]['gruposapaciente']; ?></td>
          <td><?php echo $reg[$i]['codseguro'] == '0' ? "*********" : $reg[$i]['nomseguro']; ?></td>
          <td><?php echo $reg[$i]['estadopaciente'] == '' ? "*********" : $reg[$i]['estadopaciente']; ?></td>
          <td><?php echo $reg[$i]['ocupacionpaciente'] == '' ? "*********" : $reg[$i]['ocupacionpaciente']; ?></td>
          <td><?php echo $reg[$i]['sexopaciente'] == '' ? "*********" : $reg[$i]['sexopaciente']; ?></td>
          <td><?php echo $reg[$i]['enfoquepaciente'] == '' ? "*********" : $reg[$i]['enfoquepaciente']; ?></td>
<?php if ($documento == "EXCEL") { ?>
          <td><?php echo $reg[$i]['direcpaciente'] == '' ? "*********" : $reg[$i]['direcpaciente']; ?></td>
          <td><?php echo strtoupper($reg[$i]['idparroquia'] == '0' ? "*********" : $reg[$i]['parroquia']); ?></td>
          <td><?php echo strtoupper($reg[$i]['idcanton'] == '0' ? "*********" : $reg[$i]['canton']); ?></td>
          <td><?php echo strtoupper($reg[$i]['idprovincia'] == '0' ? "*********" : $reg[$i]['provincia']); ?></td>
          <td><?php echo $reg[$i]['nomacompana'] == '' ? "*********" : $reg[$i]['nomacompana']; ?></td>
          <td><?php echo $reg[$i]['direcacompana'] == '' ? "*********" : $reg[$i]['direcacompana']; ?></td>
          <td><?php echo $reg[$i]['tlfacompana'] == '' ? "*********" : $reg[$i]['tlfacompana']; ?></td>
          <td><?php echo $reg[$i]['parentescoacompana'] == '' ? "*********" : $reg[$i]['parentescoacompana']; ?></td>
          <td><?php echo $reg[$i]['nomresponsable'] == '' ? "*********" : $reg[$i]['nomresponsable']; ?></td>
          <td><?php echo $reg[$i]['direcresponsable'] == '' ? "*********" : $reg[$i]['direcresponsable']; ?></td>
          <td><?php echo $reg[$i]['tlfresponsable'] == '' ? "*********" : $reg[$i]['tlfresponsable']; ?></td>
          <td><?php echo $reg[$i]['parentescoresponsable'] == '' ? "*********" : $reg[$i]['parentescoresponsable']; ?></td>
<?php } ?>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'PACIENTESCSV': 

$archivo = str_replace(" ", "_","LISTADO DE PACIENTES");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>TIPO DE DOCUMENTO</th>
           <th>Nº DE DOCUMENTO</th>
           <th>PRIMER NOMBRE</th>
           <th>SEGUNDO NOMBRE</th>
           <th>PRIMER APELLIDO</th>
           <th>SEGUNDO APELLIDO</th>
           <th>FECHA NACIMIENTO</th>
           <th>Nº DE TELEFONO</th>
           <th>CORREO ELECTRONICO</th>
           <th>GRUPO SANGUINEO</th>
           <th>SEGURO</th>
           <th>ESTADO CIVIL</th>
           <th>OCUPACIÓN</th>
           <th>SEXO</th>
           <th>ENFOQUE</th>
           <th>PROVINCIA</th>
           <th>CIUDAD</th>
           <th>DIRECCIÓN</th>
           <th>NOMBRE DE ACOMPAÑANTE</th>
           <th>DIRECCIÓN DE ACOMPAÑANTE</th>
           <th>Nº DE TELÉFONO</th>
           <th>PARENTESCO DE ACOMPAÑANTE</th>
           <th>NOMBRE DE RESPONSABLE</th>
           <th>DIRECCIÓN DE RESPONSABLE</th>
           <th>Nº DE TELÉFONO</th>
           <th>PARENTESCO DE RESPONSABLE</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarPacientes();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['documpaciente']; ?></td>
          <td><?php echo $reg[$i]['cedpaciente']; ?></td>
          <td><?php echo $reg[$i]['pnompaciente']; ?></td>
          <td><?php echo $reg[$i]['snompaciente']; ?></td>
          <td><?php echo $reg[$i]['papepaciente']; ?></td>
          <td><?php echo $reg[$i]['sapepaciente']; ?></td>
          <td><?php echo $reg[$i]['fnacpaciente']; ?></td>
          <td><?php echo $reg[$i]['tlfpaciente']; ?></td>
          <td><?php echo $reg[$i]['emailpaciente']; ?></td>
          <td><?php echo $reg[$i]['gruposapaciente']; ?></td>
          <td><?php echo $reg[$i]['codseguro']; ?></td>
          <td><?php echo $reg[$i]['estadopaciente']; ?></td>
          <td><?php echo $reg[$i]['ocupacionpaciente']; ?></td>
          <td><?php echo $reg[$i]['sexopaciente']; ?></td>
          <td><?php echo $reg[$i]['enfoquepaciente']; ?></td>
          <td><?php echo $reg[$i]['idprovincia']; ?></td>
          <td><?php echo $reg[$i]['idciudad']; ?></td>
          <td><?php echo $reg[$i]['direcpaciente']; ?></td>
          <td><?php echo $reg[$i]['nomacompana']; ?></td>
          <td><?php echo $reg[$i]['direcacompana']; ?></td>
          <td><?php echo $reg[$i]['tlfacompana']; ?></td>
          <td><?php echo $reg[$i]['parentescoacompana']; ?></td>
          <td><?php echo $reg[$i]['nomresponsable']; ?></td>
          <td><?php echo $reg[$i]['direcresponsable']; ?></td>
          <td><?php echo $reg[$i]['tlfresponsable']; ?></td>
          <td><?php echo $reg[$i]['parentescoresponsable']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;
############################### MODULO DE PACIENTES ###################################














##################################### MODULO DE CITAS MEDICAS ###################################
case 'CITASMEDICAS':

$tra = new Login();
$reg = $tra->ListarCitas(); 

$archivo = str_replace(" ", "_","LISTADO DE CITAS MEDICAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>MOTIVO DE CITA</th>
           <th>FECHA | HORA</th>
           <th>STATUS</th>
           <th>FECHA REGISTRO</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['pacientes']; ?></td>
          <td><?php echo $reg[$i]['descripcion']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacita'])); ?></td>
          <td>
          <?php if($reg[$i]['statuscita']==1) { 
          echo "<span style='font-size:12px;color:#155cc9;font-weight:bold;'> ATENDIDA</span>"; 
          } elseif($reg[$i]['statuscita']==2) {  
          echo "<span style='font-size:12px;color:#0d8541;font-weight:bold;'> PENDIENTE</span>";
          } elseif($reg[$i]['statuscita']==3) {  
          echo "<span style='font-size:12px;color:#e2a03f;font-weight:bold;'> CANCELADA</span>";
          } elseif($reg[$i]['statuscita']==4) { 
          echo "<span style='font-size:12px;color:#eb160c;font-weight:bold;'> VENCIDA</span>"; } ?>
          </td>
          <td><?php echo date("d-m-Y",strtotime($reg[$i]['ingresocita'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'CITASXFECHAS':

$tra = new Login();
$reg = $tra->BuscarCitasxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE CITAS MEDICAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>MOTIVO DE CITA</th>
           <th>FECHA | HORA</th>
           <th>STATUS</th>
           <th>FECHA REGISTRO</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['pacientes']; ?></td>
          <td><?php echo $reg[$i]['descripcion']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacita'])); ?></td>
          <td><?php if($reg[$i]['statuscita']==1) { 
          echo "<span style='font-size:12px;color:#155cc9;font-weight:bold;'> ATENDIDA</span>"; 
          } elseif($reg[$i]['statuscita']==2) {  
          echo "<span style='font-size:12px;color:#0d8541;font-weight:bold;'> PENDIENTE</span>";
          } elseif($reg[$i]['statuscita']==3) {  
          echo "<span style='font-size:12px;color:#e2a03f;font-weight:bold;'> CANCELADA</span>";
          } elseif($reg[$i]['statuscita']==4) { 
          echo "<span style='font-size:12px;color:#eb160c;font-weight:bold;'> VENCIDA</span>"; } ?></td>
          <td><?php echo date("d-m-Y",strtotime($reg[$i]['ingresocita'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'CITASXMEDICO':

$tra = new Login();
$reg = $tra->BuscarCitasxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE CITAS MEDICAS DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>MOTIVO DE CITA</th>
           <th>FECHA | HORA</th>
           <th>STATUS</th>
           <th>FECHA REGISTRO</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": ".$reg[$i]['pacientes']; ?></td>
          <td><?php echo $reg[$i]['descripcion']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacita'])); ?></td>
          <td><?php if($reg[$i]['statuscita']==1) { 
          echo "<span style='font-size:12px;color:#155cc9;font-weight:bold;'> ATENDIDA</span>"; 
          } elseif($reg[$i]['statuscita']==2) {  
          echo "<span style='font-size:12px;color:#0d8541;font-weight:bold;'> PENDIENTE</span>";
          } elseif($reg[$i]['statuscita']==3) {  
          echo "<span style='font-size:12px;color:#e2a03f;font-weight:bold;'> CANCELADA</span>";
          } elseif($reg[$i]['statuscita']==4) { 
          echo "<span style='font-size:12px;color:#eb160c;font-weight:bold;'> VENCIDA</span>"; } ?></td>
          <td><?php echo date("d-m-Y",strtotime($reg[$i]['ingresocita'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'CITASXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarCitasxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE CITAS MEDICAS DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]["pacientes"]." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>MOTIVO DE CITA</th>
           <th>FECHA | HORA</th>
           <th>STATUS</th>
           <th>FECHA REGISTRO</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $reg[$i]['descripcion']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacita'])); ?></td>
          <td><?php if($reg[$i]['statuscita']==1) { 
          echo "<span style='font-size:12px;color:#155cc9;font-weight:bold;'> ATENDIDA</span>"; 
          } elseif($reg[$i]['statuscita']==2) {  
          echo "<span style='font-size:12px;color:#0d8541;font-weight:bold;'> PENDIENTE</span>";
          } elseif($reg[$i]['statuscita']==3) {  
          echo "<span style='font-size:12px;color:#e2a03f;font-weight:bold;'> CANCELADA</span>";
          } elseif($reg[$i]['statuscita']==4) { 
          echo "<span style='font-size:12px;color:#eb160c;font-weight:bold;'> VENCIDA</span>"; } ?></td>
          <td><?php echo date("d-m-Y",strtotime($reg[$i]['ingresocita'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE CITAS MEDICAS ####################################










##################################### MODULO DE APERTURAS DE HISTORIA ###################################
case 'APERTURAS':

$tra = new Login();
$reg = $tra->ListarAperturas(); 

$archivo = str_replace(" ", "_","LISTADO DE APERTURAS DE HISTORIAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>ENFERMEDAD ACTUAL</th>
           <th>ANTECEDENTES PERSONALES</th>
           <th>ANTECEDENTES FAMILIARES</th>
           <th>ANTECEDENTES ALÉRGICOS</th>
           <th>ANTECEDENTES PATOLÓGICOS</th>
           <th>ANTECEDENTES QUIRÚRGICOS</th>
           <th>ANTECEDENTES FARMACOLÓGICOS</th>
           <th>ANTECEDENTES GINECOLÓGICOS</th>
           <th>HISTORIAL GESTACIONAL</th>
           <th>PLANIFICACIÓN FAMILIAR</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['enfermedadpaciente'] == '' ? "************" : $reg[$i]['enfermedadpaciente']; ?></td>
          <td><?php echo $reg[$i]['antecedentepaciente'] == '' ? "************" : $reg[$i]['antecedentepaciente']; ?></td>
          <td><?php echo $reg[$i]['antecedentefamiliares'] == '' ? "************" : $reg[$i]['antecedentefamiliares']; ?></td>
          <td><?php echo $reg[$i]['antecedentealergico'] == '' ? "************" : $reg[$i]['antecedentealergico']; ?></td>
          <td><?php echo $reg[$i]['antecedentepatologico'] == '' ? "************" : $reg[$i]['antecedentepatologico']; ?></td>
          <td><?php echo $reg[$i]['antecedentequirurgico'] == '' ? "************" : $reg[$i]['antecedentequirurgico']; ?></td>
          <td><?php echo $reg[$i]['antecedentefarmacologico'] == '' ? "************" : $reg[$i]['antecedentefarmacologico']; ?></td>
          <td><?php echo $reg[$i]['antecedenteginecologico'] == '' ? "************" : $reg[$i]['antecedenteginecologico']; ?></td>
          <td><?php echo $reg[$i]['historialgestacional'] == '' ? "************" : $reg[$i]['historialgestacional']; ?></td>
          <td><?php echo $reg[$i]['planificacionfamiliar'] == '' ? "************" : $reg[$i]['planificacionfamiliar']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaapertura'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'APERTURASXFECHAS':

$tra = new Login();
$reg = $tra->BuscarAperturasxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE APERTURAS DE HISTORIAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>ENFERMEDAD ACTUAL</th>
           <th>ANTECEDENTES PERSONALES</th>
           <th>ANTECEDENTES FAMILIARES</th>
           <th>ANTECEDENTES ALÉRGICOS</th>
           <th>ANTECEDENTES PATOLÓGICOS</th>
           <th>ANTECEDENTES QUIRÚRGICOS</th>
           <th>ANTECEDENTES FARMACOLÓGICOS</th>
           <th>ANTECEDENTES GINECOLÓGICOS</th>
           <th>HISTORIAL GESTACIONAL</th>
           <th>PLANIFICACIÓN FAMILIAR</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['enfermedadpaciente'] == '' ? "************" : $reg[$i]['enfermedadpaciente']; ?></td>
          <td><?php echo $reg[$i]['antecedentepaciente'] == '' ? "************" : $reg[$i]['antecedentepaciente']; ?></td>
          <td><?php echo $reg[$i]['antecedentefamiliares'] == '' ? "************" : $reg[$i]['antecedentefamiliares']; ?></td>
          <td><?php echo $reg[$i]['antecedentealergico'] == '' ? "************" : $reg[$i]['antecedentealergico']; ?></td>
          <td><?php echo $reg[$i]['antecedentepatologico'] == '' ? "************" : $reg[$i]['antecedentepatologico']; ?></td>
          <td><?php echo $reg[$i]['antecedentequirurgico'] == '' ? "************" : $reg[$i]['antecedentequirurgico']; ?></td>
          <td><?php echo $reg[$i]['antecedentefarmacologico'] == '' ? "************" : $reg[$i]['antecedentefarmacologico']; ?></td>
          <td><?php echo $reg[$i]['antecedenteginecologico'] == '' ? "************" : $reg[$i]['antecedenteginecologico']; ?></td>
          <td><?php echo $reg[$i]['historialgestacional'] == '' ? "************" : $reg[$i]['historialgestacional']; ?></td>
          <td><?php echo $reg[$i]['planificacionfamiliar'] == '' ? "************" : $reg[$i]['planificacionfamiliar']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaapertura'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'APERTURASXMEDICO':

$tra = new Login();
$reg = $tra->BuscarAperturasxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE APERTURAS DE HISTORIAS DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>ENFERMEDAD ACTUAL</th>
           <th>ANTECEDENTES PERSONALES</th>
           <th>ANTECEDENTES FAMILIARES</th>
           <th>ANTECEDENTES ALÉRGICOS</th>
           <th>ANTECEDENTES PATOLÓGICOS</th>
           <th>ANTECEDENTES QUIRÚRGICOS</th>
           <th>ANTECEDENTES FARMACOLÓGICOS</th>
           <th>ANTECEDENTES GINECOLÓGICOS</th>
           <th>HISTORIAL GESTACIONAL</th>
           <th>PLANIFICACIÓN FAMILIAR</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['enfermedadpaciente'] == '' ? "************" : $reg[$i]['enfermedadpaciente']; ?></td>
          <td><?php echo $reg[$i]['antecedentepaciente'] == '' ? "************" : $reg[$i]['antecedentepaciente']; ?></td>
          <td><?php echo $reg[$i]['antecedentefamiliares'] == '' ? "************" : $reg[$i]['antecedentefamiliares']; ?></td>
          <td><?php echo $reg[$i]['antecedentealergico'] == '' ? "************" : $reg[$i]['antecedentealergico']; ?></td>
          <td><?php echo $reg[$i]['antecedentepatologico'] == '' ? "************" : $reg[$i]['antecedentepatologico']; ?></td>
          <td><?php echo $reg[$i]['antecedentequirurgico'] == '' ? "************" : $reg[$i]['antecedentequirurgico']; ?></td>
          <td><?php echo $reg[$i]['antecedentefarmacologico'] == '' ? "************" : $reg[$i]['antecedentefarmacologico']; ?></td>
          <td><?php echo $reg[$i]['antecedenteginecologico'] == '' ? "************" : $reg[$i]['antecedenteginecologico']; ?></td>
          <td><?php echo $reg[$i]['historialgestacional'] == '' ? "************" : $reg[$i]['historialgestacional']; ?></td>
          <td><?php echo $reg[$i]['planificacionfamiliar'] == '' ? "************" : $reg[$i]['planificacionfamiliar']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaapertura'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'APERTURASXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarAperturasxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE APERTURAS DE HISTORIAS DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>ENFERMEDAD ACTUAL</th>
           <th>ANTECEDENTES PERSONALES</th>
           <th>ANTECEDENTES FAMILIARES</th>
           <th>ANTECEDENTES ALÉRGICOS</th>
           <th>ANTECEDENTES PATOLÓGICOS</th>
           <th>ANTECEDENTES QUIRÚRGICOS</th>
           <th>ANTECEDENTES FARMACOLÓGICOS</th>
           <th>ANTECEDENTES GINECOLÓGICOS</th>
           <th>HISTORIAL GESTACIONAL</th>
           <th>PLANIFICACIÓN FAMILIAR</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $reg[$i]['enfermedadpaciente'] == '' ? "************" : $reg[$i]['enfermedadpaciente']; ?></td>
          <td><?php echo $reg[$i]['antecedentepaciente'] == '' ? "************" : $reg[$i]['antecedentepaciente']; ?></td>
          <td><?php echo $reg[$i]['antecedentefamiliares'] == '' ? "************" : $reg[$i]['antecedentefamiliares']; ?></td>
          <td><?php echo $reg[$i]['antecedentealergico'] == '' ? "************" : $reg[$i]['antecedentealergico']; ?></td>
          <td><?php echo $reg[$i]['antecedentepatologico'] == '' ? "************" : $reg[$i]['antecedentepatologico']; ?></td>
          <td><?php echo $reg[$i]['antecedentequirurgico'] == '' ? "************" : $reg[$i]['antecedentequirurgico']; ?></td>
          <td><?php echo $reg[$i]['antecedentefarmacologico'] == '' ? "************" : $reg[$i]['antecedentefarmacologico']; ?></td>
          <td><?php echo $reg[$i]['antecedenteginecologico'] == '' ? "************" : $reg[$i]['antecedenteginecologico']; ?></td>
          <td><?php echo $reg[$i]['historialgestacional'] == '' ? "************" : $reg[$i]['historialgestacional']; ?></td>
          <td><?php echo $reg[$i]['planificacionfamiliar'] == '' ? "************" : $reg[$i]['planificacionfamiliar']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaapertura'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE APERTURAS DE HISTORIA ####################################










##################################### MODULO DE HOJAS EVOLUTIVAS ###################################
case 'HOJAS':

$tra = new Login();
$reg = $tra->ListarHojasEvolutivas(); 

$archivo = str_replace(" ", "_","LISTADO DE HOJAS EVOLUTIVAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO</th>
           <th>MOTIVO CONSULTA</th>
           <th>EXAMEN FÍSICO</th>
           <th>ATENCIÓN / ACTIVIDAD</th>
           <th>IMPRESIÓN DIAGNÓSTICA</th>
           <th>IDENTIFICACIÓN DEL ORIGEN DE LA ENFERMEDAD</th>
           <th>CONDUCTA O PLAN DE TRATAMIENTO</th>
           <th>DIAGNÓSTICO DEFINITIVO</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$dxpresuntivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxpresuntivo'])));
$dxdefinitivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxdefinitivo'])));
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['motivoconsulta'] == '' ? "************" : $reg[$i]['motivoconsulta']; ?></td>
          <td><?php echo $reg[$i]['examenfisico'] == '' ? "************" : $reg[$i]['examenfisico']; ?></td>
          <td><?php echo $reg[$i]['atenproced'] == '' ? "************" : $reg[$i]['atenproced']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxpresuntivo); $cont++):
          list($idciepresuntivo,$presuntivo,$observacionpresuntivo) = explode("/",$dxpresuntivo[$cont]);
          echo $presuntivo = ($idciepresuntivo == '' ? "" : "".$presuntivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observacionpresuntivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo $reg[$i]['origenenfermedad']; ?></td>
          <td><?php echo $reg[$i]['tratamiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxdefinitivo); $cont++):
          list($idciedefinitivo,$definitivo,$observaciondefinitivo) = explode("/",$dxdefinitivo[$cont]);
          echo $definitivo = ($idciedefinitivo == '' ? "" : "".$definitivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observaciondefinitivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechahoja'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'HOJASXFECHAS':

$tra = new Login();
$reg = $tra->BuscarHojasEvolutivasxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE HOJAS EVOLUTIVAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO</th>
           <th>MOTIVO CONSULTA</th>
           <th>EXAMEN FÍSICO</th>
           <th>ATENCIÓN / ACTIVIDAD</th>
           <th>IMPRESIÓN DIAGNÓSTICA</th>
           <th>IDENTIFICACIÓN DEL ORIGEN DE LA ENFERMEDAD</th>
           <th>CONDUCTA O PLAN DE TRATAMIENTO</th>
           <th>DIAGNÓSTICO DEFINITIVO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$dxpresuntivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxpresuntivo'])));
$dxdefinitivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxdefinitivo'])));
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['motivoconsulta'] == '' ? "************" : $reg[$i]['motivoconsulta']; ?></td>
          <td><?php echo $reg[$i]['examenfisico'] == '' ? "************" : $reg[$i]['examenfisico']; ?></td>
          <td><?php echo $reg[$i]['atenproced'] == '' ? "************" : $reg[$i]['atenproced']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxpresuntivo); $cont++):
          list($idciepresuntivo,$presuntivo,$observacionpresuntivo) = explode("/",$dxpresuntivo[$cont]);
          echo $presuntivo = ($idciepresuntivo == '' ? "" : "".$presuntivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observacionpresuntivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo $reg[$i]['origenenfermedad']; ?></td>
          <td><?php echo $reg[$i]['tratamiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxdefinitivo); $cont++):
          list($idciedefinitivo,$definitivo,$observaciondefinitivo) = explode("/",$dxdefinitivo[$cont]);
          echo $definitivo = ($idciedefinitivo == '' ? "" : "".$definitivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observaciondefinitivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechahoja'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'HOJASXMEDICO':

$tra = new Login();
$reg = $tra->BuscarHojasEvolutivasxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE HOJAS EVOLUTIVAS DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO</th>
           <th>MOTIVO CONSULTA</th>
           <th>EXAMEN FÍSICO</th>
           <th>ATENCIÓN / ACTIVIDAD</th>
           <th>IMPRESIÓN DIAGNÓSTICA</th>
           <th>IDENTIFICACIÓN DEL ORIGEN DE LA ENFERMEDAD</th>
           <th>CONDUCTA O PLAN DE TRATAMIENTO</th>
           <th>DIAGNÓSTICO DEFINITIVO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$dxpresuntivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxpresuntivo'])));
$dxdefinitivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxdefinitivo'])));
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['motivoconsulta'] == '' ? "************" : $reg[$i]['motivoconsulta']; ?></td>
          <td><?php echo $reg[$i]['examenfisico'] == '' ? "************" : $reg[$i]['examenfisico']; ?></td>
          <td><?php echo $reg[$i]['atenproced'] == '' ? "************" : $reg[$i]['atenproced']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxpresuntivo); $cont++):
          list($idciepresuntivo,$presuntivo,$observacionpresuntivo) = explode("/",$dxpresuntivo[$cont]);
          echo $presuntivo = ($idciepresuntivo == '' ? "" : "".$presuntivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observacionpresuntivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo $reg[$i]['origenenfermedad']; ?></td>
          <td><?php echo $reg[$i]['tratamiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxdefinitivo); $cont++):
          list($idciedefinitivo,$definitivo,$observaciondefinitivo) = explode("/",$dxdefinitivo[$cont]);
          echo $definitivo = ($idciedefinitivo == '' ? "" : "".$definitivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observaciondefinitivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechahoja'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'HOJASXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarHojasEvolutivasxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE HOJAS EVOLUTIVAS DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>PROCEDIMIENTO</th>
           <th>MOTIVO CONSULTA</th>
           <th>EXAMEN FÍSICO</th>
           <th>ATENCIÓN / ACTIVIDAD</th>
           <th>IMPRESIÓN DIAGNÓSTICA</th>
           <th>IDENTIFICACIÓN DEL ORIGEN DE LA ENFERMEDAD</th>
           <th>CONDUCTA O PLAN DE TRATAMIENTO</th>
           <th>DIAGNÓSTICO DEFINITIVO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$dxpresuntivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxpresuntivo'])));
$dxdefinitivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxdefinitivo'])));
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['motivoconsulta'] == '' ? "************" : $reg[$i]['motivoconsulta']; ?></td>
          <td><?php echo $reg[$i]['examenfisico'] == '' ? "************" : $reg[$i]['examenfisico']; ?></td>
          <td><?php echo $reg[$i]['atenproced'] == '' ? "************" : $reg[$i]['atenproced']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxpresuntivo); $cont++):
          list($idciepresuntivo,$presuntivo,$observacionpresuntivo) = explode("/",$dxpresuntivo[$cont]);
          echo $presuntivo = ($idciepresuntivo == '' ? "" : "".$presuntivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observacionpresuntivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo $reg[$i]['origenenfermedad']; ?></td>
          <td><?php echo $reg[$i]['tratamiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxdefinitivo); $cont++):
          list($idciedefinitivo,$definitivo,$observaciondefinitivo) = explode("/",$dxdefinitivo[$cont]);
          echo $definitivo = ($idciedefinitivo == '' ? "" : "".$definitivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observaciondefinitivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechahoja'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE HOJAS EVOLUTIVAS ####################################











##################################### MODULO DE REMISIONES ###################################
case 'REMISIONES':

$tra = new Login();
$reg = $tra->ListarRemisiones(); 

$archivo = str_replace(" ", "_","LISTADO DE REMISIONES");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO</th>
           <th>REMISIÓN</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['remision']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fecharemision'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'REMISIONESXFECHAS':

$tra = new Login();
$reg = $tra->BuscarRemisionesxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE REMISIONES (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO</th>
           <th>REMISIÓN</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['remision']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fecharemision'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'REMISIONESXMEDICO':

$tra = new Login();
$reg = $tra->BuscarRemisionesxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE REMISIONES DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO</th>
           <th>REMISIÓN</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['remision']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fecharemision'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'REMISIONESXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarRemisionesxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE REMISIONES DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>PROCEDIMIENTO</th>
           <th>REMISIÓN</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['remision']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fecharemision'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE REMISIONES ####################################











##################################### MODULO DE FORMULAS MEDICAS ###################################
case 'FORMULASMEDICAS':

$tra = new Login();
$reg = $tra->ListarFormulasMedicas(); 

$archivo = str_replace(" ", "_","LISTADO DE FÓRMULAS MÉDICAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO</th>
           <th>FÓRMULA MÉDICA</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$explode = explode(",,",$reg[$i]['formulamedica']);
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($explode); $cont++):
          list($idcieformula,$formula,$observacionformula) = explode("/",$explode[$cont]);
          echo strtoupper($formula)."<br>";
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'FORMULASMEDICASXFECHAS':

$tra = new Login();
$reg = $tra->BuscarFormulasMedicasxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE FÓRMULAS MÉDICAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO</th>
           <th>FÓRMULA MÉDICA</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$explode = explode(",,",$reg[$i]['formulamedica']);
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($explode); $cont++):
          list($idcieformula,$formula,$observacionformula) = explode("/",$explode[$cont]);
          echo strtoupper($formula)."<br>";
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'FORMULASMEDICASXMEDICO':

$tra = new Login();
$reg = $tra->BuscarFormulasMedicasxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE FÓRMULAS MÉDICAS DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO</th>
           <th>FÓRMULA MÉDICA</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$explode = explode(",,",$reg[$i]['formulamedica']);
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($explode); $cont++):
          list($idcieformula,$formula,$observacionformula) = explode("/",$explode[$cont]);
          echo strtoupper($formula)."<br>";
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'FORMULASMEDICASXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarFormulasMedicasxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE FÓRMULAS MÉDICAS DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>PROCEDIMIENTO</th>
           <th>FÓRMULA MÉDICA</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$explode = explode(",,",$reg[$i]['formulamedica']);
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($explode); $cont++):
          list($idcieformula,$formula,$observacionformula) = explode("/",$explode[$cont]);
          echo strtoupper($formula)."<br>";
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE FORMULAS MEDICAS ####################################











##################################### MODULO DE ORDENES MEDICAS ###################################
case 'ORDENESMEDICAS':

$tra = new Login();
$reg = $tra->ListarOrdenesMedicas(); 

$archivo = str_replace(" ", "_","LISTADO DE ÓRDENES MÉDICAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO</th>
           <th>ÓRDEN MÉDICA</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$explode = explode(",,",$reg[$i]['ordenmedica']);
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($explode); $cont++):
          list($idcieorden,$ordenes,$observacionorden) = explode("/",$explode[$cont]);
          echo strtoupper($ordenes)."<br>";
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaorden'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'ORDENESMEDICASXFECHAS':

$tra = new Login();
$reg = $tra->BuscarOrdenesMedicasxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE ÓRDENES MÉDICAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO</th>
           <th>ÓRDEN MÉDICA</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$explode = explode(",,",$reg[$i]['ordenmedica']);
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($explode); $cont++):
          list($idcieorden,$ordenes,$observacionorden) = explode("/",$explode[$cont]);
          echo strtoupper($ordenes)."<br>";
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaorden'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'ORDENESMEDICASXMEDICO':

$tra = new Login();
$reg = $tra->BuscarOrdenesMedicasxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE ÓRDENES MÉDICAS DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO</th>
           <th>ÓRDEN MÉDICA</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$explode = explode(",,",$reg[$i]['ordenmedica']);
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($explode); $cont++):
          list($idcieorden,$ordenes,$observacionorden) = explode("/",$explode[$cont]);
          echo strtoupper($ordenes)."<br>";
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaorden'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'ORDENESMEDICASXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarOrdenesMedicasxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE ÓRDENES MÉDICAS DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>PROCEDIMIENTO</th>
           <th>ÓRDEN MÉDICA</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$explode = explode(",,",$reg[$i]['ordenmedica']);
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($explode); $cont++):
          list($idcieorden,$ordenes,$observacionorden) = explode("/",$explode[$cont]);
          echo strtoupper($ordenes)."<br>";
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaorden'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE ORDENES MEDICAS ####################################











##################################### MODULO DE FORMULAS TERAPIAS ###################################
case 'FORMULASTERAPIAS':

$tra = new Login();
$reg = $tra->ListarFormulasTerapias(); 

$archivo = str_replace(" ", "_","LISTADO DE FÓRMULAS TERAPIAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>RESPIRATORIAS (SERIES DX)</th>
           <th>FISICAS (SERIES DX)</th>
           <th>MICRONEBULIZACIONES (CANTIDAD)</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo $reg[$i]['terapiasrespiratorias']; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo $reg[$i]['terapiasfisicas']; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo $reg[$i]['micronebulizaciones']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'FORMULASTERAPIASXFECHAS':

$tra = new Login();
$reg = $tra->BuscarOrdenesMedicasxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE FÓRMULAS TERAPIAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>RESPIRATORIAS (SERIES DX)</th>
           <th>FISICAS (SERIES DX)</th>
           <th>MICRONEBULIZACIONES (CANTIDAD)</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo $reg[$i]['terapiasrespiratorias']; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo $reg[$i]['terapiasfisicas']; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo $reg[$i]['micronebulizaciones']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'FORMULASTERAPIASXMEDICO':

$tra = new Login();
$reg = $tra->BuscarOrdenesMedicasxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE FÓRMULAS TERAPIAS DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>RESPIRATORIAS (SERIES DX)</th>
           <th>FISICAS (SERIES DX)</th>
           <th>MICRONEBULIZACIONES (CANTIDAD)</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo $reg[$i]['terapiasrespiratorias']; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo $reg[$i]['terapiasfisicas']; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo $reg[$i]['micronebulizaciones']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'FORMULASTERAPIASXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarOrdenesMedicasxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE FÓRMULAS TERAPIAS DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>RESPIRATORIAS (SERIES DX)</th>
           <th>FISICAS (SERIES DX)</th>
           <th>MICRONEBULIZACIONES (CANTIDAD)</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo $reg[$i]['terapiasrespiratorias']; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo $reg[$i]['terapiasfisicas']; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo $reg[$i]['micronebulizaciones']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaformula'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE FORMULAS TERAPIAS ####################################











##################################### MODULO DE SOLICITUD EXAMENES ###################################
case 'SOLICITUDEXAMENES':

$tra = new Login();
$reg = $tra->ListarSolicitudExamenes(); 

$archivo = str_replace(" ", "_","LISTADO DE SOLICITUD EXÁMENES");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>DESCRIPCIÓN DE CIE</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo strtoupper($reg[$i]['codcie'].": ".$reg[$i]['nombrecie']); ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechasolicitud'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'SOLICITUDEXAMENESXFECHAS':

$tra = new Login();
$reg = $tra->BuscarSolicitudExamenesxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE SOLICITUD EXÁMENES (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>DESCRIPCIÓN DE CIE</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo strtoupper($reg[$i]['codcie'].": ".$reg[$i]['nombrecie']); ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechasolicitud'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'SOLICITUDEXAMENESXMEDICO':

$tra = new Login();
$reg = $tra->BuscarSolicitudExamenesxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE SOLICITUD EXÁMENES DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>DESCRIPCIÓN DE CIE</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo strtoupper($reg[$i]['codcie'].": ".$reg[$i]['nombrecie']); ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechasolicitud'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'SOLICITUDEXAMENESXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarSolicitudExamenesxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE SOLICITUD EXÁMENES DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>DESCRIPCIÓN DE CIE</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td style="color:#000000;font-weight:bold;"><?php echo strtoupper($reg[$i]['codcie'].": ".$reg[$i]['nombrecie']); ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechasolicitud'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE SOLICITUD EXAMENES ####################################










##################################### MODULO DE CRIOCAUTERIZACIONES ###################################
case 'CRIOCAUTERIZACIONES':

$tra = new Login();
$reg = $tra->ListarCriocauterizaciones(); 

$archivo = str_replace(" ", "_","LISTADO DE CRIOCAUTERIZACIONES");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>MOTIVO CONSULTA</th>
           <th>ATENCIÓN / ACTIVIDAD</th>
           <th>IMPRESIÓN DIAGNÓSTICA</th>
           <th>IDENTIFICACIÓN DEL ORIGEN DE LA ENFERMEDAD</th>
           <th>CONDUCTA O PLAN DE TRATAMIENTO</th>
           <th>DIAGNÓSTICO DEFINITIVO</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$dxpresuntivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxpresuntivo'])));
$dxdefinitivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxdefinitivo'])));
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['motivoconsulta']; ?></td>
          <td><?php echo $reg[$i]['atenproced']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxpresuntivo); $cont++):
          list($idciepresuntivo,$presuntivo,$observacionpresuntivo) = explode("/",$dxpresuntivo[$cont]);
          echo $presuntivo = ($idciepresuntivo == '' ? "" : "".$presuntivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observacionpresuntivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo $reg[$i]['origenenfermedad']; ?></td>
          <td><?php echo $reg[$i]['tratamiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxdefinitivo); $cont++):
          list($idciedefinitivo,$definitivo,$observaciondefinitivo) = explode("/",$dxdefinitivo[$cont]);
          echo $definitivo = ($idciedefinitivo == '' ? "" : "".$definitivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observaciondefinitivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacriocauterizacion'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'CRIOCAUTERIZACIONESXFECHAS':

$tra = new Login();
$reg = $tra->BuscarCriocauterizacionesxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE CRIOCAUTERIZACIONES (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>MOTIVO CONSULTA</th>
           <th>ATENCIÓN / ACTIVIDAD</th>
           <th>IMPRESIÓN DIAGNÓSTICA</th>
           <th>IDENTIFICACIÓN DEL ORIGEN DE LA ENFERMEDAD</th>
           <th>CONDUCTA O PLAN DE TRATAMIENTO</th>
           <th>DIAGNÓSTICO DEFINITIVO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$dxpresuntivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxpresuntivo'])));
$dxdefinitivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxdefinitivo'])));
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['motivoconsulta']; ?></td>
          <td><?php echo $reg[$i]['atenproced']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxpresuntivo); $cont++):
          list($idciepresuntivo,$presuntivo,$observacionpresuntivo) = explode("/",$dxpresuntivo[$cont]);
          echo $presuntivo = ($idciepresuntivo == '' ? "" : "".$presuntivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observacionpresuntivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo $reg[$i]['origenenfermedad']; ?></td>
          <td><?php echo $reg[$i]['tratamiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxdefinitivo); $cont++):
          list($idciedefinitivo,$definitivo,$observaciondefinitivo) = explode("/",$dxdefinitivo[$cont]);
          echo $definitivo = ($idciedefinitivo == '' ? "" : "".$definitivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observaciondefinitivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacriocauterizacion'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'CRIOCAUTERIZACIONESXMEDICO':

$tra = new Login();
$reg = $tra->BuscarCriocauterizacionesxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE CRIOCAUTERIZACIONES DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>MOTIVO CONSULTA</th>
           <th>ATENCIÓN / ACTIVIDAD</th>
           <th>IMPRESIÓN DIAGNÓSTICA</th>
           <th>IDENTIFICACIÓN DEL ORIGEN DE LA ENFERMEDAD</th>
           <th>CONDUCTA O PLAN DE TRATAMIENTO</th>
           <th>DIAGNÓSTICO DEFINITIVO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$dxpresuntivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxpresuntivo'])));
$dxdefinitivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxdefinitivo'])));
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['motivoconsulta']; ?></td>
          <td><?php echo $reg[$i]['atenproced']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxpresuntivo); $cont++):
          list($idciepresuntivo,$presuntivo,$observacionpresuntivo) = explode("/",$dxpresuntivo[$cont]);
          echo $presuntivo = ($idciepresuntivo == '' ? "" : "".$presuntivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observacionpresuntivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo $reg[$i]['origenenfermedad']; ?></td>
          <td><?php echo $reg[$i]['tratamiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxdefinitivo); $cont++):
          list($idciedefinitivo,$definitivo,$observaciondefinitivo) = explode("/",$dxdefinitivo[$cont]);
          echo $definitivo = ($idciedefinitivo == '' ? "" : "".$definitivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observaciondefinitivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacriocauterizacion'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'CRIOCAUTERIZACIONESXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarCriocauterizacionesxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE CRIOCAUTERIZACIONES DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>MOTIVO CONSULTA</th>
           <th>ATENCIÓN / ACTIVIDAD</th>
           <th>IMPRESIÓN DIAGNÓSTICA</th>
           <th>IDENTIFICACIÓN DEL ORIGEN DE LA ENFERMEDAD</th>
           <th>CONDUCTA O PLAN DE TRATAMIENTO</th>
           <th>DIAGNÓSTICO DEFINITIVO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
$dxpresuntivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxpresuntivo'])));
$dxdefinitivo = explode(",,",utf8_decode(strtoupper($reg[$i]['dxdefinitivo'])));
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $reg[$i]['motivoconsulta']; ?></td>
          <td><?php echo $reg[$i]['atenproced']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxpresuntivo); $cont++):
          list($idciepresuntivo,$presuntivo,$observacionpresuntivo) = explode("/",$dxpresuntivo[$cont]);
          echo $presuntivo = ($idciepresuntivo == '' ? "" : "".$presuntivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observacionpresuntivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo $reg[$i]['origenenfermedad']; ?></td>
          <td><?php echo $reg[$i]['tratamiento']; ?></td>
          <td><?php 
          for($cont=0; $cont<COUNT($dxdefinitivo); $cont++):
          list($idciedefinitivo,$definitivo,$observaciondefinitivo) = explode("/",$dxdefinitivo[$cont]);
          echo $definitivo = ($idciedefinitivo == '' ? "" : "".$definitivo.".<br><span style='color:#000000;font-weight:bold;'>OBSERVACIÓN:</span> ".trim($observaciondefinitivo."<br>"));
          endfor;
          ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacriocauterizacion'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE CRIOCAUTERIZACIONES ####################################










##################################### MODULO DE COLPOSCOPIAS ###################################
case 'COLPOSCOPIAS':

$tra = new Login();
$reg = $tra->ListarColposcopias(); 

$archivo = str_replace(" ", "_","LISTADO DE COLPOSCOPIAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>IMPRESIÓN DIAGNÓSTICA</th>
           <th>OBSERVACIONES DE IMPRESIÓN</th>
           <th>SITIO DE BIOPSIA</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['impresiondiagnostica'] == '' ? "************" : $reg[$i]['impresiondiagnostica']; ?></td>
          <td><?php echo $reg[$i]['observacionesimpresion'] == '' ? "************" : $reg[$i]['observacionesimpresion']; ?></td>
          <td><?php echo $reg[$i]['biopsia'] == '' ? "************" : $reg[$i]['biopsia']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacolposcopia'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'COLPOSCOPIASXFECHAS':

$tra = new Login();
$reg = $tra->BuscarColposcopiasxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE COLPOSCOPIAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>IMPRESIÓN DIAGNÓSTICA</th>
           <th>OBSERVACIONES DE IMPRESIÓN</th>
           <th>SITIO DE BIOPSIA</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['impresiondiagnostica'] == '' ? "************" : $reg[$i]['impresiondiagnostica']; ?></td>
          <td><?php echo $reg[$i]['observacionesimpresion'] == '' ? "************" : $reg[$i]['observacionesimpresion']; ?></td>
          <td><?php echo $reg[$i]['biopsia'] == '' ? "************" : $reg[$i]['biopsia']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacolposcopia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'COLPOSCOPIASXMEDICO':

$tra = new Login();
$reg = $tra->BuscarColposcopiasxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE COLPOSCOPIAS DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>IMPRESIÓN DIAGNÓSTICA</th>
           <th>OBSERVACIONES DE IMPRESIÓN</th>
           <th>SITIO DE BIOPSIA</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['impresiondiagnostica'] == '' ? "************" : $reg[$i]['impresiondiagnostica']; ?></td>
          <td><?php echo $reg[$i]['observacionesimpresion'] == '' ? "************" : $reg[$i]['observacionesimpresion']; ?></td>
          <td><?php echo $reg[$i]['biopsia'] == '' ? "************" : $reg[$i]['biopsia']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacolposcopia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'COLPOSCOPIASXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarColposcopiasxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE COLPOSCOPIAS DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>IMPRESIÓN DIAGNÓSTICA</th>
           <th>OBSERVACIONES DE IMPRESIÓN</th>
           <th>SITIO DE BIOPSIA</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $reg[$i]['impresiondiagnostica'] == '' ? "************" : $reg[$i]['impresiondiagnostica']; ?></td>
          <td><?php echo $reg[$i]['observacionesimpresion'] == '' ? "************" : $reg[$i]['observacionesimpresion']; ?></td>
          <td><?php echo $reg[$i]['biopsia'] == '' ? "************" : $reg[$i]['biopsia']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacolposcopia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE COLPOSCOPIAS ####################################










##################################### MODULO DE ECOGRAFIAS ###################################
case 'ECOGRAFIAS':

$tra = new Login();
$reg = $tra->ListarEcografias(); 

$archivo = str_replace(" ", "_","LISTADO DE ECOGRAFIAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO ECOGRAFICO</th>
           <th>DIAGNÓSTICO</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['diagnostico']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaecografia'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'ECOGRAFIASXFECHAS':

$tra = new Login();
$reg = $tra->BuscarEcografiasxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE ECOGRAFIAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO ECOGRAFICO</th>
           <th>DIAGNÓSTICO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['diagnostico']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaecografia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'ECOGRAFIASXMEDICO':

$tra = new Login();
$reg = $tra->BuscarEcografiasxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE ECOGRAFIAS DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>PROCEDIMIENTO ECOGRAFICO</th>
           <th>DIAGNÓSTICO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['diagnostico']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaecografia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'ECOGRAFIASXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarEcografiasxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE ECOGRAFIAS DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>PROCEDIMIENTO ECOGRAFICO</th>
           <th>DIAGNÓSTICO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['diagnostico']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaecografia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE ECOGRAFIAS ####################################










##################################### MODULO DE EXAMENES DE LABORATORIOS ###################################
case 'LABORATORIOS':

$tra = new Login();
$reg = $tra->ListarLaboratorios(); 

$archivo = str_replace(" ", "_","LISTADO DE EXAMENES DE LABORATORIOS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>HEMATOLOGIA</th>
           <th>QUÍMICA SANGUINEA</th>
           <th>UROANÁLISIS</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['observacioneshematologia'] == '' ? "************" : $reg[$i]['observacioneshematologia']; ?></td>
          <td><?php echo $reg[$i]['observacionesquimica'] == '' ? "************" : $reg[$i]['observacionesquimica']; ?></td>
          <td><?php echo $reg[$i]['observacionesuroanalisis'] == '' ? "************" : $reg[$i]['observacionesuroanalisis']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechalaboratorio'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'LABORATORIOSXFECHAS':

$tra = new Login();
$reg = $tra->BuscarLaboratoriosxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE EXAMENES DE LABORATORIOS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>HEMATOLOGIA</th>
           <th>QUÍMICA SANGUINEA</th>
           <th>UROANÁLISIS</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['observacioneshematologia'] == '' ? "************" : $reg[$i]['observacioneshematologia']; ?></td>
          <td><?php echo $reg[$i]['observacionesquimica'] == '' ? "************" : $reg[$i]['observacionesquimica']; ?></td>
          <td><?php echo $reg[$i]['observacionesuroanalisis'] == '' ? "************" : $reg[$i]['observacionesuroanalisis']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechalaboratorio'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'LABORATORIOSXMEDICO':

$tra = new Login();
$reg = $tra->BuscarLaboratoriosxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE EXAMENES DE LABORATORIOS DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>HEMATOLOGIA</th>
           <th>QUÍMICA SANGUINEA</th>
           <th>UROANÁLISIS</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['observacioneshematologia'] == '' ? "************" : $reg[$i]['observacioneshematologia']; ?></td>
          <td><?php echo $reg[$i]['observacionesquimica'] == '' ? "************" : $reg[$i]['observacionesquimica']; ?></td>
          <td><?php echo $reg[$i]['observacionesuroanalisis'] == '' ? "************" : $reg[$i]['observacionesuroanalisis']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechalaboratorio'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'LABORATORIOSXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarLaboratoriosxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE EXAMENES DE LABORATORIOS DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>HEMATOLOGIA</th>
           <th>QUÍMICA SANGUINEA</th>
           <th>UROANÁLISIS</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $reg[$i]['observacioneshematologia'] == '' ? "************" : $reg[$i]['observacioneshematologia']; ?></td>
          <td><?php echo $reg[$i]['observacionesquimica'] == '' ? "************" : $reg[$i]['observacionesquimica']; ?></td>
          <td><?php echo $reg[$i]['observacionesuroanalisis'] == '' ? "************" : $reg[$i]['observacionesuroanalisis']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechalaboratorio'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE EXAMENES DE LABORATORIOS ####################################
















##################################### MODULO DE RADIOLOGIAS ###################################
case 'RADIOLOGIAS':

$tra = new Login();
$reg = $tra->ListarRadiologias(); 

$archivo = str_replace(" ", "_","LISTADO DE RADIOLOGIAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>LECTURA RX</th>
           <th>TIPO DE ESTUDIO</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $lectura = ( $reg[$i]['lectura'] == 1 ? "<p style='color:#101066;font-weight:bold;'>SI</p>" : "<p style='color:#b61a0d;font-weight:bold;'>NO</p>"); ?></td>
          <td><?php echo $reg[$i]['tipoestudio'] == '' ? "************" : $reg[$i]['tipoestudio']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fecharadiologia'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'RADIOLOGIASXFECHAS':

$tra = new Login();
$reg = $tra->BuscarRadiologiasxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE RADIOLOGIAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>LECTURA RX</th>
           <th>TIPO DE ESTUDIO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $lectura = ( $reg[$i]['lectura'] == 1 ? "<p style='color:#101066;font-weight:bold;'>SI</p>" : "<p style='color:#b61a0d;font-weight:bold;'>NO</p>"); ?></td>
          <td><?php echo $reg[$i]['tipoestudio'] == '' ? "************" : $reg[$i]['tipoestudio']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fecharadiologia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'RADIOLOGIASXMEDICO':

$tra = new Login();
$reg = $tra->BuscarRadiologiasxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE RADIOLOGIAS DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>LECTURA RX</th>
           <th>TIPO DE ESTUDIO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $lectura = ( $reg[$i]['lectura'] == 1 ? "<p style='color:#101066;font-weight:bold;'>SI</p>" : "<p style='color:#b61a0d;font-weight:bold;'>NO</p>"); ?></td>
          <td><?php echo $reg[$i]['tipoestudio'] == '' ? "************" : $reg[$i]['tipoestudio']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fecharadiologia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'RADIOLOGIASXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarRadiologiasxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE RADIOLOGIAS DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>LECTURA RX</th>
           <th>TIPO DE ESTUDIO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $lectura = ( $reg[$i]['lectura'] == 1 ? "<p style='color:#101066;font-weight:bold;'>SI</p>" : "<p style='color:#b61a0d;font-weight:bold;'>NO</p>"); ?></td>
          <td><?php echo $reg[$i]['tipoestudio'] == '' ? "************" : $reg[$i]['tipoestudio']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fecharadiologia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE RADIOLOGIAS ####################################
















##################################### MODULO DE TERAPIAS ###################################
case 'TERAPIAS':

$tra = new Login();
$reg = $tra->ListarTerapias(); 

$archivo = str_replace(" ", "_","LISTADO DE TERAPIAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>DIAGNÓSTICO</th>
           <th>CICLO</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['diagnostico']; ?></td>
          <td><?php echo $ciclo = ( $reg[$i]['ciclo'] == 1 ? "<p style='color:#101066;font-weight:bold;'>CULMINADO</p>" : "<p style='color:#b61a0d;font-weight:bold;'>EN PROCESO</p>"); ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaterapia'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'TERAPIASXFECHAS':

$tra = new Login();
$reg = $tra->BuscarTerapiasxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE TERAPIAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>DIAGNÓSTICO</th>
           <th>CICLO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['diagnostico']; ?></td>
          <td><?php echo $ciclo = ( $reg[$i]['ciclo'] == 1 ? "<p style='color:#101066;font-weight:bold;'>CULMINADO</p>" : "<p style='color:#b61a0d;font-weight:bold;'>EN PROCESO</p>"); ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaterapia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'TERAPIASXMEDICO':

$tra = new Login();
$reg = $tra->BuscarTerapiasxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE TERAPIAS DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>DIAGNÓSTICO</th>
           <th>CICLO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['diagnostico']; ?></td>
          <td><?php echo $ciclo = ( $reg[$i]['ciclo'] == 1 ? "<p style='color:#101066;font-weight:bold;'>CULMINADO</p>" : "<p style='color:#b61a0d;font-weight:bold;'>EN PROCESO</p>"); ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaterapia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'TERAPIASXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarTerapiasxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE TERAPIAS DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>DIAGNÓSTICO</th>
           <th>CICLO</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $reg[$i]['diagnostico']; ?></td>
          <td><?php echo $ciclo = ( $reg[$i]['ciclo'] == 1 ? "<p style='color:#101066;font-weight:bold;'>CULMINADO</p>" : "<p style='color:#b61a0d;font-weight:bold;'>EN PROCESO</p>"); ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaterapia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE TERAPIAS ####################################
















##################################### MODULO DE ODONTOLOGIAS ###################################
case 'ODONTOLOGIAS':

$tra = new Login();
$reg = $tra->ListarOdontologias(); 

$archivo = str_replace(" ", "_","LISTADO DE ODONTOLOGIAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>MOTIVO DE CONSULTA</th>
           <th>PROBLEMA ACTUAL</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['motivo_consulta'] == '' ? "************" : $reg[$i]['motivo_consulta']; ?></td>
          <td><?php echo $reg[$i]['problema_actual'] == '' ? "************" : $reg[$i]['problema_actual']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaodontologia'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'ODONTOLOGIASXFECHAS':

$tra = new Login();
$reg = $tra->BuscarOdontologiasxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE ODONTOLOGIAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>MOTIVO DE CONSULTA</th>
           <th>PROBLEMA ACTUAL</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['motivo_consulta'] == '' ? "************" : $reg[$i]['motivo_consulta']; ?></td>
          <td><?php echo $reg[$i]['problema_actual'] == '' ? "************" : $reg[$i]['problema_actual']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaodontologia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'ODONTOLOGIASXMEDICO':

$tra = new Login();
$reg = $tra->BuscarOdontologiasxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE ODONTOLOGIAS DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>MOTIVO DE CONSULTA</th>
           <th>PROBLEMA ACTUAL</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td><?php echo $reg[$i]['motivo_consulta'] == '' ? "************" : $reg[$i]['motivo_consulta']; ?></td>
          <td><?php echo $reg[$i]['problema_actual'] == '' ? "************" : $reg[$i]['problema_actual']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaodontologia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'ODONTOLOGIASXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarOdontologiasxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE ODONTOLOGIAS DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>MOTIVO DE CONSULTA</th>
           <th>PROBLEMA ACTUAL</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $reg[$i]['motivo_consulta'] == '' ? "************" : $reg[$i]['motivo_consulta']; ?></td>
          <td><?php echo $reg[$i]['problema_actual'] == '' ? "************" : $reg[$i]['problema_actual']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaodontologia'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE ODONTOLOGIAS ####################################
















##################################### MODULO DE CONSENTIMIENTO INFORMADO ###################################
case 'CONSENTIMIENTOS':

$tra = new Login();
$reg = $tra->ListarConsentimientos(); 

$archivo = str_replace(" ", "_","LISTADO DE CONSENTIMIENTOS INFORMADOS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>TIPO DE CONSENTIMIENTO</th>
           <th>PROCEDIMIENTO</th>
           <th>ANESTESIA</th>
           <th>ENFERMEDAD</th>
           <th>OBSERVACIONES</th>
           <th>FECHA | HORA</th>
           <th>SUCURSAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php 
          switch($reg[$i]['tipoconsentimiento']){
          case 1:
          echo "CONSENTIMIENTO INFORMADO PARA CONSULTORIO";
          break;
          case 2:
          echo "CONSENTIMIENTO INFORMADO PARA GINECOLOGIA";
          break;
          case 3:
          echo "CONSENTIMIENTO INFORMADO PARA LABORATORIO";
          break;
          case 4:
          echo "CONSENTIMIENTO INFORMADO PARA RADIOLOGIA";
          break;
          case 5:
          echo "CONSENTIMIENTO INFORMADO PARA TERAPEUTA";
          break;
          case 6:
          echo "CONSENTIMIENTO INFORMADO PARA ODONTOLOGIA";
          break;
          }//end switch
          ?></td>
          <td><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['anestesia']; ?></td>
          <td><?php echo $reg[$i]['enfermedad']; ?></td>
          <td><?php echo $reg[$i]['observaciones']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaconsentimiento'])); ?></td>
          <td style="color:#101066;font-weight:bold;"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'CONSENTIMIENTOSXFECHAS':

$tra = new Login();
$reg = $tra->BuscarConsentimientosxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE CONSENTIMIENTOS INFORMADOS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>TIPO DE CONSENTIMIENTO</th>
           <th>PROCEDIMIENTO</th>
           <th>ANESTESIA</th>
           <th>ENFERMEDAD</th>
           <th>OBSERVACIONES</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php 
          switch($reg[$i]['tipoconsentimiento']){
          case 1:
          echo "CONSENTIMIENTO INFORMADO PARA CONSULTORIO";
          break;
          case 2:
          echo "CONSENTIMIENTO INFORMADO PARA GINECOLOGIA";
          break;
          case 3:
          echo "CONSENTIMIENTO INFORMADO PARA LABORATORIO";
          break;
          case 4:
          echo "CONSENTIMIENTO INFORMADO PARA RADIOLOGIA";
          break;
          case 5:
          echo "CONSENTIMIENTO INFORMADO PARA TERAPEUTA";
          break;
          case 6:
          echo "CONSENTIMIENTO INFORMADO PARA ODONTOLOGIA";
          break;
          }//end switch
          ?></td>
          <td><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['anestesia']; ?></td>
          <td><?php echo $reg[$i]['enfermedad']; ?></td>
          <td><?php echo $reg[$i]['observaciones']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaconsentimiento'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'CONSENTIMIENTOSXMEDICO':

$tra = new Login();
$reg = $tra->BuscarConsentimientosxMedico(); 

$archivo = str_replace(" ", "_","LISTADO DE CONSENTIMIENTOS INFORMADOS DEL MÉDICO (Nº: ".$reg[0]["cedmedico"].": ".$reg[0]["nommedico"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"]))." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PACIENTE</th>
           <th>TIPO DE CONSENTIMIENTO</th>
           <th>PROCEDIMIENTO</th>
           <th>ANESTESIA</th>
           <th>ENFERMEDAD</th>
           <th>OBSERVACIONES</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php 
          switch($reg[$i]['tipoconsentimiento']){
          case 1:
          echo "CONSENTIMIENTO INFORMADO PARA CONSULTORIO";
          break;
          case 2:
          echo "CONSENTIMIENTO INFORMADO PARA GINECOLOGIA";
          break;
          case 3:
          echo "CONSENTIMIENTO INFORMADO PARA LABORATORIO";
          break;
          case 4:
          echo "CONSENTIMIENTO INFORMADO PARA RADIOLOGIA";
          break;
          case 5:
          echo "CONSENTIMIENTO INFORMADO PARA TERAPEUTA";
          break;
          case 6:
          echo "CONSENTIMIENTO INFORMADO PARA ODONTOLOGIA";
          break;
          }//end switch
          ?></td>
          <td><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['anestesia']; ?></td>
          <td><?php echo $reg[$i]['enfermedad']; ?></td>
          <td><?php echo $reg[$i]['observaciones']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaconsentimiento'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;

case 'CONSENTIMIENTOSXPACIENTE':

$tra = new Login();
$reg = $tra->BuscarConsentimientosxPaciente(); 

$archivo = str_replace(" ", "_","LISTADO DE CONSENTIMIENTOS INFORMADOS DEL PACIENTE (Nº: ".$reg[0]["cedpaciente"].": ".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']." Y SUCURSAL: ".$reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MÉDICO</th>
           <th>TIPO DE CONSENTIMIENTO</th>
           <th>PROCEDIMIENTO</th>
           <th>ANESTESIA</th>
           <th>ENFERMEDAD</th>
           <th>OBSERVACIONES</th>
           <th>FECHA | HORA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span style='color:#000000;font-weight:bold;'>".$reg[$i]['nommedico']."</span>"; ?></td>
          <td style="color:#da0f0f;font-weight:bold;"><?php 
          switch($reg[$i]['tipoconsentimiento']){
          case 1:
          echo "CONSENTIMIENTO INFORMADO PARA CONSULTORIO";
          break;
          case 2:
          echo "CONSENTIMIENTO INFORMADO PARA GINECOLOGIA";
          break;
          case 3:
          echo "CONSENTIMIENTO INFORMADO PARA LABORATORIO";
          break;
          case 4:
          echo "CONSENTIMIENTO INFORMADO PARA RADIOLOGIA";
          break;
          case 5:
          echo "CONSENTIMIENTO INFORMADO PARA TERAPEUTA";
          break;
          case 6:
          echo "CONSENTIMIENTO INFORMADO PARA ODONTOLOGIA";
          break;
          }//end switch
          ?></td>
          <td><?php echo $reg[$i]['procedimiento']; ?></td>
          <td><?php echo $reg[$i]['anestesia']; ?></td>
          <td><?php echo $reg[$i]['enfermedad']; ?></td>
          <td><?php echo $reg[$i]['observaciones']; ?></td>
          <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaconsentimiento'])); ?></td>
         </tr>
        <?php } } ?>
      </table>
<?php
break;
#################################### MODULO DE CONSENTIMIENTO INFORMADO ####################################

}
 
?>


<?php } else { ?> 
    <script type='text/javascript' language='javascript'>
      alert('NO TIENES PERMISO PARA ACCEDER A ESTA PAGINA.\nCONSULTA CON EL ADMINISTRADOR PARA QUE TE DE ACCESO')  
    document.location.href='panel'   
        </script> 
<?php } } else { ?>
    <script type='text/javascript' language='javascript'>
      alert('NO TIENES PERMISO PARA ACCEDER AL SISTEMA.\nDEBERA DE INICIAR SESION')  
    document.location.href='logout'  
        </script> 
<?php } ?>  