<?php
require_once("class/class.php");
?>
<script src="assets/script/jscalendario.js"></script>
<script src="assets/script/autocompleto.js"></script>

<?php
$new = new Login();
?>


<?php 
######################## BUSCA PROVINCIA POR DEPARTAMENTOS ########################
if (isset($_GET['BuscaCantones']) && isset($_GET['idprovincia'])) {
  
  $canton = $new->ListarCantonesxProvincia();

  $idprovincia = limpiar($_GET['idprovincia']);

  if($idprovincia=="") { ?>

  <option value="">-- SIN RESULTADOS --</option>
  <?php } else { ?>
  <option value=""> -- SELECCIONE -- </option>
  <?php
  for($i=0;$i<sizeof($canton);$i++){
  ?>
  <option value="<?php echo $canton[$i]['idcanton']; ?>" ><?php echo $canton[$i]['canton']; ?></option>
<?php 
    }
  }
}
######################## BUSCA PROVINCIA POR DEPARTAMENTOS ########################
?>

<?php 
######################## SELECCIONE PROVINCIA POR DEPARTAMENTOS ########################
if (isset($_GET['SeleccionaCantones']) && isset($_GET['idprovincia']) && isset($_GET['idcanton'])) {
  
  $canton = $new->SeleccionaCantones();
  ?>
  <option value="">SELECCIONE</option>
  <?php for($i=0;$i<sizeof($canton);$i++){ ?>
  <option value="<?php echo $canton[$i]['idcanton']; ?>"<?php if (!(strcmp($_GET['idcanton'], htmlentities($canton[$i]['idcanton'])))) {echo "selected=\"selected\"";} ?>><?php echo $canton[$i]['canton']; ?></option>
<?php
  } 
}
######################## SELECCIONE PROVINCIA POR DEPARTAMENTOS ########################
?>



<?php 
######################## BUSCA PROVINCIA POR DISTRITO ########################
if (isset($_GET['BuscaParroquias']) && isset($_GET['idcanton'])) {
  
  $parroquia = $new->ListarParroquiasxCanton();

  $idcanton = limpiar($_GET['idcanton']);

  if($idcanton=="") { ?>

  <option value="">-- SIN RESULTADOS --</option>
  <?php } else { ?>
  <option value=""> -- SELECCIONE -- </option>
  <?php
  for($i=0;$i<sizeof($parroquia);$i++){
  ?>
  <option value="<?php echo $parroquia[$i]['idparroquia']; ?>" ><?php echo $parroquia[$i]['parroquia']; ?></option>
<?php 
    }
  }
}
######################## BUSCA PROVINCIA POR DISTRITO ########################
?>

<?php 
######################## SELECCIONE PROVINCIA POR DISTRITO ########################
if (isset($_GET['SeleccionaParroquia']) && isset($_GET['idcanton']) && isset($_GET['idparroquia'])) {
  
  $parroquia = $new->SeleccionaParroquias();
  ?>
  <option value="">SELECCIONE</option>
  <?php for($i=0;$i<sizeof($parroquia);$i++){ ?>
  <option value="<?php echo $parroquia[$i]['idparroquia']; ?>"<?php if (!(strcmp($_GET['idparroquia'], htmlentities($parroquia[$i]['idparroquia'])))) {echo "selected=\"selected\"";} ?>><?php echo $parroquia[$i]['parroquia']; ?></option>
<?php
  } 
}
######################## SELECCIONE PROVINCIA POR DISTRITO ########################
?>

<script src="assets/js/scrollspyNav.js"></script>
<script src="plugins/font-icons/feather/feather.min.js"></script>
<script type="text/javascript">
  feather.replace();
</script>