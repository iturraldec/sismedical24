<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
     if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION['acceso'] == "enfermera" || $_SESSION['acceso'] == "medico") {

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

    <!--  BEGIN CUSTOM STYLE FILE  -->
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
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Mi Perfil</h5>
                                    </div>                 
                                </div>
                            </div>

    <div class="widget-content widget-content-area">                                
        <form class="form form-material" novalidate method="post" action="#">

            <div class="row">
                <div class="col-lg-11 mx-auto">
                    <div class="row">
                        <div class="col-xl-3 col-lg-12 col-md-4">
                            <div class="upload pr-md-4 text-center">
                                
                                <?php if($_SESSION['acceso']=="medico"){

                                if (isset($_SESSION['codigo'])) {
                                    if (file_exists("fotos/".$_SESSION['codigo'].".jpg")){
                                    echo "<img src='fotos/".$_SESSION['codigo'].".jpg?' width='140' height='140' class='rounded-circle'>"; 
                                    } else {
                                    echo "<img src='fotos/medico.png' width='140' height='140' class='rounded-circle'>"; 
                                    } } else {
                                    echo "<img src='fotos/medico.png' width='140' height='140' class='rounded-circle'>"; 
                                    }

                            } elseif($_SESSION['acceso']=="paciente"){

                                if (isset($_SESSION['codigo'])) {
                                    if (file_exists("fotos/".$_SESSION['codigo'].".jpg")){
                                    echo "<img src='fotos/".$_SESSION['codigo'].".jpg?' width='140' height='140' class='rounded-circle'>"; 
                                    } else {
                                    echo "<img src='fotos/paciente.png' width='140' height='140' class='rounded-circle'>"; 
                                    } } else {
                                    echo "<img src='fotos/paciente.png' width='140' height='140' class='rounded-circle'>"; 
                                    }

                            } else {

                                if (isset($_SESSION['codigo'])) {
                                    if (file_exists("fotos/".$_SESSION['codigo'].".jpg")){
                                    echo "<img src='fotos/".$_SESSION['codigo'].".jpg?' width='140' height='140' class='rounded-circle'>"; 
                                    } else {
                                    echo "<img src='fotos/avatar.png' width='140' height='140' class='rounded-circle'>"; 
                                    } } else {
                                    echo "<img src='fotos/avatar.png' width='140' height='140' class='rounded-circle'>"; 
                                    }
                            }
                                ?>

                                <h6 class="card-title text-primary mb-1"><?php echo $_SESSION['nivel']; ?></h6>
                                <?php if($_SESSION["acceso"]=="medico"){ ?>
                                <h6 class="text-danger alert-link mb-1"><?php echo $_SESSION['nomespecialidad']; ?></h6>
                                <?php } ?>
                                <h6 class="card-subtitle mb-1"><?php echo $_SESSION['email']; ?></h6>

                            </div>
                        </div>

                        <?php if($_SESSION['acceso']=="medico"){ ?>

                        <div class="col-xl-9 col-lg-12 col-md-8 mt-md-0">
                            <div class="form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Nº de Documento: <span class="symbol required"></span></label>
                                            <br /><abbr title="Nº de Documento"><?php echo $_SESSION['docummedico']." ".$_SESSION['cedmedico']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Nombre de Médico: <span class="symbol required"></span></label>
                                            <br /><abbr title="Nombre de Médico"><?php echo $_SESSION['nommedico']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Sexo de Médico: <span class="symbol required"></span></label>
                                            <br /><abbr title="Sexo de Médico"><?php echo $_SESSION['sexomedico']; ?></abbr>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Nº de Teléfono: <span class="symbol required"></span></label>
                                            <br /><abbr title="Nº de Teléfono"><?php echo $_SESSION['tlfmedico'] == "" ? "**********" : $_SESSION['tlfmedico']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Nº de Celular: <span class="symbol required"></span></label>
                                            <br /><abbr title="Nº de Celular"><?php echo $_SESSION['celmedico'] == "" ? "**********" : $_SESSION['celmedico']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Dirección Domiciliaria: <span class="symbol required"></span></label>
                                            <br /><abbr title="Dirección Domiciliaria"><?php echo $_SESSION['direcmedico']; ?></abbr>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Distrito: <span class="symbol required"></span></label>
                                            <br /><abbr title="Parroquia"><?php echo $_SESSION['idparroquia'] == 0 ? "**********" : $_SESSION['parroquia']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Provincia: <span class="symbol required"></span></label>
                                            <br /><abbr title="Cantón"><?php echo $_SESSION['idcanton'] == 0 ? "**********" : $_SESSION['canton']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Departamento: <span class="symbol required"></span></label>
                                            <br /><abbr title="Provincia"><?php echo $_SESSION['idprovincia'] == 0 ? "**********" : $_SESSION['provincia']; ?></abbr>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Correo de Médico: <span class="symbol required"></span></label>
                                            <br /><abbr title="Correo de Médico"><?php echo $_SESSION['correomedico']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Nº de MPS: <span class="symbol required"></span></label>
                                            <br /><abbr title="Nº de MPS"><?php echo $_SESSION['mps'] == "" ? "**********" : $_SESSION['mps']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Fecha de Nacimiento: <span class="symbol required"></span></label>
                                            <br /><abbr title="Fecha de Nacimiento"><?php echo $_SESSION["fnacmedico"] == '0000-00-00' ? "**********" : date("d-m-Y",strtotime($_SESSION["fnacmedico"])); ?></abbr>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php } elseif($_SESSION['acceso']=="paciente"){ ?>


                        <?php } else { ?>

                        <div class="col-xl-9 col-lg-12 col-md-8 mt-md-0">
                            <div class="form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Nº de Documento: <span class="symbol required"></span></label>
                                            <br /><abbr title="Nº de Documento"><?php echo $_SESSION['documusuario']." ".$_SESSION['dni']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Nombre de Usuario: <span class="symbol required"></span></label>
                                            <br /><abbr title="Nombre de Usuario"><?php echo $_SESSION['nombres']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Sexo de Usuario: <span class="symbol required"></span></label>
                                            <br /><abbr title="Sexo de Usuario"><?php echo $_SESSION['sexo']; ?></abbr>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Nº de Teléfono: <span class="symbol required"></span></label>
                                            <br /><abbr title="Nº de Teléfono"><?php echo $_SESSION['telefono'] == "" ? "**********" : $_SESSION['telefono']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Nº de Celular: <span class="symbol required"></span></label>
                                            <br /><abbr title="Nº de Celular"><?php echo $_SESSION['celular'] == "" ? "**********" : $_SESSION['celular']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Dirección Domiciliaria: <span class="symbol required"></span></label>
                                            <br /><abbr title="Dirección Domiciliaria"><?php echo $_SESSION['direccion']; ?></abbr>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Distrito: <span class="symbol required"></span></label>
                                            <br /><abbr title="Parroquia"><?php echo $_SESSION['idparroquia'] == 0 ? "**********" : $_SESSION['parroquia']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Provincia: <span class="symbol required"></span></label>
                                            <br /><abbr title="Cantón"><?php echo $_SESSION['idcanton'] == 0 ? "**********" : $_SESSION['canton']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Departamento: <span class="symbol required"></span></label>
                                            <br /><abbr title="Provincia"><?php echo $_SESSION['idprovincia'] == 0 ? "**********" : $_SESSION['provincia']; ?></abbr>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Correo de Usuario: <span class="symbol required"></span></label>
                                            <br /><abbr title="Correo de Usuario"><?php echo $_SESSION['email']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Nº de MPS: <span class="symbol required"></span></label>
                                            <br /><abbr title="Nº de MPS"><?php echo $_SESSION['mps'] == "" ? "**********" : $_SESSION['mps']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Especialidad: <span class="symbol required"></span></label>
                                            <br /><abbr title="Especialidad"><?php echo $_SESSION['codespecialidad'] == 0 ? "**********" : $_SESSION['nomespecialidad']; ?></abbr>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Fecha de Nacimiento: <span class="symbol required"></span></label>
                                            <br /><abbr title="Fecha de Nacimiento"><?php echo $_SESSION["fnacimiento"] == '0000-00-00' ? "**********" : date("d-m-Y",strtotime($_SESSION["fnacimiento"])); ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Usuario de Acceso: <span class="symbol required"></span></label>
                                            <br /><abbr title="Usuario de Acceso"><?php echo $_SESSION['usuario']; ?></abbr>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Nivel de Acceso: <span class="symbol required"></span></label>
                                            <br /><abbr title="Nivel de Acceso"><?php echo $_SESSION['nivel']; ?></abbr>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php } ?>

                    </div>
                </div>
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
    
    <script src="plugins/font-icons/feather/feather.min.js"></script>
    <script type="text/javascript">
        feather.replace();
    </script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- script jquery -->
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/script/validation.min.js"></script>
    <script type="text/javascript" src="assets/script/script.js"></script>
    <!-- script jquery -->

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