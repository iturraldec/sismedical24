//SELECCIONAR/DESELECCIONAR TODOS LOS CHECKBOX
$("#checkTodos").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
      //$("input[type='checkbox']:checked:enabled").prop('checked', $(this).prop("checked"));
  });

// FUNCION PARA LIMPIAR CHECKBOX ACTIVOS
function LimpiarCheckbox(){
$("input[type='checkbox']:checked:enabled").attr('checked',false); 
}

//BUSQUEDA EN CONSULTAS
$(document).ready(function () {
   (function($) {
       $('#FiltrarContenido').keyup(function () {
            var ValorBusqueda = new RegExp($(this).val(), 'i');
            $('.BusquedaRapida tr').hide();
             $('.BusquedaRapida tr').filter(function () {
                return ValorBusqueda.test($(this).text());
              }).show();
                })
      }(jQuery));
});

//FUNCIONES PARA ACTIVAR-DESACTIVAR CAMPO
function Embarazada(){

    var valor = $("#embarazada").val();

    if (valor === "SI" || valor === true) {
         
      $("#fechamestruacion").attr('disabled', false);
      $('#calcular').attr('disabled', false);

    } else {

      // deshabilitamos
      $("#fechamestruacion").attr('disabled', true);
      $('#calcular').attr('disabled', true);
      $('#fechamestruacion').val('');
  }
}

////FUNCION OARA CALCULAR SEMANAS Y DIAS DE EMBARAZO
function CalcularEmbarazo(){
                 
var dia1 = $("#di").val();
var dia2 = $("#sem").val();
var data =$('#fechamestruacion').val();
            
    var arr = data.split('-');
    
    var day = parseInt(arr[0]);
    var month = parseInt(arr[1]);
    var year = parseInt(arr[2]);
    
    var cycle = parseInt(dia1);
    var luteal = parseInt(dia2);      
                   
    if(isNaN(day) && isNaN(month) && isNaN(year)){
        
      $("#fechamestruacion").focus();
      $("#fechamestruacion").css('border-color', '#0D89F1');
      alert("POR FAVOR INGRESE UNA FECHA VALIDA EN ULTIMA MESTRUACION");
      return false;

    } else {

      last_menstruation_day = new Date(month+'/'+day+'/'+year);
      
      ovulation = new Date();
      ovulation.setTime(last_menstruation_day.getTime() + (cycle*86400000) - (luteal*86400000));
      
      duedate = new Date();
      duedate.setTime(ovulation.getTime() + 266*86400000);
      
      today = new Date();
      var fetalage = 14 + 266 - ((duedate - today) / 86400000);
      var weeks = parseInt(fetalage / 7);
      var days = Math.floor(fetalage % 7);
      
      
      fechaparto = duedate.getDate()+'-'+(duedate.getMonth()+1)+'-'+duedate.getFullYear();
      fetalage = weeks + " semana" + (weeks > 1 ? "s" : "") + ", " + days + " dias";
        
      $('#fechaparto').val(fechaparto);
      $('#fechaparto2').val(fechaparto);
      $('#semanas').val(fetalage);
      $('#semanas2').val(fetalage);
  }
}

////FUNCION OARA CALCULAR SEMANAS Y DIAS DE EMBARAZO
function CalcularEmbarazo22222(){
                 
var dia1 = $("#di").val();
var dia2 = $("#sem").val();
var data =$('#fechamestruacion').val();
            
      var arr = data.split('-');
      
      var day = parseInt(arr[0]);
      var month = parseInt(arr[1]);
      var year = parseInt(arr[2]);
      
      var cycle = parseInt(dia1);
      var luteal = parseInt(dia2);      
                   
      if(isNaN(day) && isNaN(month) && isNaN(year))
      {
        $("#fechamestruacion").focus();
        $("#fechamestruacion").css('border-color', '#0D89F1');
        alert("POR FAVOR INGRESE UNA FECHA VALIDA EN ULTIMA MESTRUACION");
        return false;

         } else {

        last_menstruation_day = new Date(month+'/'+day+'/'+year);
        
        ovulation = new Date();
        ovulation.setTime(last_menstruation_day.getTime() + (cycle*86400000) - (luteal*86400000));
        
        duedate = new Date();
        duedate.setTime(ovulation.getTime() + 266*86400000);
        
        today = new Date();
        var fetalage = 14 + 266 - ((duedate - today) / 86400000);
        var weeks = parseInt(fetalage / 7);
        var days = Math.floor(fetalage % 7);
        
        
        fechaparto = duedate.getDate()+'-'+(duedate.getMonth()+1)+'-'+duedate.getFullYear();
        fetalage = weeks + " semana" + (weeks > 1 ? "s" : "") + ", " + days + " dias";
          
        $('#result2').html('<div class="col-md-3"><div class="form-group has-feedback"><label class="control-label">Fecha Probable de Parto: <span class="symbol required"></span></label><input type="text" name="fechaparto" id="fechaparto" class="form-control" value="'+fechaparto+'" readonly="readonly"/><i class="fa fa-calendar form-control-feedback"></i></div></div>');
        $('#result3').html('<div class="col-md-3"><div class="form-group has-feedback"><label class="control-label">Semanas de Gestaci&oacute;n: <span class="symbol required"></span></label><input type="text" name="semanas" id="semanas" class="form-control" value="'+fetalage+'" readonly="readonly"/><i class="fa fa-calendar form-control-feedback"></i></div></div>');
                
      }
      
  }


////FUNCION MUESTRA CAMPO PARA REMISION
function mostrar(){

  var botonAccion =  document.getElementById('boton');
  var div = document.getElementById('remision');

  if(div.style.display==='block'){

      div.style.display = "none";
      //Actualizamos el nombre del botón
      botonAccion.value = "SI";

  } else {

      div.style.display = "block";
      //Actualizamos el nombre del botón
      botonAccion.value= "NO";
  }
}






/////////////////////////////////// FUNCIONES DE USUARIOS //////////////////////////////////////

// FUNCION PARA MOSTRAR USUARIOS EN VENTANA MODAL
function VerUsuario(codigo){

$('#muestrausuariomodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaUsuarioModal=si&codigo='+codigo;

$.ajax({
            type: "GET",
                  url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestrausuariomodal').empty();
                $('#muestrausuariomodal').append(''+response+'').fadeIn("slow");
                
            }
      });
}

// FUNCION PARA ACTUALIZAR USUARIOS
function UpdateUsuario(codigo,documusuario,dni,nombres,sexo,telefono,celular,
idprovincia,direccion,email,mps,codespecialidad,fnacimiento,usuario,nivel,status,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#saveusuario #codigo").val(codigo);
  $("#saveusuario #documusuario").val(documusuario);
  $("#saveusuario #dni").val(dni);
  $("#saveusuario #nombres").val(nombres);
  $("#saveusuario #sexo").val(sexo);
  $("#saveusuario #telefono").val(telefono);
  $("#saveusuario #celular").val(celular);
  $("#saveusuario #idprovincia").val(idprovincia);
  $("#saveusuario #direccion").val(direccion);
  $("#saveusuario #email").val(email);
  $("#saveusuario #mps").val(mps);
  $("#saveusuario #codespecialidad").val(codespecialidad);
  $("#saveusuario #fnacimiento").val(fnacimiento);
  $("#saveusuario #usuario").val(usuario);
  $("#saveusuario #nivel").val(nivel);
  $("#saveusuario #status").val(status);
  $("#saveusuario #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR USUARIOS 
function EliminarUsuario(codigo,dni,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Usuario?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codigo="+codigo+"&dni="+dni+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $("#usuarios").load("consultas.php?CargaUsuarios=si");
            $("#saveuser")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Este Usuario no puede ser Eliminado, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Usuarios, no tienes los privilegios dentro del Sistema!", "error"); 

                }

            }
        })
    });
}

// FUNCION PARA BUSCAR LOGS DE ACCESO
$(document).ready(function(){
//function BuscarPacientes() {  
    var consulta;
    //hacemos focus al campo de búsqueda
    $("#blogs").focus();
    //comprobamos si se pulsa una tecla
    $("#blogs").keyup(function(e){
      //obtenemos el texto introducido en el campo de búsqueda
      consulta = $("#blogs").val();

      if (consulta.trim() === '') {  

      $("#logs").html("<center><div class='alert alert-danger'><span class='fa fa-info-circle'></span> POR FAVOR REALICE LA BUSQUEDA CORRECTAMENTE</div></center>");
      return false;

      } else {
                                                                           
        //hace la búsqueda
        $.ajax({
          type: "POST",
          url: "search.php?CargaLogs=si",
          data: "b="+consulta,
          dataType: "html",
          beforeSend: function(){
              //imagen de carga
              $("#logs").html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>');
          },
          error: function(){
              swal("Oops", "Ha ocurrido un error en la petición Ajax, verifique por favor!", "error"); 
          },
          success: function(data){                                                    
            $("#logs").empty();
            $("#logs").append(data);
          }
      });
     }
   });                                                               
});













/////////////////////////////////// FUNCIONES DE PROVINCIAS //////////////////////////////////////

// FUNCION PARA ACTUALIZAR PROVINCIAS
function UpdateProvincia(idprovincia,provincia,proceso) 
{
  // aqui asigno cada valor a los campos correspondientes
  $("#saveprovincia #idprovincia").val(idprovincia);
  $("#saveprovincia #provincia").val(provincia);
  $("#saveprovincia #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR PROVINCIAS 
function EliminarProvincia(idprovincia,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Provincia?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "idprovincia="+idprovincia+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#provincias').load("consultas?CargaProvincias=si");
            $("#saveprovincia")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Esta Provincia no puede ser Eliminada, tiene Canton relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Provincias, no tienes los privilegios dentro del Sistema!", "error"); 

                }
            }
        })
    });
}











/////////////////////////////////// FUNCIONES DE CANTONES //////////////////////////////////////

// FUNCION PARA ACTUALIZAR CANTON
function UpdateCanton(idcanton,canton,idprovincia,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savecanton #idcanton").val(idcanton);
  $("#savecanton #canton").val(canton);
  $("#savecanton #idprovincia").val(idprovincia);
  $("#savecanton #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR CANTON 
function EliminarCanton(idcanton,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Canton de Provincia?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "idcanton="+idcanton+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#cantones').load("consultas?CargaCantones=si");
            $("#savecanton")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Esta Canton no puede ser Eliminado, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Canton, no tienes los privilegios dentro del Sistema!", "error"); 

                }
            }
        })
    });
}

////FUNCION PARA MOSTRAR CANTONES POR PROVINCIAS
function CargaCantones(idprovincia){

$('#idcanton').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
                
var dataString = 'BuscaCantones=si&idprovincia='+idprovincia;

$.ajax({
        type: "GET",
        url: "funciones.php",
        data: dataString,
        success: function(response) {            
        $('#idcanton').empty();
        $('#idcanton').append(''+response+'').fadeIn("slow");
       }
  });
}


////FUNCION PARA MOSTRAR CANTONES POR PROVINCIA #2
function CargaCantones2(idprovincia2){

$('#idcanton2').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
                
var dataString = 'BuscaCantones2=si&idprovincia2='+idprovincia2;

$.ajax({
        type: "GET",
        url: "funciones.php",
        data: dataString,
        success: function(response) {            
        $('#idcanton2').empty();
        $('#idcanton2').append(''+response+'').fadeIn("slow");
            
       }
  });
}

////FUNCION PARA MOSTRAR CANTONES POR PROVINCIA
function SelectCanton(idprovincia,idcanton){

  $("#idcanton").load("funciones.php?SeleccionaCantones=si&idprovincia="+idprovincia+"&idcanton="+idcanton);

}












/////////////////////////////////// FUNCIONES DE PARROQUIAS //////////////////////////////////////

// FUNCION PARA ACTUALIZAR PARROQUIAS
function UpdateParroquia(idparroquia,parroquia,idcanton,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savecanton #idparroquia").val(idparroquia);
  $("#savecanton #parroquia").val(parroquia);
  $("#savecanton #idcanton").val(idcanton);
  $("#savecanton #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR PARROQUIAS 
function EliminarParroquia(idparroquia,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Parroquia de Canton?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "idparroquia="+idparroquia+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#parroquias').load("consultas?CargaParroquias=si");
            $("#saveparroquia")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Esta Parroquia no puede ser Eliminado, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Parroquias, no tienes los privilegios dentro del Sistema!", "error"); 

                }
            }
        })
    });
}

////FUNCION PARA MOSTRAR PARROQUIAS POR CANTON
function CargaParroquias(idcanton){

$('#idparroquia').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
                
var dataString = 'BuscaParroquias=si&idcanton='+idcanton;

$.ajax({
        type: "GET",
        url: "funciones.php",
        data: dataString,
        success: function(response) {            
        $('#idparroquia').empty();
        $('#idparroquia').append(''+response+'').fadeIn("slow");
       }
  });
}


////FUNCION PARA MOSTRAR PARROQUIA POR CANTON #2
function CargaParroquias2(idcanton2){

$('#idparroquia2').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
                
var dataString = 'BuscaParroquias2=si&idcanton2='+idcanton2;

$.ajax({
        type: "GET",
        url: "funciones.php",
        data: dataString,
        success: function(response) {            
        $('#idparroquia2').empty();
        $('#idparroquia2').append(''+response+'').fadeIn("slow");
            
       }
  });
}

////FUNCION PARA MOSTRAR PARROQUIAS POR CANTON
function SelectParroquia(idcanton,idparroquia){

  $("#idparroquia").load("funciones.php?SeleccionaParroquia=si&idcanton="+idcanton+"&idparroquia="+idparroquia);

}















/////////////////////////////////// FUNCIONES DE TIPOS DE DOCUMENTOS  //////////////////////////////////////

// FUNCION PARA ACTUALIZAR TIPOS DE DOCUMENTOS
function UpdateDocumento(coddocumento,documento,descripcion,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savedocumento #coddocumento").val(coddocumento);
  $("#savedocumento #documento").val(documento);
  $("#savedocumento #descripcion").val(descripcion);
  $("#savedocumento #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR TIPOS DE DOCUMENTOS 
function EliminarDocumento(coddocumento,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Tipo de Documento?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "coddocumento="+coddocumento+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#documentos').load("consultas?CargaDocumentos=si");
            $("#savedocumento")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Este Documento no puede ser Eliminado, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Documentos, no tienes los privilegios dentro del Sistema!", "error"); 

                }
            }
        })
    });
}











/////////////////////////////////// FUNCIONES DE SEGUROS //////////////////////////////////////

// FUNCION PARA ACTUALIZAR SEGUROS
function UpdateSeguro(codseguro,nomseguro,direcseguro,tlfseguro1,tlfseguro2,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#saveseguro #codseguro").val(codseguro);
  $("#saveseguro #nomseguro").val(nomseguro);
  $("#saveseguro #direcseguro").val(direcseguro);
  $("#saveseguro #tlfseguro1").val(tlfseguro1);
  $("#saveseguro #tlfseguro2").val(tlfseguro2);
  $("#saveseguro #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR SEGUROS 
function EliminarSeguro(codseguro,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Empresa de Seguro?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codseguro="+codseguro+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#seguros').load("consultas?CargaSeguros=si");
            $("#saveseguro")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Esta Empresa de Seguro no puede ser Eliminada, tiene Pacientes relacionadas!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Empresa de Seguro, no tienes los privilegios dentro del Sistema!", "error"); 

                }
            }
        })
    });
}













/////////////////////////////////// FUNCIONES DE ESPECIALIDADES //////////////////////////////////////

// FUNCION PARA ACTUALIZAR ESPECIALIDADES
function UpdateEspecialidad(codespecialidad,nomespecialidad,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#saveespecialidad #codespecialidad").val(codespecialidad);
  $("#saveespecialidad #nomespecialidad").val(nomespecialidad);
  $("#saveespecialidad #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR ESPECIALIDADES 
function EliminarEspecialidad(codespecialidad,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Especialidad?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codespecialidad="+codespecialidad+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#especialidades').load("consultas.php?CargaEspecialidades=si");
            $("#saveespecialidad")[0].reset();

          } else if(data==2) { 

             swal("Oops", "Esta Especialidad no puede ser Eliminada, tiene registros relacionados!", "error"); 

           } else {  

             swal("Oops", "Usted no tiene Acceso para Eliminar Especialidades, no tienes los privilegios dentro del Sistema!", "error"); 

                }
            }
        })
    });
}

// FUNCION PARA MOSTRAR ESPECIALIDADES POR SUCURSAL
function CargaEspecialidades(codsucursal){

$('#codespecialidad').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaEspecialidades=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#codespecialidad').empty();
          $('#codespecialidad').append(''+response+'').fadeIn("slow");    
       }
  });
}

////FUNCION PARA MOSTRAR ESPECIALIDAD POR SUCURSAL
function SelectEspecialidad(codsucursal,codespecialidad){

  $("#codespecialidad").load("funciones.php?SeleccionaEspecialidad=si&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad);

}












/////////////////////////////////// FUNCIONES DE SUCURSALES //////////////////////////////////////

// FUNCION PARA MOSTRAR SUCURSALES EN VENTANA MODAL
function VerSucursal(codsucursal){

$('#muestrasucursalmodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaSucursalModal=si&codsucursal='+codsucursal;

$.ajax({
            type: "GET",
                  url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestrasucursalmodal').empty();
                $('#muestrasucursalmodal').append(''+response+'').fadeIn("slow");
            }
      });
}

// FUNCION PARA ACTUALIZAR SUCURSALES
function UpdateSucursal(codsucursal,documsucursal,cuitsucursal,nomsucursal,
idprovincia,direcsucursal,correosucursal,tlfsucursal,documencargado,dniencargado,nomencargado,tlfencargado,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savesucursal #codsucursal").val(codsucursal);
  $("#savesucursal #documsucursal").val(documsucursal);
  $("#savesucursal #cuitsucursal").val(cuitsucursal);
  $("#savesucursal #nomsucursal").val(nomsucursal);
  $("#savesucursal #idprovincia").val(idprovincia);
  $("#savesucursal #direcsucursal").val(direcsucursal);
  $("#savesucursal #correosucursal").val(correosucursal);
  $("#savesucursal #tlfsucursal").val(tlfsucursal);
  $("#savesucursal #documencargado").val(documencargado);
  $("#savesucursal #dniencargado").val(dniencargado);
  $("#savesucursal #nomencargado").val(nomencargado);
  $("#savesucursal #tlfencargado").val(tlfencargado);
  $("#savesucursal #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR SUCURSALES 
function EliminarSucursal(codsucursal,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Sucursal?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codsucursal="+codsucursal+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#sucursales').load("consultas?CargaSucursales=si");
            $("#savesucursal")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Esta Sucursal no puede ser Eliminada, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Sucursales, no tienes los privilegios dentro del Sistema!", "error"); 

                }
            }
        })
    });
}

// FUNCION PARA MOSTRA SUCURSALES ASIGNADAS AL USUARIO
function CargarSucursalesAsignadas(codigo,codsucursal){
                                        
var dataString = 'MuestraSucursalesAsignadas=si&codigo='+codigo+"&gruposid="+codsucursal;

$.ajax({
        type: "GET",
        url: "funciones.php",
        async : false,
        data: dataString,
        success: function(response) {            
            $('#muestrasucursales').empty();
            $('#muestrasucursales').append(''+response+'').fadeIn("slow");
         }
  });
}













/////////////////////////////////// FUNCIONES DE PLANTILLAS ECOGRAFICAS //////////////////////////////////////

// FUNCION PARA MOSTRAR PLANTILLA ECOGRAFICA EN VENTANA MODAL
function VerPlantillaEcografica(codplantillaecografia){

$('#muestraplantillamodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaPlantillaEcograficaModal=si&codplantillaecografia='+codplantillaecografia;

$.ajax({
            type: "GET",
                  url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraplantillamodal').empty();
                $('#muestraplantillamodal').append(''+response+'').fadeIn("slow");
            }
      });
}

// FUNCION PARA ACTUALIZAR PLANTILLA ECOGRAFICA
function UpdatePlantillaEcografica(codplantillaecografia,nombreplantillaecografia,
  procedimientoecografia,descripcionecografia,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#saveplantillaecografica #codplantillaecografia").val(codplantillaecografia);
  $("#saveplantillaecografica #nombreplantillaecografia").val(nombreplantillaecografia);
  $("#saveplantillaecografica #procedimientoecografia").val(procedimientoecografia);
  $("#saveplantillaecografica #descripcionecografia").val(descripcionecografia);
  $("#saveplantillaecografica #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR PLANTILLA ECOGRAFICA 
function EliminarPlantillaEcografica(codplantillaecografia,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Plantilla Ecografica?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codplantillaecografia="+codplantillaecografia+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#plantillas_ecograficas').load("consultas?CargaPlantillasEcograficas=si");
            $("#saveplantillaecografica")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Esta Plantilla Ecografica no puede ser Eliminada, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Plantillas Ecograficas, no tienes los privilegios dentro del Sistema!", "error"); 

                }
            }
        })
    });
}

// FUNCION PARA BUSCAR PLANTILLAS ECOGRAFICAS
function BuscarPlantillasEcograficas(){
                        
$('#muestra_plantillas').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');
                
var search = $("#becografias").val();
var dataString = $("#plantillasecograficas").serialize();
var url = 'consultas.php?BusquedaPlantillasEcograficas=si';

$.ajax({
    type: "GET",
    url: url,
    data: dataString,
      success: function(response) {            
        $('#muestra_plantillas').empty();
        $('#muestra_plantillas').append(''+response+'').fadeIn("slow");
      }
  });
}











/////////////////////////////////// FUNCIONES DE PLANTILLAS LECTURA RX //////////////////////////////////////

// FUNCION PARA MOSTRAR PLANTILLA LECTURA RX EN VENTANA MODAL
function VerPlantillaLecturaRx(codplantillalecturarx){

$('#muestraplantillamodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaPlantillaLecturaRxModal=si&codplantillalecturarx='+codplantillalecturarx;

$.ajax({
            type: "GET",
                  url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraplantillamodal').empty();
                $('#muestraplantillamodal').append(''+response+'').fadeIn("slow");
            }
      });
}

// FUNCION PARA ACTUALIZAR PLANTILLA LECTURA RX
function UpdatePlantillaEcografica22222(codplantillaecografia,nombreplantillaecografia,
  procedimientoecografia,descripcionecografia,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#saveplantillaecografica #codplantillaecografia").val(codplantillaecografia);
  $("#saveplantillaecografica #nombreplantillaecografia").val(nombreplantillaecografia);
  $("#saveplantillaecografica #procedimientoecografia").val(procedimientoecografia);
  $("#saveplantillaecografica #descripcionecografia").val(descripcionecografia);
  $("#saveplantillaecografica #proceso").val(proceso);
}

function UpdatePlantillaLecturaRx(codplantillalecturarx,nombreplantillalecturarx,procedimientolecturarx,descripcionlecturarx,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#saveplantillalecturarx #codplantillalecturarx").val(codplantillalecturarx);
  $("#saveplantillalecturarx #nombreplantillalecturarx").val(nombreplantillalecturarx);
  $("#saveplantillalecturarx #procedimientolecturarx").val(procedimientolecturarx);
  $("#saveplantillalecturarx #descripcionlecturarx").val(descripcionlecturarx);
  $("#saveplantillalecturarx #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR PLANTILLA LECTURA RX 
function EliminarPlantillaLecturaRx(codplantillalecturarx,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Plantilla Lectura Rx?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codplantillalecturarx="+codplantillalecturarx+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#plantillas_lecturarx').load("consultas?CargaPlantillasLecturasRx=si");
            $("#saveplantillalecturarx")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Esta Plantilla Lectura Rx no puede ser Eliminada, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Plantillas Lectura Rx, no tienes los privilegios dentro del Sistema!", "error"); 

                }
            }
        })
    });
}

// FUNCION PARA BUSCAR PLANTILLAS LECTURA RX
function BuscarPlantillasLecturaRx(){
                        
$('#muestra_plantillas').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');
                
var search = $("#blecturarx").val();
var dataString = $("#plantillaslecturarx").serialize();
var url = 'consultas.php?BusquedaPlantillasLecturaRx=si';

$.ajax({
    type: "GET",
    url: url,
    data: dataString,
      success: function(response) {            
        $('#muestra_plantillas').empty();
        $('#muestra_plantillas').append(''+response+'').fadeIn("slow");
      }
  });
}







/////////////////////////////////// FUNCIONES DE MEDICOS //////////////////////////////////////

// FUNCION PARA MOSTRAR MEDICOS EN VENTANA MODAL
function VerMedico(codmedico){

$('#muestramedicomodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaMedicoModal=si&codmedico='+codmedico;

$.ajax({
            type: "GET",
                  url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestramedicomodal').empty();
                $('#muestramedicomodal').append(''+response+'').fadeIn("slow");
            }
      });
}

// FUNCION PARA ACTUALIZAR MEDICOS
function UpdateMedico(codmedico,codsucursal) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar este Médico?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "formedico?codmedico="+codmedico+"&codsucursal="+codsucursal;
      // handle confirm
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR MEDICOS 
function EliminarMedico(codmedico,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Médico?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codmedico="+codmedico+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#medicos').load("consultas?CargaMedicos=si");
                  
          } else if(data==2){ 

             swal("Oops", "Este Médico no puede ser Eliminado, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Médicos, no tienes los privilegios dentro del Sistema!", "error"); 

                }
            }
        })
    });
}

/////FUNCION PARA REINICIAR CLAVE MEDICO 
function ReiniciarClaveMedico(codmedico,cedmedico,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Reiniciar la Clave de Acceso de este Médico?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Reiniciar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  async : false,
                  data: "codmedico="+codmedico+"&cedmedico="+cedmedico+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Reiniciada!", "Su Clave de Acceso fue Reiniciada con Éxito al Nº de Documento de Identidad", "success");
            $('#medicos').load("consultas.php?CargaMedicos=si"); 
                  
          } else { 

             swal("Oops", "No puedes Reiniciar Claves, No tienes Privilegios para ese Procedimiento !", "error"); 

                }
            }
        })
    });
}


// FUNCION PARA MOSTRAR MEDICOS POR SUCURSAL Y ESPECIALIDAD
function CargaMedicos(codsucursal,codespecialidad){

$('#codmedico').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaMedicos=si&codsucursal='+codsucursal+"&codespecialidad="+codespecialidad;

$.ajax({
        type: "GET",
        url: "funciones.php",
        data: dataString,
        success: function(response) {            
            $('#codmedico').empty();
            $('#codmedico').append(''+response+'').fadeIn("slow");
            
       }
  });
}

////FUNCION PARA MOSTRAR MEDICOS POR SUCURSAL Y ESPECIALIDAD
function SelectMedico(codsucursal,codespecialidad,codmedico){

  $("#codmedico").load("funciones.php?SeleccionaMedico=si&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico);

}

// FUNCION PARA MOSTRA DIAS LABORABLES ASIGNADOS AL MEDICO
function CargarDiasAsignados(codhorario,dias){
                                        
var dataString = 'MuestraDiasAsignados=si&codhorario='+codhorario+"&gruposid="+dias;

$.ajax({
            type: "GET",
            url: "funciones.php",
            async : false,
            data: dataString,
            success: function(response) {            
                $('#muestradiaslaborales').empty();
                $('#muestradiaslaborales').append(''+response+'').fadeIn("slow");
             }
      });
}


// FUNCION PARA BUSCAR MEDICOS POR SUCURSAL
function BuscarMedicosxSucursal() {
                        
$('#muestramedicosxsucursal').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var dataString = $("#medicosxsucursal").serialize();
var url = 'funciones.php?BusquedaMedicosxSucursal=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
        $('#muestramedicosxsucursal').empty();
        $('#muestramedicosxsucursal').append(''+response+'').fadeIn("slow");
      }
   });
}

// FUNCION PARA MOSTRAR MODULOS ESPECIALIDADES POR MEDICOS
function CargaModulosxMedicos(codsucursal,codmedico){

$('#tipoconsentimiento').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaModulosxMedicos=si&codsucursal='+codsucursal+"&codmedico="+codmedico;

$.ajax({
        type: "GET",
        url: "funciones.php",
        data: dataString,
        success: function(response) {            
            $('#tipoconsentimiento').empty();
            $('#tipoconsentimiento').append(''+response+'').fadeIn("slow");
            
       }
  });
}

// FUNCION PARA MOSTRAR MEDICOS POR SUCURSAL
function CargaMedicosxSucursal(codsucursal){

$('#codmedico').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#codmedico').empty();
          $('#codmedico').append(''+response+'').fadeIn("slow");    
       }
  });
}

// FUNCION PARA MOSTRAR PROFESIONAL SOLICITANTE POR SUCURSAL
function CargaProfesionalxSucursal(codsucursal){

$('#profesional_solicita').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;
//var dataString = 'BuscaProfesionalSolicitante=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#profesional_solicita').empty();
          $('#profesional_solicita').append(''+response+'').fadeIn("slow");    
       }
  });
}

// FUNCION PARA MOSTRAR CIRUJANO POR SUCURSAL
function CargaCirujanoxSucursal(codsucursal){

$('#cirujano').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#cirujano').empty();
          $('#cirujano').append(''+response+'').fadeIn("slow");    
       }
  });
}

// FUNCION PARA MOSTRAR PRIMER AYUDANTE CIRUJANO POR SUCURSAL
function CargaPrimerAyudanteCirujanoxSucursal(codsucursal){

$('#primer_ayudante').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#primer_ayudante').empty();
          $('#primer_ayudante').append(''+response+'').fadeIn("slow");    
       }
  });
}

// FUNCION PARA MOSTRAR SEGUNDO AYUDANTE CIRUJANO POR SUCURSAL
function CargaSegundoAyudanteCirujanoxSucursal(codsucursal){

$('#segundo_ayudante').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#segundo_ayudante').empty();
          $('#segundo_ayudante').append(''+response+'').fadeIn("slow");    
       }
  });
}

// FUNCION PARA MOSTRAR TERCER AYUDANTE CIRUJANO POR SUCURSAL
function CargaTercerAyudanteCirujanoxSucursal(codsucursal){

$('#tercer_ayudante').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#tercer_ayudante').empty();
          $('#tercer_ayudante').append(''+response+'').fadeIn("slow");    
       }
  });
}

// FUNCION PARA MOSTRAR INSTRUMENTISTA POR SUCURSAL
function CargaInstrumentistaxSucursal(codsucursal){

$('#instrumentista').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#instrumentista').empty();
          $('#instrumentista').append(''+response+'').fadeIn("slow");    
       }
  });
}

// FUNCION PARA MOSTRAR INSTRUMENTISTA POR SUCURSAL
function CargaAyudanteInstrumentistaxSucursal(codsucursal){

$('#ayudante_instrumentista').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#ayudante_instrumentista').empty();
          $('#ayudante_instrumentista').append(''+response+'').fadeIn("slow");    
       }
  });
}

// FUNCION PARA MOSTRAR CIRUJANO CIRCULANTE DE TURNO POR SUCURSAL
function CargaCirujanoCirculantexSucursal(codsucursal){

$('#cirujano_circulante').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#cirujano_circulante').empty();
          $('#cirujano_circulante').append(''+response+'').fadeIn("slow");    
       }
  });
}

// FUNCION PARA MOSTRAR CIRCULANTE POR SUCURSAL
function CargaCirculantexSucursal(codsucursal){

$('#circulante').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#circulante').empty();
          $('#circulante').append(''+response+'').fadeIn("slow");    
       }
  });
}

// FUNCION PARA MOSTRAR ANESTESISTA POR SUCURSAL
function CargaAnestesistaxSucursal(codsucursal){

$('#anestesista').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#anestesista').empty();
          $('#anestesista').append(''+response+'').fadeIn("slow");    
       }
  });
}

// FUNCION PARA MOSTRAR AYUDANTE ANESTESISTA POR SUCURSAL
function CargaAyudanteAnestesistaxSucursal(codsucursal){

$('#ayudante_anestesia').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#ayudante_anestesia').empty();
          $('#ayudante_anestesia').append(''+response+'').fadeIn("slow");    
       }
  });
}

// FUNCION PARA MOSTRAR PRIMER AYUDANTE ANESTESISTA POR SUCURSAL
function CargaPrimerAyudanteAnestesistaxSucursal(codsucursal){

$('#ayudante_anestesiologo1').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#ayudante_anestesiologo1').empty();
          $('#ayudante_anestesiologo1').append(''+response+'').fadeIn("slow");    
       }
  });
}

// FUNCION PARA MOSTRAR PRIMER SEGUNDO ANESTESISTA POR SUCURSAL
function CargaSegundoAyudanteAnestesistaxSucursal(codsucursal){

$('#ayudante_anestesiologo2').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#ayudante_anestesiologo2').empty();
          $('#ayudante_anestesiologo2').append(''+response+'').fadeIn("slow");    
       }
  });
}

// FUNCION PARA MOSTRAR PRIMER SEGUNDO ANESTESISTA POR SUCURSAL
function CargaDictadoxSucursal(codsucursal){

$('#dictado').html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                
var dataString = 'BuscaProfesional=si&codsucursal='+codsucursal;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
      success: function(response) {            
          $('#dictado').empty();
          $('#dictado').append(''+response+'').fadeIn("slow");    
       }
  });
}














/////////////////////////////////// FUNCIONES DE HORARIOS //////////////////////////////////////

// FUNCION PARA LIMPIAR FORMULARIO DE HORARIO
function Limpiar_Horario(){

$("#savehorario")[0].reset();
$("#savehorario #proceso").val("save");
$("#savehorario #codhorario").val("");
$("#savehorario #codsucursal").val("");
$("#savehorario #codespecialidad").html("<option value=''>-- SIN RESULTADOS --</option>");
$("#savehorario #codmedico").html("<option value=''>-- SIN RESULTADOS --</option>");
$("#savehorario #dias[]").val("");
$("#savehorario #hora_desde").val("");
$("#savehorario #hora_hasta").val("");

}


// FUNCION PARA MOSTRAR MEDICOS EN VENTANA MODAL
function VerHorario(codhorario){

$('#muestrahorariomodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaHorarioModal=si&codhorario='+codhorario;

$.ajax({
    type: "GET",
    url: "funciones.php",
    data: dataString,
      success: function(response) {            
        $('#muestrahorariomodal').empty();
        $('#muestrahorariomodal').append(''+response+'').fadeIn("slow");
      }
  });
}

// FUNCION PARA ACTUALIZAR HORARIOS
function UpdateHorario(codhorario,codsucursal,hora_desde,hora_hasta,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savehorario #codhorario").val(codhorario);
  $("#savehorario #codsucursal").val(codsucursal);
  $("#savehorario #hora_desde").val(hora_desde);
  $("#savehorario #hora_hasta").val(hora_hasta);
  $("#savehorario #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR HORARIOS 
function EliminarHorario(codhorario,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Horario de Médico?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codhorario="+codhorario+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#horarios').load("consultas?CargaHorarios=si");
            $("#savehorario")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Este Horario no puede ser Eliminado, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Horarios de Médicos, no tienes los privilegios dentro del Sistema!", "error"); 

                }
            }
        })
    });
}

// FUNCION PARA MOSTRAR HORAS DISPONIBLES EN VENTANA MODAL
function VerHorasDisponibles(codmedico,codsucursal,fechacita){

$('#muestrahorasmodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaHorasDisponiblesModal=si&codmedico='+codmedico+"&codsucursal="+codsucursal+"&fechacita="+fechacita;

$.ajax({
    type: "GET",
    url: "funciones.php",
    data: dataString,
      success: function(response) {            
        $('#muestrahorasmodal').empty();
        $('#muestrahorasmodal').append(''+response+'').fadeIn("slow");
      }
  });
}

// FUNCION PARA ABONAR PAGO A CREDITOS
function AsignarHora(horacita) 
{
  // aqui asigno cada valor a los campos correspondientes
  $("#savecita #horacita").val(horacita);
}

















/////////////////////////////////// FUNCIONES DE PACIENTES //////////////////////////////////////

// FUNCION PARA VERIFICAR DOCUMENTO DE PACIENTE
function VerificaDocumento(cedpaciente,tipo){
         
$.ajax({
    type: "GET",
    url: "eliminar.php",
    data: "cedpaciente="+cedpaciente+"&tipo="+tipo,
    success: function(data){

            if(data==1){

                $("#muestra_msj").html('');
                $("#cedpaciente").val(cedpaciente);

            } else { 

                $("#muestra_msj").html('ESTE Nº DE DOCUMENTO YA ESTA REGISTRADO');
                $("#cedpaciente").val('');

            }
    
        }
    })
}

// FUNCION PARA BUSCAR PACIENTES
function BuscarPacientes(){
                        
$('#muestrapacientes').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');
                
var search = $("#bpacientes").val();
var dataString = $("#busquedapacientes").serialize();
var url = 'consultas.php?CargaPacientes=si';

$.ajax({
    type: "GET",
    url: url,
    data: dataString,
      success: function(response) {            
        $('#muestrapacientes').empty();
        $('#muestrapacientes').append(''+response+'').fadeIn("slow");
      }
  });
}

// FUNCION PARA MOSTRAR DIV DE CARGA MASIVA DE PACIENTES
function CargaDivPaciente(){

$('#divpaciente').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');
                
var dataString = 'BuscaDivPaciente=si';

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#divpaciente').empty();
                $('#divpaciente').append(''+response+'').fadeIn("slow");
           }
      });
}


// FUNCION PARA LIMPIAR DIV DE CARGA MASIVA DE PACIENTES
function ModalPaciente(){
  $("#divpaciente").html("");
}

// FUNCION PARA MOSTRAR PACIENTES EN VENTANA MODAL
function VerPaciente(codpaciente){

$('#muestrapacientemodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaPacienteModal=si&codpaciente='+codpaciente;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestrapacientemodal').empty();
                $('#muestrapacientemodal').append(''+response+'').fadeIn("slow");
            }
      });
}

// FUNCION PARA ACTUALIZAR PACIENTES
function UpdatePaciente(codpaciente,documpaciente,cedpaciente,pnompaciente,snompaciente,papepaciente,sapepaciente,direcpaciente,
  barriopaciente,idprovincia,zonapaciente,tlfpaciente,fnacpaciente,lnacpaciente,nacpaciente,enfoquepaciente,sexopaciente,
  estadopaciente,instruccionpaciente,ocupacionpaciente,trabajapaciente,codseguro,referidopaciente,gruposapaciente,emailpaciente,
  nomacompana,direcacompana,tlfacompana,parentescoacompana,nomresponsable,direcresponsable,tlfresponsable,parentescoresponsable,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savepaciente #codpaciente").val(codpaciente);
  $("#savepaciente #documpaciente").val(documpaciente);
  $("#savepaciente #cedpaciente").val(cedpaciente);
  $("#savepaciente #pnompaciente").val(pnompaciente);
  $("#savepaciente #snompaciente").val(snompaciente);
  $("#savepaciente #papepaciente").val(papepaciente);
  $("#savepaciente #sapepaciente").val(sapepaciente);
  $("#savepaciente #direcpaciente").val(direcpaciente);
  $("#savepaciente #barriopaciente").val(barriopaciente);
  $("#savepaciente #idprovincia").val(idprovincia);
  $("#savepaciente #zonapaciente").val(zonapaciente);
  $("#savepaciente #tlfpaciente").val(tlfpaciente);
  $("#savepaciente #fnacpaciente").val(fnacpaciente);
  $("#savepaciente #lnacpaciente").val(lnacpaciente);
  $("#savepaciente #nacpaciente").val(nacpaciente);
  $("#savepaciente #enfoquepaciente").val(enfoquepaciente);
  $("#savepaciente #sexopaciente").val(sexopaciente);
  $("#savepaciente #estadopaciente").val(estadopaciente);
  $("#savepaciente #instruccionpaciente").val(instruccionpaciente);
  $("#savepaciente #ocupacionpaciente").val(ocupacionpaciente);
  $("#savepaciente #trabajapaciente").val(trabajapaciente);
  $("#savepaciente #codseguro").val(codseguro);
  $("#savepaciente #referidopaciente").val(referidopaciente);
  $("#savepaciente #gruposapaciente").val(gruposapaciente);
  $("#savepaciente #emailpaciente").val(emailpaciente);
  $("#savepaciente #nomacompana").val(nomacompana);
  $("#savepaciente #direcacompana").val(direcacompana);
  $("#savepaciente #tlfacompana").val(tlfacompana);
  $("#savepaciente #parentescoacompana").val(parentescoacompana);
  $("#savepaciente #nomresponsable").val(nomresponsable);
  $("#savepaciente #direcresponsable").val(direcresponsable);
  $("#savepaciente #tlfresponsable").val(tlfresponsable);
  $("#savepaciente #parentescoresponsable").val(parentescoresponsable);
  $("#savepaciente #proceso").val(proceso);
}

// FUNCION PARA ACTUALIZAR PACIENTES
function CargaDatosPaciente(codpaciente,numero,documento,nombres,apellidos,direccion,
  barrio,provincia,canton,parroquia,zona,telefono,fechanac,gruposapaciente) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savedocumentopaciente #codpaciente").val(codpaciente);
  $("#savedocumentopaciente #TxtNumero").text(numero);
  $("#savedocumentopaciente #TxtDocumento").text(documento);
  $("#savedocumentopaciente #TxtNombre").text(nombres);
  $("#savedocumentopaciente #TxtApellido").text(apellidos);
  $("#savedocumentopaciente #TxtDireccion").text(direccion);
  $("#savedocumentopaciente #TxtBarrio").text(barrio);
  $("#savedocumentopaciente #TxtProvincia").text(provincia);
  $("#savedocumentopaciente #TxtCanton").text(canton);
  $("#savedocumentopaciente #TxtParroquia").text(parroquia);
  $("#savedocumentopaciente #TxtZona").text(zona);
  $("#savedocumentopaciente #TxtTelefono").text(telefono);
  $("#savedocumentopaciente #TxtFechaNac").text(fechanac);
  $("#savedocumentopaciente #TxtGrupoSanguineo").text(gruposapaciente);
}

//FUNCION PARA LIMPIAR CAMPOS EN PACIENTE
function ResetDocumentosPaciente() 
{
    $("#savedocumentopaciente")[0].reset();
    $("#tabla").html('<div class="form-group has-feedback"><div class="fileinput fileinput-new" data-provides="fileinput"><div class="form-group has-feedback"><label class="control-label">Archivo a Cargar: <span class="symbol required"></span></label><div class="input-group"><div class="form-control" data-trigger="fileinput"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg><span class="fileinput-filename"></span></div><span class="input-group-addon btn btn-success btn-file"><span class="fileinput-new"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg> Selecciona Archivo</span><span class="fileinput-exists"><i data-feather="image"></i> Cambiar</span><input type="file" class="btn btn-default" data-original-title="Subir Archivo" data-rel="tooltip" placeholder="Suba su Imagen" name="file[]" id="file" autocomplete="off" title="Buscar Archivo"></span><a href="#" class="input-group-addon btn btn-dark fileinput-exists" data-dismiss="fileinput"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg> Quitar</a></div><small><p>Para Subir Archivo debe tener en cuenta:<br> * El Archivo a cargar debe ser extension.pdf,jpeg,jpg,png</p></small></div></div></div>');
}

/////FUNCION PARA ELIMINAR PACIENTES 
function EliminarPaciente(codpaciente,criterio,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Paciente?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codpaciente="+codpaciente+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#muestrapacientes').load("consultas.php?CargaPacientes=si&bpacientes="+criterio);
                  
          } else if(data==2){ 

             swal("Oops", "Este Paciente no puede ser Eliminado, tiene Registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Pacientes, no tienes los privilegios dentro del Sistema!", "error"); 

                }
            }
        })
    });
}

/////FUNCION PARA REINICIAR CLAVE PACIENTE 
function ReiniciarClavePaciente(codpaciente,cedpaciente,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Reiniciar la Clave de Acceso de este Paciente?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Reiniciar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  async : false,
                  data: "codpaciente="+codpaciente+"&cedpaciente="+cedpaciente+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Reiniciada!", "Su Clave de Acceso fue Reiniciada con Éxito al Nº de Documento de Identidad", "success");
                  
          } else { 

             swal("Oops", "No puedes Reiniciar Claves, No tienes Privilegios para ese Procedimiento !", "error"); 

                }
            }
        })
    });
}

























/////////////////////////////////// FUNCIONES DE CITAS //////////////////////////////////////

// FUNCION PARA BUSCAR CITAS MEDICAS EN CALENDARIO
function BuscarCitasCalendario() {
                        
$('#muestra_calendario').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var codespecialidad = $("#codespecialidad").val();
var codmedico = $("#codmedico").val();
var dataString = $("#busquedacalendario").serialize();
var url = 'calendario.php?Calendario_Secundario=si';
$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
        $('#muestra_calendario').empty();
        $('#muestra_calendario').append(''+response+'').fadeIn("slow");
      }
   });
}


// FUNCION PARA BUSCAR CITAS MEDICAS
function BuscarCitasMedicas(){
                        
$('#muestracitasmedicas').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');
                
var search = $("#bcitas").val();
var dataString = $("#busquedacitasmedicas").serialize();
var url = 'consultas.php?CargaCitasMedicas=si';

$.ajax({
    type: "GET",
    url: url,
    data: dataString,
      success: function(response) {            
        $('#muestracitasmedicas').empty();
        $('#muestracitasmedicas').append(''+response+'').fadeIn("slow");
      }
  });
}


// FUNCION MUESTRA CITAS MEDICAS EN VENTANA MODAL
function VerCita(codcita) {

$('#muestracitamedicamodal').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var dataString = 'BuscaCitaMedicasModal=si&codcita='+codcita;

$.ajax({
    type: "GET",
    url: "funciones.php",
    data: dataString,
    success: function(response) {            
      $('#muestracitamedicamodal').empty();
      $('#muestracitamedicamodal').append(''+response+'').fadeIn("slow");
      }
  });
} 

/////FUNCION PARA CANCELAR CITA MEDICA
function CancelarCita(codcita,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Cancelar esta Cita Médica?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Continuar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  async : false,
                  data: "codcita="+codcita+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "El Registro ha sido Cancelado Exitosamente!", "success");
            $('#ModalAdd').modal('hide');
            $("#deletevento").attr('disabled', true);
            $("#cancelaevento").attr('disabled', true);
            $("#savecita")[0].reset();
            $("#proceso").val("save");
            $("#cargacalendario").html("");
            $('html, body').animate({scrollTop:800}, 1000); 
            $('#cargacalendario').append('<center><i class="fa fa-spin fa-spinner"></i> Por Favor Espere, Cargando Calendario ......</center>').fadeIn("slow");
            setTimeout(function() {
          $('#cargacalendario').load("calendario?Calendario_Secundario=si");
            }, 100); 
            Cerrar();
                              
          } else if(data==2){ 

            swal("Oops", "Esta Cita Médica no puede ser Cancelada, ya se encuentra Verificada!", "error"); 

          } else {

            swal("Oops", "Usted no tiene Acceso para Cancelar Citas Médica, no tienes este privilegio!", "error"); 
             
            }
          }
      })
  });
}

/////FUNCION PARA ELIMINAR CITA MEDICA EN CALENDARIO 
function EliminarCita(codcita,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Cita Médica?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  async : false,
                  data: "codcita="+codcita+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "El Registro ha sido Eliminado Exitosamente!", "success");
            $('#ModalAdd').modal('hide');
            $("#deletevento").attr('disabled', true);
            $("#cancelaevento").attr('disabled', true);
            $("#savecita")[0].reset();
            $("#proceso").val("save");
            $("#cargacalendario").html("");
            $('html, body').animate({scrollTop:800}, 1000); 
            $('#cargacalendario').append('<center><i class="fa fa-spin fa-spinner"></i> Por Favor Espere, Cargando Calendario ......</center>').fadeIn("slow");
            setTimeout(function() {
          $('#cargacalendario').load("calendario?Calendario_Secundario=si");
            }, 100); 
            Cerrar();

          } else if(data==2){ 

              swal("Oops", "Esta Cita Médica no puede ser Eliminada, ya se encentra Verificada!", "error"); 

          } else {

             swal("Oops", "Usted no tiene Acceso para Eliminar Citas Médica, no tienes este privilegio!", "error"); 
             
            }
          }
      })
  });
}

/////FUNCION PARA ELIMINAR CITA MEDICA EN CONSULTA
function EliminarCitaGeneral(codcita,criterio,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Cita Médica?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  async : false,
                  data: "codcita="+codcita+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#muestracitasmedicas').load("consultas.php?CargaCitasMedicas=si&bcitas="+criterio);
            //$('#citas').load("consultas.php?CargaCitas=si");

          } else if(data==2){ 

              swal("Oops", "Esta Cita Médica no puede ser Eliminada, ya se encentra Verificada!", "error"); 

          } else {

             swal("Oops", "Usted no tiene Acceso para Eliminar Citas Médica, no tienes este privilegio!", "error"); 
             
            }
          }
      })
  });
}

//FUNCION LIMPIAR MODAL DE CITAS MEDICAS
function Cerrar(){

$("#savecita")[0].reset();
$("#savecita #proceso").val("save");
$("#savecita #codcita").val("");
$("#savecita #sucursal").val("");
$("#savecita #codpaciente").val("");
$("#savecita #delete").val("");
$("#savecita #cancelar").val("");
$("#savecita #medico").val("");
$("#savecita #search_paciente").val("");
$("#savecita #descripcion").val("");
$("#savecita #fechacita").val("");
$("#savecita #horacita").val("");
$("#savecita #color").val("");
$("#deletevento").attr('disabled', true);
$("#cancelaevento").attr('disabled', true);

}

//FUNCION LIMPIAR MODAL DE CITAS MEDICAS
function Limpiar(){

$("#savecita")[0].reset();
$("#savecita #proceso").val("save");
$("#savecita #codcita").val("");
$("#savecita #sucursal").val("");
$("#savecita #delete").val("");
$("#savecita #cancelar").val("");
$("#savecita #medico").val("");
$("#savecita #descripcion").val("");
$("#savecita #fechacita").val("");
$("#savecita #horacita").val("");
$("#savecita #color").val("");
$("#deletevento").attr('disabled', true);
$("#cancelaevento").attr('disabled', true);

}

// FUNCION PARA BUSCAR CITAS MEDICAS POR FECHAS
function BuscarCitasxFechas() {
                        
$('#muestracitasxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#citasxfechas").serialize();
var url = 'funciones.php?BusquedaCitasMedicasxFechas=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
        $('#muestracitasxfechas').empty();
        $('#muestracitasxfechas').append(''+response+'').fadeIn("slow");
      }
   });
}

// FUNCION PARA BUSCAR CITAS MEDICAS POR MEDICO
function BuscarCitasxMedico() {
                        
$('#muestracitasxmedico').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var codmedico = $("#codmedico").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#citasxmedico").serialize();
var url = 'funciones.php?BusquedaCitasMedicasxMedico=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
        $('#muestracitasxmedico').empty();
        $('#muestracitasxmedico').append(''+response+'').fadeIn("slow");
      }
   });
}

// FUNCION PARA BUSCAR CITAS MEDICAS POR PACIENTE
function BuscarCitasxPaciente() {
                        
$('#muestracitasxpaciente').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var codpaciente = $("#codpaciente").val();
var dataString = $("#citasxpaciente").serialize();
var url = 'funciones.php?BusquedaCitasMedicasxPaciente=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
          $('#muestracitasxpaciente').empty();
          $('#muestracitasxpaciente').append(''+response+'').fadeIn("slow");
      }
  });
}


// FUNCION PARA BUSQUEDA DE CITAS MEDICAS POR DIA
function BuscarCitasxDia(){
                        
$('#muestracitasxdia').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');
                
var codmodulo = $("#codmodulo").val();
var codsucursal = $("#codsucursal").val();
var codespecialidad = $("#codespecialidad").val();
var codmedico = $("#codmedico").val();
var fecha = $("#fecha").val();
var dataString = $("#busquedacitasxdia").serialize();
var url = 'consultas.php?BuscaCitasxDia=si';

$.ajax({
    type: "GET",
    url: url,
    data: dataString,
    success: function(response) {            
      $('#muestracitasxdia').empty();
      $('#muestracitasxdia').append(''+response+'').fadeIn("slow");
    }
  });
}

// FUNCION PARA ASIGNAR DATOS DE CITAS
function AsignarDatos(codverifica,codsucursal,sucursal,codcita,cita,codmedico,codespecialidad,fecha,codpaciente,paciente,numeropaciente,cedpaciente,nompaciente,apepaciente,
  gruposapaciente,fnacpaciente,nomacompana,parentescoacompana) 
{
  // aqui asigno cada valor a los campos correspondientes
  $("#verifica_busqueda").val(codverifica);
  $("#sucursal_busqueda").val(codsucursal);
  $("#sucursal").val(sucursal);
  $("#codcita").val(codcita);
  $("#cita").val(cita);
  $("#medico_busqueda").val(codmedico);
  $("#especialidad_busqueda").val(codespecialidad);
  $("#fecha_busqueda").val(fecha);
  $("#codpaciente").val(codpaciente);
  $("#paciente").val(paciente);
  $("#numeropaciente").val(numeropaciente);
  $("#cedpaciente").val(cedpaciente);
  $("#nompaciente").val(nompaciente);
  $("#apepaciente").val(apepaciente);
  $("#gruposapaciente").val(gruposapaciente);
  $("#fnacimiento").val(fnacpaciente);
  $("#nomacompana").val(nomacompana);
  $("#parentescoacompana").val(parentescoacompana);
 
  if(codverifica == 1){

  $("#msj_aperturas").load("funciones.php?VerificaApertura=si&codsucursal="+codsucursal+"&codpaciente="+codpaciente+"&codverifica="+codverifica);

  } else if(codverifica == 2){

  $("#msj_aperturas").load("funciones.php?VerificaApertura=si&codsucursal="+codsucursal+"&codpaciente="+codpaciente+"&codverifica="+codverifica);

  } else if(codverifica == 5){

  $("#muestra_ciclos").load("funciones.php?BuscaCicloTerapias=si&codsucursal="+codsucursal+"&codpaciente="+codpaciente);

  } else if(codverifica == 6 || codverifica == 7){

  $("#guarda").attr('disabled', false);
  $("#agrega").attr('disabled', false); 

  //$("#muestrahistorial").load("funciones.php?BuscaHistorialPaciente=si&codpaciente="+codpaciente+"&codsucursal="+codsucursal);
  $("#divTratamiento").load("funciones.php?BuscaTablaTratamiento=si&codpaciente="+codpaciente+"&codsucursal="+codsucursal);
  cargarDientes('seccionDientes', 'dientes.php', '', codpaciente, codsucursal);
  $("#verifica_odontologia").load("funciones.php?VerificaOdontologia=si&codpaciente="+codpaciente+"&codsucursal="+codsucursal+"&codverifica="+codverifica);

  }

}













/////////////////////////////////// FUNCIONES DE APERTURA MEDICA //////////////////////////////////////

// FUNCION PARA MOSTRAR APERTURA EN VENTANA MODAL
function VerApertura(codapertura){

$('#muestraaperturamodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaAperturasModal=si&numero='+codapertura;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
        success: function(response) {            
        $('#muestraaperturamodal').empty();
        $('#muestraaperturamodal').append(''+response+'').fadeIn("slow");   
      }
  });
}


// FUNCION PARA ACTUALIZAR APERTURA
function UpdateApertura(codapertura,modulo) {
  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Apertura Médica?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
        if(modulo == 1){
          location.href = "foraperturac?numero="+codapertura;
        } else {
          location.href = "foraperturag?numero="+codapertura;
        }
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR APERTURA 
function EliminarApertura(codapertura,url,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Apertura Médica?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codapertura="+codapertura+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#aperturas').load("consultas?CargaAperturas=si&url="+url);
                  
          } else if(data==2){ 

             swal("Oops", "Esta Apertura Médica no puede ser Eliminada, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Aperturas Médicas, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}












/////////////////////////////////// FUNCIONES DE HOJAS EVOLUTIVAS //////////////////////////////////////

// FUNCION PARA MOSTRAR HOJA EVOLUTIVA EN VENTANA MODAL
function VerHoja(codhoja){

$('#muestrahojamodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaHojasEvolutivasModal=si&numero='+codhoja;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
        success: function(response) {            
        $('#muestrahojamodal').empty();
        $('#muestrahojamodal').append(''+response+'').fadeIn("slow");   
      }
  });
}


// FUNCION PARA ACTUALIZAR HOJA EVOLUTIVA
function UpdateHoja(codhoja,modulo) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Hoja Evolutiva?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
        if(modulo == 1){
          location.href = "forhojac?numero="+codhoja;
        } else {
          location.href = "forhojag?numero="+codhoja;
        }
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR HOJA EVOLUTIVA 
function EliminarHoja(codhoja,url,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Hoja Evolutiva?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codhoja="+codhoja+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#hojas').load("consultas?CargaHojas=si&url="+url);
                  
          } else if(data==2){ 

             swal("Oops", "Esta Hoja Evolutiva no puede ser Eliminada, tiene una Apertura Medica relacionada!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Hojas Evolutivas, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}













/////////////////////////////////// FUNCIONES DE REMISIONES //////////////////////////////////////

// FUNCION PARA MOSTRAR REMISION EN VENTANA MODAL
function VerRemision(codremision){

$('#muestraremisionmodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaRemisionesModal=si&numero='+codremision;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
        success: function(response) {            
        $('#muestraremisionmodal').empty();
        $('#muestraremisionmodal').append(''+response+'').fadeIn("slow");   
      }
  });
}


// FUNCION PARA ACTUALIZAR REMISION
function UpdateRemision(codremision,modulo) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Remisión?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
        if(modulo == 1){
          location.href = "forremisionc?numero="+codremision;
        } else {
          location.href = "forremisiong?numero="+codremision;
        }
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR REMISION 
function EliminarRemision(codremision,url,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Remisión?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codremision="+codremision+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#remisiones').load("consultas?CargaRemisiones=si&url="+url);
                  
          } else if(data==2){ 

             swal("Oops", "Esta Remisión no puede ser Eliminada, tiene una Apertura Medica relacionada!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Remisiones, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}













/////////////////////////////////// FUNCIONES DE FORMULAS MEDICAS //////////////////////////////////////

// FUNCION PARA MOSTRAR FORMULA MEDICA EN VENTANA MODAL
function VerFormulaMedica(codformulam){

$('#muestraformulasmedicasmodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaFormulasMedicasModal=si&numero='+codformulam;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
        success: function(response) {            
        $('#muestraformulasmedicasmodal').empty();
        $('#muestraformulasmedicasmodal').append(''+response+'').fadeIn("slow");   
      }
  });
}


// FUNCION PARA ACTUALIZAR FORMULA MEDICA
function UpdateFormulaMedica(codformulam,modulo) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Formula Médica?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
        if(modulo == 1){
          location.href = "forformulamedicac?numero="+codformulam;
        } else {
          location.href = "forformulamedicag?numero="+codformulam;
        }
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR FORMULA MEDICA
function EliminarFormulaMedica(codformulam,url,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Formula Médica?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codformulam="+codformulam+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#formulasmedicas').load("consultas?CargaFormulasMedicas=si&url="+url);
                  
          } else if(data==2){ 

             swal("Oops", "Esta Formula Médica no puede ser Eliminada, tiene una Apertura Medica relacionada!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Formulas Médicas, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}












/////////////////////////////////// FUNCIONES DE ORDENES MEDICAS //////////////////////////////////////

// FUNCION PARA MOSTRAR FORMULA ORDEN EN VENTANA MODAL
function VerOrdenMedica(codorden){

$('#muestraordenesmedicasmodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaOrdenesMedicasModal=si&numero='+codorden;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
        success: function(response) {            
        $('#muestraordenesmedicasmodal').empty();
        $('#muestraordenesmedicasmodal').append(''+response+'').fadeIn("slow");   
      }
  });
}


// FUNCION PARA ACTUALIZAR ORDEN MEDICA
function UpdateOrdenMedica(codorden,modulo) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Orden Médica?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
       if(modulo == 1){
          location.href = "forformulamedicac?numero="+codorden;
       } else {
          location.href = "forformulamedicag?numero="+codorden;
       }
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR ORDEN MEDICA
function EliminarOrdenMedica(codorden,url,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Orden Médica?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codorden="+codorden+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#ordenesmedicas').load("consultas?CargaFormulasMedicas=si&url="+url);
                  
          } else if(data==2){ 

             swal("Oops", "Esta Orden Médica no puede ser Eliminada, tiene una Apertura Medica relacionada!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Ordenes Médicas, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}













/////////////////////////////////// FUNCIONES DE FORMULAS TERAPIAS //////////////////////////////////////

// FUNCION PARA MOSTRAR FORMULAS TERAPIAS EN VENTANA MODAL
function VerFormulaTerapia(codformula){

$('#muestraformulasterapiasmodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaFormulasTerapiasModal=si&numero='+codformula;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
        success: function(response) {            
        $('#muestraformulasterapiasmodal').empty();
        $('#muestraformulasterapiasmodal').append(''+response+'').fadeIn("slow");   
      }
  });
}


// FUNCION PARA ACTUALIZAR FORMULAS TERAPIAS
function UpdateFormulaTerapia(codformula) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Fórmula de Terapia?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forformulaterapia?numero="+codformula;
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR FORMULAS TERAPIAS
function EliminarFormulaTerapia(codformula,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Fórmula de Terapia?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codformula="+codformula+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#formulasterapias').load("consultas?CargaFormulasTerapias=si");
                  
          } else if(data==2){ 

             swal("Oops", "Esta Fórmula de Terapia no puede ser Eliminada, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Fórmulas de Terapias, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}













/////////////////////////////////// FUNCIONES DE SOLICITUD EXAMENES //////////////////////////////////////

// FUNCION PARA MOSTRAR SOLICITUD EXAMENES EN VENTANA MODAL
function VerSolicitudExamen(codexamen){

$('#muestrasolicitudexamenesmodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaSolicitudExamenesModal=si&numero='+codexamen;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
        success: function(response) {            
        $('#muestrasolicitudexamenesmodal').empty();
        $('#muestrasolicitudexamenesmodal').append(''+response+'').fadeIn("slow");   
      }
  });
}


// FUNCION PARA ACTUALIZAR SOLICITUD EXAMENES
function UpdateSolicitudExamen(codexamen) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Solicitud de Examen?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forsolicitudexamen?numero="+codexamen;
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR SOLICITUD EXAMENES
function EliminarSolicitudExamen(codexamen,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Solicitud de Examen?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codexamen="+codexamen+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#solicitudexamenes').load("consultas?CargaSolicitudExamenes=si");
                  
          } else if(data==2){ 

             swal("Oops", "Esta Solicitud de Examen no puede ser Eliminada, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Solicitud de Exámenes, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}

// FUNCION PARA BUSCAR CONSULTORIOS POR FECHAS
function BuscarConsultoriosxFechas() {
                        
$('#muestraconsultoriosxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var url = $("#url").val();
var busqueda = $("input[name='busqueda']:checked").val();
var codsucursal = $("#codsucursal").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#consultoriosxfechas").serialize();
var url = 'funciones.php?BusquedaConsultoriosxFechas=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
        $('#muestraconsultoriosxfechas').empty();
        $('#muestraconsultoriosxfechas').append(''+response+'').fadeIn("slow");
      }
   });
}


// FUNCION PARA BUSCAR CONSULTORIOS POR MEDICO
function BuscarConsultoriosxMedico() {
                        
$('#muestraconsultoriosxmedico').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var url = $("#url").val();
var busqueda = $("input[name='busqueda']:checked").val();
var codsucursal = $("#codsucursal").val();
var codmedico = $("#codmedico").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#consultoriosxmedico").serialize();
var url = 'funciones.php?BusquedaConsultoriosxMedico=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
        $('#muestraconsultoriosxmedico').empty();
        $('#muestraconsultoriosxmedico').append(''+response+'').fadeIn("slow");
      }
   });
}

// FUNCION PARA BUSCAR CONSULTORIOS POR PACIENTE
function BuscarConsultoriosxPaciente() {
                        
$('#muestraconsultoriosxpaciente').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var url = $("#url").val();
var busqueda = $("input[name='busqueda']:checked").val();
var codsucursal = $("#codsucursal").val();
var codpaciente = $("#codpaciente").val();
var dataString = $("#consultoriosxpaciente").serialize();
var url = 'funciones.php?BusquedaConsultoriosxPaciente=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
          $('#muestraconsultoriosxpaciente').empty();
          $('#muestraconsultoriosxpaciente').append(''+response+'').fadeIn("slow");
      }
  });
}














/////////////////////////////////// FUNCIONES DE CRIOCAUTERIZACIONES //////////////////////////////////////

// FUNCION PARA MOSTRAR CRIOCAUTERIZACIONES EN VENTANA MODAL
function VerCriocauterizacion(codcriocauterizacion){

$('#muestracriocauterizacionesmodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaCriocauterizacionModal=si&numero='+codcriocauterizacion;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
        success: function(response) {            
        $('#muestracriocauterizacionesmodal').empty();
        $('#muestracriocauterizacionesmodal').append(''+response+'').fadeIn("slow");   
      }
  });
}


// FUNCION PARA ACTUALIZAR CRIOCAUTERIZACIONES
function UpdateCriocauterizacion(codcriocauterizacion) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Criocauterización?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
          location.href = "forcriocauterizacion?numero="+codcriocauterizacion;
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR CRIOCAUTERIZACIONES 
function EliminarCriocauterizacion(codcriocauterizacion,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Criocauterización?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codcriocauterizacion="+codcriocauterizacion+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#criocauterizaciones').load("consultas?Criocauterizaciones=si");
                  
          } else if(data==2){ 

             swal("Oops", "Esta Criocauterización no puede ser Eliminada, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Criocauterizaciones, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}












/////////////////////////////////// FUNCIONES DE COLPOSCOPIAS //////////////////////////////////////

// FUNCION PARA MOSTRAR COLPOSCOPIA EN VENTANA MODAL
function VerColposcopia(codcolposcopia){

$('#muestracolposcopiamodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaColposcopiasModal=si&numero='+codcolposcopia;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
        success: function(response) {            
        $('#muestracolposcopiamodal').empty();
        $('#muestracolposcopiamodal').append(''+response+'').fadeIn("slow");   
      }
  });
}


// FUNCION PARA ACTUALIZAR COLPOSCOPIA
function UpdateColposcopia(codcolposcopia) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Colposcopia?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forcolposcopia?numero="+codcolposcopia;
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR COLPOSCOPIA 
function EliminarColposcopia(codcolposcopia,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Colposcopia?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codcolposcopia="+codcolposcopia+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#colposcopias').load("consultas?CargaColposcopias=si");
                  
          } else if(data==2){ 

             swal("Oops", "Esta Colposcopia no puede ser Eliminada, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Colposcopias, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}














/////////////////////////////////// FUNCIONES DE ECOGRAFIAS //////////////////////////////////////

////FUNCION CARGAR PLANTILLAS ECOGRAFIAS
function MostrarPlantillasEcograficas(){
  
  $('#muestra_plantillas').load("consultas?BusquedaPlantillasEcograficas=si");
}

// FUNCION PARA ASIGNAR PLANTILLA ECOGRAFIAS
function AsignarEcografia(procedimientoecografia,descripcionecografia) 
{
  // aqui asigno cada valor a los campos correspondientes
  $("#procedimiento").val(procedimientoecografia);
  $("#diagnostico").val(descripcionecografia);
  $("#becografias").val("");
}

// FUNCION PARA MOSTRAR ECOGRAFIA EN VENTANA MODAL
function VerEcografia(codecografia){

$('#muestraecografiamodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaEcografiasModal=si&numero='+codecografia;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
        success: function(response) {            
        $('#muestraecografiamodal').empty();
        $('#muestraecografiamodal').append(''+response+'').fadeIn("slow");   
      }
  });
}


// FUNCION PARA ACTUALIZAR ECOGRAFIA
function UpdateEcografia(codecografia) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Ecografía?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forecografia?numero="+codecografia;
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR ECOGRAFIA 
function EliminarEcografia(codecografia,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Ecografía?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codecografia="+codecografia+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#ecografias').load("consultas?CargaEcografias=si");
                  
          } else if(data==2){ 

             swal("Oops", "Esta Ecografía no puede ser Eliminada, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Ecografías, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}

// FUNCION PARA BUSCAR GINECOLOGIAS POR FECHAS
function BuscarGinecologiasxFechas() {
                        
$('#muestraginecologiasxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var url = $("#url").val();
var busqueda = $("input[name='busqueda']:checked").val();
var codsucursal = $("#codsucursal").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#ginecologiasxfechas").serialize();
var url = 'funciones.php?BusquedaGinecologiasxFechas=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
        $('#muestraginecologiasxfechas').empty();
        $('#muestraginecologiasxfechas').append(''+response+'').fadeIn("slow");
      }
   });
}


// FUNCION PARA BUSCAR GINECOLOGIAS POR MEDICO
function BuscarGinecologiasxMedico() {
                        
$('#muestraginecologiasxmedico').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var url = $("#url").val();
var busqueda = $("input[name='busqueda']:checked").val();
var codsucursal = $("#codsucursal").val();
var codmedico = $("#codmedico").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#ginecologiasxmedico").serialize();
var url = 'funciones.php?BusquedaGinecologiasxMedico=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
        $('#muestraginecologiasxmedico').empty();
        $('#muestraginecologiasxmedico').append(''+response+'').fadeIn("slow");
      }
   });
}

// FUNCION PARA BUSCAR GINECOLOGIAS POR PACIENTE
function BuscarGinecologiasxPaciente() {
                        
$('#muestraginecologiasxpaciente').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var url = $("#url").val();
var busqueda = $("input[name='busqueda']:checked").val();
var codsucursal = $("#codsucursal").val();
var codpaciente = $("#codpaciente").val();
var dataString = $("#ginecologiasxpaciente").serialize();
var url = 'funciones.php?BusquedaGinecologiasxPaciente=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
          $('#muestraginecologiasxpaciente').empty();
          $('#muestraginecologiasxpaciente').append(''+response+'').fadeIn("slow");
      }
  });
}












/////////////////////////////////// FUNCIONES DE LABORATORIO //////////////////////////////////////

// FUNCION PARA BUSCAR LABORATORIOS
function BuscarLaboratorios(){
                        
$('#muestradetalles').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');
                
var search = $("#search_criterio").val();
var dataString = $("#busquedalaboratorios").serialize();
var url = 'consultas.php?CargaLaboratorios=si';

$.ajax({
    type: "GET",
    url: url,
    data: dataString,
      success: function(response) {            
        $('#muestradetalles').empty();
        $('#muestradetalles').append(''+response+'').fadeIn("slow");
      }
  });
}

// FUNCION PARA MOSTRAR LABORATORIO EN VENTANA MODAL
function VerLaboratorio(codlaboratorio){

$('#muestralaboratoriomodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaLaboratoriosModal=si&numero='+codlaboratorio;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
        success: function(response) {            
        $('#muestralaboratoriomodal').empty();
        $('#muestralaboratoriomodal').append(''+response+'').fadeIn("slow");   
      }
  });
}


// FUNCION PARA ACTUALIZAR LABORATORIO
function UpdateLaboratorio(codlaboratorio) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar este Examen de Laboratorio?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forlaboratorio?numero="+codlaboratorio;
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR LABORATORIO 
function EliminarLaboratorio(codlaboratorio,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Examen de Laboratorio?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codlaboratorio="+codlaboratorio+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $("#BotonBusqueda").trigger("click");
            //$('#laboratorios').load("consultas?CargaLaboratorios=si");
                  
          } else if(data==2){ 

             swal("Oops", "Este Examen de Laboratorio no puede ser Eliminado, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Exámenes de Laboratorio, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}


// FUNCION PARA BUSCAR LABORATORIOS POR FECHAS
function BuscarLaboratoriosxFechas() {
                        
$('#muestralaboratoriosxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#laboratoriosxfechas").serialize();
var url = 'funciones.php?BusquedaLaboratoriosxFechas=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
        $('#muestralaboratoriosxfechas').empty();
        $('#muestralaboratoriosxfechas').append(''+response+'').fadeIn("slow");
      }
   });
}


// FUNCION PARA BUSCAR LABORATORIOS POR MEDICO
function BuscarLaboratoriosxMedico() {
                        
$('#muestralaboratoriosxmedico').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var codmedico = $("#codmedico").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#laboratoriosxmedico").serialize();
var url = 'funciones.php?BusquedaLaboratoriosxMedico=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
        $('#muestralaboratoriosxmedico').empty();
        $('#muestralaboratoriosxmedico').append(''+response+'').fadeIn("slow");
      }
   });
}

// FUNCION PARA BUSCAR LABORATORIOS POR PACIENTE
function BuscarLaboratoriosxPaciente() {
                        
$('#muestralaboratoriosxpaciente').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var codpaciente = $("#codpaciente").val();
var dataString = $("#laboratoriosxpaciente").serialize();
var url = 'funciones.php?BusquedaLaboratoriosxPaciente=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
          $('#muestralaboratoriosxpaciente').empty();
          $('#muestralaboratoriosxpaciente').append(''+response+'').fadeIn("slow");
      }
  });
}















/////////////////////////////////// FUNCIONES DE RADIOLOGIAS //////////////////////////////////////

////FUNCION CARGAR PLANTILLAS LECTURA RX
function MostrarPlantillasLecturaRx(){
  
  $('#muestra_plantillas').load("consultas?BusquedaPlantillasLecturasRx=si");
}

// FUNCION PARA ACTIVAR LECTURA RX
function LecturaRx(){

var lectura = $('input:radio[name=lectura]:checked').val();

    if (lectura === '1' || lectura === true) {

    $("#tipoestudio").attr('disabled', false);
    $("#diagnostico").attr('disabled', false);
    $("#BotonPlantilla").attr('disabled', false);
    
    } else {

    $("#tipoestudio").attr('disabled', true);
    $("#diagnostico").attr('disabled', true);
    $("#BotonPlantilla").attr('disabled', true);

    } 
}

// FUNCION PARA ASIGNAR PLANTILLA LECTURA RX
function AsignarLecturaRx(procedimientolecturarx,descripcionlecturarx) 
{
  // aqui asigno cada valor a los campos correspondientes
  $("#tipoestudio").val(procedimientolecturarx);
  $("#diagnostico").val(descripcionlecturarx);
  $("#blecturarx").val("");
}

// FUNCION PARA BUSCAR RADIOLOGIAS
function BuscarRadiologias(){
                        
$('#muestradetalles').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');
                
var search = $("#search_criterio").val();
var dataString = $("#busquedaradiologias").serialize();
var url = 'consultas.php?CargaRadiologias=si';

$.ajax({
    type: "GET",
    url: url,
    data: dataString,
      success: function(response) {            
        $('#muestradetalles').empty();
        $('#muestradetalles').append(''+response+'').fadeIn("slow");
      }
  });
}


// FUNCION PARA MOSTRAR RADIOLOGIAS EN VENTANA MODAL
function VerRadiologia(codradiologia){

$('#muestraradiologiamodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaRadiologiasModal=si&numero='+codradiologia;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
        success: function(response) {            
        $('#muestraradiologiamodal').empty();
        $('#muestraradiologiamodal').append(''+response+'').fadeIn("slow");   
      }
  });
}


// FUNCION PARA ACTUALIZAR RADIOLOGIAS
function UpdateRadiologia(codradiologia) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Lectura Rx de Radiología?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forradiologia?numero="+codradiologia;
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR RADIOLOGIAS 
function EliminarRadiologia(codradiologia,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Lectura Rx de Radiología?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codradiologia="+codradiologia+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $("#BotonBusqueda").trigger("click");
            //$('#radiologias').load("consultas?CargaRadiologias=si");
                  
          } else if(data==2){ 

             swal("Oops", "Esta Lectura Rx de Radiología no puede ser Eliminado, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Lectura Rx de Radiología, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}


// FUNCION PARA BUSCAR RADIOLOGIAS POR FECHAS
function BuscarRadiologiasxFechas() {
                        
$('#muestraradiologiasxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#radiologiasxfechas").serialize();
var url = 'funciones.php?BusquedaRadiologiasxFechas=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
        $('#muestraradiologiasxfechas').empty();
        $('#muestraradiologiasxfechas').append(''+response+'').fadeIn("slow");
      }
   });
}


// FUNCION PARA BUSCAR RADIOLOGIAS POR MEDICO
function BuscarRadiologiasxMedico() {
                        
$('#muestraradiologiasxmedico').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var codmedico = $("#codmedico").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#radiologiasxmedico").serialize();
var url = 'funciones.php?BusquedaRadiologiasxMedico=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
        $('#muestraradiologiasxmedico').empty();
        $('#muestraradiologiasxmedico').append(''+response+'').fadeIn("slow");
      }
   });
}

// FUNCION PARA BUSCAR RADIOLOGIAS POR PACIENTE
function BuscarRadiologiasxPaciente() {
                        
$('#muestraradiologiasxpaciente').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var codpaciente = $("#codpaciente").val();
var dataString = $("#radiologiasxpaciente").serialize();
var url = 'funciones.php?BusquedaRadiologiasxPaciente=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
          $('#muestraradiologiasxpaciente').empty();
          $('#muestraradiologiasxpaciente').append(''+response+'').fadeIn("slow");
      }
  });
}
















/////////////////////////////////// FUNCIONES DE TERAPIAS //////////////////////////////////////

// FUNCION PARA ACTIVAR CICLO TERAPIAS
function CicloTerapia(){

var ciclo = $('input:radio[name=ciclo]:checked').val();

    if (ciclo === '1' || ciclo === true) {

    $("#observaciones").attr('disabled', false);
    
    } else {

    $("#observaciones").attr('disabled', true);

    } 
}

// FUNCION PARA BUSCAR TERAPIAS
function BuscarTerapias(){
                        
$('#muestradetalles').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');
                
var search = $("#search_criterio").val();
var dataString = $("#busquedaterapias").serialize();
var url = 'consultas.php?CargaTerapias=si';

$.ajax({
    type: "GET",
    url: url,
    data: dataString,
      success: function(response) {            
        $('#muestradetalles').empty();
        $('#muestradetalles').append(''+response+'').fadeIn("slow");
      }
  });
}

// FUNCION PARA MOSTRAR TERAPIAS EN VENTANA MODAL
function VerTerapia(codterapia){

$('#muestraterapiamodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaTerapiasModal=si&numero='+codterapia;

$.ajax({
      type: "GET",
      url: "funciones.php",
      data: dataString,
        success: function(response) {            
        $('#muestraterapiamodal').empty();
        $('#muestraterapiamodal').append(''+response+'').fadeIn("slow");   
      }
  });
}


// FUNCION PARA ACTUALIZAR TERAPIAS
function UpdateTerapia(codterapia) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Terapia?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forterapia?numero="+codterapia;
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR CICLO TERAPIAS 
function EliminarCicloTerapia(codterapia,iddetalleterapia,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Actividad de Terapia?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codterapia="+codterapia+"&iddetalleterapia="+iddetalleterapia+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#detalles_terapias').load("funciones?BuscaTablaCicloTerapias=si&numero="+codterapia);

          } else if(data==2){ 

             swal("Oops", "Esta Actividad no puede ser Eliminada, debe de Eliminar la Terapia Completa!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Actividad de Terapias, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}

/////FUNCION PARA ELIMINAR TERAPIAS 
function EliminarTerapia(codterapia,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Terapia?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codterapia="+codterapia+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $("#BotonBusqueda").trigger("click");
            //$('#terapias').load("consultas?CargaTerapias=si");
                  
          } else if(data==2){ 

             swal("Oops", "Esta Terapia no puede ser Eliminado, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Terapia, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}


// FUNCION PARA BUSCAR TERAPIAS POR FECHAS
function BuscarTerapiasxFechas() {
                        
$('#muestraterapiasxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#terapiasxfechas").serialize();
var url = 'funciones.php?BusquedaTerapiasxFechas=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
        $('#muestraterapiasxfechas').empty();
        $('#muestraterapiasxfechas').append(''+response+'').fadeIn("slow");
      }
   });
}


// FUNCION PARA BUSCAR TERAPIAS POR MEDICO
function BuscarTerapiasxMedico() {
                        
$('#muestraterapiasxmedico').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var codmedico = $("#codmedico").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#terapiasxmedico").serialize();
var url = 'funciones.php?BusquedaTerapiasxMedico=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
        $('#muestraterapiasxmedico').empty();
        $('#muestraterapiasxmedico').append(''+response+'').fadeIn("slow");
      }
   });
}

// FUNCION PARA BUSCAR TERAPIAS POR PACIENTE
function BuscarTerapiasxPaciente() {
                        
$('#muestraterapiasxpaciente').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var codpaciente = $("#codpaciente").val();
var dataString = $("#terapiasxpaciente").serialize();
var url = 'funciones.php?BusquedaTerapiasxPaciente=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
          $('#muestraterapiasxpaciente').empty();
          $('#muestraterapiasxpaciente').append(''+response+'').fadeIn("slow");
      }
  });
}



























/////////////////////////////////// FUNCIONES DE ODONTOLOGIA //////////////////////////////////////

//FUNCIONES PARA CARGAR FOTO
function CargaFoto(){
  $("#foto").attr("src","fotos/img.png");
}

//FUNCION PARA SUMAR CPO 1
function SumPiezas(){

  var pieza_1_placa = ($('#pieza_1_placa').val() == "" ? "0" : $('#pieza_1_placa').val());
  var pieza_2_placa = ($('#pieza_2_placa').val() == "" ? "0" : $('#pieza_2_placa').val());
  var pieza_3_placa = ($('#pieza_3_placa').val() == "" ? "0" : $('#pieza_3_placa').val());
  var pieza_4_placa = ($('#pieza_4_placa').val() == "" ? "0" : $('#pieza_4_placa').val());
  var pieza_5_placa = ($('#pieza_5_placa').val() == "" ? "0" : $('#pieza_5_placa').val());
  var pieza_6_placa = ($('#pieza_6_placa').val() == "" ? "0" : $('#pieza_6_placa').val());

  var Placa = parseFloat(pieza_1_placa)+parseFloat(pieza_2_placa)+parseFloat(pieza_3_placa)+parseFloat(pieza_4_placa)+parseFloat(pieza_5_placa)+parseFloat(pieza_6_placa);

  var pieza_1_calculo = ($('#pieza_1_calculo').val() == "" ? "0" : $('#pieza_1_calculo').val());
  var pieza_2_calculo = ($('#pieza_2_calculo').val() == "" ? "0" : $('#pieza_2_calculo').val());
  var pieza_3_calculo = ($('#pieza_3_calculo').val() == "" ? "0" : $('#pieza_3_calculo').val());
  var pieza_4_calculo = ($('#pieza_4_calculo').val() == "" ? "0" : $('#pieza_4_calculo').val());
  var pieza_5_calculo = ($('#pieza_5_calculo').val() == "" ? "0" : $('#pieza_5_calculo').val());
  var pieza_6_calculo = ($('#pieza_6_calculo').val() == "" ? "0" : $('#pieza_6_calculo').val());

  var Calculo = parseFloat(pieza_1_calculo)+parseFloat(pieza_2_calculo)+parseFloat(pieza_3_calculo)+parseFloat(pieza_4_calculo)+parseFloat(pieza_5_calculo)+parseFloat(pieza_6_calculo);

  var pieza_1_gingivitis = ($('#pieza_1_gingivitis').val() == "" ? "0" : $('#pieza_1_gingivitis').val());
  var pieza_2_gingivitis = ($('#pieza_2_gingivitis').val() == "" ? "0" : $('#pieza_2_gingivitis').val());
  var pieza_3_gingivitis = ($('#pieza_3_gingivitis').val() == "" ? "0" : $('#pieza_3_gingivitis').val());
  var pieza_4_gingivitis = ($('#pieza_4_gingivitis').val() == "" ? "0" : $('#pieza_4_gingivitis').val());
  var pieza_5_gingivitis = ($('#pieza_5_gingivitis').val() == "" ? "0" : $('#pieza_5_gingivitis').val());
  var pieza_6_gingivitis = ($('#pieza_6_gingivitis').val() == "" ? "0" : $('#pieza_6_gingivitis').val());

  var Gingivitis = parseFloat(pieza_1_gingivitis)+parseFloat(pieza_2_gingivitis)+parseFloat(pieza_3_gingivitis)+parseFloat(pieza_4_gingivitis)+parseFloat(pieza_5_gingivitis)+parseFloat(pieza_6_gingivitis);

  $("#sum_placa").text(Placa);
  $("#sum_calculo").text(Calculo);
  $("#sum_gingivitis").text(Gingivitis);

}

//FUNCION PARA SUMAR CPO 1
function Cpo_1(){

  var cpo_1_c = ($('#cpo_1_c').val() == "" ? "0" : $('#cpo_1_c').val());
  var cpo_1_p = ($('#cpo_1_p').val() == "" ? "0" : $('#cpo_1_p').val());
  var cpo_1_o = ($('#cpo_1_o').val() == "" ? "0" : $('#cpo_1_o').val());

  var Cpo_1 = parseFloat(cpo_1_c)+parseFloat(cpo_1_p)+parseFloat(cpo_1_o);

  $("#cpo_1").text(Cpo_1);

}

//FUNCION PARA SUMAR CPO 2
function Cpo_2(){

  var cpo_2_c = ($('#cpo_2_c').val() == "" ? "0" : $('#cpo_2_c').val());
  var cpo_2_e = ($('#cpo_2_e').val() == "" ? "0" : $('#cpo_2_e').val());
  var cpo_2_o = ($('#cpo_2_o').val() == "" ? "0" : $('#cpo_2_o').val());

  var Cpo_2 = parseFloat(cpo_2_c)+parseFloat(cpo_2_e)+parseFloat(cpo_2_o);

  $("#cpo_2").text(Cpo_2);

}

/////FUNCION PARA ELIMINAR REFERENCIA EN ODONTOGRAMA 
function EliminarReferencia(codreferencia,codpaciente,paciente,codsucursal,sucursal,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Referencia del Odontograma?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codreferencia="+codreferencia+"&codpaciente="+codpaciente+"&codsucursal="+codsucursal+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $("#divTratamiento").load("funciones.php?BuscaTablaTratamiento=si&codpaciente="+codpaciente+"&codsucursal="+codsucursal);
            cargarDientes('seccionDientes', 'dientes.php', '', codpaciente, codsucursal);

            setTimeout(function() { 
  
            //INICIO PARA REGISTRO DE IMAGEN  
            html2canvas($("#seccionDientes"), {
    
                onrendered: function(canvas) {
                theCanvas = canvas;
                var dataString = $("#odontograma").serialize();
                var imagen = canvas.toDataURL();
                var url = urlBase() + "operacionesOdontograma.php?accion=1";
                var post = "codpaciente=" + paciente +"&codsucursal=" + sucursal +"&img_val=" + imagen;
        
            $.ajax({
                    type: 'POST',
                    url: url,
                    data: post,
                    success: function (msg) {
                    // alert('Imagen guardada correctamente...');
                    //$("#seccionDientes").load("dientes.php"); 
                    }
                }); 
              }
            }); 
            //FIN PARA REGISTRO DE IMAGEN
    
        }, 2000);

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Referencias, no tienes los privilegios dentro del Sistema!", "error"); 

                }
            }
        })
    });
}

// FUNCION PARA BUSCAR ODONTOLOGIAS
function BuscarOdontologias(){
                        
$('#muestradetalles').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');
                
var search = $("#search_criterio").val();
var dataString = $("#busquedaodontologias").serialize();
var url = 'consultas.php?CargaOdontologias=si';

$.ajax({
    type: "GET",
    url: url,
    data: dataString,
      success: function(response) {            
        $('#muestradetalles').empty();
        $('#muestradetalles').append(''+response+'').fadeIn("slow");
      }
  });
}

// FUNCION PARA MOSTRAR ODONTOLOGIA EN VENTANA MODAL
function VerOdontologia(cododontologia){

$('#muestraodontologiamodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaOdontologiaModal=si&numero='+cododontologia;

$.ajax({
        type: "GET",
        url: "funciones.php",
        data: dataString,
          success: function(response) {            
            $('#muestraodontologiamodal').empty();
            $('#muestraodontologiamodal').append(''+response+'').fadeIn("slow");   
      }
  });
}

// FUNCION PARA ACTUALIZAR ODONTOLOGIA
function UpdateOdontologia(cododontologia,codpaciente,codsucursal) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Consulta Odontologica?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forodontologia?numero="+cododontologia;
      //$("#divTratamiento").load("funciones.php?BuscaTablaTratamiento=si&codpaciente="+codpaciente+"&codsucursal="+codsucursal);
      //cargarDientes('seccionDientes', 'dientes.php', '', codpaciente, codsucursal);

      // handle confirm
    } else {
      // handle all other cases
    }
  })
}

// FUNCION PARA ACTUALIZAR ODONTOGRAMA
function UpdateOdontograma(cododontologia,codpaciente,codsucursal) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar las Referencias de Tratamiento del Odontograma?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "odontograma?numero="+cododontologia;
      //$("#divTratamiento").load("funciones.php?BuscaTablaTratamiento=si&codpaciente="+codpaciente+"&codsucursal="+codsucursal);
      //cargarDientes('seccionDientes', 'dientes.php', '', codpaciente, codsucursal);

      // handle confirm
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR ODONTOLOGIA 
function EliminarOdontologia(cododontologia,codpaciente,codsucursal,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Consulta Odontologica?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "cododontologia="+cododontologia+"&codpaciente="+codpaciente+"&codsucursal="+codsucursal+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $("#BotonBusqueda").trigger("click");
            //$('#odontologias').load("consultas?CargaOdontologias=si");
                  
          } else if(data==2){ 

             swal("Oops", "Esta Consulta Odontologica no puede ser Eliminada, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Consulta Odontologicas, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}


// FUNCION PARA BUSCAR ODONTOLOGIAS POR FECHAS
function BuscarOdontologiasxFechas() {
                        
$('#muestraodontologiasxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#odontologiasxfechas").serialize();
var url = 'funciones.php?BusquedaOdontologiasxFechas=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
          $('#muestraodontologiasxfechas').empty();
          $('#muestraodontologiasxfechas').append(''+response+'').fadeIn("slow");
    }
  });
}


// FUNCION PARA BUSCAR ODONTOLOGIAS POR MEDICO
function BuscarOdontologiasxMedico() {
                        
$('#muestraodontologiasxmedico').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var codmedico = $("#codmedico").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#odontologiasxmedico").serialize();
var url = 'funciones.php?BusquedaOdontologiasxMedico=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
          $('#muestraodontologiasxmedico').empty();
          $('#muestraodontologiasxmedico').append(''+response+'').fadeIn("slow");
      }
  });
}


// FUNCION PARA BUSCAR ODONTOLOGIAS POR PACIENTE
function BuscarOdontologiasxPaciente() {
                        
$('#muestraodontologiasxpaciente').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var codpaciente = $("#codpaciente").val();
var dataString = $("#odontologiasxpaciente").serialize();
var url = 'funciones.php?BusquedaOdontologiasxPaciente=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
          $('#muestraodontologiasxpaciente').empty();
          $('#muestraodontologiasxpaciente').append(''+response+'').fadeIn("slow");
      }
  });
}



























/////////////////////////////////// FUNCIONES DE CONSENTIMIENTOS //////////////////////////////////////

// FUNCION PARA BUSCAR CONSENTIMIENTOS POR MEDICO
function ProcesarConsentimiento() {
                        
$('#muestra_detalles').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var codespecialidad = $("#codespecialidad").val();
var codmedico = $("#codmedico").val();
var tipoconsentimiento = $("#tipoconsentimiento").val();
var codpaciente = $("#codpaciente").val();
var dataString = $("#saveconsentimiento").serialize();
var url = 'funciones.php?ProcesarDetalleConsentimiento=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
          $('#muestra_detalles').empty();
          $('#muestra_detalles').append(''+response+'').fadeIn("slow");
      }
  });
}

// FUNCION PARA MOSTRAR ODONTOLOGIA EN VENTANA MODAL
function VerConsentimiento(codconsentimiento){

$('#muestraconsentimientomodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaConsentimientoModal=si&numero='+codconsentimiento;

$.ajax({
        type: "GET",
        url: "funciones.php",
        data: dataString,
          success: function(response) {            
            $('#muestraconsentimientomodal').empty();
            $('#muestraconsentimientomodal').append(''+response+'').fadeIn("slow");   
      }
  });
}

// FUNCION PARA ACTUALIZAR ODONTOLOGIA
function UpdateConsentimiento(codconsentimiento,codpaciente,codsucursal) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar este Consentimiento Informado?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forconsentimiento?numero="+codconsentimiento;

      // handle confirm
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR ODONTOLOGIA 
function EliminarConsentimiento(codconsentimiento,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Consentimiento Informado?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codconsentimiento="+codconsentimiento+"&tipo="+tipo,
                  success: function(data){

         if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#consentimientos').load("consultas?CargaConsentimientos=si");
                  
          } else if(data==2){ 

             swal("Oops", "Esta Consentimiento Informado no puede ser Eliminad0, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Consentimientos Informados, no tienes Privilegios para ejecutar esta Acción!", "error"); 

                }
            }
        })
    });
}


// FUNCION PARA BUSCAR CONSENTIMIENTOS POR FECHAS
function BuscarConsentimientosxFechas() {
                        
$('#muestraconsentimientosxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#consentimientosxfechas").serialize();
var url = 'funciones.php?BusquedaConsentimientosxFechas=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
          $('#muestraconsentimientosxfechas').empty();
          $('#muestraconsentimientosxfechas').append(''+response+'').fadeIn("slow");
    }
  });
}


// FUNCION PARA BUSCAR CONSENTIMIENTOS POR MEDICO
function BuscarConsentimientosxMedico() {
                        
$('#muestraconsentimientosxmedico').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var codmedico = $("#codmedico").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#consentimientosxmedico").serialize();
var url = 'funciones.php?BusquedaConsentimientosxMedico=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
          $('#muestraconsentimientosxmedico').empty();
          $('#muestraconsentimientosxmedico').append(''+response+'').fadeIn("slow");
      }
  });
}


// FUNCION PARA BUSCAR CONSENTIMIENTOS POR PACIENTE
function BuscarConsentimientosxPaciente() {
                        
$('#muestraconsentimientosxpaciente').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var codsucursal = $("#codsucursal").val();
var codpaciente = $("#codpaciente").val();
var dataString = $("#consentimientosxpaciente").serialize();
var url = 'funciones.php?BusquedaConsentimientosxPaciente=si';

$.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(response) {            
          $('#muestraconsentimientosxpaciente').empty();
          $('#muestraconsentimientosxpaciente').append(''+response+'').fadeIn("slow");
      }
  });
}