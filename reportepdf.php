<?php
include_once('fpdf/pdf.php');
require_once("class/class.php");
//ob_end_clean();
ob_start();

$casos = array (

                  'USUARIOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarUsuarios',

                                    'output' => array('Listado General de Usuarios.pdf', 'I')

                                  ),

                  'LOGS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarLogs',

                                    'output' => array('Listado General Logs de Acceso.pdf', 'I')

                                  ),

                  'DOCUMENTOS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarDocumentos',

                                    'output' => array('Listado General de Tipos de Documentos.pdf', 'I')

                                  ),

                  'SEGUROS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarSeguros',

                                    'output' => array('Listado General de Seguros.pdf', 'I')

                                  ),

                  'ESPECIALIDADES' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarEspecialidades',

                                    'output' => array('Listado General de Especialidades.pdf', 'I')

                                  ),

                  'DEPARTAMENTOS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarDepartamentos',

                                    'output' => array('Listado General de Departamentos.pdf', 'I')

                                  ),

                  'PROVINCIAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarProvincias',

                                    'output' => array('Listado General de Provincias.pdf', 'I')

                                  ),


                  'SUCURSALES' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarSucursales',

                                    'output' => array('Listado General de Sucursales.pdf', 'I')

                                  ),

                  'PLANTILLASECOGRAFICAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarPlantillasEcograficas',

                                    'output' => array('Listado General de Plantillas Ecograficas.pdf', 'I')

                                  ),

                  'PLANTILLASLECTURARX' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarPlantillasLecturaRx',

                                    'output' => array('Listado General de Plantillas Lectura Rx.pdf', 'I')

                                  ),
                  
                  'MEDICOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarMedicos',

                                    'output' => array('Listado General de Medicos.pdf', 'I')

                                  ),
                  
                  'MEDICOSXSUCURSAL' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarMedicosxSucursal',

                                    'output' => array('Listado General de Medicos por Sucursal.pdf', 'I')

                                  ),
                  
                  'HORARIOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarHorarios',

                                    'output' => array('Listado General de Horarios.pdf', 'I')

                                  ),

                  'PACIENTES' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarPacientes',

                                    'output' => array('Listado General de Pacientes.pdf', 'I')

                                  ),

                  'CITASMEDICAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarCitasMedicas',

                                    'output' => array('Listado General de Citas Medicas.pdf', 'I')

                                  ),

                  'CITASXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarCitasMedicasxFechas',

                                    'output' => array('Listado General de Citas Medicas por Fechas.pdf', 'I')

                                  ),

                  'CITASXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarCitasMedicasxMedicos',

                                    'output' => array('Listado General de Citas Medicas por Médico.pdf', 'I')

                                  ),

                  'CITASXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarCitasMedicasxPacientes',

                                    'output' => array('Listado General de Citas Medicas por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_APERTURA' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaApertura',

                                    'output' => array('Apertura de Historia.pdf', 'I')

                                  ),

                  'APERTURAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarAperturas',

                                    'output' => array('Listado de Aperturas de Historia.pdf', 'I')

                                  ),

                  'APERTURASXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarAperturasxFechas',

                                    'output' => array('Listado de Aperturas de Historia por Fechas.pdf', 'I')

                                  ),

                  'APERTURASXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarAperturasxMedico',

                                    'output' => array('Listado de Aperturas de Historia por Medico.pdf', 'I')

                                  ),

                  'APERTURASXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarAperturasxPaciente',

                                    'output' => array('Listado de Aperturas de Historia por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_HOJA' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaHojaEvolutiva',

                                    'output' => array('Hoja Evolutiva.pdf', 'I')

                                  ),

                  'HOJAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarHojasEvolutivas',

                                    'output' => array('Listado de Hojas Evolutivas.pdf', 'I')

                                  ),

                  'HOJASXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarHojasEvolutivasxFechas',

                                    'output' => array('Listado de Hojas Evolutivas por Fechas.pdf', 'I')

                                  ),

                  'HOJASXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarHojasEvolutivasxMedico',

                                    'output' => array('Listado de Hojas Evolutivas por Medico.pdf', 'I')

                                  ),

                  'HOJASXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarHojasEvolutivasxPaciente',

                                    'output' => array('Listado de Hojas Evolutivas por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_REMISION' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaRemisiones',

                                    'output' => array('Remisiones.pdf', 'I')

                                  ),

                  'REMISIONES' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarRemisiones',

                                    'output' => array('Listado de Remisiones.pdf', 'I')

                                  ),

                  'REMISIONESXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarRemisionesxFechas',

                                    'output' => array('Listado de Remisiones por Fechas.pdf', 'I')

                                  ),

                  'REMISIONESXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarRemisionesxMedico',

                                    'output' => array('Listado de Remisiones por Medico.pdf', 'I')

                                  ),

                  'REMISIONESXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarRemisionesxPaciente',

                                    'output' => array('Listado de Remisiones por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_FORMULAMEDICA' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaFormulasMedicas',

                                    'output' => array('Fórmulas Médicas.pdf', 'I')

                                  ),

                  'FORMULASMEDICAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarFormulasMedicas',

                                    'output' => array('Listado de Fórmulas Médicas.pdf', 'I')

                                  ),

                  'FORMULASMEDICASXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarFormulasMedicasxFechas',

                                    'output' => array('Listado de Fórmulas Médicas por Fechas.pdf', 'I')

                                  ),

                  'FORMULASMEDICASXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarFormulasMedicasxMedico',

                                    'output' => array('Listado de Fórmulas Médicas por Medico.pdf', 'I')

                                  ),

                  'FORMULASMEDICASXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarFormulasMedicasxPaciente',

                                    'output' => array('Listado de Fórmulas Médicas por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_ORDENMEDICA' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaOrdenesMedicas',

                                    'output' => array('Órdenes Médicas.pdf', 'I')

                                  ),

                  'ORDENESMEDICAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarOrdenesMedicas',

                                    'output' => array('Listado de Órdenes Médicas.pdf', 'I')

                                  ),

                  'ORDENESMEDICASXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarOrdenesMedicasxFechas',

                                    'output' => array('Listado de Órdenes Médicas por Fechas.pdf', 'I')

                                  ),

                  'ORDENESMEDICASXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarOrdenesMedicasxMedico',

                                    'output' => array('Listado de Órdenes Médicas por Medico.pdf', 'I')

                                  ),

                  'ORDENESMEDICASXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarOrdenesMedicasxPaciente',

                                    'output' => array('Listado de Órdenes Médicas por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_CRIOCAUTERIZACION' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaCriocauterizaciones',

                                    'output' => array('Criocauterizaciones.pdf', 'I')

                                  ),

                  'CRIOCAUTERIZACIONES' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarCriocauterizaciones',

                                    'output' => array('Listado de Criocauterizacion.pdf', 'I')

                                  ),

                  'CRIOCAUTERIZACIONESXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarCriocauterizacionesxFechas',

                                    'output' => array('Listado de Criocauterizacion por Fechas.pdf', 'I')

                                  ),

                  'CRIOCAUTERIZACIONESXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarCriocauterizacionesxMedico',

                                    'output' => array('Listado de Criocauterizacion por Medico.pdf', 'I')

                                  ),

                  'CRIOCAUTERIZACIONESXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarCriocauterizacionesxPaciente',

                                    'output' => array('Listado de Criocauterizacion por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_FORMULATERAPIA' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaFormulasTerapias',

                                    'output' => array('Fórmulas de Terapias.pdf', 'I')

                                  ),

                  'FORMULASTERAPIAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarFormulasTerapias',

                                    'output' => array('Listado de Fórmulas Terapias.pdf', 'I')

                                  ),

                  'FORMULASTERAPIASXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarFormulasTerapiasxFechas',

                                    'output' => array('Listado de Fórmulas Terapias por Fechas.pdf', 'I')

                                  ),

                  'FORMULASTERAPIASXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarFormulasTerapiasxMedico',

                                    'output' => array('Listado de Fórmulas Terapias por Medico.pdf', 'I')

                                  ),

                  'FORMULASTERAPIASXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarFormulasTerapiasxPaciente',

                                    'output' => array('Listado de Fórmulas Terapias por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_SOLICITUDEXAMEN' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaSolicitudExamenes',

                                    'output' => array('Solicitud de Examenes.pdf', 'I')

                                  ),

                  'SOLICITUDEXAMENES' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarSolicitudExamenes',

                                    'output' => array('Listado de Solicitud Examenes.pdf', 'I')

                                  ),

                  'SOLICITUDEXAMENESXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarSolicitudExamenesxFechas',

                                    'output' => array('Listado de Solicitud Examenes por Fechas.pdf', 'I')

                                  ),

                  'SOLICITUDEXAMENESXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarSolicitudExamenesxMedico',

                                    'output' => array('Listado de Solicitud Examenes por Medico.pdf', 'I')

                                  ),

                  'SOLICITUDEXAMENESXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarSolicitudExamenesxPaciente',

                                    'output' => array('Listado de Solicitud Examenes por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_COLPOSCOPIA' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaColposcopia',

                                    'output' => array('Colposcopia.pdf', 'I')

                                  ),

                  'COLPOSCOPIAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarColposcopias',

                                    'output' => array('Listado de Colposcopias.pdf', 'I')

                                  ),

                  'COLPOSCOPIASXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarColposcopiasxFechas',

                                    'output' => array('Listado de Colposcopias por Fechas.pdf', 'I')

                                  ),

                  'COLPOSCOPIASXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarColposcopiasxMedico',

                                    'output' => array('Listado de Colposcopias por Medico.pdf', 'I')

                                  ),

                  'COLPOSCOPIASXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarColposcopiasxPaciente',

                                    'output' => array('Listado de Colposcopias por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_ECOGRAFIA' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaEcografia',

                                    'output' => array('Ecografía.pdf', 'I')

                                  ),

                  'ECOGRAFIAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarEcografias',

                                    'output' => array('Listado de Ecografias.pdf', 'I')

                                  ),

                  'ECOGRAFIASXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarEcografiasxFechas',

                                    'output' => array('Listado de Ecografias por Fechas.pdf', 'I')

                                  ),

                  'ECOGRAFIASXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarEcografiasxMedico',

                                    'output' => array('Listado de Ecografias por Medico.pdf', 'I')

                                  ),

                  'ECOGRAFIASXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarEcografiasxPaciente',

                                    'output' => array('Listado de Ecografias por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_LABORATORIO' => array(

                                    'medidas' => array('P','mm','LEGAL'),

                                    'func' => 'TablaLaboratorio',

                                    'output' => array('Resultado de Laboratorio.pdf', 'I')

                                  ),

                  'LABORATORIOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarLaboratorios',

                                    'output' => array('Listado de Examenes de Laboratorios.pdf', 'I')

                                  ),

                  'LABORATORIOSXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarLaboratoriosxFechas',

                                    'output' => array('Listado de Examenes de Laboratorios por Fechas.pdf', 'I')

                                  ),

                  'LABORATORIOSXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarLaboratoriosxMedico',

                                    'output' => array('Listado de Examenes de Laboratorios por Medico.pdf', 'I')

                                  ),

                  'LABORATORIOSXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarLaboratoriosxPaciente',

                                    'output' => array('Listado de Examenes de Laboratorios por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_RADIOLOGIA' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaRadiologia',

                                    'output' => array('Lectura Rx.pdf', 'I')

                                  ),

                  'RADIOLOGIAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarRadiologias',

                                    'output' => array('Listado de Radiologias.pdf', 'I')

                                  ),

                  'RADIOLOGIASXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarRadiologiasxFechas',

                                    'output' => array('Listado de Radiologias por Fechas.pdf', 'I')

                                  ),

                  'RADIOLOGIASXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarRadiologiasxMedico',

                                    'output' => array('Listado de Radiologias por Medico.pdf', 'I')

                                  ),

                  'RADIOLOGIASXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarRadiologiasxPaciente',

                                    'output' => array('Listado de Radiologias por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_TERAPIA' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaTerapia',

                                    'output' => array('Terapias.pdf', 'I')

                                  ),

                  'TERAPIAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarTerapias',

                                    'output' => array('Listado de Terapias.pdf', 'I')

                                  ),

                  'TERAPIASXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarTerapiasxFechas',

                                    'output' => array('Listado de Terapias por Fechas.pdf', 'I')

                                  ),

                  'TERAPIASXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarTerapiasxMedico',

                                    'output' => array('Listado de Terapias por Medico.pdf', 'I')

                                  ),

                  'TERAPIASXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarTerapiasxPaciente',

                                    'output' => array('Listado de Terapias por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_ODONTOLOGIA' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaOdontologia',

                                    'output' => array('Ficha Odontologica.pdf', 'I')

                                  ),

                  'ODONTOLOGIAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarOdontologias',

                                    'output' => array('Listado de Odontologias.pdf', 'I')

                                  ),

                  'ODONTOLOGIASXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarOdontologiasxFechas',

                                    'output' => array('Listado de Odontologias por Fechas.pdf', 'I')

                                  ),

                  'ODONTOLOGIASXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarOdontologiasxMedico',

                                    'output' => array('Listado de Odontologias por Medico.pdf', 'I')

                                  ),

                  'ODONTOLOGIASXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarOdontologiasxPaciente',

                                    'output' => array('Listado de Odontologias por Paciente.pdf', 'I')

                                  ),

                  'CONSTANCIA_CONSENTIMIENTO' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaConsentimientoInformado',

                                    'output' => array('Consentimiento Informado.pdf', 'I')

                                  ),

                  'CONSENTIMIENTOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarConsentimientos',

                                    'output' => array('Listado de Consentimientos Informados.pdf', 'I')

                                  ),

                  'CONSENTIMIENTOSXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarConsentimientosxFechas',

                                    'output' => array('Listado de Consentimientos por Fechas.pdf', 'I')

                                  ),

                  'CONSENTIMIENTOSXMEDICO' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarConsentimientosxMedico',

                                    'output' => array('Listado de Consentimientos por Medico.pdf', 'I')

                                  ),

                  'CONSENTIMIENTOSXPACIENTE' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarConsentimientosxPaciente',

                                    'output' => array('Listado de Consentimientos por Paciente.pdf', 'I')

                                  ),
                    );

 
$tipo = decrypt($_GET['tipo']);
if ($tipo == 'TICKET') {

  $caso_data = $casos[$tipo];
  $pdf = new PDF($caso_data['medidas'][0], $caso_data['medidas'][1], $caso_data['medidas'][2]);
  $pdf->AddPage();
  $pdf->SetAuthor("Ing. Christian Gonzales");
  $pdf->SetCreator("FPDF Y PHP");
  $pdf->{$caso_data['func']}();
  //$pdf->AutoPrint(false);
  $pdf->Output($caso_data['output'][0], $caso_data['output'][1]);
  ob_end_flush();

} else {
  $caso_data = $casos[$tipo];
  $pdf = new PDF($caso_data['medidas'][0], $caso_data['medidas'][1], $caso_data['medidas'][2]);
  $pdf->AddPage();
  $pdf->SetAuthor("Ing. Christian Gonzales");
  $pdf->SetCreator("FPDF Y PHP");
  $pdf->{$caso_data['func']}();

  // archivo pdf
  $pdf_file = './assets/pdf/'.$caso_data['output'][0];
  $pdf->Output('F', $pdf_file);
  ob_end_flush();

  //
  $contenido_pdf = file_get_contents($pdf_file);
  $pdf_base64 = base64_encode($contenido_pdf);

  // Imprimir el resultado
  echo $pdf_base64;
}
?>