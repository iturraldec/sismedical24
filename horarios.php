<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
     if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "enfermera" || $_SESSION['acceso'] == "medico") {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

if(isset($_POST["proceso"]) and $_POST["proceso"]=="save")
{
$reg = $tra->RegistrarHorarios();
exit;
}
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarHorarios();
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
    <link rel="stylesheet" type="text/css" href="plugins/dropify/dropify.min.css">
    <link href="assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/sweetalert.css">
    <link href="assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_html5.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <!-- END PAGE LEVEL CUSTOM STYLES -->

</head>
<body onLoad="muestraReloj()" class="sidebar-noneoverflow">

<!--############################## MODAL PARA VER DETALLE HORARIO DE MEDICO ######################################-->
<!-- Modal -->
<div class="modal fade" id="myModalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="text-white" data-feather="align-justify"></i> Detalle de Horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="text-white" data-feather="x-circle"></i>
                </button>
            </div>

            <div class="modal-body"><!-- modal-body -->

            <div id="muestrahorariomodal"></div>

            </div><!-- modal-body -->

            <div class="modal-footer">
                <button class="btn" type="button" data-dismiss="modal"><i data-feather="x-circle"></i> Cerrar</button>
            </div>

        </div>
    </div>
</div>
<!--############################## MODAL PARA VER DETALLE HORARIO DE MEDICO ######################################-->

<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") { ?>
<!--############################## MODAL PARA REGISTRO DE NUEVO HORARIO ######################################-->
<!-- Modal -->
<div class="modal fade" id="myModalHorario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="text-white" data-feather="align-justify"></i> Gestión de Horarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="text-white" data-feather="x-circle"></i>
                </button>
            </div>

            <form class="form-material" novalidate method="post" action="#" name="savehorario" id="savehorario" enctype="multipart/form-data">

            <div class="modal-body"><!-- modal-body -->

            <h5 class="card-subtitle text-dark alert-link"><i data-feather="search"></i> Búsqueda</h5><hr> 
            
            <div class="row">
                <div class="col-md-4"> 
                    <div class="form-group has-feedback"> 
                        <label class="control-label">Seleccione Sucursal: <span class="symbol required"></span></label>
                        <input type="hidden" name="proceso" id="proceso" value="save"/>
                        <input type="hidden" name="codhorario" id="codhorario">
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

        <hr> 

        <h5 class="card-subtitle text-dark alert-link"><i data-feather="calendar"></i> Dias Laborables</h5><hr>

        <!--ABRE DIAS LABORALES -->
        <div id="muestradiaslaborales">

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

        </div>
        <!--CIERRE DIAS LABORALES -->

        <hr> 

        <h5 class="card-subtitle text-dark alert-link"><i data-feather="clock"></i> Horas Laborables</h5><hr>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <label class="control-label">Hora Desde: <span class="symbol required"></span></label><br>
                    <input style="color:#000;font-weight:bold;width:200%;" type="text" class="form-control hora_modal" name="hora_desde" id="hora_desde" onKeyUp="this.value=this.value.toUpperCase();" placeholder="--:--" autocomplete="off" required="" aria-required="true"/>  
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <label class="control-label">Hora Hasta: <span class="symbol required"></span></label><br>
                    <input style="color:#000;font-weight:bold;width:200%;" type="text" class="form-control hora_modal" name="hora_hasta" id="hora_hasta" onKeyUp="this.value=this.value.toUpperCase();" placeholder="--:--" autocomplete="off" required="" aria-required="true"/>  
                </div>
            </div>
        </div>

        </div><!-- modal-body -->

            <div class="modal-footer">
                <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><i data-feather="save"></i> Guardar</button>
                <button class="btn" type="button" data-dismiss="modal" onclick="Limpiar_Horario();"><i data-feather="x-circle"></i> Cerrar</button>
            </div>

            </form>

        </div>
    </div>
</div>
<!--############################## MODAL PARA REGISTRO DE NUEVO HORARIO ######################################-->
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

                <div id="save">
                <!-- error will be shown here ! -->
                </div>
                
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                        <div class="widget-content-area br-4">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Horarios</h5>
                                    </div>                  
                                </div>
                            </div>

                        <div class="table mb-4 mt-4">
                            <div class="btn-group">
                                <?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") { ?>
                                <button type="button" class="btn waves-effect waves-light btn-primary" data-toggle="modal" data-target="#myModalHorario" title="Nuevo"><i data-feather="folder-plus"></i> Nuevo</button>
                                <?php } ?>

                                <a class="btn waves-effect waves-light btn-primary" href="reportepdf?tipo=<?php echo encrypt("HORARIOS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><i data-feather="file-text"></i> Pdf</a>

                                <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("HORARIOS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><i data-feather="file-text"></i> Excel</a>

                                <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("HORARIOS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><i data-feather="file-text"></i> Word</a>
                            </div>
                        </div>

                        <div id="horarios"></div>
                               
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
    <script src="assets/calendario/jquery-ui.js"></script>
    <script src="assets/script/jscalendario.js"></script>
    <script src="assets/script/autocompleto.js"></script>
    <!-- Calendario -->

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
    <script type="text/jscript">
    $('#horarios').append('<center><i data-feather="settings"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
    setTimeout(function() {
    $('#horarios').load("consultas?CargaHorarios=si");
     }, 200);
    </script>
    <!-- jQuery Noty-->

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