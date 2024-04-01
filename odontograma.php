<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
    if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "enfermera" || ($_SESSION['acceso'] == "medico" && in_array("6", explode(",", $_SESSION['modulos'])))) {

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

    <!-- css dientes -->
    <link rel="stylesheet" href="assets/css/odontograma/cssDiente.css">
    <link rel="stylesheet" href="assets/css/odontograma/cssFormulario.css">
    <link rel="stylesheet" href="assets/css/odontograma/cssComponentesPersonalizados.css">
    <!-- css dientes -->

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
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Gestión de Odontograma</h5>
                                    </div>                 
                                </div>
                            </div>

    <div class="widget-content widget-content-area">                                

     <?php $reg = $tra->OdontologiasPorId(); ?>
      
    <form class="form-material" novalidate method="post" action="#" name="saveodontograma" id="saveodontograma" data-id="<?php echo $reg[0]["cododontologia"] ?>" enctype="multipart/form-data">
        
        <div id="save">
            <!-- error will be shown here ! -->
        </div>

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="user"></i> Datos del Paciente</h5><hr> 

        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Nº de Historia: <span class="symbol required"></span></label>
                <div class="input-group">
                    <input type="hidden" name="proceso" id="proceso" value="save"/>
                    <input type="hidden" name="idodontologia" id="idodontologia" <?php if (isset($reg[0]['idodontologia'])) { ?> value="<?php echo encrypt($reg[0]['idodontologia']); ?>" <?php } ?>>
                    <input type="hidden" name="cododontologia" id="cododontologia" <?php if (isset($reg[0]['cododontologia'])) { ?> value="<?php echo encrypt($reg[0]['cododontologia']); ?>" <?php } ?>/>
                    <input type="hidden" name="codsucursal" id="codsucursal" <?php if (isset($reg[0]['codsucursal'])) { ?> value="<?php echo encrypt($reg[0]['codsucursal']); ?>" <?php } ?>/>

                    <input type="hidden" name="modulo_busqueda" id="modulo_busqueda"/>
                    <input type="hidden" name="sucursal_busqueda" id="sucursal_busqueda" <?php if (isset($reg[0]['codsucursal'])) { ?> value="<?php echo encrypt($reg[0]['codsucursal']); ?>" <?php } ?>/>
                    <input type="hidden" name="especialidad_busqueda" id="especialidad_busqueda"/>
                    <input type="hidden" name="medico_busqueda" id="medico_busqueda" <?php if (isset($reg[0]['codmedico'])) { ?> value="<?php echo encrypt($reg[0]['codmedico']); ?>" <?php } ?>/>
                    <input type="hidden" name="fecha_busqueda" id="fecha_busqueda"/>

                    <input type="hidden" name="codcita" id="codcita" <?php if (isset($reg[0]['codcita'])) { ?> value="<?php echo encrypt($reg[0]['codcita']); ?>" <?php } ?>/>
                    <input type="hidden" name="cita" id="cita" <?php if (isset($reg[0]['codcita'])) { ?> value="<?php echo $reg[0]['codcita']; ?>" <?php } ?>/>

                    <input type="hidden" name="codpaciente" id="codpaciente" <?php if (isset($reg[0]['codpaciente'])) { ?> value="<?php echo encrypt($reg[0]['codpaciente']); ?>" <?php } ?>/>
                    <input type="hidden" name="paciente" id="paciente" <?php if (isset($reg[0]['codpaciente'])) { ?> value="<?php echo $reg[0]['codpaciente']; ?>" <?php } ?>/> 
                    <input type="hidden" name="sucursal" id="sucursal" <?php if (isset($reg[0]['codsucursal'])) { ?> value="<?php echo $reg[0]['codsucursal']; ?>" <?php } ?>/>

                    <?php if (isset($reg[0]['idodontologia'])) { ?>

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

        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="file-text"></i> 1. Odontograma</h5><hr>

        <div class="row">
            <div class="col-md-12">

            <div id="seccionDientes" class="sombraFormulario"></div>          

            </div>
        </div>

        <hr>

        <div class="row">

        <div class="col-md-2">
            <section class="displayInlineBlockMiddle">
            <div class="dienteGeneral" id="dienteGeneral">
            <div id="C1" onClick="seleccionarCara(this.id);"></div>
            <div id="C2" onClick="seleccionarCara(this.id);"></div>
            <div id="C3" onClick="seleccionarCara(this.id);"></div>
            <div id="C4" onClick="seleccionarCara(this.id);"></div>
            <div id="C5" onClick="seleccionarCara(this.id);"></div>
            <input style="background: transparent !important;color:#000;font-weight:bold;" type="text" id="txtIdentificadorDienteGeneral" name="txtIdentificadorDienteGeneral" value="DXX" disabled="">
            </div>
            </section>
        </div>

        <div class="col-md-4">
            <div class="displayInlineBlockMiddle">
                <div id="odontograma" class="formulario sombraFormulario labelPequenio">

                <div class="tituloFormulario">DATOS DEL TRATAMIENTO</div>
                <div class="contenidoInterno">
                    <label class="alert-link" for="">Diente Tratado:</label>
                    <input style="color:#000;font-weight:bold;" type="text" id="txtDienteTratado" name="txtDienteTratado" class="textAlignCenter" size="4" readonly="readonly">
                    <br>
                    <label class="alert-link" for="">Cara Tratada:</label>
                    <input style="color:#000;font-weight:bold;" type="text" id="txtCaraTratada" name="txtCaraTratada" class="textAlignCenter" size="4" readonly="readonly">
                    <br>
                    <label class="alert-link" for="">Referencias:</label>
                    <select style="color:#000;font-weight:bold;" id="cbxEstado" name="cbxEstado" style="white">
                    <option value="">-- SELECCIONE REFERENCIA --</option>
                    <option value="1-DO: EN AZUL DIENTE OBTURADO">DO: EN AZUL DIENTE OBTURADO</option>
                    <option value="2-C: EN ROJO CARIADO">C: EN ROJO CARIADO</option>
                    <option value="3--: EN AZUL AUSENTE">-: EN AZUL AUSENTE</option>
                    <option value="4-X: EN ROJO EXODONCIA">X: EN ROJO EXODONCIA</option>
                    <option value="5-CP: EN ROJO CARIES PENETRANTE">CP: EN ROJO CARIES PENETRANTE</option>
                    <option value="6-R: EN ROJO RETENIDO">R: EN ROJO RETENIDO</option>
                    <option value="7-EN AZUL PIEZA DE PUENTE">FP: EN AZUL PIEZA DE PUENTE</option>
                    <option value="8-CO: EN AZUL CORONA">CO: EN AZUL CORONA</option>
                    <option value="9-PR: EN AZUL PROTESIS REMOVIBLE">PR: EN AZUL PROTESIS REMOVIBLE</option>
                    <option value="10-INC: INSCRUSTACION">INC: INSCRUSTACIÓN</option>
                    <option value="11-EP: EN ROJO ENFERMEDAD PERIODONTAL">EP: EN ROJO ENFERMEDAD PERIODONTAL</option>
                    <option value="12-FD: EN ROJO FRACTURA DENTARIA">FD: EN ROJO FRACTURA DENTARIA</option>
                    <option value="13-MPD: EN ROJO MAL POSICION DENTARIA">MPD: EN ROJO MAL POSICION DENTARIA</option>
                    <option value="14-PM: EN AZUL PERNO MUÑON">PM: EN AZUL PERNO MUÑON</option>
                    <option value="15-TC: EN AZUL TRATAMIENTO DE CONDUCTO">TC: EN AZUL TRATAMIENTO DE CONDUCTO</option>
                    <option value="16-F: EN ROJO FLUOROSIS">F: EN ROJO FLUOROSIS</option>
                    <option value="17-IMP: EN AZUL IMPLANTE DENTAL">IMP: EN AZUL IMPLANTE DENTAL</option>
                    <option value="18-MB: EN ROJO MANCHA BLANCA">MB: EN ROJO MANCHA BLANCA</option>
                    <option value="19-SC: EN AZUL SELLADOR">SC: EN AZUL SELLADOR</option>
                    <option value="20-SP SR: EN AZUL SURCO PROFUNDO">SP SR: EN AZUL SURCO PROFUNDO</option>
                    <option value="21-HP: EN AZUL HIPOPLASIA DE ESMALTE">HP: EN AZUL HIPOPLASIA DE ESMALTE</option>
                    <option value="22-DESGASTADO">DESG: DESGASTADO</option>
                    <option value="23-DIASTEMA">DIA: DIASTEMA</option>
                    <option value="24-MOVILIDAD">MOV: MOVILIDAD</option>
                    <option value="25-CORONA TEMPORAL">CT: CORONA TEMPORAL</option>
                    <option value="26-CORONA COMPLETA">CC: CORONA COMPLETA</option>
                    <option value="27-CORONA VEENER">CV: CORONA VEENER</option>
                    <option value="28-CORONA FEXESTRADA">CF: CORONA FEXESTRADA</option>
                    <option value="29-CORONA TRES CUARTOS">3/4: CORONA TRES CUARTOS</option>
                    <option value="30-CORONA PORCELANA">CP: CORONA PORCELANA</option>
                    <option value="31-PROTESIS FIJA">PROTESIS FIJA</option>
                    <option value="32-PROTESIS REMOVIBLE">PROTESIS REMOVIBLE</option>
                    <option value="33-ODONTULO TOTAL">ODONTULO TOTAL</option>
                    <option value="34-APARAT. ORTO. FIJO">APARAT. ORTO. FIJO</option>
                    <option value="35-APARAT. ORTO. REMOV.">APARAT. ORTO. REMOV.</option>
                    <option value="36-IMPLANTE">IMP: IMPLANTE</option>
                    <option value="37-SUPERNUMERARIO">S: SUPERNUMERARIO</option>
                    <option value="38-DIENTE POR EXTRAER">X: DIENTE POR EXTRAER</option>
                    <option value="39-A: AMALGAMA">A: AMALGAMA</option>
                    <option value="40-R: RESINA">R: RESINA</option>
                    </select>
                    <br></br>

        <div class="text-right">
            <button type="button" id="guarda" class="btn btn-danger waves-effect waves-light" <?php if (isset($reg[0]['cododontologia'])) { ?>  <?php } else { ?> disabled="" <?php } ?> onClick="guardarTratamiento();"><i data-feather="save"></i> Guardar</button>

            <button type="button" id="agrega" class="btn btn-primary waves-effect waves-light" <?php if (isset($reg[0]['cododontologia'])) { ?>  <?php } else { ?> disabled="" <?php } ?> onClick="agregarTratamiento($('#txtDienteTratado').val(), $('#txtCaraTratada').val(), $('#cbxEstado').val());"><i data-feather="plus-circle"></i> Agregar</button>
        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div id="divTratamiento" class="displayInlineBlockTop sombraFormulario" style="width: 100%;height:210px;overflow-y: scroll;scrollbar-width: thin;white-space: nowrap">
                <table id="tablaTratamiento" class="table2 table-striped table-bordered border display">
                <tbody>
                </tbody>
                </table>
            </div>
        </div>
                   
        </div>

        <hr>

        <div class="text-right">
<a class="text-dark" href="reportepdf?numero=<?php echo encrypt($reg[0]['cododontologia']); ?>&tipo=<?php echo encrypt("CONSTANCIA_ODONTOLOGIA") ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-dark"><i data-feather="printer"></i> Imprimir</button></a> 
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
    <script type="text/javascript" src="assets/script/agrega_filas.js"></script>
    <script type="text/javascript" src="assets/script/jsAcciones.js"></script>
    <script type="text/javascript" src="assets/script/html2canvas.js" type="text/javascript"></script>
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

    <script>
    cargarTratamientos("divTratamiento", "funciones.php?BuscaTablaTratamiento=si&codpaciente="+$('#codpaciente').val()+"&codsucursal="+$('#codsucursal').val(), '', '');
    cargarDientes("seccionDientes", "dientes.php", '', $('#codpaciente').val(), $('#codsucursal').val());
    </script>

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