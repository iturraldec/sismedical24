<?php
//Declaras el arreglo donde meteras las fechas
/*$arr = array();

//Haces un for de 24 horas
for($i=6;$i<18;){
    //Declaras una sintaxis que la fecha iniciará de media noche más lo que tenga $i en esta vuelta
    $x = "midnight +" . $i . " hour";
    //Lo mismo que $x pero $i más 1 hora de más
    $y = "midnight +" . ($i + 1) . " hour";
    
    //Paraeas las sintaxis a un formato de hora
    $z = date('H:i', strtotime($x)) . ' - ' . date('H:i', strtotime($y));

    //Añades el parsing a tu arreglo
    array_push($arr, $z);

    //Incrementas de 2 en 2,
    $i+=2;
}*/

//print_r($arr);
$separar = (explode(" ",$fecha));
$fecha = $separar[0];
$hora = $separar[1];

$fecha = preg_split("/[\s-]/", $fechaMysql);
$ano = $fecha[0];
$mes = $fecha[1];
$dia = $fecha[2];
$hora = $fecha[3];
?>



<?php
$arr = array();
for($i=6;$i<18;){
    //Declaras una sintaxis que la fecha iniciará de media noche más lo que tenga $i en esta vuelta
    $x = "midnight +" . $i . " hour";
    //Lo mismo que $x pero $i más 1 hora de más
    $y = "midnight +" . ($i) . " hour". (+20) . " minute";
    
    //Paraeas las sintaxis a un formato de hora
    $z = date('H:i', strtotime($x)) . ' - ' . date('H:i', strtotime($y));
    //$z = date('H:i', strtotime($y));

    //Añades el parsing a tu arreglo
    array_push($arr, $z);

    //Incrementas de 2 en 2,
    $i+=1;
}

//print_r($arr);
?>

<div id="div1"><table id="html5-extension" class="table" style="width:100%">
  <thead>
    <tr>
      <th>N°</th>
      <th>Hora</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($arr as $hor): ?>
        <tr>
          <td></td>
          <td class="text-dark alert-link"><?php echo $hor; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table></div>