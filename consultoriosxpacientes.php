<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
    if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "enfermera" || ($_SESSION['acceso'] == "medico" && in_array("1", explode(",", $_SESSION['modulos'])))) {

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
    
    <!--  BEGIN CUSTOM STYLE FILE -->
    <link rel="stylesheet" type="text/css" href="assets/css/elements/alert.css">
    <link href="assets/css/elements/search.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/dropify/dropify.min.css">
    <link href="assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->

</head>
<body onLoad="muestraReloj()" class="sidebar-noneoverflow">
    
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
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Consultorios por Pacientes</h5>
                                    </div>                 
                                </div>
                            </div>

    <div class="widget-content widget-content-area">                                
        <form class="form form-material" method="post" action="#" name="consultoriosxpaciente" id="consultoriosxpaciente">

            <?php if ($_SESSION['acceso'] == "medico") { ?>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-checkbox">
                                <input type="radio" class="custom-control-input" name="busqueda" id="optradio1" value="<?php echo encrypt("a"); ?>" checked="checked">
                                <label class="custom-control-label text-dark alert-link" for="optradio1">APERTURAS MÉDICAS</label>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-checkbox">
                                <input type="radio" class="custom-control-input" name="busqueda" id="optradio2" value="<?php echo encrypt("b"); ?>">
                                <label class="custom-control-label text-dark alert-link" for="optradio2">HOJA EVOLUTIVA</label>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-checkbox">
                                <input type="radio" class="custom-control-input" name="busqueda" id="optradio3" value="<?php echo encrypt("c"); ?>">
                                <label class="custom-control-label text-dark alert-link" for="optradio3">REMISIONES</label>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-checkbox">
                                <input type="radio" class="custom-control-input" name="busqueda" id="optradio4" value="<?php echo encrypt("d"); ?>">
                                <label class="custom-control-label text-dark alert-link" for="optradio4">FÓRMULAS MÉDICAS</label>
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
                                <input type="radio" class="custom-control-input" name="busqueda" id="optradio5" value="<?php echo encrypt("e"); ?>">
                                <label class="custom-control-label text-dark alert-link" for="optradio5">ÓRDENES MÉDICAS</label>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-checkbox">
                                <input type="radio" class="custom-control-input" name="busqueda" id="optradio6" value="<?php echo encrypt("f"); ?>">
                                <label class="custom-control-label text-dark alert-link" for="optradio6">FÓRMULAS TERAPIAS</label>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-checkbox">
                                <input type="radio" class="custom-control-input" name="busqueda" id="optradio7" value="<?php echo encrypt("g"); ?>">
                                <label class="custom-control-label text-dark alert-link" for="optradio7">SOLICITUD EXÁMENES</label>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12"> 
                    <div class="form-group has-feedback"> 
                        <label class="control-label">Búsqueda de Paciente: <span class="symbol required"></span></label>
                        <input type="hidden" name="url" id="url" value="<?php echo encrypt("1"); ?>" />
                        <input type="hidden" name="codsucursal" id="codsucursal" value="<?php echo encrypt($_SESSION['codsucursal']); ?>" />
                        <input type="hidden" name="codpaciente" id="codpaciente"/> 
                        <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="search_paciente" id="search_paciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Criterio para la Búsqueda de Paciente" autocomplete="off" required="required"/>
                    </div> 
                </div>
            </div>

        <?php } else { ?>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-checkbox">
                                <input type="radio" class="custom-control-input" name="busqueda" id="optradio1" value="<?php echo encrypt("a"); ?>" checked="checked">
                                <label class="custom-control-label text-dark alert-link" for="optradio1">APERTURAS MÉDICAS</label>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-checkbox">
                                <input type="radio" class="custom-control-input" name="busqueda" id="optradio2" value="<?php echo encrypt("b"); ?>">
                                <label class="custom-control-label text-dark alert-link" for="optradio2">HOJA EVOLUTIVA</label>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-checkbox">
                                <input type="radio" class="custom-control-input" name="busqueda" id="optradio3" value="<?php echo encrypt("c"); ?>">
                                <label class="custom-control-label text-dark alert-link" for="optradio3">REMISIONES</label>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-checkbox">
                                <input type="radio" class="custom-control-input" name="busqueda" id="optradio4" value="<?php echo encrypt("d"); ?>">
                                <label class="custom-control-label text-dark alert-link" for="optradio4">FÓRMULAS MÉDICAS</label>
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
                                <input type="radio" class="custom-control-input" name="busqueda" id="optradio5" value="<?php echo encrypt("e"); ?>">
                                <label class="custom-control-label text-dark alert-link" for="optradio5">ÓRDENES MÉDICAS</label>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-checkbox">
                                <input type="radio" class="custom-control-input" name="busqueda" id="optradio6" value="<?php echo encrypt("f"); ?>">
                                <label class="custom-control-label text-dark alert-link" for="optradio6">FÓRMULAS TERAPIAS</label>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-checkbox">
                                <input type="radio" class="custom-control-input" name="busqueda" id="optradio7" value="<?php echo encrypt("g"); ?>">
                                <label class="custom-control-label text-dark alert-link" for="optradio7">SOLICITUD EXÁMENES</label>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6"> 
                    <div class="form-group has-feedback"> 
                        <label class="control-label">Seleccione Sucursal: <span class="symbol required"></span></label>
                        <input type="hidden" name="url" id="url" value="<?php echo encrypt("1"); ?>" />
                        <select style="color:#000;font-weight:bold;" name="codsucursal" id="codsucursal" class="form-control" required="" aria-required="true">
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

                <div class="col-md-6"> 
                    <div class="form-group has-feedback"> 
                        <label class="control-label">Búsqueda de Paciente: <span class="symbol required"></span></label>
                        <input type="hidden" name="codpaciente" id="codpaciente"/> 
                        <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="search_paciente" id="search_paciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Criterio para la Búsqueda de Paciente" autocomplete="off" required="required"/>
                    </div> 
                </div>
            </div>

        <?php } ?>
                                    <div class="text-right">
        <button type="button" onClick="BuscarConsultoriosxPaciente()" class="btn btn-primary"><i data-feather="search"></i> Realizar Búsqueda</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <div id="muestraconsultoriosxpaciente"></div>

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

    <!-- script jquery -->
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/script/script2.js"></script>
    <!-- script jquery -->

    <!-- Calendario -->
    <link rel="stylesheet" href="assets/calendario/jquery-ui.css" />
    <link href="plugins/autocomplete/autocomplete.css" rel="stylesheet" type="text/css" />
    <script src="assets/calendario/jquery-ui.js"></script>
    <script src="assets/script/autocompleto.js"></script>
    <!-- Calendario -->

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