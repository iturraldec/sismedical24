<?php
require_once("class/class.php");
?>

<?php
$new = new Login();
?>


<?php 
######################## BUSCA CANTONES POR PROVINCIAS ########################
if (isset($_GET['BuscaCantones']) && isset($_GET['idprovincia'])) {
  
  $canton = $new->ListarCantonesxProvincia();

  $idprovincia = limpiar($_GET['idprovincia']);

  if($idprovincia=="") { ?>

  <option value="">-- SIN RESULTADOS --</option>
  <?php } else { ?>
  <option value=""> -- SELECCIONE -- </option>
  <?php
  for($i=0;$i<sizeof($canton);$i++){
  ?>
  <option value="<?php echo $canton[$i]['idcanton']; ?>" ><?php echo $canton[$i]['canton']; ?></option>
<?php 
    }
  }
}
######################## BUSCA CANTONES POR PROVINCIAS ########################
?>

<?php 
######################## SELECCIONE CANTONES POR PROVINCIAS ########################
if (isset($_GET['SeleccionaCantones']) && isset($_GET['idprovincia']) && isset($_GET['idcanton'])) {
  
  $canton = $new->SeleccionaCantones();
  ?>
  <option value="">SELECCIONE</option>
  <?php for($i=0;$i<sizeof($canton);$i++){ ?>
  <option value="<?php echo $canton[$i]['idcanton']; ?>"<?php if (!(strcmp($_GET['idcanton'], htmlentities($canton[$i]['idcanton'])))) {echo "selected=\"selected\"";} ?>><?php echo $canton[$i]['canton']; ?></option>
<?php
  } 
}
######################## SELECCIONE CANTONES POR PROVINCIAS ########################
?>



<?php 
######################## BUSCA CANTONES POR PARROQUIA ########################
if (isset($_GET['BuscaParroquias']) && isset($_GET['idcanton'])) {
  
  $parroquia = $new->ListarParroquiasxCanton();

  $idcanton = limpiar($_GET['idcanton']);

  if($idcanton=="") { ?>

  <option value="">-- SIN RESULTADOS --</option>
  <?php } else { ?>
  <option value=""> -- SELECCIONE -- </option>
  <?php
  for($i=0;$i<sizeof($parroquia);$i++){
  ?>
  <option value="<?php echo $parroquia[$i]['idparroquia']; ?>" ><?php echo $parroquia[$i]['parroquia']; ?></option>
<?php 
    }
  }
}
######################## BUSCA CANTONES POR PARROQUIA ########################
?>

<?php 
######################## SELECCIONE CANTONES POR PARROQUIA ########################
if (isset($_GET['SeleccionaParroquia']) && isset($_GET['idcanton']) && isset($_GET['idparroquia'])) {
  
  $parroquia = $new->SeleccionaParroquias();
  ?>
  <option value="">SELECCIONE</option>
  <?php for($i=0;$i<sizeof($parroquia);$i++){ ?>
  <option value="<?php echo $parroquia[$i]['idparroquia']; ?>"<?php if (!(strcmp($_GET['idparroquia'], htmlentities($parroquia[$i]['idparroquia'])))) {echo "selected=\"selected\"";} ?>><?php echo $parroquia[$i]['parroquia']; ?></option>
<?php
  } 
}
######################## SELECCIONE PARROQUIAS POR PARROQUIA ########################
?>



<?php
######################## MOSTRAR USUARIO EN VENTANA MODAL ############################
if (isset($_GET['BuscaUsuarioModal']) && isset($_GET['codigo'])) { 
$reg = $new->UsuariosPorId();
?>

  <table class="table-responsive" border="0" class="text-center">
  <tr>
    <td><strong>Nº de <?php echo $reg[0]['documusuario'] == '0' ? "Documento" : $reg[0]['documento']; ?>:</strong> <?php echo $reg[0]['dni']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres y Apellidos:</strong> <?php echo $reg[0]['nombres']; ?></td>
  </tr>
  <tr>
    <td><strong>Sexo:</strong> <?php echo $reg[0]['sexo']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Teléfono: </strong> <?php echo $reg[0]['telefono']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Celular: </strong> <?php echo $reg[0]['celular'] == '' ? "***********" : $reg[0]['celular']; ?></td>
  </tr>
  <tr>
    <td><strong>Provincia: </strong> <?php echo $reg[0]['idprovincia'] == '0' ? "*********" : $reg[0]['provincia']; ?></td>
  </tr>
  <tr>
    <td><strong>Cantón: </strong> <?php echo $reg[0]['idcanton'] == '0' ? "*********" : $reg[0]['canton']; ?></td>
  </tr>
  <tr>
    <td><strong>Parroquia: </strong> <?php echo $reg[0]['idparroquia'] == '0' ? "*********" : $reg[0]['parroquia']; ?></td>
  </tr>
  <tr>
    <td><strong>Dirección Domiciliaria: </strong> <?php echo $reg[0]['direccion']; ?></td>
  </tr>
  <tr>
    <td><strong>Correo Electrónico: </strong> <?php echo $reg[0]['email']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de MPS: </strong> <?php echo $reg[0]['mps'] == '' ? "*********" : $reg[0]['mps']; ?></td>
  </tr> 
  <tr>
    <td><strong>Especialidad: </strong> <?php echo $reg[0]['codespecialidad'] == '0' ? "*********" : $reg[0]['nomespecialidad']; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Nacimiento: </strong> <?php echo $reg[0]['fnacimiento'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[0]['fnacimiento'])); ?></td>
  </tr>
  <tr>
    <td><strong>Usuario de Acceso: </strong> <?php echo $reg[0]['usuario']; ?></td>
  </tr>
  <tr>
    <td><strong>Nivel de Acceso: </strong> <?php echo $reg[0]['nivel']; ?></td>
  </tr>
  <tr>
  <td><strong>Status de Acceso: </strong> <?php echo $status = ( $reg[0]['status'] == 1 ? '<span class="badge badge-info"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg> ACTIVO</span>' : '<span class="badge badge-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-x"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="18" y1="8" x2="23" y2="13"></line><line x1="23" y1="8" x2="18" y2="13"></line></svg> INACTIVO</span>'); ?></td>
  </tr>
</table>  

<?php
} 
######################## MOSTRAR USUARIO EN VENTANA MODAL ############################
?>








<?php
######################### MOSTRAR SUCURSAL EN VENTANA MODAL ##########################
if (isset($_GET['BuscaSucursalModal']) && isset($_GET['codsucursal'])) { 

$reg = $new->SucursalesPorId();
?>
  
  <table class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $reg[0]['documsucursal'] == '0' ? "Documento" : $reg[0]['documento'] ?>: </strong> <?php echo $reg[0]['cuitsucursal']; ?></td>
  </tr>
  <tr>
    <td><strong>Razòn Social: </strong> <?php echo $reg[0]['nomsucursal']; ?></td>
  </tr>
  <tr>
    <td><strong>Provincia: </strong> <?php echo $reg[0]['idprovincia'] == '0' ? "*********" : $reg[0]['provincia']; ?></td>
  </tr>
  <tr>
    <td><strong>Cantón: </strong> <?php echo $reg[0]['idcanton'] == '0' ? "*********" : $reg[0]['canton']; ?></td>
  </tr>
  <tr>
    <td><strong>Parroquia: </strong> <?php echo $reg[0]['idparroquia'] == '0' ? "*********" : $reg[0]['parroquia']; ?></td>
  </tr>
  <tr>
    <td><strong>Dirección de Sucursal: </strong> <?php echo $reg[0]['direcsucursal']; ?></td>
  </tr>
  <tr>
    <td><strong>Correo Electrónico: </strong> <?php echo $reg[0]['correosucursal']; ?></td>
  </tr> 
  <tr>
    <td><strong>Nº de Teléfono: </strong> <?php echo $reg[0]['tlfsucursal']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº <?php echo $reg[0]['documencargado'] == '0' ? "Documento" : $reg[0]['documento2'] ?> de Encargado:</strong> <?php echo $reg[0]['dniencargado']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Encargado:</strong> <?php echo $reg[0]['nomencargado']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Telèfono:</strong> <?php echo $reg[0]['tlfencargado'] == '' ? "******" : $reg[0]['tlfencargado']; ?></td>
  </tr>
</table>
<?php 
} 
######################### MOSTRAR SUCURSAL EN VENTANA MODAL #########################
?>

<!--########################### LISTAR SUCURSALES ##########################-->
<?php if (isset($_GET['MuestraSucursales'])): ?>

<?php 
$sucursal = new Login();
$sucursal = $sucursal->ListarSucursales();

if($sucursal==""){  

} else {  
?>

<div class="row"> 
             
<?php
$a=1;
for($i=0;$i<sizeof($sucursal);$i++){ 
?>

    <div class="col-md-4 m-t-10">
        <div class="form-check">
            <div class="custom-control custom-radio">
                <input type="checkbox" class="custom-control-input" name="codsucursal[]" id="codsucursal_<?php echo $sucursal[$i]['codsucursal'] ?>" value="<?php echo $sucursal[$i]['codsucursal'] ?>">
                   <label class="custom-control-label" for="codsucursal_<?php echo $sucursal[$i]['codsucursal'] ?>">
                   <?php echo $sucursal[$i]['nomsucursal'] ?>
                   </label>
            </div>
        </div>
    </div>
    <?php } ?>
        </div> 
  <?php } ?>

<?php endif; ?>
<!--########################### LISTAR SUCURSALES ASIGNADAS ##########################-->


<!--########################### LISTAR SUCURSALES ASIGNADAS ##########################-->
<?php if (isset($_GET['MuestraSucursalesAsignadas']) && isset($_GET['codigo']) && isset($_GET['gruposid'])): ?>

<?php 
$sucursal = new Login();
$sucursal = $sucursal->ListarSucursales();

if($sucursal==""){  

} else {  
?>

<div class="row"> 
              
<?php
$a=1;
for($i=0;$i<sizeof($sucursal);$i++){ 
?>

    <div class="col-md-4 m-t-10">
        <div class="form-check">
            <div class="custom-control custom-radio">
                <input type="checkbox" class="custom-control-input" name="codsucursal[]" id="codsucursal_<?php echo $sucursal[$i]['codsucursal'] ?>" value="<?php echo $sucursal[$i]['codsucursal'] ?>" <?php 

$explode = explode(", ", $_GET['gruposid']);

foreach($explode as $meschecked){

echo $meschecked == $sucursal[$i]['codsucursal'] ? "checked=\"checked\"":'';  } ?>>
                   <label class="custom-control-label" for="codsucursal_<?php echo $sucursal[$i]['codsucursal'] ?>">
                   <?php echo $sucursal[$i]['nomsucursal'] ?>
                   </label>
            </div>
        </div>
    </div>
                        <?php } ?>
                    </div> 
        <?php } ?>

<?php endif; ?>
<!--########################### LISTAR SUCURSALES ASIGNADAS ##########################-->









<?php
######################### MOSTRAR PLANTILLA ECOGRAFICA EN VENTANA MODAL ##########################
if (isset($_GET['BuscaPlantillaEcograficaModal']) && isset($_GET['codplantillaecografia'])) { 

$reg = $new->PlantillasEcograficasPorId();
?>
  
  <table id="div2" class="table-responsive" border="0">
  <tr>
    <td><strong>Nombre de Plantilla: </strong> <?php echo $reg[0]['nombreplantillaecografia']; ?></td>
  </tr>
  <tr>
    <td><strong>Procedimiento de Plantilla: </strong> <?php echo nl2br($reg[0]['procedimientoecografia']); ?></td>
  </tr>
  <tr>
    <td><strong>Descripción de Plantilla: </strong> <?php echo nl2br($reg[0]['descripcionecografia']); ?></td>
  </tr>
</table>
<?php 
} 
######################### MOSTRAR PLANTILLA ECOGRAFICA EN VENTANA MODAL #########################
?>









<?php
######################### MOSTRAR PLANTILLA LECTURA RX EN VENTANA MODAL ##########################
if (isset($_GET['BuscaPlantillaLecturaRxModal']) && isset($_GET['codplantillalecturarx'])) { 

$reg = $new->PlantillasLecturaRxPorId();
?>
  
  <table id="div2" class="table-responsive" border="0">
  <tr>
    <td><strong>Nombre de Plantilla: </strong> <?php echo $reg[0]['nombreplantillalecturarx']; ?></td>
  </tr>
  <tr>
    <td><strong>Procedimiento de Plantilla: </strong> <?php echo nl2br($reg[0]['procedimientolecturarx']); ?></td>
  </tr>
  <tr>
    <td><strong>Descripción de Plantilla: </strong> <?php echo nl2br($reg[0]['descripcionlecturarx']); ?></td>
  </tr>
</table>
<?php 
} 
######################### MOSTRAR PLANTILLA LECTURA RX EN VENTANA MODAL #########################
?>











<?php
######################## MOSTRAR MEDICO EN VENTANA MODAL ############################
if (isset($_GET['BuscaMedicoModal']) && isset($_GET['codmedico'])) { 
$reg = $new->MedicosPorId();
?>

  <table class="table-responsive" border="0">
  <tr>
    <td><strong>Código:</strong> <?php echo $reg[0]['codmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $reg[0]['docummedico'] == '0' ? "Documento" : $reg[0]['documento']; ?>:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres y Apellidos:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Sexo: </strong> <?php echo $reg[0]['sexomedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Teléfono: </strong> <?php echo $reg[0]['tlfmedico'] == '' ? "***********" : $reg[0]['tlfmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Celular: </strong> <?php echo $reg[0]['celmedico'] == '' ? "***********" : $reg[0]['celmedico']; ?></td>
  </tr>
 <tr>
    <td><strong>Provincia: </strong> <?php echo $reg[0]['idprovincia'] == '0' ? "*********" : $reg[0]['provincia']; ?></td>
  </tr>
  <tr>
    <td><strong>Cantón: </strong> <?php echo $reg[0]['idcanton'] == '0' ? "*********" : $reg[0]['canton']; ?></td>
  </tr>
  <tr>
    <td><strong>Parroquia: </strong> <?php echo $reg[0]['idparroquia'] == '0' ? "*********" : $reg[0]['parroquia']; ?></td>
  </tr>
  <tr>
    <td><strong>Dirección Domiciliaria: </strong> <?php echo $reg[0]['direcmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Correo Electrónico: </strong> <?php echo $reg[0]['correomedico'] == '' ? "*********" : $reg[0]['correomedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de MPS: </strong> <?php echo $reg[0]['mps']; ?></td>
  </tr> 
  <tr>
    <td><strong>Especialidad: </strong> <?php echo $reg[0]['nomespecialidad']; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Nacimiento: </strong> <?php echo $reg[0]['fnacmedico'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[0]['fnacmedico'])); ?></td>
  </tr>
  <tr>
    <td><strong>Sucursal Asignada: </strong> <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table>  

  <?php
   } 
######################## MOSTRAR MEDICO EN VENTANA MODAL ############################
?>

<?php 
########################## BUSCA ESPECIALIDADES #############################
if (isset($_GET['BuscaEspecialidades']) && isset($_GET['codsucursal'])) {
  
  $especialidad = $new->ListarEspecialidades();

  $codsucursal = limpiar($_GET['codsucursal']);

  if($codsucursal=="") { ?>

  <option value="">-- SIN RESULTADOS --</option>
  <?php } else { ?>
  <option value=""> -- SELECCIONE -- </option>
  <?php
  for($i=0;$i<sizeof($especialidad);$i++){
  ?>
  <option value="<?php echo encrypt($especialidad[$i]['codespecialidad']); ?>"><?php echo $especialidad[$i]['nomespecialidad']; ?></option>
  <?php
    } 
  } 
}
############################# BUSCA ESPECIALIDADES ##########################
?>

<?php 
######################## SELECCIONE ESPECIALIDAD POR SUCURSAL ########################
if (isset($_GET['SeleccionaEspecialidad']) && isset($_GET['codsucursal']) && isset($_GET['codespecialidad'])) {
  
  $especialidad = $new->ListarEspecialidades();
  ?>
  <option value=""> -- SELECCIONE -- </option>
  <?php
  for($i=0;$i<sizeof($especialidad);$i++){
  ?>
  <option value="<?php echo encrypt($especialidad[$i]['codespecialidad']); ?>"<?php if (!(strcmp(decrypt($_GET['codespecialidad']), htmlentities($especialidad[$i]['codespecialidad'])))) {echo "selected=\"selected\"";} ?>><?php echo $especialidad[$i]['nomespecialidad']; ?></option>
<?php
  } 
}
######################## SELECCIONE ESPECIALIDAD POR SUCURSAL ########################
?>

<?php 
########################## BUSCA MEDICOS POR SUCURSALES Y ESPECIALIDADES #############################
if (isset($_GET['BuscaMedicos']) && isset($_GET['codsucursal']) && isset($_GET['codespecialidad'])) {
  
  $medico = $new->BuscarMedicosxSucursalEspecialidad();

  $codsucursal = limpiar($_GET['codsucursal']);
  $codespecialidad = limpiar($_GET['codespecialidad']);

  if($codsucursal=="") { ?>
  <option value="">-- SIN RESULTADOS --</option>
  <?php } else if($codespecialidad=="") { ?>
  <option value="">-- SIN RESULTADOS --</option>
  <?php } else { ?>
  <option value=""> -- SELECCIONE -- </option>
  <?php
  for($i=0;$i<sizeof($medico);$i++){
  ?>
  <option value="<?php echo encrypt($medico[$i]['codmedico']); ?>"><?php echo $medico[$i]['nommedico']; ?></option>
  <?php 
    }
  } 
}
############################# BUSCA MEDICOS POR SUCURSALES Y ESPECIALIDADES ##########################
?>

<?php 
######################## SELECCIONE MEDICOS POR SUCURSAL Y ESPECIALIDAD ########################
if (isset($_GET['SeleccionaMedico']) && isset($_GET['codsucursal']) && isset($_GET['codespecialidad']) && isset($_GET['codmedico'])) {
  
  $medico = $new->BuscarMedicosxSucursalEspecialidad();
  ?>
  <option value=""> -- SELECCIONE -- </option>
  <?php
  for($i=0;$i<sizeof($medico);$i++){
  ?>
  <option value="<?php echo encrypt($medico[$i]['codmedico']); ?>"<?php if (!(strcmp(decrypt($_GET['codmedico']), htmlentities($medico[$i]['codmedico'])))) {echo "selected=\"selected\"";} ?>><?php echo $medico[$i]['nommedico']; ?></option>
<?php
  } 
}
######################## SELECCIONE MEDICOS POR SUCURSAL Y ESPECIALIDAD ########################
?>

<?php 
########################### BUSQUEDA DE MEDICOS POR SUCURSALES ##########################
if (isset($_GET['BusquedaMedicosxSucursal']) && isset($_GET['codsucursal'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else {
  
 $busqueda = new Login();
 $reg = $busqueda->BusquedaMedicosxSucursal();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&tipo=<?php echo encrypt("MEDICOSXSUCURSAL") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("MEDICOSXSUCURSAL") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("MEDICOSXSUCURSAL") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>N° de Documento</th>
                          <th>Nombres y Apellidos</th>
                          <th>Nº de Teléfono</th>
                          <th>Nº de Celular</th>
                          <th>Email</th>
                          <th>Especialidad</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['documento']." ".$reg[$i]['cedmedico']; ?></td>
                    <td class="text-dark alert-link"><?php echo $reg[$i]['nommedico']; ?></td>
                    <td><?php echo $reg[$i]['tlfmedico'] == "" ? "**********" : $reg[$i]['tlfmedico']; ?></td>
                    <td><?php echo $reg[$i]['celmedico'] == "" ? "**********" : $reg[$i]['celmedico']; ?></td>
                    <td><?php echo $reg[$i]['correomedico']; ?></td>
                    <td><?php echo $reg[$i]['nomespecialidad']; ?></td>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE MEDICOS POR SUCURSALES ##########################
?>

<?php 
######################## BUSQUEDA MODULOS X MEDICOS ########################
if (isset($_GET['BuscaModulosxMedicos']) && isset($_GET['codsucursal']) && isset($_GET['codmedico'])) {
  
  $acceso = [
    "CONSULTORIO" => 1,
    "GINECOLOGIA" => 2,
    "LABORATORIO" => 3,
    "RADIOLOGIA" => 4,
    "TERAPEUTA" => 5,
    "ODONTOLOGIA" => 6
  ];

  $codsucursal = limpiar($_GET['codsucursal']);
  $codmedico = limpiar($_GET['codmedico']);

  if($codmedico=="") { ?>
  <option value="">-- SIN RESULTADOS --</option>
  <?php } else { ?>
  <option value=""> -- SELECCIONE -- </option>
  <?php
  $modulo = $new->MedicosPorId();
  $explode_modulos = explode(",", $modulo[0]['modulos']);
  foreach ($acceso as $nombre => $tipo):

    if (in_array($tipo, $explode_modulos)) {
  ?>
  <option value="<?php echo encrypt($tipo); ?>"><?php echo $nombre; ?></option>
  <?php
    }
   endforeach;
  } 
}
######################## BUSQUEDA MODULOS X MEDICOS ########################
?>

<?php 
######################## SELECCIONE PROFESIONAL POR SUCURSAL ########################
if (isset($_GET['BuscaProfesional']) && isset($_GET['codsucursal'])) {
  
  $medico = $new->BuscarProfesionalxSucursal();
  ?>
  <option value=""> -- SELECCIONE -- </option>
  <?php
  for($i=0;$i<sizeof($medico);$i++){
  ?>
  <option value="<?php echo encrypt($medico[$i]['codmedico']); ?>"><?php echo $medico[$i]['nommedico']; ?></option>
<?php
  } 
}
######################## SELECCIONE PROFESIONAL POR SUCURSAL ########################
?>



















<?php
######################## MOSTRAR HORARIO MEDICO EN VENTANA MODAL ############################
if (isset($_GET['BuscaHorarioModal']) && isset($_GET['codhorario'])) { 
$reg = $new->HorariosPorId();
?>

  <table class="table-responsive" border="0">
  <tr>
    <td><strong>Código:</strong> <?php echo $reg[0]['codmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $reg[0]['docummedico'] == '0' ? "Documento" : $reg[0]['documento']; ?>:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres y Apellidos:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Teléfono: </strong> <?php echo $reg[0]['tlfmedico'] == '' ? "***********" : $reg[0]['tlfmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Celular: </strong> <?php echo $reg[0]['celmedico'] == '' ? "***********" : $reg[0]['celmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de MPS: </strong> <?php echo $reg[0]['mps']; ?></td>
  </tr> 
  <tr>
    <td><strong>Especialidad: </strong> <?php echo $reg[0]['nomespecialidad']; ?></td>
  </tr>
  <tr>
    <td><strong>Dias Laborales: </strong> <?php echo Dias($reg[0]['dias']); ?></td>
  </tr>
  <tr>
    <td><strong>Hora: </strong> <?php echo $reg[0]['hora_desde']." - ".$reg[0]['hora_hasta']; ?></td>
  </tr>
  <tr>
    <td><strong>Sucursal Asignada: </strong> <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table>  

  <?php
   } 
######################## MOSTRAR HORARIO MEDICO EN VENTANA MODAL ############################
?>

<!--########################### MOSTRAR DIAS LABORABLES ##########################-->
<?php if (isset($_GET['MuestraDiasLaborales'])): 
?>
  <div class="row">
      <?php
      $days = [
        "LUNES" => 1,
        "MARTES" => 2,
        "MIERCOLES" => 3,
        "JUEVES" => 4,
        "VIERNES" => 5,
        "SABADO" => 6,
        "DOMINGO" => 7
      ];
      
      foreach ($days as $nombre => $dia):
      ?> 
      <div class="col-md-3">
          <div class="form-check">
              <div class="custom-control custom-radio">
                  <input type="checkbox" class="custom-control-input" name="dias[]" id="<?php echo $dia; ?>" value="<?php echo $dia; ?>">
                  <label class="custom-control-label" for="<?php echo $dia; ?>">
                  <?php echo $nombre; ?>
                  </label>
              </div>
          </div>
      </div>
      <?php
      endforeach;
      ?>
  </div>

<?php endif; ?>
<!--########################### MOSTRAR DIAS LABORABLES ##########################-->

<!--########################### LISTAR DIAS LABORABLES ASIGNADOS ##########################-->
<?php if (isset($_GET['MuestraDiasAsignados']) && isset($_GET['codhorario']) && isset($_GET['gruposid'])): 
?>
  <div class="row">
      <?php
      $days = [
        "LUNES" => 1,
        "MARTES" => 2,
        "MIERCOLES" => 3,
        "JUEVES" => 4,
        "VIERNES" => 5,
        "SABADO" => 6,
        "DOMINGO" => 7
      ];

      $days_bd = explode(",", $_GET['gruposid']);
      
      foreach ($days as $nombre => $dia):
      ?> 
      <div class="col-md-3">
          <div class="form-check">
              <div class="custom-control custom-radio">
                  <input type="checkbox" class="custom-control-input" name="dias[]" id="<?php echo $dia; ?>" value="<?php echo $dia; ?>"
                  <?php echo $var = in_array($dia, $days_bd) ? "checked=\"checked\"" : ""; ?>>
                  <label class="custom-control-label" for="<?php echo $dia; ?>">
                  <?php echo $nombre; ?>
                  </label>
              </div>
          </div>
      </div>
      <?php
      endforeach;
      ?>
  </div>

<?php endif; ?>
<!--########################### LISTAR DIAS LABORABLES ASIGNADOS ##########################-->

<!--########################### LISTAR HORAS DISPONIBLES ##########################-->
<?php if (isset($_GET['BuscaHorasDisponiblesModal']) && isset($_GET['codmedico']) && isset($_GET['codsucursal']) && isset($_GET['fechacita'])): ?>

<?php 
$agrupado = new Login();
$agrupado = $agrupado->BuscarCitasMedicasxMedicoAgrupadas();
$explode = (empty($agrupado) ? "0" : explode(",", $agrupado[0]['horas_citas']));
?>

<div id="div1"><table id="html5-extension" class="table" style="width:100%">
  <thead>
    <tr>
      <th>N°</th>
      <th>Hora de Cita</th>
    </tr>
  </thead>
  <tbody>
<?php
$horas = new Login();
$horas = $horas->BusquedaHoraDesdeHasta();
$intervarlo = '20';

$fechaInicio = new DateTime($horas[0]['hora_desde']);
$fechaFin = new DateTime($horas[0]['hora_hasta']);
$fechaFin = $fechaFin->modify( '+20 minutes' ); 

$rangoFechas = new DatePeriod($fechaInicio, new DateInterval('PT20M'), $fechaFin);

$a=1;
foreach($rangoFechas as $fecha):
?>
        <tr class="text-dark alert-link">
          <td><?php echo $a++; ?></td>
          <td>
          <?php if(!empty($agrupado) && in_array($fecha->format("H:i"), $explode)){ ?>
          <span class="text-danger" style="cursor: pointer;" title="OCUPADO"> 
          <?php } else { ?>
          <span style="cursor: pointer;" data-dismiss="modal" title="DISPONIBLE" 
            onClick="AsignarHora('<?php echo $fecha->format("H:i"); ?>')"> 
          <?php } ?>
          <?php echo $fecha->format("H:i") . PHP_EOL; ?></span></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table></div>

<?php endif; ?>
<!--########################### LISTAR HORAS DISPONIBLES ##########################-->















<?php 
######################## MUESTRA DIV PACIENTES ########################
if (isset($_GET['BuscaDivPaciente'])) {
?>
<div class="row">
      <div class="col-md-12">
<font color="red"><strong> Para poder realizar la Carga Masiva de Pacientes, el archivo Excel, debe estar estructurado de 36 columnas, la cuales tendrán las siguientes especificaciones:</strong></font><br>

  1. Código de Paciente. (Ejemplo: P1, P2, P3, P4....)<br>
  2. Nº de Historia.<br>
  3. Tipo de Documento. (Debera de Ingresar el Nº de Documento a la que corresponde)<br>
  4. Nº de Documento.<br>
  5. Primer Nombre.<br>
  6. Segundo Nombre.<br>
  7. Primer Apellido.<br>
  8. Segundo Apellido.<br>
  9. Dirección Domiciliaria.<br>
  10. Barrio.<br>
  11. Parroquia. (Debera de Ingresar el Nº de Parroquia a la que corresponde)<br>
  12. Cantón. (Debera de Ingresar el Nº de Cantón a la que corresponde)<br>
  13. Provincia. (Debera de Ingresar el Nº de Provincia a la que corresponde)<br>
  14. Zona.<br>
  15. Nº de Teléfono.<br>
  16. Fecha de Nacimiento.<br>
  17. Lugar de Nacimiento.<br>
  18. Nacionalidad (Pais).<br>
  19. Grupo Cultural.<br>
  20. Sexo.<br>
  21. Estado Civil.<br>
  22. Grado de Instrucción.<br>
  23. Ocupación Laboral.<br>
  24. Empresa donde Trabaja.<br>
  25. Código de Seguro.<br>
  26. Referido.<br>
  27. Grupo Sanguineo.<br>
  28. Correo Electronico.<br>
  29. Nombre de Acompañante.<br>
  30. Dirección de Acompañante.<br>
  31. Nº de Teléfono de Acompañante.<br>
  32. Parentesco de Acompañante.<br>
  33. Nombre de Responsable.<br>
  34. Dirección de Responsable.<br>
  35. Nº de Teléfono de Responsable.<br>
  36. Parentesco de Responsable.<br>

  <font color="red"><strong> NOTA:</strong></font><br>
  a) El Archivo no debe de tener cabecera, solo deben estar los registros a grabar.<br>
  b) Se debe de guardar como archivo .CSV  (delimitado por comas)(*.csv).<br>
  c) Descargar Plantilla <a href="fotos/pacientes.csv">AQUI</a>. (La Cabecera deberá de ser eliminada al momento de hacer la Carga Masiva)<br>
  d) Todos los datos deberán escribirse en mayúscula para mejor orden y visibilidad en los reportes.<br>
  e) Deben de tener en cuenta que la carga masiva de Pacientes, deben de ser cargados como se explica, para evitar problemas de datos del Paciente dentro del Sistema.<br><br>
   </div>
</div>                               
<?php 
  }
######################## MUESTRA DIV PACIENTES ########################
?>

<?php
######################## MOSTRAR PACIENTES EN VENTANA MODAL ############################
if (isset($_GET['BuscaPacienteModal']) && isset($_GET['codpaciente'])) { 
$reg = $new->PacientesPorId();
?>

  <h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Datos del Paciente</h5><hr>

  <table class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de Historia Clínica:</strong> <?php echo $reg[0]['numerohistoria']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $reg[0]['documpaciente'] == '0' ? "Documento" : $reg[0]['documento']; ?>:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres:</strong> <?php echo $reg[0]['pnompaciente']." ".$reg[0]['snompaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Apellidos:</strong> <?php echo $reg[0]['papepaciente']." ".$reg[0]['sapepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Dirección Domiciliaria:</strong> <?php echo $reg[0]['direcpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Barrio:</strong> <?php echo $reg[0]['barriopaciente'] == '' ? "*********" : $reg[0]['barriopaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Parroquia: </strong> <?php echo $reg[0]['idparroquia'] == '0' ? "*********" : $reg[0]['parroquia']; ?></td>
  </tr>
  <tr>
    <td><strong>Cantón: </strong> <?php echo $reg[0]['idcanton'] == '0' ? "*********" : $reg[0]['canton']; ?></td>
  </tr>
  <tr>
    <td><strong>Provincia: </strong> <?php echo $reg[0]['idprovincia'] == '0' ? "*********" : $reg[0]['provincia']; ?></td>
  </tr>
  <tr>
    <td><strong>Zona: </strong> <?php echo $reg[0]['zonapaciente'] == '' ? "*********" : $reg[0]['zonapaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Teléfono:</strong> <?php echo $reg[0]['tlfpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Nacimiento:</strong> <?php echo $reg[0]['fnacpaciente'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[0]['fnacpaciente'])); ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo $reg[0]['fnacpaciente'] == '0000-00-00' ? "*********" : edad($reg[0]['fnacpaciente'])." AÑOS"; ?></td>
  </tr>
  <tr>
    <td><strong>Lugar de Nacimiento:</strong> <?php echo $reg[0]['lnacpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nacionalidad (Pais):</strong> <?php echo $reg[0]['nacpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Grupo Cultural:</strong> <?php echo $reg[0]['enfoquepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Sexo:</strong> <?php echo $reg[0]['sexopaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Estado Civil:</strong> <?php echo $reg[0]['estadopaciente'] == '' ? "*********" : $reg[0]['estadopaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Grado de Instrucción:</strong> <?php echo $reg[0]['instruccionpaciente'] == '' ? "*********" : $reg[0]['instruccionpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Ocupación Laboral:</strong> <?php echo $reg[0]['ocupacionpaciente'] == '' ? "*********" : $reg[0]['ocupacionpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Empresa donde Trabaja:</strong> <?php echo $reg[0]['trabajapaciente'] == '' ? "*********" : $reg[0]['trabajapaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Seguro:</strong> <?php echo $reg[0]['codseguro'] == '0' ? "*********" : $reg[0]['nomseguro']; ?></td>
  </tr>
  <tr>
    <td><strong>Referido:</strong> <?php echo $reg[0]['referidopaciente'] == '' ? "*********" : $reg[0]['referidopaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Grupo Sanguineo:</strong> <?php echo $reg[0]['gruposapaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Correo Electronico:</strong> <?php echo $reg[0]['emailpaciente'] == '' ? "*********" : $reg[0]['emailpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Acompañante:</strong> <?php echo $reg[0]['nomacompana'] == '' ? "*********" : $reg[0]['nomacompana']; ?></td>
  </tr>
  <tr>
    <td><strong>Dirección de Acompañante:</strong> <?php echo $reg[0]['direcacompana'] == '' ? "*********" : $reg[0]['direcacompana']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Teléfono de Acompañante:</strong> <?php echo $reg[0]['tlfacompana'] == '' ? "*********" : $reg[0]['tlfacompana']; ?></td>
  </tr>
  <tr>
    <td><strong>Parentesco de Acompañante:</strong> <?php echo $reg[0]['parentescoacompana'] == '' ? "*********" : $reg[0]['parentescoacompana']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Responsable:</strong> <?php echo $reg[0]['nomresponsable'] == '' ? "*********" : $reg[0]['nomresponsable']; ?></td>
  </tr>
  <tr>
    <td><strong>Dirección de Responsable:</strong> <?php echo $reg[0]['direcresponsable'] == '' ? "*********" : $reg[0]['direcresponsable']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Teléfono de Responsable:</strong> <?php echo $reg[0]['tlfresponsable'] == '' ? "*********" : $reg[0]['tlfresponsable']; ?></td>
  </tr>
  <tr>
    <td><strong>Parentesco de Responsable:</strong> <?php echo $reg[0]['parentescoresponsable'] == '' ? "*********" : $reg[0]['parentescoresponsable']; ?></td>
  </tr>
</table>

 <hr><h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder-plus"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="12" y1="11" x2="12" y2="17"></line><line x1="9" y1="14" x2="15" y2="14"></line></svg> Archivos Cargados</h5><hr>

<div class="row">
  <?php
  $directory="fotos/documentos/".$reg[0]['codpaciente'];
  if (is_dir($directory)) {
    $dirint = dir($directory);
    while (($archivo = $dirint->read()) !== false){
      if ($archivo != "." && $archivo != ".."){ ?>

      <div class="col-md-6">
          <a href="<?php echo $directory."/".$archivo; ?>" title="<?php echo "Archivo ".pathinfo($archivo, PATHINFO_FILENAME); ?>" download="<?php echo $archivo; ?>"><h5>Descargar (<span class="text-danger alert-link">Archivo</span>)</h5></a> 
      </div>
  <?php }
  }
  $dirint->close();
  } else { } ?>
</div>

<?php
} 
######################## MOSTRAR PACIENTES EN VENTANA MODAL ############################
?>












<?php
############################# MOSTRAR CITAS MEDICAS EN VENTANA MODAL ############################
if (isset($_GET['BuscaCitaMedicasModal']) && isset($_GET['codcita'])) { 

$reg = $new->CitasPorId();

?>
  
  <table class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['pnompaciente']." ".$reg[0]['snompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['papepaciente']." ".$reg[0]['sapepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
  <tr>
    <td><strong>Motivo de Cita:</strong> <?php echo $reg[0]['descripcion']; ?></td>
  </tr>
  <tr>
    <td><strong>Status de Cita:</strong> <?php if($reg[0]['statuscita']==1) { 
    echo "<span class='badge badge-info'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg> ATENDIDA</span>"; 
    } elseif($reg[0]['statuscita']==2) { 
    echo "<span class='badge badge-success'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-user-plus'><path d='M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2'></path><circle cx='8.5' cy='7' r='4'></circle><line x1='20' y1='8' x2='20' y2='14'></line><line x1='23' y1='11' x2='17' y2='11'></line></svg> PENDIENTE</span>";
    } elseif($reg[0]['statuscita']==3) { 
    echo "<span class='badge badge-warning'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-octagon'><polygon points='7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2'></polygon><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg> CANCELADA</span>";
    } elseif($reg[0]['statuscita']==4) {
    echo "<span class='badge badge-danger'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> VENCIDA</span>";
    } ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Cita:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechacita'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora de Cita:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fechacita'])); ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Ingreso:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['ingresocita'])); ?></td>
  </tr>
  <tr>
    <td><strong>Registrado por:</strong> 

      <?php echo $nombres = ($reg[0]['codigo'] == $reg[0]['codmedico'] ? $reg[0]['cedmedico']." : ".$reg[0]['nommedico']." (".$reg[0]['nomespecialidad'].")" : $reg[0]['dni']." : ".$reg[0]['nombres']); ?>

    </td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table>
  <?php
   } 
############################# MOSTRAR CITAS MEDICAS EN VENTANA MODAL ############################
?>

<?php 
########################### BUSQUEDA DE CITAS MEDICAS POR FECHAS ##########################
if (isset($_GET['BusquedaCitasMedicasxFechas']) && isset($_GET['codsucursal']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarCitasxFechas();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("CITASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("CITASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("CITASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Descripción</th>
                          <th>Fecha | Hora</th>
                          <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['pacientes']."</span>"; ?></td>
                    <td><?php echo $reg[$i]['descripcion']; ?></td>
                    <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacita'])); ?></td>
                    <td><?php if($reg[$i]['statuscita']==1) { 
                    echo "<span class='badge badge-info'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg> ATENDIDA</span>"; 
                    } elseif($reg[$i]['statuscita']==2) { 
                    echo "<span class='badge badge-success'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-user-plus'><path d='M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2'></path><circle cx='8.5' cy='7' r='4'></circle><line x1='20' y1='8' x2='20' y2='14'></line><line x1='23' y1='11' x2='17' y2='11'></line></svg> PENDIENTE</span>";
                    } elseif($reg[$i]['statuscita']==3) { 
                    echo "<span class='badge badge-warning'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-octagon'><polygon points='7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2'></polygon><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg> CANCELADA</span>";
                    } elseif($reg[$i]['statuscita']==4) {
                    echo "<span class='badge badge-danger'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> VENCIDA</span>";
                    } ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE CITAS MEDICAS POR FECHAS ##########################
?>

<?php 
########################### BUSQUEDA DE CITAS MEDICAS POR MEDICOS ##########################
if (isset($_GET['BusquedaCitasMedicasxMedico']) && isset($_GET['codsucursal']) && isset($_GET['codmedico']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$codmedico = limpiar($_GET['codmedico']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($codmedico=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE MEDICO PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarCitasxMedico();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("CITASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("CITASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("CITASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Descripción</th>
                          <th>Fecha | Hora</th>
                          <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['pacientes']."</span>"; ?></td>
                    <td><?php echo $reg[$i]['descripcion']; ?></td>
                    <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacita'])); ?></td>
                    <td><?php if($reg[$i]['statuscita']==1) { 
                    echo "<span class='badge badge-info'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg> ATENDIDA</span>"; 
                    } elseif($reg[$i]['statuscita']==2) { 
                    echo "<span class='badge badge-success'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-user-plus'><path d='M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2'></path><circle cx='8.5' cy='7' r='4'></circle><line x1='20' y1='8' x2='20' y2='14'></line><line x1='23' y1='11' x2='17' y2='11'></line></svg> PENDIENTE</span>";
                    } elseif($reg[$i]['statuscita']==3) { 
                    echo "<span class='badge badge-warning'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-octagon'><polygon points='7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2'></polygon><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg> CANCELADA</span>";
                    } elseif($reg[$i]['statuscita']==4) {
                    echo "<span class='badge badge-danger'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> VENCIDA</span>";
                    } ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE CITAS MEDICAS POR MEDICOS ##########################
?>

<?php 
########################### BUSQUEDA DE CITAS MEDICAS POR PACIENTES ##########################
if (isset($_GET['BusquedaCitasMedicasxPaciente']) && isset($_GET['codsucursal']) && isset($_GET['codpaciente'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$codpaciente = limpiar($_GET['codpaciente']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codpaciente=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR REALICE LA BÚSQUEDA DEL PACIENTE CORRECTAMENTE</center>";
   echo "</div>";   
   exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarCitasxPaciente();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['pacientes']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("CITASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("CITASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("CITASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Descripción</th>
                          <th>Fecha | Hora</th>
                          <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $reg[$i]['descripcion']; ?></td>
                    <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechacita'])); ?></td>
                    <td><?php if($reg[$i]['statuscita']==1) { 
                    echo "<span class='badge badge-info'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg> ATENDIDA</span>"; 
                    } elseif($reg[$i]['statuscita']==2) { 
                    echo "<span class='badge badge-success'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-user-plus'><path d='M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2'></path><circle cx='8.5' cy='7' r='4'></circle><line x1='20' y1='8' x2='20' y2='14'></line><line x1='23' y1='11' x2='17' y2='11'></line></svg> PENDIENTE</span>";
                    } elseif($reg[$i]['statuscita']==3) { 
                    echo "<span class='badge badge-warning'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-octagon'><polygon points='7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2'></polygon><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg> CANCELADA</span>";
                    } elseif($reg[$i]['statuscita']==4) {
                    echo "<span class='badge badge-danger'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> VENCIDA</span>";
                    } ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE CITAS MEDICAS POR PACIENTES ##########################
?>
















<?php
############################# BUSQUEDA APERTURAS EN PACIENTES ############################
if (isset($_GET['VerificaApertura']) && isset($_GET['codsucursal']) && isset($_GET['codpaciente']) && isset($_GET['codverifica'])) { 

$apertura = new Login();
$apertura = $apertura->BusquedaAperturas();

} 
############################# BUSQUEDA APERTURAS EN PACIENTES ############################
?>

<?php
######################## MOSTRAR APERTURA EN VENTANA MODAL ############################
if (isset($_GET['BuscaAperturasModal']) && isset($_GET['numero'])) { 
$reg = $new->AperturasPorId();
?>

  <table id="div3" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>

  <tr>
    <td><strong>Enfermedad:</strong> <?php echo $reg[0]['enfermedadpaciente'] == "" ? "**********" : nl2br($reg[0]['enfermedadpaciente']); ?></td>
  </tr>
 
  <tr>
    <td><strong>Motivo Consulta:</strong> <?php echo $reg[0]['motivoconsulta'] == "" ? "**********" : nl2br($reg[0]['motivoconsulta']); ?></td>
  </tr>

  <tr>
    <td><strong>Examen Fisico:</strong> <?php echo $reg[0]['examenfisico'] == "" ? "**********" : nl2br($reg[0]['examenfisico']); ?></td>
  </tr>

  <tr>
    <td><strong>Origen de Enfermedad:</strong> <?php echo $reg[0]['origenenfermedad']; ?></td>
  </tr>

  <tr>
    <td><strong>Presuntivo:</strong></td>
  </tr> 

  <tr>
    <td class="alert-link">
    <?php 
    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['dxpresuntivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciepresuntivo,$presuntivo) = explode("/",$explode[$cont]);

    if($idciepresuntivo==""){
      echo "***********";
    } else {
    echo $a++. "). ".$presuntivo."<br>";
    }
    endfor;
    ?>
     </td>
  </tr> 

  <tr>
    <td><strong>Definitivo:</strong></td>
  </tr> 

  <tr>
    <td class="alert-link">
    <?php 
    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['dxdefinitivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciedefinitivo,$definitivo) = explode("/",$explode[$cont]);

    if($idciedefinitivo==""){
      echo "***********";
    } else {
    echo $a++. "). ".$definitivo."<br>";
    }
    endfor;
    ?>
     </td>
  </tr>
  <tr>
    <td><strong>Fecha:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechaapertura'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fechaapertura'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table> 

<?php  
}  
######################## MOSTRAR APERTURA EN VENTANA MODAL ############################
?>


<?php
######################## MOSTRAR HOJA EVOLUTIVA EN VENTANA MODAL ############################
if (isset($_GET['BuscaHojasEvolutivasModal']) && isset($_GET['numero'])) { 
$reg = $new->HojasEvolutivasPorId();
?>

  <table id="div3" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
 
  <tr>
    <td><strong>Motivo Consulta:</strong> <?php echo $reg[0]['motivoconsulta'] == "" ? "**********" : nl2br($reg[0]['motivoconsulta']); ?></td>
  </tr>

  <tr>
    <td><strong>Examen Fisico:</strong> <?php echo $reg[0]['examenfisico'] == "" ? "**********" : nl2br($reg[0]['examenfisico']); ?></td>
  </tr>

  <tr>
    <td><strong>Atención o Procedimiento:</strong> <?php echo $reg[0]['atenproced'] == "" ? "**********" : nl2br($reg[0]['atenproced']); ?></td>
  </tr>

  <tr>
    <td><strong>Origen de Enfermedad:</strong> <?php echo $reg[0]['origenenfermedad']; ?></td>
  </tr>

  <tr>
    <td><strong>Presuntivo:</strong></td>
  </tr> 

  <tr>
    <td class="alert-link">
    <?php 
    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['dxpresuntivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciepresuntivo,$presuntivo) = explode("/",$explode[$cont]);

    if($idciepresuntivo==""){
      echo "***********";
    } else {
    echo $a++. "). ".$presuntivo."<br>";
    }
    endfor;
    ?>
     </td>
  </tr> 

  <tr>
    <td><strong>Definitivo:</strong></td>
  </tr> 

  <tr>
    <td class="alert-link">
    <?php 
    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['dxdefinitivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciedefinitivo,$definitivo) = explode("/",$explode[$cont]);

    if($idciedefinitivo==""){
      echo "***********";
    } else {
    echo $a++. "). ".$definitivo."<br>";
    }
    endfor;
    ?>
     </td>
  </tr>
  <tr>
    <td><strong>Fecha:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechahoja'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fechahoja'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table> 

<?php  
}  
######################## MOSTRAR HOJA EVOLUTIVA EN VENTANA MODAL ############################
?>





<?php
######################## MOSTRAR REMISIONES EN VENTANA MODAL ############################
if (isset($_GET['BuscaRemisionesModal']) && isset($_GET['numero'])) { 
$reg = $new->RemisionesPorId();
?>

  <table id="div2" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
 
  <tr>
    <td class="alert-link"><strong>Remisión:</strong> <?php echo nl2br($reg[0]['remision']); ?></td>
  </tr>

  <tr>
    <td><strong>Fecha:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fecharemision'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fecharemision'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table> 

<?php  
}  
######################## MOSTRAR REMISIONES EN VENTANA MODAL ############################
?>



<?php
######################## MOSTRAR FORMULAS MEDICAS EN VENTANA MODAL ############################
if (isset($_GET['BuscaFormulasMedicasModal']) && isset($_GET['numero'])) { 
$reg = $new->FormulasMedicasPorId();
?>

  <table id="div2" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
 
  <tr>
    <td><strong>Fórmulas Médicas:</strong></td>
  </tr> 

  <tr>
    <td class="alert-link">
    <?php 
    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['formulamedica'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idcieformula,$formula,$observacion) = explode("/",$explode[$cont]);

    if($idcieformula==""){
      echo "***********";
    } else {
    echo $a++. "). ".$formula."<br>".$observacion."<br>";
    }
    endfor;
    ?>
     </td>
  </tr> 

  <tr>
    <td><strong>Fecha:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechaformula'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fechaformula'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table> 

<?php  
}  
######################## MOSTRAR FORMULAS MEDICAS EN VENTANA MODAL ############################
?>



<?php
######################## MOSTRAR ORDENES MEDICAS EN VENTANA MODAL ############################
if (isset($_GET['BuscaOrdenesMedicasModal']) && isset($_GET['numero'])) { 
$reg = $new->OrdenesMedicasPorId();
?>

  <table id="div2" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
 
  <tr>
    <td><strong>Órdenes Médicas:</strong></td>
  </tr> 

  <tr>
    <td class="alert-link">
    <?php 
    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['ordenmedica'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idcieorden,$ordenes,$observacion) = explode("/",$explode[$cont]);

    if($idcieorden==""){
      echo "***********";
    } else {
    echo $a++. "). ".$ordenes."<br>".$observacion."<br>";
    }
    endfor;
    ?>
     </td>
  </tr> 

  <tr>
    <td><strong>Fecha:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechaorden'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fechaorden'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table> 

<?php  
}  
######################## MOSTRAR ORDENES MEDICAS EN VENTANA MODAL ############################
?>



<?php
######################## MOSTRAR FORMULAS TERAPIAS EN VENTANA MODAL ############################
if (isset($_GET['BuscaFormulasTerapiasModal']) && isset($_GET['numero'])) { 
$reg = $new->FormulasTerapiasPorId();
?>

  <table id="div1" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
 
  <tr>
    <td><strong>Terapias Respiratorias:</strong> <?php echo $reg[0]['terapiasrespiratorias']; ?></td>
  </tr>  
  <tr>
    <td><strong>Terapias Fisicas:</strong> <?php echo $reg[0]['terapiasfisicas']; ?></td>
  </tr>
  <tr>
    <td><strong>Micronebulizaciones:</strong> <?php echo $reg[0]['micronebulizaciones']; ?></td>
  </tr>

  <tr>
    <td><strong>Fecha:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechaformula'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fechaformula'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table> 

<?php  
}  
######################## MOSTRAR FORMULAS TERAPIAS EN VENTANA MODAL ############################
?>



<?php
######################## MOSTRAR SOLICITUD EXAMENES EN VENTANA MODAL ############################
if (isset($_GET['BuscaSolicitudExamenesModal']) && isset($_GET['numero'])) { 
$reg = $new->SolicitudExamenesPorId();
?>

  <table id="div1" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
 
  <tr>
    <td class="alert-link"><strong>DX:</strong> <?php echo strtoupper($reg[0]['codcie'].": ".$reg[0]['nombrecie']); ?></td>
  </tr>

  <tr>
    <td><strong>Fecha:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechasolicitud'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fechasolicitud'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table> 

<?php  
}  
######################## MOSTRAR SOLICITUD EXAMENES EN VENTANA MODAL ############################
?>


<?php 
########################### BUSQUEDA DE CONSULTORIOS POR FECHAS ##########################
if (isset($_GET['BusquedaConsultoriosxFechas']) && isset($_GET['busqueda']) && isset($_GET['url']) && isset($_GET['codsucursal']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 

$busqueda = limpiar($_GET['busqueda']);
$url = limpiar($_GET['url']);
$codsucursal = limpiar($_GET['codsucursal']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($busqueda=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE TIPO DE BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else if(decrypt($busqueda) == "a") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarAperturasxFechas();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("APERTURASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("APERTURASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("APERTURASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Enfermedad</th>
                          <th>Antecedentes</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['enfermedadpaciente']; ?></td>
                    <td><?php echo $reg[$i]['antecedentepaciente']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaapertura']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaapertura']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codapertura']); ?>&tipo=<?php echo encrypt("CONSTANCIA_APERTURA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php
} else if(decrypt($busqueda) == "b") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarHojasEvolutivasxFechas();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("HOJASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("HOJASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("HOJASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Motivo Consulta</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo $reg[$i]['motivoconsulta']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechahoja']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechahoja']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codhoja']); ?>&tipo=<?php echo encrypt("CONSTANCIA_HOJA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "c") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarRemisionesxFechas();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("REMISIONESXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("REMISIONESXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("REMISIONESXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Remisión</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo $reg[$i]['remision']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fecharemision']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fecharemision']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codremision']); ?>&tipo=<?php echo encrypt("CONSTANCIA_REMISION") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "d") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarFormulasMedicasxFechas();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("FORMULASMEDICASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("FORMULASMEDICASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("FORMULASMEDICASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Fórmula Médica</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){

$explode = explode(",,",$reg[$i]['formulamedica']);
//$reemplazo = str_replace(",,", "<br>", $reg[$i]['formulamedica']);
//$reemplazo_final = str_replace("/", ":", $reemplazo);
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

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
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codformulam']); ?>&tipo=<?php echo encrypt("CONSTANCIA_FORMULAMEDICA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "e") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarOrdenesMedicasxFechas();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("ORDENESMEDICASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("ORDENESMEDICASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("ORDENESMEDICASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Órden Médica</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){

$explode = explode(",,",$reg[$i]['ordenmedica']);
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

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
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codorden']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ORDENMEDICA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php  

} else if(decrypt($busqueda) == "f") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarFormulasTerapiasxFechas();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("FORMULASTERAPIASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("FORMULASTERAPIASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("FORMULASTERAPIASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Terapias Respiratorias<br><small class='text-danger alert-link'>(Series Dx)</small></th>
                          <th>Terapias Fisicas<br><small class='text-danger alert-link'>(Series Dx)</small></th>
                          <th>Micronebulizaciones<br><small class='text-danger alert-link'>(Cantidad)</small></th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['terapiasrespiratorias']; ?></td>
                    <td class="text-danger alert-link"><?php echo $reg[$i]['terapiasfisicas']; ?></td>
                    <td class="text-danger alert-link"><?php echo $reg[$i]['micronebulizaciones']; ?></td>

                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaformula']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaformula']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codformula']); ?>&tipo=<?php echo encrypt("CONSTANCIA_FORMULATERAPIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php  

} else if(decrypt($busqueda) == "g") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarSolicitudExamenesxFechas();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("SOLICITUDEXAMENESXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("SOLICITUDEXAMENESXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("SOLICITUDEXAMENESXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Nombre de Cie </th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['codcie'].": ".$reg[$i]['nombrecie']; ?></td>

                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechasolicitud']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechasolicitud']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codexamen']); ?>&tipo=<?php echo encrypt("CONSTANCIA_SOLICITUDEXAMEN") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> HA OCURRIDO UN ERROR EN LA BÚSQUEDA DE INFORMACIÓN</center>";
  echo "</div>";
  exit;

  } 
}
########################### BUSQUEDA DE CONSULTORIOS POR FECHAS ##########################
?>


<?php 
########################### BUSQUEDA DE CONSULTORIOS POR MEDICOS ##########################
if (isset($_GET['BusquedaConsultoriosxMedico']) && isset($_GET['busqueda']) && isset($_GET['url']) && isset($_GET['codsucursal']) && isset($_GET['codmedico']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 

$busqueda = limpiar($_GET['busqueda']);
$url = limpiar($_GET['url']);
$codsucursal = limpiar($_GET['codsucursal']);
$codmedico = limpiar($_GET['codmedico']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($busqueda=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE TIPO DE BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($codmedico=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE MEDICO PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else if(decrypt($busqueda) == "a") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarAperturasxMedico();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("APERTURASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("APERTURASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("APERTURASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Enfermedad</th>
                          <th>Antecedentes</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['enfermedadpaciente']; ?></td>
                    <td><?php echo $reg[$i]['antecedentepaciente']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaapertura']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaapertura']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codapertura']); ?>&tipo=<?php echo encrypt("CONSTANCIA_APERTURA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php
} else if(decrypt($busqueda) == "b") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarHojasEvolutivasxMedico();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("HOJASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("HOJASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("HOJASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Motivo Consulta</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo $reg[$i]['motivoconsulta']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechahoja']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechahoja']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codhoja']); ?>&tipo=<?php echo encrypt("CONSTANCIA_HOJA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "c") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarRemisionesxMedico();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("REMISIONESXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("REMISIONESXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("REMISIONESXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Remisión</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo $reg[$i]['remision']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fecharemision']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fecharemision']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codremision']); ?>&tipo=<?php echo encrypt("CONSTANCIA_REMISION") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "d") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarFormulasMedicasxMedico();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("FORMULASMEDICASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("FORMULASMEDICASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("FORMULASMEDICASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Fórmula Médica</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){

$explode = explode(",,",$reg[$i]['formulamedica']);
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

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
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codformulam']); ?>&tipo=<?php echo encrypt("CONSTANCIA_FORMULAMEDICA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "e") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarOrdenesMedicasxMedico();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("ORDENESMEDICASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("ORDENESMEDICASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("ORDENESMEDICASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Órden Médica</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){

$explode = explode(",,",$reg[$i]['ordenmedica']);
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

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
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codorden']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ORDENMEDICA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php  

} else if(decrypt($busqueda) == "f") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarFormulasTerapiasxMedico();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("FORMULASTERAPIASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("FORMULASTERAPIASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("FORMULASTERAPIASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Terapias Respiratorias<br><small class='text-danger alert-link'>(Series Dx)</small></th>
                          <th>Terapias Fisicas<br><small class='text-danger alert-link'>(Series Dx)</small></th>
                          <th>Micronebulizaciones<br><small class='text-danger alert-link'>(Cantidad)</small></th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['terapiasrespiratorias']; ?></td>
                    <td class="text-danger alert-link"><?php echo $reg[$i]['terapiasfisicas']; ?></td>
                    <td class="text-danger alert-link"><?php echo $reg[$i]['micronebulizaciones']; ?></td>

                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaformula']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaformula']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codformula']); ?>&tipo=<?php echo encrypt("CONSTANCIA_FORMULATERAPIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php  

} else if(decrypt($busqueda) == "g") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarSolicitudExamenesxMedico();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("SOLICITUDEXAMENESXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("SOLICITUDEXAMENESXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("SOLICITUDEXAMENESXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Nombre de Cie </th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['codcie'].": ".$reg[$i]['nombrecie']; ?></td>

                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechasolicitud']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechasolicitud']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codexamen']); ?>&tipo=<?php echo encrypt("CONSTANCIA_SOLICITUDEXAMEN") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> HA OCURRIDO UN ERROR EN LA BÚSQUEDA DE INFORMACIÓN</center>";
  echo "</div>";
  exit;

  } 
}
########################### BUSQUEDA DE CONSULTORIOS POR MEDICOS ##########################
?>

<?php 
########################### BUSQUEDA DE CONSULTORIOS POR PACIENTES ##########################
if (isset($_GET['BusquedaConsultoriosxPaciente']) && isset($_GET['busqueda']) && isset($_GET['url']) && isset($_GET['codsucursal']) && isset($_GET['codpaciente'])) { 

$busqueda = limpiar($_GET['busqueda']);
$url = limpiar($_GET['url']);
$codsucursal = limpiar($_GET['codsucursal']);
$codpaciente = limpiar($_GET['codpaciente']);
   
 if($busqueda=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE TIPO DE BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codpaciente=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR REALICE LA BÚSQUEDA DEL PACIENTE CORRECTAMENTE</center>";
   echo "</div>";   
   exit;

} else if(decrypt($busqueda) == "a") {
  
 $citas = new Login();
 $reg = $citas->BuscarAperturasxPaciente();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("APERTURASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("APERTURASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("APERTURASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Enfermedad</th>
                          <th>Antecedentes</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['enfermedadpaciente']; ?></td>
                    <td><?php echo $reg[$i]['antecedentepaciente']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaapertura']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaapertura']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codapertura']); ?>&tipo=<?php echo encrypt("CONSTANCIA_APERTURA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php
} else if(decrypt($busqueda) == "b") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarHojasEvolutivasxPaciente();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("HOJASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("HOJASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("HOJASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Procedimiento</th>
                          <th>Motivo Consulta</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo $reg[$i]['motivoconsulta']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechahoja']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechahoja']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codhoja']); ?>&tipo=<?php echo encrypt("CONSTANCIA_HOJA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "c") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarRemisionesxPaciente();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("REMISIONESXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("REMISIONESXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("REMISIONESXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Procedimiento</th>
                          <th>Remisión</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo $reg[$i]['remision']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fecharemision']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fecharemision']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codremision']); ?>&tipo=<?php echo encrypt("CONSTANCIA_REMISION") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "d") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarFormulasMedicasxPaciente();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("FORMULASMEDICASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("FORMULASMEDICASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("FORMULASMEDICASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Procedimiento</th>
                          <th>Fórmula Médica</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 

$explode = explode(",,",$reg[$i]['formulamedica']); 
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

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
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codformulam']); ?>&tipo=<?php echo encrypt("CONSTANCIA_FORMULAMEDICA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "e") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarOrdenesMedicasxPaciente();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("ORDENESMEDICASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("ORDENESMEDICASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("ORDENESMEDICASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Procedimiento</th>
                          <th>Órden Médica</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 

$explode = explode(",,",$reg[$i]['ordenmedica']); 
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

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
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codorden']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ORDENMEDICA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php  

} else if(decrypt($busqueda) == "f") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarFormulasTerapiasxPaciente();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("FORMULASTERAPIASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("FORMULASTERAPIASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("FORMULASTERAPIASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Terapias Respiratorias<br><small class='text-danger alert-link'>(Series Dx)</small></th>
                          <th>Terapias Fisicas<br><small class='text-danger alert-link'>(Series Dx)</small></th>
                          <th>Micronebulizaciones<br><small class='text-danger alert-link'>(Cantidad)</small></th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['terapiasrespiratorias']; ?></td>
                    <td class="text-danger alert-link"><?php echo $reg[$i]['terapiasfisicas']; ?></td>
                    <td class="text-danger alert-link"><?php echo $reg[$i]['micronebulizaciones']; ?></td>

                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaformula']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaformula']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codformula']); ?>&tipo=<?php echo encrypt("CONSTANCIA_FORMULATERAPIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php  

} else if(decrypt($busqueda) == "g") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarSolicitudExamenesxPaciente();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("SOLICITUDEXAMENESXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("SOLICITUDEXAMENESXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("SOLICITUDEXAMENESXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Cie </th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['codcie'].": ".$reg[$i]['nombrecie']; ?></td>

                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechasolicitud']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechasolicitud']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codexamen']); ?>&tipo=<?php echo encrypt("CONSTANCIA_SOLICITUDEXAMEN") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> HA OCURRIDO UN ERROR EN LA BÚSQUEDA DE INFORMACIÓN</center>";
  echo "</div>";
  exit;

  } 
}
########################### BUSQUEDA DE CONSULTORIOS POR PACIENTES ##########################
?>




















<?php
######################## MOSTRAR CRIOCAUTERIZACIONES EN VENTANA MODAL ############################
if (isset($_GET['BuscaCriocauterizacionModal']) && isset($_GET['numero'])) { 
$reg = $new->CriocauterizacionesPorId();
?>

  <table id="div3" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
 
  <tr>
    <td><strong>Motivo Consulta:</strong> <?php echo $reg[0]['motivoconsulta'] == "" ? "**********" : nl2br($reg[0]['motivoconsulta']); ?></td>
  </tr>

  <tr>
    <td><strong>Atención o Procedimiento:</strong> <?php echo $reg[0]['atenproced'] == "" ? "**********" : nl2br($reg[0]['atenproced']); ?></td>
  </tr>

  <tr>
    <td><strong>Origen de Enfermedad:</strong> <?php echo $reg[0]['origenenfermedad']; ?></td>
  </tr>

  <tr>
    <td><strong>Presuntivo:</strong></td>
  </tr> 

  <tr>
    <td class="alert-link">
    <?php 
    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['dxpresuntivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciepresuntivo,$presuntivo) = explode("/",$explode[$cont]);

    if($idciepresuntivo==""){
      echo "***********";
    } else {
    echo $a++. "). ".$presuntivo."<br>";
    }
    endfor;
    ?>
     </td>
  </tr> 

  <tr>
    <td><strong>Definitivo:</strong></td>
  </tr> 

  <tr>
    <td class="alert-link">
    <?php 
    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['dxdefinitivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciedefinitivo,$definitivo) = explode("/",$explode[$cont]);

    if($idciedefinitivo==""){
      echo "***********";
    } else {
    echo $a++. "). ".$definitivo."<br>";
    }
    endfor;
    ?>
     </td>
  </tr>
  <tr>
    <td><strong>Fecha:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechacriocauterizacion'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fechacriocauterizacion'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table> 

<?php  
}  
######################## MOSTRAR CRIOCAUTERIZACIONES EN VENTANA MODAL ############################
?>

<?php
############################# MOSTRAR COLPOSCOPIA EN VENTANA MODAL ############################
if (isset($_GET['BuscaColposcopiasModal']) && isset($_GET['numero'])) { 

$reg = $new->ColposcopiasPorId();
?>
  
  <table id="div2" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
  <tr>
    <td><strong>Impresión Diagnóstica:</strong> <?php echo $reg[0]['impresiondiagnostica'] == '' ? "************" : nl2br($reg[0]['impresiondiagnostica']); ?></td>
  </tr>
  <tr>
    <td><strong>Observaciones:</strong> <?php echo $reg[0]['observacionesimpresion'] == '' ? "************" : nl2br($reg[0]['observacionesimpresion']); ?></td>
  </tr>
  <tr>
    <td><strong>Sitio de la Biopsia:</strong> <?php echo $reg[0]['biopsia'] == '' ? "************" : nl2br($reg[0]['biopsia']); ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Colposcopia:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechacolposcopia'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora de Colposcopia:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fechacolposcopia'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table>
  <?php
   } 
############################# MOSTRAR COLPOSCOPIA EN VENTANA MODAL ############################
?>


<?php
############################# MOSTRAR ECOGRAFIAS EN VENTANA MODAL ############################
if (isset($_GET['BuscaEcografiasModal']) && isset($_GET['numero'])) { 

$reg = $new->EcografiasPorId();
?>
  
  <table id="div3" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
  <tr>
    <td><strong>Procedimiento Ecográfico:</strong> <?php echo $reg[0]['procedimiento'] == '' ? "************" : nl2br($reg[0]['procedimiento']); ?></td>
  </tr>
  <tr>
    <td><strong>Descripción Ecográfica:</strong> <?php echo $reg[0]['diagnostico'] == '' ? "************" : nl2br($reg[0]['diagnostico']); ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Ecografía:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechaecografia'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora de Ecografía:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fechaecografia'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table>
  <?php
   } 
############################# MOSTRAR ECOGRAFIAS EN VENTANA MODAL ############################
?>

<?php 
########################### BUSQUEDA DE GINECOLOGIAS POR FECHAS ##########################
if (isset($_GET['BusquedaGinecologiasxFechas']) && isset($_GET['busqueda']) && isset($_GET['url']) && isset($_GET['codsucursal']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 

$busqueda = limpiar($_GET['busqueda']);
$url = limpiar($_GET['url']);
$codsucursal = limpiar($_GET['codsucursal']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($busqueda=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE TIPO DE BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else if(decrypt($busqueda) == "a") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarAperturasxFechas();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("APERTURASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("APERTURASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("APERTURASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Enfermedad</th>
                          <th>Antecedentes</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['enfermedadpaciente']; ?></td>
                    <td><?php echo $reg[$i]['antecedentepaciente']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaapertura']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaapertura']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codapertura']); ?>&tipo=<?php echo encrypt("CONSTANCIA_APERTURA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php
} else if(decrypt($busqueda) == "b") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarHojasEvolutivasxFechas();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("HOJASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("HOJASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("HOJASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Motivo Consulta</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo $reg[$i]['motivoconsulta']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechahoja']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechahoja']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codhoja']); ?>&tipo=<?php echo encrypt("CONSTANCIA_HOJA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "c") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarRemisionesxFechas();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("REMISIONESXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("REMISIONESXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("REMISIONESXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Remisión</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo $reg[$i]['remision']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fecharemision']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fecharemision']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codremision']); ?>&tipo=<?php echo encrypt("CONSTANCIA_REMISION") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "d") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarFormulasMedicasxFechas();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("FORMULASMEDICASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("FORMULASMEDICASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("FORMULASMEDICASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Fórmula Médica</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){

$explode = explode(",,",$reg[$i]['formulamedica']);
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

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
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codformulam']); ?>&tipo=<?php echo encrypt("CONSTANCIA_FORMULAMEDICA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "e") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarOrdenesMedicasxFechas();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("ORDENESMEDICASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("ORDENESMEDICASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("ORDENESMEDICASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Órden Médica</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){

$explode = explode(",,",$reg[$i]['ordenmedica']);
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

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
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codorden']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ORDENMEDICA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php  

} else if(decrypt($busqueda) == "f") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarCriocauterizacionesxFechas();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("CRIOCAUTERIZACIONESXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("CRIOCAUTERIZACIONESXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("CRIOCAUTERIZACIONESXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Motivo de Consulta</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['motivoconsulta']; ?></td>

                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechacriocauterizacion']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechacriocauterizacion']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codcriocauterizacion']); ?>&tipo=<?php echo encrypt("CONSTANCIA_CRIOCAUTERIZACION") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php  

} else if(decrypt($busqueda) == "g") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarColposcopiasxFechas();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("COLPOSCOPIASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("COLPOSCOPIASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("COLPOSCOPIASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Impresión Diagnóstica</th>
                          <th>Sitio de Biopsia</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['impresiondiagnostica'] == '' ? "************" : $reg[$i]['impresiondiagnostica']; ?></td>
                    <td><?php echo $reg[$i]['biopsia'] == '' ? "************" : $reg[$i]['biopsia']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechacolposcopia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechacolposcopia']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codcolposcopia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_COLPOSCOPIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php  

} else if(decrypt($busqueda) == "h") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarEcografiasxFechas();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("ECOGRAFIASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("ECOGRAFIASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("ECOGRAFIASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento Ecográfico</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaecografia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaecografia']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codecografia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ECOGRAFIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> HA OCURRIDO UN ERROR EN LA BÚSQUEDA DE INFORMACIÓN</center>";
  echo "</div>";
  exit;

  } 
}
########################### BUSQUEDA DE GINECOLOGIAS POR FECHAS ##########################
?>


<?php 
########################### BUSQUEDA DE GINECOLOGIAS POR MEDICOS ##########################
if (isset($_GET['BusquedaGinecologiasxMedico']) && isset($_GET['busqueda']) && isset($_GET['url']) && isset($_GET['codsucursal']) && isset($_GET['codmedico']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 

$busqueda = limpiar($_GET['busqueda']);
$url = limpiar($_GET['url']);
$codsucursal = limpiar($_GET['codsucursal']);
$codmedico = limpiar($_GET['codmedico']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($busqueda=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE TIPO DE BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($codmedico=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE MEDICO PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else if(decrypt($busqueda) == "a") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarAperturasxMedico();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("APERTURASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("APERTURASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("APERTURASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Enfermedad</th>
                          <th>Antecedentes</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['enfermedadpaciente']; ?></td>
                    <td><?php echo $reg[$i]['antecedentepaciente']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaapertura']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaapertura']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codapertura']); ?>&tipo=<?php echo encrypt("CONSTANCIA_APERTURA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php
} else if(decrypt($busqueda) == "b") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarHojasEvolutivasxMedico();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("HOJASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("HOJASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("HOJASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Motivo Consulta</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo $reg[$i]['motivoconsulta']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechahoja']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechahoja']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codhoja']); ?>&tipo=<?php echo encrypt("CONSTANCIA_HOJA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "c") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarRemisionesxMedico();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("REMISIONESXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("REMISIONESXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("REMISIONESXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Remisión</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo $reg[$i]['remision']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fecharemision']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fecharemision']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codremision']); ?>&tipo=<?php echo encrypt("CONSTANCIA_REMISION") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "d") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarFormulasMedicasxMedico();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("FORMULASMEDICASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("FORMULASMEDICASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("FORMULASMEDICASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Fórmula Médica</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){

$explode = explode(",,",$reg[$i]['formulamedica']);
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

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
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codformulam']); ?>&tipo=<?php echo encrypt("CONSTANCIA_FORMULAMEDICA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php  

} else if(decrypt($busqueda) == "e") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarOrdenesMedicasxMedico();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("ORDENESMEDICASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("ORDENESMEDICASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("ORDENESMEDICASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento</th>
                          <th>Órden Médica</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){

$explode = explode(",,",$reg[$i]['ordenmedica']);
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

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
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codorden']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ORDENMEDICA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php  

} else if(decrypt($busqueda) == "f") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarCriocauterizacionesxMedico();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("CRIOCAUTERIZACIONESXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("CRIOCAUTERIZACIONESXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("CRIOCAUTERIZACIONESXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Motivo de Consulta</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['motivoconsulta']; ?></td>

                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechacriocauterizacion']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechacriocauterizacion']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codcriocauterizacion']); ?>&tipo=<?php echo encrypt("CONSTANCIA_FORMULATERAPIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php   

} else if(decrypt($busqueda) == "g") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarColposcopiasxMedico();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("COLPOSCOPIASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("COLPOSCOPIASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("COLPOSCOPIASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Impresión Diagnóstica</th>
                          <th>Sitio de Biopsia</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                     <td><?php echo $reg[$i]['impresiondiagnostica'] == '' ? "************" : $reg[$i]['impresiondiagnostica']; ?></td>
                    <td><?php echo $reg[$i]['biopsia'] == '' ? "************" : $reg[$i]['biopsia']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechacolposcopia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechacolposcopia']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codcolposcopia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_COLPOSCOPIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php   

} else if(decrypt($busqueda) == "h") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarEcografiasxMedico();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("ECOGRAFIASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("ECOGRAFIASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("ECOGRAFIASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Procedimiento Ecográfico</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaecografia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaecografia']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codecografia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ECOGRAFIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> HA OCURRIDO UN ERROR EN LA BÚSQUEDA DE INFORMACIÓN</center>";
  echo "</div>";
  exit;

  } 
}
########################### BUSQUEDA DE GINECOLOGIAS POR MEDICOS ##########################
?>

<?php 
########################### BUSQUEDA DE GINECOLOGIAS POR PACIENTES ##########################
if (isset($_GET['BusquedaGinecologiasxPaciente']) && isset($_GET['busqueda']) && isset($_GET['url']) && isset($_GET['codsucursal']) && isset($_GET['codpaciente'])) { 

$busqueda = limpiar($_GET['busqueda']);
$url = limpiar($_GET['url']);
$codsucursal = limpiar($_GET['codsucursal']);
$codpaciente = limpiar($_GET['codpaciente']);
   
 if($busqueda=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE TIPO DE BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codpaciente=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR REALICE LA BÚSQUEDA DEL PACIENTE CORRECTAMENTE</center>";
   echo "</div>";   
   exit;

} else if(decrypt($busqueda) == "a") {
  
 $citas = new Login();
 $reg = $citas->BuscarAperturasxPaciente();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("APERTURASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("APERTURASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("APERTURASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Enfermedad</th>
                          <th>Antecedentes</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['enfermedadpaciente']; ?></td>
                    <td><?php echo $reg[$i]['antecedentepaciente']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaapertura']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaapertura']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codapertura']); ?>&tipo=<?php echo encrypt("CONSTANCIA_APERTURA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php
} else if(decrypt($busqueda) == "b") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarHojasEvolutivasxPaciente();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("HOJASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("HOJASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("HOJASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Procedimiento</th>
                          <th>Motivo Consulta</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo $reg[$i]['motivoconsulta']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechahoja']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechahoja']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codhoja']); ?>&tipo=<?php echo encrypt("CONSTANCIA_HOJA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "c") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarRemisionesxPaciente();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("REMISIONESXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("REMISIONESXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("REMISIONESXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Procedimiento</th>
                          <th>Remisión</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo $reg[$i]['remision']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fecharemision']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fecharemision']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codremision']); ?>&tipo=<?php echo encrypt("CONSTANCIA_REMISION") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "d") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarFormulasMedicasxPaciente();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("FORMULASMEDICASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("FORMULASMEDICASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("FORMULASMEDICASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Procedimiento</th>
                          <th>Fórmula Médica</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 

$explode = explode(",,",$reg[$i]['formulamedica']); 
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

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
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codformulam']); ?>&tipo=<?php echo encrypt("CONSTANCIA_FORMULAMEDICA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else if(decrypt($busqueda) == "e") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarOrdenesMedicasxPaciente();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("ORDENESMEDICASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("ORDENESMEDICASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("ORDENESMEDICASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Procedimiento</th>
                          <th>Órden Médica</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 

$explode = explode(",,",$reg[$i]['ordenmedica']); 
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

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
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codorden']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ORDENMEDICA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php  

} else if(decrypt($busqueda) == "f") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarCriocauterizacionesxPaciente();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("CRIOCAUTERIZACIONESXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("CRIOCAUTERIZACIONESXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("CRIOCAUTERIZACIONESXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Motivo de Consulta</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['motivoconsulta']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechacriocauterizacion']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechacriocauterizacion']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codcriocauterizacion']); ?>&tipo=<?php echo encrypt("CONSTANCIA_CRIOCAUTERIZACION") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php  

} else if(decrypt($busqueda) == "g") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarColposcopiasxPaciente();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("COLPOSCOPIASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("COLPOSCOPIASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("COLPOSCOPIASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Impresión Diagnóstica</th>
                          <th>Sitio de Biopsia</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['impresiondiagnostica'] == '' ? "************" : $reg[$i]['impresiondiagnostica']; ?></td>
                    <td><?php echo $reg[$i]['biopsia'] == '' ? "************" : $reg[$i]['biopsia']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechacolposcopia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechacolposcopia']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codcolposcopia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_COLPOSCOPIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php  

} else if(decrypt($busqueda) == "h") {
  
 $reporte = new Login();
 $reg = $reporte->BuscarEcografiasxPaciente();

?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("ECOGRAFIASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("ECOGRAFIASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&url=<?php echo $url; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("ECOGRAFIASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Procedimiento Ecográfico</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['procedimiento']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaecografia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaecografia']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codecografia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ECOGRAFIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

<?php 

} else {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> HA OCURRIDO UN ERROR EN LA BÚSQUEDA DE INFORMACIÓN</center>";
  echo "</div>";
  exit;

  } 
}
########################### BUSQUEDA DE ECOGRAFIAS POR PACIENTES ##########################
?>










<?php
############################# MOSTRAR EXAMENES DE LABORATORIOS EN VENTANA MODAL ############################
if (isset($_GET['BuscaLaboratoriosModal']) && isset($_GET['numero'])) { 

$reg = $new->LaboratoriosPorId();
?>
  
  <table id="div2" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
  <tr>
    <td><strong>Hematologia:</strong> <?php echo $reg[0]['observacioneshematologia'] == '' ? "************" : nl2br($reg[0]['observacioneshematologia']); ?></td>
  </tr>
  <tr>
    <td><strong>Química Sanguinea:</strong> <?php echo $reg[0]['observacionesquimica'] == '' ? "************" : nl2br($reg[0]['observacionesquimica']); ?></td>
  </tr>
  <tr>
    <td><strong>Uroanálisis:</strong> <?php echo $reg[0]['observacionesuroanalisis'] == '' ? "************" : nl2br($reg[0]['observacionesuroanalisis']); ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Examen:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechalaboratorio'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora de Examen:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fechalaboratorio'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table>
  <?php
   } 
############################# MOSTRAR EXAMENES DE LABORATORIOS EN VENTANA MODAL ############################
?>

<?php 
########################### BUSQUEDA DE EXAMENES DE LABORATORIOS POR FECHAS ##########################
if (isset($_GET['BusquedaLaboratoriosxFechas']) && isset($_GET['codsucursal']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarLaboratoriosxFechas();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("LABORATORIOSXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("LABORATORIOSXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("LABORATORIOSXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Hematologia</th>
                          <th>Química Sanguinea</th>
                          <th>Uroanálisis</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['observacioneshematologia'] == '' ? "************" : $reg[$i]['observacioneshematologia']; ?></td>
                    <td><?php echo $reg[$i]['observacionesquimica'] == '' ? "************" : $reg[$i]['observacionesquimica']; ?></td>
                    <td><?php echo $reg[$i]['observacionesuroanalisis'] == '' ? "************" : $reg[$i]['observacionesuroanalisis']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechalaboratorio']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechalaboratorio']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codlaboratorio']); ?>&tipo=<?php echo encrypt("CONSTANCIA_LABORATORIO") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE EXAMENES DE LABORATORIOS POR FECHAS ##########################
?>

<?php 
########################### BUSQUEDA DE EXAMENES DE LABORATORIOS POR MEDICOS ##########################
if (isset($_GET['BusquedaLaboratoriosxMedico']) && isset($_GET['codsucursal']) && isset($_GET['codmedico']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$codmedico = limpiar($_GET['codmedico']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($codmedico=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE MEDICO PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarLaboratoriosxMedico();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("LABORATORIOSXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("LABORATORIOSXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("LABORATORIOSXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Hematologia</th>
                          <th>Química Sanguinea</th>
                          <th>Uroanálisis</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['observacioneshematologia'] == '' ? "************" : $reg[$i]['observacioneshematologia']; ?></td>
                    <td><?php echo $reg[$i]['observacionesquimica'] == '' ? "************" : $reg[$i]['observacionesquimica']; ?></td>
                    <td><?php echo $reg[$i]['observacionesuroanalisis'] == '' ? "************" : $reg[$i]['observacionesuroanalisis']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechalaboratorio']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechalaboratorio']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codlaboratorio']); ?>&tipo=<?php echo encrypt("CONSTANCIA_LABORATORIO") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE EXAMENES DE LABORATORIOS POR MEDICOS ##########################
?>

<?php 
########################### BUSQUEDA DE EXAMENES DE LABORATORIOS POR PACIENTES ##########################
if (isset($_GET['BusquedaLaboratoriosxPaciente']) && isset($_GET['codsucursal']) && isset($_GET['codpaciente'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$codpaciente = limpiar($_GET['codpaciente']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codpaciente=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR REALICE LA BÚSQUEDA DEL PACIENTE CORRECTAMENTE</center>";
   echo "</div>";   
   exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarLaboratoriosxPaciente();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("LABORATORIOSXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("LABORATORIOSXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("LABORATORIOSXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Hematologia</th>
                          <th>Química Sanguinea</th>
                          <th>Uroanálisis</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['observacioneshematologia'] == '' ? "************" : $reg[$i]['observacioneshematologia']; ?></td>
                    <td><?php echo $reg[$i]['observacionesquimica'] == '' ? "************" : $reg[$i]['observacionesquimica']; ?></td>
                    <td><?php echo $reg[$i]['observacionesuroanalisis'] == '' ? "************" : $reg[$i]['observacionesuroanalisis']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechalaboratorio']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechalaboratorio']))."</span>"; ?></td>
                    <td><a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codlaboratorio']); ?>&tipo=<?php echo encrypt("CONSTANCIA_LABORATORIO") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE EXAMENES DE LABORATORIOS POR PACIENTES ##########################
?>
















<?php
############################# MOSTRAR RADIOLOGIAS EN VENTANA MODAL ############################
if (isset($_GET['BuscaRadiologiasModal']) && isset($_GET['numero'])) { 

$reg = $new->RadiologiasPorId();
?>
  
  <table id="div2" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
  <tr>
    <td><strong>Lectura Rx:</strong> <?php echo $lectura = ( $reg[0]['lectura'] == 1 ? "<span class='badge badge-info'><i class='fa fa-check'></i> SI</span>" : "<span class='badge badge-danger'><i class='fa fa-times'></i> NO</span>"); ?></td>
  </tr>
  <tr>
    <td><strong>Tipo de Estudio:</strong> <?php echo $reg[0]['tipoestudio'] == '' ? "************" : nl2br($reg[0]['tipoestudio']); ?></td>
  </tr>
  <tr>
    <td><strong>Diagnóstico:</strong> <?php echo $reg[0]['diagnostico'] == '' ? "************" : nl2br($reg[0]['diagnostico']); ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Radiología:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fecharadiologia'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora de Radiología:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fecharadiologia'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table>
  <?php
   } 
############################# MOSTRAR RADIOLOGIAS EN VENTANA MODAL ############################
?>

<?php 
########################### BUSQUEDA DE RADIOLOGIAS POR FECHAS ##########################
if (isset($_GET['BusquedaRadiologiasxFechas']) && isset($_GET['codsucursal']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 
$codsucursal = limpiar($_GET['codsucursal']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarRadiologiasxFechas();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("RADIOLOGIASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("RADIOLOGIASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("RADIOLOGIASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Lectura Rx</th>
                          <th>Tipo de Estudio</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

<td><?php echo $lectura = ( $reg[$i]['lectura'] == 1 ? "<span class='badge badge-info'><i class='fa fa-check'></i> SI</span>" : "<span class='badge badge-danger'><i class='fa fa-times'></i> NO</span>"); ?></td>

                    <td><?php echo $reg[$i]['tipoestudio'] == '' ? "************" : $reg[$i]['tipoestudio']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fecharadiologia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fecharadiologia']))."</span>"; ?></td>

                    <td><?php if($reg[$i]['lectura'] == 1){ ?>
                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codradiologia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_RADIOLOGIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    <?php } ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE RADIOLOGIAS POR FECHAS ##########################
?>

<?php 
########################### BUSQUEDA DE RADIOLOGIAS POR MEDICOS ##########################
if (isset($_GET['BusquedaRadiologiasxMedico']) && isset($_GET['codsucursal']) && isset($_GET['codmedico']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$codmedico = limpiar($_GET['codmedico']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($codmedico=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE MEDICO PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarRadiologiasxMedico();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("RADIOLOGIASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("RADIOLOGIASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("RADIOLOGIASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Lectura Rx</th>
                          <th>Tipo de Estudio</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

<td><?php echo $lectura = ( $reg[$i]['lectura'] == 1 ? "<span class='badge badge-info'><i class='fa fa-check'></i> SI</span>" : "<span class='badge badge-danger'><i class='fa fa-times'></i> NO</span>"); ?></td>

                    <td><?php echo $reg[$i]['tipoestudio'] == '' ? "************" : $reg[$i]['tipoestudio']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fecharadiologia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fecharadiologia']))."</span>"; ?></td>

                    <td><?php if($reg[$i]['lectura'] == 1){ ?>
                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codradiologia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_RADIOLOGIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    <?php } ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE RADIOLOGIAS POR MEDICOS ##########################
?>

<?php 
########################### BUSQUEDA DE RADIOLOGIAS POR PACIENTES ##########################
if (isset($_GET['BusquedaRadiologiasxPaciente']) && isset($_GET['codsucursal']) && isset($_GET['codpaciente'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$codpaciente = limpiar($_GET['codpaciente']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codpaciente=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR REALICE LA BÚSQUEDA DEL PACIENTE CORRECTAMENTE</center>";
   echo "</div>";   
   exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarRadiologiasxPaciente();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("RADIOLOGIASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("RADIOLOGIASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("RADIOLOGIASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Lectura Rx</th>
                          <th>Tipo de Estudio</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

<td><?php echo $lectura = ( $reg[$i]['lectura'] == 1 ? "<span class='badge badge-info'><i class='fa fa-check'></i> SI</span>" : "<span class='badge badge-danger'><i class='fa fa-times'></i> NO</span>"); ?></td>

                    <td><?php echo $reg[$i]['tipoestudio'] == '' ? "************" : $reg[$i]['tipoestudio']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fecharadiologia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fecharadiologia']))."</span>"; ?></td>

                    <td><?php if($reg[$i]['lectura'] == 1){ ?>
                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codradiologia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_RADIOLOGIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    <?php } ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE RADIOLOGIAS POR PACIENTES ##########################
?>



















<?php
############################# MOSTRAR FORMULARIO DE TERAPIAS ############################
if (isset($_GET['BuscaFormularioTerapias'])) { 
?>

<input type="hidden" name="proceso" id="proceso" value="save"/>
<hr><h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Diagnóstico de Terapia</h5><hr>

    <div class="row">
        <div class="col-md-12"> 
            <div class="form-group has-feedback2"> 
                <label class="control-label">Diagnóstico: <span class="symbol required"></span></label>
                <textarea class="form-control" type="text" name="diagnostico" id="diagnostico" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Diagnóstico" rows="6"></textarea>
            </div> 
        </div>
    </div>

    <hr><h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Ciclos de Terapias</h5><hr>

    <div class="row">
        <div class="col-md-12"> 
            <div class="form-group has-feedback">
            <table width="100%" id="tabla6">
<a class="btn btn-success rounded-circle" onClick="AddTerapia()" title="Agregar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>&nbsp;
<a class="btn btn-danger rounded-circle" onClick="DeleteTerapia()" title="Quitar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a><br></br>                
            <tr> 
            <td>

            <div class="row">    
              <div class="col-md-6">
                <div class="form-group has-feedback2"> 
                  <label class="control-label">Atención/Actividad y/o Tratamiento: <span class="symbol required"></span></label>
                  <textarea class="form-control" type="text" name="tratamiento[]" id="tratamiento" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Atención/Actividad y/o Tratamiento" title="Ingrese Atención/Actividad y/o Tratamiento" rows="2" required="" aria-required="true"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-feedback2"> 
                  <label class="control-label">Fecha / Hora de Terapia: <span class="symbol required"></span></label>
                  <input style="color:#000;font-weight:bold;" type="text" class="form-control calendario_terapia" name="fechaciclo[]" id="fechaciclo" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha de Terapia" title="Ingrese Fecha de Terapia" autocomplete="off" value="" required="" aria-required="true"/>
                </div>
              </div>
            </div>

            </td>
            </tr>
            <input type="hidden" name="var_cont">
            </table>
            </div> 
        </div>
    </div>

    <hr><h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Culminación de Terapias</h5><hr>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Culminar Terapias: <span class="symbol required"></span></label>
                <br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="SI" name="ciclo" value="1" onClick="CicloTerapia();" class="custom-control-input">
                    <label class="custom-control-label text-dark alert-link" for="SI">SI</label>
                </div><br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="NO" name="ciclo" value="2" onClick="CicloTerapia();" checked="checked" class="custom-control-input">
                    <label class="custom-control-label text-dark alert-link" for="NO">NO</label>
                </div>
            </div>
        </div>

        <div class="col-md-10"> 
            <div class="form-group has-feedback2"> 
                <label class="control-label">Observaciones: <span class="symbol required"></span></label>
                <textarea class="form-control" type="text" name="observaciones" id="observaciones" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observaciones" rows="3" disabled=""></textarea>
            </div> 
        </div>
    </div>

    <div class="text-right">
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Guardar</button>
<button class="btn btn-dark" type="reset"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Limpiar</button>
    </div> 

<?php
} 
############################# MOSTRAR FORMULARIO DE TERAPIAS ############################
?>

<?php
############################# MOSTRAR DETALLES DE CICLOS DE TERAPIAS ############################
if (isset($_GET['BuscaCicloTerapias']) && isset($_GET['codsucursal']) && isset($_GET['codpaciente'])) { 

$ciclo = new Login();
$ciclo = $ciclo->BusquedaTerapiasAbiertas();

if($ciclo[0]['codterapia']==""){

  //echo "<hr><div class='alert alert-danger'>";
  //echo "<center> ESTE PACIENTE NO TIENE TERAPIAS EN PROCESO, REALICE UN NUEVO REGISTRO POR FAVOR</center>";
  //echo "</div>";    
  //exit;
?>

<input type="hidden" name="proceso" id="proceso" value="save"/>
<hr><h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Diagnóstico de Terapia</h5><hr>

    <div class="row">
        <div class="col-md-12"> 
            <div class="form-group has-feedback2"> 
                <label class="control-label">Diagnóstico: <span class="symbol required"></span></label>
                <textarea class="form-control" type="text" name="diagnostico" id="diagnostico" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Diagnóstico" rows="6"></textarea>
            </div> 
        </div>
    </div>

    <hr><h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Ciclos de Terapias</h5><hr>

    <div class="row">
        <div class="col-md-12"> 
            <div class="form-group has-feedback">
            <table width="100%" id="tabla6">
<a class="btn btn-success rounded-circle" onClick="AddTerapia()" title="Agregar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>&nbsp;
<a class="btn btn-danger rounded-circle" onClick="DeleteTerapia()" title="Quitar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a><br></br>                
            <tr> 
            <td>

            <div class="row">    
              <div class="col-md-6">
                <div class="form-group has-feedback2"> 
                  <label class="control-label">Atención/Actividad y/o Tratamiento: <span class="symbol required"></span></label>
                  <textarea class="form-control" type="text" name="tratamiento[]" id="tratamiento" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Atención/Actividad y/o Tratamiento" title="Ingrese Atención/Actividad y/o Tratamiento" rows="2" required="" aria-required="true"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-feedback2"> 
                  <label class="control-label">Fecha / Hora de Terapia: <span class="symbol required"></span></label>
                  <input style="color:#000;font-weight:bold;" type="text" class="form-control calendario_terapia" name="fechaciclo[]" id="fechaciclo" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha de Terapia" title="Ingrese Fecha de Terapia" autocomplete="off" value="" required="" aria-required="true"/>
                </div>
              </div>
            </div>

            </td>
            </tr>
            <input type="hidden" name="var_cont">
            </table>
            </div> 
        </div>
    </div>

    <hr><h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Culminación de Terapias</h5><hr>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Culminar Terapias: <span class="symbol required"></span></label>
                <br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="SI" name="ciclo" value="1" onClick="CicloTerapia();" class="custom-control-input">
                    <label class="custom-control-label text-dark alert-link" for="SI">SI</label>
                </div><br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="NO" name="ciclo" value="2" onClick="CicloTerapia();" checked="checked" class="custom-control-input">
                    <label class="custom-control-label text-dark alert-link" for="NO">NO</label>
                </div>
            </div>
        </div>

        <div class="col-md-10"> 
            <div class="form-group has-feedback2"> 
                <label class="control-label">Observaciones: <span class="symbol required"></span></label>
                <textarea class="form-control" type="text" name="observaciones" id="observaciones" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observaciones" rows="3" disabled=""></textarea>
            </div> 
        </div>
    </div>

    <div class="text-right">
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Guardar</button>
<button class="btn btn-dark" type="reset"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Limpiar</button>
    </div> 

<?php } else { ?>
  
    <input type="hidden" name="proceso" id="proceso" value="agregar"/>
    <hr><h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Diagnóstico de Terapia</h5><hr>

    <div class="row">
        <div class="col-md-12"> 
            <div class="form-group has-feedback2"> 
                <label class="control-label">Diagnóstico: <span class="symbol required"></span></label>
                <input type="hidden" name="codterapia" id="codterapia" value="<?php echo encrypt($ciclo[0]['codterapia']); ?>" />
                <textarea class="form-control" type="text" name="diagnostico" id="diagnostico" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Diagnóstico" rows="6"><?php echo nl2br($ciclo[0]['diagnostico']); ?></textarea>
            </div> 
        </div>
    </div>

    <hr><h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Ciclos Agregados</h5><hr>

    <div class="row">
        <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">

            <div id="detalles_terapias"><!-- detalles terapias -->

              <table id="html5-extension" class="table" style="width:100%">
                <thead>
                <tr>
                    <th>N°</th>
                    <th>Atención/Actividad y/o Tratamiento</th>
                    <th>Fecha de Terapia</th>
                    <th>Hora de Terapia</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($ciclo[0]['detalles_terapias'])){

                $explode = explode(",,",$ciclo[0]['detalles_terapias']);
                $a=1;
                for($cont=0; $cont<COUNT($explode); $cont++):
                list($iddetalleterapia,$tratamiento,$fechaciclo) = explode("/",$explode[$cont]);
                ?>
                <tr>
                    <td><?php echo $a++; ?></td>
                    <td class="text-dark alert-link"><?php echo nl2br($tratamiento); ?></td>
                    <td><?php echo date("d-m-Y",strtotime($fechaciclo)); ?></td>
                    <td><?php echo date("H:i",strtotime($fechaciclo)); ?></td>
                    <td><span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarCicloTerapia('<?php echo encrypt($ciclo[0]["codterapia"]); ?>','<?php echo encrypt($iddetalleterapia); ?>','<?php echo encrypt("CICLO_TERAPIAS") ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span></td>
                </tr>
                <?php endfor; } ?>
              </tbody>
            </table>

          </div><!-- detalles terapias -->

        </div>
    </div> 

    <hr><h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Ciclos de Terapias</h5><hr>

    <div class="row">
        <div class="col-md-12"> 
            <div class="form-group has-feedback">
            <table width="100%" id="tabla6">
<a class="btn btn-success rounded-circle" onClick="AddTerapia()" title="Agregar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>&nbsp;
<a class="btn btn-danger rounded-circle" onClick="DeleteTerapia()" title="Quitar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a><br></br>                
            <tr> 
            <td>

            <div class="row">    
              <div class="col-md-6">
                <div class="form-group has-feedback2"> 
                  <label class="control-label">Atención/Actividad y/o Tratamiento: <span class="symbol required"></span></label>
                  <textarea class="form-control" type="text" name="tratamiento[]" id="tratamiento" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Atención/Actividad y/o Tratamiento" title="Ingrese Atención/Actividad y/o Tratamiento" rows="2" required="" aria-required="true"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-feedback2"> 
                  <label class="control-label">Fecha / Hora de Terapia: <span class="symbol required"></span></label>
                  <input style="color:#000;font-weight:bold;" type="text" class="form-control calendario_terapia" name="fechaciclo[]" id="fechaciclo" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha de Terapia" title="Ingrese Fecha de Terapia" autocomplete="off" required="" aria-required="true"/>
                </div>
              </div>
            </div> 

            </td>
            </tr>
            <input type="hidden" name="var_cont">
            </table>
            </div> 
        </div>
    </div>

    <hr><h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Culminación de Terapias</h5><hr>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Culminar Terapias: <span class="symbol required"></span></label>
                <br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="SI" name="ciclo" value="1" onClick="CicloTerapia();" class="custom-control-input">
                    <label class="custom-control-label text-dark alert-link" for="SI">SI</label>
                </div><br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="NO" name="ciclo" value="2" onClick="CicloTerapia();" checked="checked" class="custom-control-input">
                    <label class="custom-control-label text-dark alert-link" for="NO">NO</label>
                </div>
            </div>
        </div>

        <div class="col-md-10"> 
            <div class="form-group has-feedback2"> 
                <label class="control-label">Observaciones: <span class="symbol required"></span></label>
                <textarea class="form-control" type="text" name="observaciones" id="observaciones" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observaciones" rows="3" disabled=""></textarea>
            </div> 
        </div>
    </div>

    <div class="text-right">
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Guardar</button>
<button class="btn btn-dark" type="reset"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Limpiar</button>
    </div> 

<?php
  }
} 
############################# MOSTRAR DETALLES DE CICLOS DE TERAPIAS ############################
?>

<?php
############################# MOSTRAR TABLA DE CICLOS DE TERAPIAS ############################
if (isset($_GET['BuscaTablaCicloTerapias']) && isset($_GET['numero'])) { 

$ciclo = new Login();
$ciclo = $ciclo->TerapiasPorId();
?>
    <table id="html5-extension" class="table" style="width:100%">
        <thead>
        <tr>
            <th>N°</th>
            <th>Atención/Actividad y/o Tratamiento</th>
            <th>Fecha de Terapia</th>
            <th>Hora de Terapia</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($ciclo[0]['detalles_terapias'])){

        $explode = explode(",,",$ciclo[0]['detalles_terapias']);
        $a=1;
        for($cont=0; $cont<COUNT($explode); $cont++):
        list($iddetalleterapia,$tratamiento,$fechaciclo) = explode("/",$explode[$cont]);
        ?>
        <tr>
            <td><?php echo $a++; ?></td>
            <td class="text-dark alert-link"><?php echo nl2br($tratamiento); ?></td>
            <td><?php echo date("d-m-Y",strtotime($fechaciclo)); ?></td>
            <td><?php echo date("H:i",strtotime($fechaciclo)); ?></td>
            <td><span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarCicloTerapia('<?php echo encrypt($ciclo[0]["codterapia"]); ?>','<?php echo encrypt($iddetalleterapia); ?>','<?php echo encrypt("CICLO_TERAPIAS") ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span></td>
        </tr>
        <?php endfor; } ?>
      </tbody>
    </table>
    
<?php
  } 
############################# MOSTRAR TABLA DE CICLOS DE TERAPIAS ############################
?>

<?php
############################# MOSTRAR TERAPIAS EN VENTANA MODAL ############################
if (isset($_GET['BuscaTerapiasModal']) && isset($_GET['numero'])) { 

$reg = $new->TerapiasPorId();
?>
  
  <table id="div2" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
  <tr>
    <td><strong>Diagnóstico:</strong> <?php echo $reg[0]['diagnostico'] == '' ? "************" : nl2br($reg[0]['diagnostico']); ?></td>
  </tr>
  <tr>
    <td><strong>Observaciones:</strong> <?php echo $reg[0]['observaciones'] == '' ? "************" : nl2br($reg[0]['observaciones']); ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Terapia:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechaterapia'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora de Terapia:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fechaterapia'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table>

<hr><h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Ciclos de Terapias</h5><hr>

    <div id="div1"><table id="html5-extension" class="table" style="width:100%">
      <thead>
        <tr>
          <th>N°</th>
          <th>Atención/Actividad y/o Tratamiento</th>
          <th>Fecha</th>
          <th>Hora</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if(!empty($reg[0]['detalles_terapias'])){

        $explode = explode(",,",$reg[0]['detalles_terapias']);
        $a=1;
        for($cont=0; $cont<COUNT($explode); $cont++):
          list($iddetalleterapia,$tratamiento,$fechaciclo) = explode("/",$explode[$cont]);
          ?>
          <tr>
            <td><?php echo $a++; ?></td>
            <td class="text-dark alert-link"><?php echo nl2br($tratamiento); ?></td>
            <td><?php echo date("d-m-Y",strtotime($fechaciclo)); ?></td>
            <td><?php echo date("H:i",strtotime($fechaciclo)); ?></td>
          </tr>
        <?php endfor; } ?>
      </tbody>
    </table></div>

<?php
} 
############################# MOSTRAR TERAPIAS EN VENTANA MODAL ############################
?>

<?php 
########################### BUSQUEDA DE TERAPIAS POR FECHAS ##########################
if (isset($_GET['BusquedaTerapiasxFechas']) && isset($_GET['codsucursal']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 
$codsucursal = limpiar($_GET['codsucursal']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarTerapiasxFechas();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("TERAPIASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("TERAPIASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("TERAPIASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Diagnóstico</th>
                          <th>Ciclo</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['diagnostico'] == '' ? "************" : $reg[$i]['diagnostico']; ?></td>
                    <td><?php echo $ciclo = ( $reg[$i]['ciclo'] == 1 ? "<span class='badge badge-info'><i class='fa fa-check'></i> CULMINADO</span>" : "<span class='badge badge-danger'><i class='fa fa-times'></i> EN PROCESO</span>"); ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaterapia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaterapia']))."</span>"; ?></td>

                    <td>
                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codterapia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_TERAPIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE TERAPIAS POR FECHAS ##########################
?>

<?php 
########################### BUSQUEDA DE TERAPIAS POR MEDICOS ##########################
if (isset($_GET['BusquedaTerapiasxMedico']) && isset($_GET['codsucursal']) && isset($_GET['codmedico']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$codmedico = limpiar($_GET['codmedico']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($codmedico=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE MEDICO PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarTerapiasxMedico();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("TERAPIASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("TERAPIASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("TERAPIASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Diagnóstico</th>
                          <th>Ciclo</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['diagnostico'] == '' ? "************" : $reg[$i]['diagnostico']; ?></td>
                    <td><?php echo $ciclo = ( $reg[$i]['ciclo'] == 1 ? "<span class='badge badge-info'><i class='fa fa-check'></i> CULMINADO</span>" : "<span class='badge badge-danger'><i class='fa fa-times'></i> EN PROCESO</span>"); ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaterapia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaterapia']))."</span>"; ?></td>

                    <td>
                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codterapia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_TERAPIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE TERAPIAS POR MEDICOS ##########################
?>

<?php 
########################### BUSQUEDA DE TERAPIAS POR PACIENTES ##########################
if (isset($_GET['BusquedaTerapiasxPaciente']) && isset($_GET['codsucursal']) && isset($_GET['codpaciente'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$codpaciente = limpiar($_GET['codpaciente']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codpaciente=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR REALICE LA BÚSQUEDA DEL PACIENTE CORRECTAMENTE</center>";
   echo "</div>";   
   exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarTerapiasxPaciente();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("TERAPIASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("TERAPIASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("TERAPIASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Diagnóstico</th>
                          <th>Ciclo</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['diagnostico'] == '' ? "************" : $reg[$i]['diagnostico']; ?></td>
                    <td><?php echo $ciclo = ( $reg[$i]['ciclo'] == 1 ? "<span class='badge badge-info'><i class='fa fa-check'></i> CULMINADO</span>" : "<span class='badge badge-danger'><i class='fa fa-times'></i> EN PROCESO</span>"); ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaterapia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaterapia']))."</span>"; ?></td>

                    <td>
                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codterapia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_TERAPIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE TERAPIAS POR PACIENTES ##########################
?>























<?php 
########################### BUSQUEDA DE HISTORIAL DE PACIENTE ##########################
if (isset($_GET['VerificaOdontologia']) && isset($_GET['codpaciente']) && isset($_GET['codsucursal']) && isset($_GET['codverifica'])) { 
$codpaciente = limpiar($_GET['codpaciente']);
$codsucursal = limpiar($_GET['codsucursal']); 
$codverifica = limpiar($_GET['codverifica']);
   
$historial = new Login();
$reg = $historial->BusquedaHistorialPacientes();  
?>

<?php 
}
########################### BUSQUEDA DE HISTORIAL DE PACIENTE ##########################
?>

<?php 
########################### BUSQUEDA DE HISTORIAL DE PACIENTE ##########################
if (isset($_GET['BuscaHistorialPaciente66666']) && isset($_GET['codpaciente']) && isset($_GET['codsucursal'])) { 

$codpaciente = limpiar($_GET['codpaciente']);
$codsucursal = limpiar($_GET['codsucursal']); 
   
  
$historial = new Login();
$reg = $historial->BusquedaHistorialPacientes();  
?>

<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-danger">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Historial de Paciente</h4>
      </div>

      <div class="form-body">
        <div class="card-body">

      
    <div id="div"><table id="datatable-scroller" class="table2 table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>N°</th>
                            <th>Nombre de Especialista</th>
                            <th>Pronóstico</th>
                            <th>Tratamiento</th>
                            <th>Observaciones</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th><span class="mdi mdi-drag-horizontal"></span></th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                          <tr>
                        <td><?php echo $a++; ?></td>
                        <td><?php echo $reg[$i]['cedespecialista'].": ".$reg[$i]['nomespecialista']; ?></td>
                        <td><?php echo $reg[$i]['pronostico'] == "" ? "**********" : $reg[$i]['pronostico']; ?></td>
                        <td><?php echo $reg[$i]['plantratamiento'] == "" ? "**********" : str_replace(",",", ", $reg[$i]['plantratamiento']); ?></td>
                        <td><?php echo $reg[$i]['observacionestratamiento'] == "" ? "**********" : $reg[$i]['observacionestratamiento']; ?></td>
                        <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaodontologia'])); ?></td>
                        <td><?php echo date("H:i:s",strtotime($reg[$i]['fechaodontologia'])); ?></td>
                        <td><a href="reportepdf?cododontologia=<?php echo encrypt($reg[$i]['cododontologia']); ?>&codsucursal=<?php echo encrypt($reg[$i]['codsucursal']); ?>&tipo=<?php echo encrypt("FICHAODONTOLOGICA"); ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-outline-secondary btn-rounded" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a></td>
                          </tr>
                  <?php } ?>
                        </tbody>
                    </table>
                </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

<?php 
}
########################### BUSQUEDA DE HISTORIAL DE PACIENTE ##########################
?>

<?php
############################# FUNCION TABLA REFERENCIAS DE ODONTOGRAMA ############################
if (isset($_GET['BuscaTablaTratamiento']) && isset($_GET['codpaciente']) && isset($_GET['codsucursal'])) { 

$codpaciente = limpiar($_GET['codpaciente']);
$codsucursal = limpiar($_GET['codsucursal']);

$tra = new Login();
$reg = $tra->TratamientosOdontograma();
?>

<table id="tablaTratamiento" class="table" style="width:100%">
        <thead>
        <tr>
            <th>Diente</th>
            <th>Cara</th>
            <th>Tratamiento</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php 
        if($reg == "" || $reg[0]['estados'] == ""){

        echo "";

        } else {

        $explode = explode("__",$reg[0]['estados']);
        $listaSimple = array_values(array_unique($explode));

        $a=1;
        for($cont=0; $cont<COUNT($listaSimple); $cont++):
        # Listo 3 variables donde guardare lo que me retorne el explode de cada posicion del array.
        list($diente,$caradiente,$referencias) = explode("_",$listaSimple[$cont]);
        ?>
        <tr class="text-dark alert-link">
            <td><?php echo $diente; ?></td>
            <td><?php echo $caradiente; ?></td>
            <td><?php echo $referencias; ?></td>
            <td><span class="text-danger" style="cursor: pointer;" title="Eliminar" onClick="EliminarReferencia('<?php echo $cont ?>','<?php echo encrypt($reg[0]["codpaciente"]); ?>','<?php echo $reg[0]["codpaciente"]; ?>','<?php echo encrypt($reg[0]["codsucursal"]); ?>','<?php echo $reg[0]["codsucursal"]; ?>','<?php echo encrypt("REFERENCIA_ODONTOLOGIA") ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span></td>
        </tr>
        <?php endfor; } ?>
      </tbody>
    </table>

<?php
   } 
############################# FUNCION TABLA REFERENCIAS DE ODONTOGRAMA ############################
?>

<?php
######################## MOSTRAR ODONTOLOGIA EN VENTANA MODAL ############################
if (isset($_GET['BuscaOdontologiaModal']) && isset($_GET['numero'])) { 
$reg = $new->OdontologiasPorId();
?>

  <table id="div2" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
 
  <tr>
    <td><strong>Motivo Consulta:</strong> <?php echo $reg[0]['motivo_consulta'] == "" ? "**********" : nl2br($reg[0]['motivo_consulta']); ?></td>
  </tr>
  <tr>
    <td><strong>Problema Actual:</strong> <?php echo $reg[0]['problema_actual'] == "" ? "**********" : nl2br($reg[0]['problema_actual']); ?></td>
  </tr>
  <tr>
    <td><strong>Observaciones Antecedentes:</strong> <?php echo $reg[0]['observaciones_antecedentes'] == "" ? "**********" : nl2br($reg[0]['observaciones_antecedentes']); ?></td>
  </tr>
  <tr>
    <td><strong>Observaciones Examen:</strong> <?php echo $reg[0]['observaciones_examen'] == "" ? "**********" : nl2br($reg[0]['observaciones_examen']); ?></td>
  </tr>

  <tr>
    <td><strong>Presuntivo:</strong></td>
  </tr> 

  <tr>
    <td>
    <?php 
    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['presuntivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciepresuntivo,$presuntivo) = explode("/",$explode[$cont]);

    if($idciepresuntivo==""){
      echo "***********";
    } else {
    echo $a++. "). ".$presuntivo."<br>";
    }
    endfor;
    ?>
     </td>
  </tr> 

  <tr>
    <td><strong>Definitivo:</strong></td>
  </tr> 

  <tr>
    <td>
    <?php 
    $explode = explode(",,",utf8_decode(strtoupper($reg[0]['definitivo'])));
    $a=1;
    for($cont=0; $cont<COUNT($explode); $cont++):
    list($idciedefinitivo,$definitivo) = explode("/",$explode[$cont]);

    if($idciedefinitivo==""){
      echo "***********";
    } else {
    echo $a++. "). ".$definitivo."<br>";
    }
    endfor;
    ?>
     </td>
  </tr>
  <tr>
    <td><strong>Fecha:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechaodontologia'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fechaodontologia'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table> 

<?php 
$detalle = new Login();
$detalle = $detalle->VerDetallesOdontologia();

if($detalle==""){

    echo "";      
    
} else {

?>
<div id="div1">
  <table id="default_order" class="table table-striped">
      <thead>
      <tr>
        <th>Nº</th>
        <th>Diagnostico</th>
        <th>Procedimientos</th>
        <th>Prescripciones</th>
        <th>Fecha</th>
      </tr>
      </thead>
        <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($detalle);$i++){
?>
  <tr>
<td><?php echo $detalle[$i]["codsesion"]; ?></td>
<td><?php echo nl2br($detalle[$i]["diagnostico"]); ?></td>
<td><?php echo nl2br($detalle[$i]["procedimientos"]); ?></td>
<td><?php echo nl2br($detalle[$i]["prescripciones"]); ?></td>
<td><?php echo date("d-m-Y",strtotime($detalle[$i]['fecha_detalle'])); ?></td>
      </tr> 
        <?php } ?> 
     </tbody>
    </table>
  </div> 

<?php  
    }
}  
######################## MOSTRAR ODONTOLOGIA EN VENTANA MODAL ############################
?>


<?php 
########################### BUSQUEDA DE ODONTOLOGIAS POR FECHAS ##########################
if (isset($_GET['BusquedaOdontologiasxFechas']) && isset($_GET['codsucursal']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 
$codsucursal = limpiar($_GET['codsucursal']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarOdontologiasxFechas();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("ODONTOLOGIASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("ODONTOLOGIASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("ODONTOLOGIASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Motivo Consulta</th>
                          <th>Problema Actual</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['motivo_consulta'] == '' ? "************" : $reg[$i]['motivo_consulta']; ?></td>
                    <td><?php echo $reg[$i]['problema_actual'] == '' ? "************" : $reg[$i]['problema_actual']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaodontologia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaodontologia']))."</span>"; ?></td>

                    <td>
                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['cododontologia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ODONTOLOGIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE ODONTOLOGIAS POR FECHAS ##########################
?>

<?php 
########################### BUSQUEDA DE ODONTOLOGIAS POR MEDICOS ##########################
if (isset($_GET['BusquedaOdontologiasxMedico']) && isset($_GET['codsucursal']) && isset($_GET['codmedico']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$codmedico = limpiar($_GET['codmedico']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($codmedico=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE MEDICO PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarOdontologiasxMedico();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("ODONTOLOGIASXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("ODONTOLOGIASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("ODONTOLOGIASXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Motivo Consulta</th>
                          <th>Problema Actual</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['motivo_consulta'] == '' ? "************" : $reg[$i]['motivo_consulta']; ?></td>
                    <td><?php echo $reg[$i]['problema_actual'] == '' ? "************" : $reg[$i]['problema_actual']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaodontologia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaodontologia']))."</span>"; ?></td>

                    <td>
                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['cododontologia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ODONTOLOGIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE ODONTOLOGIAS POR MEDICOS ##########################
?>

<?php 
########################### BUSQUEDA DE ODONTOLOGIAS POR PACIENTES ##########################
if (isset($_GET['BusquedaOdontologiasxPaciente']) && isset($_GET['codsucursal']) && isset($_GET['codpaciente'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$codpaciente = limpiar($_GET['codpaciente']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codpaciente=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR REALICE LA BÚSQUEDA DEL PACIENTE CORRECTAMENTE</center>";
   echo "</div>";   
   exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarOdontologiasxPaciente();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("ODONTOLOGIASXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("ODONTOLOGIASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("ODONTOLOGIASXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Motivo Consulta</th>
                          <th>Problema Actual</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>

                    <td><?php echo $reg[$i]['motivo_consulta'] == '' ? "************" : $reg[$i]['motivo_consulta']; ?></td>
                    <td><?php echo $reg[$i]['problema_actual'] == '' ? "************" : $reg[$i]['problema_actual']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaodontologia']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaodontologia']))."</span>"; ?></td>

                    <td>
                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['cododontologia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ODONTOLOGIA") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE ODONTOLOGIAS POR PACIENTES ##########################
?>


















<?php
############################# BUSCAR DETALLES CONSENTIMIENTO INFORMADO ############################
if (isset($_GET['ProcesarDetalleConsentimiento']) && isset($_GET['codsucursal']) && isset($_GET['codespecialidad']) && isset($_GET['codmedico']) && isset($_GET['tipoconsentimiento']) && isset($_GET['codpaciente'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$codespecialidad = limpiar($_GET['codespecialidad']);
$codmedico = limpiar($_GET['codmedico']);
$tipoconsentimiento = limpiar($_GET['tipoconsentimiento']);
$codpaciente = limpiar($_GET['codpaciente']);
   
 if($codsucursal=="") {

  echo "<br><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codespecialidad=="") {

  echo "<br><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE ESPECIALIDAD PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

} elseif($codmedico=="") {

   echo "<br><div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR SELECCIONE MEDICO PARA TU BÚSQUEDA</center>";
   echo "</div>";   
   exit;

} else if($tipoconsentimiento=="") {

  echo "<br><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE TIPO DE CONSENTIMIENTO PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

} elseif($codpaciente=="") {

   echo "<br><div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR REALICE LA BÚSQUEDA DEL PACIENTE CORRECTAMENTE</center>";
   echo "</div>";   
   exit;

} else {
  
$paciente = new Login();
$paciente = $paciente->BusquedaPacientesPorCodigo();

$medico = new Login();
$medico = $medico->MedicosPorId();
?>


  <hr><div class="row">
      <h4 class="col-md-12 text-danger alert-link">
      <?php 
      switch(decrypt($tipoconsentimiento)){
      case 1:
      ?>
      CONSENTIMIENTO INFORMADO PARA CONSULTORIO
      <?php
      break;
      case 2:
      ?>
      CONSENTIMIENTO INFORMADO PARA GINECOLOGIA
      <?php
      break;
      case 3:
      ?>
      CONSENTIMIENTO INFORMADO PARA LABORATORIO
      <?php
      break;
      case 4:
      ?>
      CONSENTIMIENTO INFORMADO PARA RADIOLOGIA 
      <?php
      break;
      case 5:
      ?> 
      CONSENTIMIENTO INFORMADO PARA TERAPEUTA
      <?php
      break;
      case 6:
      ?> 
      CONSENTIMIENTO INFORMADO PARA ODONTOLOGIA
      <?php
      break;
      }//end switch
      ?>
    </h4>
  </div>

  <hr><h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Detalle de Consentimiento Informado del Paciente</h5><hr>

  <div class="row">
    <div class="col-md-12 text-dark alert-link">
      <p align="justify">PARA SATISFACCIÓN DE LOS <strong>DERECHOS DEL PACIENTE</strong>, COMO INSTRUMENTO FAVORECEDOR DEL CORRECTO USO DE LOS PROCEDIMIENTOS TERAPÉUTICOS Y DIAGNÓSTICOS<br><br> 

      YO D/Dª <?php echo "<span class='text-danger alert-link'>".$paciente[0]['nompaciente']." ".$paciente[0]['apepaciente']."</span>"; ?> <?php echo $variable = ( edad($paciente[0]['fnacpaciente']) >= '18' ? " MAYOR DE EDAD" : " MENOR DE EDAD");  ?>, CON <?php echo "<span class='text-danger alert-link'>".$paciente[0]['documento']." N&deg; ".$paciente[0]['cedpaciente']."</span>"; ?>, Y CON <?php echo "<span class='text-danger alert-link'>HCL: ".$paciente[0]['numerohistoria']."</span>"; ?> O D/Dª <?php echo "<strong>".$responsable = ($paciente[0]['nomresponsable'] == "" ? "**********" : $paciente[0]['nomresponsable'])."</strong>"; ?> COMO SU REPRESENTANTE LEGAL EN PLENO USO DE MIS FACULTADES, LIBRE Y VOLUNTARIAMENTE<br><br>

      <strong>DECLARO:</strong><br><br>

      QUE EL/LA DR./DRA <?php echo "<span class='text-danger alert-link'>".$medico[0]['nommedico']."</span>"; ?> CON PROFESIÓN O ESPECIALIDAD <?php echo "<span class='text-danger alert-link'>".$medico[0]['nomespecialidad']."</span>"; ?>, ME HA EXPLICADO, EN TÉRMINOS ASEQUIBLES, LA NATURALEZA EXACTA DE LA INTERVENCIÓN O PROCEDIMIENTO QUE SE ME VA A REALIZAR Y SU NECESIDAD. HE TENIDO LA OPORTUNIDAD DE DISCUTIR CON EL FACULTATIVO CÓMO SE VA A EFECTUAR, SU PROPÓSITO, LAS ALTERNATIVAS RAZONABLES, LAS POSIBLES CONSECUENCIAS DE NO HACER ESTE TRATAMIENTO Y TODOS LOS RIESGOS Y POSIBLES COMPLICACIONES QUE DE ÉL PUEDAN DERIVARSE.<br><br>

      COMPRENDO TAMBIÉN QUE UN RESULTADO INDESEABLE NO NECESARIAMENTE IMPLICA UN ERROR EN ESE JUICIO, POR LO QUE BUSCANDO LOS MEJORES RESULTADOS CONFÍO EN QUE EL CONOCIMIENTO Y LAS DECISIONES DEL PROFESIONAL DURANTE EL PROCEDIMIENTO O INTERVENCIÓN ESTARÁN BASADOS SOBRE LOS HECHOS HASTA ENTONCES CONOCIDOS, BUSCANDO SIEMPRE MI MAYOR BENEFICIO.<br>

      ME HA EXPLICADO QUE EL TRATAMIENTO QUE SE VA A HACER SE EFECTUARÁ BAJO ANESTESIA LOCAL, O GENERAL EN LOS CASOS QUE REQUIEREN HOSPITALIZACIÓN. SU FINALIDAD ES BLOQUEAR, DE FORMA REVERSIBLE, LA TRANSMISIÓN DE LOS IMPULSOS NERVIOSOS, PARA PODER REALIZAR LA INTERVENCIÓN SIN DOLOR.<br><br>

      SI BIEN A PARTIR DE MIS ANTECEDENTES PERSONALES NO SE DEDUCEN POSIBLES ALERGIAS O HIPERSENSIBILIDAD A LOS COMPONENTES DE LA SOLUCIÓN ANESTÉSICA, ELLO NO EXCLUYE LA POSIBILIDAD DE QUE, A PESAR DE SER MUY IMPROBABLE, PUEDAN PRESENTARSE MANIFESTACIONES ALÉRGICAS DEL TIPO URTICARIA, DERMATITIS DE CONTACTO, ASMA, EDEMA ANGIONEURÓTICO, Y EN CASOS EXTREMOS SHOCK ANAFILÁCTICO, QUE PUEDEN REQUERIR TRATAMIENTO URGENTE.<br>

      LAS SUSTANCIAS QUE CONTIENE LA SOLUCIÓN ANESTÉSICA PUEDEN ORIGINAR LEVES ALTERACIONES DEL PULSO Y DE LA TENSIÓN ARTERIAL. SE ME HA INFORMADO QUE, AÚN EN EL CASO DE QUE NO SE DEDUZCA NINGÚN TIPO DE PATOLOGÍA CARDIOVASCULAR DE MIS ANTECEDENTES, LA PRESENCIA DE ADRENALINA PUEDE FAVORECER, AUNQUE DE FORMA MUY INUSUAL, LA APARICIÓN DE ARRITMIAS LEVES.<br><br>
       
      HE SIDO INFORMADO DE:<br>
      • QUE ESTAS COMPLICACIONES GENERALES PUEDEN REQUERIR TRATAMIENTOS MÉDICO-QUIRÚRGICOS ADICIONALES Y QUE, RARAMENTE, ALGUNAS PUEDEN DEJAR SECUELAS DEFINITIVAS.<br>
      • LA BIOPSIA CONSISTE EN LA TOMA DE UNA MUESTRA REPRESENTATIVA DE LA LESIÓN. ESTE PROCEDIMIENTO ANALIZADO POR EL PATÓLOGO, NOS DA EL DIAGNÓSTICO DEFINITIVO DE LA LESIÓN, LO QUE DARÁ PASO AL COMIENZO DEL TRATAMIENTO CONCRETO DE LA MISMA. LAS COMPLICACIONES POTENCIALES DE ESTE TRATAMIENTO QUIRÚRGICO, SON, APARTE DE LAS MENCIONADAS PREVIAMENTE:<br>
      . NECESIDAD DE REPETIR LA BIOPSIA, SI EL PATÓLOGO NECESITARA OTRA MUESTRA PARA UN ANÁLISIS HISTOLÓGICO MÁS DETALLADO.<br>
      . INFECCIÓN POSTQUIRÚRGICA DE LA ZONA BIOPSIADA.<br>
      . HEMORRAGIA DURANTE LAS PRIMERAS HORAS POSTINTERVENCIÓN.<br>
      . DEHISCENCIA DE LA SUTURA.<br><br>

      CONSIENTO EN QUE SE TOMEN FOTOGRAFÍAS O REGISTROS EN OTROS TIPOS DE SOPORTE AUDIOVISUAL, ANTES, DURANTE Y DESPUÉS DE LA INTERVENCIÓN QUIRÚRGICA, PARA FACILITAR EL AVANCE DEL CONOCIMIENTO CIENTÍFICO Y LA DOCENCIA. EN TODOS LOS CASOS SERÁ RESGUARDADA LA IDENTIDAD DEL/DE LA PACIENTE.<br>

      HE COMPRENDIDO LAS EXPLICACIONES QUE SE ME HAN FACILITADO, Y EL FACULTATIVO ME HA PERMITIDO REALIZAR TODAS LAS OBSERVACIONES Y ME HA ACLARADO TODAS LAS DUDAS QUE LE HE PLANTEADO.<br>

      SI SURGIERA CUALQUIER SITUACIÓN INESPERADA DURANTE LA INTERVENCIÓN, AUTORIZO A MI ESPECIALISTA A REALIZAR CUALQUIER PROCEDIMIENTO O MANIOBRA QUE, EN SU JUICIO CLÍNICO, ESTIME OPORTUNA PARA MI MEJOR TRATAMIENTO.<br>

      TAMBIÉN COMPRENDO, QUE EN CUALQUIER MOMENTO Y SIN NECESIDAD DE DAR NINGUNA EXPLICACIÓN, PUEDO REVOCAR EL CONSENTIMIENTO QUE AHORA PRESTO.<br>

      POR ELLO, ME CONSIDERO EN CONDICIONES DE PONDERAR DEBIDAMENTE TANTO LOS RIESGOS COMO LA UTILIDAD Y BENEFICIO QUE PUEDO OBTENER DEL TRATAMIENTO; ASÍ PUES, MANIFIESTO QUE ESTOY SATISFECHO/A CON LA INFORMACIÓN RECIBIDA Y POR ELLO, <strong>YO DOY MI CONSENTIMIENTO</strong>, PARA LA REALIZACIÓN DEL PROCEDIMIENTO<br><br> 

      </p>
    </div>
  </div>

  <div class="row"> 
    <div class="col-md-12"> 
      <div class="form-group has-feedback"> 
        <label class="control-label alert-link">PROCEDIMIENTO:</label> 
        <textarea class="form-control" name="procedimiento" id="procedimiento" onkeyup="this.value=this.value.toUpperCase();" style="color:#000;font-weight:bold;width:100%;background:#f0f9fc;border-radius:5px 5px 5px 5px;" autocomplete="off" placeholder="Ingrese Procedimiento" rows="2" required="" aria-required="true"></textarea>     
      </div>
    </div>   
  </div>

  <div class="row"> 
    <div class="col-md-12"> 
      <div class="form-group has-feedback"> 
        <label class="control-label alert-link">BAJO ANESTESIA:</label> 
        <textarea class="form-control" name="anestesia" id="anestesia" onkeyup="this.value=this.value.toUpperCase();" style="color:#000;font-weight:bold;width:100%;background:#f0f9fc;border-radius:5px 5px 5px 5px;" autocomplete="off" placeholder="Ingrese Anestesia" rows="3" required="" aria-required="true"></textarea>     
      </div>
    </div>   
  </div>

  <div class="row"> 
    <div class="col-md-12"> 
      <div class="form-group has-feedback"> 
        <label class="control-label alert-link">ENFERMEDAD:</label> 
        <textarea class="form-control" name="enfermedad" id="enfermedad" onkeyup="this.value=this.value.toUpperCase();" style="color:#000;font-weight:bold;width:100%;background:#f0f9fc;border-radius:5px 5px 5px 5px;" autocomplete="off" placeholder="Ingrese Enfermedad" rows="3" required="" aria-required="true"></textarea>     
      </div>
    </div>   
  </div>

  <div class="row"> 
    <div class="col-md-12"> 
      <div class="form-group has-feedback"> 
        <label class="control-label alert-link">OBSERVACIONES:</label> 
        <textarea class="form-control" name="observaciones" id="observaciones" onkeyup="this.value=this.value.toUpperCase();" style="color:#000;font-weight:bold;width:100%;background:#f0f9fc;border-radius:5px 5px 5px 5px;" autocomplete="off" placeholder="Ingrese Observaciones" rows="3" required="" aria-required="true"></textarea>     
      </div>
    </div>   
  </div>

  <div class="row">
    <div class="col-md-12 text-dark alert-link">
      <p align="justify">Y PARA QUE ASÍ CONSTE, FIRMO EL PRESENTE ORIGINAL DESPUÉS DE LEÍDO.</p>
    </div>
  </div>

  <div class="row"> 
    <div class="col-md-4"> 
      <div class="form-group has-feedback"> 
        <label class="control-label alert-link">Nº de Documento de Testigo:</label> 
        <input class="form-control" type="text" name="doctestigo" id="doctestigo" onkeyup="this.value=this.value.toUpperCase();" style="color:#000;font-weight:bold;width:100%;background:#f0f9fc;border-radius:5px 5px 5px 5px;" autocomplete="off" placeholder="Ingrese Nº de Documento" required="" aria-required="true">  
      </div> 
    </div>
                                     
    <div class="col-md-8">
      <div class="form-group has-feedback">
        <label class="control-label alert-link">Nombre del Testigo o Responsable del Paciente:</label> 
        <input class="form-control" type="text" name="nombretestigo" id="nombretestigo" onkeyup="this.value=this.value.toUpperCase();" style="color:#000;font-weight:bold;width:100%;background:#f0f9fc;border-radius:5px 5px 5px 5px;" autocomplete="off" placeholder="Ingrese Nombre de Testigo" required="" aria-required="true">
      </div> 
    </div>
  </div>  
              
  <div class="row"> 
    <div class="col-md-12"> 
      <div class="form-group has-feedback"> 
        <label class="control-label alert-link">El Paciente no puede firmar por:</label> 
        <textarea name="nofirmapaciente" class="form-control" id="nofirmapaciente" onkeyup="this.value=this.value.toUpperCase();" style="color:#000;font-weight:bold;width:100%;background:#f0f9fc;border-radius:5px 5px 5px 5px;" autocomplete="off" placeholder="Ingrese Motivo de no firmar el Paciente"></textarea>     
      </div>
    </div>   
  </div>

            <div class="text-right">
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Guardar</button>
<button class="btn btn-dark" type="reset"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Limpiar</button>
             </div>

<?php
  } 
} 
############################# BUSCAR DETALLES CONSENTIMIENTO INFORMADO ############################
?>

<?php
######################## MOSTRAR CONSENTIMIENTO INFORMADO EN VENTANA MODAL ############################
if (isset($_GET['BuscaConsentimientoModal']) && isset($_GET['numero'])) { 
$reg = $new->ConsentimientosPorId();
?>

  <table id="div2" class="table-responsive" border="0">
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['docummedico'] == '0' ? "DOCUMENTO" : $reg[0]['documento3']); ?> de Médico:</strong> <?php echo $reg[0]['cedmedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Médico:</strong> <?php echo $reg[0]['nommedico']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $documento = ($reg[0]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[0]['documento4']); ?> de Paciente:</strong> <?php echo $reg[0]['cedpaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres de Paciente:</strong> <?php echo $reg[0]['nompaciente']; ?></td>
  </tr>
  <tr>
  <td><strong>Apellidos de Paciente:</strong> <?php echo $reg[0]['apepaciente']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacpaciente']); ?> AÑOS</td>
  </tr>
 
  <tr>
    <td class="alert-link"><strong>Tipo Consentimiento:</strong> <?php 
    switch($reg[0]['tipoconsentimiento']){
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
  </tr>
  <tr>
    <td><strong>Procedimiento:</strong> <?php echo $reg[0]['procedimiento'] == "" ? "**********" : nl2br($reg[0]['procedimiento']); ?></td>
  </tr>
  <tr>
    <td><strong>Anestesia:</strong> <?php echo $reg[0]['anestesia'] == "" ? "**********" : nl2br($reg[0]['anestesia']); ?></td>
  </tr>
  <tr>
    <td><strong>Enfermedad:</strong> <?php echo $reg[0]['enfermedad'] == "" ? "**********" : nl2br($reg[0]['enfermedad']); ?></td>
  </tr>
  <tr>
    <td><strong>Observaciones:</strong> <?php echo $reg[0]['observaciones'] == "" ? "**********" : nl2br($reg[0]['observaciones']); ?></td>
  </tr>
  <tr>
    <td><strong>Fecha:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechaconsentimiento'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora:</strong> <?php echo date("H:i:s",strtotime($reg[0]['fechaconsentimiento'])); ?></td>
  </tr>
  <tr>
    <td class="alert-link">Sucursal: <?php echo $reg[0]['cuitsucursal'].": ".$reg[0]['nomsucursal']; ?></td>
  </tr>
</table> 

<?php  
}  
######################## MOSTRAR CONSENTIMIENTO INFORMADO EN VENTANA MODAL ############################
?>


<?php 
########################### BUSQUEDA DE CONSENTIMIENTOS INFORMADOS POR FECHAS ##########################
if (isset($_GET['BusquedaConsentimientosxFechas']) && isset($_GET['codsucursal']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 
$codsucursal = limpiar($_GET['codsucursal']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarConsentimientosxFechas();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("CONSENTIMIENTOSXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("CONSENTIMIENTOSXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("CONSENTIMIENTOSXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Nombre de Paciente</th>
                          <th>Tipo de Consentimiento</th>
                          <th>Procedimiento</th>
                          <th>Enfermedad</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>

                    <td class="text-danger alert-link"><?php 
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
                    <td><?php echo $reg[$i]['enfermedad']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaconsentimiento']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaconsentimiento']))."</span>"; ?></td>
                    <td>
                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codconsentimiento']); ?>&tipo=<?php echo encrypt("CONSTANCIA_CONSENTIMIENTO") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE CONSENTIMIENTOS INFORMADOS POR FECHAS ##########################
?>

<?php 
########################### BUSQUEDA DE CONSENTIMIENTO INFORMADO POR MEDICOS ##########################
if (isset($_GET['BusquedaConsentimientosxMedico']) && isset($_GET['codsucursal']) && isset($_GET['codmedico']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$codmedico = limpiar($_GET['codmedico']);
$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($codmedico=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE MEDICO PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA DESDE PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR INGRESE FECHA HASTA PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA FINAL</center>";
  echo "</div>"; 
  exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarConsentimientosxMedico();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Médico : <?php echo "<span class='text-danger'>".$reg[0]['nomespecialidad']."</span>: ".$reg[0]['nommedico']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Desde : <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta : <?php echo date("d-m-Y", strtotime($hasta)); ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("CONSENTIMIENTOSXMEDICO") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("CONSENTIMIENTOSXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codmedico=<?php echo $codmedico; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("CONSENTIMIENTOSXMEDICO") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Paciente</th>
                          <th>Tipo de Consentimiento</th>
                          <th>Procedimiento</th>
                          <th>Enfermedad</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $documento = ($reg[$i]['documpaciente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento4'])." ".$reg[$i]['cedpaciente'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nompaciente']." ".$reg[$i]['apepaciente']."</span>"; ?></td>
                    <td class="text-danger alert-link"><?php 
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
                    <td><?php echo $reg[$i]['enfermedad']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaconsentimiento']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaconsentimiento']))."</span>"; ?></td>
                    <td>
                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codconsentimiento']); ?>&tipo=<?php echo encrypt("CONSTANCIA_CONSENTIMIENTO") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE CONSENTIMIENTOS INFORMADOS POR MEDICOS ##########################
?>

<?php 
########################### BUSQUEDA DE CONSENTIMIENTOS INFORMADOS POR PACIENTES ##########################
if (isset($_GET['BusquedaConsentimientosxPaciente']) && isset($_GET['codsucursal']) && isset($_GET['codpaciente'])) { 

$codsucursal = limpiar($_GET['codsucursal']);
$codpaciente = limpiar($_GET['codpaciente']);
   
 if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

} else if($codpaciente=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR REALICE LA BÚSQUEDA DEL PACIENTE CORRECTAMENTE</center>";
   echo "</div>";   
   exit;

} else {
  
 $citas = new Login();
 $reg = $citas->BuscarConsentimientosxPaciente();  
 ?>

  <div class="row">
      <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
          <div class="statbox widget box box-shadow">
              <div class="widget-header">
                  <div class="row">
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                          <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Sucursal : <?php echo $reg[0]['nomsucursal']; ?><br>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Paciente : <?php echo $reg[0]['nompaciente']." ".$reg[0]['apepaciente']; ?>
                          </h4>
                      </div>                 
                  </div>
              </div>

        <div class="widget-content widget-content-area">

              <div class="table">
                <div class="btn-group">
                  <a class="btn waves-effect waves-light btn-primary" href="reportepdf?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&tipo=<?php echo encrypt("CONSENTIMIENTOSXPACIENTE") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Pdf</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("CONSENTIMIENTOSXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Excel</a>

                  <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?codsucursal=<?php echo $codsucursal; ?>&codpaciente=<?php echo $codpaciente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("CONSENTIMIENTOSXPACIENTE") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Word</a>
                </div>
              </div>
                               
    <div id="div3"><table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nombre de Médico</th>
                          <th>Tipo de Consentimiento</th>
                          <th>Procedimiento</th>
                          <th>Enfermedad</th>
                          <th>Fecha | Hora</th>
                          <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                    <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['docummedico'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']." ".$reg[$i]['cedmedico'].":<br> <span class='text-dark alert-link'>".$reg[$i]['nommedico']."</span>"; ?></td>
                    <td class="text-danger alert-link"><?php 
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
                    <td><?php echo $reg[$i]['enfermedad']; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaconsentimiento']))."<br><span class='text-dark alert-link'>".date("H:i:s",strtotime($reg[$i]['fechaconsentimiento']))."</span>"; ?></td>
                    <td>
                    <a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[$i]['codconsentimiento']); ?>&tipo=<?php echo encrypt("CONSTANCIA_CONSENTIMIENTO") ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table></div>

        </div>
      </div>
    </div>
  </div>

 <?php
    } 
  }
########################### BUSQUEDA DE CONSENTIMIENTOS INFORMADOS POR PACIENTES ##########################
?>