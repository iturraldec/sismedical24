<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
    if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "enfermera" || ($_SESSION['acceso'] == "medico" && in_array("1", explode(",", $_SESSION['modulos'])))) {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

if(isset($_POST["proceso"]) and $_POST["proceso"]=="save")
{
$reg = $tra->RegistrarAperturas();
exit;
}
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarAperturas();
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

<!--############################## MODAL BUSQUEDA DE CITAS EN APERTURA DE HISTORIA ######################################-->
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
                    <input type="hidden" name="codverifica" id="codverifica" value="<?php echo "1"; ?>"/>
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
                    <input type="hidden" name="codverifica" id="codverifica" value="<?php echo "1"; ?>"/>
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
<!--############################## MODAL BUSQUEDA DE CITAS EN APERTURA DE HISTORIA ######################################-->

    
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
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Gestión de Aperturas</h5>
                                    </div>                 
                                </div>
                            </div>

    <div class="widget-content widget-content-area">                                

     <?php  if (isset($_GET['numero'])) {
      
      $reg = $tra->AperturasPorId(); 
    ?>
      
      
    <form class="form-material" novalidate method="post" action="#" name="updateapertura" id="updateapertura" data-id="<?php echo $reg[0]["codapertura"] ?>" enctype="multipart/form-data">
        
    <?php } else { ?>

    <form class="form-material" novalidate method="post" action="#" name="saveapertura" id="saveapertura" enctype="multipart/form-data">
              
    <?php } ?>
            
        <div id="save">
            <!-- error will be shown here ! -->
        </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="user"></i> Datos del Paciente</h5><hr> 

        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Nº de Historia: <span class="symbol required"></span></label>
                <div class="input-group">
                    <input type="hidden" name="formulario" id="formulario" value="<?php echo "foraperturac"; ?>"/>
                    <input type="hidden" name="modulo" id="modulo" value="<?php echo "1"; ?>"/>
                    <input type="hidden" name="proceso" id="proceso" <?php if (isset($reg[0]['codapertura'])) { ?> value="update" <?php } else { ?>  value="save" <?php } ?>/>
                    <input type="hidden" name="idapertura" id="idapertura" <?php if (isset($reg[0]['idapertura'])) { ?> value="<?php echo encrypt($reg[0]['idapertura']); ?>" <?php } ?>>
                    <input type="hidden" name="codapertura" id="codapertura" <?php if (isset($reg[0]['codapertura'])) { ?> value="<?php echo encrypt($reg[0]['codapertura']); ?>" <?php } ?>/>

                    <input type="hidden" name="verifica_busqueda" id="verifica_busqueda"/>
                    <input type="hidden" name="sucursal_busqueda" id="sucursal_busqueda" <?php if (isset($reg[0]['codsucursal'])) { ?> value="<?php echo encrypt($reg[0]['codsucursal']); ?>" <?php } ?>/>
                    <input type="hidden" name="especialidad_busqueda" id="especialidad_busqueda"/>
                    <input type="hidden" name="medico_busqueda" id="medico_busqueda" <?php if (isset($reg[0]['codmedico'])) { ?> value="<?php echo encrypt($reg[0]['codmedico']); ?>" <?php } ?>/>
                    <input type="hidden" name="fecha_busqueda" id="fecha_busqueda"/>

                    <input type="hidden" name="codcita" id="codcita" <?php if (isset($reg[0]['codcita'])) { ?> value="<?php echo encrypt($reg[0]['codcita']); ?>" <?php } ?>/>
                    <input type="hidden" name="cita" id="cita" <?php if (isset($reg[0]['codcita'])) { ?> value="<?php echo $reg[0]['codcita']; ?>" <?php } ?>/>
                    <input type="hidden" name="codpaciente" id="codpaciente" <?php if (isset($reg[0]['codpaciente'])) { ?> value="<?php echo encrypt($reg[0]['codpaciente']); ?>" <?php } ?>/>
                    <input type="hidden" name="paciente" id="paciente" <?php if (isset($reg[0]['codpaciente'])) { ?> value="<?php echo $reg[0]['codpaciente']; ?>" <?php } ?>/> 

                    <?php if (isset($reg[0]['idapertura'])) { ?>

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

        <div id="msj_aperturas"></div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> Motivo de Consulta</h5><hr>

        <div class="row">
            <div class="col-md-6"> 
                <div class="form-group has-feedback2">
                    <label class="control-label">Motivo de Consulta: <span class="symbol required"></span></label> 
                    <textarea class="form-control" name="motivoconsulta" id="motivoconsulta" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Motivo de Consulta" rows="2" required="" aria-required="true"><?php if (isset($reg[0]['motivoconsulta'])) { echo $reg[0]['motivoconsulta']; } ?></textarea> 
                </div> 
            </div>

            <div class="col-md-6"> 
                <div class="form-group has-feedback2"> 
                    <label class="control-label">Exámen Físico: <span class="symbol required"></span></label> 
                    <textarea class="form-control" name="examenfisico" id="examenfisico" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Exámen Físico" rows="2" required="" aria-required="true"><?php if (isset($reg[0]['examenfisico'])) { echo $reg[0]['examenfisico']; } ?></textarea>
                </div> 
            </div> 
        </div>
        
        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> Signos Vitales</h5><hr>

        <div class="row">
            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">PA(mm/Hg): <span class="symbol required"></span></label> 
                    <input class="form-control" type="text" name="ta" id="ta" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese PA" <?php if (isset($reg[0]['ta'])) { ?> value="<?php echo $reg[0]['ta']; ?>" <?php } ?> required="" aria-required="true">
                </div> 
            </div>

            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">Temperatura:(°C): <span class="symbol required"></span></label> 
                    <input class="form-control" type="text" name="temperatura" id="temperatura" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Temperatura" <?php if (isset($reg[0]['temperatura'])) { ?> value="<?php echo $reg[0]['temperatura']; ?>" <?php } ?> required="" aria-required="true">
                </div> 
            </div>

             <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">FC(por minuto): <span class="symbol required"></span></label> 
                    <input class="form-control" type="text" name="fc" id="fc" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese FC" <?php if (isset($reg[0]['fc'])) { ?> value="<?php echo $reg[0]['fc']; ?>" <?php } ?> required="" aria-required="true">
                </div> 
            </div>

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">FR(por minuto): <span class="symbol required"></span></label> 
                    <input class="form-control" type="text" name="fr" id="fr" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese FR" <?php if (isset($reg[0]['fr'])) { ?> value="<?php echo $reg[0]['fr']; ?>" <?php } ?> required="" aria-required="true">
                </div> 
            </div>

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">PESO(Kg): <span class="symbol required"></span></label> 
                    <input class="form-control" type="text" name="peso" id="peso" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Peso" <?php if (isset($reg[0]['peso'])) { ?> value="<?php echo $reg[0]['peso']; ?>" <?php } ?> required="" aria-required="true">
                </div> 
            </div>

            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">Talla:</label> 
                    <input class="form-control" type="numeric" name="talla" id="talla" placeholder="Ingrese Talla" <?php if (isset($reg[0]['talla'])) { ?> value="<?php echo $reg[0]['talla']; ?>" <?php } ?>>
                </div> 
            </div>

            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">IMC = Peso/Talla</label> 
                    <input class="form-control" type="numeric" name="imc" id="imc" <?php if (isset($reg[0]['imc'])) { ?> value="<?php echo $reg[0]['imc']; ?>" <?php } ?> readonly>
                </div> 
            </div>
        </div> 


        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> Enfermedad Actual del Paciente</h5><hr>

        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group has-feedback2">
                    <label class="control-label">Enfermedad Actual del Paciente: <span class="symbol required"></span></label> 
                    <textarea class="form-control" name="enfermedadpaciente" id="enfermedadpaciente" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Enfermedad Actual del Paciente" rows="2" required="" aria-required="true"><?php if (isset($reg[0]['enfermedadpaciente'])) { echo $reg[0]['enfermedadpaciente']; } ?></textarea> 
                </div> 
            </div>
        </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> Antecedentes del Paciente</h5><hr>

        <div class="row">
            <div class="col-md-4"> 
                <div class="form-group has-feedback2">
                    <label class="control-label">Antecedentes Personales: <span class="symbol required"></span></label> 
                    <textarea class="form-control" name="antecedentepaciente" id="antecedentepaciente" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Antecedentes Personales" rows="2" required="" aria-required="true"><?php if (isset($reg[0]['antecedentepaciente'])) { echo $reg[0]['antecedentepaciente']; } ?></textarea> 
                </div> 
            </div>

            <div class="col-md-4"> 
                <div class="form-group has-feedback2">
                    <label class="control-label">Antecedentes Familiares: <span class="symbol required"></span></label> 
                    <textarea class="form-control" name="antecedentefamiliares" id="antecedentefamiliares" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Antecedentes Familiares" rows="2" required="" aria-required="true"><?php if (isset($reg[0]['antecedentefamiliares'])) { echo $reg[0]['antecedentefamiliares']; } ?></textarea> 
                </div> 
            </div>

            <div class="col-md-4"> 
                <div class="form-group has-feedback2">
                    <label class="control-label">Antecedentes Alérgico: <span class="symbol required"></span></label> 
                    <textarea class="form-control" name="antecedentealergico" id="antecedentealergico" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Antecedentes Alérgico" rows="2" required="" aria-required="true"><?php if (isset($reg[0]['antecedentealergico'])) { echo $reg[0]['antecedentealergico']; } ?></textarea> 
                </div> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"> 
                <div class="form-group has-feedback2">
                    <label class="control-label">Antecedentes Patólogicos: <span class="symbol required"></span></label> 
                    <textarea class="form-control" name="antecedentepatologico" id="antecedentepatologico" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Antecedentes Patólogicos" rows="2" required="" aria-required="true"><?php if (isset($reg[0]['antecedentepatologico'])) { echo $reg[0]['antecedentepatologico']; } ?></textarea> 
                </div> 
            </div>

            <div class="col-md-4"> 
                <div class="form-group has-feedback2">
                    <label class="control-label">Antecedentes Quirúrgicos: <span class="symbol required"></span></label> 
                    <textarea class="form-control" name="antecedentequirurgico" id="antecedentequirurgico" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Antecedentes Quirúrgicos" rows="2" required="" aria-required="true"><?php if (isset($reg[0]['antecedentequirurgico'])) { echo $reg[0]['antecedentequirurgico']; } ?></textarea> 
                </div> 
            </div>

            <div class="col-md-4"> 
                <div class="form-group has-feedback2">
                    <label class="control-label">Medicación Actual: <span class="symbol required"></span></label> 
                    <textarea class="form-control" name="antecedentefarmacologico" id="antecedentefarmacologico" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Medicación Actual" rows="2" required="" aria-required="true"><?php if (isset($reg[0]['antecedentefarmacologico'])) { echo $reg[0]['antecedentefarmacologico']; } ?></textarea> 
                </div> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"> 
                <div class="form-group has-feedback2">
                    <label class="control-label">Antecedentes Ginecológicos: </label> 
                    <textarea class="form-control" name="antecedenteginecologico" id="antecedenteginecologico" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Antecedentes Ginecológicos" rows="2" required="" aria-required="true"><?php if (isset($reg[0]['antecedenteginecologico'])) { echo $reg[0]['antecedenteginecologico']; } ?></textarea> 
                </div> 
            </div>

            <div class="col-md-4"> 
                <div class="form-group has-feedback2">
                    <label class="control-label">Historial Gestacional: </label> 
                    <textarea class="form-control" name="historialgestacional" id="historialgestacional" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Historial Gestacional" rows="2" required="" aria-required="true"><?php if (isset($reg[0]['historialgestacional'])) { echo $reg[0]['historialgestacional']; } ?></textarea> 
                </div> 
            </div>

            <div class="col-md-4"> 
                <div class="form-group has-feedback2">
                    <label class="control-label">Planificación Familiar: </label> 
                    <textarea class="form-control" name="planificacionfamiliar" id="planificacionfamiliar" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Planificación Familiar" rows="2" required="" aria-required="true"><?php if (isset($reg[0]['planificacionfamiliar'])) { echo $reg[0]['planificacionfamiliar']; } ?></textarea> 
                </div> 
            </div>
        </div>


        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> Diagnóstico de la Enfermedad o Accidente</h5><hr>

        <div class="row">
            <div class="col-md-6"> 
<a class="btn btn-primary rounded-circle" onClick="AddDxPresuntivo()" title="Agregar"><i data-feather="plus-circle"></i></a>&nbsp;
<a class="btn btn-danger rounded-circle" onClick="DeleteDxPresuntivo()" title="Quitar"><i data-feather="x-circle"></i></a>
            <table width="100%" id="tabla"><tr> 
            <td>
            <?php
            if (isset($reg[0]['dxpresuntivo']) && strlen($reg[0]['dxpresuntivo']) > 0) {
            $explode = explode(",,",$reg[0]['dxpresuntivo']);
            for($cont=0; $cont<COUNT($explode); $cont++):
            list($presuntivo) = explode("/",$explode[$cont]);
            ?>
                <div class="form-group has-feedback"> 
                    <label class="control-label alert-link">Dx Presuntivo:</label>
                    <input type="hidden" name="idciepresuntivo[]<?php echo $cont; ?>" id="idciepresuntivo<?php echo $cont; ?>" value="<?php echo $idciepresuntivo; ?>"/>
                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="presuntivo[]<?php echo $cont; ?>" id="presuntivo<?php echo $cont; ?>" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" value="<?php echo $presuntivo; ?>" placeholder="Ingrese Nombre de Dx para tu Busqueda" title="Ingrese Dx Presuntivo">
                    <!-- <textarea class="form-control" name="observacionpresuntivo[]<?php echo $cont; ?>" id="observacionpresuntivo<?php echo $cont; ?>" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Dx Presuntivo" title="Ingrese Observación de Dx Presuntivo" rows="2"><?php echo $observacionpresuntivo; ?></textarea> -->
                </div>

            <?php endfor; 

            } else { ?>

                <div class="form-group has-feedback"> 
                    <label class="control-label alert-link">Dx Presuntivo:</span></label>
                    <input type="hidden" name="idciepresuntivo[]" id="idciepresuntivo"/>
                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="presuntivo[]" id="presuntivo" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" placeholder="Ingrese Nombre de Dx para tu Busqueda" title="Ingrese Dx Presuntivo">
                    <!-- <textarea class="form-control" name="observacionpresuntivo[]" id="observacionpresuntivo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Dx Presuntivo" title="Ingrese Observación de Dx Presuntivo" rows="2" required="" aria-required="true"></textarea> -->

                </div>

            <?php } ?>

                 </td></tr><input type="hidden" name="var_cont">
                </table>
            </div>

            <div class="col-md-6"> 
<a class="btn btn-primary rounded-circle" onClick="AddDxDefinitivo()" title="Agregar"><i data-feather="plus-circle"></i></a>&nbsp;
<a class="btn btn-danger rounded-circle" onClick="DeleteDxDefinitivo()" title="Quitar"><i data-feather="x-circle"></i></a>
            <table width="100%" id="tabla2"><tr> 
            <td>
            <?php
            if (isset($reg[0]['dxdefinitivo']) && strlen($reg[0]['dxdefinitivo']) > 0) {

            $explode = explode(",,",$reg[0]['dxdefinitivo']);
            for($cont=0; $cont<COUNT($explode); $cont++):
            list($definitivo) = explode("/",$explode[$cont]);    
            ?>

                <div class="form-group has-feedback"> 
                    <label class="control-label alert-link">Dx Definitivo:</label>
                    <input type="hidden" name="idciedefinitivo[]<?php echo $cont; ?>" id="idciedefinitivo<?php echo $cont; ?>" value="<?php echo $idciedefinitivo; ?>"/>
                    <input style="color:#000;font-weight:bold;" class="form-control" type="text" name="definitivo[]<?php echo $cont; ?>" id="definitivo<?php echo $cont; ?>" onKeyUp="this.value=this.value.toUpperCase(); autocompletar2(this.name);" value="<?php echo $definitivo; ?>" placeholder="Ingrese Nombre de Dx para tu Busqueda" title="Ingrese Dx Definitivo">
                    <!-- <textarea class="form-control" name="observaciondefinitivo[]<?php echo $cont; ?>" id="observaciondefinitivo<?php echo $cont; ?>" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Dx Definitivo" title="Ingrese Observación de Dx Definitivo" rows="2" required="" aria-required="true"><?php echo $observaciondefinitivo; ?></textarea> -->
                </div>

            <?php endfor; 

            } else { ?>

                <div class="form-group has-feedback"> 
                    <label class="control-label alert-link">Dx Definitivo:</label>
                    <input type="hidden" name="idciedefinitivo[]" id="idciedefinitivo"/>
                    <input style="color:#000;font-weight:bold;" class="form-control" type="text" name="definitivo[]" id="definitivo" onKeyUp="this.value=this.value.toUpperCase(); autocompletar2(this.name);" placeholder="Ingrese Nombre de Dx para tu Busqueda" title="Ingrese Dx Definitivo">
<!--                     <textarea class="form-control" name="observaciondefinitivo[]" id="observaciondefinitivo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Dx Definitivo" title="Ingrese Observación de Dx Definitivo" rows="2" required="" aria-required="true"></textarea> -->
                </div>

            <?php } ?>

            </td></tr><input type="hidden" name="var_cont">
            </table>
            </div>
        </div>

        <div class="row">
            <!-- <div class="col-md-6"> 
                <div class="form-group has-feedback">
                    <label class="control-label">Origen de la Enfermedad o Accidente del Paciente: <span class="symbol required"></span></label>
                    <?php if (isset($reg[0]['origenenfermedad'])) { ?>
                    <select style="color:#000;font-weight:bold;" name="origenenfermedad" id="origenenfermedad" class='form-control' required="" aria-required="true">
                    <option value=""> -- SELECCIONE -- </option>
                    <option value="PACIENTE SANO"<?php if (!(strcmp('PACIENTE SANO', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>PACIENTE SANO</option>
                    <option value="ACCIDENTE DE TRABAJO"<?php if (!(strcmp('ACCIDENTE DE TRABAJO', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>ACCIDENTE DE TRABAJO</option>
                    <option value="ACCIDENTE DE TRANSITO"<?php if (!(strcmp('ACCIDENTE DE TRANSITO', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>ACCIDENTE DE TRANSITO</option>
                    <option value="ACCIDENTE RAPIDO"<?php if (!(strcmp('ACCIDENTE RAPIDO', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>ACCIDENTE RAPIDO</option>
                    <option value="ACCIDENTE OFIDICO"<?php if (!(strcmp('ACCIDENTE OFIDICO', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>ACCIDENTE OFIDICO</option>
                    <option value="OTRO TIPO DE ACCIDENTE"<?php if (!(strcmp('OTRO TIPO DE ACCIDENTE', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>OTRO TIPO DE ACCIDENTE</option>
                    <option value="EVENTO CATASTROFICO"<?php if (!(strcmp('EVENTO CATASTROFICO', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>EVENTO CATASTROFICO</option>
                    <option value="LESION POR AGRESION"<?php if (!(strcmp('LESION POR AGRESION', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>LESION POR AGRESION</option>
                    <option value="LESION AUTO INFLINGIDA"<?php if (!(strcmp('LESION AUTO INFLINGIDA', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>LESION AUTO INFLINGIDA</option>
                    <option value="SOSPECHA DE MALTRATO FISICO"<?php if (!(strcmp('SOSPECHA DE MALTRATO FISICO', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>SOSPECHA DE MALTRATO FISICO</option>
                    <option value="SOSPECHA DE ABUSO SEXUAL"<?php if (!(strcmp('SOSPECHA DE ABUSO SEXUAL', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>SOSPECHA DE ABUSO SEXUAL</option>
                    <option value="SOSPECHA DE VIOLENCIA SEXUAL"<?php if (!(strcmp('SOSPECHA DE VIOLENCIA SEXUAL', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>SOSPECHA DE VIOLENCIA SEXUAL</option>
                    <option value="SOSPECHA DE MALTRATO EMOCIONAL"<?php if (!(strcmp('SOSPECHA DE MALTRATO EMOCIONAL', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>SOSPECHA DE MALTRATO EMOCIONAL</option>
                    <option value="ENFERMEDAD GENERAL"<?php if (!(strcmp('ENFERMEDAD GENERAL', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>ENFERMEDAD GENERAL</option>
                    <option value="ENFERMEDAD PROFESIONAL U OCUPACIONAL"<?php if (!(strcmp('ENFERMEDAD PROFESIONAL U OCUPACIONAL', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>ENFERMEDAD PROFESIONAL U OCUPACIONAL</option>
                    <option value="OTRO"<?php if (!(strcmp('OTRO', $reg[0]['origenenfermedad']))) {echo "selected=\"selected\"";} ?>>OTRO</option>
                    </select>
                    <?php } else { ?>
                    <select style="color:#000;font-weight:bold;" name="origenenfermedad" id="origenenfermedad" class='form-control' required="" aria-required="true">
                    <option value=""> -- SELECCIONE -- </option>
                    <option value="PACIENTE SANO" >PACIENTE SANO</option>
                    <option value="ACCIDENTE DE TRABAJO" >ACCIDENTE DE TRABAJO</option>
                    <option value="ACCIDENTE DE TRANSITO" >ACCIDENTE DE TRANSITO</option>
                    <option value="ACCIDENTE RAPIDO" >ACCIDENTE RAPIDO</option>
                    <option value="ACCIDENTE OFIDICO" >ACCIDENTE OFIDICO</option>
                    <option value="OTRO TIPO DE ACCIDENTE" >OTRO TIPO DE ACCIDENTE</option>
                    <option value="EVENTO CATASTROFICO" >EVENTO CATASTROFICO</option>
                    <option value="LESION POR AGRESION" >LESION POR AGRESION</option>
                    <option value="LESION AUTO INFLINGIDA" >LESION AUTO INFLINGIDA</option>
                    <option value="SOSPECHA DE MALTRATO FISICO" >SOSPECHA DE MALTRATO FISICO</option>
                    <option value="SOSPECHA DE ABUSO SEXUAL" >SOSPECHA DE ABUSO SEXUAL</option>
                    <option value="SOSPECHA DE VIOLENCIA SEXUAL" >SOSPECHA DE VIOLENCIA SEXUAL</option>
                    <option value="SOSPECHA DE MALTRATO EMOCIONAL" >SOSPECHA DE MALTRATO EMOCIONAL</option>
                    <option value="ENFERMEDAD GENERAL" >ENFERMEDAD GENERAL</option>
                    <option value="ENFERMEDAD PROFESIONAL U OCUPACIONAL" >ENFERMEDAD PROFESIONAL U OCUPACIONAL</option>
                    <option value="OTRO" >OTRO</option>
                    </select>
                    <?php } ?>
                </div> 
            </d -->

            <div class="col-md-6"> 
                <div class="form-group has-feedback2">
                    <label class="control-label">Conducta o Plan de Tratamiento: <span class="symbol required"></span></label> 
                    <textarea class="form-control" name="tratamiento" id="tratamiento" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Conducta o Plan de Tratamiento del Paciente" rows="2" required="" aria-required="true"><?php if (isset($reg[0]['tratamiento'])) { echo $reg[0]['tratamiento']; } ?></textarea>
                </div> 
            </div>
        </div>


        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> Interconsulta</h5><hr>

        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group has-feedback">
                    <textarea class="form-control" name="remision" id="remision" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Interconsulta del Paciente" rows="2" required="" aria-required="true"><?php if (isset($reg[0]['remision'])) { echo $reg[0]['remision']; } ?></textarea>
                </div> 
            </div>
        </div>

        <div class="row">

        <!-- .col -->
        <div class="col-md-6">

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i>Emitir Receta Médicas</h5><hr>

        <div class="row">
            <div class="col-md-12"> 
            <a class="btn btn-primary rounded-circle" onClick="AddFormula()" title="Agregar"><i data-feather="plus-circle"></i></a>&nbsp;
            <a class="btn btn-danger rounded-circle" onClick="DeleteFormula()" title="Quitar"><i data-feather="x-circle"></i></a>
            <table width="100%" id="tabla3"><tr> 

            <td>
            <?php
            if (isset($reg[0]['formulamedica'])) {

            $explode = explode(",,",$reg[0]['formulamedica']);
            for($cont=0; $cont<COUNT($explode); $cont++):
            list($idcieformula,$formula,$observacionformula) = explode("/",$explode[$cont]);
            ?>
                <div class="form-group has-feedback"> 
                    <label class="control-label alert-link">Nombre de Dx para Receta Médica: </label>
                    <input type="hidden" name="idcieformula[]<?php echo $cont; ?>" id="idcieformula<?php echo $cont; ?>" value="<?php echo $idcieformula; ?>"/>
                    <input style="color:#000;font-weight:bold;" class="form-control" type="text" name="formula[]<?php echo $cont; ?>" id="formula<?php echo $cont; ?>" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" placeholder="Ingrese Nombre de Dx para tu Busqueda" title="Ingrese Nombre de Dx" value="<?php echo $formula; ?>" required="" aria-required="true">
                    <textarea class="form-control" name="observacionformula[]<?php echo $cont; ?>" id="observacionformula<?php echo $cont; ?>" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Receta Médica" title="Ingrese Observación de Receta Médica" rows="2" required="" aria-required="true"><?php echo $observacionformula; ?></textarea>
                </div>

            <?php endfor; 

            } else { ?>

                <div class="form-group has-feedback"> 
                    <label class="control-label alert-link">Nombre de Dx para Receta Médica: </label>
                    <input type="hidden" name="idcieformula[]" id="idcieformula"/>
                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="formula[]" id="formula" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" placeholder="Ingrese Nombre de Dx para tu Busqueda" title="Ingrese Dx Receta Médica">
                    <textarea class="form-control" name="observacionformula[]" id="observacionformula" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Dx Receta Médica" title="Ingrese Observación de Dx Receta Médica" rows="2"></textarea>
                </div>

            <?php } ?>

            </td></tr><input type="hidden" name="var_cont">
            </table>
            </div>
        </div>   

        </div>
        <!-- /.col -->
        
        <!-- .col -->  
        <div class="col-md-6">
        
        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> Examanes Auxiliares</h5><hr>
            
        <div class="row">
            <div class="col-md-12">
            <a class="btn btn-primary rounded-circle" onClick="AddOrden()" title="Agregar"><i data-feather="plus-circle"></i></a>&nbsp;
            <a class="btn btn-danger rounded-circle" onClick="DeleteOrden()" title="Quitar"><i data-feather="x-circle"></i></a> 
            <table width="100%" id="tabla4"><tr> 
            <td>
            <?php
            if (isset($reg[0]['ordenmedica'])) {

            $explode = explode(",,",$reg[0]['ordenmedica']);
            for($cont=0; $cont<COUNT($explode); $cont++):
            list($idcieorden,$orden,$observacionorden) = explode("/",$explode[$cont]);    
            ?>

                <div class="form-group has-feedback"> 
                    <label class="control-label alert-link">Nombre de Examenes Auxiliares: </label>
                    <input type="hidden" name="idcieorden[]<?php echo $cont; ?>" id="idcieorden<?php echo $cont; ?>" value="<?php echo $idcieorden; ?>"/>
                    <input style="color:#000;font-weight:bold;" class="form-control" type="text" name="ordenes[]<?php echo $cont; ?>" id="ordenes<?php echo $cont; ?>" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" placeholder="Ingrese Nombre de Dx para tu Busqueda" title="Ingrese Nombre de Dx" value="<?php echo $orden; ?>" required="" aria-required="true">
                    <textarea class="form-control" name="observacionorden[]<?php echo $cont; ?>" id="observacionorden<?php echo $cont; ?>" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Orden Médica" title="Ingrese Observación de Orden Médica" rows="2" required="" aria-required="true"><?php echo $observacionorden; ?></textarea>
                </div>

            <?php endfor; 

            } else { ?>

                <div class="form-group has-feedback"> 
                    <label class="control-label alert-link">Nombre de Examenes Auxiliares: </label>
                    <input type="hidden" name="idcieorden[]" id="idcieorden"/>
                    <input style="color:#000;font-weight:bold;" class="form-control" type="text" name="ordenes[]" id="ordenes" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" placeholder="Ingrese Nombre de Dx para tu Busqueda" title="Ingrese Dx Orden Médica">
                    <textarea class="form-control" name="observacionorden[]" id="observacionorden" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Dx Examenes Auxiliares" title="Ingrese Observación de Dx Examen Axuliar" rows="2"></textarea>
                </div>

            <?php } ?>

            </td></tr><input type="hidden" name="var_cont">
            </table>
            </div>
        </div>    

        </div>
        <!-- /.col -->
       
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
    $(document).ready(function() {
        // iniciarlizar el formulario
        App.init();

        // calculo de talla
        $( "#talla" ).on( "blur", function() {
            let peso = $("#peso").val();
            let talla = $("#talla").val();

            $("#imc").val((peso / talla).toFixed(2));
        });

        // grabar la apertura
        function grabar_apertura() {
            var data = $("#saveapertura").serialize();
            var formulario = $('#formulario').val();
            var codverifica = $('#verifica_busqueda').val();
            var codsucursal = $('#sucursal_busqueda').val();
            var codespecialidad = $('#especialidad_busqueda').val();
            var codmedico = $('#medico_busqueda').val();
            var fecha = $("#fecha_busqueda").val();
            var codpaciente = $('#codpaciente').val();
	
            if (codpaciente == "" || codpaciente == 0) {
                swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
                return false;
            } 
            else { 
                $.ajax({
                    type : 'POST',
                    url  : formulario+'.php',
                    data : data,
                    beforeSend: function() {	
                        $("#save").fadeOut();

                        var n = noty({
                            text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
                            theme: 'defaultTheme',
                            layout: 'center',
                            type: 'information',
                            timeout: 1000, 
                        });

                        $("#btn-submit").attr('disabled', true);
                    },
                    success :  function(data) {
                        if(data==1) {
                            $("#save").fadeIn(1000, function() {
                                var n = noty({
                                    text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                                    theme: 'defaultTheme',
                                    layout: 'center',
                                    type: 'warning',
                                    timeout: 5000 });
                                    $("#btn-submit").attr('disabled', false);
                            });
                        }  
                        else if(data==2) {
                            $("#save").fadeIn(1000, function(){
                                var n = noty({
                                    text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX PRESUNTIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                                    theme: 'defaultTheme',
                                    layout: 'center',
                                    type: 'warning',
                                    timeout: 5000 });
                                    $("#btn-submit").attr('disabled', false);
                            });
                        }   
                        else if(data==3) {
                            $("#save").fadeIn(1000, function(){
                            var n = noty({
                                text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX DEFINITIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                                theme: 'defaultTheme',
                                layout: 'center',
                                type: 'warning',
                                timeout: 5000 });
                                $("#btn-submit").attr('disabled', false);
                            });
                        }   
                        else if(data==4) {
                            $("#save").fadeIn(1000, function(){
                            var n = noty({
                                text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR FORMULAS MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                                theme: 'defaultTheme',
                                layout: 'center',
                                type: 'warning',
                                timeout: 5000 });
                                $("#btn-submit").attr('disabled', false);
                            });
                        }   
                        else if(data==5) {
                            $("#save").fadeIn(1000, function(){
                            var n = noty({
                                text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR ORDENES MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                                theme: 'defaultTheme',
                                layout: 'center',
                                type: 'warning',
                                timeout: 5000 });
                                $("#btn-submit").attr('disabled', false);
                            });
                        }   
                        else if(data==6) {
                            $("#save").fadeIn(1000, function(){
                            var n = noty({
                                text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA APERTURA MEDICA, DEBE DE REALIZAR UNA HOJA EVOLUTIVA ...!",
                                theme: 'defaultTheme',
                                layout: 'center',
                                type: 'warning',
                                timeout: 5000 });
                                $("#btn-submit").attr('disabled', false);
                            });
                        } else {
                            $("#save").fadeIn(1000, function(){
                                var n = noty({
                                    text: '<center> '+data+' </center>',
                                    theme: 'defaultTheme',
                                    layout: 'center',
                                    type: 'information',
                                    timeout: 5000 
                                });

                                $("#saveapertura")[0].reset();
                                $("#codcita").val("");
                                $("#codpaciente").val("");
                                $("#verifica_busqueda").val("");
                                $("#sucursal_busqueda").val("");
                                $("#especialidad_busqueda").val("");
                                $("#medico_busqueda").val("");
                                $("#fecha_busqueda").val("");
                                $("#tabla").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Dx Presuntivo: <span class="symbol required"></span></label><input type="hidden" name="idciepresuntivo[]" id="idciepresuntivo"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="presuntivo[]" id="presuntivo" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Presuntivo" autocomplete="off" required="" aria-required="true"><textarea class="form-control" name="observacionpresuntivo[]" id="observacionpresuntivo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Dx Presuntivo" title="Ingrese Observación de Dx Presuntivo" rows="2" required="" aria-required="true"></textarea></div></td></tr></tbody>');
                                $("#tabla2").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Dx Definitivo: <span class="symbol required"></span></label><input type="hidden" name="idciedefinitivo[]" id="idciedefinitivo"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="definitivo[]" id="definitivo" onKeyUp="this.value=this.value.toUpperCase(); autocompletar2(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Definitivo" autocomplete="off" required="" aria-required="true"><textarea class="form-control" name="observaciondefinitivo[]" id="observaciondefinitivo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Dx Definitivo" title="Ingrese Observación de Dx Definitivo" rows="2" required="" aria-required="true"></textarea></div></td></tr></tbody>');
                                $("#tabla3").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Fórmula Médica: </label><input type="hidden" name="idcieformula[]" id="idcieformula"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="formula[]" id="formula" onKeyUp="this.value=this.value.toUpperCase(); autocompletarformula(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Fórmula Médica"><textarea class="form-control" name="observacionformula[]" id="observacionformula" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Fórmula Médica" title="Ingrese Observación de Fórmula Médica" rows="2"></textarea></div></td></tr></tbody>');
                                $("#tabla4").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Orden Médica: </label><input type="hidden" name="idcieorden[]" id="idcieorden"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="ordenes[]" id="ordenes" onKeyUp="this.value=this.value.toUpperCase(); autocompletarordenes(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Orden Médica"><textarea class="form-control" name="observacionorden[]" id="observacionorden" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Orden Médica" title="Ingrese Observación de Orden Médica" rows="2"></textarea></div></td></tr></tbody>');
                                $("#btn-submit").attr('disabled', false);
                                $('#muestracitasxdia').html("");
                                $("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);
                            });
                        }
                    }
                });
                return false;
            }
        }
        // fin de grabar la apertura

        // validacion del formulario
        $("#saveapertura").validate({
            rules: {
                numeropaciente: { required: false },
                codmedico: { required: false },
                motivoconsulta: { required: true, },
                examenfisico: { required: true, },
                fechamestruacion: { required: true, },
                fechacitologia: { required: false, },
                embarazada: { required: false, },
                ta: { required: true, },
                temperatura: { required: true, },
                fc: { required: true, },
                fr: { required: true, },
                peso: { required: true, },
                enfermedadpaciente: { required: true },
                antecedentepaciente: { required: true },
                antecedentefamiliares: { required: true },
                antecedentealergico: { required: true },
                antecedentepatologico: { required: true },
                antecedentequirurgico: { required: true },
                antecedentefarmacologico: { required: true },
                antecedenteginecologico: { required: false },
                historialgestacional: { required: false },
                planificacionfamiliar: { required: false },
                tratamiento: { required: true },
                remision: { required: false },
                formula: { required: false },
                observacionformula: { required: false },
                ordenes: { required: false },
                observacionorden: { required: false },
            },
            messages: {
                numeropaciente:{ required: "Realice la Busqueda de Paciente" },
                codmedico:{ required: "Seleccione Médico" },
                motivoconsulta:{ required: "Por favor Ingrese Motivo de Consulta" },
                examenfisico:{ required: "Por favor Ingrese Examen Fisico" },
                fechamestruacion:{ required: "Ingrese Fecha Ultima Mestruaci&oacute;n", date: "Ingrese fecha Valida"  },
                fechacitologia:{ required: "Ingrese Fecha Ultima Citologia", date: "Ingrese fecha Valida"  },
                embarazada: { required: "Seleccione Embarazada" },
                ta:{ required: "Ingrese PA" },
                temperatura : { required : "Ingrese Temp"  },
                fc : { required : "Ingrese FC"  },
                fr:{ required: "Ingrese FR" },
                peso: { required: "Ingrese Peso" },
                enfermedadpaciente:{ required: "Ingrese Enfermedad del Paciente" },
                antecedentepaciente:{ required: "Ingrese Antecedentes Personales" },
                antecedentefamiliares:{ required: "Ingrese Antecedentes Familiares" },
                antecedentealergico:{ required: "Ingrese Antecedentes Alergicos" },
                antecedentepatologico:{ required: "Ingrese Antecedentes Patologicos" },
                antecedentequirurgico:{ required: "Ingrese Antecedentes Quirurgicos" },
                antecedentefarmacologico: { required: "Ingrese Medicación Actual" },
                antecedenteginecologico: { required: "Ingrese Antecedentes Ginecologicos" },
                historialgestacional: { required: "Ingrese Historial Gestacional" },
                planificacionfamiliar: { required: "Ingrese Planificaci&oacute;n Familiar" },
                tratamiento: { required: "Ingrese Conducta o Tratamiento" },
                remision: { required: "Ingrese Remision del Paciente" },
                formula: { required: "Ingrese Dx para F&oacute;rmula M&eacute;dica" },
                observacionformula: { required: "Ingrese Observaci&oacute;n de F&oacute;rmula M&eacute;dica" },
                ordenes: { required: "Ingrese Dx para &Oacute;rden M&eacute;dica" },
                observacionorden: { required: "Ingrese Observaci&oacute;n de &Oacute;rden M&eacute;dica" },
            },
            errorElement: "span",
            submitHandler: function(form) {              
                Swal.fire({
                    title: "Atención: No podra modificar la Apertura posteriormente!",
                    text: "Seguro de grabar la Apertura?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, graba la Apertura!"
                    }).then((result) => {
                    if (!result.isConfirmed) {
                        form.preventDefault();
                    }
                    else {
                        grabar_apertura();
                    }
                });

            }
        });
    /* form submit */
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

    <!-- script jquery -->
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/script/agrega_filas.js"></script>
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