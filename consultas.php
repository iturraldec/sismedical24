<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
     if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION['acceso'] == "enfermera" || $_SESSION['acceso'] == "medico") {

$tra = new Login();
$ses = $tra->ExpiraSession();       
?>

<?php
############################# CARGAR USUARIOS ############################
if (isset($_GET['CargaUsuarios'])) { 
?>

<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                          <thead>
                          <tr role="row">
                          <th>N°</th>
                          <th>Foto</th>
                          <th>N° de Documento</th>
                          <th>Nombres y Apellidos</th>
                          <th>Nº de Teléfono</th>
                          <th>Nº de Celular</th>
                          <th>Usuario</th>
                          <th>Nivel</th>
                          <th>Status</th>
                          <th>Acciones</th>
                          </tr>
                          </thead>
                          <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarUsuarios();

if($reg==""){
    
    echo "";   

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
    <tr role="row" class="odd">
    <td><?php echo $a++; ?></td>
    <td><?php if (file_exists("fotos/".$reg[$i]["codigo"].".jpg")){
    echo "<img src='fotos/".$reg[$i]["codigo"].".jpg?' class='rounded-circle' style='margin:0px;' width='50' height='50'>";
       } else {
    echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>';  
    } ?></td>
    <td><?php echo $reg[$i]['documento']." ".$reg[$i]['dni']; ?></td>
    <td class="text-dark alert-link"><?php echo $reg[$i]['nombres']; ?></td>
    <td><?php echo $reg[$i]['telefono'] == "" ? "**********" : $reg[$i]['telefono']; ?></td>
    <td><?php echo $reg[$i]['celular'] == "" ? "**********" : $reg[$i]['celular']; ?></td>
    <td><?php echo $reg[$i]['usuario']; ?></td>
    <td><?php echo $reg[$i]['nivel']; ?></td>
    <td><?php echo $status = ( $reg[$i]['status'] == 1 ? '<span class="badge badge-info"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg> ACTIVO</span>' : '<span class="badge badge-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-x"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="18" y1="8" x2="23" y2="13"></line><line x1="23" y1="8" x2="18" y2="13"></line></svg> INACTIVO</span>'); ?></td>
    <td>
    <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerUsuario('<?php echo encrypt($reg[$i]["codigo"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

    <!-- <span class="text-info" style="cursor: pointer;" data-toggle="modal" data-target="#myModalUsuario" title="Editar" onClick="UpdateUsuario('<?php echo $reg[$i]["codigo"]; ?>','<?php echo $reg[$i]["documusuario"]; ?>','<?php echo $reg[$i]["dni"]; ?>','<?php echo $reg[$i]["nombres"]; ?>','<?php echo $reg[$i]["sexo"]; ?>','<?php echo $reg[$i]["telefono"]; ?>','<?php echo $reg[$i]["celular"]; ?>','<?php echo ($reg[$i]['idprovincia'] == '0' ? "" : $reg[$i]['idprovincia']); ?>','<?php echo $reg[$i]["direccion"]; ?>','<?php echo $reg[$i]["email"]; ?>','<?php echo $reg[$i]["mps"]; ?>','<?php echo ($reg[$i]['codespecialidad'] == '0' ? "" : encrypt($reg[$i]["codespecialidad"])); ?>','<?php echo $reg[$i]["fnacimiento"] == '0000-00-00' ? "" : date("d-m-Y",strtotime($reg[$i]["fnacimiento"])); ?>','<?php echo $reg[$i]["usuario"]; ?>','<?php echo $reg[$i]["nivel"]; ?>','<?php echo $reg[$i]["status"]; ?>','update'); SelectCanton('<?php echo ($reg[$i]['idprovincia'] == '0' ? "" : $reg[$i]['idprovincia']); ?>','<?php echo $reg[$i]["idcanton"]; ?>'); SelectParroquia('<?php echo ($reg[$i]['idcanton'] == '0' ? "" : $reg[$i]['idcanton']); ?>','<?php echo $reg[$i]["idparroquia"]; ?>');"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span> -->

    <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarUsuario('<?php echo encrypt($reg[$i]["codigo"]); ?>','<?php echo encrypt("USUARIOS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>
        </td>
        </tr>
        <?php } } ?>
        </tbody>
    </table></div>
<?php
} 
############################# CARGAR USUARIOS ############################
?>


<?php
############################# CARGAR LOGS DE ACCESO ############################
if (isset($_GET['CargaLogs'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Ip de Máquina</th>
                                            <th>Fecha</th>
                                            <th>Navegador</th>
                                            <th>Usuario</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$reg = $tra->ListarLogs();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                        <tr>
                                            <td><?php echo $a++; ?></td>
                                            <td><?php echo $reg[$i]['ip']; ?></td>
                                            <td><?php echo $reg[$i]['tiempo']; ?></td>
                                            <td><?php echo $reg[$i]['detalles']; ?></td>
                                            <td><?php echo $reg[$i]['usuario']; ?></td>
                                        </tr>
                                    <?php } } ?>
                                    </tbody>
                                </table></div>
 <?php
   } 
############################# CARGAR LOGS DE ACCESO ############################
?>



<?php
############################# CARGAR PROVINCIAS ############################
if (isset($_GET['CargaProvincias'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Provincias</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarProvincias();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> NO SE ENCONTRARON PROVINCIAS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
    <tr role="row" class="odd">
    <td><?php echo $a++; ?></td>
    <td><?php echo $reg[$i]['provincia']; ?></td>
    <td>
<span class="text-info" style="cursor: pointer;" data-toggle="modal" data-target="#myModalProvincia" title="Editar" onClick="UpdateProvincia('<?php echo $reg[$i]['idprovincia']; ?>','<?php echo $reg[$i]["provincia"]; ?>','update')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

<span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarProvincia('<?php echo encrypt($reg[$i]["idprovincia"]); ?>','<?php echo encrypt("PROVINCIAS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>
                                               </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
<?php
} 
############################# CARGAR PROVINCIAS ############################
?>




<?php
############################# CARGAR CANTONES ############################
if (isset($_GET['CargaCantones'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Cantón</th>
                                                    <th>Provincia</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarCantones();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> NO SE ENCONTRARON CANTONES ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['canton']; ?></td>
                                               <td><?php echo $reg[$i]['provincia']; ?></td>
                                               <td>
<span class="text-info" style="cursor: pointer;" data-toggle="modal" data-target="#myModalCanton" title="Editar" onClick="UpdateCanton('<?php echo $reg[$i]["idcanton"]; ?>','<?php echo $reg[$i]["canton"]; ?>','<?php echo $reg[$i]['idprovincia']; ?>','update')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

<span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarCanton('<?php echo encrypt($reg[$i]["idcanton"]); ?>','<?php echo encrypt("CANTONES"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>
                                               </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR CANTONES ############################
?>




<?php
############################# CARGAR PARROQUIAS ############################
if (isset($_GET['CargaParroquias'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Parroquia</th>
                                                    <th>Cantón</th>
                                                    <th>Provincia</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarParroquias();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> NO SE ENCONTRARON PARROQUIAS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['parroquia']; ?></td>
                                               <td><?php echo $reg[$i]['canton']; ?></td>
                                               <td><?php echo $reg[$i]['provincia']; ?></td>
                                               <td>
<span class="text-info" style="cursor: pointer;" data-toggle="modal" data-target="#myModalParroquia" title="Editar" onClick="UpdateParroquia('<?php echo $reg[$i]["idparroquia"]; ?>','<?php echo $reg[$i]["parroquia"]; ?>','<?php echo $reg[$i]['idcanton']; ?>','update'); SelectCanton('<?php echo $reg[$i]["idcanton"]; ?>','<?php echo $reg[$i]["idparroquia"]; ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

<span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarParroquia('<?php echo encrypt($reg[$i]["idparroquia"]); ?>','<?php echo encrypt("PARROQUIAS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>
                                               </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR PARROQUIAS ############################
?>




<?php
############################# CARGAR TIPO DOCUMENTOS ############################
if (isset($_GET['CargaDocumentos'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                          <thead>
                              <tr>
                                  <th>N°</th>
                                  <th>Nombre</th>
                                  <th>Descripción de Documento</th>
                                  <th>Acciones</th>
                              </tr>
                          </thead>
                          <tbody>
<?php 
$reg = $tra->ListarDocumentos();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                          <tr>
                              <td><?php echo $a++; ?></td>
                              <td><?php echo $reg[$i]['documento']; ?></td>
                              <td><?php echo $reg[$i]['descripcion']; ?></td>
                              <td>
                              <span class="text-info" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDocumento" title="Editar" onClick="UpdateDocumento('<?php echo $reg[$i]["coddocumento"]; ?>','<?php echo $reg[$i]["documento"]; ?>','<?php echo $reg[$i]["descripcion"]; ?>','update')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

                              <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarDocumento('<?php echo encrypt($reg[$i]["coddocumento"]); ?>','<?php echo encrypt("DOCUMENTOS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

                              </td>
                          </tr>
                      <?php } } ?>
                      </tbody>
                  </table></div>
 <?php
   } 
############################# CARGAR TIPO DOCUMENTOS ############################
?>



<?php
############################# CARGAR SEGUROS ############################
if (isset($_GET['CargaSeguros'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre de Seguro</th>
                            <th>Dirección</th>
                            <th>Telefono #1</th>
                            <th>Telefono #2</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarSeguros();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['nomseguro']; ?></td>
                    <td><?php echo $reg[$i]['direcseguro']; ?></td>
                    <td><?php echo $reg[$i]['tlfseguro1']; ?></td>
                    <td><?php echo $reg[$i]['tlfseguro2'] == "" ? "**********" : $reg[$i]['tlfseguro2']; ?></td>
                    <td>
                    <span class="text-info" style="cursor: pointer;" data-toggle="modal" data-target="#myModalSeguro" title="Editar" onClick="UpdateSeguro('<?php echo $reg[$i]["codseguro"]; ?>','<?php echo $reg[$i]["nomseguro"]; ?>','<?php echo $reg[$i]["direcseguro"]; ?>','<?php echo $reg[$i]["tlfseguro1"]; ?>','<?php echo $reg[$i]["tlfseguro2"]; ?>','update')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

                    <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarSeguro('<?php echo encrypt($reg[$i]["codseguro"]); ?>','<?php echo encrypt("SEGUROS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

                    </td>
                  </tr>
                <?php } } ?>
              </tbody>
            </table></div>
 <?php
   } 
############################# CARGAR SEGUROS ############################
?>


<?php
############################# CARGAR ESPECIALIDADES ############################
if (isset($_GET['CargaEspecialidades'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                          <thead>
                              <tr>
                                  <th>N°</th>
                                  <th>Nombre</th>
                                  <th>Acciones</th>
                              </tr>
                          </thead>
                          <tbody>
<?php 
$reg = $tra->ListarEspecialidades();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                          <tr>
                              <td><?php echo $a++; ?></td>
                              <td><?php echo $reg[$i]['nomespecialidad']; ?></td>
                              <td>
                              <span class="text-info" style="cursor: pointer;" data-toggle="modal" data-target="#myModalEspecialidad" title="Editar" onClick="UpdateEspecialidad('<?php echo $reg[$i]["codespecialidad"]; ?>','<?php echo $reg[$i]["nomespecialidad"]; ?>','update')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

                              <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarEspecialidad('<?php echo encrypt($reg[$i]["codespecialidad"]); ?>','<?php echo encrypt("ESPECIALIDADES"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

                              </td>
                          </tr>
                      <?php } } ?>
                      </tbody>
                  </table></div>
 <?php
   } 
############################# CARGAR ESPECIALIDADES ############################
?>



<?php
############################# CARGAR SUCURSALES ############################
if (isset($_GET['CargaSucursales'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Foto</th>
                            <th>N° de Documento</th>
                            <th>Razón Social</th>
                            <th>Nº de Teléfono</th>
                            <th>Email</th>
                            <th>Encargado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarSucursales();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php if (file_exists("fotos/sucursales/".$reg[$i]["cuitsucursal"].".png")){
    echo "<img src='fotos/sucursales/".$reg[$i]["cuitsucursal"].".png?' class='rounded-circle' style='margin:0px;' width='50' height='50'>";
       } else {
    echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>'; 
    } ?></td>
                    <td><?php echo "<span class='text-dark alert-link'>".$reg[$i]['documento']."</span>: ".$reg[$i]['cuitsucursal']; ?></td>
                    <td class="text-dark alert-link"><?php echo $reg[$i]['nomsucursal']; ?></td>
                    <td><?php echo $reg[$i]['tlfsucursal']; ?></td>
                    <td><?php echo $reg[$i]['correosucursal']; ?></td>
                    <td><?php echo $reg[$i]['nomencargado']; ?></td>
                    <td>
                    <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerSucursal('<?php echo encrypt($reg[$i]["codsucursal"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

                    <span class="text-info" style="cursor: pointer;" data-toggle="modal" data-target="#myModalSucursal" title="Editar" onClick="UpdateSucursal('<?php echo encrypt($reg[$i]["codsucursal"]); ?>','<?php echo $reg[$i]["documsucursal"]; ?>','<?php echo $reg[$i]["cuitsucursal"]; ?>','<?php echo $reg[$i]["nomsucursal"]; ?>','<?php echo ($reg[$i]['idprovincia'] == '0' ? "" : $reg[$i]['idprovincia']); ?>','<?php echo $reg[$i]["direcsucursal"]; ?>','<?php echo $reg[$i]["correosucursal"]; ?>','<?php echo $reg[$i]["tlfsucursal"]; ?>','<?php echo $reg[$i]["documencargado"]; ?>','<?php echo $reg[$i]["dniencargado"]; ?>','<?php echo $reg[$i]["nomencargado"]; ?>','<?php echo $reg[$i]["tlfencargado"]; ?>','update'); SelectCanton('<?php echo ($reg[$i]['idprovincia'] == '0' ? "" : $reg[$i]['idprovincia']); ?>','<?php echo $reg[$i]["idcanton"]; ?>'); SelectParroquia('<?php echo ($reg[$i]['idcanton'] == '0' ? "" : $reg[$i]['idcanton']); ?>','<?php echo $reg[$i]["idparroquia"]; ?>');"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

                    <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarSucursal('<?php echo encrypt($reg[$i]["codsucursal"]); ?>','<?php echo encrypt("SUCURSALES"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

                    </td>
                  </tr>
                <?php } } ?>
              </tbody>
            </table></div>
 <?php
   } 
############################# CARGAR SUCURSALES ############################
?>





<?php
############################# CARGAR PLANTILLAS ECOGRAFICAS ############################
if (isset($_GET['CargaPlantillasEcograficas'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre de Plantilla</th>
                            <th>Procedimiento de Plantilla</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarPlantillasEcograficas();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td class="text-dark alert-link"><?php echo $reg[$i]['nombreplantillaecografia']; ?></td>
                    <td><?php echo $reg[$i]['procedimientoecografia']; ?></td>
                    <td>
                    <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerPlantillaEcografica('<?php echo encrypt($reg[$i]["codplantillaecografia"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

                    <span class="text-info" style="cursor: pointer;" data-toggle="modal" data-target="#myModalPlantilla" title="Editar" onClick="UpdatePlantillaEcografica('<?php echo encrypt($reg[$i]["codplantillaecografia"]); ?>','<?php echo $reg[$i]["nombreplantillaecografia"]; ?>','<?php echo preg_replace("/\r\n|\r|\n/",'\n',$reg[$i]['procedimientoecografia']); ?>','<?php echo preg_replace("/\r\n|\r|\n/",'\n',$reg[$i]['descripcionecografia']); ?>','update');"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

                    <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarPlantillaEcografica('<?php echo encrypt($reg[$i]["codplantillaecografia"]); ?>','<?php echo encrypt("PLANTILLASECOGRAFICAS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

                    </td>
                  </tr>
                <?php } } ?>
              </tbody>
            </table></div>
 <?php
   } 
############################# CARGAR PLANTILLAS ECOGRAFICAS ############################
?>

<?php
############################# BUSQUEDA PLANTILLAS ECOGRAFICAS ############################
if (isset($_GET['BusquedaPlantillasEcograficas']) && isset($_GET['becografias'])) { 

$criterio = limpiar($_GET['becografias']);
?>
<div class="table-responsive mb-0 mt-0">
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre de Plantilla</th>
                            <th>Procedimiento de Plantilla</th>
                            <th>Agregar</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
if($criterio==""){
    
  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE VALOR PARA TU CRITERIO DE BÚSQUEDA </center>";
  echo "</div>";
  exit;    

} else {

$reg = $tra->BusquedaPlantillasEcograficas();

$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
            <tr>
            <td><?php echo $a++; ?></td>
            <td class="text-dark alert-link"><?php echo $reg[$i]['nombreplantillaecografia']; ?></td>
            <td><?php echo $reg[$i]['procedimientoecografia']; ?></td>
            <td>
            <span class="text-info" style="cursor: pointer;" data-dismiss="modal" title="Agregar" onClick="AsignarEcografia(
            '<?php echo preg_replace("/\r\n|\r|\n/",'\n',$reg[$i]['procedimientoecografia']); ?>',
            '<?php echo preg_replace("/\r\n|\r|\n/",'\n',$reg[$i]['descripcionecografia']); ?>'
            )"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg></span>
            </td>
          </tr>
        <?php } } ?>
      </tbody>
    </table></div></div>
<?php
} 
############################# BUSQUEDA PLANTILLAS ECOGRAFICAS ############################
?>



<?php
############################# CARGAR PLANTILLAS LECTURA RX ############################
if (isset($_GET['CargaPlantillasLecturasRx'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre de Plantilla</th>
                            <th>Procedimiento de Plantilla</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarPlantillasLecturaRx();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
            <tr>
            <td><?php echo $a++; ?></td>
            <td class="text-dark alert-link"><?php echo $reg[$i]['nombreplantillalecturarx']; ?></td>
            <td><?php echo $reg[$i]['procedimientolecturarx']; ?></td>
            <td>
            <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerPlantillaLecturaRx('<?php echo encrypt($reg[$i]["codplantillalecturarx"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

            <span class="text-info" style="cursor: pointer;" data-toggle="modal" data-target="#myModalPlantilla" title="Editar" onClick="UpdatePlantillaLecturaRx('<?php echo encrypt($reg[$i]["codplantillalecturarx"]); ?>','<?php echo $reg[$i]["nombreplantillalecturarx"]; ?>','<?php echo preg_replace("/\r\n|\r|\n/",'\n',$reg[$i]['procedimientolecturarx']); ?>','<?php echo preg_replace("/\r\n|\r|\n/",'\n',$reg[$i]['descripcionlecturarx']); ?>','update');"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

            <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarPlantillaLecturaRx('<?php echo encrypt($reg[$i]["codplantillalecturarx"]); ?>','<?php echo encrypt("PLANTILLASLECTURASRX"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

            </td>
          </tr>
        <?php } } ?>
      </tbody>
    </table></div>
 <?php
   } 
############################# CARGAR PLANTILLAS LECTURA RX ############################
?>

<?php
############################# BUSQUEDA PLANTILLAS LECTURA RX ############################
if (isset($_GET['BusquedaPlantillasLecturaRx']) && isset($_GET['blecturarx'])) { 

$criterio = limpiar($_GET['blecturarx']);
?>
<div class="table-responsive mb-0 mt-0">
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre de Plantilla</th>
                            <th>Procedimiento de Plantilla</th>
                            <th>Agregar</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
if($criterio==""){
    
  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE VALOR PARA TU CRITERIO DE BÚSQUEDA </center>";
  echo "</div>";
  exit;    

} else {

$reg = $tra->BusquedaPlantillasLecturaRx();

$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
            <tr>
            <td><?php echo $a++; ?></td>
            <td class="text-dark alert-link"><?php echo $reg[$i]['nombreplantillalecturarx']; ?></td>
            <td><?php echo $reg[$i]['procedimientolecturarx']; ?></td>
            <td>
            <span class="text-info" style="cursor: pointer;" data-dismiss="modal" title="Agregar" onClick="AsignarLecturaRx(
            '<?php echo preg_replace("/\r\n|\r|\n/",'\n',$reg[$i]['procedimientolecturarx']); ?>',
            '<?php echo preg_replace("/\r\n|\r|\n/",'\n',$reg[$i]['descripcionlecturarx']); ?>'
            )"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg></span>
            </td>
          </tr>
        <?php } } ?>
      </tbody>
    </table></div></div>
<?php
} 
############################# BUSQUEDA PLANTILLAS LECTURA RX ############################
?>



<?php
############################# CARGAR MEDICOS ############################
if (isset($_GET['CargaMedicos'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Foto</th>
                          <th>N° de Documento</th>
                          <th>Nombres y Apellidos</th>
                          <th>Nº de Teléfono</th>
                          <th>Nº de Celular</th>
                          <th>Email</th>
                          <th>Especialidad</th>
                          <th>Sucursal</th>
<?php echo $var = ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" ? "<th>Acciones</th>" : "<th><span class='mdi mdi-drag-horizontal'></span></th>"); ?>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarMedicos();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
    <tr>
    <td><?php echo $a++; ?></td>
    <td><?php if (file_exists("fotos/".$reg[$i]["codmedico"].".jpg")){
    echo "<img src='fotos/".$reg[$i]["codmedico"].".jpg?' class='rounded-circle' style='margin:0px;' width='50' height='50'>";
       }else{
    echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>';  
    } ?></td>
    <td><?php echo $reg[$i]['documento']." ".$reg[$i]['cedmedico']; ?></td>
    <td class="text-dark alert-link"><?php echo $reg[$i]['nommedico']; ?></td>
    <td><?php echo $reg[$i]['tlfmedico'] == "" ? "**********" : $reg[$i]['tlfmedico']; ?></td>
    <td><?php echo $reg[$i]['celmedico'] == "" ? "**********" : $reg[$i]['celmedico']; ?></td>
    <td><?php echo $reg[$i]['correomedico']; ?></td>
    <td><?php echo $reg[$i]['nomespecialidad']; ?></td>
    <td class="text-dark alert-link"><?php echo $reg[$i]['nomsucursal']; ?></td>
    <td>
    <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerMedico('<?php echo encrypt($reg[$i]["codmedico"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

    <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateMedico('<?php echo encrypt($reg[$i]["codmedico"]); ?>','<?php echo encrypt($reg[$i]["codsucursal"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

    <span class="text-warning" style="cursor: pointer;" title="Reinicar Clave" onClick="ReiniciarClaveMedico('<?php echo encrypt($reg[$i]["codmedico"]); ?>','<?php echo encrypt($reg[$i]["cedmedico"]); ?>','<?php echo encrypt("REINICIARMEDICOS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg></span>

    <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarMedico('<?php echo encrypt($reg[$i]["codmedico"]); ?>','<?php echo encrypt("MEDICOS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

            </td>
          </tr>
        <?php } } ?>
      </tbody>
    </table></div>
 <?php
   } 
############################# CARGAR MEDICOS ############################
?>



<?php
############################# CARGAR HORARIOS DE MEDICOS ############################
if (isset($_GET['CargaHorarios'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
        <thead>
            <tr>
              <th>N°</th>
              <th>N° de Documento</th>
              <th>Nombres y Apellidos</th>
              <th>Especialidad</th>
              <th>Dias Laborables</th>
              <th>Hora Desde</th>
              <th>Hora Hasta</th>
              <th>Sucursal</th>
              <?php if ($_SESSION['acceso'] != "medico") { ?><th>Acciones</th><?php } ?>
            </tr>
        </thead>
        <tbody>
<?php 
$reg = $tra->ListarHorarios();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
            <tr>
            <td><?php echo $a++; ?></td>
            <td><?php echo $reg[$i]['documento']." ".$reg[$i]['cedmedico']; ?></td>
            <td class="text-dark alert-link"><?php echo $reg[$i]['nommedico']; ?></td>
            <td><?php echo $reg[$i]['nomespecialidad']; ?></td>
            <td class="text-dark alert-link"><?php echo Dias($reg[$i]['dias_laborales']); ?></td>
            <td><?php echo $reg[$i]['hora_desde']; ?></td>
            <td><?php echo $reg[$i]['hora_hasta']; ?></td>
            <td class="text-dark alert-link"><?php echo $reg[$i]['nomsucursal']; ?></td>
            <?php if ($_SESSION['acceso'] != "medico") { ?><td>
            <!--<span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerHorario('<?php echo encrypt($reg[$i]["codhorario"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>-->

            <span class="text-info" style="cursor: pointer;" data-toggle="modal" data-target="#myModalHorario" title="Editar" onClick="UpdateHorario('<?php echo encrypt($reg[$i]["codhorario"]); ?>','<?php echo encrypt($reg[$i]["codsucursal"]); ?>','<?php echo $reg[$i]["hora_desde"]; ?>','<?php echo $reg[$i]["hora_hasta"]; ?>','update'); 
            SelectEspecialidad('<?php echo encrypt($reg[$i]['codsucursal']); ?>','<?php echo encrypt($reg[$i]["codespecialidad"]); ?>');
            SelectMedico('<?php echo encrypt($reg[$i]['codsucursal']); ?>','<?php echo encrypt($reg[$i]["codespecialidad"]); ?>','<?php echo encrypt($reg[$i]["codmedico"]); ?>');
            CargarDiasAsignados('<?php echo encrypt($reg[$i]["codhorario"]); ?>','<?php echo $reg[$i]["dias_laborales"]; ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

            <span 
              class="text-danger" 
              style="cursor: pointer;" 
              title="Eliminar"
              onClick="EliminarHorario('<?php echo encrypt('HORARIOS'); ?>', '<?php echo $reg[$i]["codmedico"];?>', '<?php echo $reg[$i]["hora_desde"];?>', '<?php echo $reg[$i]["hora_hasta"];?>')"
            >
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
            </span>
            </td><?php } ?>
          </tr>
        <?php } } ?>
      </tbody>
    </table></div>
<?php
} 
############################# CARGAR HORARIOS DE MEDICOS ############################
?>



<?php
############################# CARGAR PACIENTES ############################
if (isset($_GET['CargaPacientes']) && isset($_GET['bpacientes'])) { 

$criterio = limpiar($_GET['bpacientes']);
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
        <thead>
            <tr>
              <th>N°</th>
               <th>Nº de Historia</th>
               <th>Nº de Documento</th>
               <th>Nombres</th>
               <th>Apellidos</th>
               <th>Grupo Sang.</th>
               <th>Nº de Teléfono</th>
               <th>Acompañante</th>
               <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
<?php 
if($criterio==""){
    
  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE VALOR PARA TU CRITERIO DE BÚSQUEDA </center>";
  echo "</div>";
  exit;    

} else {

$reg = $tra->BusquedaPacientes();
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
        <tr>
        <td><?php echo $a++; ?></td>
        <td class="text-dark alert-link"><?php echo $reg[$i]['numerohistoria']; ?></td>
        <td><?php echo "Nº ".$documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento']).": ".$reg[$i]['cedpaciente']; ?></td>
        <td class="text-dark alert-link"><?php echo $reg[$i]['pnompaciente']." ".$reg[$i]['snompaciente']; ?></td>
        <td class="text-dark alert-link"><?php echo $reg[$i]['papepaciente']." ".$reg[$i]['sapepaciente']; ?></td>
        <td><?php echo $reg[$i]['gruposapaciente']; ?></td>
        <td><?php echo $reg[$i]['tlfpaciente'] == '' ? "***********" : $reg[$i]['tlfpaciente']; ?></td>
        <td><?php echo $reg[$i]['nomacompana'] == '' ? "***********" : $reg[$i]['nomacompana']; ?></td>
        <td>
        <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerPaciente('<?php echo encrypt($reg[$i]["codpaciente"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

        <span class="text-info" style="cursor: pointer;" data-toggle="modal" data-target="#myModalPaciente" title="Editar" 
        onClick="UpdatePaciente(
        '<?php echo $reg[$i]["codpaciente"]; ?>',
        '<?php echo $reg[$i]["documpaciente"]; ?>',
        '<?php echo $reg[$i]["cedpaciente"]; ?>',
        '<?php echo $reg[$i]["pnompaciente"]; ?>',
        '<?php echo $reg[$i]["snompaciente"]; ?>',
        '<?php echo $reg[$i]["papepaciente"]; ?>',
        '<?php echo $reg[$i]["sapepaciente"]; ?>',
        '<?php echo $reg[$i]["direcpaciente"]; ?>',
        '<?php echo $reg[$i]["barriopaciente"]; ?>',
        '<?php echo ($reg[$i]['idprovincia'] == '0' ? "" : $reg[$i]['idprovincia']); ?>',
        '<?php echo $reg[$i]["zonapaciente"]; ?>',
        '<?php echo $reg[$i]["tlfpaciente"]; ?>',
        '<?php echo $reg[$i]["fnacpaciente"] == '0000-00-00' ? "" : date("d-m-Y",strtotime($reg[$i]["fnacpaciente"])); ?>',
        '<?php echo $reg[$i]["lnacpaciente"]; ?>',
        '<?php echo $reg[$i]["nacpaciente"]; ?>',
        '<?php echo $reg[$i]["enfoquepaciente"]; ?>',
        '<?php echo $reg[$i]["sexopaciente"]; ?>',
        '<?php echo $reg[$i]["estadopaciente"]; ?>',
        '<?php echo $reg[$i]["instruccionpaciente"]; ?>',
        '<?php echo $reg[$i]["ocupacionpaciente"]; ?>',
        '<?php echo $reg[$i]["trabajapaciente"]; ?>',
        '<?php echo $seguro = ($reg[$i]["codseguro"] == '0' ? "" : $reg[$i]['codseguro']); ?>',
        '<?php echo $reg[$i]["referidopaciente"]; ?>',
        '<?php echo $reg[$i]["gruposapaciente"]; ?>',
        '<?php echo $reg[$i]["emailpaciente"]; ?>',
        '<?php echo $reg[$i]["nomacompana"]; ?>',
        '<?php echo $reg[$i]["direcacompana"]; ?>',
        '<?php echo $reg[$i]["tlfacompana"]; ?>',
        '<?php echo $reg[$i]["parentescoacompana"]; ?>',
        '<?php echo $reg[$i]["nomresponsable"]; ?>',
        '<?php echo $reg[$i]["direcresponsable"]; ?>',
        '<?php echo $reg[$i]["tlfresponsable"]; ?>',
        '<?php echo $reg[$i]["parentescoresponsable"]; ?>',
        'update'); 
        SelectCanton('<?php echo $reg[$i]['idprovincia']; ?>','<?php echo $reg[$i]["idcanton"]; ?>'); 
        SelectParroquia('<?php echo $reg[$i]['idcanton']; ?>','<?php echo $reg[$i]["idparroquia"]; ?>');"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

        <span class="text-dark" style="cursor: pointer;" data-toggle="modal" data-target="#myModalCargaDocumentos" title="Cargar Documentos" onClick="CargaDatosPaciente(
        '<?php echo encrypt($reg[$i]["codpaciente"]); ?>',
        '<?php echo $reg[$i]["numerohistoria"]; ?>',
        '<?php echo $reg[$i]["documento"]." ".$reg[$i]["cedpaciente"]; ?>',
        '<?php echo $reg[$i]["pnompaciente"]." ".$reg[$i]["snompaciente"]; ?>',
        '<?php echo $reg[$i]["papepaciente"]." ".$reg[$i]["sapepaciente"]; ?>',
        '<?php echo ($reg[$i]["direcpaciente"] == '' ? "******" : $reg[$i]['direcpaciente']); ?>',
        '<?php echo ($reg[$i]["barriopaciente"] == '' ? "******" : $reg[$i]['barriopaciente']); ?>',
        '<?php echo ($reg[$i]['idprovincia'] == '0' ? "******" : $reg[$i]['provincia']); ?>',
        '<?php echo ($reg[$i]['idcanton'] == '0' ? "******" : $reg[$i]['canton']); ?>',
        '<?php echo ($reg[$i]['idparroquia'] == '0' ? "******" : $reg[$i]['parroquia']); ?>',
        '<?php echo ($reg[$i]["zonapaciente"] == '' ? "******" : $reg[$i]['zonapaciente']); ?>',
        '<?php echo ($reg[$i]["tlfpaciente"] == '' ? "******" : $reg[$i]['tlfpaciente']); ?>',
        '<?php echo $reg[$i]["fnacpaciente"] == '0000-00-00' ? "******" : date("d-m-Y",strtotime($reg[$i]["fnacpaciente"])); ?>',
        '<?php echo $reg[$i]["gruposapaciente"]; ?>');"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></span>

        <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarPaciente('<?php echo encrypt($reg[$i]["codpaciente"]); ?>','<?php echo $criterio; ?>','<?php echo encrypt("PACIENTES"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

        </td>
      </tr>
    <?php } } ?>
  </tbody>
</table></div>
<?php
} 
############################# CARGAR PACIENTES ############################
?>





<?php
############################# CARGAR CITAS MEDICAS ############################
if (isset($_GET['CargaCitasMedicas']) && isset($_GET['bcitas'])) { 

$criterio = limpiar($_GET['bcitas']);
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?>
                          <th>Nombre de Médico</th>
                          <?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Descripción</th>
                          <th>Fecha | Hora</th>
                          <th>Status</th>
                          <th>Registrado</th>
                          <th>Sucursal</th>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
if($criterio==""){
    
  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE VALOR PARA TU CRITERIO DE BÚSQUEDA </center>";
  echo "</div>";
  exit;    

} else {

$reg = $tra->BusquedaCitas();
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
        <tr>
        <td><?php echo $a++; ?></td>
        <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
        <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['pacientes']."</span>"; ?></td>
        <td><?php echo $reg[$i]['descripcion']; ?></td>
        <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechacita']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechacita']))."</span>"; ?></td>
        <td>
        <?php if($reg[$i]['statuscita']==1) { 
        echo "<span class='badge badge-info'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg> ATENDIDA</span>"; 
        } elseif($reg[$i]['statuscita']==2) { 
        echo "<span class='badge badge-success'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-user-plus'><path d='M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2'></path><circle cx='8.5' cy='7' r='4'></circle><line x1='20' y1='8' x2='20' y2='14'></line><line x1='23' y1='11' x2='17' y2='11'></line></svg> PENDIENTE</span>";
        } elseif($reg[$i]['statuscita']==3) { 
        echo "<span class='badge badge-warning'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-octagon'><polygon points='7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2'></polygon><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg> CANCELADA</span>";
        } elseif($reg[$i]['statuscita']==4) {
        echo "<span class='badge badge-danger'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> VENCIDA</span>";
        } ?>
        </td>
        <td><?php echo date("d-m-Y",strtotime($reg[$i]['ingresocita'])); ?></td>
        <td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td>

        <td>
        <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerCita('<?php echo encrypt($reg[$i]["codcita"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

        <?php if ($_SESSION['acceso']=="administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="enfermera" || $_SESSION["acceso"]=="medico") { ?><span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarCitaGeneral('<?php echo encrypt($reg[$i]["codcita"]); ?>','<?php echo $criterio; ?>','<?php echo encrypt("CITAS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span><?php } ?>

        </td>
      </tr>
    <?php } } ?>
  </tbody>
</table></div>
<?php
} 
############################# CARGAR CITAS MEDICAS ############################
?>



<?php
############################# CARGAR CITAS MEDICAS POR FECHA ############################
if (isset($_GET['BuscaCitasxDia']) && isset($_GET['codverifica']) && isset($_GET['codsucursal']) && isset($_GET['codespecialidad']) && isset($_GET['codmedico']) && isset($_GET['fecha'])) { 

$codverifica = limpiar($_GET['codverifica']);
$codsucursal = limpiar($_GET['codsucursal']);
$codespecialidad = limpiar($_GET['codespecialidad']);
$codmedico = limpiar($_GET['codmedico']);
$fecha = limpiar($_GET['fecha']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codespecialidad=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE ESPECIALIDAD PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

} elseif($codmedico=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR SELECCIONE MEDICO PARA TU BÚSQUEDA</center>";
   echo "</div>";   
   exit;

} elseif($fecha=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA PARA TU BÚSQUEDA</center>";
   echo "</div>";   
   exit;

} else {
  
$busqueda = new Login();
$reg = $busqueda->BuscarCitasMedicasPendientes();  
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Descripción</th>
                          <th>Fecha | Hora</th>
                          <th>Status</th>
                          <th>Agregar</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
        <tr>
        <td><?php echo $a++; ?></td>
        <td><?php echo $reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
        <td><?php echo $reg[$i]['descripcion']; ?></td>
        <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechacita']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechacita']))."</span>"; ?></td>
        <td><?php if($reg[$i]['statuscita']==1) { 
        echo "<span class='badge badge-info'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg> ATENDIDA</span>"; 
        } elseif($reg[$i]['statuscita']==2) { 
        echo "<span class='badge badge-primary'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-user-plus'><path d='M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2'></path><circle cx='8.5' cy='7' r='4'></circle><line x1='20' y1='8' x2='20' y2='14'></line><line x1='23' y1='11' x2='17' y2='11'></line></svg> PENDIENTE</span>";
        } elseif($reg[$i]['statuscita']==3) { 
        echo "<span class='badge badge-warning'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-octagon'><polygon points='7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2'></polygon><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg> CANCELADA</span>";
        } elseif($reg[$i]['statuscita']==4) {
        echo "<span class='badge badge-danger'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> VENCIDA</span>";
        } ?></td>
        <td>
        <?php if($reg[$i]['statuscita']==1) { ?>

        <span class="text-info" style="cursor: pointer;" title="Atendida"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></span>

        <?php } elseif($reg[$i]['statuscita']==2) { ?>
        
        <span class="text-primary" style="cursor: pointer;" data-dismiss="modal" title="Agregar" onClick="AsignarDatos(
        '<?php echo $codverifica; ?>',
        '<?php echo encrypt($reg[$i]["codsucursal"]); ?>',
        '<?php echo $reg[$i]["codsucursal"]; ?>',
        '<?php echo encrypt($reg[$i]["codcita"]); ?>',
        '<?php echo $reg[$i]["codcita"]; ?>',
        '<?php echo encrypt($reg[$i]["codmedico"]); ?>',
        '<?php echo $codespecialidad; ?>',
        '<?php echo $fecha; ?>',
        '<?php echo encrypt($reg[$i]["codpaciente"]); ?>',
        '<?php echo $reg[$i]["codpaciente"]; ?>',
        '<?php echo $reg[$i]["numerohistoria"]; ?>',
        '<?php echo $reg[$i]["cedpaciente"]; ?>',
        '<?php echo $reg[$i]["nompaciente"]; ?>',
        '<?php echo $reg[$i]["apepaciente"]; ?>',
        '<?php echo $reg[$i]["gruposapaciente"]; ?>',
        '<?php echo $reg[$i]['fnacpaciente'] == '0000-00-00' ? "" : date("d-m-Y",strtotime($reg[$i]["fnacpaciente"])); ?>',
        '<?php echo $reg[$i]["nomacompana"]; ?>',
        '<?php echo $reg[$i]["parentescoacompana"]; ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg></span>
        
        <?php } else { ?>

        <span class="text-danger" style="cursor: pointer;" title="Cancelada"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></span>

        <?php } ?>

        </td>
      </tr>
        <?php } ?>
      </tbody>
    </table></div>
<?php
    } 
} 
############################# CARGAR CITAS MEDICAS POR FECHA ############################
?>





<?php
############################# CARGAR APERTURAS ############################
if (isset($_GET['CargaAperturas']) && isset($_GET['url'])) { 

$url = limpiar($_GET['url']);
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Enfermedad</th>
                          <th>Fecha | Hora</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarAperturas();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['enfermedadpaciente']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaapertura']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaapertura']))."</span>"; ?></td>
                    <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
                    <td>
                    <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerApertura('<?php echo encrypt($reg[$i]["codapertura"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

                    <!-- <span class="text-info" style="cursor: pointer;" title="Editarxxx" onClick="UpdateApertura('<?php echo encrypt($reg[$i]["codapertura"]); ?>','<?php echo (decrypt($url) == 1 ? 1 : 2); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span> -->

                    <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarApertura('<?php echo encrypt($reg[$i]["codapertura"]); ?>','<?php echo $url; ?>','<?php echo encrypt("APERTURAS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codapertura']); ?>&tipo=<?php echo encrypt("CONSTANCIA_APERTURA"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>
<?php
    } 
  } 
############################# CARGAR APERTURAS ############################
?>






<?php
############################# CARGAR HOJAS EVOLUTIVAS ############################
if (isset($_GET['CargaHojas']) && isset($_GET['url'])) { 

$url = limpiar($_GET['url']);
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Motivo Consulta</th>
                          <th>Fecha | Hora</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarHojasEvolutivas();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo $reg[$i]['motivoconsulta']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechahoja']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechahoja']))."</span>"; ?></td>
                    <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
                    <td>
                    <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerHoja('<?php echo encrypt($reg[$i]["codhoja"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

                    <?php if($reg[$i]['codprocedimiento']==0){ ?>

                    <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateHoja('<?php echo encrypt($reg[$i]["codhoja"]); ?>','<?php echo (decrypt($url) == 1 ? 1 : 2); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

                    <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarHoja('<?php echo encrypt($reg[$i]["codhoja"]); ?>','<?php echo $url; ?>','<?php echo encrypt("HOJAS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

                    <?php } ?>

                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codhoja']); ?>&tipo=<?php echo encrypt("CONSTANCIA_HOJA"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>
<?php
    } 
  } 
############################# CARGAR HOJAS EVOLUTIVAS ############################
?>






<?php
############################# CARGAR REMISIONES ############################
if (isset($_GET['CargaRemisiones']) && isset($_GET['url'])) { 

$url = limpiar($_GET['url']);
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Fecha | Hora</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarRemisiones();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fecharemision']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fecharemision']))."</span>"; ?></td>
                    <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
                    <td>
                    <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerRemision('<?php echo encrypt($reg[$i]["codremision"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

                    <?php if($reg[$i]['codprocedimiento']==0){ ?>

                    <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateRemision('<?php echo encrypt($reg[$i]["codremision"]); ?>','<?php echo (decrypt($url) == 1 ? 1 : 2); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

                    <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarRemision('<?php echo encrypt($reg[$i]["codremision"]); ?>','<?php echo $url; ?>','<?php echo encrypt("REMISIONES"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

                    <?php } ?>

                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codremision']); ?>&tipo=<?php echo encrypt("CONSTANCIA_REMISION"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>
<?php
    } 
  } 
############################# CARGAR REMISIONES ############################
?>






<?php
############################# CARGAR FORMULAS MEDICAS ############################
if (isset($_GET['CargaFormulasMedicas']) && isset($_GET['url'])) { 

$url = limpiar($_GET['url']);
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Fórmula Médica</th>
                          <th>Fecha | Hora</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarFormulasMedicas();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){

$explode = explode(",,",$reg[$i]['formulamedica']);  
?>
        <tr>
        <td><?php echo $a++; ?></td>
        <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
        <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

        <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
        <td class="text-dark alert-link">
        <?php 
        for($cont=0; $cont<COUNT($explode); $cont++):
        list($idcieformula,$formula,$observacionformula) = explode("/",$explode[$cont]);
        echo $formula."<br>";
        endfor;
        ?>
        </td>
        <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaformula']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaformula']))."</span>"; ?></td>
        <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
        <td>
        <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerFormulaMedica('<?php echo encrypt($reg[$i]["codformulam"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

        <?php if($reg[$i]['codprocedimiento']==0){ ?>

        <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateFormulaMedica('<?php echo encrypt($reg[$i]["codformulam"]); ?>','<?php echo (decrypt($url) == 1 ? 1 : 2); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

        <?php } ?>

        <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarFormulaMedica('<?php echo encrypt($reg[$i]["codformulam"]); ?>','<?php echo $url; ?>','<?php echo encrypt("FORMULASMEDICAS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

        <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codformulam']); ?>&tipo=<?php echo encrypt("CONSTANCIA_FORMULAMEDICA"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
        
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table></div>
<?php
    } 
} 
############################# CARGAR FORMULAS MEDICAS ############################
?>






<?php
############################# CARGAR ORDENES MEDICAS ############################
if (isset($_GET['CargaOrdenesMedicas']) && isset($_GET['url'])) { 

$url = limpiar($_GET['url']);
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Órden Médica</th>
                          <th>Fecha | Hora</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarOrdenesMedicas();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){

$explode = explode(",,",$reg[$i]['ordenmedica']);  
?>
            <tr>
            <td><?php echo $a++; ?></td>
            <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
            <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

            <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
            <td class="text-dark alert-link">
            <?php 
            for($cont=0; $cont<COUNT($explode); $cont++):
            list($idcieorden,$ordenes,$observacionorden) = explode("/",$explode[$cont]);
            echo $ordenes."<br>";
            endfor;
            ?>
            </td>
            <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaorden']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaorden']))."</span>"; ?></td>
            <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
            <td>
            <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerOrdenMedica('<?php echo encrypt($reg[$i]["codorden"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

            <?php if($reg[$i]['codprocedimiento']==0){ ?>

            <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateOrdenMedica('<?php echo encrypt($reg[$i]["codorden"]); ?>','<?php echo (decrypt($url) == 1 ? 1 : 2); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

            <?php } ?>

            <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarOrdenMedica('<?php echo encrypt($reg[$i]["codorden"]); ?>','<?php echo $url; ?>','<?php echo encrypt("ORDENESMEDICAS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

            <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codorden']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ORDENMEDICA"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
            
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table></div>
<?php
    } 
  } 
############################# CARGAR ORDENES MEDICAS ############################
?>







<?php
############################# CARGAR FORMULAS TERAPIAS ############################
if (isset($_GET['CargaFormulasTerapias'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Terapias Respiratorias <small class='text-danger alert-link'>(Series Dx)</small></th>
                          <th>Terapias Fisicas <small class='text-danger alert-link'>(Series Dx)</small></th>
                          <th>Micronebulizaciones <small class='text-danger alert-link'>(Cantidad)</small></th>
                          <th>Fecha | Hora</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarFormulasTerapias();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
            <tr>
            <td><?php echo $a++; ?></td>
            <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
            <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

            <td class="text-danger alert-link"><?php echo $reg[$i]['terapiasrespiratorias']; ?></td>
            <td class="text-danger alert-link"><?php echo $reg[$i]['terapiasfisicas']; ?></td>
            <td class="text-danger alert-link"><?php echo $reg[$i]['micronebulizaciones']; ?></td>

            <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaformula']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaformula']))."</span>"; ?></td>
            <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
            <td>
            <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerFormulaTerapia('<?php echo encrypt($reg[$i]["codformula"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

            <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateFormulaTerapia('<?php echo encrypt($reg[$i]["codformula"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

            <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarFormulaTerapia('<?php echo encrypt($reg[$i]["codformula"]); ?>','<?php echo encrypt("FORMULASTERAPIAS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

            <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codformula']); ?>&tipo=<?php echo encrypt("CONSTANCIA_FORMULATERAPIA"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
            
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table></div>
<?php
    } 
} 
############################# CARGAR FORMULAS TERAPIAS ############################
?>








<?php
############################# CARGAR SOLICITUD EXAMENES ############################
if (isset($_GET['CargaSolicitudExamenes'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Nombre de Cie </th>
                          <th>Fecha | Hora</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarSolicitudExamenes();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
            <tr>
            <td><?php echo $a++; ?></td>
            <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
            <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

            <td class="text-danger alert-link"><?php echo $reg[$i]['codcie'].": ".$reg[$i]['nombrecie']; ?></td>

            <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechasolicitud']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechasolicitud']))."</span>"; ?></td>
            <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
            <td>
            <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerSolicitudExamen('<?php echo encrypt($reg[$i]["codexamen"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

            <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateSolicitudExamen('<?php echo encrypt($reg[$i]["codexamen"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

            <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarSolicitudExamen('<?php echo encrypt($reg[$i]["codexamen"]); ?>','<?php echo encrypt("SOLICITUDEXAMENES"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

            <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codexamen']); ?>&tipo=<?php echo encrypt("CONSTANCIA_SOLICITUDEXAMEN"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
            
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table></div>
<?php
    } 
  } 
############################# CARGAR SOLICITUD EXAMENES ############################
?>






<?php
############################# CARGAR HOJAS CRIOCAUTERIZACIONES ############################
if (isset($_GET['Criocauterizaciones'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Motivo Consulta</th>
                          <th>Fecha | Hora</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarCriocauterizaciones();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
            <tr>
            <td><?php echo $a++; ?></td>
            <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
            <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

            <td><?php echo $reg[$i]['motivoconsulta']; ?></td>
            <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechacriocauterizacion']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechacriocauterizacion']))."</span>"; ?></td>
            <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
            <td>
            <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerCriocauterizacion('<?php echo encrypt($reg[$i]["codcriocauterizacion"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

            <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateCriocauterizacion('<?php echo encrypt($reg[$i]["codcriocauterizacion"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

            <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarCriocauterizacion('<?php echo encrypt($reg[$i]["codcriocauterizacion"]); ?>','<?php echo encrypt("CRIOCAUTERIZACIONES"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

            <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codcriocauterizacion']); ?>&tipo=<?php echo encrypt("CONSTANCIA_CRIOCAUTERIZACION"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
            
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table></div>
<?php
    } 
  } 
############################# CARGAR CRIOCAUTERIZACIONES ############################
?>





<?php
############################# CARGAR COLPOSCOPIAS ############################
if (isset($_GET['CargaColposcopias'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Impresión Diagnóstica</th>
                          <th>Sitio de Biopsia</th>
                          <th>Fecha | Hora</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarColposcopias();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
            <tr>
            <td><?php echo $a++; ?></td>
            <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
            <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

            <td><?php echo $reg[$i]['impresiondiagnostica'] == '' ? "************" : $reg[$i]['impresiondiagnostica']; ?></td>
            <td><?php echo $reg[$i]['biopsia'] == '' ? "************" : $reg[$i]['biopsia']; ?></td>
            <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechacolposcopia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechacolposcopia']))."</span>"; ?></td>
            <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
            <td>
            <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerColposcopia('<?php echo encrypt($reg[$i]["codcolposcopia"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

            <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateColposcopia('<?php echo encrypt($reg[$i]["codcolposcopia"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

            <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarColposcopia('<?php echo encrypt($reg[$i]["codcolposcopia"]); ?>','<?php echo encrypt("COLPOSCOPIAS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

            <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codcolposcopia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_COLPOSCOPIA"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
            
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table></div>
<?php
    } 
  } 
############################# CARGAR COLPOSCOPIAS ############################
?>








<?php
############################# CARGAR EXAMENES DE ECOGRAFIAS ############################
if (isset($_GET['CargaEcografias'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento Ecográfico</th>
                          <th>Fecha | Hora</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarEcografias();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
            <tr>
            <td><?php echo $a++; ?></td>
            <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
            <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

            <td><?php echo $reg[$i]['procedimiento']; ?></td>
            <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaecografia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaecografia']))."</span>"; ?></td>
            <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
            <td>
            <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerEcografia('<?php echo encrypt($reg[$i]["codecografia"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

            <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateEcografia('<?php echo encrypt($reg[$i]["codecografia"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

            <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarEcografia('<?php echo encrypt($reg[$i]["codecografia"]); ?>','<?php echo encrypt("ECOGRAFIAS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

            <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codecografia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ECOGRAFIA"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
            
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table></div>
<?php
    } 
} 
############################# CARGAR ECOGRAFIAS ############################
?>





<?php
############################# CARGAR EXAMENES DE LABORATORIO ############################
if (isset($_GET['CargaLaboratorios']) && isset($_GET['search_criterio'])) { 
$criterio = limpiar($_GET['search_criterio']);
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Hematologia</th>
                          <th>Química Sanguinea</th>
                          <th>Uroanálisis</th>
                          <th>Fecha | Hora</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
if($criterio==""){
    
  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE VALOR PARA TU CRITERIO DE BÚSQUEDA </center>";
  echo "</div>";
  exit;    

} else {

$reg = $tra->BusquedaLaboratorios();
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
    <tr>
    <td><?php echo $a++; ?></td>
    <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

    <td><?php echo $reg[$i]['observacioneshematologia'] == '' ? "************" : $reg[$i]['observacioneshematologia']; ?></td>
    <td><?php echo $reg[$i]['observacionesquimica'] == '' ? "************" : $reg[$i]['observacionesquimica']; ?></td>
    <td><?php echo $reg[$i]['observacionesuroanalisis'] == '' ? "************" : $reg[$i]['observacionesuroanalisis']; ?></td>
    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechalaboratorio']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechalaboratorio']))."</span>"; ?></td>
    <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
    <td>
    <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerLaboratorio('<?php echo encrypt($reg[$i]["codlaboratorio"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

    <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateLaboratorio('<?php echo encrypt($reg[$i]["codlaboratorio"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

    <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarLaboratorio('<?php echo encrypt($reg[$i]["codlaboratorio"]); ?>','<?php echo encrypt("LABORATORIOS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codlaboratorio']); ?>&tipo=<?php echo encrypt("CONSTANCIA_LABORATORIO"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table></div>
<?php
    } 
} 
############################# CARGAR EXAMENES DE LABORATORIO ############################
?>








<?php
############################# CARGAR RADIOLOGIAS ############################
if (isset($_GET['CargaRadiologias']) && isset($_GET['search_criterio'])) { 
$criterio = limpiar($_GET['search_criterio']);
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Lectura Rx</th>
                          <th>Tipo de Estudio</th>
                          <th>Fecha | Hora</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php  
if($criterio==""){
    
  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE VALOR PARA TU CRITERIO DE BÚSQUEDA </center>";
  echo "</div>";
  exit;    

} else {

$reg = $tra->BusquedaRadiologias();
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
    <tr>
    <td><?php echo $a++; ?></td>
    <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

    <td><?php echo $lectura = ( $reg[$i]['lectura'] == 1 ? "<span class='badge badge-info'><i class='fa fa-check'></i> SI</span>" : "<span class='badge badge-danger'><i class='fa fa-times'></i> NO</span>"); ?></td>

    <td><?php echo $reg[$i]['tipoestudio'] == '' ? "************" : $reg[$i]['tipoestudio']; ?></td>
    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fecharadiologia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fecharadiologia']))."</span>"; ?></td>
    <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
    <td>
    <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerRadiologia('<?php echo encrypt($reg[$i]["codradiologia"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

    <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateRadiologia('<?php echo encrypt($reg[$i]["codradiologia"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

    <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarRadiologia('<?php echo encrypt($reg[$i]["codradiologia"]); ?>','<?php echo encrypt("RADIOLOGIAS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

    <?php if($reg[$i]['lectura'] == 1){ ?>
    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codradiologia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_RADIOLOGIA"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
            <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table></div>
<?php
    } 
} 
############################# CARGAR RADIOLOGIAS ############################
?>









<?php
############################# CARGAR TERAPIAS ############################
if (isset($_GET['CargaTerapias']) && isset($_GET['search_criterio'])) { 
$criterio = limpiar($_GET['search_criterio']); 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Diagnóstico</th>
                          <th>Ciclo</th>
                          <th>Fecha | Hora</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php  
if($criterio==""){
    
  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE VALOR PARA TU CRITERIO DE BÚSQUEDA </center>";
  echo "</div>";
  exit;    

} else {

$reg = $tra->BusquedaTerapias();
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
    <tr>
    <td><?php echo $a++; ?></td>
    <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
    <td><?php echo $reg[$i]['diagnostico']; ?></td>
    <td><?php echo $ciclo = ( $reg[$i]['ciclo'] == 1 ? "<span class='badge badge-info'><i class='fa fa-check'></i> CULMINADO</span>" : "<span class='badge badge-danger'><i class='fa fa-times'></i> EN PROCESO</span>"); ?></td>

    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaterapia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaterapia']))."</span>"; ?></td>
    <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
    <td>
    <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerTerapia('<?php echo encrypt($reg[$i]["codterapia"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

    <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateTerapia('<?php echo encrypt($reg[$i]["codterapia"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

    <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarTerapia('<?php echo encrypt($reg[$i]["codterapia"]); ?>','<?php echo encrypt("TERAPIAS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codterapia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_TERAPIA"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
            
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table></div>
<?php
    } 
} 
############################# CARGAR TERAPIAS ############################
?>









<?php
############################# CARGAR ODONTOLOGIAS ############################
if (isset($_GET['CargaOdontologias']) && isset($_GET['search_criterio'])) { 
$criterio = limpiar($_GET['search_criterio']); 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
            <thead>
                <tr>
                  <th>N°</th>
                  <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                  <th>Nombre de Paciente</th>
                  <th>Motivo Consulta</th>
                  <th>Problema Actual</th>
                  <th>Fecha | Hora</th>
                  <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                  <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
<?php 
if($criterio==""){
    
  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE VALOR PARA TU CRITERIO DE BÚSQUEDA </center>";
  echo "</div>";
  exit;    

} else {

$reg = $tra->BusquedaOdontologias();
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
    <tr>
    <td><?php echo $a++; ?></td>
    <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

    <td><?php echo $reg[$i]['motivo_consulta'] == '' ? "************" : $reg[$i]['motivo_consulta']; ?></td>
    <td><?php echo $reg[$i]['problema_actual'] == '' ? "************" : $reg[$i]['problema_actual']; ?></td>
    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaodontologia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaodontologia']))."</span>"; ?></td>
    <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
    <td>
    <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerOdontologia('<?php echo encrypt($reg[$i]["cododontologia"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

    <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateOdontologia('<?php echo encrypt($reg[$i]["cododontologia"]); ?>','<?php echo encrypt($reg[$i]["codpaciente"]); ?>','<?php echo encrypt($reg[$i]["codsucursal"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

    <span class="text-warning" style="cursor: pointer;" title="Odontograma" onClick="UpdateOdontograma('<?php echo encrypt($reg[$i]["cododontologia"]); ?>','<?php echo encrypt($reg[$i]["codpaciente"]); ?>','<?php echo encrypt($reg[$i]["codsucursal"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-life-buoy"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="4.93" y1="4.93" x2="9.17" y2="9.17"></line><line x1="14.83" y1="14.83" x2="19.07" y2="19.07"></line><line x1="14.83" y1="9.17" x2="19.07" y2="4.93"></line><line x1="14.83" y1="9.17" x2="18.36" y2="5.64"></line><line x1="4.93" y1="19.07" x2="9.17" y2="14.83"></line></svg></span>

    <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarOdontologia('<?php echo encrypt($reg[$i]["cododontologia"]); ?>','<?php echo encrypt($reg[$i]["codpaciente"]); ?>','<?php echo encrypt($reg[$i]["codsucursal"]); ?>','<?php echo encrypt("ODONTOLOGIAS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['cododontologia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ODONTOLOGIA"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
            
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table></div>
<?php
    } 
} 
############################# CARGAR ODONTOLOGIAS ############################
?>










<?php
############################# CARGAR CONSENTIMIENTOS INFORMADOS ############################
if (isset($_GET['CargaConsentimientos'])) { 
?>
<div class="table-responsive mb-0 mt-0">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Nombre de Médico</th><?php } ?>
                          <th>Nombre de Paciente</th>
                          <th>Tipo de Consentimiento</th>
                          <th>Procedimiento</th>
                          <th>Fecha | Hora</th>
                          <?php if ($_SESSION['acceso'] != "medico") { ?><th>Sucursal</th><?php } ?>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$reg = $tra->ListarConsentimientos();

if($reg==""){
    
    echo "";  

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
    <tr>
    <td><?php echo $a++; ?></td>
    <?php if ($_SESSION['acceso'] != "medico") { ?><td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].": <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td><?php } ?>
    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].": <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

    <td class="text-danger alert-link"><?php 
    switch($reg[$i]['tipoconsentimiento']){
    case 1:
    ?>
    <?php echo "CONSENTIMIENTO INFORMADO PARA CONSULTORIO"; ?>
    <?php
    break;
    case 2:
    ?>
    <?php echo "CONSENTIMIENTO INFORMADO PARA GINECOLOGIA"; ?>
    <?php
    break;
    case 3:
    ?>
    <?php echo "CONSENTIMIENTO INFORMADO PARA LABORATORIO"; ?>
    <?php
    break;
    case 4:
    ?>
    <?php echo "CONSENTIMIENTO INFORMADO PARA RADIOLOGIA"; ?> 
    <?php
    break;
    case 5:
    ?> 
    <?php echo "CONSENTIMIENTO INFORMADO PARA TERAPEUTA"; ?>
    <?php
    break;
    case 6:
    ?> 
    <?php echo "CONSENTIMIENTO INFORMADO PARA ODONTOLOGIA"; ?>
    <?php
    break;
    }//end switch
    ?></td>
    <td><?php echo $reg[$i]['procedimiento']; ?></td>
    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaconsentimiento']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaconsentimiento']))."</span>"; ?></td>
    <?php if ($_SESSION['acceso'] != "medico") { ?><td class="text-dark alert-link"><?php echo $reg[$i]['cuitsucursal'].": ".$reg[$i]['nomsucursal']; ?></td><?php } ?>
    <td>
    <span class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#myModalDetalle" title="Ver" onClick="VerConsentimiento('<?php echo encrypt($reg[$i]["codconsentimiento"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>

    <span class="text-info" style="cursor: pointer;" title="Editar" onClick="UpdateConsentimiento('<?php echo encrypt($reg[$i]["codconsentimiento"]); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

    <span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarConsentimiento('<?php echo encrypt($reg[$i]["codconsentimiento"]); ?>','<?php echo encrypt("CONSENTIMIENTOS"); ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span>

    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codconsentimiento']); ?>&tipo=<?php echo encrypt("CONSTANCIA_CONSENTIMIENTO"); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
    
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table></div>
<?php
    } 
  } 
############################# CARGAR CONSENTIMIENTOS INFORMADOS ############################
?>


  <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
  <script src="plugins/table/datatable/datatables.js"></script>
  <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
  <script src="plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
  <script src="plugins/table/datatable/button-ext/jszip.min.js"></script>    
  <script src="plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
  <script src="plugins/table/datatable/button-ext/buttons.print.min.js"></script>
  <script>        
        $('#html5-extension').DataTable( {
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Mostrar Página _PAGE_ de _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Mostrar :  _MENU_",
            },
            "order": [[ 0, "asc" ]],
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 20,
            drawCallback: function () { $('.dataTables_paginate > .pagination').addClass(' pagination-style-13 pagination-bordered mb-5'); }
      } );
    </script>
  <!-- END PAGE LEVEL CUSTOM SCRIPTS -->

  <script src="assets/js/scrollspyNav.js"></script>
  <script src="plugins/font-icons/feather/feather.min.js"></script>
  <script type="text/javascript">
      feather.replace();
  </script>

<?php } else { ?>   
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER A ESTE MODULO.\nCONSULTA CON EL ADMINISTRADOR PARA QUE TE DE ACCESO')  
        document.location.href='panel'   
        </script> 
<?php } } else { ?>
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER AL SISTEMA.\nDEBERA DE INICIAR SESION')  
        document.location.href='logout'  
        </script> 
<?php } ?>