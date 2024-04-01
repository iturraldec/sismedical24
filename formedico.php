<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
    if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "enfermera") {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

if(isset($_POST["proceso"]) and $_POST["proceso"]=="save")
{
$reg = $tra->RegistrarMedicos();
exit;
}
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarMedicos();
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
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Gestión de Médicos</h5>
                                    </div>                 
                                </div>
                            </div>

    <div class="widget-content widget-content-area">                                
        

     <?php  if (isset($_GET['codmedico'])) {
      
      $reg = $tra->MedicosPorId(); ?>
      
    <form class="form-material" novalidate method="post" action="#" name="updatemedico" id="updatemedico" data-id="<?php echo $reg[0]["codmedico"] ?>" enctype="multipart/form-data">
        
    <?php } else { ?>

    <form class="form-material" novalidate method="post" action="#" name="savemedico" id="savemedico" enctype="multipart/form-data">
              
    <?php } ?>
            
            <div id="save">
               <!-- error will be shown here ! -->
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Tipo de Documento: <span class="symbol required"></span></label>
                        <?php if (isset($reg[0]['docummedico'])) { ?>
                        <select style="color:#000;font-weight:bold;" name="docummedico" id="docummedico" class='form-control' required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <?php
                        $doc = new Login();
                        $doc = $doc->ListarDocumentos();
                        if($doc==""){
                            echo "";    
                        } else {
                        for($i=0;$i<sizeof($doc);$i++){ ?>
                        <option value="<?php echo $doc[$i]['coddocumento'] ?>"<?php if (!(strcmp($reg[0]['docummedico'], htmlentities($doc[$i]['coddocumento'])))) { echo "selected=\"selected\""; } ?>><?php echo $doc[$i]['documento'] ?></option>
                        <?php } } ?>
                        </select>
                        <?php } else { ?>
                        <select style="color:#000;font-weight:bold;" name="docummedico" id="docummedico" class='form-control' required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <?php
                        $doc = new Login();
                        $doc = $doc->ListarDocumentos();
                        if($doc==""){
                            echo "";    
                        } else {
                        for($i=0;$i<sizeof($doc);$i++){ ?>
                        <option value="<?php echo $doc[$i]['coddocumento'] ?>"><?php echo $doc[$i]['documento'] ?></option>
                        <?php } } ?>
                        </select>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nº de Documento: <span class="symbol required"></span></label>
                        <input type="hidden" name="proceso" id="proceso" <?php if (isset($reg[0]['idmedico'])) { ?> value="update" <?php } else { ?> value="save" <?php } ?>/>
                        <input type="hidden" class="form-control" name="idmedico" id="idmedico" <?php if (isset($reg[0]['idmedico'])) { ?> value="<?php echo $reg[0]['idmedico']; ?>" <?php } ?>/>
                        <input type="hidden" class="form-control" name="codmedico" id="codmedico" <?php if (isset($reg[0]['codmedico'])) { ?> value="<?php echo $reg[0]['codmedico']; ?>" <?php } ?>/>
                        <input type="text" class="form-control" name="cedmedico" id="cedmedico" <?php if (isset($reg[0]['cedmedico'])) { ?> value="<?php echo $reg[0]['cedmedico']; ?>" <?php } ?> onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Documento" autocomplete="off" required="" aria-required="true"/> 
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nombre de Médico: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="nommedico" id="nommedico" <?php if (isset($reg[0]['nommedico'])) { ?> value="<?php echo $reg[0]['nommedico']; ?>" <?php } ?> onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Médico" autocomplete="off" required="" aria-required="true"/> 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Genero: <span class="symbol required"></span></label>
                        <?php if (isset($reg[0]['sexomedico'])) { ?> 
                        <select style="color:#000;font-weight:bold;" name="sexomedico" id="sexomedico" class='form-control' required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <option value="MASCULINO"<?php if (!(strcmp('MASCULINO', $reg[0]['sexomedico']))) {echo "selected=\"selected\"";} ?>> MASCULINO </option>
                        <option value="FEMENINO"<?php if (!(strcmp('FEMENINO', $reg[0]['sexomedico']))) {echo "selected=\"selected\"";} ?>> FEMENINO </option>
                        <option value="OTROS"<?php if (!(strcmp('OTROS', $reg[0]['sexomedico']))) {echo "selected=\"selected\"";} ?>> OTROS </option>
                        </select>
                        <?php } else { ?>
                        <select style="color:#000;font-weight:bold;" name="sexomedico" id="sexomedico" class='form-control' required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <option value="MASCULINO"> MASCULINO </option>
                        <option value="FEMENINO"> FEMENINO </option>
                        <option value="OTROS"> OTROS </option>
                        </select>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nº de Teléfono: <span class="symbol required"></span></label>
                        <input type="text" class="form-control phone-inputmask" name="tlfmedico" id="tlfmedico" <?php if (isset($reg[0]['tlfmedico'])) { ?> value="<?php echo $reg[0]['tlfmedico']; ?>" <?php } ?> onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Teléfono" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nº de Celular: <span class="symbol required"></span></label>
                        <input type="text" class="form-control phone-inputmask" name="celmedico" id="celmedico" <?php if (isset($reg[0]['celmedico'])) { ?> value="<?php echo $reg[0]['celmedico']; ?>" <?php } ?> onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Celular" autocomplete="off" required="" aria-required="true"/> 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Departamento: <span class="symbol required"></span></label>
                        <?php if (isset($reg[0]['idprovincia'])) { ?>
                        <select style="color:#000;font-weight:bold;" name="idprovincia" id="idprovincia" onChange="CargaCantones(this.form.idprovincia.value);" class='form-control' required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <?php
                        $provincia = new Login();
                        $provincia = $provincia->ListarProvincias();
                        if($provincia==""){
                            echo "";    
                        } else {
                        for($i=0;$i<sizeof($provincia);$i++){ ?>
                        <option value="<?php echo $provincia[$i]['idprovincia'] ?>"<?php if (!(strcmp($reg[0]['idprovincia'], htmlentities($provincia[$i]['idprovincia'])))) { echo "selected=\"selected\""; } ?>><?php echo $provincia[$i]['provincia'] ?></option>
                        <?php } } ?>
                        </select>
                        <?php } else { ?>
                        <select style="color:#000;font-weight:bold;" name="idprovincia" id="idprovincia" onChange="CargaCantones(this.form.idprovincia.value);" class='form-control' required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <?php
                        $provincia = new Login();
                        $provincia = $provincia->ListarProvincias();
                        if($provincia==""){
                            echo "";    
                        } else {
                        for($i=0;$i<sizeof($provincia);$i++){ ?>
                        <option value="<?php echo $provincia[$i]['idprovincia'] ?>"><?php echo $provincia[$i]['provincia'] ?></option>
                        <?php } } ?>
                        </select>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Provincia: <span class="symbol required"></span></label>
                        <?php if (isset($reg[0]['idcanton'])) { ?> 
                        <select style="color:#000;font-weight:bold;" class="form-control" id="idcanton" name="idcanton" onChange="CargaParroquias(this.form.idcanton.value);" required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <?php
                        $canton = new Login();
                        $canton = $canton->ListarCantones();
                        if($canton==""){
                            echo "";    
                        } else {
                        for($i=0;$i<sizeof($canton);$i++){ ?>
                        <option value="<?php echo $canton[$i]['idcanton'] ?>"<?php if (!(strcmp($reg[0]['idcanton'], htmlentities($canton[$i]['idcanton'])))) { echo "selected=\"selected\""; } ?>><?php echo $canton[$i]['canton'] ?></option>
                        <?php } } ?>
                        </select>
                        <?php } else { ?>
                        <select style="color:#000;font-weight:bold;" class="form-control" id="idcanton" name="idcanton" onChange="CargaParroquias(this.form.idcanton.value);" required="" aria-required="true">
                        <option value=""> -- SIN RESULTADOS -- </option>
                        </select>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Distrito: <span class="symbol required"></span></label>
                        <?php if (isset($reg[0]['idparroquia'])) { ?> 
                        <select style="color:#000;font-weight:bold;" class="form-control" id="idparroquia" name="idparroquia" required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <?php
                        $parroquia = new Login();
                        $parroquia = $parroquia->ListarParroquias();
                        if($parroquia==""){
                            echo "";    
                        } else {
                        for($i=0;$i<sizeof($parroquia);$i++){ ?>
                        <option value="<?php echo $parroquia[$i]['idparroquia'] ?>"<?php if (!(strcmp($reg[0]['idparroquia'], htmlentities($parroquia[$i]['idparroquia'])))) { echo "selected=\"selected\""; } ?>><?php echo $parroquia[$i]['parroquia'] ?></option>
                        <?php } } ?>
                        </select>
                        <?php } else { ?>
                        <select style="color:#000;font-weight:bold;" class="form-control" id="idparroquia" name="idparroquia" required="" aria-required="true">
                        <option value=""> -- SIN RESULTADOS -- </option>
                        </select>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Dirección Domiciliaria: </label>
                        <input type="text" class="form-control" name="direcmedico" id="direcmedico" <?php if (isset($reg[0]['direcmedico'])) { ?> value="<?php echo $reg[0]['direcmedico']; ?>" <?php } ?> onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Dirección Domiciliaria" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Correo Electrónico: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="correomedico" id="correomedico" <?php if (isset($reg[0]['correomedico'])) { ?> value="<?php echo $reg[0]['correomedico']; ?>" <?php } ?> onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Correo Electrónico" autocomplete="off" required="" aria-required="true"/> 
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                       <label class="control-label">CMP: <span class="symbol required"></span></label>
                       <input type="text" class="form-control" name="mps" id="mps" <?php if (isset($reg[0]['mps'])) { ?> value="<?php echo $reg[0]['mps']; ?>" <?php } ?> onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de MPS" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Especialidad: <span class="symbol required"></span></label>
                        <?php if (isset($reg[0]['codespecialidad'])) { ?> 
                        <select style="color:#000;font-weight:bold;" name="codespecialidad" id="codespecialidad" class='form-control' required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <?php
                        $especialidad = new Login();
                        $especialidad = $especialidad->ListarEspecialidades();
                        if($especialidad==""){
                            echo "";    
                        } else {
                        for($i=0;$i<sizeof($especialidad);$i++){ ?>
                        <option value="<?php echo encrypt($especialidad[$i]['codespecialidad']); ?>"<?php if (!(strcmp($reg[0]['codespecialidad'], htmlentities($especialidad[$i]['codespecialidad'])))) { echo "selected=\"selected\""; } ?>><?php echo $especialidad[$i]['nomespecialidad'] ?></option>
                        <?php } } ?>
                        </select>
                        <?php } else { ?>
                        <select style="color:#000;font-weight:bold;" name="codespecialidad" id="codespecialidad" class='form-control' required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <?php
                        $especialidad = new Login();
                        $especialidad = $especialidad->ListarEspecialidades();
                        if($especialidad==""){
                            echo "";    
                        } else {
                        for($i=0;$i<sizeof($especialidad);$i++){ ?>
                        <option value="<?php echo encrypt($especialidad[$i]['codespecialidad']); ?>"><?php echo $especialidad[$i]['nomespecialidad'] ?></option>
                        <?php } } ?>
                        </select>
                        <?php }  ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Fecha de Nacimiento: </label>
                        <input style="color:#000;font-weight:bold;width:170%;" type="text" class="form-control fnacimiento" name="fnacmedico" id="fnacmedico" <?php if (isset($reg[0]['fnacmedico'])) { ?> value="<?php echo $reg[0]['fnacmedico'] == '0000-00-00' ? "" : date("d-m-Y",strtotime($reg[0]['fnacmedico'])); ?>" <?php } ?> onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha de Nacimiento" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="upload mt-4 pr-md-4">
                        <input type="file" id="input-file-max-fs" class="dropify" data-default-file="<?php if (isset($reg[0]['codmedico'])) {
                            if (file_exists("fotos/".$reg[0]['codmedico'].".jpg")){
                                echo "<img src='fotos/".$reg[0]['codmedico'].".jpg?".date('h:i:s')."'>"; 
                            } else {
                                echo "<img src='fotos/img.png'>"; 
                            } } else {
                                echo "<img src='fotos/img.png'>"; 
                            }
                            ?>" data-max-file-size="1M" name="imagen" id="imagen"/>
                        <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Foto</p>
                        <small><p>Para Subir su Foto debe tener en cuenta:<br> * La Imagen debe ser extension.jpg<br> * La imagen no debe ser mayor de 1 MB</p></small>
                    </div>
                </div>
            </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> Módulos de Acceso</h5><hr>

        <!--ABRE DIAS LABORALES -->
        <div id="muestramodulosacceso">

        <div class="row">
            <?php
            $acceso = [
              "CONSULTORIO" => 1,
              "GINECOLOGIA" => 2,
              "LABORATORIO" => 3,
              "IMAGENES" => 4
            ];
            
            foreach ($acceso as $nombre => $dia):
            ?> 
            <div class="col-md-3">
                <div class="form-check">
                    <div class="custom-control custom-radio">
                        <input type="checkbox" class="custom-control-input" name="moduloacceso[]" id="<?php echo $dia; ?>" value="<?php echo $dia; ?>"
<?php

if (isset($_GET['codmedico'])) {

$explode_modulos = explode(",", $reg[0]['modulos']);

echo $var = in_array($dia, $explode_modulos) ? "checked=\"checked\"" : "";

}
?>>
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

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="home"></i> Sucursales</h5><hr>

        <!--ABRE SUCURSALES -->
        <div id="muestrasucursales">

        <?php 
        $sucursal = new Login();
        $sucursal = $sucursal->ListarSucursales();

        if($sucursal==""){  

        } else { ?>

        <div class="row"> 
             
            <?php
            $a=1;
            for($i=0;$i<sizeof($sucursal);$i++){ 
            ?>
            <div class="col-md-4">
                <div class="form-check">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="codsucursal[]" id="codsucursal_<?php echo $sucursal[$i]['codsucursal'] ?>" value="<?php echo $sucursal[$i]['codsucursal']; ?>"
                    <?php
                    if (isset($_GET['codmedico'])) {
                        $explode = explode(", ", decrypt($_GET['codsucursal']));
                    echo $var = in_array($sucursal[$i]['codsucursal'], $explode) ? "checked=\"checked\"" : ""; } ?>>
                        <label class="custom-control-label" for="codsucursal_<?php echo $sucursal[$i]['codsucursal'] ?>">
                        <?php echo $sucursal[$i]['nomsucursal'] ?>
                        </label>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div> 
        <?php } ?>

        </div>
        <!--CIERRE SUCURSALES -->

        <hr>

                                    <div class="text-right">

    <?php  if (isset($_GET['codmedico'])) { ?>
<button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><i data-feather="edit-2"></i> Actualizar</button>
<button class="btn btn-dark" type="reset"><i data-feather="x-circle"></i> Cancelar</button>
    <?php } else { ?>
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><i data-feather="save"></i> Guardar</button>
<button class="btn btn-dark" type="button" onclick="
                document.getElementById('proceso').value = 'save',
                document.getElementById('codmedico').value = '',
                document.getElementById('docummedico').value = '',
                document.getElementById('cedmedico').value = '',
                document.getElementById('nommedico').value = '',
                document.getElementById('sexomedico').value = '',
                document.getElementById('tlfmedico').value = '',
                document.getElementById('celmedico').value = '',
                document.getElementById('correomedico').value = '',
                document.getElementById('idprovincia').value = '',
                document.getElementById('idcanton').value = '',
                document.getElementById('direcmedico').value = '',
                document.getElementById('mps').value = '',
                document.getElementById('codespecialidad').value = '',
                document.getElementById('fnacmedico').value = '',
                document.getElementById('imagen').value = ''
                "><i data-feather="trash-2"></i> Limpiar</button>
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
    <script type="text/javascript" src="assets/script/validation.min.js"></script>
    <script type="text/javascript" src="assets/script/script.js"></script>
    <!-- script jquery -->

    <!-- Calendario -->
    <link rel="stylesheet" href="assets/calendario/jquery-ui.css" />
    <link href="plugins/autocomplete/autocomplete.css" rel="stylesheet" type="text/css" />
    <script src="plugins/flatpickr/flatpickr.js"></script>
    <script src="assets/calendario/jquery-ui.js"></script>
    <script src="assets/script/jscalendario.js"></script>
    <!--<script src="assets/script/autocompleto.js"></script>
     Calendario -->

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