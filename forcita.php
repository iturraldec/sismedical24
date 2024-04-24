<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
     if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION['acceso'] == "enfermera" || $_SESSION["acceso"]=="medico") {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

if(isset($_POST["proceso"]) and $_POST["proceso"]=="save")
{
$reg = $tra->RegistrarCitas();
exit;
}
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarCitas();
exit;
}  
elseif(isset($_POST['Event'][2]) and isset($_POST['Event'][2]) and $_POST['Event'][3]=="editdate")
{
$reg = $tra->ActualizarFechaCitas();
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

    <!-- timepicker CSS 
    <link href="plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">-->
    <!-- timepicker CSS -->

    <!-- timepicker CSS -->
    <link href="plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
    <link href="plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
    <!-- timepicker CSS -->
    
    <!--  BEGIN CUSTOM STYLE FILE -->
    <link rel="stylesheet" type="text/css" href="assets/css/elements/alert.css">
    <link href="assets/css/elements/search.css" rel="stylesheet" type="text/css" />
    <!--<link rel="stylesheet" type="text/css" href="plugins/dropify/dropify.min.css">
    <link href="assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" href="assets/css/sweetalert.css">
    <link href="assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />

    <link href="assets/css/fullcalendar.min.css" rel="stylesheet" /> 
    <link href="assets/css/calendar.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="plugins/dropify/dropify.min.css">
    <link href="assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->

</head>
<body onLoad="muestraReloj()" class="sidebar-noneoverflow">

<!--############################## MODAL PARA REGISTRO DE NUEVA CITA ######################################-->
<!-- Modal -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i data-feather="align-justify"></i> Gestión de Citas Médicas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x-circle"></i>
                </button>
            </div>

            <form class="form-material" novalidate method="post" action="#" name="savecita" id="savecita">

            <div class="modal-body"><!-- modal-body -->

            <div class="row"> 
                <div class="col-md-12"> 
                    <div class="form-group has-feedback"> 
                        <label class="control-label">Búsqueda de Paciente: <span class="symbol required"></span></label> 
                        <input type="hidden" name="proceso" id="proceso" value="save"/>
                        <input type="hidden" name="codcita" id="codcita">
                        <input type="hidden" name="medico" id="medico">
                        <input type="hidden" name="sucursal" id="sucursal">
                        <input type="hidden" name="especialidad" id="especialidad">
                        <input type="hidden" name="codpaciente" id="codpaciente" value="<?php echo $_SESSION["acceso"] == "paciente" ? $_SESSION["codpaciente"] : ''; ?>" />
                        <input type="hidden" name="delete" id="delete">
                        <input type="hidden" name="cancelar" id="cancelar">
                        <?php if ($_SESSION["acceso"] == "paciente") { ?>
                        <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="search_paciente" id="search_paciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Criterio para la Búsqueda de Paciente"
                            value="<?php echo $_SESSION["acceso"] == "paciente" ? $_SESSION["documento"]." ".$_SESSION["cedpaciente"]." : ".$_SESSION["pnompaciente"]." ".$_SESSION["snompaciente"]." ".$_SESSION["papepaciente"]." ".$_SESSION["sapepaciente"] : ''; ?>" disabled="" autocomplete="off" required="required"/>   
                        <?php } else { ?>
                        <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="search_paciente" id="search_paciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Criterio para la Búsqueda de Paciente"
                             autocomplete="off" required="required"/>
                        <?php } ?>
                    </div> 
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback2">
                        <label class="control-label">Motivo de Cita: <span class="symbol required"></span></label>
                        <textarea class="form-control" name="descripcion" id="descripcion" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Descripción de Cita" autocomplete="off" required="" rows="1" aria-required="true"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Seleccione Color: <span class="symbol required"></span></label>
                        <select style="color:#000;font-weight:bold;" name="color" id="color" class='form-control' required="" aria-required="true">
                            <option style="color:#0071c5;" value="#0071c5" selected="selected">&#9724; Azul oscuro</option>
                            <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
                            <option style="color:#008000;" value="#008000">&#9724; Verde</option>                       
                            <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
                            <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
                            <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
                            <option style="color:#000;" value="#000">&#9724; Negro</option>
                        </select> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Fecha de Cita: <span class="symbol required"></span></label>
                        <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="fechacita" id="fechacita" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha de Cita" autocomplete="off" readonly="" required="" aria-required="true"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="control-label">Hora de Cita: <span class="symbol required"></span></label>
                    <div class="input-group">
                        <input style="color:#000;font-weight:bold;" class="form-control" type="text" name="horacita" id="horacita" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Hora de Cita" autocomplete="off" readonly="" required="" aria-required="true">
                        <div class="input-group-append">
                            <div class="btn-group" data-bs-toggle="buttons">
                                <button type="button" id="BotonHoras" class="btn btn-primary waves-effect waves-light" data-placement="left" title="Asignar Hora" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalHoras" data-backdrop="static" data-keyboard="false" onClick="VerHorasDisponibles(document.getElementById('medico').value,document.getElementById('sucursal').value,document.getElementById('fechacita').value)"><i data-feather="clock"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

            </div><!-- modal-body -->

            <div class="modal-footer">
                <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><i data-feather="save"></i> Guardar</button>

                <?php if ($_SESSION["acceso"] != "paciente") { ?>

                <button type="button" class="btn btn-warning" id="cancelaevento" disabled="" onClick="CancelarCita(document.getElementById('cancelar').value,'<?php echo encrypt("CANCELARCITA") ?>')" title="Cancelar"><i data-feather="user-x"></i> Cancelar</button>

                <button type="button" class="btn btn-danger" id="deletevento" disabled="" onClick="EliminarCita(document.getElementById('delete').value,'<?php echo encrypt("CITAS") ?>')" title="Eliminar"><i data-feather="trash-2"></i> Eliminar</button>

                <button type="button" class="btn" data-dismiss="modal" onClick="Cerrar();"><i data-feather="x-circle"></i> Cerrar</button>

                <?php } else { ?>

                <button type="button" class="btn" data-dismiss="modal" onClick="Limpiar();"><i data-feather="x-circle"></i> Cerrar</button>

                <?php } ?>
            </div>

            </form>

        </div>
    </div>
</div>
<!--############################## MODAL PARA REGISTRO DE NUEVA CITA ######################################-->

<!--############################## MODAL PARA VER HORAS DISPONIBLES ######################################-->
<!-- Modal -->
<div class="modal fade" id="myModalHoras" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="text-white" data-feather="align-justify"></i> Horas Disponibles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="text-white" data-feather="x-circle"></i>
                </button>
            </div>

            <div class="modal-body"><!-- modal-body -->

            <div id="muestrahorasmodal"></div>

            </div><!-- modal-body -->

            <div class="modal-footer">
                <button class="btn" type="button" data-dismiss="modal"><i data-feather="x-circle"></i> Cerrar</button>
            </div>

        </div>
    </div>
</div>
<!--############################## MODAL PARA VER HORAS DISPONIBLES ######################################-->

    
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
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Gestión de Citas Médicas</h5>
                                    </div>                 
                                </div>
                            </div>

    <div class="widget-content widget-content-area">                                

            <div id="save">
               <!-- error will be shown here ! -->
            </div>

        <form class="form form-material" method="post" action="#" name="busquedacalendario" id="busquedacalendario">

        <?php if ($_SESSION['acceso'] == "medico") { ?>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nombre de Sucursal: <span class="symbol required"></span></label>
                        <input type="hidden" name="codsucursal" id="codsucursal" value="<?php echo encrypt($_SESSION['codsucursal']); ?>" />
                        <input type="text" class="form-control" name="sucursales" id="sucursales" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Sucursal" style="color:#000;font-weight:bold;" autocomplete="off" value="<?php echo $_SESSION['nomsucursal']; ?>" disabled="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nombre de Médico: <span class="symbol required"></span></label>
                        <input type="hidden" name="codmedico" id="codmedico" value="<?php echo encrypt($_SESSION['codmedico']); ?>"/>
                        <input type="text" class="form-control" name="medicos" id="medicos" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Médico" style="color:#000;font-weight:bold;" autocomplete="off" value="<?php echo $_SESSION['nommedico']; ?>" disabled="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Especialidad: <span class="symbol required"></span></label>
                        <input type="hidden" name="codespecialidad" id="codespecialidad" value="<?php echo encrypt($_SESSION['codespecialidad']); ?>"/>
                        <input type="text" class="form-control" name="especialidades" id="especialidades" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Especialidad" style="color:#000;font-weight:bold;" autocomplete="off" value="<?php echo $_SESSION['nomespecialidad']; ?>" disabled="" aria-required="true"/>  
                    </div>
                </div>
            </div>

        <?php } else { ?>
            
            <div class="row">
                <div class="col-md-4"> 
                    <div class="form-group has-feedback"> 
                        <label class="control-label">Seleccione Sucursal: <span class="symbol required"></span></label>
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

                <div class="col-md-4"> 
                    <div class="form-group has-feedback"> 
                        <label class="control-label">Seleccione Especialidad: <span class="symbol required"></span></label>
                        <select style="color:#000;font-weight:bold;" name="codespecialidad" id="codespecialidad" onChange="CargaMedicos(this.form.codsucursal.value,this.form.codespecialidad.value);" class="form-control" required="" aria-required="true">
                            <option value=""> -- SIN RESULTADOS -- </option>
                        </select>
                    </div> 
                </div>

                <div class="col-md-4"> 
                    <div class="form-group has-feedback"> 
                        <label class="control-label">Seleccione Médico: <span class="symbol required"></span></label>
                        <select style="color:#000;font-weight:bold;" name="codmedico" id="codmedico" class="form-control" required="" aria-required="true">
                            <option value=""> -- SIN RESULTADOS -- </option>
                        </select>
                    </div> 
                </div>
            </div>

        <?php } ?>

                                <div class="text-right">
        <button type="button" onClick="BuscarCitasCalendario()" class="btn btn-primary"><i data-feather="search"></i> Realizar Búsqueda</button>
                                </div>

                                </form>

                <!-- Row 
                <div class="row">
                    <div class="col-lg-12">
                            
                            <div id="cargacalendario"></div>

                    </div>
                </div>-->
                <!--End Row -->

                            </div>
                        </div>
                    </div>
                </div>

                <div id="muestra_calendario"></div>

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
            //
            App.init();

            //
            $("#ModalAdd").on("shown.bs.modal", function() {
                $("#color").val("#0071c5");
            });
        });
    </script>


     <!-- Sweet-Alert -->
     <script src="assets/js/sweetalert-dev.js"></script>
    <!-- Sweet-Alert --> 

    
    <script src="assets/js/custom.js"></script>
    
    <script src="plugins/font-icons/feather/feather.min.js"></script>
    <script type="text/javascript">
        feather.replace();
    </script>
    <!-- END GLOBAL MANDATORY SCRIPTS --> 
    
    <!-- FullCalendar -->
    <script src='plugins/fullcalendar/moment.min.js'></script>
    <script src='plugins/fullcalendar/fullcalendar.min.js'></script>
    <script src='plugins/fullcalendar/es.js'></script>
    <!-- FullCalendar -->

    <!-- script jquery -->
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/script/script2.js"></script>
    <script type="text/javascript" src="assets/script/validation.min.js"></script>
    <script type="text/javascript" src="assets/script/script.js"></script>
    <!-- script jquery -->

    <!-- Calendario -->
    <link rel="stylesheet" href="assets/calendario/jquery-ui.css" />
    <link href="plugins/autocomplete/autocomplete.css" rel="stylesheet" type="text/css" />
    <script src="plugins/flatpickr/flatpickr.js"></script>
    <script src="assets/calendario/jquery-ui.js"></script>
    <script src="assets/script/jscalendario.js"></script>
    <script src="assets/script/autocompleto.js"></script>
    <!-- Calendario -->

    <!-- jQuery Noty-->
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <!--<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
     jQuery Noty-->

</body>
</html>
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