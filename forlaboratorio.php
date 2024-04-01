<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
    if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "enfermera" || ($_SESSION['acceso'] == "medico" && in_array("3", explode(",", $_SESSION['modulos'])))) {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

$valor = new Login();
$valor = $valor->ValoresPorId();

if(isset($_POST["proceso"]) and $_POST["proceso"]=="save")
{
$reg = $tra->RegistrarLaboratorios();
exit;
}
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarLaboratorios();
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

<!--############################## MODAL BUSQUEDA DE CITAS EN LABORATORIO ######################################-->
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
                    <input type="hidden" name="codverifica" id="codverifica" value="<?php echo "3"; ?>"/>
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
                    <input type="hidden" name="codverifica" id="codverifica" value="<?php echo "3"; ?>"/>
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
<!--############################## MODAL BUSQUEDA DE CITAS EN LABORATORIO ######################################-->
    
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
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Gestión de Exámenes</h5>
                                    </div>                 
                                </div>
                            </div>

    <div class="widget-content widget-content-area">                                

     <?php  if (isset($_GET['numero'])) {
      
      $reg = $tra->LaboratoriosPorId(); ?>
      
    <form class="form-material" novalidate method="post" action="#" name="updatelaboratorio" id="updatelaboratorio" data-id="<?php echo $reg[0]["codlaboratorio"] ?>" enctype="multipart/form-data">
        
    <?php } else { ?>

    <form class="form-material" novalidate method="post" action="#" name="savelaboratorio" id="savelaboratorio" enctype="multipart/form-data">
              
    <?php } ?>
            
        <div id="save">
            <!-- error will be shown here ! -->
        </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="user"></i> Datos del Paciente</h5><hr> 

        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Nº de Historia: <span class="symbol required"></span></label>
                <div class="input-group">
                    <input type="hidden" name="proceso" id="proceso" <?php if (isset($reg[0]['codlaboratorio'])) { ?> value="update" <?php } else { ?>  value="save" <?php } ?>/>
                    <input type="hidden" name="idlaboratorio" id="idlaboratorio" <?php if (isset($reg[0]['idlaboratorio'])) { ?> value="<?php echo encrypt($reg[0]['idlaboratorio']); ?>" <?php } ?>>
                    <input type="hidden" name="codlaboratorio" id="codlaboratorio" <?php if (isset($reg[0]['codlaboratorio'])) { ?> value="<?php echo encrypt($reg[0]['codlaboratorio']); ?>" <?php } ?>/>

                    <input type="hidden" name="verifica_busqueda" id="verifica_busqueda"/>
                    <input type="hidden" name="sucursal_busqueda" id="sucursal_busqueda" <?php if (isset($reg[0]['codsucursal'])) { ?> value="<?php echo encrypt($reg[0]['codsucursal']); ?>" <?php } ?>/>
                    <input type="hidden" name="especialidad_busqueda" id="especialidad_busqueda"/>
                    <input type="hidden" name="medico_busqueda" id="medico_busqueda" <?php if (isset($reg[0]['codmedico'])) { ?> value="<?php echo encrypt($reg[0]['codmedico']); ?>" <?php } ?>/>
                    <input type="hidden" name="fecha_busqueda" id="fecha_busqueda"/>

                    <input type="hidden" name="codcita" id="codcita" <?php if (isset($reg[0]['codcita'])) { ?> value="<?php echo encrypt($reg[0]['codcita']); ?>" <?php } ?>/>
                    <input type="hidden" name="cita" id="cita" <?php if (isset($reg[0]['codcita'])) { ?> value="<?php echo $reg[0]['codcita']; ?>" <?php } ?>/>
                    <input type="hidden" name="codpaciente" id="codpaciente" <?php if (isset($reg[0]['codpaciente'])) { ?> value="<?php echo encrypt($reg[0]['codpaciente']); ?>" <?php } ?>/>
                    <input type="hidden" name="paciente" id="paciente" <?php if (isset($reg[0]['codpaciente'])) { ?> value="<?php echo $reg[0]['codpaciente']; ?>" <?php } ?>/> 

                    <?php if (isset($reg[0]['idlaboratorio'])) { ?>

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

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> Exámenes de Laboratorio</h5><hr>

        <div class="row">

        <div class="widget-content widget-content-area underline-content">
                                    
            <ul class="nav nav-tabs  mb-3" id="lineTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link alert-link active" id="underline-home-tab" data-toggle="tab" href="#underline-hematologia" role="tab" aria-controls="underline-home" aria-selected="true"><i data-feather="file-text"></i> HEMATOLOGÍA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link alert-link" id="underline-profile-tab" data-toggle="tab" href="#underline-quimica" role="tab" aria-controls="underline-profile" aria-selected="false"><i data-feather="file-text"></i> QUÍMICA SANGUINEA </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link alert-link" id="underline-contact-tab" data-toggle="tab" href="#underline-analisis" role="tab" aria-controls="underline-contact" aria-selected="false"><i data-feather="file-text"></i> UROANÁLISIS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link alert-link" id="underline-contact-tab" data-toggle="tab" href="#underline-flujo" role="tab" aria-controls="underline-contact" aria-selected="false"><i data-feather="file-text"></i> FLUJO VAGINAL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link alert-link" id="underline-contact-tab" data-toggle="tab" href="#underline-inmunologia" role="tab" aria-controls="underline-contact" aria-selected="false"><i data-feather="file-text"></i> INMUNOLOGÍA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link alert-link" id="underline-contact-tab" data-toggle="tab" href="#underline-parasito" role="tab" aria-controls="underline-contact" aria-selected="false"><i data-feather="file-text"></i> PARÁSITO-MICROBIOLOGÍA</a>
                </li>
            </ul>

            <div class="tab-content" id="lineTabContent-3">
                    
                <div class="tab-pane fade show active" id="underline-hematologia" role="tabpanel" aria-labelledby="underline-home-tab">
                    <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">                           
                    <thead>
                    <tr class="alert-link">
                    <th colspan="5" class="text-center">HEMATOLOGÍA</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="alert-link">
                    <td width="353">EXÁMEN</td>
                    <td colspan="2">RESULTADO</td>
                    <td colspan="2">VALOR NORMAL</td>
                    </tr>
                    <tr class="alert-link">
                    <td>HEMATOCRITO</td>
                    <td width="250"><input name="hematocrito" type="text" class="form-control" id="hematocrito" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['hematocrito'])) { ?> value="<?php echo $reg[0]['hematocrito']; ?>" <?php } ?>></td>
                    <td width="190"><div align="right">%</div></td>
                    <td width="210"><div align="right"><?php echo $valor[0]['hematocritov']; ?></div></td>
                    <td width="170"><div align="right">%</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>HEMOGLOBINA</td>
                    <td><input name="hemoglobina" type="text" class="form-control" id="hemoglobina" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['hemoglobina'])) { ?> value="<?php echo $reg[0]['hemoglobina']; ?>" <?php } ?>/></td>
                    <td><div align="right">gr/dl</div></td>
                    <td><div align="right"><?php echo $valor[0]['hemoglobinav']; ?></div></td>
                    <td><div align="right">gr/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>LEUCOCITOS</td>
                    <td><input name="leucocitos" type="text" class="form-control" id="leucocitos" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['leucocitos'])) { ?> value="<?php echo $reg[0]['leucocitos']; ?>" <?php } ?>/></td>
                    <td><div align="right">mm3</div></td>
                    <td><div align="right"><?php echo $valor[0]['leucocitosv']; ?></div></td>
                    <td><div align="right">mm3</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>NEUTROFILOS</td>
                    <td><input name="neutrofilos" type="text" class="form-control" id="neutrofilos" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['neutrofilos'])) { ?> value="<?php echo $reg[0]['neutrofilos']; ?>" <?php } ?>/></td>
                    <td><div align="right">%</div></td>
                    <td><div align="right"><?php echo $valor[0]['neutrofilosv']; ?></div></td>
                    <td><div align="right">%</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>LINFOCITOS</td>
                    <td><input name="linfocitos" type="text" class="form-control" id="linfocitos" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['linfocitos'])) { ?> value="<?php echo $reg[0]['linfocitos']; ?>" <?php } ?>/></td>
                    <td><div align="right">%</div></td>
                    <td><div align="right"><?php echo $valor[0]['linfocitosv']; ?></div></td>
                    <td><div align="right">%</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>EOSINOFILOS</td>
                    <td><input name="eosinofilos" type="text" class="form-control" id="eosinofilos" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['eosinofilos'])) { ?> value="<?php echo $reg[0]['eosinofilos']; ?>" <?php } ?>/></td>
                    <td><div align="right">%</div></td>
                    <td><div align="right"><?php echo $valor[0]['eosinofilosv']; ?></div></td>
                    <td><div align="right">%</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>MONOCITOS</td>
                    <td><input name="monositos" type="text" class="form-control" id="monositos" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['monositos'])) { ?> value="<?php echo $reg[0]['monositos']; ?>" <?php } ?>/></td>
                    <td><div align="right">%</div></td>
                    <td><div align="right"><?php echo $valor[0]['monositosv']; ?></div></td>
                    <td><div align="right">%</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>BASOFILOS</td>
                    <td><input name="basofilos" type="text" class="form-control" id="basofilos" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['basofilos'])) { ?> value="<?php echo $reg[0]['basofilos']; ?>" <?php } ?>/></td>
                    <td><div align="right">%</div></td>
                    <td><div align="right"><?php echo $valor[0]['basofilosv']; ?></div></td>
                    <td><div align="right">%</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>CAYADOS</td>
                    <td><input name="cayados" type="text" class="form-control" id="cayados" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['cayados'])) { ?> value="<?php echo $reg[0]['cayados']; ?>" <?php } ?>/></td>
                    <td><div align="right">%</div></td>
                    <td><div align="right"><?php echo $valor[0]['cayadosv']; ?></div></td>
                    <td><div align="right">%</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>PLAQUETAS</td>
                    <td><input name="plaquetas" type="text" class="form-control" id="plaquetas" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['plaquetas'])) { ?> value="<?php echo $reg[0]['plaquetas']; ?>" <?php } ?>/></td>
                    <td><div align="right">mm3</div></td>
                    <td><div align="right"><?php echo $valor[0]['plaquetasv']; ?></div></td>
                    <td><div align="right">mm3</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>RETICULOCITOS</td>
                    <td><input name="reticulositos" type="text" class="form-control" id="reticulositos" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['reticulositos'])) { ?> value="<?php echo $reg[0]['reticulositos']; ?>" <?php } ?>/></td>
                    <td><div align="right">%</div></td>
                    <td><div align="right"><?php echo $valor[0]['reticulositosv']; ?></div></td>
                    <td><div align="right">%</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>V.S.G</td>
                    <td><input name="vsg" type="text" class="form-control" id="vsg" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['vsg'])) { ?> value="<?php echo $reg[0]['vsg']; ?>" <?php } ?>/></td>
                    <td><div align="right">mm/hr</div></td>
                    <td><div align="right"><?php echo $valor[0]['vsgv']; ?></div></td>
                    <td><div align="right">mm/hr</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>PT</td>
                    <td><input name="pt" type="text" class="form-control" id="pt" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['pt'])) { ?> value="<?php echo $reg[0]['pt']; ?>" <?php } ?>/></td>
                    <td><div align="right">seg. CD</div></td>
                    <td><div align="right"><?php echo $valor[0]['ptv']; ?></div></td>
                    <td><div align="right">seg. CD</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>PTT</td>
                    <td><input name="ptt" type="text" class="form-control" id="ptt" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['ptt'])) { ?> value="<?php echo $reg[0]['ptt']; ?>" <?php } ?>/></td>
                    <td><div align="right">seg. CD</div></td>
                    <td><div align="right"><?php echo $valor[0]['pttv']; ?></div></td>
                    <td><div align="right">seg. CD</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td><label>HEMOCLASIFICACIÓN</label></td>
                    <td><label>GRUPO</label></td>
                    <td><input name="clasifgrupo" type="text" class="form-control" id="clasifgrupo" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['clasifgrupo'])) { ?> value="<?php echo $reg[0]['clasifgrupo']; ?>" <?php } ?>/></td>
                    <td>RH:</td>
                    <td><input name="clasifrh" type="text" class="form-control" id="clasifrh" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['clasifrh'])) { ?> value="<?php echo $reg[0]['clasifrh']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr>
                    <td colspan="5"><textarea name="observacioneshematologia" cols="80" rows="2" style="background:#f0f9fc;color:#000;font-weight:bold;font-size:14px;" onKeyUp="this.value=this.value.toUpperCase();" class="form-control" id="observacioneshematologia" placeholder="Ingrese Observaciones de Resultado"><?php if (isset($reg[0]['observacioneshematologia'])) { echo $reg[0]['observacioneshematologia']; } ?></textarea></td>
                    </tr>
                    </tbody>
                    </table>
                    </div>                                                 
                </div>

                <div class="tab-pane fade" id="underline-quimica" role="tabpanel" aria-labelledby="underline-profile-tab">
                    <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                    <thead>
                    <tr class="alert-link">
                    <th colspan="5" class="text-center">QUÍMICA SANGUÍNEA</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="alert-link">
                    <td width="353">EXÁMEN</td>
                    <td colspan="2">RESULTADO</td>
                    <td colspan="2">VALOR NORMAL</td>
                    </tr>
                    <tr class="alert-link">
                    <td width="353">GLUCOSA</td>
                    <td width="268"><input name="glucosa" type="text" class="form-control" id="glucosa" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['glucosa'])) { ?> value="<?php echo $reg[0]['glucosa']; ?>" <?php } ?>/></td>
                    <td width="192"><div align="right">mg/dl</div></td>
                    <td width="222"><div align="right"><?php echo $valor[0]['glucosav']; ?></div></td>
                    <td width="167"><div align="right">mg/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>COLESTEROL TOTAL</td>
                    <td><input name="colesteroltotal" type="text" class="form-control" id="colesteroltotal" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['colesteroltotal'])) { ?> value="<?php echo $reg[0]['colesteroltotal']; ?>" <?php } ?>/></td>
                    <td><div align="right">mg/dl</div></td>
                    <td><div align="right"><?php echo $valor[0]['colesteroltotalv']; ?></div></td>
                    <td><div align="right">mg/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>COLESTEROL HDL</td>
                    <td><input name="colesterolhdl" type="text" class="form-control" id="colesterolhdl" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['colesterolhdl'])) { ?> value="<?php echo $reg[0]['colesterolhdl']; ?>" <?php } ?>/></td>
                    <td><div align="right">mg/dl</div></td>
                    <td><div align="right"><?php echo $valor[0]['colesterolhdlv']; ?></div></td>
                    <td><div align="right">mg/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>COLESTEROL LDL</td>
                    <td><input name="colesterolldl" type="text" class="form-control" id="colesterolldl" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['colesterolldl'])) { ?> value="<?php echo $reg[0]['colesterolldl']; ?>" <?php } ?>/></td>
                    <td><div align="right">mg/dl</div></td>
                    <td><div align="right"><?php echo $valor[0]['colesterolldlv']; ?></div></td>
                    <td><div align="right">mg/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>TRIGLICERIDOS</td>
                    <td><input name="trigliceridos" type="text" class="form-control" id="trigliceridos" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['trigliceridos'])) { ?> value="<?php echo $reg[0]['trigliceridos']; ?>" <?php } ?>/></td>
                    <td><div align="right">mg/dl</div></td>
                    <td><div align="right"><?php echo $valor[0]['trigliceridosv']; ?></div></td>
                    <td><div align="right">mg/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>ACIDO ÚRICO</td>
                    <td><input name="acidourico" type="text" class="form-control" id="acidourico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['acidourico'])) { ?> value="<?php echo $reg[0]['acidourico']; ?>" <?php } ?>/></td>
                    <td><div align="right">mg/dl</div></td>
                    <td><div align="right"><?php echo $valor[0]['acidouricov']; ?></div></td>
                    <td><div align="right">mg/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>NITROGENO UREICO</td>
                    <td><input name="nitrogenoureico" type="text" class="form-control" id="nitrogenoureico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['nitrogenoureico'])) { ?> value="<?php echo $reg[0]['nitrogenoureico']; ?>" <?php } ?>/></td>
                    <td><div align="right">mg/dl</div></td>
                    <td><div align="right"><?php echo $valor[0]['nitrogenoureicov']; ?></div></td>
                    <td><div align="right">mg/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>CREATININA</td>
                    <td><input name="creatinina" type="text" class="form-control" id="creatinina" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['creatinina'])) { ?> value="<?php echo $reg[0]['creatinina']; ?>" <?php } ?>/></td>
                    <td><div align="right">mg/dl</div></td>
                    <td><div align="right"><?php echo $valor[0]['creatininav']; ?></div></td>
                    <td><div align="right">mg/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>PROTEINAS TOTALES</td>
                    <td><input name="proteinastotales" type="text" class="form-control" id="proteinastotales" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['proteinastotales'])) { ?> value="<?php echo $reg[0]['proteinastotales']; ?>" <?php } ?>/></td>
                    <td><div align="right">mg/dl</div></td>
                    <td><div align="right"><?php echo $valor[0]['proteinastotalesv']; ?></div></td>
                    <td><div align="right">mg/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>ALBÚMINA</td>
                    <td><input name="albumina" type="text" class="form-control" id="albumina" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['albumina'])) { ?> value="<?php echo $reg[0]['albumina']; ?>" <?php } ?>/></td>
                    <td><div align="right">mg/dl</div></td>
                    <td><div align="right"><?php echo $valor[0]['albuminav']; ?></div></td>
                    <td><div align="right">mg/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>GLOBULINAS</td>
                    <td><input name="globulina" type="text" class="form-control" id="globulina" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['globulina'])) { ?> value="<?php echo $reg[0]['globulina']; ?>" <?php } ?>/></td>
                    <td><div align="right">mg/dl</div></td>
                    <td><div align="right"><?php echo $valor[0]['globulinav']; ?></div></td>
                    <td><div align="right">mg/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>BILIRRUBINA TOTAL</td>
                    <td><input name="bilirrubinatotal" type="text" class="form-control" id="bilirrubinatotal" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['bilirrubinatotal'])) { ?> value="<?php echo $reg[0]['bilirrubinatotal']; ?>" <?php } ?>/></td>
                    <td><div align="right">mg/dl</div></td>
                    <td><div align="right"><?php echo $valor[0]['bilirrubinatotalv']; ?></div></td>
                    <td><div align="right">mg/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>BILIRRUBINA DIRECTA</td>
                    <td><input name="bilirrubinadirecta" type="text" class="form-control" id="bilirrubinadirecta" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['bilirrubinadirecta'])) { ?> value="<?php echo $reg[0]['bilirrubinadirecta']; ?>" <?php } ?>/></td>
                    <td><div align="right">mg/dl</div></td>
                    <td><div align="right"><?php echo $valor[0]['bilirrubinadirectav']; ?></div></td>
                    <td><div align="right">mg/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>BILIRRUBINA INDIRECTA</td>
                    <td><input name="bilirrubinaindirecta" type="text" class="form-control" id="bilirrubinaindirecta" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['bilirrubinaindirecta'])) { ?> value="<?php echo $reg[0]['bilirrubinaindirecta']; ?>" <?php } ?>/></td>
                    <td><div align="right">mg/dl</div></td>
                    <td><div align="right"><?php echo $valor[0]['bilirrubinaindirectav']; ?></div></td>
                    <td><div align="right">mg/dl</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>FOSFATASA ALCALINA</td>
                    <td><input name="fosfatasaalcalina" type="text" class="form-control" id="fosfatasaalcalina" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['fosfatasaalcalina'])) { ?> value="<?php echo $reg[0]['fosfatasaalcalina']; ?>" <?php } ?>/></td>
                    <td><div align="right">UI/L</div></td>
                    <td><div align="right"><?php echo $valor[0]['fosfatasaalcalinav']; ?></div></td>
                    <td><div align="right">UI/L</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>TGO/AST</td>
                    <td><input name="tgo" type="text" class="form-control" id="tgo" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['tgo'])) { ?> value="<?php echo $reg[0]['tgo']; ?>" <?php } ?>/></td>
                    <td><div align="right">UI/L</div></td>
                    <td><div align="right"><?php echo $valor[0]['tgov']; ?></div></td>
                    <td><div align="right">UI/L</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>TGP/ALT</td>
                    <td><input name="tgp" type="text" class="form-control" id="tgp" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['tgp'])) { ?> value="<?php echo $reg[0]['tgp']; ?>" <?php } ?>/></td>
                    <td><div align="right">UI/L</div></td>
                    <td><div align="right"><?php echo $valor[0]['tgpv']; ?></div></td>
                    <td><div align="right">UI/L</div></td>
                    </tr>
                    <tr class="alert-link">
                    <td>AMILASA</td>
                    <td><input name="amilasa" type="text" class="form-control" id="amilasa" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['amilasa'])) { ?> value="<?php echo $reg[0]['amilasa']; ?>" <?php } ?>/></td>
                    <td><div align="right">UI/L</div></td>
                    <td><div align="right"><?php echo $valor[0]['amilasav']; ?></div></td>
                    <td><div align="right">UI/L</div></td>
                    </tr>
                    <tr>
                    <td colspan="5"><textarea name="observacionesquimica" cols="80" onKeyUp="this.value=this.value.toUpperCase();" rows="2" class="form-control" id="observacionesquimica" style="background:#f0f9fc;color:#000;font-weight:bold;font-size:14px;" placeholder="Ingrese Observaciones de Resultado"><?php if (isset($reg[0]['observacionesquimica'])) { echo $reg[0]['observacionesquimica']; } ?></textarea></td>
                    </tr>
                    </tbody>
                    </table>
                    </div> 
                </div>

                <div class="tab-pane fade" id="underline-analisis" role="tabpanel" aria-labelledby="underline-contact-tab">
                    <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                    <thead>
                    <tr class="alert-link">
                    <th colspan="5" class="text-center">UROANÁLISIS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="alert-link">
                    <td colspan="2">EXÁMEN QUIMICO</td>
                    <td colspan="2">EXÁMEN MICROCOSPICO</td>
                    <td>XC</td>
                    </tr>
                    <tr class="alert-link">
                    <td width="256">COLOR</td>
                    <td width="336"><input name="colorquimico" type="text" class="form-control" id="colorquimico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['colorquimico'])) { ?> value="<?php echo $reg[0]['colorquimico']; ?>" <?php } ?>/></td>
                    <td colspan="2" height="25">CELULAS EPITELIALES BAJAS</td>
                    <td width="227"><input name="celulasepibajas" type="text" class="form-control" id="celulasepibajas" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['celulasepibajas'])) { ?> value="<?php echo $reg[0]['celulasepibajas']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr class="alert-link">
                    <td>ASPECTO</td>
                    <td><input name="aspectoquimico" type="text" class="form-control" id="aspectoquimico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['aspectoquimico'])) { ?> value="<?php echo $reg[0]['aspectoquimico']; ?>" <?php } ?>/></td>
                    <td colspan="2" height="20">CELULAS EPITELIALES ALTAS</td>
                    <td><input name="celulasepialtas" type="text" class="form-control" id="celulasepialtas" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado"  <?php if (isset($reg[0]['celulasepialtas'])) { ?> value="<?php echo $reg[0]['celulasepialtas']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr class="alert-link">
                    <td>PH</td>
                    <td><input name="phquimico" type="text" class="form-control" id="phquimico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['phquimico'])) { ?> value="<?php echo $reg[0]['phquimico']; ?>" <?php } ?>/></td>
                    <td width="166">BACTERIAS</span></td>
                    <td width="217"><input class="form-control" type="text" name="bacteriasmicroscopico" id="bacteriasmicroscopico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['bacteriasmicroscopico'])) { ?> value="<?php echo $reg[0]['bacteriasmicroscopico']; ?>" <?php } ?>/></td>
                    <td></td>
                    </tr>
                    <tr class="alert-link">
                    <td>DENSIDAD</td>
                    <td><input name="densidadquimico" type="text" class="form-control" id="densidadquimico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['densidadquimico'])) { ?> value="<?php echo $reg[0]['densidadquimico']; ?>" <?php } ?>/></td>
                    <td>LEUCOCITOS</td>
                    <td><input class="form-control" type="text" name="leucocitosmicroscopico" id="leucocitosmicroscopico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['leucocitosmicroscopico'])) { ?> value="<?php echo $reg[0]['leucocitosmicroscopico']; ?>" <?php } ?>/></td>
                    <td></td>
                    </tr>
                    <tr class="alert-link">
                    <td>PROTEINA</td>
                    <td><input name="proteinaquimico" type="text" class="form-control" id="proteinaquimico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['proteinaquimico'])) { ?> value="<?php echo $reg[0]['proteinaquimico']; ?>" <?php } ?>/></td>
                    <td>HEMATIES</td>
                    <td><input class="form-control" type="text" name="hematiesmicroscopico" id="hematiesmicroscopico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['hematiesmicroscopico'])) { ?> value="<?php echo $reg[0]['hematiesmicroscopico']; ?>" <?php } ?>/></td>
                    <td></td>
                    </tr>
                    <tr class="alert-link">
                    <td>GLUCOSA</td>
                    <td><input name="glucosaquimico" type="text" class="form-control" id="glucosaquimico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['glucosaquimico'])) { ?> value="<?php echo $reg[0]['glucosaquimico']; ?>" <?php } ?>/></td>
                    <td>CRISTALES</td>
                    <td><input class="form-control" type="text" name="cristalesmicroscopico" id="cristalesmicroscopico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['cristalesmicroscopico'])) { ?> value="<?php echo $reg[0]['cristalesmicroscopico']; ?>" <?php } ?>/></td>
                    <td></td>
                    </tr>
                    <tr class="alert-link">
                    <td>CETONAS</td>
                    <td><input name="cetonaquimico" type="text" class="form-control" id="cetonaquimico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['cetonaquimico'])) { ?> value="<?php echo $reg[0]['cetonaquimico']; ?>" <?php } ?>/></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr class="alert-link">
                    <td>BILIRRUBINAS</td>
                    <td><input name="bilirrubinaquimico" type="text" class="form-control" id="bilirrubinaquimico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['bilirrubinaquimico'])) { ?> value="<?php echo $reg[0]['bilirrubinaquimico']; ?>" <?php } ?>/></td>
                    <td>CILINDROS</td>
                    <td><input class="form-control" type="text" name="cilindrosmicroscopico" id="cilindrosmicroscopico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['cilindrosmicroscopico'])) { ?> value="<?php echo $reg[0]['cilindrosmicroscopico']; ?>" <?php } ?>/></td>
                    <td></td>
                    </tr>
                    <tr class="alert-link">
                    <td>UROBILINOGENO</td>
                    <td><input name="urobilinogenoquimico" type="text" class="form-control" id="urobilinogenoquimico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['urobilinogenoquimico'])) { ?> value="<?php echo $reg[0]['urobilinogenoquimico']; ?>" <?php } ?>/></td>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr class="alert-link">
                    <td>SANGRE</td>
                    <td><input name="sangrequimico" type="text" class="form-control" id="sangrequimico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['sangrequimico'])) { ?> value="<?php echo $reg[0]['sangrequimico']; ?>" <?php } ?>/></td>
                    <td>MOCO</td>
                    <td><input class="form-control" type="text" name="mocomicroscopico" id="mocomicroscopico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['mocomicroscopico'])) { ?> value="<?php echo $reg[0]['mocomicroscopico']; ?>" <?php } ?>/></td>
                    <td></td>
                    </tr>
                    <tr class="alert-link">
                    <td>LEUCOCITOS</td>
                    <td><input name="leucocitosquimico" type="text" class="form-control" id="leucocitosquimico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['leucocitosquimico'])) { ?> value="<?php echo $reg[0]['leucocitosquimico']; ?>" <?php } ?>/></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr class="alert-link">
                    <td>NITRITOS</td>
                    <td><input name="nitritosquimico" type="text" class="form-control" id="nitritosquimico" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['nitritosquimico'])) { ?> value="<?php echo $reg[0]['nitritosquimico']; ?>" <?php } ?>/></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr>
                    <td colspan="5"><textarea name="observacionesuroanalisis" cols="80" onKeyUp="this.value=this.value.toUpperCase();" rows="2" class="form-control" id="observacionesuroanalisis" style="background:#f0f9fc;color:#000;font-weight:bold;font-size:14px;" placeholder="Ingrese Observaciones de Resultado"><?php if (isset($reg[0]['observacionesuroanalisis'])) { echo $reg[0]['observacionesuroanalisis']; } ?></textarea></td>
                    </tr>
                    </tbody>
                    </table>
                    </div>  
                </div>

                <div class="tab-pane fade" id="underline-flujo" role="tabpanel" aria-labelledby="underline-contact-tab">
                    <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                    <thead>
                    <tr class="alert-link">
                    <th colspan="5" class="text-center">FROTIS DE FLUJO VAGINAL</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="alert-link">
                    <td colspan="2">EXÁMEN FRESCO</td>
                    <td colspan="2">GRAM</td>
                    </tr>
                    <tr class="alert-link">
                    <td width="256">PH</td>
                    <td width="144"><input name="phfresco" type="text" class="form-control" id="phfresco" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['phfresco'])) { ?> value="<?php echo $reg[0]['phfresco']; ?>" <?php } ?>/></td>
                    <td>BACILOS GRAM POSITIVO</td>
                    <td width="144"><input name="basilosgranpositivo" type="text" class="form-control" id="basilosgranpositivo" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['basilosgranpositivo'])) { ?> value="<?php echo $reg[0]['basilosgranpositivo']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr class="alert-link">
                    <td>CELULAS GUIA</td>
                    <td><input name="celulasfresco" type="text" class="form-control" id="celulasfresco" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['celulasfresco'])) { ?> value="<?php echo $reg[0]['celulasfresco']; ?>" <?php } ?>/></td>
                    <td>BACILOS GRAM NEGATIVO</td>
                    <td><input name="basilosgrannegativo" type="text" class="form-control" id="basilosgrannegativo" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['basilosgrannegativo'])) { ?> value="<?php echo $reg[0]['basilosgrannegativo']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr class="alert-link">
                    <td>TEST AMINAS</td>
                    <td><input name="testaminafresco" type="text" class="form-control" id="testaminafresco" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['testaminafresco'])) { ?> value="<?php echo $reg[0]['testaminafresco']; ?>" <?php } ?>/></td>
                    <td>COCOBACILO GRAM VARIABLE</td>
                    <td><input name="cocobacilogran" type="text" class="form-control" id="cocobacilogran" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['cocobacilogran'])) { ?> value="<?php echo $reg[0]['cocobacilogran']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr class="alert-link">
                    <td>HONGOS</td>
                    <td><input name="hongosfresco" type="text" class="form-control" id="hongosfresco" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['hongosfresco'])) { ?> value="<?php echo $reg[0]['hongosfresco']; ?>" <?php } ?>/></td>
                    <td>DIPLOCOCO GRAM NEGATIVO</td>
                    <td><input name="diplococogran" type="text" class="form-control" id="diplococogran" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['diplococogran'])) { ?> value="<?php echo $reg[0]['diplococogran']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr class="alert-link">
                    <td>TRICHOMONAS</td>
                    <td><input name="trichomonafresco" type="text" class="form-control" id="trichomonafresco" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['trichomonafresco'])) { ?> value="<?php echo $reg[0]['trichomonafresco']; ?>" <?php } ?>/></td>
                    <td>BLASTOCONIDIAS</td>
                    <td><input name="blastoconidiasgran" type="text" class="form-control" id="blastoconidiasgran" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['blastoconidiasgran'])) { ?> value="<?php echo $reg[0]['blastoconidiasgran']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr class="alert-link">
                    <td>LEUCOCITOS</td>
                    <td><input name="leucitofresco" type="text" class="form-control" id="leucitofresco" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['leucitofresco'])) { ?> value="<?php echo $reg[0]['leucitofresco']; ?>" <?php } ?>/></td>
                    <td>PSEUDOMICELIO</td>
                    <td><input name="pseudomiceliogran" type="text" class="form-control" id="pseudomiceliogran" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['pseudomiceliogran'])) { ?> value="<?php echo $reg[0]['pseudomiceliogran']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr class="alert-link">
                    <td>HEMATIES</td>
                    <td><input name="hematiesfresco" type="text" class="form-control" id="hematiesfresco" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['hematiesfresco'])) { ?> value="<?php echo $reg[0]['hematiesfresco']; ?>" <?php } ?>/></td>
                    <td>PMN</td>
                    <td><input name="pmngran" type="text" class="form-control" id="pmngran" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['pmngran'])) { ?> value="<?php echo $reg[0]['pmngran']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr>
                    <td colspan="5"><textarea name="observacionesfrotis" cols="80" rows="2" onKeyUp="this.value=this.value.toUpperCase();" class="form-control" id="observacionesfrotis" style="background:#f0f9fc;color:#000;font-weight:bold;font-size:14px;" placeholder="Ingrese Observaciones de Resultado"><?php if (isset($reg[0]['observacionesfrotis'])) { echo $reg[0]['observacionesfrotis']; } ?></textarea></td>
                    </tr>
                    </tbody>
                    </table>
                    </div>    
                </div>

                <div class="tab-pane fade" id="underline-inmunologia" role="tabpanel" aria-labelledby="underline-contact-tab">
                    <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                    <thead>
                    <tr class="alert-link">
                    <th colspan="3" class="text-center">INMUNOLOGÍA</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="alert-link">
                    <td>EXÁMEN</td>
                    <td>RESULTADO</td>
                    </tr>
                    <tr class="alert-link">
                    <td width="336">PRUEBA DE EMBARAZO</td>
                    <td width="238"><input name="pruebaembarazo" type="text" class="form-control" id="pruebaembarazo" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['pruebaembarazo'])) { ?> value="<?php echo $reg[0]['pruebaembarazo']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr class="alert-link">
                    <td>RPR-SISFILIS</td>
                    <td><input name="rprsisfilis" type="text" class="form-control" id="rprsisfilis" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['rprsisfilis'])) { ?> value="<?php echo $reg[0]['rprsisfilis']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr class="alert-link">
                    <td>RA TEST</td>
                    <td><input name="ratest" type="text" class="form-control" id="ratest" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['ratest'])) { ?> value="<?php echo $reg[0]['ratest']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr class="alert-link">
                    <td>ASTOS</td>
                    <td><input name="astos" type="text" class="form-control" id="astos" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['astos'])) { ?> value="<?php echo $reg[0]['astos']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr>
                    <td colspan="3"><textarea name="observacionesinmunologia" onKeyUp="this.value=this.value.toUpperCase();" cols="80" class="form-control" id="observacionesinmunologia" style="background:#f0f9fc;color:#000;font-weight:bold;font-size:14px;" placeholder="Ingrese Observaciones de Resultado" rows="2"><?php if (isset($reg[0]['observacionesinmunologia'])) { echo $reg[0]['observacionesinmunologia']; } ?></textarea></td>
                    </tr>
                    </tbody>
                    </table>
                    </div>  
                </div>

                <div class="tab-pane fade" id="underline-parasito" role="tabpanel" aria-labelledby="underline-contact-tab">
                    <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                    <tbody>
                    <tr class="alert-link">
                    <td colspan="5" class="text-center">COPROPARASITOLOGÍA</td>
                    </tr>
                    <tr class="alert-link">
                    <td width="330">COLOR</td>
                    <td width="260"><input class="form-control" type="text" name="colorparasitologia" id="colorparasitologia" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['colorparasitologia'])) { ?> value="<?php echo $reg[0]['colorparasitologia']; ?>" <?php } ?>/></td>
                    <td width="60">QUISTE</span></td>
                    <td width="350">Blastocystis hominis</td>
                    </tr>
                    <tr class="alert-link">
                    <td>CONSISTENCIA</td>
                    <td><input class="form-control" type="text" name="consistenciaparasitologia" id="consistenciaparasitologia" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['consistenciaparasitologia'])) { ?> value="<?php echo $reg[0]['consistenciaparasitologia']; ?>" <?php } ?>/></td>
                    <td>QUISTE</td>
                    <td>Endolimax nana</td>
                    </tr>
                    <tr class="alert-link">
                    <td>PH</td>
                    <td><input class="form-control" type="text" name="phparasitologia" id="phparasitologia" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['phparasitologia'])) { ?> value="<?php echo $reg[0]['phparasitologia']; ?>" <?php } ?>/></td>
                    <td>QUISTE</td>
                    <td>Entamoeba coli</td>
                    </tr>
                    <tr class="alert-link">
                    <td>SANGRE OCULTA</td>
                    <td><input class="form-control" type="text" name="sangreocultaparasitologia" id="sangreocultaparasitologia" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['sangreocultaparasitologia'])) { ?> value="<?php echo $reg[0]['sangreocultaparasitologia']; ?>" <?php } ?>/></td>
                    <td>QUISTE</td>
                    <td>Entamoeba hitolytica</td>
                    </tr>
                    <tr class="alert-link">
                    <td>AZUCARES REDUCTORES</td>
                    <td><input class="form-control" type="text" name="azucaresparasitologia" id="azucaresparasitologia" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['azucaresparasitologia'])) { ?> value="<?php echo $reg[0]['azucaresparasitologia']; ?>" <?php } ?>/></td>
                    <td>QUISTE</td>
                    <td>Giardia lamblia</td>
                    </tr>
                    <tr class="alert-link">
                    <td>ALMIDONES SIN DIGERIR</td>
                    <td><input class="form-control" type="text" name="almidonesparasitologia" id="almidonesparasitologia" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['almidonesparasitologia'])) { ?> value="<?php echo $reg[0]['almidonesparasitologia']; ?>" <?php } ?>/></td>
                    <td>HUEVO</td>
                    <td>Ascaris lumbricoides</td>
                    </tr>
                    <tr class="alert-link">
                    <td>HONGOS</td>
                    <td><input class="form-control" type="text" name="hongosparasitologia" id="hongosparasitologia" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['hongosparasitologia'])) { ?> value="<?php echo $reg[0]['hongosparasitologia']; ?>" <?php } ?>/></td>
                    <td>HUEVO</td>
                    <td>Uncinaria</td>
                    </tr>
                    <tr class="alert-link">
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>HUEVO</td>
                    <td>Tricocefalo</td>
                    </tr>
                    <tr class="alert-link">
                    <td>TRICHOMONAS HOMINIS</td>
                    <td><input class="form-control" type="text" name="trichomonaparasitologia" id="trichomonaparasitologia" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['trichomonaparasitologia'])) { ?> value="<?php echo $reg[0]['trichomonaparasitologia']; ?>" <?php } ?>/></td>
                    <td>HUEVO</td>
                    <td>Tenia sp</td>
                    </tr>
                    <tr class="alert-link">
                    <td>IODAMOEBA BUTSLLI</td>
                    <td><input class="form-control" type="text" name="iodamoebaparasitologia" id="iodamoebaparasitologia" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['iodamoebaparasitologia'])) { ?> value="<?php echo $reg[0]['iodamoebaparasitologia']; ?>" <?php } ?>/></td>
                    <td>HUEVO</td>
                    <td>Hymenolepis nana</td>
                    </tr>
                    <tr class="alert-link">
                    <td>OTROS</td>
                    <td><input class="form-control" type="text" name="otrosparasitologia" id="otrosparasitologia" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['otrosparasitologia'])) { ?> value="<?php echo $reg[0]['otrosparasitologia']; ?>" <?php } ?>/></td>
                    <td>HUEVO</td>
                    <td>Strongyloides</td>
                    </tr>
                    </tbody>
                    </table>
                    </div>

                    <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                    <tbody>
                    <tr class="alert-link">
                    <td colspan="3" class="text-center">MICROBIOLOGÍA</td>
                    </tr>
                    <tr class="alert-link">
                    <td width="467">KOH</td>
                    <td width="338"><input class="form-control" type="text" name="kohmicro" id="kohmicro" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['kohmicro'])) { ?> value="<?php echo $reg[0]['kohmicro']; ?>" <?php } ?>/></td>
                    </tr>
                    <tr class="alert-link">
                    <td>BACILOSOCOPIA</td>
                    <td><input class="form-control" type="text" name="baciloscopiamicro" id="baciloscopiamicro" style="width:100%;height:35px;background:#f0f9fc;color:#000;font-weight:bold;" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Resultado" <?php if (isset($reg[0]['baciloscopiamicro'])) { ?> value="<?php echo $reg[0]['baciloscopiamicro']; ?>" <?php } ?>/></td>
                    </tr>
                    </tbody>
                    </table>
                    </div> 
                </div>

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
   <!--<link href="plugins/autocomplete/autocomplete.css" rel="stylesheet" type="text/css" />-->
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