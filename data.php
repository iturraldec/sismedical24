<?php
require_once("class/class.php");

header('Content-Type: application/json');

################ GRAFICO POR SUCURSALES ########################
if (isset($_GET['ProcesosxSucursales'])):

$grafico = new Login();
$reg = $grafico->GraficoxSucursal();

$data = array();
if (is_array($reg)) {
	foreach ($reg as $row) {
		$data[] = $row;
	}
}

echo json_encode($data);

endif;
################ GRAFICO POR SUCURSALES ########################

################ GRAFICO DE CITAS EN GINECOLOGIA ########################
if (isset($_GET['CitasGinecologia'])):

$gin = new Login();
$u = $gin->GraficosGinecologia();

$data = array();
if (is_array($u)) {
	foreach ($u as $row) {
		$data[] = $row;
	}
}

echo json_encode($data);

endif;
################ GRAFICO DE CITAS EN GINECOLOGIA ########################

################ GRAFICO DE CITAS EN RADIOLOGIA ########################
if (isset($_GET['CitasRadiologia'])):

$sexo = new Login();
$s = $sexo->GraficosRadiologia();

$data = array();
if (is_array($s)) {
	foreach ($s as $row) {
	$data[] = $row;
	}
}

echo json_encode($data);

endif;
################ GRAFICO DE CITAS EN RADIOLOGIA ########################

################ GRAFICO DE CITAS EN SEXO ########################
if (isset($_GET['CitasSexo'])):

$rad = new Login();
$p = $rad->GraficosSexo();

$data = array();
if (is_array($p)) {
	foreach ($p as $row) {
	$data[] = $row;
	}
}

echo json_encode($data);

endif;
################ GRAFICO DE CITAS EN SEXO ########################
?>