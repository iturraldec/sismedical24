<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
    if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "enfermera" || ($_SESSION['acceso'] == "medico" && in_array("6", explode(",", $_SESSION['modulos'])))) {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

if(isset($_POST["proceso"]) and $_POST["proceso"]=="save")
{
$reg = $tra->RegistrarOdontologias();
exit;
}
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarOdontologias();
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

    <!-- css dientes -->
    <link rel="stylesheet" href="assets/css/odontograma/cssDiente.css">
    <link rel="stylesheet" href="assets/css/odontograma/cssFormulario.css">
    <link rel="stylesheet" href="assets/css/odontograma/cssComponentesPersonalizados.css">
    <!-- css dientes -->

</head>
<body onLoad="muestraReloj()" class="sidebar-noneoverflow">

<?php if (!isset($_GET['numero'])) { ?>

<!--############################## MODAL BUSQUEDA DE CITAS EN ODONTOLOGIA ######################################-->
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
                    <input type="hidden" name="codverifica" id="codverifica" value="<?php echo "6"; ?>"/>
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
                    <input type="hidden" name="codverifica" id="codverifica" value="<?php echo "6"; ?>"/>
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
<!--############################## MODAL BUSQUEDA DE CITAS EN ODONTOLOGIA ######################################-->

<?php } ?>

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
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Gestión de Odontología</h5>
                                    </div>                 
                                </div>
                            </div>

    <div class="widget-content widget-content-area">                                

     <?php  if (isset($_GET['numero'])) {
      
      $reg = $tra->OdontologiasPorId(); ?>
      
    <form class="form-material" novalidate method="post" action="#" name="updateodontologia" id="updateodontologia" data-id="<?php echo $reg[0]["cododontologia"] ?>" enctype="multipart/form-data">
        
    <?php } else { ?>

    <form class="form-material" novalidate method="post" action="#" name="saveodontologia" id="saveodontologia" enctype="multipart/form-data">
              
    <?php } ?>
            
        <div id="save">
            <!-- error will be shown here ! -->
        </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="user"></i> Datos del Paciente</h5><hr> 

        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Nº de Historia: <span class="symbol required"></span></label>
                <div class="input-group">
                    <input type="hidden" name="proceso" id="proceso" <?php if (isset($reg[0]['cododontologia'])) { ?> value="update" <?php } else { ?>  value="save" <?php } ?>/>
                    <input type="hidden" name="idodontologia" id="idodontologia" <?php if (isset($reg[0]['idodontologia'])) { ?> value="<?php echo encrypt($reg[0]['idodontologia']); ?>" <?php } ?>>
                    <input type="hidden" name="cododontologia" id="cododontologia" <?php if (isset($reg[0]['cododontologia'])) { ?> value="<?php echo encrypt($reg[0]['cododontologia']); ?>" <?php } ?>/>
                    <input type="hidden" name="codsucursal" id="codsucursal" <?php if (isset($reg[0]['codsucursal'])) { ?> value="<?php echo encrypt($reg[0]['codsucursal']); ?>" <?php } ?>/>

                    <input type="hidden" name="verifica_busqueda" id="verifica_busqueda"/>
                    <input type="hidden" name="sucursal_busqueda" id="sucursal_busqueda" <?php if (isset($reg[0]['codsucursal'])) { ?> value="<?php echo encrypt($reg[0]['codsucursal']); ?>" <?php } ?>/>
                    <input type="hidden" name="especialidad_busqueda" id="especialidad_busqueda"/>
                    <input type="hidden" name="medico_busqueda" id="medico_busqueda" <?php if (isset($reg[0]['codmedico'])) { ?> value="<?php echo encrypt($reg[0]['codmedico']); ?>" <?php } ?>/>
                    <input type="hidden" name="fecha_busqueda" id="fecha_busqueda"/>

                    <input type="hidden" name="codcita" id="codcita" <?php if (isset($reg[0]['codcita'])) { ?> value="<?php echo encrypt($reg[0]['codcita']); ?>" <?php } ?>/>
                    <input type="hidden" name="cita" id="cita" <?php if (isset($reg[0]['codcita'])) { ?> value="<?php echo $reg[0]['codcita']; ?>" <?php } ?>/>
                    <input type="hidden" name="codpaciente" id="codpaciente" <?php if (isset($reg[0]['codpaciente'])) { ?> value="<?php echo encrypt($reg[0]['codpaciente']); ?>" <?php } ?>/>
                    <input type="hidden" name="paciente" id="paciente" <?php if (isset($reg[0]['codpaciente'])) { ?> value="<?php echo $reg[0]['codpaciente']; ?>" <?php } ?>/> 
                    <input type="hidden" name="sucursal" id="sucursal" <?php if (isset($reg[0]['codsucursal'])) { ?> value="<?php echo $reg[0]['codsucursal']; ?>" <?php } ?>/>

                    <?php if (isset($reg[0]['idodontologia'])) { ?>

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

        <div id="verifica_odontologia"></div>

        <hr>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="menor_1" name="menor_1" value="X" <?php if (isset($reg[0]['menor_1']) && $reg[0]['menor_1'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="menor_1">Menor de 1 Año</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="1_4" name="1_4" value="X" <?php if (isset($reg[0]['1_4']) && $reg[0]['1_4'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="1_4">1 - 4 Años</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="5_9" name="5_9" value="X" <?php if (isset($reg[0]['5_9']) && $reg[0]['5_9'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="5_9">5 - 9 Años Programado</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="5_14" name="5_14" value="X" <?php if (isset($reg[0]['5_14']) && $reg[0]['5_14'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="5_14">5 - 14 Años No Programado</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="10_14" name="10_14" value="X" <?php if (isset($reg[0]['10_14']) && $reg[0]['10_14'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="10_14">10 - 14 Años</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="15_19" name="15_19" value="X" <?php if (isset($reg[0]['15_19']) && $reg[0]['15_19'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="15_19">15 - 19 Años</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="mayor_20" name="mayor_20" value="X" <?php if (isset($reg[0]['mayor_20']) && $reg[0]['mayor_20'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="mayor_20">Mayor de 20 Años</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="embarazada" name="embarazada" value="X" <?php if (isset($reg[0]['embarazada']) && $reg[0]['embarazada'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="embarazada">Embarazada</label>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> 1. Motivo de Consulta</h5><hr>

        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group has-feedback2"> 
                    <label class="control-label">Motivo de Consulta: (Anotar la Causa del Problema en la Versión del Informante) <span class="symbol required"></span></label> 
                    <textarea class="form-control" type="text" name="motivo_consulta" id="motivo_consulta" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Motivo de Consulta" rows="3"><?php if (isset($reg[0]['motivo_consulta'])) { echo $reg[0]['motivo_consulta']; } ?></textarea>
                </div> 
            </div>
        </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> 2. Enfermedad o Problema Actual</h5><hr>

        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group has-feedback2"> 
                    <label class="control-label">Registrar Sintomas: (Cronología, Localización, Características, Intensidad, Causa Aparente, Síntomas Asociados, Evolución, Estado Actual) <span class="symbol required"></span></label><textarea class="form-control" type="text" name="problema_actual" id="problema_actual" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Enfermedad o Problema Actual" rows="4"><?php if (isset($reg[0]['problema_actual'])) { echo $reg[0]['problema_actual']; } ?></textarea>
                </div> 
            </div>
        </div>


        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> 3. Antecedentes Personales y Familiares</h5><hr>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="alergia_antibiotico" name="alergia_antibiotico" value="X" <?php if (isset($reg[0]['alergia_antibiotico']) && $reg[0]['alergia_antibiotico'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="alergia_antibiotico">1. Alergia Antibiótico</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="alergia_anestesia" name="alergia_anestesia" value="X" <?php if (isset($reg[0]['alergia_anestesia']) && $reg[0]['alergia_anestesia'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="alergia_anestesia">2. Alergia Anestesia</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="hemorragias" name="hemorragias" value="X" <?php if (isset($reg[0]['hemorragias']) && $reg[0]['hemorragias'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="hemorragias">3. Hemorragias</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="vih" name="vih" value="X" <?php if (isset($reg[0]['vih']) && $reg[0]['vih'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="vih">4. VIH/SIDA</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="tuberculosis" name="tuberculosis" value="X" <?php if (isset($reg[0]['tuberculosis']) && $reg[0]['tuberculosis'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="tuberculosis">5. Tuberculosis</label>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="asma" name="asma" value="X" <?php if (isset($reg[0]['asma']) && $reg[0]['asma'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="asma">6. Asma</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="diabetes" name="diabetes" value="X" <?php if (isset($reg[0]['diabetes']) && $reg[0]['diabetes'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="diabetes">7. Diabetes</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="hipertension" name="hipertension" value="X" <?php if (isset($reg[0]['hipertension']) && $reg[0]['hipertension'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="hipertension">8. Hipertensión</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="enfermedad_cardiaca" name="enfermedad_cardiaca" value="X" <?php if (isset($reg[0]['enfermedad_cardiaca']) && $reg[0]['enfermedad_cardiaca'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="enfermedad_cardiaca">9. Enfermedad Cardiaca</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="otro_antecedentes" name="otro_antecedentes" value="X" <?php if (isset($reg[0]['otro_antecedentes']) && $reg[0]['otro_antecedentes'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="otro_antecedentes">10. Otro</label>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group has-feedback2"> 
                    <label class="control-label">Observaciones: </label> 
                    <textarea class="form-control" type="text" name="observaciones_antecedentes" id="observaciones_antecedentes" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observaciones" rows="2"><?php if (isset($reg[0]['observaciones_antecedentes'])) { echo $reg[0]['observaciones_antecedentes']; } ?></textarea>
                </div> 
            </div>
        </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> 4. Signos Vitales</h5><hr>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Presión Arterial: <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="presion_arterial" id="presion_arterial" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Presión Arterial" autocomplete="off" <?php if (isset($reg[0]['presion_arterial'])) { ?> value="<?php echo $reg[0]['presion_arterial']; ?>" <?php } ?> required="" aria-required="true"/>  
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Frecuencia Cardiaca (min): <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="frecuencia_cardiaca" id="frecuencia_cardiaca" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Frecuencia Cardiaca (min)" autocomplete="off" <?php if (isset($reg[0]['frecuencia_cardiaca'])) { ?> value="<?php echo $reg[0]['frecuencia_cardiaca']; ?>" <?php } ?> required="" aria-required="true"/>  
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Temperatura (ºC): <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="temperatura" id="temperatura" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Temperatura (ºC)" autocomplete="off" <?php if (isset($reg[0]['temperatura'])) { ?> value="<?php echo $reg[0]['temperatura']; ?>" <?php } ?> required="" aria-required="true"/>  
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Frecuencia Respiratoria (min): <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="frecuencia_respiratoria" id="frecuencia_respiratoria" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Frecuencia Respiratoria (min)" autocomplete="off" <?php if (isset($reg[0]['frecuencia_respiratoria'])) { ?> value="<?php echo $reg[0]['frecuencia_respiratoria']; ?>" <?php } ?> required="" aria-required="true"/>  
                </div>
            </div>
        </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> 5. Examen del Sistema Estomatognático</h5><hr>

        <h6 class="card-subtitle text-dark alert-link"> DESCRIBIR ABAJO LA PATOLOGÍA DE LA REGIÓN AFECTADA ANOTANDO EL NUMERO</h6><hr>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="labios" name="labios" value="X" <?php if (isset($reg[0]['labios']) && $reg[0]['labios'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="labios">1. Labios</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="mejillas" name="mejillas" value="X" <?php if (isset($reg[0]['mejillas']) && $reg[0]['mejillas'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="mejillas">2. Mejillas</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="maxilar_superior" name="maxilar_superior" value="X" <?php if (isset($reg[0]['maxilar_superior']) && $reg[0]['maxilar_superior'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="maxilar_superior">3. Maxilar Superior</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="maxilar_inferior" name="maxilar_inferior" value="X" <?php if (isset($reg[0]['maxilar_inferior']) && $reg[0]['maxilar_inferior'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="maxilar_inferior">4. Maxilar Inferior</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="lengua" name="lengua" value="X" <?php if (isset($reg[0]['lengua']) && $reg[0]['lengua'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="lengua">5. Lengua</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="paladar" name="paladar" value="X" <?php if (isset($reg[0]['paladar']) && $reg[0]['paladar'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="paladar">6. Paladar</label>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="piso" name="piso" value="X" <?php if (isset($reg[0]['piso']) && $reg[0]['piso'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="piso">7. Piso</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="carrillos" name="carrillos" value="X" <?php if (isset($reg[0]['carrillos']) && $reg[0]['carrillos'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="carrillos">8. Carrillos</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="glandulas" name="glandulas" value="X" <?php if (isset($reg[0]['glandulas']) && $reg[0]['glandulas'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="glandulas">9. Glándulas Salivales</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="faringe" name="faringe" value="X" <?php if (isset($reg[0]['faringe']) && $reg[0]['faringe'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="faringe">10. Oro Faringe</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="atm" name="atm" value="X" <?php if (isset($reg[0]['atm']) && $reg[0]['atm'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="atm">11. A.T.M</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="ganglios" name="ganglios" value="X" <?php if (isset($reg[0]['ganglios']) && $reg[0]['ganglios'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="ganglios">12. Ganglios</label>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group has-feedback2"> 
                    <label class="control-label">Observaciones: </label> 
                    <textarea class="form-control" type="text" name="observaciones_examen" id="observaciones_examen" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observaciones" rows="4"><?php if (isset($reg[0]['observaciones_examen'])) { echo $reg[0]['observaciones_examen']; } ?></textarea>
                    <i class="fa fa-comment-o form-control-feedback2"></i> 
                </div> 
            </div>
        </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> 6. Odontograma</h5><hr>

        <div class="row">
            <div class="col-md-12">

            <div id="seccionDientes" class="sombraFormulario"></div>          

            </div>
        </div>

        <hr>

        <div class="row">

        <div class="col-md-2">
            <section class="displayInlineBlockMiddle">
            <div class="dienteGeneral" id="dienteGeneral">
            <div id="C1" onClick="seleccionarCara(this.id);"></div>
            <div id="C2" onClick="seleccionarCara(this.id);"></div>
            <div id="C3" onClick="seleccionarCara(this.id);"></div>
            <div id="C4" onClick="seleccionarCara(this.id);"></div>
            <div id="C5" onClick="seleccionarCara(this.id);"></div>
            <input style="background: transparent !important;color:#000;font-weight:bold;" type="text" id="txtIdentificadorDienteGeneral" name="txtIdentificadorDienteGeneral" value="DXX" disabled="">
            </div>
            </section>
        </div>

        <div class="col-md-4">
            <div class="displayInlineBlockMiddle">
                <div id="odontograma" class="formulario sombraFormulario labelPequenio">

                <div class="tituloFormulario">DATOS DEL TRATAMIENTO</div>
                <div class="contenidoInterno">
                    <label class="alert-link" for="">Diente Tratado:</label>
                    <input style="color:#d10505;font-weight:bold;" type="text" id="txtDienteTratado" name="txtDienteTratado" class="textAlignCenter" size="4" readonly="readonly">
                    <br>
                    <label class="alert-link" for="">Cara Tratada:</label>
                    <input style="color:#d10505;font-weight:bold;" type="text" id="txtCaraTratada" name="txtCaraTratada" class="textAlignCenter" size="4" readonly="readonly">
                    <br>
                    <label class="alert-link" for="">Referencias:</label>
                    <select style="color:#000;font-weight:bold;" id="cbxEstado" name="cbxEstado" style="white">
                    <option value="">-- SELECCIONE REFERENCIA --</option>
                    <option value="1-DO: EN AZUL DIENTE OBTURADO">DO: EN AZUL DIENTE OBTURADO</option>
                    <option value="2-C: EN ROJO CARIADO">C: EN ROJO CARIADO</option>
                    <option value="3--: EN AZUL AUSENTE">-: EN AZUL AUSENTE</option>
                    <option value="4-X: EN ROJO EXODONCIA">X: EN ROJO EXODONCIA</option>
                    <option value="5-CP: EN ROJO CARIES PENETRANTE">CP: EN ROJO CARIES PENETRANTE</option>
                    <option value="6-R: EN ROJO RETENIDO">R: EN ROJO RETENIDO</option>
                    <option value="7-EN AZUL PIEZA DE PUENTE">FP: EN AZUL PIEZA DE PUENTE</option>
                    <option value="8-CO: EN AZUL CORONA">CO: EN AZUL CORONA</option>
                    <option value="9-PR: EN AZUL PROTESIS REMOVIBLE">PR: EN AZUL PROTESIS REMOVIBLE</option>
                    <option value="10-INC: INSCRUSTACION">INC: INSCRUSTACIÓN</option>
                    <option value="11-EP: EN ROJO ENFERMEDAD PERIODONTAL">EP: EN ROJO ENFERMEDAD PERIODONTAL</option>
                    <option value="12-FD: EN ROJO FRACTURA DENTARIA">FD: EN ROJO FRACTURA DENTARIA</option>
                    <option value="13-MPD: EN ROJO MAL POSICION DENTARIA">MPD: EN ROJO MAL POSICION DENTARIA</option>
                    <option value="14-PM: EN AZUL PERNO MUÑON">PM: EN AZUL PERNO MUÑON</option>
                    <option value="15-TC: EN AZUL TRATAMIENTO DE CONDUCTO">TC: EN AZUL TRATAMIENTO DE CONDUCTO</option>
                    <option value="16-F: EN ROJO FLUOROSIS">F: EN ROJO FLUOROSIS</option>
                    <option value="17-IMP: EN AZUL IMPLANTE DENTAL">IMP: EN AZUL IMPLANTE DENTAL</option>
                    <option value="18-MB: EN ROJO MANCHA BLANCA">MB: EN ROJO MANCHA BLANCA</option>
                    <option value="19-SC: EN AZUL SELLADOR">SC: EN AZUL SELLADOR</option>
                    <option value="20-SP SR: EN AZUL SURCO PROFUNDO">SP SR: EN AZUL SURCO PROFUNDO</option>
                    <option value="21-HP: EN AZUL HIPOPLASIA DE ESMALTE">HP: EN AZUL HIPOPLASIA DE ESMALTE</option>
                    <option value="22-DESGASTADO">DESG: DESGASTADO</option>
                    <option value="23-DIASTEMA">DIA: DIASTEMA</option>
                    <option value="24-MOVILIDAD">MOV: MOVILIDAD</option>
                    <option value="25-CORONA TEMPORAL">CT: CORONA TEMPORAL</option>
                    <option value="26-CORONA COMPLETA">CC: CORONA COMPLETA</option>
                    <option value="27-CORONA VEENER">CV: CORONA VEENER</option>
                    <option value="28-CORONA FEXESTRADA">CF: CORONA FEXESTRADA</option>
                    <option value="29-CORONA TRES CUARTOS">3/4: CORONA TRES CUARTOS</option>
                    <option value="30-CORONA PORCELANA">CP: CORONA PORCELANA</option>
                    <option value="31-PROTESIS FIJA">PROTESIS FIJA</option>
                    <option value="32-PROTESIS REMOVIBLE">PROTESIS REMOVIBLE</option>
                    <option value="33-ODONTULO TOTAL">ODONTULO TOTAL</option>
                    <option value="34-APARAT. ORTO. FIJO">APARAT. ORTO. FIJO</option>
                    <option value="35-APARAT. ORTO. REMOV.">APARAT. ORTO. REMOV.</option>
                    <option value="36-IMPLANTE">IMP: IMPLANTE</option>
                    <option value="37-SUPERNUMERARIO">S: SUPERNUMERARIO</option>
                    <option value="38-DIENTE POR EXTRAER">X: DIENTE POR EXTRAER</option>
                    <option value="39-A: AMALGAMA">A: AMALGAMA</option>
                    <option value="40-R: RESINA">R: RESINA</option>
                    </select>
                    <br></br>

        <div class="text-right">
            <button type="button" id="guarda" class="btn btn-danger waves-effect waves-light" <?php if (isset($reg[0]['cododontologia'])) { ?>  <?php } else { ?> disabled="" <?php } ?> onClick="guardarTratamiento();"><i data-feather="save"></i> Guardar</button>

            <button type="button" id="agrega" class="btn btn-primary waves-effect waves-light" <?php if (isset($reg[0]['cododontologia'])) { ?>  <?php } else { ?> disabled="" <?php } ?> onClick="agregarTratamiento($('#txtDienteTratado').val(), $('#txtCaraTratada').val(), $('#cbxEstado').val());"><i data-feather="plus-circle"></i> Agregar</button>
        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div id="divTratamiento" class="displayInlineBlockTop sombraFormulario" style="width: 100%;height:210px;overflow-y: scroll;scrollbar-width: thin;white-space: nowrap">
                <table id="tablaTratamiento" class="table2 table-striped table-bordered border display">
                <tbody>
                </tbody>
                </table>
            </div>
        </div>
                   
    </div>


        <div class="row">

        <!-- .col -->
        <div class="col-md-9">

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> 7. Indicadores de Salud Bucal</h5><hr>

        <div class="row">

            <!-- .col -->
            <div class="col-md-6">
        
            <table border="0" class="table2 table-striped table-bordered border display">
                <tr>
                    <td colspan="9" class="text-center text-dark alert-link">HIGIENE ORAL SIMPLIFICADA</td>
                </tr>
                <tr class="text-center text-dark alert-link">
                    <td colspan="6">PIEZAS DENTALES</td>
                    <td>PLACA<h5>0-1-2-3</h5></td>
                    <td>C&Aacute;LCULO<h5>0-1-2-3</h5></td>
                    <td>GINGIVITIS<h5>0-1</h5></td>
                </tr>
                <tr class="text-center text-dark alert-link">
                    <td>16</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_16" name="pieza_16" value="X" <?php if (isset($reg[0]['pieza_16']) && $reg[0]['pieza_16'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_16"></label></div></div>
                    </td>
                    <td>17</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_17" name="pieza_17" value="X" <?php if (isset($reg[0]['pieza_17']) && $reg[0]['pieza_17'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_17"></label></div></div>
                    </td>
                    <td>55</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_55" name="pieza_55" value="X" <?php if (isset($reg[0]['pieza_55']) && $reg[0]['pieza_55'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_55"></label></div></div>
                    </td>
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="3" name="pieza_1_placa" id="pieza_1_placa" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 3){ this.value='3'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_1_placa'])) { ?> value="<?php echo $reg[0]['pieza_1_placa']; ?>" <?php } ?>></td>
                    
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="3" name="pieza_1_calculo" id="pieza_1_calculo" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 3){ this.value='3'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_1_calculo'])) { ?> value="<?php echo $reg[0]['pieza_1_calculo']; ?>" <?php } ?>></td>
                    
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="1" name="pieza_1_gingivitis" id="pieza_1_gingivitis" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 1){ this.value='1'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_1_gingivitis'])) { ?> value="<?php echo $reg[0]['pieza_1_gingivitis']; ?>" <?php } ?>></td>

                </tr>
                <tr class="text-center text-dark alert-link">
                    <td>11</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_11" name="pieza_11" value="X" <?php if (isset($reg[0]['pieza_11']) && $reg[0]['pieza_11'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_11"></label></div></div>
                    </td>
                    <td>21</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_21" name="pieza_21" value="X" <?php if (isset($reg[0]['pieza_21']) && $reg[0]['pieza_21'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_21"></label></div></div>
                    </td>
                    <td>51</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_51" name="pieza_51" value="X" <?php if (isset($reg[0]['pieza_51']) && $reg[0]['pieza_51'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_51"></label></div></div>
                    </td>
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="3" name="pieza_2_placa" id="pieza_2_placa" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 3){ this.value='3'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_2_placa'])) { ?> value="<?php echo $reg[0]['pieza_2_placa']; ?>" <?php } ?>></td>
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="3" name="pieza_2_calculo" id="pieza_2_calculo" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 3){ this.value='3'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_2_calculo'])) { ?> value="<?php echo $reg[0]['pieza_2_calculo']; ?>" <?php } ?>></td>
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="1" name="pieza_2_gingivitis" id="pieza_2_gingivitis" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 1){ this.value='1'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_2_gingivitis'])) { ?> value="<?php echo $reg[0]['pieza_2_gingivitis']; ?>" <?php } ?>></td>
                </tr>
                <tr class="text-center text-dark alert-link">
                    <td>26</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_26" name="pieza_26" value="X" <?php if (isset($reg[0]['pieza_26']) && $reg[0]['pieza_26'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_26"></label></div></div>
                    </td>
                    <td>27</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_27" name="pieza_27" value="X" <?php if (isset($reg[0]['pieza_27']) && $reg[0]['pieza_27'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_27"></label></div></div>
                    </td>
                    <td>65</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_65" name="pieza_65" value="X" <?php if (isset($reg[0]['pieza_65']) && $reg[0]['pieza_65'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_65"></label></div></div>
                    </td>
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="3" name="pieza_3_placa" id="pieza_3_placa" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 3){ this.value='3'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_3_placa'])) { ?> value="<?php echo $reg[0]['pieza_3_placa']; ?>" <?php } ?>></td>
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="3" name="pieza_3_calculo" id="pieza_3_calculo" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 3){ this.value='3'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_3_calculo'])) { ?> value="<?php echo $reg[0]['pieza_3_calculo']; ?>" <?php } ?>></td>
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="1" name="pieza_3_gingivitis" id="pieza_3_gingivitis" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 1){ this.value='1'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_3_gingivitis'])) { ?> value="<?php echo $reg[0]['pieza_3_gingivitis']; ?>" <?php } ?>></td>
                </tr>
                <tr class="text-center text-dark alert-link">
                    <td>36</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_36" name="pieza_36" value="X" <?php if (isset($reg[0]['pieza_36']) && $reg[0]['pieza_36'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_36"></label></div></div>
                    </td>
                    <td>37</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_37" name="pieza_37" value="X" <?php if (isset($reg[0]['pieza_37']) && $reg[0]['pieza_37'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_37"></label></div></div>
                    </td>
                    <td>75</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_75" name="pieza_75" value="X" <?php if (isset($reg[0]['pieza_75']) && $reg[0]['pieza_75'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_75"></label></div></div>
                    </td>
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="3" name="pieza_4_placa" id="pieza_4_placa" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 3){ this.value='3'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_4_placa'])) { ?> value="<?php echo $reg[0]['pieza_4_placa']; ?>" <?php } ?>></td>
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="3" name="pieza_4_calculo" id="pieza_4_calculo" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 3){ this.value='3'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_4_calculo'])) { ?> value="<?php echo $reg[0]['pieza_4_calculo']; ?>" <?php } ?>></td>
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="1" name="pieza_4_gingivitis" id="pieza_4_gingivitis" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 1){ this.value='1'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_4_gingivitis'])) { ?> value="<?php echo $reg[0]['pieza_4_gingivitis']; ?>" <?php } ?>></td>
                </tr>
                <tr class="text-center text-dark alert-link">
                    <td>31</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_31" name="pieza_31" value="X" <?php if (isset($reg[0]['pieza_31']) && $reg[0]['pieza_31'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_31"></label></div></div>
                    </td>
                    <td>41</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_41" name="pieza_41" value="X" <?php if (isset($reg[0]['pieza_41']) && $reg[0]['pieza_41'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_41"></label></div></div>
                    </td>
                    <td>71</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_71" name="pieza_71" value="X" <?php if (isset($reg[0]['pieza_71']) && $reg[0]['pieza_71'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_71"></label></div></div>
                    </td>
                    
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="3" name="pieza_5_placa" id="pieza_5_placa" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 3){ this.value='3'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_5_placa'])) { ?> value="<?php echo $reg[0]['pieza_5_placa']; ?>" <?php } ?>></td>
                    
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="3" name="pieza_5_calculo" id="pieza_5_calculo" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 3){ this.value='3'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_5_calculo'])) { ?> value="<?php echo $reg[0]['pieza_5_calculo']; ?>" <?php } ?>></td>
                    
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="1" name="pieza_5_gingivitis" id="pieza_5_gingivitis" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 1){ this.value='1'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_5_gingivitis'])) { ?> value="<?php echo $reg[0]['pieza_5_gingivitis']; ?>" <?php } ?>></td>
                </tr>
                <tr class="text-center text-dark alert-link">
                    <td>46</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_46" name="pieza_46" value="X" <?php if (isset($reg[0]['pieza_46']) && $reg[0]['pieza_46'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_46"></label></div></div>
                    </td>
                    <td>47</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_47" name="pieza_47" value="X" <?php if (isset($reg[0]['pieza_47']) && $reg[0]['pieza_47'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_47"></label></div></div>
                    </td>
                    <td>85</td>
                    <td><div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pieza_85" name="pieza_85" value="X" <?php if (isset($reg[0]['pieza_85']) && $reg[0]['pieza_85'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="pieza_85"></label></div></div>
                    </td>
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="3" name="pieza_6_placa" id="pieza_6_placa" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 3){ this.value='3'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_6_placa'])) { ?> value="<?php echo $reg[0]['pieza_6_placa']; ?>" <?php } ?>></td>
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="3" name="pieza_6_calculo" id="pieza_6_calculo" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 3){ this.value='3'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_6_calculo'])) { ?> value="<?php echo $reg[0]['pieza_6_calculo']; ?>" <?php } ?>></td>
                    <td><input class="text" type="text" size="1" maxlength="1" min="0" max="1" name="pieza_6_gingivitis" id="pieza_6_gingivitis" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:50px;" onKeyUp="this.value=this.value.toUpperCase(); if(this.value > 1){ this.value='1'; return false; } SumPiezas();" autocomplete="off" <?php if (isset($reg[0]['pieza_6_gingivitis'])) { ?> value="<?php echo $reg[0]['pieza_6_gingivitis']; ?>" <?php } ?>></td>
                </tr>
                <tr class="text-center text-dark alert-link">
                    <td colspan="6">TOTALES</td>
                    <td><label id="sum_placa"><?php if (isset($reg[0]['cododontologia'])) { echo $reg[0]['pieza_1_placa']+$reg[0]['pieza_2_placa']+$reg[0]['pieza_3_placa']+$reg[0]['pieza_4_placa']+$reg[0]['pieza_5_placa']+$reg[0]['pieza_6_placa']; } else { ?>0<?php } ?></label></td>
                    <td><label id="sum_calculo"><?php if (isset($reg[0]['cododontologia'])) { echo $reg[0]['pieza_1_calculo']+$reg[0]['pieza_2_calculo']+$reg[0]['pieza_3_calculo']+$reg[0]['pieza_4_calculo']+$reg[0]['pieza_5_calculo']+$reg[0]['pieza_6_calculo']; } else { ?>0<?php } ?></label></td>
                    <td><label id="sum_gingivitis"><?php if (isset($reg[0]['cododontologia'])) { echo $reg[0]['pieza_1_gingivitis']+$reg[0]['pieza_2_gingivitis']+$reg[0]['pieza_3_gingivitis']+$reg[0]['pieza_4_gingivitis']+$reg[0]['pieza_5_gingivitis']+$reg[0]['pieza_6_gingivitis']; } else { ?>0<?php } ?></label></td>
                </tr>
                <!--<tr class="text-center text-dark alert-link">
                    <td colspan="6">&nbsp;</td>
                    <td><label id="div_placa"></label></td>
                    <td><label id="div_calculo"></label></td>
                    <td><label id="div_gingivitis"></label></td>
                </tr>-->
            </table>

            </div>
            <!-- /.col -->
        
            <!-- .col -->  
            <div class="col-md-6">
            
            <table class="table2 table-striped table-bordered border display">
                <tr class="text-center text-dark alert-link">
                   <td colspan="2">ENFERMEDAD PERIODONTAL</td>
                   <td colspan="2">MAL OCLUSI&Oacute;N</td>
                   <td colspan="2">FLUOROSIS</td>
                </tr>
                <tr class="text-center text-dark alert-link font-12">
                    <td>LEVE</td>
                    
                    <td><div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="periodontal1" name="periodontal" value="LEVE" <?php if (isset($reg[0]['periodontal']) && $reg[0]['periodontal'] == "LEVE") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="periodontal1"></label></div>
                    </td>

                    <td>ANGLE I  </td>
                    <td><div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="oclusion1" name="oclusion" value="I" <?php if (isset($reg[0]['oclusion']) && $reg[0]['oclusion'] == "I") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="oclusion1"></label></div>
                    </td>
                    <td>LEVE</td>
                    <td><div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="fluorosis1" name="fluorosis" value="LEVE" <?php if (isset($reg[0]['fluorosis']) && $reg[0]['fluorosis'] == "LEVE") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="fluorosis1"></label></div>
                    </td>
                </tr>
                <tr class="text-center text-dark alert-link font-12">
                    <td>MODERADA</td>
                    
                    <td><div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="periodontal2" name="periodontal" value="MODERADA" <?php if (isset($reg[0]['periodontal']) && $reg[0]['periodontal'] == "MODERADA") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="periodontal2"></label></div>
                    </td>

                    <td>ANGLE II</td>
                    <td><div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="oclusion2" name="oclusion" value="II" <?php if (isset($reg[0]['oclusion']) && $reg[0]['oclusion'] == "II") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="oclusion2"></label></div>
                    </td>
                    <td>MODERADA</td>
                    <td><div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="fluorosis2" name="fluorosis" value="MODERADA" <?php if (isset($reg[0]['fluorosis']) && $reg[0]['fluorosis'] == "MODERADA") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="fluorosis2"></label></div>
                    </td>
                </tr>
                <tr class="text-center text-dark alert-link font-12">
                    <td>SEVERA</td>
                    
                    <td><div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="periodontal3" name="periodontal" value="SEVERA" <?php if (isset($reg[0]['periodontal']) && $reg[0]['periodontal'] == "SEVERA") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="periodontal3"></label></div>
                    </td>

                    <td>ANGLE III </td>
                    <td><div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="oclusion3" name="oclusion" value="III" <?php if (isset($reg[0]['oclusion']) && $reg[0]['oclusion'] == "III") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="oclusion3"></label></div>
                    </td>
                    <td>SEVERA</td>
                    <td><div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="fluorosis3" name="fluorosis" value="SEVERA" <?php if (isset($reg[0]['fluorosis']) && $reg[0]['fluorosis'] == "SEVERA") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label" for="fluorosis3"></label></div>
                    </td>
                </tr>
            </table>

            </div>
            <!-- /.col -->

        </div>  

        </div>
        <!-- /.col -->
        
        <!-- .col -->  
        <div class="col-md-3">
        
        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> 8. ÍNDICES CPO-ceo</h5><hr>

        <div class="row">

            <table class="table2 table-striped table-bordered border display">
                <tr class="text-center text-dark alert-link">
                    <td rowspan="2">D</td>
                    <td>C</td>
                    <td>P</td>
                    <td>O</td>
                    <td>TOTAL</td>
                </tr>
                <tr class="text-center text-dark alert-link">
                    <td><input class="text" step="" type="text" name="cpo_1_c" id="cpo_1_c" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:40px;" onKeyUp="this.value=this.value.toUpperCase(); Cpo_1();" autocomplete="off" <?php if (isset($reg[0]['cpo_1_c'])) { ?> value="<?php echo $reg[0]['cpo_1_c']; ?>" <?php } ?>></td>
                    <td><input class="text" type="text" name="cpo_1_p" id="cpo_1_p" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:40px;" onKeyUp="this.value=this.value.toUpperCase(); Cpo_1();" autocomplete="off" <?php if (isset($reg[0]['cpo_1_p'])) { ?> value="<?php echo $reg[0]['cpo_1_p']; ?>" <?php } ?>></td>
                    <td><input class="text" type="text" name="cpo_1_o" id="cpo_1_o" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:40px;" onKeyUp="this.value=this.value.toUpperCase(); Cpo_1();" autocomplete="off" <?php if (isset($reg[0]['cpo_1_o'])) { ?> value="<?php echo $reg[0]['cpo_1_o']; ?>" <?php } ?>></td>
                    <td><label id="cpo_1"><?php if (isset($reg[0]['cododontologia'])) { echo $reg[0]['cpo_1_c']+$reg[0]['cpo_1_p']+$reg[0]['cpo_1_o']; } else { ?>0<?php } ?></label></td>
                </tr>
                <tr class="text-center text-dark alert-link">
                    <td rowspan="2">d</td>
                    <td>c</td>
                    <td>e</td>
                    <td>o</td>
                    <td>TOTAL</td>
                </tr>
                <tr class="text-center text-dark alert-link">
                    <td><input class="text" type="text" name="cpo_2_c" id="cpo_2_c" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:40px;" onKeyUp="this.value=this.value.toUpperCase(); Cpo_2();" autocomplete="off" <?php if (isset($reg[0]['cpo_2_c'])) { ?> value="<?php echo $reg[0]['cpo_2_c']; ?>" <?php } ?>></td>
                    <td><input class="text" type="text" name="cpo_2_e" id="cpo_2_e" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:40px;" onKeyUp="this.value=this.value.toUpperCase(); Cpo_2();" autocomplete="off" <?php if (isset($reg[0]['cpo_2_e'])) { ?> value="<?php echo $reg[0]['cpo_2_e']; ?>" <?php } ?>></td>
                    <td><input class="text" type="text" name="cpo_2_o" id="cpo_2_o" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:25px;width:40px;" onKeyUp="this.value=this.value.toUpperCase(); Cpo_2();" autocomplete="off" <?php if (isset($reg[0]['cpo_2_o'])) { ?> value="<?php echo $reg[0]['cpo_2_o']; ?>" <?php } ?>></td>
                    <td><label id="cpo_2"><?php if (isset($reg[0]['cododontologia'])) { echo $reg[0]['cpo_2_c']+$reg[0]['cpo_2_e']+$reg[0]['cpo_2_o']; } else { ?>0<?php } ?></label></td>
                </tr>
            </table>
        </div>   

        </div>
        <!-- /.col -->
       
        </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> 9. Planes de Diagnótico, Terapéutico y Educacional</h5><hr>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="biometria" name="biometria" value="X" <?php if (isset($reg[0]['biometria']) && $reg[0]['biometria'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="biometria">Biometria</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="quimica" name="quimica" value="X" <?php if (isset($reg[0]['quimica']) && $reg[0]['quimica'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="quimica">Quimica Sanguinea</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="rayosx" name="rayosx" value="X" <?php if (isset($reg[0]['rayosx']) && $reg[0]['rayosx'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="rayosx">Rayox-X</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="otros_planes" name="otros_planes" value="X" <?php if (isset($reg[0]['otros_planes']) && $reg[0]['otros_planes'] == "X") { ?> checked="checked" <?php } ?>>
                        <label class="custom-control-label text-dark alert-link" for="otros_planes">Otros</label>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group has-feedback2"> 
                    <label class="control-label">Observaciones: </label> 
                    <textarea class="form-control" type="text" name="observaciones_planes" id="observaciones_planes" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observaciones" rows="2"><?php if (isset($reg[0]['observaciones_planes'])) { echo $reg[0]['observaciones_planes']; } ?></textarea>
                </div> 
            </div>
        </div>


        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> 10. Diagnóstico</h5><hr>

        <div class="row">
            <div class="col-md-6"> 
                <div class="form-group has-feedback">
                <table width="100%" id="tabla"><tr> 

<a class="btn btn-primary rounded-circle" onClick="AddDxPresuntivoIngreso()" title="Agregar"><i data-feather="plus-circle"></i></a>&nbsp;
<a class="btn btn-danger rounded-circle" onClick="DeleteDxPresuntivoIngreso()" title="Quitar"><i data-feather="x-circle"></i></a><br></br>

                    <td>
            <?php
            if (isset($reg[0]['presuntivo'])) {

            $explode = explode(",,",$reg[0]['presuntivo']);
            for($cont=0; $cont<COUNT($explode); $cont++):
            list($idciepresuntivo,$presuntivo) = explode("/",$explode[$cont]);
            ?>
                <div class="form-group has-feedback"> 
                    <label class="control-label alert-link">Dx Presuntivo: </label>
                    <input type="hidden" name="idciepresuntivoingreso[]<?php echo $cont; ?>" id="idciepresuntivoingreso<?php echo $cont; ?>" value="<?php echo $idciepresuntivo; ?>"/>
                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="presuntivoingreso[]<?php echo $cont; ?>" id="presuntivoingreso<?php echo $cont; ?>" onKeyUp="this.value=this.value.toUpperCase(); autocompletarpresingreso(this.name);" value="<?php echo $presuntivo; ?>" placeholder="Ingrese Nombre de Dx para tu Busqueda" title="Ingrese Dx Presuntivo">
                </div>

            <?php endfor; 

            } else { ?>

                <div class="form-group has-feedback"> 
                    <label class="control-label alert-link">Dx Presuntivo: </label>
                    <input type="hidden" name="idciepresuntivoingreso[]" id="idciepresuntivoingreso"/>
                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="presuntivoingreso[]" id="presuntivoingreso" onKeyUp="this.value=this.value.toUpperCase(); autocompletarpresingreso(this.name);" placeholder="Ingrese Nombre de Dx para tu Busqueda" title="Ingrese Dx Presuntivo">
                </div>

            <?php } ?>

                 </td></tr><input type="hidden" name="var_cont">
                </table>
                </div> 
            </div>

            <div class="col-md-6"> 
                <div class="form-group has-feedback">
                <table width="100%" id="tabla2"><tr> 

<a class="btn btn-primary rounded-circle" onClick="AddDxDefinitivoIngreso()" title="Agregar"><i data-feather="plus-circle"></i></a>&nbsp;
<a class="btn btn-danger rounded-circle" onClick="DeleteDxDefinitivoIngreso()" title="Quitar"><i data-feather="x-circle"></i></a><br></br>
                    <td>
            <?php
            if (isset($reg[0]['definitivo'])) {

            $explode = explode(",,",$reg[0]['definitivo']);
            for($cont=0; $cont<COUNT($explode); $cont++):
            list($idciedefinitivo,$definitivo) = explode("/",$explode[$cont]);    
            ?>

                <div class="form-group has-feedback"> 
                    <label class="control-label alert-link">Dx Definitivo: </label>
                    <input type="hidden" name="idciedefinitivoingreso[]" id="idciedefinitivoingreso" value="<?php echo $idciedefinitivo; ?>"/>
                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="definitivoingreso[]" id="definitivoingreso" onKeyUp="this.value=this.value.toUpperCase(); autocompletardefingreso(this.name);" value="<?php echo $definitivo; ?>" placeholder="Ingrese Nombre de Dx para tu Busqueda" title="Ingrese Dx Definitivo">
                </div>

            <?php endfor; 

            } else { ?>

                <div class="form-group has-feedback"> 
                    <label class="control-label alert-link">Dx Definitivo: </label>
                    <input type="hidden" name="idciedefinitivoingreso[]" id="idciedefinitivoingreso"/>
                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="definitivoingreso[]" id="definitivoingreso" onKeyUp="this.value=this.value.toUpperCase(); autocompletardefingreso(this.name);" placeholder="Ingrese Nombre de Dx para tu Busqueda" title="Ingrese Dx Definitivo">
                </div>

            <?php } ?>

            </td></tr><input type="hidden" name="var_cont">
                </table>
                </div> 
            </div>
        </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> 11. Tratamiento</h5><hr>

        <?php if (isset($reg[0]['cododontologia'])) { ?>

        <?php       
        $detalle = new Login();
        $detalle = $detalle->VerDetallesOdontologia();
        $a=1;
        for($i=0;$i<sizeof($detalle);$i++){ 
        ?>

        <h3 class="card-subtitle m-0 text-dark"><i class="font-22 mdi mdi-code-string"></i> Sesión Nº <?php echo $a++; ?></h3><hr>

        <div class="row">
            <div class="col-md-4"> 
                <div class="form-group has-feedback2"> 
                   <label class="control-label">Diagnostico y Complicaciones: <span class="symbol required"></span></label> 
                   <input type="hidden" name="coddetalleodontologia[]" id="coddetalleodontologia" value="<?php echo $detalle[$i]['coddetalleodontologia']; ?>" />
                   <textarea class="form-control" type="text" name="diagnostico[]" id="diagnostico" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Diagnostico" rows="3"><?php echo $detalle[$i]['diagnostico']; ?></textarea>
                </div> 
            </div>

            <div class="col-md-4"> 
                <div class="form-group has-feedback2"> 
                   <label class="control-label">Procedimientos: <span class="symbol required"></span></label> 
                   <textarea class="form-control" type="text" name="procedimientos[]" id="procedimientos" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Procedimientos" rows="3"><?php echo $detalle[$i]['procedimientos']; ?></textarea>
                </div> 
            </div>

            <div class="col-md-4"> 
                <div class="form-group has-feedback2"> 
                   <label class="control-label">Prescripciones: <span class="symbol required"></span></label> 
                   <textarea class="form-control" type="text" name="prescripciones[]" id="prescripciones" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Prescripciones" rows="3"><?php echo $detalle[$i]['prescripciones']; ?></textarea>
                </div> 
            </div>
        </div>

        <?php } ?>

        <?php } else { ?>

        <div class="row">
            <div class="col-md-4"> 
                <div class="form-group has-feedback2"> 
                   <label class="control-label">Diagnostico y Complicaciones: <span class="symbol required"></span></label> 
                   <textarea class="form-control" type="text" name="diagnostico" id="diagnostico" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Diagnostico" rows="3"><?php if (isset($reg[0]['diagnostico'])) { echo $reg[0]['diagnostico']; } ?></textarea>
                </div> 
            </div>

            <div class="col-md-4"> 
                <div class="form-group has-feedback2"> 
                   <label class="control-label">Procedimientos: <span class="symbol required"></span></label> 
                   <textarea class="form-control" type="text" name="procedimientos" id="procedimientos" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Procedimientos" rows="3"><?php if (isset($reg[0]['procedimientos'])) { echo $reg[0]['procedimientos']; } ?></textarea>
                </div> 
            </div>

            <div class="col-md-4"> 
                <div class="form-group has-feedback2"> 
                   <label class="control-label">Prescripciones: <span class="symbol required"></span></label> 
                   <textarea class="form-control" type="text" name="prescripciones" id="prescripciones" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Prescripciones" rows="3"><?php if (isset($reg[0]['prescripciones'])) { echo $reg[0]['prescripciones']; } ?></textarea>
                </div> 
            </div>
        </div>

        <?php } ?>

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
    <script type="text/javascript" src="assets/script/agrega_filas.js"></script>
    <script type="text/javascript" src="assets/script/jsAcciones.js"></script>
    <script type="text/javascript" src="assets/script/html2canvas.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/script/script2.js"></script>
    <script type="text/javascript" src="assets/script/validation.min.js"></script>
    <script type="text/javascript" src="assets/script/script.js"></script>
    <!-- script jquery -->

    <!-- Calendario -->
    <link rel="stylesheet" href="assets/calendario/jquery-ui.css" />
   <!--<link href="plugins/autocomplete/autocomplete.css" rel="stylesheet" type="text/css" />-->
    <script src="plugins/flatpickr/flatpickr.js"></script>
    <script src="assets/calendario/jquery-ui.js"></script>
    <script src="assets/script/jscalendario.js"></script>
    <script src="assets/script/autocompleto.js"></script>
    <!-- Calendario -->

    <!-- jQuery Noty-->
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <!-- jQuery Noty-->

    <script>
    cargarTratamientos("divTratamiento", "funciones.php?BuscaTablaTratamiento=si&codpaciente="+$('#codpaciente').val()+"&codsucursal="+$('#codsucursal').val(), '', '');
    cargarDientes("seccionDientes", "dientes.php", '', $('#codpaciente').val(), $('#codsucursal').val());
    </script>

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