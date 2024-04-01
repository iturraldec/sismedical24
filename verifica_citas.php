<?php
require_once("class/class.php");

######################## VERIFICA CITAS VENCIDAS #################################
if (isset($_GET['Verifica_Citas_Vencidas'])) {
  
$citas = new Login();
$citas = $citas->VerificaCitasVencidas();

}
######################## VERIFICA CITAS VENCIDAS #################################
?>