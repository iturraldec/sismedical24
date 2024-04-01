<?php
require_once("class/class.php");

$tra = new Login();

if(isset($_POST["proceso"]) and $_POST["proceso"]=="login")
{
  $log = $tra->Logueo();
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
    <link href="assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <!--<link rel="stylesheet" href="plugins/font-icons/fontawesome/css/fontawesome.css">-->
</head>
<body class="form" style="background:url(assets/img/bg-home.png); position: absolute; height: 100%; width: 100%; top: 0; left: 2px;">
    
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                    <?php if (file_exists("fotos/logo_principal.png")){
                    echo "<h3 class=''><img src='fotos/logo_principal.png' width='70%' alt='Logo Principal'></h3>"; 
                    } else { ?>
                    <h3 class="">Login de Acceso</h3>
                    <p class="">Inicie sesión en su cuenta para continuar.</p>
                    <?php } ?>
                    
                    <form class="text-left" name="formlogin" id="formlogin" action="" novalidate>	
                        <div class="form">

                    	<div id="login">
                    		<!-- error will be shown here ! -->
                    	</div>

                        <div class="field-wrapper input">
                            <div class="d-flex justify-content-between">
                                <h6 class="control-label text-dark">Ingrese su Usuario <span class="symbol required"></span></h6>
                            </div>
                            <i data-feather="user" class="text-primary"></i>
                            <input type="hidden" name="proceso" value="login"/>
                    		<input type="text" class="form-control" placeholder="Ingrese su Usuario" name="usuario" id="usuario" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" required="" aria-required="true"> 
                        </div>

                        <div id="password-field" class="field-wrapper input">
                            <div class="d-flex justify-content-between">
                                <h6 class="control-label text-dark">Ingrese su Password <span class="symbol required"></span></h6>
                                <a href="pass_recovery" class="forgot-pass-link text-info">Olvidaste tu Contraseña?</a>
                            </div>
                            <i data-feather="lock" class="text-primary"></i>
                            <input class="form-control" type="password" placeholder="Ingrese su Password" name="password" id="password" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" required="" aria-required="true">
                            <i data-feather="eye" id="toggle-password" class="text-primary"></i>
                        </div>

                        <div class="n-chk">
                            <label class="new-control new-radio new-radio-text radio-classic-primary">
                                <input type="radio" class="new-control-input" name="tipo" id="1" value="<?php echo encrypt("1"); ?>" checked>
                                <span class="new-control-indicator"></span><span class="new-radio-content">ADMINISTRACIÓN</span>
                            </label>

                            <label class="new-control new-radio new-radio-text radio-classic-primary">
                                <input type="radio" class="new-control-input" name="tipo" id="2" value="<?php echo encrypt("2"); ?>">
                                <span class="new-control-indicator"></span><span class="new-radio-content">MÉDICO</span>
                            </label><!---->
                        </div><br>

                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
                        <button type="submit" name="btn-login" id="btn-login" class="btn btn-primary btn-lg btn-block waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Haga clic aquí para iniciar sesión"><i data-feather="log-in"></i> Acceder</button>
                      </div>
                    </div>

                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="assets/script/password.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <script src="plugins/font-icons/feather/feather.min.js"></script>
    <script type="text/javascript">
        feather.replace();
    </script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- script jquery -->
    <script src="assets/script/jquery.min.js"></script> 
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/script/validation.min.js"></script>
    <script type="text/javascript" src="assets/script/script.js"></script>
    <!-- script jquery -->

    <!-- jQuery Noty-->
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <!-- jQuery Noty-->
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/authentication/form-2.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="assets/js/forms/bootstrap_validation/bs_validation_script.js"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->

</body>
</html>