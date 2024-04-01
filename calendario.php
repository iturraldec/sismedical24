<?php
require_once("class/class.php"); 
?> 

<?php if (isset($_GET['Calendario_Principal'])): ?>

<?php
$tra = new Login();
$events = $tra->BuscarCitasMedicas();
?>    
               
<div id="calendar"></div>

<script>
$(document).ready(function() {

    var date = new Date();
    var yyyy = date.getFullYear().toString();
    var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
    var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
    
    $('#calendar').fullCalendar({
        header: {
            language: 'es',
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay',
        },
        defaultDate: yyyy+"-"+mm+"-"+dd,
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        selectHelper: true,
        <?php if ($_SESSION['acceso'] != "administradorG"){ ?>
        select: function(start) {
            
        },
        eventRender: function(event, element) {
            element.bind('dblclick', function() {
                $("#ModalAdd #sucursal").text(event.sucursal);
                $('#ModalAdd #nompaciente').text(event.paciente);
                $("#ModalAdd #nomespecialista").text(event.especialista);
                $('#ModalAdd #movitocita').text(event.descripcion);
                $('#ModalAdd #fechacita').text(moment(event.start).format('DD-MM-YYYY'));
                $('#ModalAdd #horacita').text(event.hora);
                $('#ModalAdd #descripcion').val(event.descripcion);
                $('#ModalAdd #color').val(event.color);
                $('#ModalAdd').modal('show');
            });
        },<?php } ?>
        events: [
        <?php if($events==""){ echo ""; } else {  

                foreach($events as $event): 
        ?>
            {
                sucursal: '<?php echo $event['nomsucursal']; ?>',
                paciente: '<?php echo $event['pacientes']; ?>',
                especialista: '<?php echo $event['cedespecialista']." ".$event['nomespecialista']; ?>',
                descripcion: '<?php echo $event['descripcion']; ?>',
                start: '<?php echo $event['fechacita']; ?>',
                hora: '<?php echo date("H:i",strtotime($event['fechacita'])); ?>',
                title: '<?php echo $event['nompaciente']; ?>',
                color: '<?php echo $event['color']; ?>',
            },
        <?php endforeach; } ?>
        ]
    });  
});
</script>

<?php endif; ?> 






<?php if (isset($_GET['Calendario_Secundario']) && isset($_GET['codsucursal']) && isset($_GET['codespecialidad']) && isset($_GET['codmedico'])): 

  $codsucursal = limpiar($_GET['codsucursal']);
  $codespecialidad = limpiar($_GET['codespecialidad']);
  $codmedico = limpiar($_GET['codmedico']);

  if($codsucursal=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE SUCURSAL PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($codespecialidad=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE ESPECIALIDAD PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
  } else if($codmedico=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-alert-triangle'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12.01' y2='17'></line></svg> POR FAVOR SELECCIONE MEDICO PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;

 } else {

$horario = new Login();
$horario = $horario->BuscarHorarioxMedico(); 

$events = new Login();
$events = $events->BuscarCitasMedicas(); 
?>      

    <div class="row">
        <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
            <div class="statbox widget box box-shadow">

    <div class="widget-content widget-content-area" style="background: #ecf1f3;">                                

            <table id="html5-extension" class="table" style="width:100%">
                <thead>
                <tr>
                    <th>N°</th>
                    <th>Dias Laborables</th>
                    <th>Hora Desde</th>
                    <th>Hora Hasta</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                if($horario==""){
                    echo "";  
                } else {
                $a=1;
                for($i=0;$i<sizeof($horario);$i++){  
                ?>
                <tr>
                    <td><?php echo $a++; ?></td>
                    <td class="text-dark alert-link"><?php echo Dias($horario[$i]['dias_laborales']); ?></td>
                    <td><?php echo $horario[$i]['hora_desde']; ?></td>
                    <td><?php echo $horario[$i]['hora_hasta']; ?></td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>

                </div>
            </div>
        </div>
    </div>                  

<div id="calendar"></div>

<script>
$(document).ready(function() {

    var date = new Date();
    var yyyy = date.getFullYear().toString();
    var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
    var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
    
    $('#calendar').fullCalendar({
        header: {
            language: 'es',
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay',
        },
        defaultDate: yyyy+"-"+mm+"-"+dd,

        <?php if ($_SESSION['acceso'] == "paciente"){ ?>
        editable: false,
        <?php } else { ?> 
        editable: true,	
        <?php } ?>
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        selectHelper: true,
        select: function(start) {
            
            $('#ModalAdd #fechacita').val(moment(start).format('DD-MM-YYYY'));
            $('#ModalAdd #sucursal').val('<?php echo $codsucursal; ?>');
            $('#ModalAdd #medico').val('<?php echo $codmedico; ?>');
            $('#ModalAdd #especialidad').val('<?php echo $codespecialidad; ?>');
            $('#ModalAdd').modal('show');
        },
        editable: true,
        eventLimit: true,
        eventMouseover: function(event, jsEvent, view) {
            $(this).attr('codcita', event.codcita);

            $('#'+event.codcita).popover({
                template: '<div class="popover popover-primary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3>SSSSS<div class="popover-body"></div></div>',
                title: event.title,
                content: event.description,
                placement: 'top',
            });

            $('#'+event.codcita).popover('show');
        },
        eventMouseout: function(event, jsEvent, view) {
            $('#'+event.codcita).popover('hide');
        },
        eventRender: function(event, element) {
            element.bind('dblclick', function() {
                $('#ModalAdd #proceso').val("update");
                $('#ModalAdd #delete').val(event.idelim);
                $('#ModalAdd #cancelar').val(event.idcanc);
                $('#ModalAdd #codcita').val(event.codcita);
                $("#ModalAdd #sucursal").val(event.codsucursal);
                $("#ModalAdd #medico").val(event.codmedico);
                $("#ModalAdd #especialidad").val(event.codespecialidad);
                $("#ModalAdd #codpaciente").val(event.codpaciente);
                $('#ModalAdd #search_paciente').val(event.valor);
                $('#ModalAdd #descripcion').val(event.descripcion);
                $('#ModalAdd #color').val(event.color);
                $('#ModalAdd #fechacita').val(moment(event.start).format('DD-MM-YYYY'));
                $('#ModalAdd #horacita').val(event.hora);
                (event.status == 1 ? $("#btn-submit").attr('disabled', true) : $("#btn-submit").attr('disabled', false));
                (event.status == 1 ? $("#deletevento").attr('disabled', true) : $("#deletevento").attr('disabled', false));
                (event.status == 1 ? $("#cancelaevento").attr('disabled', true) : $("#cancelaevento").attr('disabled', false));
                $('#ModalAdd').modal('show');
            });
        },
        eventDrop: function(event, delta, revertFunc) { // si changement de position

            edit(event);
        },
        eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

            edit(event);
        },
        events: [
        <?php if($events==""){ echo ""; } else {  

                foreach($events as $event): 
        ?>
            {
                idelim: '<?php echo encrypt($event['codcita']); ?>',
                idcanc: '<?php echo encrypt($event['codcita']); ?>',
                codcita: '<?php echo encrypt($event['codcita']); ?>',
                codsucursal: '<?php echo encrypt($event['codsucursal']); ?>',
                codmedico: '<?php echo encrypt($event['codmedico']); ?>',
                codespecialidad: '<?php echo encrypt($event['codespecialidad']); ?>',
                codpaciente: '<?php echo $event['codpaciente']; ?>',
                valor: '<?php echo $event['pacientes']; ?>',
                title: '<?php echo $event['horacita']; ?> | <?php echo $event['nompaciente']; ?>',
                descripcion: '<?php echo $event['descripcion']; ?>',
                status: '<?php echo $event['statuscita']; ?>',
                start: '<?php echo $event['fechacita']; ?>',
                hora: '<?php echo $event['horacita']; ?>',
                color: '<?php echo $event['color']; ?>',
            },
        <?php endforeach; } ?>
        ]
    }); 
    
    function edit(event){
        start = event.start.format('YYYY-MM-DD HH:mm:ss');
        hora =  event.hora
        codcita =  event.codcita;
        codsucursal =  event.codsucursal;
        codespecialidad =  event.codespecialidad;
        codmedico =  event.codmedico;
        Event = [];
        Event[0] = codcita;
        Event[1] = start;
        Event[2] = hora;
        Event[3] = "editdate";
        Event[4] = codsucursal;
        Event[5] = codespecialidad;
        Event[6] = codmedico;
        
        $.ajax({
         url: 'forcita.php',
         type: "POST",
         data: {Event:Event},
         success: function(response) {
                if(response==1){
                                    
                    swal("Error!", "No se pudo Actualizar esta Cita Médica. Inténtelo de nuevo!", "error");
                    $('#muestra_calendario').html("");
                    $('#muestra_calendario').append('<center><i class="fa fa-spin fa-spinner"></i> Por Favor Espere, Cargando Calendario ......</center>').fadeIn("slow");
                    setTimeout(function() {
                        $("#muestra_calendario").load("calendario?Calendario_Secundario=si&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico);
                    }, 100);

                } else if(response==2){
                                    
                    swal("Oops", "Este Dia no se encuentra asignado a este Medico para Citas, verifique por favor!", "error");
                    $('#muestra_calendario').html("");
                    $('#muestra_calendario').append('<center><i class="fa fa-spin fa-spinner"></i> Por Favor Espere, Cargando Calendario ......</center>').fadeIn("slow");
                    setTimeout(function() {
                        $("#muestra_calendario").load("calendario?Calendario_Secundario=si&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico);
                    }, 100);                

                } else if(response==3){
                                    
                    swal("Oops", "Esta Cita Médica no puede ser Actualizada a una Fecha Anterior, verifique por favor!", "error");
                    $('#muestra_calendario').html("");
                    $('#muestra_calendario').append('<center><i class="fa fa-spin fa-spinner"></i> Por Favor Espere, Cargando Calendario ......</center>').fadeIn("slow");
                    setTimeout(function() {
                        $("#muestra_calendario").load("calendario?Calendario_Secundario=si&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico);
                    }, 100);                

                } else if(response==4){
                                    
                    swal("Oops", "Esta Cita Médica no puede ser Actualizada a una Hora Anterior, verifique por favor!", "error");
                    $('#muestra_calendario').html("");
                    $('#muestra_calendario').append('<center><i class="fa fa-spin fa-spinner"></i> Por Favor Espere, Cargando Calendario ......</center>').fadeIn("slow");
                    setTimeout(function() {
                        $("#muestra_calendario").load("calendario?Calendario_Secundario=si&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico);
                    }, 100);                

                } else {

                    swal("Exitoso!", "La Fecha de Cita Médica ha sido Actualizada con éxito!", "success");               

                }
            }
        });
    }     
});
</script>

<?php } endif;  ?>