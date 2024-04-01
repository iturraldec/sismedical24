<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
     if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria") {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

if(isset($_POST["proceso"]) and $_POST["proceso"]=="save")
{
$reg = $tra->RegistrarSucursales();
exit;
}
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarSucursales();
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

<!--############################## MODAL PARA VER DETALLE DE SUCURSAL ######################################-->
<!-- Modal -->
<div class="modal fade" id="myModalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="text-white" data-feather="align-justify"></i> Detalle de Sucursal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="text-white" data-feather="x-circle"></i>
                </button>
            </div>

            <div class="modal-body"><!-- modal-body -->

            <div id="muestrasucursalmodal"></div>

            </div><!-- modal-body -->

            <div class="modal-footer">
                <button class="btn" type="button" data-dismiss="modal"><i data-feather="x-circle"></i> Cerrar</button>
            </div>

        </div>
    </div>
</div>
<!--############################## MODAL PARA VER DETALLE DE SUCURSAL ######################################-->


<!--############################## MODAL PARA REGISTRO DE NUEVA SUCURSAL ######################################-->
<!-- Modal -->
<div class="modal fade" id="myModalSucursal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="text-white" data-feather="align-justify"></i> Gestión de Sucursales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="text-white" data-feather="x-circle"></i>
                </button>
            </div>

            <form class="form-material" novalidate method="post" action="#" name="savesucursal" id="savesucursal" enctype="multipart/form-data">

            <div class="modal-body"><!-- modal-body -->
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Tipo de Documento: <span class="symbol required"></span></label>
                        <select style="color:#000;font-weight:bold;" name="documsucursal" id="documsucursal" class='form-control' required="" aria-required="true">
                            <option value=""> -- SELECCIONE -- </option>
                            <?php
                            $documento = new Login();
                            $documento = $documento->ListarDocumentos();
                            if($documento==""){
                                echo "";    
                            } else {
                            for($i=0;$i<sizeof($documento);$i++){ ?>
                                <option value="<?php echo $documento[$i]['coddocumento'] ?>"><?php echo $documento[$i]['documento'] ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>

                 <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nº de Sucursal: <span class="symbol required"></span></label>
                        <input type="hidden" name="proceso" id="proceso" value="save"/>
                        <input type="hidden" name="codsucursal" id="codsucursal">
                        <input type="text" class="form-control" name="cuitsucursal" id="cuitsucursal" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Sucursal" autocomplete="off" required="" aria-required="true"/> 
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Razón Social: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="nomsucursal" id="nomsucursal" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Razón Social" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nº de Teléfono: <span class="symbol required"></span></label>
                        <input type="text" class="form-control phone-inputmask" name="tlfsucursal" id="tlfsucursal" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Teléfono" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Correo Electrónico: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="correosucursal" id="correosucursal" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Correo Electrónico" autocomplete="off" required="" aria-required="true"/> 
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Departamento: <span class="symbol required"></span></label>
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
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Provincia: <span class="symbol required"></span></label>
                        <select style="color:#000;font-weight:bold;" class="form-control" id="idcanton" name="idcanton" onChange="CargaParroquias(this.form.idcanton.value);" required="" aria-required="true">
                        <option value=""> -- SIN RESULTADOS -- </option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Distrito: <span class="symbol required"></span></label>
                        <select style="color:#000;font-weight:bold;" class="form-control" id="idparroquia" name="idparroquia" required="" aria-required="true">
                        <option value=""> -- SIN RESULTADOS -- </option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Dirección de Sucursal: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="direcsucursal" id="direcsucursal" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Dirección de Sucursal" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Tipo de Documento: <span class="symbol required"></span></label>
                        <select style="color:#000;font-weight:bold;" name="documencargado" id="documencargado" class='form-control' required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <?php
                        $documento = new Login();
                        $documento = $documento->ListarDocumentos();
                        if($documento==""){
                            echo "";    
                        } else {
                        for($i=0;$i<sizeof($documento);$i++){ ?>
                        <option value="<?php echo $documento[$i]['coddocumento'] ?>"><?php echo $documento[$i]['documento'] ?></option>
                        <?php } } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                       <label class="control-label">Nº de Doc. de Encargado: <span class="symbol required"></span></label>
                       <input type="text" class="form-control" name="dniencargado" id="dniencargado" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº Documento de Encargado" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nombre de Encargado: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="nomencargado" id="nomencargado" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Encargado" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nº de Teléfono: </label>
                        <input type="text" class="form-control phone-inputmask" name="tlfencargado" id="tlfencargado" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Teléfono Encargado" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-8"> 
                    <div class="form-group has-feedback">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="form-group has-feedback"> 
                                <label class="control-label">Realice la Búsqueda de Imagen: </label>
                                <div class="input-group">
                                <div class="form-control" data-trigger="fileinput"><i data-feather="image"></i>
                                <span class="fileinput-filename"></span>
                                </div>
                                <span class="input-group-addon btn btn-primary btn-file">
                                <span class="fileinput-new"><i data-feather="image"></i> Selecciona Imagen</span>
                                <span class="fileinput-exists"><i data-feather="image"></i> Cambiar</span>
                                <input type="file" class="btn btn-default" data-original-title="Subir Imagen" data-rel="tooltip" placeholder="Suba su Imagen" name="imagen" id="imagen" autocomplete="off" title="Buscar Archivo">
                                </span>
                                <a href="#" class="input-group-addon btn btn-dark fileinput-exists" data-dismiss="fileinput"><i data-feather="x-octagon"></i> Quitar</a>
                                </div><small><p>Para Subir Logo de Sucursal debe tener en cuenta:<br> * La Imagen debe ser extension.png<br> * La imagen no debe ser mayor de 1 MB</p></small>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>

            </div><!-- modal-body -->

            <div class="modal-footer">
                <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><i data-feather="save"></i> Guardar</button>
                <button class="btn" type="button" data-dismiss="modal" onclick="
                document.getElementById('proceso').value = 'save',
                document.getElementById('codsucursal').value = '',
                document.getElementById('documsucursal').value = '',
                document.getElementById('cuitsucursal').value = '',
                document.getElementById('nomsucursal').value = '',
                document.getElementById('idprovincia').value = '',
                document.getElementById('idcanton').value = '',
                document.getElementById('idparroquia').value = '',
                document.getElementById('direcsucursal').value = '',
                document.getElementById('correosucursal').value = '',
                document.getElementById('tlfsucursal').value = '',
                document.getElementById('documencargado').value = '',
                document.getElementById('dniencargado').value = '',
                document.getElementById('nomencargado').value = '',
                document.getElementById('tlfencargado').value = '',
                document.getElementById('imagen').value = ''
                "><i data-feather="x-circle"></i> Cerrar</button>
            </div>

            </form>

        </div>
    </div>
</div>
<!--############################## MODAL PARA REGISTRO DE NUEVA SUCURSAL ######################################-->

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
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                        
                        <div class="widget-content widget-content-area br-6">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Sucursales</h5>
                                    </div>                  
                                </div>
                            </div>

                        <div class="table-responsive mb-4 mt-4">
                            <div class="btn-group">
                                <button type="button" class="btn waves-effect waves-light btn-primary" data-toggle="modal" data-target="#myModalSucursal" title="Nueva"><i data-feather="file-plus"></i> Nueva</button>

                                <a class="btn waves-effect waves-light btn-primary" href="reportepdf?tipo=<?php echo encrypt("SUCURSALES") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><i data-feather="file-text"></i> Pdf</a>

                                <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("SUCURSALES") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><i data-feather="file-text"></i> Excel</a>

                                <a class="btn waves-effect waves-light btn-primary" href="reporteexcel?documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("SUCURSALES") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><i data-feather="file-text"></i> Word</a>
                            </div>
                        </div>

                        <div id="sucursales"></div>
                               
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
    <script type="text/javascript" src="assets/script/validation.min.js"></script>
    <script type="text/javascript" src="assets/script/script.js"></script>
    <!-- script jquery -->

    <!-- jQuery Noty-->
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script type="text/jscript">
    $('#sucursales').append('<center><i data-feather="settings"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
    setTimeout(function() {
    $('#sucursales').load("consultas?CargaSucursales=si");
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