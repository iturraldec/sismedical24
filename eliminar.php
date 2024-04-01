<?php
require_once("class/class.php");
$tra = new Login();
$tipo = decrypt($_GET['tipo']);
switch($tipo)
{
case 'USUARIOS':
$tra->EliminarUsuarios();
exit;
break;

case 'PROVINCIAS':
$tra->EliminarProvincias();
exit;
break;

case 'CIUDADES':
$tra->EliminarCiudades();
exit;
break;

case 'DOCUMENTOS':
$tra->EliminarDocumentos();
exit;
break;

case 'SEGUROS':
$tra->EliminarSeguros();
exit;
break;

case 'ESPECIALIDADES':
$tra->EliminarEspecialidades();
exit;
break;

case 'SUCURSALES':
$tra->EliminarSucursales();
exit;
break;

case 'PLANTILLASECOGRAFICAS':
$tra->EliminarPlantillasEcograficas();
exit;
break;

case 'PLANTILLASLECTURASRX':
$tra->EliminarPlantillasLecturaRx();
exit;
break;

case 'MEDICOS':
$tra->EliminarMedicos();
exit;
break;

case 'REINICIARMEDICOS':
$tra->ReiniciarClaveMedicos();
exit;
break;

case 'HORARIOS':
$tra->EliminarHorarios();
exit;
break;

case 'VERIFICAPACIENTE':
$tra->DocumentoPaciente();
exit;
break;

case 'PACIENTES':
$tra->EliminarPacientes();
exit;
break;

case 'CANCELARCITA':
$tra->CancelarCitas();
exit;
break;

case 'CITAS':
$tra->EliminarCitas();
exit;
break;

case 'APERTURAS':
$tra->EliminarAperturas();
exit;
break;

case 'HOJAS':
$tra->EliminarHojasEvolutivas();
exit;
break;

case 'FORMULASMEDICAS':
$tra->EliminarFormulasMedicas();
exit;
break;

case 'ORDENESMEDICAS':
$tra->EliminarOrdenesMedicas();
exit;
break;

case 'REMISIONES':
$tra->EliminarRemisiones();
exit;
break;

case 'FORMULASTERAPIAS':
$tra->EliminarFormulasTerapias();
exit;
break;

case 'SOLICITUDEXAMENES':
$tra->EliminarSolicitudExamenes();
exit;
break;

case 'CRIOCAUTERIZACIONES':
$tra->EliminarCriocauterizaciones();
exit;
break;

case 'COLPOSCOPIAS':
$tra->EliminarColposcopias();
exit;
break;

case 'ECOGRAFIAS':
$tra->EliminarEcografias();
exit;
break;

case 'LABORATORIOS':
$tra->EliminarLaboratorios();
exit;
break;

case 'RADIOLOGIAS':
$tra->EliminarRadiologias();
exit;
break;

case 'CICLO_TERAPIAS':
$tra->EliminarCicloTerapias();
exit;
break;

case 'TERAPIAS':
$tra->EliminarTerapias();
exit;
break;

case 'REFERENCIA_ODONTOLOGIA':
$tra->EliminarReferenciasOdontologia();
exit;
break;

case 'ODONTOLOGIAS':
$tra->EliminarOdontologias();
exit;
break;

case 'CONSENTIMIENTOS':
$tra->EliminarConsentimientos();
exit;
break;

case 'EPICRISIS':
$tra->EliminarEpicrisis();
exit;
break;

case 'INTERCONSULTAS':
$tra->EliminarInterconsultas();
exit;
break;

case 'EMERGENCIAS':
$tra->EliminarEmergencias();
exit;
break;

case 'SOLICITUD_IMAGENOLOGIA':
$tra->EliminarSolicitudImagenologias();
exit;
break;

case 'INFORME_IMAGENOLOGIA':
$tra->EliminarInformeImagenologias();
exit;
break;

case 'PROTOCOLOS':
$tra->EliminarProtocolos();
exit;
break;

case 'PARTES':
$tra->EliminarPartes();
exit;
break;

case 'PRESCRIPCIONES':
$tra->EliminarPrescripciones();
exit;
break;

case 'VERIFICACIONES':
$tra->EliminarVerificaciones();
exit;
break;

}
?>