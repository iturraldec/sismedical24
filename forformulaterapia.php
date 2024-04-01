<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
    if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "enfermera" || ($_SESSION['acceso'] == "medico" && in_array("1", explode(",", $_SESSION['modulos'])))) {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

if(isset($_POST["proceso"]) and $_POST["proceso"]=="save")
{
$reg = $tra->RegistrarFormulasTerapias();
exit;
}
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarFormulasTerapias();
exit;
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="icon" type="image/png" href="assets/img/favicon.png"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- timepicker CSS -->
    <link href="plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
    <link href="plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
    <!-- timepicker CSS -->
    
    <!--  BEGIN CUSTOM STYLE FILE -->
    <link rel="stylesheet" type="text/css" href="assets/css/elements/alert.css">
    <link href="assets/css/elements/search.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/dropify/dropify.min.css">
    <link href="assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/sweetalert.css">
    <link href="assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_html5.css">
    <!--<link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
     END PAGE LEVEL CUSTOM STYLES -->

</head>
<body onLoad="muestraReloj()" class="sidebar-noneoverflow">

<!--############################## MODAL BUSQUEDA DE CITAS EN FORMULAS TERAPIAS ######################################-->
<!-- Modal -->
<div class="modal fade" id="myModalBusqueda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="text-white" data-feather="align-justify"></i> Búsqueda de Citas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="text-white" data-feather="x-circle"></i>
                </button>
            </div>

        <form class="form-material" novalidate method="post" action="#" name="busquedacitasxdia" id="busquedacitasxdia">

        <div class="modal-body"><!-- modal-body -->
            
        <?php if ($_SESSION['acceso'] == "medico") { ?>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Nombre de Sucursal: <span class="symbol required"></span></label>
                    <input type="hidden" name="codsucursal" id="codsucursal" value="<?php echo encrypt($_SESSION['codsucursal']); ?>" />
                    <input type="hidden" name="codverifica" id="codverifica" value="<?php echo "0"; ?>"/>
                    <input type="text" class="form-control" name="sucursales" id="sucursales" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Sucursal" style="color:#000;font-weight:bold;" autocomplete="off" value="<?php echo $_SESSION['nomsucursal']; ?>" disabled="" aria-required="true"/>  
                </div>
            </div>

             <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Nombre de Médico: <span class="symbol required"></span></label>
                    <input type="hidden" name="codmedico" id="codmedico" value="<?php echo encrypt($_SESSION['codmedico']); ?>"/>
                    <input type="text" class="form-control" name="medicos" id="medicos" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Médico" style="color:#000;font-weight:bold;" autocomplete="off" value="<?php echo $_SESSION['nommedico']; ?>" disabled="" aria-required="true"/>  
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Especialidad: <span class="symbol required"></span></label>
                    <input type="hidden" name="codespecialidad" id="codespecialidad" value="<?php echo encrypt($_SESSION['codespecialidad']); ?>"/>
                    <input type="text" class="form-control" name="especialidades" id="especialidades" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Especialidad" style="color:#000;font-weight:bold;" autocomplete="off" value="<?php echo $_SESSION['nomespecialidad']; ?>" disabled="" aria-required="true"/>  
                </div>
            </div>   

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Ingrese Fecha de Búsqueda: <span class="symbol required"></span></label><br>
                    <input style="color:#000;font-weight:bold;width:100%;" type="text" class="form-control fecha_modal" name="fecha" id="fecha" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha de Inicio" value="<?php echo date("d-m-Y"); ?>" autocomplete="off" required="" aria-required="true"/>
                </div>
            </div>
        </div>


    <?php } else { ?>

        <div class="row">
            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">Seleccione Sucursal: <span class="symbol required"></span></label>
                    <input type="hidden" name="codverifica" id="codverifica" value="<?php echo "0"; ?>"/>
                    <select style="color:#000;font-weight:bold;" name="codsucursal" id="codsucursal" onChange="CargaEspecialidades(this.form.codsucursal.value);" class="form-control" required="" aria-required="true">
                    <option value=""> -- SELECCIONE -- </option>
                    <?php
                    $sucursal = new Login();
                    $sucursal = $sucursal->ListarSucursales();
                    if($sucursal==""){ 
                        echo "";
                    } else {
                    for($i=0;$i<sizeof($sucursal);$i++){
                    ?>
                    <option value="<?php echo encrypt($sucursal[$i]['codsucursal']); ?>"><?php echo $sucursal[$i]['cuitsucursal'].": ".$sucursal[$i]['nomsucursal']; ?></option>       
                    <?php } } ?>
                    </select>
                </div> 
            </div>

            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">Seleccione Especialidad: <span class="symbol required"></span></label>
                    <select style="color:#000;font-weight:bold;" name="codespecialidad" id="codespecialidad" onChange="CargaMedicos(this.form.codsucursal.value,this.form.codespecialidad.value);" class="form-control" required="" aria-required="true">
                        <option value=""> -- SIN RESULTADOS -- </option>
                    </select>
                </div> 
            </div>

            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">Seleccione Médico: <span class="symbol required"></span></label>
                    <select style="color:#000;font-weight:bold;" name="codmedico" id="codmedico" class="form-control" required="" aria-required="true">
                        <option value=""> -- SIN RESULTADOS -- </option>
                    </select>
                </div> 
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Ingrese Fecha de Búsqueda: <span class="symbol required"></span></label>
                    <input style="color:#000;font-weight:bold;width:100%;" type="text" class="form-control fecha_modal" name="fecha" id="fecha" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha de Inicio" value="<?php echo date("d-m-Y"); ?>" autocomplete="off" required="" aria-required="true"/>
                </div>
            </div>
        </div>

     <?php } ?>

        <div class="modal-footer">
            <button type="button" onClick="BuscarCitasxDia()" class="btn btn-primary"><i data-feather="search"></i> Realizar Búsqueda</button>
            <button class="btn" type="button" data-dismiss="modal" onclick="
            document.getElementById('codsucursal').value = '',
            document.getElementById('codespecialidad').value = '',
            document.getElementById('codmedico').value = '',
            document.getElementById('fecha').value = '<?php echo date("d-m-Y"); ?>'
            "><i data-feather="x-circle"></i> Cerrar</button>
        </div>

        <div id="muestracitasxdia"></div>

        </div><!-- modal-body -->

        </form>

        </div>
    </div>
</div>
<!--############################## MODAL BUSQUEDA DE CITAS EN FORMULAS TERAPIAS ######################################-->

    
    <!--  BEGIN NAVBAR  -->
    <?php include('membrete.php'); ?>
    <!--  BEGIN NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        <?php include('menu.php'); ?>
        <!--  BEGIN TOPBAR  -->
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                    <div id="custom_styles" class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                        <div class="widget-content-area statbox widget box box-shadow">
                            
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Gestión de Fórmulas Terapias</h5>
                                    </div>                 
                                </div>
                            </div>

    <div class="widget-content widget-content-area">                                

     <?php  if (isset($_GET['numero'])) {
      
      $reg = $tra->FormulasTerapiasPorId(); ?>
      
    <form class="form-material" novalidate method="post" action="#" name="updateformulaterapia" id="updateformulaterapia" data-id="<?php echo $reg[0]["codformula"] ?>" enctype="multipart/form-data">
        
    <?php } else { ?>

    <form class="form-material" novalidate method="post" action="#" name="saveformulaterapia" id="saveformulaterapia" enctype="multipart/form-data">
              
    <?php } ?>
            
        <div id="save">
            <!-- error will be shown here ! -->
        </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="user"></i> Datos del Paciente</h5><hr> 

        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Nº de Historia: <span class="symbol required"></span></label>
                <div class="input-group">
                    <input type="hidden" name="proceso" id="proceso" <?php if (isset($reg[0]['codformula'])) { ?> value="update" <?php } else { ?>  value="save" <?php } ?>/>
                    <input type="hidden" name="idformula" id="idformula" <?php if (isset($reg[0]['idformula'])) { ?> value="<?php echo encrypt($reg[0]['idformula']); ?>" <?php } ?>>
                    <input type="hidden" name="codformula" id="codformula" <?php if (isset($reg[0]['codformula'])) { ?> value="<?php echo encrypt($reg[0]['codformula']); ?>" <?php } ?>/>

                    <input type="hidden" name="verifica_busqueda" id="verifica_busqueda"/>
                    <input type="hidden" name="sucursal_busqueda" id="sucursal_busqueda" <?php if (isset($reg[0]['codsucursal'])) { ?> value="<?php echo encrypt($reg[0]['codsucursal']); ?>" <?php } ?>/>
                    <input type="hidden" name="especialidad_busqueda" id="especialidad_busqueda"/>
                    <input type="hidden" name="medico_busqueda" id="medico_busqueda" <?php if (isset($reg[0]['codmedico'])) { ?> value="<?php echo encrypt($reg[0]['codmedico']); ?>" <?php } ?>/>
                    <input type="hidden" name="fecha_busqueda" id="fecha_busqueda"/>

                    <input type="hidden" name="codcita" id="codcita" <?php if (isset($reg[0]['codcita'])) { ?> value="<?php echo encrypt($reg[0]['codcita']); ?>" <?php } ?>/>
                    <input type="hidden" name="cita" id="cita" <?php if (isset($reg[0]['codcita'])) { ?> value="<?php echo $reg[0]['codcita']; ?>" <?php } ?>/>
                    <input type="hidden" name="codpaciente" id="codpaciente" <?php if (isset($reg[0]['codpaciente'])) { ?> value="<?php echo encrypt($reg[0]['codpaciente']); ?>" <?php } ?>/>
                    <input type="hidden" name="paciente" id="paciente" <?php if (isset($reg[0]['codpaciente'])) { ?> value="<?php echo $reg[0]['codpaciente']; ?>" <?php } ?>/> 

                    <?php if (isset($reg[0]['idformula'])) { ?>

                    <input type="text" class="form-control" name="numeropaciente" id="numeropaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Historia" style="color:#000;font-weight:bold;" autocomplete="off" value="<?php echo $reg[0]['numerohistoria']; ?>" disabled=""/>
                    
                    <?php } else { ?>

                    <input type="text" class="form-control" name="numeropaciente" id="numeropaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Historia" style="color:#000;font-weight:bold;" autocomplete="off" readonly=""/>
                    <div class="input-group-append">
                        <div class="btn-group" data-bs-toggle="buttons">
                            <button type="button" id="BotonCitas" class="btn btn-primary waves-effect waves-light" data-placement="left" title="Buscar Paciente" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalBusqueda" data-backdrop="static" data-keyboard="false"><i data-feather="search"></i></button>
                        </div>
                    </div>

                    <?php } ?>

                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Nº de Documento: <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="cedpaciente" id="cedpaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Documento" style="color:#000;font-weight:bold;" autocomplete="off" <?php if (isset($reg[0]['cedpaciente'])) { ?> value="<?php echo $reg[0]['cedpaciente']; ?>" <?php } ?> disabled="" aria-required="true"/>  
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Nombre de Paciente: <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="nompaciente" id="nompaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Paciente" style="color:#000;font-weight:bold;" autocomplete="off" <?php if (isset($reg[0]['nompaciente'])) { ?> value="<?php echo $reg[0]['nompaciente']; ?>" <?php } ?> disabled="" aria-required="true"/>  
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Apellido de Paciente: <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="apepaciente" id="apepaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Apellido de Paciente" style="color:#000;font-weight:bold;" autocomplete="off" <?php if (isset($reg[0]['apepaciente'])) { ?> value="<?php echo $reg[0]['apepaciente']; ?>" <?php } ?> disabled="" aria-required="true"/>  
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Grupo Sanguineo: <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="gruposapaciente" id="gruposapaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Grupo Sanguineo" style="color:#000;font-weight:bold;" autocomplete="off" <?php if (isset($reg[0]['gruposapaciente'])) { ?> value="<?php echo $reg[0]['gruposapaciente']; ?>" <?php } ?> disabled="" aria-required="true"/>  
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Fecha de Nacimiento: <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="fnacimiento" id="fnacimiento" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha de Nacimiento" style="color:#000;font-weight:bold;" autocomplete="off" <?php if (isset($reg[0]['fnacpaciente'])) { ?> value="<?php echo $reg[0]['fnacpaciente'] == '0000-00-00' ? "" : date("d-m-Y",strtotime($reg[0]['fnacpaciente'])); ?>" <?php } ?> disabled="" aria-required="true">
                </div>
            </div> 

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Nombre de Acompañante: <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="nomacompana" id="nomacompana" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Acompañante" style="color:#000;font-weight:bold;" autocomplete="off" <?php if (isset($reg[0]['nomacompana'])) { ?> value="<?php echo $reg[0]['nomacompana']; ?>" <?php } ?> disabled="" aria-required="true"/>  
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Parentesco de Acompañante: <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="parentescoacompana" id="parentescoacompana" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Parentesco de Acompañante" style="color:#000;font-weight:bold;" autocomplete="off" <?php if (isset($reg[0]['parentescoacompana'])) { ?> value="<?php echo $reg[0]['parentescoacompana']; ?>" <?php } ?> disabled="" aria-required="true"/>  
                </div>
            </div>
        </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> Fórmulas de Terapias</h5><hr>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback">
                    <label class="control-label">Terapias Respiratorias <small class='text-danger alert-link'>(Series Dx)</small>: </label>
                    <input type="text" class="form-control" name="terapiasrespiratorias" id="terapiasrespiratorias" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Series DX" autocomplete="off" <?php if (isset($reg[0]['terapiasrespiratorias'])) { ?> value="<?php echo $reg[0]['terapiasrespiratorias']; ?>" <?php } ?> required="" aria-required="true"/>  
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group has-feedback">
                    <label class="control-label">Terapias Fisicas <small class='text-danger alert-link'>(Series Dx)</small>: </label>
                    <input type="text" class="form-control" name="terapiasfisicas" id="terapiasfisicas" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Series DX" autocomplete="off" <?php if (isset($reg[0]['terapiasfisicas'])) { ?> value="<?php echo $reg[0]['terapiasfisicas']; ?>" <?php } ?> required="" aria-required="true"/>  
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group has-feedback">
                    <label class="control-label">Micronebulizaciones <small class='text-danger alert-link'>(Cantidad)</small>: </label>
                    <input type="text" class="form-control" name="micronebulizaciones" id="micronebulizaciones" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Micronebulizaciones" autocomplete="off" <?php if (isset($reg[0]['micronebulizaciones'])) { ?> value="<?php echo $reg[0]['micronebulizaciones']; ?>" <?php } ?> required="" aria-required="true"/>  
                </div>
            </div>
        </div>


        <div class="text-right">
    <?php  if (isset($_GET['numero'])) { ?>
<button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><i data-feather="edit-2"></i> Actualizar</button>
<button class="btn btn-dark" type="reset"><i data-feather="x-circle"></i> Cancelar</button>
    <?php } else { ?>
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><i data-feather="save"></i> Guardar</button>
<button class="btn btn-dark" type="reset"><i data-feather="trash-2"></i> Limpiar</button>
    <?php } ?>          
        </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="footer-wrapper text-primary">
                <div class="footer-section f-section-1">
                    <i data-feather="copyright"></i> <span class="current-year"></span>.
                </div>
                <div class="footer-section f-section-2">
                    <p class="text-primary"><span class="current-detalle"></span></p>
                </div>
            </div>

        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="assets/script/jquery.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="assets/js/custom.js"></script>
    <script src="plugins/dropify/dropify.min.js"></script>
    <script src="plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="assets/js/users/account-settings.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    
    <script src="plugins/font-icons/feather/feather.min.js"></script>
    <script type="text/javascript">
        feather.replace();
    </script>

    <!-- Sweet-Alert -->
    <script src="assets/js/sweetalert-dev.js"></script>
    <!-- Sweet-Alert -->  

    <!-- script jquery -->
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/script/script2.js"></script>
    <script type="text/javascript" src="assets/script/validation.min.js"></script>
    <script type="text/javascript" src="assets/script/script.js"></script>
    <!-- script jquery -->

    <!-- Calendario -->
    <link rel="stylesheet" href="assets/calendario/jquery-ui.css" />
    <script src="plugins/flatpickr/flatpickr.js"></script>
    <script src="assets/calendario/jquery-ui.js"></script>
    <script src="assets/script/jscalendario.js"></script>
    <script src="assets/script/autocompleto.js"></script>
    <!-- Calendario -->

    <!-- jQuery Noty-->
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <!-- jQuery Noty-->

</body>
</html>
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