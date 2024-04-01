<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
     if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION['acceso'] == "enfermera" || $_SESSION["acceso"]=="medico") {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

if(isset($_POST["proceso"]) and $_POST["proceso"]=="save")
{
$reg = $tra->RegistrarConsentimientos();
exit;
}
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarConsentimientos();
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
                                        <h5 class="card-subtitle text-dark alert-link"><i data-feather="align-justify"></i> Gestión de Consentimientos</h5>
                                    </div>                 
                                </div>
                            </div>

    <div class="widget-content widget-content-area">                                

            <div id="save">
               <!-- error will be shown here ! -->
            </div>

    <?php  if (isset($_GET['numero'])) {
      
    $reg = $tra->ConsentimientosPorId(); ?>
      
    <form class="form form-material" method="post" action="#" name="updateconsentimiento" id="updateconsentimiento" data-id="<?php echo $reg[0]["codconsentimiento"]; ?>">
        
    <?php } else { ?>
        
    <form class="form form-material" method="post" action="#" name="saveconsentimiento" id="saveconsentimiento"> 

    <?php } ?>


    <?php  if (isset($_GET["numero"])) { ?>

    <input type="hidden" name="proceso" id="proceso" value="update"/>
    <input type="hidden" name="codconsentimiento" id="codconsentimiento" value="<?php echo encrypt($reg[0]['codconsentimiento']); ?>"/>
    <input type="hidden" name="codsucursal" id="codsucursal" value="<?php echo encrypt($reg[0]['codsucursal']); ?>"/>
    <input type="hidden" name="codespecialidad" id="codespecialidad" value="<?php echo encrypt($reg[0]['codespecialidad']); ?>"/>
    <input type="hidden" name="codmedico" id="codmedico" value="<?php echo encrypt($reg[0]['codmedico']); ?>"/>
    <input type="hidden" name="tipoconsentimiento" id="tipoconsentimiento" value="<?php echo encrypt($reg[0]['tipoconsentimiento']); ?>"/>
    <input type="hidden" name="codpaciente" id="codpaciente" value="<?php echo encrypt($reg[0]['codpaciente']); ?>"/>

    <hr><div class="row">
      <h4 class="col-md-12 text-danger alert-link">
      <?php 
      switch($reg[0]["tipoconsentimiento"]){
      case 1:
      ?>
      CONSENTIMIENTO INFORMADO PARA CONSULTORIO
      <?php
      break;
      case 2:
      ?>
      CONSENTIMIENTO INFORMADO PARA GINECOLOGIA
      <?php
      break;
      case 3:
      ?>
      CONSENTIMIENTO INFORMADO PARA LABORATORIO
      <?php
      break;
      case 4:
      ?>
      CONSENTIMIENTO INFORMADO PARA RADIOLOGIA 
      <?php
      break;
      case 5:
      ?> 
      CONSENTIMIENTO INFORMADO PARA TERAPEUTA
      <?php
      break;
      case 6:
      ?> 
      CONSENTIMIENTO INFORMADO PARA ODONTOLOGIA
      <?php
      break;
      }//end switch
      ?>
    </h4>
  </div>

  <hr><h5 class="card-subtitle text-dark alert-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Detalle de Consentimiento Informado del Paciente</h5><hr>

  <div class="row">
    <div class="col-md-12 text-dark alert-link">
      <p align="justify">PARA SATISFACCIÓN DE LOS <strong>DERECHOS DEL PACIENTE</strong>, COMO INSTRUMENTO FAVORECEDOR DEL CORRECTO USO DE LOS PROCEDIMIENTOS TERAPÉUTICOS Y DIAGNÓSTICOS<br><br> 

      YO D/Dª <?php echo "<span class='text-danger alert-link'>".$reg[0]['nompaciente']." ".$reg[0]['apepaciente']."</span>"; ?> <?php echo $variable = ( edad($reg[0]['fnacpaciente']) >= '18' ? " MAYOR DE EDAD" : " MENOR DE EDAD");  ?>, CON <?php echo "<span class='text-danger alert-link'>".$reg[0]['documento']." N&deg; ".$reg[0]['cedpaciente']."</span>"; ?>, Y CON <?php echo "<span class='text-danger alert-link'>HCL: ".$reg[0]['numerohistoria']."</span>"; ?> O D/Dª <?php echo "<strong>".$responsable = ($reg[0]['nomresponsable'] == "" ? "**********" : $reg[0]['nomresponsable'])."</strong>"; ?> COMO SU REPRESENTANTE LEGAL EN PLENO USO DE MIS FACULTADES, LIBRE Y VOLUNTARIAMENTE<br><br>

      <strong>DECLARO:</strong><br><br>

      QUE EL/LA DR./DRA <?php echo "<span class='text-danger alert-link'>".$reg[0]['nommedico']."</span>"; ?> CON PROFESIÓN O ESPECIALIDAD <?php echo "<span class='text-danger alert-link'>".$reg[0]['nomespecialidad']."</span>"; ?>, ME HA EXPLICADO, EN TÉRMINOS ASEQUIBLES, LA NATURALEZA EXACTA DE LA INTERVENCIÓN O PROCEDIMIENTO QUE SE ME VA A REALIZAR Y SU NECESIDAD. HE TENIDO LA OPORTUNIDAD DE DISCUTIR CON EL FACULTATIVO CÓMO SE VA A EFECTUAR, SU PROPÓSITO, LAS ALTERNATIVAS RAZONABLES, LAS POSIBLES CONSECUENCIAS DE NO HACER ESTE TRATAMIENTO Y TODOS LOS RIESGOS Y POSIBLES COMPLICACIONES QUE DE ÉL PUEDAN DERIVARSE.<br><br>

      COMPRENDO TAMBIÉN QUE UN RESULTADO INDESEABLE NO NECESARIAMENTE IMPLICA UN ERROR EN ESE JUICIO, POR LO QUE BUSCANDO LOS MEJORES RESULTADOS CONFÍO EN QUE EL CONOCIMIENTO Y LAS DECISIONES DEL PROFESIONAL DURANTE EL PROCEDIMIENTO O INTERVENCIÓN ESTARÁN BASADOS SOBRE LOS HECHOS HASTA ENTONCES CONOCIDOS, BUSCANDO SIEMPRE MI MAYOR BENEFICIO.<br>

      ME HA EXPLICADO QUE EL TRATAMIENTO QUE SE VA A HACER SE EFECTUARÁ BAJO ANESTESIA LOCAL, O GENERAL EN LOS CASOS QUE REQUIEREN HOSPITALIZACIÓN. SU FINALIDAD ES BLOQUEAR, DE FORMA REVERSIBLE, LA TRANSMISIÓN DE LOS IMPULSOS NERVIOSOS, PARA PODER REALIZAR LA INTERVENCIÓN SIN DOLOR.<br><br>

      SI BIEN A PARTIR DE MIS ANTECEDENTES PERSONALES NO SE DEDUCEN POSIBLES ALERGIAS O HIPERSENSIBILIDAD A LOS COMPONENTES DE LA SOLUCIÓN ANESTÉSICA, ELLO NO EXCLUYE LA POSIBILIDAD DE QUE, A PESAR DE SER MUY IMPROBABLE, PUEDAN PRESENTARSE MANIFESTACIONES ALÉRGICAS DEL TIPO URTICARIA, DERMATITIS DE CONTACTO, ASMA, EDEMA ANGIONEURÓTICO, Y EN CASOS EXTREMOS SHOCK ANAFILÁCTICO, QUE PUEDEN REQUERIR TRATAMIENTO URGENTE.<br>

      LAS SUSTANCIAS QUE CONTIENE LA SOLUCIÓN ANESTÉSICA PUEDEN ORIGINAR LEVES ALTERACIONES DEL PULSO Y DE LA TENSIÓN ARTERIAL. SE ME HA INFORMADO QUE, AÚN EN EL CASO DE QUE NO SE DEDUZCA NINGÚN TIPO DE PATOLOGÍA CARDIOVASCULAR DE MIS ANTECEDENTES, LA PRESENCIA DE ADRENALINA PUEDE FAVORECER, AUNQUE DE FORMA MUY INUSUAL, LA APARICIÓN DE ARRITMIAS LEVES.<br><br>
       
      HE SIDO INFORMADO DE:<br>
      • QUE ESTAS COMPLICACIONES GENERALES PUEDEN REQUERIR TRATAMIENTOS MÉDICO-QUIRÚRGICOS ADICIONALES Y QUE, RARAMENTE, ALGUNAS PUEDEN DEJAR SECUELAS DEFINITIVAS.<br>
      • LA BIOPSIA CONSISTE EN LA TOMA DE UNA MUESTRA REPRESENTATIVA DE LA LESIÓN. ESTE PROCEDIMIENTO ANALIZADO POR EL PATÓLOGO, NOS DA EL DIAGNÓSTICO DEFINITIVO DE LA LESIÓN, LO QUE DARÁ PASO AL COMIENZO DEL TRATAMIENTO CONCRETO DE LA MISMA. LAS COMPLICACIONES POTENCIALES DE ESTE TRATAMIENTO QUIRÚRGICO, SON, APARTE DE LAS MENCIONADAS PREVIAMENTE:<br>
      . NECESIDAD DE REPETIR LA BIOPSIA, SI EL PATÓLOGO NECESITARA OTRA MUESTRA PARA UN ANÁLISIS HISTOLÓGICO MÁS DETALLADO.<br>
      . INFECCIÓN POSTQUIRÚRGICA DE LA ZONA BIOPSIADA.<br>
      . HEMORRAGIA DURANTE LAS PRIMERAS HORAS POSTINTERVENCIÓN.<br>
      . DEHISCENCIA DE LA SUTURA.<br><br>

      CONSIENTO EN QUE SE TOMEN FOTOGRAFÍAS O REGISTROS EN OTROS TIPOS DE SOPORTE AUDIOVISUAL, ANTES, DURANTE Y DESPUÉS DE LA INTERVENCIÓN QUIRÚRGICA, PARA FACILITAR EL AVANCE DEL CONOCIMIENTO CIENTÍFICO Y LA DOCENCIA. EN TODOS LOS CASOS SERÁ RESGUARDADA LA IDENTIDAD DEL/DE LA PACIENTE.<br>

      HE COMPRENDIDO LAS EXPLICACIONES QUE SE ME HAN FACILITADO, Y EL FACULTATIVO ME HA PERMITIDO REALIZAR TODAS LAS OBSERVACIONES Y ME HA ACLARADO TODAS LAS DUDAS QUE LE HE PLANTEADO.<br>

      SI SURGIERA CUALQUIER SITUACIÓN INESPERADA DURANTE LA INTERVENCIÓN, AUTORIZO A MI ESPECIALISTA A REALIZAR CUALQUIER PROCEDIMIENTO O MANIOBRA QUE, EN SU JUICIO CLÍNICO, ESTIME OPORTUNA PARA MI MEJOR TRATAMIENTO.<br>

      TAMBIÉN COMPRENDO, QUE EN CUALQUIER MOMENTO Y SIN NECESIDAD DE DAR NINGUNA EXPLICACIÓN, PUEDO REVOCAR EL CONSENTIMIENTO QUE AHORA PRESTO.<br>

      POR ELLO, ME CONSIDERO EN CONDICIONES DE PONDERAR DEBIDAMENTE TANTO LOS RIESGOS COMO LA UTILIDAD Y BENEFICIO QUE PUEDO OBTENER DEL TRATAMIENTO; ASÍ PUES, MANIFIESTO QUE ESTOY SATISFECHO/A CON LA INFORMACIÓN RECIBIDA Y POR ELLO, <strong>YO DOY MI CONSENTIMIENTO</strong>, PARA LA REALIZACIÓN DEL PROCEDIMIENTO<br><br> 

      </p>
    </div>
  </div>

  <div class="row"> 
    <div class="col-md-12"> 
      <div class="form-group has-feedback"> 
        <label class="control-label alert-link">PROCEDIMIENTO:</label> 
        <textarea class="form-control" name="procedimiento" id="procedimiento" onkeyup="this.value=this.value.toUpperCase();" style="color:#000;font-weight:bold;width:100%;background:#f0f9fc;border-radius:5px 5px 5px 5px;" autocomplete="off" placeholder="Ingrese Procedimiento" rows="2" required="" aria-required="true"><?php echo $reg[0]["procedimiento"]; ?></textarea>     
      </div>
    </div>   
  </div>

  <div class="row"> 
    <div class="col-md-12"> 
      <div class="form-group has-feedback"> 
        <label class="control-label alert-link">BAJO ANESTESIA:</label> 
        <textarea class="form-control" name="anestesia" id="anestesia" onkeyup="this.value=this.value.toUpperCase();" style="color:#000;font-weight:bold;width:100%;background:#f0f9fc;border-radius:5px 5px 5px 5px;" autocomplete="off" placeholder="Ingrese Anestesia" rows="3" required="" aria-required="true"><?php echo $reg[0]["anestesia"]; ?></textarea>     
      </div>
    </div>   
  </div>

  <div class="row"> 
    <div class="col-md-12"> 
      <div class="form-group has-feedback"> 
        <label class="control-label alert-link">ENFERMEDAD:</label> 
        <textarea class="form-control" name="enfermedad" id="enfermedad" onkeyup="this.value=this.value.toUpperCase();" style="color:#000;font-weight:bold;width:100%;background:#f0f9fc;border-radius:5px 5px 5px 5px;" autocomplete="off" placeholder="Ingrese Enfermedad" rows="3" required="" aria-required="true"><?php echo $reg[0]["enfermedad"]; ?></textarea>     
      </div>
    </div>   
  </div>

  <div class="row"> 
    <div class="col-md-12"> 
      <div class="form-group has-feedback"> 
        <label class="control-label alert-link">OBSERVACIONES:</label> 
        <textarea class="form-control" name="observaciones" id="observaciones" onkeyup="this.value=this.value.toUpperCase();" style="color:#000;font-weight:bold;width:100%;background:#f0f9fc;border-radius:5px 5px 5px 5px;" autocomplete="off" placeholder="Ingrese Observaciones" rows="3" required="" aria-required="true"><?php echo $reg[0]["observaciones"]; ?></textarea>     
      </div>
    </div>   
  </div>

  <div class="row">
    <div class="col-md-12 text-dark alert-link">
      <p align="justify">Y PARA QUE ASÍ CONSTE, FIRMO EL PRESENTE ORIGINAL DESPUÉS DE LEÍDO.</p>
    </div>
  </div>

  <div class="row"> 
    <div class="col-md-4"> 
      <div class="form-group has-feedback"> 
        <label class="control-label alert-link">Nº de Documento de Testigo:</label> 
        <input class="form-control" type="text" name="doctestigo" id="doctestigo" onkeyup="this.value=this.value.toUpperCase();" style="color:#000;font-weight:bold;width:100%;background:#f0f9fc;border-radius:5px 5px 5px 5px;" autocomplete="off" placeholder="Ingrese Nº de Documento" value="<?php echo $reg[0]["doctestigo"]; ?>" required="" aria-required="true">  
      </div> 
    </div>
                                     
    <div class="col-md-8">
      <div class="form-group has-feedback">
        <label class="control-label alert-link">Nombre del Testigo o Responsable del Paciente:</label> 
        <input class="form-control" type="text" name="nombretestigo" id="nombretestigo" onkeyup="this.value=this.value.toUpperCase();" style="color:#000;font-weight:bold;width:100%;background:#f0f9fc;border-radius:5px 5px 5px 5px;" autocomplete="off" placeholder="Ingrese Nombre de Testigo" value="<?php echo $reg[0]["nombretestigo"]; ?>" required="" aria-required="true">
      </div> 
    </div>
  </div>  
              
  <div class="row"> 
    <div class="col-md-12"> 
      <div class="form-group has-feedback"> 
        <label class="control-label alert-link">El Paciente no puede firmar por:</label> 
        <textarea name="nofirmapaciente" class="form-control" id="nofirmapaciente" onkeyup="this.value=this.value.toUpperCase();" style="color:#000;font-weight:bold;width:100%;background:#f0f9fc;border-radius:5px 5px 5px 5px;" autocomplete="off" placeholder="Ingrese Motivo de no firmar el Paciente"><?php echo $reg[0]["nofirmapaciente"]; ?></textarea>     
      </div>
    </div>   
  </div> 

        <div class="text-right">
<button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><i data-feather="edit-2"></i> Actualizar</button>
<button class="btn btn-dark" type="reset"><i data-feather="x-circle"></i> Cancelar</button>
        </div>

    <?php } else { ?> 


        <hr><h5 class="card-subtitle text-dark alert-link"><i data-feather="home"></i> Detalle de Búsqueda</h5><hr>

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

        <?php
        $acceso = [
          "CONSULTORIO" => 1,
          "GINECOLOGIA" => 2,
          "LABORATORIO" => 3,
          "RADIOLOGIA" => 4,
          "TERAPEUTA" => 5,
          "ODONTOLOGIA" => 6
        ];

        ?>

        <div class="row">
            <div class="col-md-4"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">Seleccione Tipo Consentimiento: <span class="symbol required"></span></label>
                    <select style="color:#000;font-weight:bold;" name="tipoconsentimiento" id="tipoconsentimiento" class="form-control" required="" aria-required="true">
                    <option value=""> -- SELECCIONE -- </option>
                    <?php
                    $new = new Login();
                    $modulo = $new->MedicosPorId();
                    $explode_modulos = explode(",", $modulo[0]['modulos']);
                    foreach ($acceso as $nombre => $tipo):
                    if (in_array($tipo, $explode_modulos)) {
                    ?>
                    <option value="<?php echo encrypt($tipo); ?>"><?php echo $nombre; ?></option>
                    <?php
                    }
                    endforeach;
                    ?>
                    </select>
                </div> 
            </div>

            <div class="col-md-8"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">Búsqueda de Paciente: <span class="symbol required"></span></label>
                    <input type="hidden" name="codpaciente" id="codpaciente"/> 
                    <input type="hidden" name="proceso" id="proceso" value="save"/>
                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="search_paciente" id="search_paciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Criterio para la Búsqueda de Paciente" autocomplete="off" required="required"/>
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
                    <select style="color:#000;font-weight:bold;" name="codmedico" id="codmedico" onChange="CargaModulosxMedicos(this.form.codsucursal.value,this.form.codmedico.value);" class="form-control" required="" aria-required="true">
                        <option value=""> -- SIN RESULTADOS -- </option>
                    </select>
                </div> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">Seleccione Tipo Consentimiento: <span class="symbol required"></span></label>
                    <select style="color:#000;font-weight:bold;" name="tipoconsentimiento" id="tipoconsentimiento" class="form-control" required="" aria-required="true">
                            <option value=""> -- SIN RESULTADOS -- </option>
                    </select>
                </div> 
            </div>

            <div class="col-md-8"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">Búsqueda de Paciente: <span class="symbol required"></span></label>
                    <input type="hidden" name="codpaciente" id="codpaciente"/> 
                    <input type="hidden" name="proceso" id="proceso" value="save"/>
                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="search_paciente" id="search_paciente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Criterio para la Búsqueda de Paciente" autocomplete="off" required="required"/>
                </div> 
            </div>
        </div>

        <?php } ?>

                        <div class="text-right">
        <button type="button" onClick="ProcesarConsentimiento()" class="btn btn-primary"><i data-feather="search"></i> Realizar Búsqueda</button>
                        </div>

        <div id="muestra_detalles"></div>

    <?php } ?>

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
    
    <script src="plugins/font-icons/feather/feather.min.js"></script>
    <script type="text/javascript">
        feather.replace();
    </script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- Sweet-Alert -->
    <script src="assets/js/sweetalert-dev.js"></script>
    <!-- Sweet-Alert -->  
    
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