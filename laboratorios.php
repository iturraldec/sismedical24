<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
    if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "enfermera" || ($_SESSION['acceso'] == "medico" && in_array("3", explode(",", $_SESSION['modulos'])))) {

$tra = new Login();
$ses = $tra->ExpiraSession();   
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
    <link href="plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <!-- timepicker CSS -->
    
    <!--  BEGIN CUSTOM STYLE FILE -->
    <link rel="stylesheet" type="text/css" href="assets/css/elements/alert.css">
    <link href="assets/css/elements/search.css" rel="stylesheet" type="text/css" />
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

<!--############################## MODAL PARA VER DETALLE DE LABORATORIO ######################################-->
<!-- Modal -->
<div class="modal fade" id="myModalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="text-white" data-feather="align-justify"></i> Detalle de Examen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="text-white" data-feather="x-circle"></i>
                </button>
            </div>

            <div class="modal-body"><!-- modal-body -->

            <div id="muestralaboratoriomodal"></div>

            </div><!-- modal-body -->

            <div class="modal-footer">
                <button class="btn" type="button" data-dismiss="modal"><i data-feather="x-circle"></i> Cerrar</button>
            </div>

        </div>
    </div>
</div>
<!--############################## MODAL PARA VER DETALLE DE LABORATORIO ######################################-->

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
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Exámenes</h5>
                                    </div>                  
                                </div>
                            </div>

                        <div class="table mb-4 mt-4">
                            <div class="btn-group">
                                <a class="btn waves-effect waves-light btn-primary" href="reportepdf?tipo=<?php echo encrypt("LABORATORIOS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><i data-feather="file-text"></i> Pdf</a>

                                <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("LABORATORIOS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><i data-feather="file-text"></i> Excel</a>

                                <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("LABORATORIOS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><i data-feather="file-text"></i> Word</a>
                            </div>
                        </div>

                <div class="widget-one">

                    <div class="col-lg-12 filtered-list-search mx-auto">
                        <form class="form-inline mb-8 justify-content-center" method="post" action="#" name="busquedalaboratorios" id="busquedalaboratorios">
                            <div class="w-100">
                                <input type="text" class="w-100 form-control product-search br-30" name="search_criterio" id="search_criterio" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Criterio para tu Búsqueda" autocomplete="off">
                                <button class="btn btn-primary" id="BotonBusqueda" type="button" onClick="BuscarLaboratorios();"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
                            </div>
                        </form>
                    </div>

                    <div id="muestradetalles"></div>

                </div><!-- widget-one -->
                               
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

    <!-- Custom file upload -->
    <script src="assets/fileupload/bootstrap-fileupload.min.js"></script>

    <!-- script jquery -->
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/script/script2.js"></script>
    <!-- script jquery -->

    <!-- jQuery Noty-->
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $(document).keypress(function(e) {        
            var keycode = (e.keyCode ? e.keyCode : e.which);
            if (keycode == '13') {
            $("#BotonBusqueda").trigger("click");
            return false;
            }
        });                    
    });  
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