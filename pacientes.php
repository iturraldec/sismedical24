<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
     if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION['acceso'] == "enfermera" || $_SESSION["acceso"]=="medico") {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

if(isset($_POST["proceso"]) and $_POST["proceso"]=="cargar")
{
$reg = $tra->CargaPacientes();
exit;
} 
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="save")
{
$reg = $tra->RegistrarPacientes();
exit;
}
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarPacientes();
exit;
} 
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="cargardocumentos")
{
$reg = $tra->CargarDocumentosxPaciente();
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
    <!--  END CUSTOM STYLE FILE  -->

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_html5.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    
</head>
<body onLoad="muestraReloj()" class="sidebar-noneoverflow">

<!--############################## MODAL PARA CARGA MASIVA DE PACIENTE ######################################-->
<!-- Modal -->
<div class="modal fade" id="myModalCargaMasiva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="text-white" data-feather="align-justify"></i> Carga Masiva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="text-white" data-feather="x-circle"></i>
                </button>
            </div>

            <form class="form form-material" name="cargapacientes" id="cargapacientes" action="#" enctype="multipart/form-data">

            <div class="modal-body"><!-- modal-body -->

            <div class="row">
                <div class="col-md-12"> 
                    <div class="form-group has-feedback">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="form-group has-feedback"> 
                    <label class="control-label">Realice la Búsqueda del Archivo (CSV): <span class="symbol required"></span></label>
                    <div class="input-group">
                    <div class="form-control" data-trigger="fileinput"><i data-feather="file-text"></i>
                        <span class="fileinput-filename"></span>
                    </div>
                    <input type="hidden" name="proceso" value="cargar"/>
                    <span class="input-group-addon btn btn-info btn-file">
                    <span class="fileinput-new"><i data-feather="file-text"></i> Selecciona Archivo</span>
                    <span class="fileinput-exists"><i data-feather="file-text"></i> Cambiar</span>
                    <input type="file" class="btn btn-default" data-original-title="Suba su Archivo CSV" data-rel="tooltip" placeholder="Suba su Imagen" name="sel_file" id="sel_file" autocomplete="off" required="" aria-required="true">
                    </span>
                    <a href="#" class="input-group-addon btn btn-dark fileinput-exists" data-dismiss="fileinput"><i data-feather="x-octagon"></i> Quitar</a>
                            </div><small><p>Para realizar la Carga masiva de Pacientes el archivo debe de ser extensión (CSV Delimitado por Comas). Debe de llevar la cantidad de filas y columnas explicadas para la Carga exitosa de los registros.<br></small>
                            <div id="divpaciente"></div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div> 

            </div><!-- modal-body -->

            <div class="modal-footer">
                <button type="button" onClick="CargaDivPaciente()" class="btn btn-info"><i data-feather="eye"></i> Ver Detalles</button>
                <button type="submit" name="btn-cargar" id="btn-cargar" class="btn btn-primary"><i data-feather="upload-cloud"></i> Cargar</button>
                <button class="btn" type="button" data-dismiss="modal"><i data-feather="x-circle"></i> Cerrar</button>
            </div>

            </form>

        </div>
    </div>
</div>
<!--############################## MODAL PARA CARGA MASIVA DE PACIENTE ######################################-->


<!--############################## MODAL PARA VER DETALLE DE PACIENTE ######################################-->
<!-- Modal -->
<div class="modal fade" id="myModalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="text-white" data-feather="align-justify"></i> Detalle de Paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="text-white" data-feather="x-circle"></i>
                </button>
            </div>

            <div class="modal-body"><!-- modal-body -->

            <div id="muestrapacientemodal"></div>

            </div><!-- modal-body -->

            <div class="modal-footer">
                <button class="btn" type="button" data-dismiss="modal"><i data-feather="x-circle"></i> Cerrar</button>
            </div>

        </div>
    </div>
</div>
<!--############################## MODAL PARA VER DETALLE DE PACIENTE ######################################-->

<!--############################## MODAL PARA REGISTRO DE NUEVO PACIENTE ######################################-->
<!-- Modal -->
<div class="modal fade" id="myModalPaciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="text-white" data-feather="align-justify"></i> Gestión de Pacientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="text-white" data-feather="x-circle"></i>
                </button>
            </div>

            <form class="form-material" novalidate method="post" action="#" name="savepaciente" id="savepaciente">

            <div class="modal-body"><!-- modal-body -->

            <h5 class="card-subtitle text-dark alert-link"><i data-feather="user"></i> Datos Personales</h5><hr> 
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Tipo de Documento: <span class="symbol required"></span></label>
                        <select style="color:#000;font-weight:bold;" name="documpaciente" id="documpaciente" class='form-control' required="" aria-required="true">
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
                        <label class="control-label">Nº de Documento: <span class="symbol required"></span></label>
                        <input type="hidden" name="proceso" id="proceso" value="save"/>
                        <input type="hidden" name="formulario" id="formulario" value="pacientes"/>
                        <input type="hidden" name="codpaciente" id="codpaciente">
                        <input type="text" class="form-control number" name="cedpaciente" id="cedpaciente" onKeyUp="this.value=this.value.toUpperCase();" onBlur="VerificaDocumento(this.form.cedpaciente.value,'<?php echo encrypt("VERIFICAPACIENTE") ?>');" placeholder="Ingrese Nº de Documento" autocomplete="off" required="" aria-required="true"/>
                        <div id="muestra_msj" class="text-danger alert-link"></div> 
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Primer Nombre: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="pnompaciente" id="pnompaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Primer Nombre" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Segundo Nombre: </label>
                        <input type="text" class="form-control" name="snompaciente" id="snompaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Segundo Nombre" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Primer Apellido: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="papepaciente" id="papepaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Primer Apellido" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Segundo Apellido: </label>
                        <input type="text" class="form-control" name="sapepaciente" id="sapepaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Segundo Apellido" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Dirección Domiciliaria: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="direcpaciente" id="direcpaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Dirección Domiciliaria" autocomplete="off" required="" aria-required="true"/>  
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

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nº de Teléfono: <span class="symbol required"></span></label>
                        <input type="text" class="form-control phone-inputmask" name="tlfpaciente" id="tlfpaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Teléfono" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                 <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Fecha de Nacimiento: <span class="symbol required"></span></label>
                        <input style="color:#000;font-weight:bold;width:160%;" type="text" class="form-control" name="fnacpaciente" id="fnacpaciente" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Fecha de Nacimiento" required="" aria-required="true">
                    </div>
                </div> 

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Lugar de Nacimiento: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="lnacpaciente" id="lnacpaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Lugar de Nacimiento" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nacionalidad (Pais): <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="nacpaciente" id="nacpaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nacionalidad (Pais)" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Sexo: <span class="symbol required"></span></label>
                        <select style="color:#000;font-weight:bold;" name="sexopaciente" id="sexopaciente" class="form-control" required="" aria-required="true">
                            <option value=""> -- SELECCIONE -- </option>
                            <option value="MASCULINO">MASCULINO</option>
                            <option value="FEMENINO">FEMENINO</option>
                        </select> 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Estado Civil: </label>
                        <select style="color:#000;font-weight:bold;" name="estadopaciente" id="estadopaciente" class="form-control" required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                            <option value="SOLTERO(A)"> SOLTERO(A)</option>
                            <option value="CASADO(A)"> CASADO(A)</option>
                            <option value="VIUDO(A)"> VIUDO(A)</option>
                            <option value="DIVORCIADO(A)"> DIVORCIADO(A)</option>
                            <option value="CONCUBINO(A)"> CONCUBINO(A)</option> 
                            <option value="UNION LIBRE"> UNION LIBRE</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Grado de Instrucción: </label>
                        <input type="text" class="form-control" name="instruccionpaciente" id="instruccionpaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Instrucción Ultimo Año Aprobado" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Ocupación Laboral: </label>
                        <input type="text" class="form-control" name="ocupacionpaciente" id="ocupacionpaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Ocupación Laboral" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Empresa donde Trabaja: </label>
                        <input type="text" class="form-control" name="trabajapaciente" id="trabajapaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Empresa donde Trabaja" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Seguro: </label>
                        <select style="color:#000;font-weight:bold;" name="codseguro" id="codseguro" class='form-control' required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <?php
                        $seguro = new Login();
                        $seguro = $seguro->ListarSeguros();
                        if($seguro==""){
                            echo "";    
                        } else {
                        for($i=0;$i<sizeof($seguro);$i++){ ?>
                        <option value="<?php echo $seguro[$i]['codseguro'] ?>"><?php echo $seguro[$i]['nomseguro'] ?></option>
                        <?php } } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Referido: </label>
                        <input type="text" class="form-control" name="referidopaciente" id="referidopaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Referido" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label">Correo Electronico: </label>
                        <input type="text" class="form-control" name="emailpaciente" id="emailpaciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Correo Electronico" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Grupo Sanguineo:</label>
                        <select style="color:#000;font-weight:bold;" name="gruposapaciente" id="gruposapaciente" class="form-control">
                        <option value=""> -- SELECCIONE -- </option>
                            <option value="A RH-">A RH-</option>
                            <option value="A RH+">A RH+</option>
                            <option value="AB RH-">AB RH-</option>
                            <option value="AB RH+">AB RH+</option>
                            <option value="B RH-">B RH-</option>
                            <option value="B RH+">B RH+</option>
                            <option value="O RH-">O RH-</option>
                            <option value="O RH+">O RH+</option>
                        </select> 
                    </div>
                </div>
            </div>

            <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="users"></i> Datos del Acompañante</h5><hr>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nombre y Apellidos: </label>
                        <input type="text" class="form-control" name="nomacompana" id="nomacompana" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre y Apellidos" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Dirección Domiciliaria: </label>
                        <input type="text" class="form-control" name="direcacompana" id="direcacompana" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Dirección Domiciliaria" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nº de Teléfono: </label>
                        <input type="text" class="form-control phone-inputmask" name="tlfacompana" id="tlfacompana" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Teléfono" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Parentesco: </label>
                        <input type="text" class="form-control" name="parentescoacompana" id="parentescoacompana" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Parentesco" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>
            </div>

            <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="users"></i> Datos de Responsable</h5><hr>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nombre y Apellidos: </label>
                        <input type="text" class="form-control" name="nomresponsable" id="nomresponsable" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre y Apellidos" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Dirección Domiciliaria: </label>
                        <input type="text" class="form-control" name="direcresponsable" id="direcresponsable" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Dirección Domiciliaria" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nº de Teléfono: </label>
                        <input type="text" class="form-control phone-inputmask" name="tlfresponsable" id="tlfresponsable" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Teléfono" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Parentesco: </label>
                        <input type="text" class="form-control" name="parentescoresponsable" id="parentescoresponsable" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Parentesco" autocomplete="off" required="" aria-required="true"/>  
                    </div>
                </div>
            </div>

            </div><!-- modal-body -->

            <div class="modal-footer">
                <button type="submit" name="btn-paciente" id="btn-paciente" class="btn btn-primary"><i data-feather="save"></i> Guardar</button>
                <button class="btn" type="button" data-dismiss="modal" onclick="
                document.getElementById('proceso').value = 'save',
                document.getElementById('codpaciente').value = '',
                document.getElementById('numerohistoria').value = '',
                document.getElementById('documpaciente').value = '',
                document.getElementById('cedpaciente').value = '',
                document.getElementById('pnompaciente').value = '',
                document.getElementById('snompaciente').value = '',
                document.getElementById('papepaciente').value = '',
                document.getElementById('sapepaciente').value = '',
                document.getElementById('direcpaciente').value = '',
                document.getElementById('idparroquia').value = '',
                document.getElementById('idcanton').value = '',
                document.getElementById('idprovincia').value = '',
                document.getElementById('tlfpaciente').value = '',
                document.getElementById('fnacpaciente').value = '',
                document.getElementById('lnacpaciente').value = '',
                document.getElementById('nacpaciente').value = '',
                document.getElementById('sexopaciente').value = '',
                document.getElementById('estadopaciente').value = '',
                document.getElementById('instruccionpaciente').value = '',
                document.getElementById('ocupacionpaciente').value = '',
                document.getElementById('trabajapaciente').value = '',
                document.getElementById('codseguro').value = '',
                document.getElementById('referidopaciente').value = '',
                document.getElementById('gruposapaciente').value = '',
                document.getElementById('emailpaciente').value = '',
                document.getElementById('nomacompana').value = '',
                document.getElementById('direcacompana').value = '',
                document.getElementById('tlfacompana').value = '',
                document.getElementById('parentescoacompana').value = '',
                document.getElementById('nomresponsable').value = '',
                document.getElementById('direcresponsable').value = '',
                document.getElementById('tlfresponsable').value = '',
                document.getElementById('parentescoresponsable').value = ''
                "><i data-feather="x-circle"></i> Cerrar</button>
            </div>

            </form>

        </div>
    </div>
</div>
<!--############################## MODAL PARA REGISTRO DE NUEVO PACIENTE ######################################-->


<!--############################## MODAL PARA CARGAR DOCUMENTOS ######################################-->
<!-- Modal -->
<div class="modal fade" id="myModalCargaDocumentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="text-white" data-feather="align-justify"></i> Gestión de Documentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="text-white" data-feather="x-circle"></i>
                </button>
            </div>

            <form class="form-material" novalidate method="post" action="#" name="savedocumentopaciente" id="savedocumentopaciente" enctype="multipart/form-data">

            <div class="modal-body"><!-- modal-body -->

            <h5 class="card-subtitle text-dark alert-link"><i data-feather="user"></i> Datos de Paciente</h5><hr> 
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label alert-link">Nº de Historia: <span class="symbol required"></span></label>
                        <input type="hidden" name="proceso" id="proceso" value="cargardocumentos"/>
                        <input type="hidden" name="codpaciente" id="codpaciente">
                        <br /><abbr title="Nº de Historia"><label id="TxtNumero"></label></abbr>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label alert-link">Nº de Documento: <span class="symbol required"></span></label>
                        <br /><abbr title="Nº de Documento"><label id="TxtDocumento"></label></abbr>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label alert-link">Nombre de Paciente: <span class="symbol required"></span></label>
                        <br /><abbr title="Nombre de Paciente"><label id="TxtNombre"></label></abbr>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label alert-link">Apellido de Paciente: <span class="symbol required"></span></label>
                        <br /><abbr title="Apellido de Paciente"><label id="TxtApellido"></label></abbr>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label alert-link">Dirección Domiciliaria: <span class="symbol required"></span></label>
                        <br /><abbr title="Dirección Domiciliaria"><label id="TxtDireccion"></label></abbr>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label alert-link">Departamento: <span class="symbol required"></span></label>
                        <br /><abbr title="Provincia"><label id="TxtProvincia"></label></abbr>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label alert-link">Provincia: <span class="symbol required"></span></label>
                        <br /><abbr title="Cantón"><label id="TxtCanton"></label></abbr>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label alert-link">Distrito: <span class="symbol required"></span></label>
                        <br /><abbr title="Parroquia"><label id="TxtParroquia"></label></abbr>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label class="control-label alert-link">Nº de Teléfono: <span class="symbol required"></span></label>
                        <br /><abbr title="Nº de Teléfono"><label id="TxtTelefono"></label></abbr>
                    </div>
                </div>
            </div>

            <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="folder-plus"></i> Documentos a Cargar</h5><hr>

            <div class="row">
                <div class="col-md-12"> 
                    <div class="form-group has-feedback">
                        <a class="btn btn-info" onClick="Add()"><i data-feather="plus-circle"></i></a>&nbsp;
                        <a class="btn btn-dark" onClick="Delete()"><i data-feather="minus-circle"></i></a><hr>
                        <table width="100%" id="tabla">
                        <tr> 
                        <td>
                        <div class="form-group has-feedback">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="form-group has-feedback"> 
                                    <label class="control-label">Archivo a Cargar: <span class="symbol required"></span></label>
                                    <div class="input-group">
                                    <div class="form-control" data-trigger="fileinput"><i data-feather="image"></i>
                                    <span class="fileinput-filename"></span>
                                    </div>
                                    <span class="input-group-addon btn btn-success btn-file">
                                    <span class="fileinput-new"><i data-feather="image"></i> Selecciona Archivo</span>
                                    <span class="fileinput-exists"><i data-feather="image"></i> Cambiar</span>
                                    <input type="file" class="btn btn-default" data-original-title="Subir Archivo" data-rel="tooltip" placeholder="Suba su Archivo" name="file[]" id="file" autocomplete="off" title="Buscar Archivo" required="" aria-required="true">
                                    </span>
                                    <a href="#" class="input-group-addon btn btn-dark fileinput-exists" data-dismiss="fileinput"><i data-feather="x-octagon"></i> Quitar</a>
                                    </div><small><p>Para Subir el Archivo debe tener en cuenta:<br> * El Archivo a cargar debe ser extension.pdf,jpeg,jpg,png</p></small>
                                </div>
                            </div>
                        </div> 
                        </td></tr><input type="hidden" name="var_cont">
                        </table>
                   </div> 
                </div>
            </div>

            </div><!-- modal-body -->

            <div class="modal-footer">
                <button type="submit" name="btn-cargardocumento" id="btn-cargardocumento" class="btn btn-primary"><i data-feather="upload-cloud"></i> Cargar</button>
                <button class="btn" type="button" data-dismiss="modal" onclick="ResetDocumentosPaciente();"><i data-feather="x-circle"></i> Cerrar</button>
            </div>

            </form>

        </div>
    </div>
</div>
<!--############################## MODAL PARA CARGAR DOCUMENTOS ######################################-->

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
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Pacientes</h5>
                                    </div>                  
                                </div>
                            </div>

                <div class="table mb-4 mt-4">
                    <div class="col-md-6">
                        <div class="btn-group m-b-20">
                        <?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="enfermera") { ?>
                        <button type="button" class="btn waves-effect waves-light btn-primary" data-toggle="modal" data-target="#myModalCargaMasiva" title="Carga Masiva"><i data-feather="upload-cloud"></i> Carga Masiva</button>
                        <?php } ?>

                        <button type="button" class="btn waves-effect waves-light btn-primary" data-toggle="modal" data-target="#myModalPaciente" title="Nuevo"><i data-feather="user-plus"></i> Nuevo</button>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Reportes"><i data-feather="folder-plus"></i> Reportes</button>
                            <div class="dropdown-menu dropdown-menu-left" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(164px, 35px, 0px);">
                                <a class="dropdown-item" href="reportepdf?tipo=<?php echo encrypt("PACIENTES") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><i data-feather="file-text"></i> Pdf</a>

                                <a class="dropdown-item" href="reporteexcel?documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("PACIENTES") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><i data-feather="file-text"></i> Excel</a>

                                <a class="dropdown-item" href="reporteexcel?documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("PACIENTES") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><i data-feather="file-text"></i> Word</a>

                                <?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="enfermera") { ?>
                                <a class="dropdown-item" href="reporteexcel?documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("PACIENTESCSV") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><i data-feather="file-text"></i> CSV</a>
                                <?php } ?>
                            </div>
                        </div> 
                        </div>
                    </div>
                </div>

                <div class="widget-one">

                    <div class="col-lg-12 filtered-list-search mx-auto">
                        <form class="form-inline mb-8 justify-content-center" method="post" action="#" name="busquedapacientes" id="busquedapacientes">
                            <div class="w-100">
                                <input type="text" class="w-100 form-control product-search br-30" name="bpacientes" id="bpacientes" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Criterio para tu Búsqueda" autocomplete="off">
                                <button class="btn btn-primary" id="BotonBusqueda" type="button" onClick="BuscarPacientes();"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
                            </div>
                        </form>
                    </div>

                    <div id="muestrapacientes"></div>

                </div><!-- widget-one -->

                        </div>
                    </div>
                </div><!-- row layout-top-spacing -->

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
    <script type="text/javascript" src="assets/script/agrega_filas.js"></script>
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
        alert('NO TIENES PERMISO PARA ACCEDER A ESTA PAGINA.\nCONSULTA CON EL ADMINISTRADOR PARA QUE TE DE ACCESO')  
        document.location.href='logout'   
        </script> 
<?php } } else { ?>
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER AL SISTEMA.\nDEBERA DE INICIAR SESION')  
        document.location.href='logout'  
        </script> 
<?php } ?>