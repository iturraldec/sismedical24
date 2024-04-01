<?php
include('class.consultas.php');

if (isset($_GET['Busqueda_Cie10'])):

$filtro = $_GET["term"];
$Json = new Json;
$cie10 = $Json->BuscaCie10($filtro);
echo json_encode($cie10);

endif;

if (isset($_GET['Busqueda_Pacientes'])):

$filtro = $_GET["term"];
$Json = new Json;
$paciente = $Json->BuscaPacientes($filtro);
echo json_encode($paciente);

endif;

if (isset($_GET['Busqueda_Medicos'])):

$filtro = $_GET["term"];
$Json = new Json;
$medico = $Json->BuscaMedicos($filtro);
echo json_encode($medico);

endif;

?>  