/*Author: Ing. Christian Gonzales R. Tlf: +51 950165669, email: christiangonzalescio@gmail.com

/* FUNCION JQUERY PARA VALIDAR ACCESO DE USUARIOS*/
$('document').ready(function()
{ 
	$("#formlogin").validate({
	rules:
		{
		     usuario: { required: true, },
			password: { required: true, },
		},
	     messages:
		{
			usuario:{ required: "Ingrese su Usuario" },
		     password:{ required: "Ingrese su Password" },
	     },
	     errorElement: "span",
	     submitHandler: function(form) {
                     		
		var data = $("#formlogin").serialize();
			
		$.ajax({
		type : 'POST',
		url  : 'index.php',
		async : false,
		data : data,
		beforeSend: function()
		{	
			$("#login").fadeOut(1000);
			
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
	        $("#btn-login").attr('disabled', true);
	     },
		success :  function(response)
		          {						
				if(response==1){ 
							 
			$("#login").fadeIn(1000, function(){ 
		
		var n = noty({
          text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
          heme: 'defaultTheme',
          layout: 'center',
          type: 'error',
          timeout: 5000, });
          $("#btn-login").attr('disabled', false);
			    
				     });
                    } 
                    else if(response==2){
								 
			$("#login").fadeIn(1000, function(){
		
		var n = noty({
          text: "<span class='fa fa-warning'></span> LOS DATOS INGRESADOS NO EXISTEN, VERIFIQUE NUEVAMENTE POR FAVOR...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'error',
          timeout: 5000, });
          $("#btn-login").attr('disabled', false);
			 
			          });
		   
				} 
				else if(response==3){
								 
			$("#login").fadeIn(1000, function(){
		
		var n = noty({
          text: "<span class='fa fa-warning'></span> ESTE USUARIO SE ENCUENTRA ACTUALMENTE INACTIVO, VERIFIQUE NUEVAMENTE POR FAVOR...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'error',
          timeout: 5000, });
          $("#btn-login").attr('disabled', false);
			 
			        });  
				} 
				else if(response==4){
								 
			$("#login").fadeIn(1000, function(){
		
		var n = noty({
          text: "<span class='fa fa-warning'></span> EL PASSWORD INGRESADO ES ERRONEO, VERIFIQUE NUEVAMENTE POR FAVOR...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'error',
          timeout: 5000, });
          $("#btn-login").attr('disabled', false);
			 
			         });  
				} 
				else {
								  
			$("#login").fadeIn(1000, function(){
			
          $("#btn-login").attr('disabled', false);
		setTimeout(' window.location.href = "panel"; ',500);
				 
				         });  
					}
			     }
		     });
			return false;
	     }
	    /* login submit */
    }); 
});
/* FUNCION JQUERY PARA VALIDAR ACCESO DE USUARIOS*/


/* FUNCION JQUERY PARA VALIDAR ACCESO DE USUARIOS*/
$('document').ready(function()
{ 
	$("#lockscreen").validate({
	rules:
		{
		     usuario: { required: true, },
			password: { required: true, },
		},
	     messages:
		{
			usuario:{ required: "Ingrese su Usuario" },
		     password:{ required: "Ingrese su Password" },
	     },
	     errorElement: "span",
	     submitHandler: function(form) {
                     		
		var data = $("#lockscreen").serialize();
			
		$.ajax({
		type : 'POST',
		url  : 'lockscreen.php',
		async : false,
		data : data,
		beforeSend: function()
		{	
			$("#login").fadeOut(1000);
			
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
	        $("#btn-login").attr('disabled', true);
	     },
		success :  function(response)
		          {						
				if(response==1){ 
							 
			$("#login").fadeIn(1000, function(){ 
		
		var n = noty({
          text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
          heme: 'defaultTheme',
          layout: 'center',
          type: 'error',
          timeout: 5000, });
          $("#btn-login").attr('disabled', false);
			    
				     });
                    } 
                    else if(response==2){
								 
			$("#login").fadeIn(1000, function(){
		
		var n = noty({
          text: "<span class='fa fa-warning'></span> LOS DATOS INGRESADOS NO EXISTEN, VERIFIQUE NUEVAMENTE POR FAVOR...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'error',
          timeout: 5000, });
          $("#btn-login").attr('disabled', false);
			 
			          });
		   
				} 
				else if(response==3){
								 
			$("#login").fadeIn(1000, function(){
		
		var n = noty({
          text: "<span class='fa fa-warning'></span> ESTE USUARIO SE ENCUENTRA ACTUALMENTE INACTIVO, VERIFIQUE NUEVAMENTE POR FAVOR...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'error',
          timeout: 5000, });
          $("#btn-login").attr('disabled', false);
			 
			        });  
				} 
				else if(response==4){
								 
			$("#login").fadeIn(1000, function(){
		
		var n = noty({
          text: "<span class='fa fa-warning'></span> EL PASSWORD INGRESADO ES ERRONEO, VERIFIQUE NUEVAMENTE POR FAVOR...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'error',
          timeout: 5000, });
          $("#btn-login").attr('disabled', false);
			 
			         });  
				} 
				else {
								  
			$("#login").fadeIn(1000, function(){
			
          $("#btn-login").attr('disabled', false);
		setTimeout(' window.location.href = "panel"; ',500);
				 
				         });  
					}
			     }
		     });
			return false;
	     }
	    /* login submit */
    }); 
});
/* FUNCION JQUERY PARA VALIDAR ACCESO DE USUARIOS*/



/* FUNCION JQUERY PARA RECUPERAR CONTRASEÑA DE USUARIOS */	 
$('document').ready(function()
{ 
     /* validation */
	$("#formrecover").validate({
          rules:
	     {
			email: { required: true,  email: true  },
			tipo: { required: true },
	     },
          messages:
 	     {
			email:{ required: "Ingrese su Correo Electronico", email: "Ingrese un Correo Electronico Valido" },
			tipo:{ required: "Seleccione Tipo Ingreso" },
          },
	     errorElement: "span",
	     submitHandler: function(form) {
                     		
		var data = $("#formrecover").serialize();
		
		$.ajax({
		type : 'POST',
		url  : 'pass_recovery.php',
	     async : false,
		data : data,
		beforeSend: function()
		{	
			$("#recover").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
	          $("#btn-recuperar").attr('disabled', true);
		},
		success : function(data)
			     {						
			     if(data==1){
							
			$("#recover").fadeIn(1000, function(){ 
	
		var n = noty({
          text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'error',
          timeout: 5000, });
          $("#btn-recuperar").attr('disabled', false);
		    
			          });																			
			     }
			     else if(data==2) {
							
			$("#recover").fadeIn(1000, function(){ 
	
		var n = noty({
          text: "<span class='fa fa-warning'></span> EL CORREO INGRESADO NO FUE ENCONTRADO ACTUALMENTE, VERIFIQUE NUEVAMENTE POR FAVOR...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'error',
          timeout: 5000, });
          $("#btn-recuperar").attr('disabled', false);
		    
				    });
				}
				else if(data==3) {
							
			$("#recover").fadeIn(1000, function(){ 
	
		var n = noty({
          text: "<span class='fa fa-warning'></span> LA NUEVA CLAVE DE ACCESO NO PUDO SER ENVIADA A SU CORREO, OCURRIO UN ERROR AL CONECTAR CON EL PROVEEDOR DE CORREO, INTENTE NUEVAMENTE POR FAVOR...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'error',
          timeout: 5000, });
          $("#btn-recuperar").attr('disabled', false);
		    
				    });
				
				} else {
								
			$("#recover").fadeIn(1000, function(){
								
		$("#formrecover")[0].reset();
		var n = noty({
		text: '<center> &nbsp; '+data+' </center>',
          theme: 'defaultTheme',
          layout: 'center',
          type: 'information',
          timeout: 5000, });
          $("#btn-recuperar").attr('disabled', false);
			                                
						});
					}
				}
			});
		     return false;
		}
	     /* form submit */
     }); 
});
/*  FIN DE FUNCION PARA RECUPERAR CONTRASEÑA DE USUARIOS */
 
 
/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONTRASEÑA */	 
$('document').ready(function()
{ 						
     /* validation */
	$("#updatepassword").validate({
          rules:
	     {
			usuario: {required: true },
			password: {required: true, minlength: 8},  
               password2:   {required: true, minlength: 8, equalTo: "#password"}, 
	     },
          messages:
	     {
               usuario:{ required: "Ingrese Usuario de Acceso" },
               password:{ required: "Ingrese su Nuevo Password", minlength: "Ingrese 8 caracteres como minimo" },
		     password2:{ required: "Repita su Nuevo Password", minlength: "Ingrese 8 caracteres como minimo", equalTo: "Este Password no coincide" },
          },
	     errorElement: "span",
	     submitHandler: function(form) {
                     		
			var data = $("#updatepassword").serialize();
			var id= $("#updatepassword").attr("data-id");
	          var codigo = id;
			
			$.ajax({
			type : 'POST',
			url  : 'password.php?codigo='+codigo,
		     async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
		          $("#btn-update").attr('disabled', true);
			},
			success : function(data)
					{						
					if(data==1){
								
				$("#save").fadeIn(1000, function(){ 
		
			var n = noty({
               text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
               theme: 'defaultTheme',
               layout: 'center',
               type: 'error',
               timeout: 5000, });
		     $("#btn-update").attr('disabled', false);
			    
				        });									
				     }
				    else if(data==2){
								
				$("#save").fadeIn(1000, function(){ 
		
			var n = noty({
               text: "<span class='fa fa-warning'></span> NO PUEDE USAR LA CLAVE ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
               theme: 'defaultTheme',
               layout: 'center',
               type: 'error',
               timeout: 5000, });
		     $("#btn-update").attr('disabled', false);
			    
				        });
				
				     } else {
									
				$("#save").fadeIn(1000, function(){
									
			$("#updatepassword")[0].reset();
			var n = noty({
			text: '<center> '+data+' </center>',
               theme: 'defaultTheme',
               layout: 'center',
               type: 'information',
               timeout: 5000, });
		     $("#btn-update").attr('disabled', false);
			setTimeout(' window.location.href = "logout"; ',5000);
			 
						});									
					}
			     }
			});
			return false;
		}
	     /* form submit */
     }); 
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONTRASEÑA */


















/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONFIGURACION GENERAL */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#configuracion").validate({
      rules:
	  {
			documsucursal: { required: true },
			cuitsucursal: { required: true, digits: false},
			nomsucursal: { required: true },
			tlfsucursal: { required: true,  digits : false },
			correosucursal: { required: true,  email : true },
			idprovincia: { required: false },
			idcanton: { required: false },
			idparroquia: { required: false },
			direcsucursal: { required: true },
			documencargado: { required: true },
			dniencargado: { required: true, number: true },
			nomencargado: { required: true, lettersonly: true },
			tlfencargado: { required: true,  digits : false },

	   },
       messages:
	   {
            documsucursal:{ required: "Seleccione Tipo de Documento" },
            cuitsucursal:{ required: "Ingrese N&deg; de Sucursal", digits: "Ingrese solo digitos para N&deg; de Sucursal" },
			nomsucursal:{ required: "Ingrese Raz&oacute;n Social" },
			tlfsucursal: { required: "Ingrese N&deg; de Tel&eacute;fono", digits: "Ingrese solo digitos para Tel&eacute;fono" },
			correosucursal: { required: "Ingrese Correo Electronico", email: "Ingrese un Correo v&aacute;lido" },
			idprovincia:{ required: "Seleccione Provincia" },
			idcanton:{ required: "Seleccione Canton" },
			idparroquia:{ required: "Seleccione Parroquia" },
			direcsucursal: { required: "Ingrese Direcci&oacute;n" },
			documencargado:{ required: "Seleccione Tipo de Documento" },
            dniencargado: { required: "Ingrese N&deg; de Documento", number: "Ingrese solo numeros" },
			nomencargado:{ required: "Ingrese Nombre de Encargado", lettersonly: "Ingrese solo letras para Nombres" },
			tlfencargado: { required: "Ingrese N&deg; de Tel&eacute;fono", digits: "Ingrese solo digitos para Tel&eacute;fono" },
       },
	   errorElement: "span",
	   submitHandler: function(form) {
                     		
			var data = $("#configuracion").serialize();
			var formData = new FormData($("#configuracion")[0]);
			
			$.ajax({
			type : 'POST',
			url  : 'configuracion.php',
		    async : false,
			data : formData,
			//necesario para subir archivos via ajax
            cache: false,
			contentType: false,
			processData: false,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
		        $("#btn-update").attr('disabled', true);
			},
			success :  function(data)
					{						
					if(data==1){
								
					$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'error',
             timeout: 5000, });
		    $("#btn-update").attr('disabled', false);
			 
			     }); 
																			
				} else { 
							     
					$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'success',
             timeout: 5000, });
		    $("#btn-update").attr('disabled', false);
			                                
						});
					}
				}
		    });
		  return false;
	  }
	  /* form submit */	 
    });   
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONFIGURACION GENERAL */
 
















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE USUARIOS */	 
$('document').ready(function()
{ 
        jQuery.validator.addMethod("lettersonly", function(value, element) {
          return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ,. ]+$/i.test(value);
        });

     /* validation */
	 $("#saveusuario").validate({
      rules:
	  {
			documusuario: { required: true },
			dni: { required: true,  digits : true, minlength: 7 },
			nombres: { required: true, lettersonly: true },
			sexo: { required: true, },
			telefono: { required: true, },
			celular: { required: true, },
			idprovincia: { required: false },
			idcanton: { required: false },
			idparroquia: { required: false },
			direccion: { required: true, },
			email: { required: true, email: true },
			mps: { required: false },
			codespecialidad: { required: false },
			fnacimiento: { required: false,  date : false },
			usuario: { required: true, },
			password: {required: true, minlength: 8},  
            password2:   {required: true, minlength: 8, equalTo: "#password"}, 
			nivel: { required: true, },
			status: { required: true, },
	   },
       messages:
	   {
            documusuario:{ required: "Seleccione Tipo de Documento" },
            dni:{ required: "Ingrese N&deg; de Documento", digits: "Ingrese solo d&iacute;gitos para N&deg; de Documento", minlength: "Ingrese 7 d&iacute;gitos como m&iacute;nimo" },
			nombres:{ required: "Ingrese Nombres y Apellidos", lettersonly: "Ingrese solo letras para Nombre y Apellidos" },
            sexo:{ required: "Seleccione Sexo" },
            telefono:{ required: "Ingrese N&deg; de Tel&eacute;fono" },
            celular:{ required: "Ingrese N&deg; de Celular" },
            idprovincia:{ required: "Seleccione Provincia" },
			idcanton:{ required: "Seleccione Canton" },
			idparroquia:{ required: "Seleccione Parroquia" },
			direccion:{ required: "Ingrese Direcci&oacute;n Domiciliaria" },
			email:{ required: "Ingrese Correo Electronico", email: "Ingrese un Email V&aacute;lido" },
			mps: { required: "Ingrese N&deg; de MPS" },
			codespecialidad:{ required: "Seleccione Especialidad" },
			fnacimiento: { required: "Ingrese Fecha de Nacimiento", date: "Ingrese Fecha Valida" },
			usuario:{ required: "Ingrese Usuario de Acceso" },
			password:{ required: "Ingrese Password de Acceso", minlength: "Ingrese 8 caracteres como m&iacute;nimo" },
		    password2:{ required: "Repita Password de Acceso", minlength: "Ingrese 8 caracteres como m&iacute;nimo", equalTo: "Este Password no coincide" },
			nivel:{ required: "Seleccione Nivel de Acceso" },
			status:{ required: "Seleccione Status de Acceso" },
       },
	   errorElement: "span",
	   submitHandler: function(form) {
                     		
		var data = $("#saveusuario").serialize();
		var formData = new FormData($("#saveusuario")[0]);
		
		$.ajax({
		type : 'POST',
		url  : 'usuarios.php',
	    async : false,
		data : formData,
		//necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
		    $("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
				   {						
						if(data==1){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-submit").attr('disabled', false);
								
							});
						}    
						else if(data==2){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> YA EXISTE UN USUARIO CON ESTE N&deg; DE DOCUMENTO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		 $("#btn-submit").attr('disabled', false);
																		
							});
						}
						else if(data==3){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> ESTE CORREO ELECTR&Oacute;NICO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-submit").attr('disabled', false);
									
							});
						}
						else if(data==4)
						{
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> ESTE USUARIO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		 $("#btn-submit").attr('disabled', false);

							});
						}
						else{
								
			$("#save").fadeIn(1000, function(){
								
		 var n = noty({
		 text: '<center> '+data+' </center>',
         theme: 'defaultTheme',
         layout: 'center',
         type: 'information',
         timeout: 5000, });
         $('body').removeClass('modal-open');
         $('#myModalUsuario').modal('hide');
		 $("#saveusuario")[0].reset();
         $("#proceso").val("save");	
		 $('#codusuario').val("");
		 $("#btn-submit").attr('disabled', false);
		 $('#idcanton').html("<option value=''>-- SIN RESULTADOS --</option>");
		 $('#idparroquia').html("<option value=''>-- SIN RESULTADOS --</option>");
		 $('#muestrasucursales').load("funciones?MuestraSucursales=si");
		 $('#usuarios').html("");
		 $('#usuarios').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
		 setTimeout(function() {
		 	$('#usuarios').load("consultas?CargaUsuarios=si");
		 }, 200);

							});
						}
				   }
		});
		return false;
		}
	   /* form submit */
    }); 	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE USUARIOS */




















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE PROVINCIAS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#saveprovincia").validate({
      rules:
	  {
			provincia: { required: true, },
	   },
       messages:
	   {
            provincia:{ required: "Ingrese Nombre de Provincia" },
       },
	   errorElement: "span",
	   submitHandler: function(form) {
                     		
			var data = $("#saveprovincia").serialize();
			
			$.ajax({
			type : 'POST',
			url  : 'provincias.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
		        $("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> YA EXISTE ESTE NOMBRE DE PROVINCIA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
																			
								});
							}
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
			 $("#saveprovincia")[0].reset();
             $("#proceso").val("save");	
			 $('#idprovincia').val("");	
			 $('#provincias').html("");
		     $("#btn-submit").attr('disabled', false);
			 $('#provincias').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
			 setTimeout(function() {
			 	$('#provincias').load("consultas?CargaProvincias=si");
			 }, 200);
									
						});
				    }
			    }
			});
			return false;
		}
	   /* form submit */
    }); 	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE PROVINCIAS */


















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE CANTONES */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#savecanton").validate({
      rules:
	  {
			canton: { required: true, },
			idprovincia: { required: true, },
	   },
       messages:
	   {
            canton:{ required: "Ingrese Nombre de Canton"},
            idprovincia:{ required: "Seleccione Provincia"},
       },
	   errorElement: "span",
	   submitHandler: function(form) {
                     		
			var data = $("#savecanton").serialize();
			
			$.ajax({
			type : 'POST',
			url  : 'cantones.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> YA EXISTE ESTE CANTON PARA LA PROVINCIA SELECCIONADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-submit").attr('disabled', false);
																			
								});
							}
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
			 $("#savecanton")[0].reset();
             $("#proceso").val("save");	
			 $('#idcanton').val("");
			 $('#cantones').html("");
			 $("#btn-submit").attr('disabled', false);
			 $('#cantones').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
			 setTimeout(function() {
			 	$('#cantones').load("consultas?CargaCantones=si");
			 }, 200);
									
								});
							}
					   }
			});
			return false;
		}
	   /* form submit */
    }); 	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE CANTONES */



















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE PARROQUIAS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#saveparroquia").validate({
      rules:
	  {
			parroquia: { required: true, },
			idcanton: { required: true, },
	   },
       messages:
	   {
            parroquia:{ required: "Ingrese Nombre de Parroquia"},
            idcanton:{ required: "Seleccione Canton"},
       },
	   errorElement: "span",
	   submitHandler: function(form) {
                     		
			var data = $("#saveparroquia").serialize();
			
			$.ajax({
			type : 'POST',
			url  : 'parroquias.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> YA EXISTE ESTA PARROQUIA PARA EL CANTON SELECCIONADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-submit").attr('disabled', false);
																			
								});
							}
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
			 $("#saveparroquia")[0].reset();
             $("#proceso").val("save");	
			 $('#idparroquia').val("");
			 $('#parroquias').html("");
			 $("#btn-submit").attr('disabled', false);
			 $('#parroquias').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
			 setTimeout(function() {
			 	$('#parroquias').load("consultas?CargaParroquias=si");
			 }, 200);
									
								});
							}
					   }
			});
			return false;
		}
	   /* form submit */
    }); 	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE PARROQUIAS */
















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE TIPOS DE DOCUMENTOS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#savedocumento").validate({
      rules:
	  {
			documento: { required: true, },
			descripcion: { required: true, },
	   },
       messages:
	   {
			documento:{ required: "Ingrese Nombre de Documento" },
            descripcion:{ required: "Ingrese Descripci&oacute;n de Documento" },
       },
	   errorElement: "span",
	   submitHandler: function(form) {
                     		
			var data = $("#savedocumento").serialize();
			
			$.ajax({
			type : 'POST',
			url  : 'documentos.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ESTE NOMBRE DE DOCUMENTO YA EXISTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-submit").attr('disabled', false);
																			
								});
							}
							 else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalDocumento').modal('hide');
			 $("#savedocumento")[0].reset();
             $("#proceso").val("save");
			 $('#coddocumento').val("");
			 $('#documentos').html("");	
			 $("#btn-submit").attr('disabled', false);
			 $('#documentos').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
             setTimeout(function() {
             $('#documentos').load("consultas?CargaDocumentos=si");
             }, 200);
									
								});
							}
					   }
			});
			return false;
		}
	   /* form submit */	
    });    
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE TIPOS DE DOCUMENTOS */












/* FUNCION JQUERY PARA VALIDAR REGISTRO DE SEGUROS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#saveseguro").validate({
      rules:
	  {
			nomseguro: { required: true, },
			direcseguro: { required: true, },
			tlfseguro1: { required: true, },
			tlfseguro2: { required: false, },
	   },
       messages:
	   {
			nomseguro:{ required: "Ingrese Nombre de Seguro" },
            direcseguro:{ required: "Ingrese Direcci&oacute;n de Seguro" },
            tlfseguro1:{ required: "Ingrese Nº de Telefono #1" },
            tlfseguro2:{ required: "Ingrese Nº de Telefono #2" },
       },
	   errorElement: "span",
	   submitHandler: function(form) {
                     		
			var data = $("#saveseguro").serialize();
			
			$.ajax({
			type : 'POST',
			url  : 'seguros.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ESTE NOMBRE DE DOCUMENTO YA EXISTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-submit").attr('disabled', false);
																			
								});
							}
							 else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalSeguro').modal('hide');
			 $("#saveseguro")[0].reset();
             $("#proceso").val("save");
			 $('#codseguro').val("");
			 $('#seguros').html("");
			 $("#btn-submit").attr('disabled', false);	
			 $('#seguros').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
             setTimeout(function() {
             $('#seguros').load("consultas?CargaSeguros=si");
             }, 200);
									
								});
							}
					   }
			});
			return false;
		}
	   /* form submit */	
    });    
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE SEGUROS */


















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE ESPECIALIDADES */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#saveespecialidad").validate({
      rules:
	  {
			codespecialidad: { required: true, },
			nomespecialidad: { required: true, },
	   },
       messages:
	   {
			codespecialidad:{ required: "Ingrese Codigo de Especialidad" },
            nomespecialidad:{ required: "Ingrese Nombre de Especialidad" },
       },
	   errorElement: "span",
	   submitHandler: function(form) {
                     		
			var data = $("#saveespecialidad").serialize();
			
			$.ajax({
			type : 'POST',
			url  : 'especialidades.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ESTE NOMBRE DE ESPECIALIDAD YA EXISTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-submit").attr('disabled', false);
																			
								});
							}
							 else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalEspecialidad').modal('hide');
			 $("#saveespecialidad")[0].reset();
             $("#proceso").val("save");
			 $('#codespecialidad').val("");
			 $('#especialidades').html("");	
			 $("#btn-submit").attr('disabled', false);
			 $('#especialidades').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
             setTimeout(function() {
             $('#especialidades').load("consultas?CargaEspecialidades=si");
             }, 200);
									
								});
							}
					   }
			});
			return false;
		}
	   /* form submit */	
    });    
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE ESPECIALIDADES */






















/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE VALORES EXAMENES */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updatevaloresexamenes").validate({
        rules:
	    {
			hematocritov: { required: true, },
			hemoglobinav: { required: true, },
			leucocitosv: { required: true, },
			neutrofilosv: { required: true, },
			linfocitosv: { required: true, },
			eosinofilosv: { required: true, },
			monositosv: { required: true, },
			basofilosv: { required: true, },
			cayadosv: { required: true, },
			plaquetasv: { required: true, },
			reticulositosv: { required: true, },
			vsgv: { required: true, },
			ptv: { required: true, },
			pttv: { required: true, },
			glucosav: { required: true, },
			colesteroltotalv: { required: true, },
			colesterolhdlv: { required: true, },
			colesterolldlv: { required: true, },
			trigliceridosv: { required: true, },
			acidouricov: { required: true, },
			nitrogenoureicov: { required: true, },
			creatininav: { required: true, },
			proteinastotalesv: { required: true, },
			albuminav: { required: true, },
			globulinav: { required: true, },
			bilirrubinatotalv: { required: true, },
			bilirrubinadirectav: { required: true, },
			bilirrubinaindirectav: { required: true, },
			fosfatasaalcalinav: { required: true, },
			tgov: { required: true, },
			tgpv: { required: true, },
			amilasav: { required: true, },
	    },
        messages:
	    {
            hematocritov:{ required: "Ingrese Valor normal" },
			hemoglobinav: { required: "Ingrese Valor normal" },
			leucocitosv: { required: "Ingrese Valor normal" },
			neutrofilosv: { required: "Ingrese Valor normal" },
			linfocitosv: { required: "Ingrese Valor normal" },
			eosinofilosv: { required: "Ingrese Valor normal" },
			monositosv: { required: "Ingrese Valor normal" },
			basofilosv: { required: "Ingrese Valor normal" },
			cayadosv: { required: "Ingrese Valor normal" },
			plaquetasv: { required: "Ingrese Valor normal" },
			reticulositosv: { required: "Ingrese Valor normal" },
			vsgv: { required: "Ingrese Valor normal" },
			ptv: { required: "Ingrese Valor normal" },
			pttv: { required: "Ingrese Valor normal" },
			glucosav: { required: "Ingrese Valor normal" },
			colesteroltotalv: { required: "Ingrese Valor normal" },
			colesterolhdlv: { required: "Ingrese Valor normal" },
			colesterolldlv: { required: "Ingrese Valor normal" },
			trigliceridosv: { required: "Ingrese Valor normal" },
			acidouricov: { required: "Ingrese Valor normal" },
			nitrogenoureicov: { required: "Ingrese Valor normal" },
			creatininav: { required: "Ingrese Valor normal" },
			proteinastotalesv: { required: "Ingrese Valor normal" },
			albuminav: { required: "Ingrese Valor normal" },
			globulinav: { required: "Ingrese Valor normal" },
			bilirrubinatotalv: { required: "Ingrese Valor normal" },
			bilirrubinadirectav: { required: "Ingrese Valor normal" },
			bilirrubinaindirectav: { required: "Ingrese Valor normal" },
			fosfatasaalcalinav: { required: "Ingrese Valor normal" },
			tgov: { required: "Ingrese Valor normal" },
			tgpv: { required: "Ingrese Valor normal" },
			amilasav: { required: "Ingrese Valor normal" },
        },
	    errorElement: "span",
	    submitHandler: function(form) {
                     		
			var data = $("#updatevaloresexamenes").serialize();
			var formData = new FormData($("#updatevaloresexamenes")[0]);
			
			$.ajax({
			type : 'POST',
			url  : 'valores.php',
		    async : false,
			data : formData,
			//necesario para subir archivos via ajax
            cache: false,
			contentType: false,
			processData: false,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
		        $("#btn-update").attr('disabled', true);
			},
			success :  function(data)
					{						
					if(data==1){
								
					$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'error',
             timeout: 5000, });
		    $("#btn-update").attr('disabled', false);
			 
			     }); 
																			
				} else { 
							     
					$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'success',
             timeout: 5000, });
		    $("#btn-update").attr('disabled', false);
			                                
						});
					}
				}
		    });
		  return false;
	  }
	  /* form submit */	 
    });   
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION VALORES EXAMENES */





















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE SUCURSALES */	 
$('document').ready(function()
{ 
        jQuery.validator.addMethod("lettersonly", function(value, element) {
          return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ,. ]+$/i.test(value);
        });

        /* validation */
	    $("#savesucursal").validate({
        rules:
	    {
			documsucursal: { required: true },
			cuitsucursal: { required: true, digits: false },
			nomsucursal: { required: true },
			idprovincia: { required: true },
			idcanton: { required: true },
			idparroquia: { required: true },
			direcsucursal: { required: true },
			correosucursal: { required: true,  email : true },
			tlfsucursal: { required: true,  digits : false },
			documencargado: { required: true },
			dniencargado: { required: true, number: true },
			nomencargado: { required: true, lettersonly: true },
			tlfencargado: { required: false,  digits : false },
	    },
        messages:
	    {
			documsucursal:{ required: "Seleccione Tipo de Documento" },
            cuitsucursal:{ required: "Ingrese N&deg; de Sucursal", digits: "Ingrese solo digitos para N&deg; de Documento" },
			nomsucursal:{ required: "Ingrese Raz&oacute;n Social" },
			idprovincia:{ required: "Seleccione Provincia" },
			idcanton:{ required: "Seleccione Canton" },
			idparroquia:{ required: "Seleccione Parroquia" },
			direcsucursal: { required: "Ingrese Direcci&oacute;n" },
			correosucursal: { required: "Ingrese Correo Electr&oacute;nico", email: "Ingrese un Correo v&aacute;lido" },
			tlfsucursal: { required: "Ingrese N&deg; de Tel&eacute;fono", digits: "Ingrese solo digitos para Tel&eacute;fono" },
			documencargado:{ required: "Seleccione Tipo de Documento" },
			dniencargado: { required: "Ingrese N&deg; de Documento", number: "Ingrese solo numeros para N&deg de Documento" },
			nomencargado:{ required: "Ingrese Nombre de Encargado", lettersonly: "Ingrese solo letras para Nombres" },
			tlfencargado: { required: "Ingrese N&deg; de Tel&eacute;fono", digits: "Ingrese solo digitos para Tel&eacute;fono" },
			
       },
	   errorElement: "span",
	   submitHandler: function(form) {
	   			
		var data = $("#savesucursal").serialize();
		var formData = new FormData($("#savesucursal")[0]);
		
		$.ajax({
		type : 'POST',
		url  : 'sucursales.php',
	    async : false,
		data : formData,
		//necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
				   {						
						if(data==1){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000 });
         $("#btn-submit").attr('disabled', false);
								
							});
						} 
						else if(data==2){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> ESTE CORREO ELECTR&Oacute;NICO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000 });
         $("#btn-submit").attr('disabled', false);
									
							});
						}
						else if(data==3){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> YA EXISTE UNA SUCURSAL CON ESTE N&deg; DE DOCUMENTO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000 });
         $("#btn-submit").attr('disabled', false);
																		
							});
						}
						else{
								
			$("#save").fadeIn(1000, function(){
								
		 var n = noty({
		 text: '<center> '+data+' </center>',
         theme: 'defaultTheme',
         layout: 'center',
         type: 'information',
         timeout: 5000 });
         $('body').removeClass('modal-open');
         $('#myModalSucursal').modal('hide');
		 $("#savesucursal")[0].reset();
         $("#proceso").val("save");
         $("#codsucursal").val("");
         $("#btn-submit").attr('disabled', false);
		 $('#idcanton').html("<option value=''>-- SIN RESULTADOS --</option>");
		 $('#idparroquia').html("<option value=''>-- SIN RESULTADOS --</option>");
		 $('#sucursales').html("");
		 $('#sucursales').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
		 setTimeout(function() {
		 	$('#sucursales').load("consultas?CargaSucursales=si");
		 }, 200);
								
							});
						}
				   }
			});
			return false;
		}
	   /* form submit */	   
    }); 
});
/*  FUNCION PARA VALIDAR REGISTRO DE SUCURSALES */












/* FUNCION JQUERY PARA VALIDAR REGISTRO DE PLANTILLA ECOGRAFICA */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#saveplantillaecografica").validate({
      rules:
	  {
			nombreplantillaecografia: { required: true, },
			procedimientoecografia: { required: true, },
			descripcionecografia: { required: true, },
	   },
       messages:
	   {
			nombreplantillaecografia:{ required: "Ingrese Nombre de Plantilla" },
            procedimientoecografia:{ required: "Ingrese Procedimiento Ecografico" },
            descripcionecografia:{ required: "Ingrese Descripcion de Plantilla" },
       },
	   errorElement: "span",
	   submitHandler: function(form) {
                     		
			var data = $("#saveplantillaecografica").serialize();
			
			$.ajax({
			type : 'POST',
			url  : 'plantillasecograficas.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ESTE NOMBRE DE PLANTILLA YA EXISTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-submit").attr('disabled', false);
																			
								});
							}
							 else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalPlantilla').modal('hide');
			 $("#saveplantillaecografica")[0].reset();
             $("#proceso").val("save");
			 $('#codplantillaecografia').val("");
			 $('#plantillas_ecograficas').html("");
			 $("#btn-submit").attr('disabled', false);	
			 $('#plantillas_ecograficas').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
             setTimeout(function() {
             $('#plantillas_ecograficas').load("consultas?CargaPlantillasEcograficas=si");
             }, 200);
									
								});
							}
					   }
			});
			return false;
		}
	   /* form submit */	
    });    
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE PLANTILLA ECOGRAFICA */











/* FUNCION JQUERY PARA VALIDAR REGISTRO DE PLANTILLA LECTURA RX */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#saveplantillalecturarx").validate({
      rules:
	  {
			nombreplantillalecturarx: { required: true, },
			procedimientolecturarx: { required: true, },
			descripcionlecturarx: { required: true, },
	   },
       messages:
	   {
			nombreplantillalecturarx:{ required: "Ingrese Nombre de Plantilla" },
            procedimientolecturarx:{ required: "Ingrese Procedimiento de Lectura Rx" },
            descripcionlecturarx:{ required: "Ingrese Descripcion de Plantilla" },
       },
	   errorElement: "span",
	   submitHandler: function(form) {
                     		
			var data = $("#saveplantillalecturarx").serialize();
			
			$.ajax({
			type : 'POST',
			url  : 'plantillaslecturarx.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ESTE NOMBRE DE PLANTILLA YA EXISTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-submit").attr('disabled', false);
																			
								});
							}
							 else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalPlantilla').modal('hide');
			 $("#saveplantillalecturarx")[0].reset();
             $("#proceso").val("save");
			 $('#codplantillalecturarx').val("");
			 $('#plantillas_lecturarx').html("");
			 $("#btn-submit").attr('disabled', false);	
			 $('#plantillas_lecturarx').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
             setTimeout(function() {
             $('#plantillas_lecturarx').load("consultas?CargaPlantillasLecturasRx=si");
             }, 200);
									
								});
							}
					   }
			});
			return false;
		}
	   /* form submit */	
    });    
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE PLANTILLA LECTURA RX */













/* FUNCION JQUERY PARA VALIDAR REGISTRO DE MEDICOS */	 
$('document').ready(function()
{ 
    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ,. ]+$/i.test(value);
    });

    /* validation */
    $("#savemedico").validate({
    rules:
    {
		docummedico: { required: true },
		cedmedico: { required: true, digits: false },
		nommedico: { required: true },
		sexomedico: { required: true },
		tlfmedico: { required: true,  digits : false },
		celmedico: { required: true,  digits : false },
		idprovincia: { required: true },
		idcanton: { required: true },
		idparroquia: { required: true },
		direcmedico: { required: true },
		correomedico: { required: true,  email : true },
		mps: { required: true },
		codespecialidad: { required: true },
		fnacmedico: { required: false,  date : false },
		codsucursal: { required: true },
    },
    messages:
    {
		docummedico:{ required: "Seleccione Tipo de Documento" },
        cedmedico:{ required: "Ingrese N&deg; de Documento", digits: "Ingrese solo digitos para N&deg; de Documento" },
		nommedico:{ required: "Ingrese Nombre de M&eacute;dico" },
		sexomedico:{ required: "Seleccione Genero" },
		tlfmedico: { required: "Ingrese N&deg; de Tel&eacute;fono", digits: "Ingrese solo digitos para Tel&eacute;fono" },
		celmedico: { required: "Ingrese N&deg; de Celular", digits: "Ingrese solo digitos para Celular" },
		idprovincia:{ required: "Seleccione Provincia" },
		idcanton:{ required: "Seleccione Canton" },
		idparroquia:{ required: "Seleccione Parroquia" },
		direcmedico: { required: "Ingrese Direcci&oacute;n Domiciliara" },
		correomedico: { required: "Ingrese Correo Electr&oacute;nico", email: "Ingrese un Correo v&aacute;lido" },
		mps: { required: "Ingrese N&deg; de MPS" },
		codespecialidad:{ required: "Seleccione Especialidad" },
		fnacmedico: { required: "Ingrese Fecha de Nacimiento", date: "Ingrese Fecha Valida" },
		codsucursal:{ required: "Seleccione Sucursal" },
   },
   errorElement: "span",
   submitHandler: function(form) {
	   			
		var data = $("#savemedico").serialize();
		var formData = new FormData($("#savemedico")[0]);
		
		$.ajax({
		type : 'POST',
		url  : 'formedico.php',
	    async : false,
		data : formData,
		//necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
				   {						
						if(data==1){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000 });
         $("#btn-submit").attr('disabled', false);
								
							});
						} 
						else if(data==2){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> ESTE CORREO ELECTR&Oacute;NICO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000 });
         $("#btn-submit").attr('disabled', false);
									
							});
						}
						else if(data==3){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> YA EXISTE UN MEDICO CON ESTE N&deg; DE DOCUMENTO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000 });
         $("#btn-submit").attr('disabled', false);
																		
							});
						}
						else{
								
			$("#save").fadeIn(1000, function(){
								
		 var n = noty({
		 text: '<center> '+data+' </center>',
         theme: 'defaultTheme',
         layout: 'center',
         type: 'information',
         timeout: 5000 });
		 $("#savemedico")[0].reset();
         $("#btn-submit").attr('disabled', false);
		 $('#idcanton').html("<option value=''>-- SIN RESULTADOS --</option>");
		 $('#idparroquia').html("<option value=''>-- SIN RESULTADOS --</option>");
								
							});
						}
				   }
			});
			return false;
		}
	   /* form submit */	   
    }); 
});
/*  FUNCION PARA VALIDAR REGISTRO DE MEDICOS */

/* FUNCION JQUERY PARA VALIDAR ACTUALIZAR MEDICO */	  
$('document').ready(function()
{ 
    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ,. ]+$/i.test(value);
    });

    /* validation */
    $("#updatemedico").validate({
    rules:
    {
		docummedico: { required: true },
		cedmedico: { required: true, digits: false },
		nommedico: { required: true },
		sexomedico: { required: true },
		tlfmedico: { required: true,  digits : false },
		celmedico: { required: true,  digits : false },
		idprovincia: { required: true },
		idcanton: { required: true },
		idparroquia: { required: true },
		direcmedico: { required: true },
		correomedico: { required: true,  email : true },
		mps: { required: true },
		codespecialidad: { required: true },
		fnacmedico: { required: false,  date : false },
		codsucursal: { required: true },
    },
    messages:
    {
		docummedico:{ required: "Seleccione Tipo de Documento" },
        cedmedico:{ required: "Ingrese N&deg; de Documento", digits: "Ingrese solo digitos para N&deg; de Documento" },
		nommedico:{ required: "Ingrese Nombre de M&eacute;dico" },
		sexomedico:{ required: "Seleccione Genero" },
		tlfmedico: { required: "Ingrese N&deg; de Tel&eacute;fono", digits: "Ingrese solo digitos para Tel&eacute;fono" },
		celmedico: { required: "Ingrese N&deg; de Celular", digits: "Ingrese solo digitos para Celular" },
		idprovincia:{ required: "Seleccione Provincia" },
		idcanton:{ required: "Seleccione Canton" },
		idparroquia:{ required: "Seleccione Parroquia" },
		direcmedico: { required: "Ingrese Direcci&oacute;n Domiciliara" },
		correomedico: { required: "Ingrese Correo Electr&oacute;nico", email: "Ingrese un Correo v&aacute;lido" },
		mps: { required: "Ingrese N&deg; de MPS" },
		codespecialidad:{ required: "Seleccione Especialidad" },
		fnacmedico: { required: "Ingrese Fecha de Nacimiento", date: "Ingrese Fecha Valida" },
		codsucursal:{ required: "Seleccione Sucursal" },
   },
    errorElement: "span",
    submitHandler: function(form) {
	   			
			var data = $("#updatemedico").serialize();
			var formData = new FormData($("#updatemedico")[0]);
			
			$.ajax({
			type : 'POST',
			url  : 'formedico.php',
			async : false,
			data : formData,
		    //necesario para subir archivos via ajax
		    cache: false,
		    contentType: false,
		    processData: false,
		    beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-update").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000 });
             $("#btn-update").attr('disabled', false);
									
								});
							} 
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ESTE CORREO ELECTRONICO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000 });
			$("#btn-update").attr('disabled', false);
																			
								});
							} 
							else if(data==3){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> YA EXISTE UN MEDICO CON ESTE N&deg; DE DOCUMENTO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000 });
			$("#btn-update").attr('disabled', false);
																			
								});
							}
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000 });
			 $("#btn-update").attr('disabled', false);
	         setTimeout("location.href='medicos'", 5000);	
							});
					    }
				   }
			});
			return false;
		}
	   /* form submit */	
    });    
});
/*  FUNCION PARA VALIDAR ACTUALIZAR MEDICO */ 

/* FUNCION JQUERY PARA VALIDAR ACTUALIZAR MEDICO */	  
$('document').ready(function()
{ 
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ,. ]+$/i.test(value);
    });

    /* validation */
	$("#updatedatos").validate({
        rules:
    {
		docummedico: { required: true },
		cedmedico: { required: true, digits: false },
		nommedico: { required: true },
		sexomedico: { required: true },
		tlfmedico: { required: true,  digits : false },
		celmedico: { required: true,  digits : false },
		idprovincia: { required: true },
		idcanton: { required: true },
		idparroquia: { required: true },
		direcmedico: { required: true },
		correomedico: { required: true,  email : true },
		mps: { required: true },
		codespecialidad: { required: true },
		fnacmedico: { required: false,  date : false },
		codsucursal: { required: true },
    },
    messages:
    {
		docummedico:{ required: "Seleccione Tipo de Documento" },
        cedmedico:{ required: "Ingrese N&deg; de Documento", digits: "Ingrese solo digitos para N&deg; de Documento" },
		nommedico:{ required: "Ingrese Nombre de M&eacute;dico" },
		sexomedico:{ required: "Seleccione Genero" },
		tlfmedico: { required: "Ingrese N&deg; de Tel&eacute;fono", digits: "Ingrese solo digitos para Tel&eacute;fono" },
		celmedico: { required: "Ingrese N&deg; de Celular", digits: "Ingrese solo digitos para Celular" },
		idprovincia:{ required: "Seleccione Provincia" },
		idcanton:{ required: "Seleccione Canton" },
		idparroquia:{ required: "Seleccione Parroquia" },
		direcmedico: { required: "Ingrese Direcci&oacute;n Domiciliara" },
		correomedico: { required: "Ingrese Correo Electr&oacute;nico", email: "Ingrese un Correo v&aacute;lido" },
		mps: { required: "Ingrese N&deg; de MPS" },
		codespecialidad:{ required: "Seleccione Especialidad" },
		fnacmedico: { required: "Ingrese Fecha de Nacimiento", date: "Ingrese Fecha Valida" },
		codsucursal:{ required: "Seleccione Sucursal" },
   },
	    errorElement: "span",
	    submitHandler: function(form) {
	   			
			var data = $("#updatedatos").serialize();
			
			$.ajax({
			type : 'POST',
			url  : 'edit_datos.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000 });
             $("#btn-submit").attr('disabled', false);
									
								});
							} 
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ESTE CORREO ELECTRONICO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000 });
			$("#btn-submit").attr('disabled', false);
																			
								});
							} 
							else if(data==3){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> YA EXISTE UN MEDICO CON ESTE N&deg; DE DOCUMENTO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000 });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000 });
			 $("#btn-submit").attr('disabled', false);
							});
					    }
				    }
				});
				return false;
		}
	   /* form submit */	
    });    
});
/*  FUNCION PARA VALIDAR ACTUALIZAR MEDICO */ 
 
















/* FUNCION JQUERY PARA VALIDAR REGISTRO HORARIOS DE MEDICOS */	 
$('document').ready(function()
{ 
        jQuery.validator.addMethod("lettersonly", function(value, element) {
          return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ,. ]+$/i.test(value);
        });

        /* validation */
	    $("#savehorario").validate({
        rules:
	    {
			codsucursal: { required: true },
			codespecialidad: { required: true },
			codmedico: { required: true },
			hora_desde: { required: true },
			hora_hasta: { required: true },
	    },
        messages:
	    {
			codsucursal:{ required: "Seleccione Sucursal" },
			codespecialidad:{ required: "Seleccione Especialidad" },
			codmedico:{ required: "Seleccione M&eacute;dico" },
			hora_desde:{ required: "Ingrese Hora Desde" },
			hora_hasta:{ required: "Ingrese Hora Hasta" },
       },
	   errorElement: "span",
	   submitHandler: function(form) {
	   			
		var data = $("#savehorario").serialize();
		var formData = new FormData($("#savehorario")[0]);
		
		$.ajax({
		type : 'POST',
		url  : 'horarios.php',
	    async : false,
		data : formData,
		//necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
				   {						
						if(data==1){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000 });
         $("#btn-submit").attr('disabled', false);
								
							});
						} 
						else if(data==2){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> LA HORA DESDE NO PUEDE SER MAYOR QUE LA HORA HASTA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000 });
         $("#btn-submit").attr('disabled', false);
									
							});
						} 
						else if(data==3){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> LOS DIAS LABORABLES NO PUEDEN REPETIRSE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000 });
         $("#btn-submit").attr('disabled', false);
									
							});
						}
						else{
								
			$("#save").fadeIn(1000, function(){
								
		 var n = noty({
		 text: '<center> '+data+' </center>',
         theme: 'defaultTheme',
         layout: 'center',
         type: 'information',
         timeout: 5000 });
         $('body').removeClass('modal-open');
         $('#myModalHorario').modal('hide');
		 $("#savehorario")[0].reset();
         $("#proceso").val("save");
         $("#codhorario").val("");
         $("#btn-submit").attr('disabled', false);
		 $('#codespecialidad').html("<option value=''>-- SIN RESULTADOS --</option>");
		 $('#codmedico').html("<option value=''>-- SIN RESULTADOS --</option>");
		 $('#muestradiaslaborales').load("funciones?MuestraDiasLaborales=si");
		 $('#horarios').html("");
		 $('#horarios').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
		 setTimeout(function() {
		 	$('#horarios').load("consultas?CargaHorarios=si");
		 }, 200);
								
							});
						}
				   }
			});
			return false;
		}
	   /* form submit */	   
    }); 
});
/*  FUNCION PARA VALIDAR REGISTRO HORARIOS DE MEDICOS */

/* FUNCION JQUERY PARA CARGA MASIVA DE PACIENTES */	 
$('document').ready(function()
{ 						
     /* validation */
	$("#cargapacientes").validate({
     rules:
	     {
			sel_file: { required: false },
	     },
          messages:
	     {
              sel_file:{ required: "Por favor Seleccione Archivo para Cargar" },
          },
	     errorElement: "span",
	     submitHandler: function(form) {
	   			
		var data = $("#cargapacientes").serialize();
		var formData = new FormData($("#cargapacientes")[0]);
		var sel_file = $('#sel_file').val();

          if (sel_file == "") {
            
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL ARCHIVO A CARGAR!", "error");
               return false;

          } else {
			
		$.ajax({
		type : 'POST',
		url  : 'pacientes.php',
		async : false,
	     data : formData,
		//necesario para subir archivos via ajax
          cache: false,
          contentType: false,
          processData: false,
		beforeSend: function()
		{	
		     $("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-cargar").attr('disabled', true);
		},
		success : function(data)
			     {						
			     if(data==1){
								
			$("#save").fadeIn(1000, function(){
								
	     var n = noty({
          text: "<span class='fa fa-warning'></span> NO SE HA SELECCIONADO NINGUN ARCHIVO PARA CARGAR, VERIFIQUE NUEVAMENTE POR FAVOR...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'warning',
          timeout: 5000 });
		$("#btn-cargar").attr('disabled', false);
									
					});
				}  
			     else if(data==2){
								
			$("#save").fadeIn(1000, function(){
								
		var n = noty({
          text: "<span class='fa fa-warning'></span> ERROR! ARCHIVO INVALIDO PARA LA CARGA MASIVA DE PACIENTES, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'warning',
          timeout: 5000 });
	     $("#btn-cargar").attr('disabled', false);
																			
					});
				}
				else{
									
			$("#save").fadeIn(1000, function(){
									
		var n = noty({
		text: '<center> '+data+' </center>',
          theme: 'defaultTheme',
          layout: 'center',
          type: 'information',
          timeout: 5000 });
          $('body').removeClass('modal-open');
          $('#myModalCargaMasiva').modal('hide');
	     $("#cargapacientes")[0].reset();
		$('#divpaciente').html("");
		$("#btn-cargar").attr('disabled', false);
									
						});
					}
				}
			});
			return false;
		     }
		}
	    /* form submit */
     }); 
});
/*  FUNCION PARA CARGA MASIVA DE PACIENTES */

/* FUNCION JQUERY PARA VALIDAR REGISTRO DE PACIENTE */	  
$('document').ready(function()
{ 
     jQuery.validator.addMethod("lettersonly", function(value, element) {
          return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ,. ]+$/i.test(value);
     });

	$("#savepaciente").validate({
     rules:
	     {
			numerohistoria: { required: true, digits : true  },
			documpaciente: { required: true },
			cedpaciente: { required: true, digits : true  },
			pnompaciente: { required: true, lettersonly: false },
			snompaciente : { required: false, lettersonly: false },
			papepaciente: { required: true, lettersonly: false },
			sapepaciente: { required: false, lettersonly: false },
			direcpaciente: { required: true },
			idparroquia: { required: true },
			idcanton: { required: true },
			idprovincia: { required: true },
			tlfpaciente: { required: true },
			fnacpaciente: { required: true },
			lnacpaciente: { required: true },
			nacpaciente: { required: true },
			enfoquepaciente: { required: true },
			sexopaciente: { required: true },
			estadopaciente: { required: false },
			instruccionpaciente: { required: false },
			ocupacionpaciente: { required: false },
			trabajapaciente: { required: false },
			codseguro: { required: false },
			referidopaciente: { required: false },
			emailpaciente: { required: false, email: true },
			nomacompana: { required: false, lettersonly: false },
			direcacompana: { required: false },
			tlfacompana: { required: false },
			parentescoacompana: { required: false },
			nomresponsable: { required: false, lettersonly: false },
			direcresponsable: { required: false },
			tlfresponsable: { required: false },
			parentescoresponsable: { required: false },
	     },
          messages:
	     {
               numerohistoria:{  required: "Ingrese N&deg; de Historia" },
               documpaciente:{ required: "Seleccione Tipo de Documento" },
			cedpaciente:{  required: "Ingrese N&deg; de Documento", digits: "Ingrese solo digitos"  },
			pnompaciente:{ required: "Ingrese Primer Nombre", lettersonly: "Ingrese solo letras" },
			snompaciente : { required : "Ingrese Segundo Nombre", lettersonly: "Ingrese solo letras" },
			papepaciente:{  required: "Ingrese Primer Apellido", lettersonly: "Ingrese solo letras" },
			sapepaciente:{ required: "Ingrese Segundo Apellido", lettersonly: "Ingrese solo letras" },
			direcpaciente:{ required: "Ingrese Direcci&oacute;n Domiciliaria" },
			idparroquia:{ required: "Seleccione Parroquia" },
			idcanton:{ required: "Seleccione Canton" },
			idprovincia:{ required: "Seleccione Provincia" },
			tlfpaciente:{ required: "Ingrese N&deg; de Tel&eacute;fono" },
			fnacpaciente:{ required: "Ingrese Fecha Nacimiento" },
			lnacpaciente:{ required: "Ingrese Lugar de Nacimiento" },
			nacpaciente:{ required: "Ingrese Pais de Nacimiento" },
			sexopaciente:{  required: "Seleccione Sexo" },
			estadopaciente:{ required: "Seleccione Estado Civil"  },
			instruccionpaciente:{ required: "Ingrese Grado Instrucci&oacute;n" },
			ocupacionpaciente:{ required: "Ingrese Ocupaci&oacute;n Laboral" },
			trabajapaciente:{ required: "Ingrese Empresa donde Trabaja" },
			codseguro:{ required: "Seleccione Seguro" },
			referidopaciente:{ required: "Ingrese Referido" },
			emailpaciente:{ required: "Ingrese Correo Electronico", email: "Ingrese un Email V&aacute;lido" },
			nomacompana:{ required: "Ingrese Nombre Completo", lettersonly: "Ingrese solo letras" },
		     direcacompana:{ required: "Ingrese Direcci&oacute;n Domiciliaria" },
			tlfacompana:{ required: "Ingrese N&deg; de Tel&eacute;fono" },
			parentescoacompana:{ required: "Ingrese Parentesco" },
			nomresponsable:{ required: "Ingrese Nombre Completo", lettersonly: "Ingrese solo letras" },
		     direcresponsable:{ required: "Ingrese Direcci&oacute;n Domiciliaria" },
			tlfresponsable:{ required: "Ingrese N&deg; de Tel&eacute;fono" },
			parentescoresponsable:{ required: "Ingrese Parentesco" },
          },
	     errorElement: "span",
	     submitHandler: function(form) {
	   			
		var data = $("#savepaciente").serialize();
		var formulario = $('#formulario').val();
		
		$.ajax({
		type : 'POST',
		url  : formulario+'.php',
	     async : false,
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-paciente").attr('disabled', true);
		},
		success : function(data)
				{						
				if(data==1){
							
			$("#save").fadeIn(1000, function(){
							
		var n = noty({
          text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'warning',
          timeout: 5000 });
		$("#btn-paciente").attr('disabled', false);
								
					});
				}  
				else if(data==2){
							
			$("#save").fadeIn(1000, function(){
							
		var n = noty({
          text: "<span class='fa fa-warning'></span> ESTE N&deg; DE HISTORIA YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'warning',
          timeout: 5000 });
		$("#btn-paciente").attr('disabled', false);
																		
					});
				} 
				else if(data==3){
							
			$("#save").fadeIn(1000, function(){
							
		var n = noty({
          text: "<span class='fa fa-warning'></span> YA EXISTE UN PACIENTE CON ESTE N&deg; DE DOCUMENTO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'warning',
          timeout: 5000 });
		$("#btn-paciente").attr('disabled', false);
																		
					});
				}
				else{
								
			$("#save").fadeIn(1000, function(){
								
		var n = noty({
		text: '<center> '+data+' </center>',
          theme: 'defaultTheme',
          layout: 'center',
          type: 'information',
          timeout: 5000 });
          $('body').removeClass('modal-open');
          $('#myModalPaciente').modal('hide');
		$("#savepaciente")[0].reset();
	     $('#idcanton').html("<option value=''>-- SIN RESULTADOS --</option>");
	     $('#idparroquia').html("<option value=''>-- SIN RESULTADOS --</option>");
		$("#btn-paciente").attr('disabled', false);

		if(formulario == "pacientes"){
               $("#proceso").val("save");
		     $('#codpaciente').val("");
		     $("#BotonBusqueda").trigger("click");
          }				
						});
					}
				}
			});
			return false;
		}
	     /* form submit */	
     });    
});
/*  FUNCION PARA VALIDAR REGISTRO DE PACIENTE */ 
 
/* FUNCION JQUERY PARA CARGAR DOCUMENTOS A PACIENTE */	 
$('document').ready(function()
{ 
     jQuery.validator.addMethod("lettersonly", function(value, element) {
          return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ,. ]+$/i.test(value);
     });

     /* validation */
	$("#savedocumentopaciente").validate({
     rules:
	     {
			numerohistoria: { required: true, digits : true  },
			documpaciente: { required: true },
			sel_file: { required: true },
	     },
          messages:
	     {
               numerohistoria:{  required: "Ingrese N&deg; de Historia" },
               documpaciente:{ required: "Seleccione Tipo de Documento" },
               sel_file:{ required: "Por favor Seleccione Archivo para Cargar" },
          },
	     errorElement: "span",
	     submitHandler: function(form) {
	   			
		var data = $("#savedocumentopaciente").serialize();
		var formData = new FormData($("#savedocumentopaciente")[0]);
		
		$.ajax({
		type : 'POST',
		url  : 'pacientes.php',
	     async : false,
		data : formData,
		//necesario para subir archivos via ajax
          cache: false,
          contentType: false,
          processData: false,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-cargardocumento").attr('disabled', true);
		},
		success : function(data)
				{						
				if(data==1){
							
			$("#save").fadeIn(1000, function(){
							
		var n = noty({
          text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'warning',
          timeout: 5000 });
          $("#btn-cargardocumento").attr('disabled', false);
								
					});
				} 
				else if(data==2){
							
			$("#save").fadeIn(1000, function(){
							
		var n = noty({
          text: "<span class='fa fa-warning'></span> LOS ARCHIVOS CARGADOS NO CUMPLEN CON LOS FORMATOS SOLICITADOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
          theme: 'defaultTheme',
          layout: 'center',
          type: 'warning',
          timeout: 5000 });
          $("#btn-cargardocumento").attr('disabled', false);
									
					});
				}
				else{
								
			$("#save").fadeIn(1000, function(){
								
		var n = noty({
		text: '<center> '+data+' </center>',
          theme: 'defaultTheme',
          layout: 'center',
          type: 'information',
          timeout: 5000 });
          $('body').removeClass('modal-open');
          $('#myModalCargaDocumentos').modal('hide');
		$("#savedocumentopaciente")[0].reset();
          $("#proceso").val("cargardocumentos");
          $("#tabla").html('<div class="form-group has-feedback"><div class="fileinput fileinput-new" data-provides="fileinput"><div class="form-group has-feedback"><label class="control-label">Archivo a Cargar: <span class="symbol required"></span></label><div class="input-group"><div class="form-control" data-trigger="fileinput"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg><span class="fileinput-filename"></span></div><span class="input-group-addon btn btn-success btn-file"><span class="fileinput-new"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg> Selecciona Archivo</span><span class="fileinput-exists"><i data-feather="image"></i> Cambiar</span><input type="file" class="btn btn-default" data-original-title="Subir Archivo" data-rel="tooltip" placeholder="Suba su Archivo" name="file[]" id="file" autocomplete="off" title="Buscar Archivo" required="" aria-required="true"></span><a href="#" class="input-group-addon btn btn-dark fileinput-exists" data-dismiss="fileinput"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg> Quitar</a></div><small><p>Para Subir el Archivo debe tener en cuenta:<br> * El Archivo a cargar debe ser extension.pdf,jpeg,jpg,png</p></small></div></div></div>');
          $("#codpaciente").val("");
          $("#btn-cargardocumento").attr('disabled', false);
								
							});
						}
				     }
			     });
			return false;
		}
	     /* form submit */	   
     }); 
});
/*  FUNCION PARA VALIDAR CARGAR DOCUMENTOS A PACIENTE */




















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE CITAS */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#savecita").validate({
		rules:
		{
			search_paciente: { required: false },
			codmedico: { required: true },
			descripcion: { required: true },
			color: { required: true },
			fechacita: { required: true, date : false },
			horacita: { required: false },
		},
		messages:
		{
			search_paciente:{ required: "Ingrese Criterio para tu Busqueda" },
			codmedico:{ required: "Seleccione Médico" },
			descripcion:{ required: "Ingrese Descripción de Cita" },
			color : { required : "Seleccione Color" },
			fechacita:{ required: "Ingrese Fecha de Cita", date: "Ingrese Fecha Valida"  },
			horacita:{ required: "Ingrese Hora de Cita" },
		},
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#savecita").serialize();
		var codsucursal = $('#sucursal').val();
		var codmedico = $('#medico').val();
		var codespecialidad = $('#especialidad').val();

		$.ajax({

		type : 'POST',
		url  : 'forcita.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE DIA NO SE ENCUENTRA ASIGNADO AL MEDICO PARA CITAS, VERIFIQUE LOS DIAS LABORABLES POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			} 
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> LA FECHA DE CITA MEDICA NO PUEDE SER MENOR QUE LA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}
			else if(data==4){

			    $("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> LA HORA DE CITA MEDICA NO PUEDE SER MENOR QUE LA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}
			else if(data==5){
									
				$("#save").fadeIn(1000, function(){
									
			    var n = noty({
                text: "<span class='fa fa-warning'></span> YA EXISTE UNA CITA MEDICA EN LA FECHA Y HORA INGRESADA, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                theme: 'defaultTheme',
                layout: 'center',
                type: 'error',
                timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				 
				  }); 															
			}
        	else if(data==6)
        	{

        		$("#save").fadeIn(1000, function(){

        		var n = noty({
        		text: "<span class='fa fa-warning'></span> ESTA CITA MEDICA NO PUEDE SER ACTUALIZADA, YA FUE ATENDIDA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
        		theme: 'defaultTheme',
        		layut: 'center',
        		type: 'warning',
        		timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

        		});

        	} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
                $('body').removeClass('modal-open');
				$('#ModalAdd').modal('hide');
				$("#deletevento").attr('disabled', true);
				$("#cancelaevento").attr('disabled', true);
			    $("#btn-submit").attr('disabled', false);
				$("#savecita")[0].reset();
				$("#proceso").val("save");
				$("#error").html("");
				//$('#cargacalendario').html("");
				$('html, body').animate({scrollTop:800}, 1000);
				$("#muestra_calendario").load("calendario.php?Calendario_Secundario=si&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico);
				//$('#cargacalendario').append('<center><i class="fa fa-spin fa-spinner"></i> Por Favor Espere, Cargando Calendario ......</center>').fadeIn("slow");
				//setTimeout(function() {
				 	//$('#cargacalendario').load("calendario?Calendario_Secundario=si");
				//}, 1000);	

				});
			  }
			}
		});
		return false;
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE CITAS */

/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CITAS */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updatecita").validate({
		rules:
		{
			search_paciente: { required: false },
			codmedico: { required: true },
			descripcion: { required: true },
			color: { required: true },
			fechacita: { required: true, date : false },
			horacita: { required: false },
		},
		messages:
		{
			search_paciente:{ required: "Ingrese Criterio para tu Busqueda" },
			codmedico:{ required: "Seleccione Médico" },
			descripcion:{ required: "Ingrese Descripción de Cita" },
			color : { required : "Seleccione Color" },
			fechacita:{ required: "Ingrese Fecha de Cita", date: "Ingrese Fecha Valida"  },
			horacita:{ required: "Ingrese Hora de Cita" },
		},
	    errorElement: "span",
	    submitHandler: function(form) {	

		var data = $("#updatecita").serialize();
		var codcita = $('input#codcita').val();

        $.ajax({

        type : 'POST',
        url  : 'citasmedicas.php?codcita='+codcita,
        data : data,
        beforeSend: function()
        {	
        	$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
        },
        success :  function(data)
        {						
        	if(data==1){

        		$("#save").fadeIn(1000, function(){

        		var n = noty({
        		text: "<span class='fa fa-warning'></span> REALICE LA BUSQUEDA DEL BENEFICIARIO O FAMILIAR CORRECTAMENTE, VERIFIQUE NUEVAMENTE POR FAVOR...!",
        		theme: 'defaultTheme',
        		layout: 'center',
        		type: 'warning',
        		timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
        		});
        	}  
        	else if(data==2){

        		$("#save").fadeIn(1000, function(){

        		var n = noty({
        		text: "<span class='fa fa-warning'></span> LA FECHA DE CITA PARA ODONTOLOGIA NO PUEDE SER MENOR QUE LA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
        		theme: 'defaultTheme',
        		layout: 'center',
        		type: 'warning',
        		timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
        		});
        	}
        	else if(data==3){

        		$("#save").fadeIn(1000, function(){

    			var n = noty({
    			text: "<span class='fa fa-warning'></span> LA HORA DE CITA PARA ODONTOLOGIA NO PUEDE SER MENOR QUE LA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
    			theme: 'defaultTheme',
    			layout: 'center',
    			type: 'warning',
    			timeout: 5000 });
    			$("#btn-update").attr('disabled', false);
        		});
        	}
        	else if(data==4)
        	{

        		$("#save").fadeIn(1000, function(){

    			var n = noty({
    			text: "<span class='fa fa-warning'></span> YA EXISTE UNA CITA PARA ODONTOLOGIA EN LA FECHA Y HORA INGRESADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
    			theme: 'defaultTheme',
    			layout: 'center',
    			type: 'warning',
    			timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
    			});
        	}
        	else if(data==5)
        	{

        		$("#save").fadeIn(1000, function(){

    			var n = noty({
    			text: "<span class='fa fa-warning'></span> ESTA CITA PARA ODONTOLOGIA NO PUEDE SER ACTUALIZADA, YA FUE ATENDIDA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
    			theme: 'defaultTheme',
    			layout: 'center',
    			type: 'warning',
    			timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
    			});
        	} else {

        		$("#save").fadeIn(1000, function(){

        			var n = noty({
        			text: '<center> '+data+' </center>',
        			theme: 'defaultTheme',
        			layout: 'center',
        			type: 'information',
        			timeout: 5000 });
                    $('#cargacalendario').html("");
        			$("html, body").animate({ scrollTop: $('html, body').prop("scrollHeight")}, "fast");
			        $("#btn-update").attr('disabled', false);
                    $('#cargacalendario').append('<center><i class="fa fa-spin fa-spinner"></i> Por Favor Espere, Cargando Calendario ......</center>').fadeIn("slow");
                    setTimeout(function() {
                    $('#cargacalendario').load("calendario?Calendario_Secundario=si");
                        }, 100);  
        			});
        		}
        	}
        });
        return false;
        }
	   /* form submit */
    }); 	   
});
/*  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CITAS */


/*  FUNCION PARA VALIDAR REGISTRO DE APERTURA CONSULTORIO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#saveapertura").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			motivoconsulta: { required: true, },
			examenfisico: { required: true, },
			fechamestruacion: { required: true, },
			fechacitologia: { required: false, },
			embarazada: { required: false, },
			ta: { required: true, },
			temperatura: { required: true, },
			fc: { required: true, },
			fr: { required: true, },
			peso: { required: true, },
			enfermedadpaciente: { required: true },
			antecedentepaciente: { required: true },
			antecedentefamiliares: { required: true },
			antecedentealergico: { required: true },
			antecedentepatologico: { required: true },
			antecedentequirurgico: { required: true },
			antecedentefarmacologico: { required: true },
			antecedenteginecologico: { required: false },
			historialgestacional: { required: false },
			planificacionfamiliar: { required: false },
			tratamiento: { required: true },
			remision: { required: false },
			formula: { required: false },
			observacionformula: { required: false },
			ordenes: { required: false },
			observacionorden: { required: false },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			motivoconsulta:{ required: "Por favor Ingrese Motivo de Consulta" },
			examenfisico:{ required: "Por favor Ingrese Examen Fisico" },
			fechamestruacion:{ required: "Ingrese Fecha Ultima Mestruaci&oacute;n", date: "Ingrese fecha Valida"  },
			fechacitologia:{ required: "Ingrese Fecha Ultima Citologia", date: "Ingrese fecha Valida"  },
			embarazada: { required: "Seleccione Embarazada" },
			ta:{ required: "Ingrese PA" },
			temperatura : { required : "Ingrese Temp"  },
			fc : { required : "Ingrese FC"  },
			fr:{ required: "Ingrese FR" },
			peso: { required: "Ingrese Peso" },
			enfermedadpaciente:{ required: "Ingrese Enfermedad del Paciente" },
			antecedentepaciente:{ required: "Ingrese Antecedentes Personales" },
			antecedentefamiliares:{ required: "Ingrese Antecedentes Familiares" },
			antecedentealergico:{ required: "Ingrese Antecedentes Alergicos" },
			antecedentepatologico:{ required: "Ingrese Antecedentes Patologicos" },
			antecedentequirurgico:{ required: "Ingrese Antecedentes Quirurgicos" },
			antecedentefarmacologico: { required: "Ingrese Medicación Actual" },
			antecedenteginecologico: { required: "Ingrese Antecedentes Ginecologicos" },
			historialgestacional: { required: "Ingrese Historial Gestacional" },
			planificacionfamiliar: { required: "Ingrese Planificaci&oacute;n Familiar" },
			tratamiento: { required: "Ingrese Conducta o Tratamiento" },
			remision: { required: "Ingrese Remision del Paciente" },
			formula: { required: "Ingrese Dx para F&oacute;rmula M&eacute;dica" },
			observacionformula: { required: "Ingrese Observaci&oacute;n de F&oacute;rmula M&eacute;dica" },
			ordenes: { required: "Ingrese Dx para &Oacute;rden M&eacute;dica" },
			observacionorden: { required: "Ingrese Observaci&oacute;n de &Oacute;rden M&eacute;dica" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#saveapertura").serialize();
		var formulario = $('#formulario').val();
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();
	
        if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;

	    } else { 
		$.ajax({

		type : 'POST',
		url  : formulario+'.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{	
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX PRESUNTIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX DEFINITIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==4){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR FORMULAS MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==5){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR ORDENES MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==6){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA APERTURA MEDICA, DEBE DE REALIZAR UNA HOJA EVOLUTIVA ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				$("#saveapertura")[0].reset();
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
				$("#tabla").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Dx Presuntivo: <span class="symbol required"></span></label><input type="hidden" name="idciepresuntivo[]" id="idciepresuntivo"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="presuntivo[]" id="presuntivo" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Presuntivo" autocomplete="off" required="" aria-required="true"><textarea class="form-control" name="observacionpresuntivo[]" id="observacionpresuntivo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Dx Presuntivo" title="Ingrese Observación de Dx Presuntivo" rows="2" required="" aria-required="true"></textarea></div></td></tr></tbody>');
                $("#tabla2").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Dx Definitivo: <span class="symbol required"></span></label><input type="hidden" name="idciedefinitivo[]" id="idciedefinitivo"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="definitivo[]" id="definitivo" onKeyUp="this.value=this.value.toUpperCase(); autocompletar2(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Definitivo" autocomplete="off" required="" aria-required="true"><textarea class="form-control" name="observaciondefinitivo[]" id="observaciondefinitivo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Dx Definitivo" title="Ingrese Observación de Dx Definitivo" rows="2" required="" aria-required="true"></textarea></div></td></tr></tbody>');
			    $("#tabla3").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Fórmula Médica: </label><input type="hidden" name="idcieformula[]" id="idcieformula"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="formula[]" id="formula" onKeyUp="this.value=this.value.toUpperCase(); autocompletarformula(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Fórmula Médica"><textarea class="form-control" name="observacionformula[]" id="observacionformula" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Fórmula Médica" title="Ingrese Observación de Fórmula Médica" rows="2"></textarea></div></td></tr></tbody>');
                $("#tabla4").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Orden Médica: </label><input type="hidden" name="idcieorden[]" id="idcieorden"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="ordenes[]" id="ordenes" onKeyUp="this.value=this.value.toUpperCase(); autocompletarordenes(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Orden Médica"><textarea class="form-control" name="observacionorden[]" id="observacionorden" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Orden Médica" title="Ingrese Observación de Orden Médica" rows="2"></textarea></div></td></tr></tbody>');
			    $("#btn-submit").attr('disabled', false);
				$('#muestracitasxdia').html("");
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE APERTURA CONSULTORIO */

/*  FUNCION PARA VALIDAR ACTUALIZACION DE APERTURA CONSULTORIO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updateapertura").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			motivoconsulta: { required: true, },
			examenfisico: { required: true, },
			fechamestruacion: { required: true, },
			fechacitologia: { required: false, },
			embarazada: { required: false, },
			ta: { required: true, },
			temperatura: { required: true, },
			fc: { required: true, },
			fr: { required: true, },
			peso: { required: true, },
			enfermedadpaciente: { required: true },
			antecedentepaciente: { required: true },
			antecedentefamiliares: { required: true },
			antecedentealergico: { required: true },
			antecedentepatologico: { required: true },
			antecedentequirurgico: { required: true },
			antecedentefarmacologico: { required: true },
			antecedenteginecologico: { required: false },
			historialgestacional: { required: false },
			planificacionfamiliar: { required: false },
			presuntivo: { required: true },
			definitivo: { required: true },
			tratamiento: { required: true },
			remision: { required: false },
			formula: { required: false },
			observacionformula: { required: false },
			ordenes: { required: false },
			observacionorden: { required: false },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			motivoconsulta:{ required: "Por favor Ingrese Motivo de Consulta" },
			examenfisico:{ required: "Por favor Ingrese Examen Fisico" },
			fechamestruacion:{ required: "Ingrese Fecha Ultima Mestruaci&oacute;n", date: "Ingrese fecha Valida"  },
			fechacitologia:{ required: "Ingrese Fecha Ultima Citologia", date: "Ingrese fecha Valida"  },
			embarazada: { required: "Seleccione Embarazada" },
			ta:{ required: "Ingrese PA" },
			temperatura : { required : "Ingrese Temp"  },
			fc : { required : "Ingrese FC"  },
			fr:{ required: "Ingrese FR" },
			peso: { required: "Ingrese Peso" },
			enfermedadpaciente:{ required: "Ingrese Enfermedad del Paciente" },
			antecedentepaciente:{ required: "Ingrese Antecedentes Personales" },
			antecedentefamiliares:{ required: "Ingrese Antecedentes Familiares" },
			antecedentealergico:{ required: "Ingrese Antecedentes Alergicos" },
			antecedentepatologico:{ required: "Ingrese Antecedentes Patologicos" },
			antecedentequirurgico:{ required: "Ingrese Antecedentes Quirurgicos" },
			antecedentefarmacologico: { required: "Ingrese Medicación Actual" },
			antecedenteginecologico: { required: "Ingrese Antecedentes Ginecologicos" },
			historialgestacional: { required: "Ingrese Historial Gestacional" },
			planificacionfamiliar: { required: "Ingrese Planificaci&oacute;n Familiar" },
			tratamiento: { required: "Ingrese Conducta o Tratamiento" },
			remision: { required: "Ingrese Remision del Paciente" },
			formula: { required: "Ingrese Dx para F&oacute;rmula M&eacute;dica" },
			observacionformula: { required: "Ingrese Observaci&oacute;n de F&oacute;rmula M&eacute;dica" },
			ordenes: { required: "Ingrese Dx para &Oacute;rden M&eacute;dica" },
			observacionorden: { required: "Ingrese Observaci&oacute;n de &Oacute;rden M&eacute;dica" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#updateapertura").serialize();
		var formulario = $('#formulario').val();
		var modulo = $('#modulo').val();
		var codapertura = $('#codapertura').val();
		var codpaciente = $('#codpaciente').val();

		$.ajax({

		type : 'POST',
		url  : formulario+'.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
		success :  function(data)
		{
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX PRESUNTIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX DEFINITIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==4){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR FORMULAS MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==5){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR ORDENES MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==6){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA APERTURA MEDICA, DEBE DE REALIZAR UNA HOJA EVOLUTIVA ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				    if(modulo == "1"){
				    	setTimeout("location.href='aperturasc'", 5000);
				    } else {
				    	setTimeout("location.href='aperturasg'", 5000);
				    }

				});
			  }
			}
		});
		return false;
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR ACTUALIZACION DE APERTURA CONSULTORIO */












/*  FUNCION PARA VALIDAR REGISTRO DE HOJA EVOLUTIVA CONSULTORIO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#savehoja").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			motivoconsulta: { required: true, },
			examenfisico: { required: true, },
			fechamestruacion: { required: true, },
			fechacitologia: { required: false, },
			embarazada: { required: false, },
			ta: { required: true, },
			temperatura: { required: true, },
			fc: { required: true, },
			fr: { required: true, },
			peso: { required: true, },
			atenproced: { required: true },
			presuntivo: { required: true },
			observacionpresuntivo: { required: true },
			definitivo: { required: true },
			observaciondefinitivo: { required: true },
			tratamiento: { required: true },
			remision: { required: false },
			formula: { required: false },
			observacionformula: { required: false },
			ordenes: { required: false },
			observacionorden: { required: false },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			motivoconsulta:{ required: "Por favor Ingrese Motivo de Consulta" },
			examenfisico:{ required: "Por favor Ingrese Examen Fisico" },
			fechamestruacion:{ required: "Ingrese Fecha Ultima Mestruaci&oacute;n", date: "Ingrese fecha Valida"  },
			fechacitologia:{ required: "Ingrese Fecha Ultima Citologia", date: "Ingrese fecha Valida"  },
			embarazada: { required: "Seleccione Embarazada" },
			ta:{ required: "Ingrese PA" },
			temperatura : { required : "Ingrese Temp"  },
			fc : { required : "Ingrese FC"  },
			fr:{ required: "Ingrese FR" },
			peso: { required: "Ingrese Peso" },
			atenproced:{ required: "Ingrese Atencion o Procedimiento del Paciente" },
			tratamiento: { required: "Ingrese Conducta o Tratamiento" },
			remision: { required: "Ingrese Remision del Paciente" },
			formula: { required: "Ingrese Dx para F&oacute;rmula M&eacute;dica" },
			observacionformula: { required: "Ingrese Observaci&oacute;n de F&oacute;rmula M&eacute;dica" },
			ordenes: { required: "Ingrese Dx para &Oacute;rden M&eacute;dica" },
			observacionorden: { required: "Ingrese Observaci&oacute;n de &Oacute;rden M&eacute;dica" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#savehoja").serialize();
		var formulario = $('#formulario').val();
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();
	
        if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;

	    } else { 

		$.ajax({

		type : 'POST',
		url  : formulario+'.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX PRESUNTIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX DEFINITIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==4){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR FORMULAS MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==5){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR ORDENES MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==6){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE NO TIENE UNA APERTURA MEDICA, DEBE DE REALIZAR UNA PARA EL CONTROL DE HISTORIAS MEDICAS ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				$("#savehoja")[0].reset();
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
				$("#tabla").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Dx Presuntivo: <span class="symbol required"></span></label><input type="hidden" name="idciepresuntivo[]" id="idciepresuntivo"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="presuntivo[]" id="presuntivo" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Presuntivo" autocomplete="off" required="" aria-required="true"><textarea class="form-control" name="observacionpresuntivo[]" id="observacionpresuntivo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Dx Presuntivo" title="Ingrese Observación de Dx Presuntivo" rows="2" required="" aria-required="true"></textarea></div></td></tr></tbody>');
                $("#tabla2").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Dx Definitivo: <span class="symbol required"></span></label><input type="hidden" name="idciedefinitivo[]" id="idciedefinitivo"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="definitivo[]" id="definitivo" onKeyUp="this.value=this.value.toUpperCase(); autocompletar2(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Definitivo" autocomplete="off" required="" aria-required="true"><textarea class="form-control" name="observaciondefinitivo[]" id="observaciondefinitivo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Dx Definitivo" title="Ingrese Observación de Dx Definitivo" rows="2" required="" aria-required="true"></textarea></div></td></tr></tbody>');
                $("#tabla3").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Fórmula Médica: </label><input type="hidden" name="idcieformula[]" id="idcieformula"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="formula[]" id="formula" onKeyUp="this.value=this.value.toUpperCase(); autocompletarformula(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Fórmula Médica"><textarea class="form-control" name="observacionformula[]" id="observacionformula" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Fórmula Médica" title="Ingrese Observación de Fórmula Médica" rows="2"></textarea></div></td></tr></tbody>');
                $("#tabla4").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Orden Médica: </label><input type="hidden" name="idcieorden[]" id="idcieorden"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="ordenes[]" id="ordenes" onKeyUp="this.value=this.value.toUpperCase(); autocompletarordenes(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Orden Médica"><textarea class="form-control" name="observacionorden[]" id="observacionorden" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Orden Médica" title="Ingrese Observación de Orden Médica" rows="2"></textarea></div></td></tr></tbody>');
			    $("#btn-submit").attr('disabled', false);
				$('#muestracitasxdia').html("");
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE HOJA EVOLUTIVA CONSULTORIO */

/*  FUNCION PARA VALIDAR ACTUALIZACION DE HOJA EVOLUTIVA CONSULTORIO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updatehoja").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			motivoconsulta: { required: true, },
			examenfisico: { required: true, },
			fechamestruacion: { required: true, },
			fechacitologia: { required: false, },
			embarazada: { required: false, },
			ta: { required: true, },
			temperatura: { required: true, },
			fc: { required: true, },
			fr: { required: true, },
			peso: { required: true, },
			atenproced: { required: true },
			tratamiento: { required: true },
			remision: { required: false },
			formula: { required: false },
			observacionformula: { required: false },
			ordenes: { required: false },
			observacionorden: { required: false },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			motivoconsulta:{ required: "Por favor Ingrese Motivo de Consulta" },
			examenfisico:{ required: "Por favor Ingrese Examen Fisico" },
			fechamestruacion:{ required: "Ingrese Fecha Ultima Mestruaci&oacute;n", date: "Ingrese fecha Valida"  },
			fechacitologia:{ required: "Ingrese Fecha Ultima Citologia", date: "Ingrese fecha Valida"  },
			embarazada: { required: "Seleccione Embarazada" },
			ta:{ required: "Ingrese PA" },
			temperatura : { required : "Ingrese Temp"  },
			fc : { required : "Ingrese FC"  },
			fr:{ required: "Ingrese FR" },
			peso: { required: "Ingrese Peso" },
			atenproced:{ required: "Ingrese Atencion o Procedimiento del Paciente" },
			tratamiento: { required: "Ingrese Conducta o Tratamiento" },
			remision: { required: "Ingrese Remision del Paciente" },
			formula: { required: "Ingrese Dx para F&oacute;rmula M&eacute;dica" },
			observacionformula: { required: "Ingrese Observaci&oacute;n de F&oacute;rmula M&eacute;dica" },
			ordenes: { required: "Ingrese Dx para &Oacute;rden M&eacute;dica" },
			observacionorden: { required: "Ingrese Observaci&oacute;n de &Oacute;rden M&eacute;dica" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#updatehoja").serialize();
		var formulario = $('#formulario').val();
		var modulo = $('#modulo').val();
		var codhoja = $('#codhoja').val();
		var codpaciente = $('#codpaciente').val();

		$.ajax({

		type : 'POST',
		url  : formulario+'.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX PRESUNTIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX DEFINITIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==4){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR FORMULAS MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==5){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR ORDENES MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==6){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE NO TIENE UNA APERTURA MEDICA, DEBE DE REALIZAR UNA PARA EL CONTROL DE HISTORIAS MEDICAS ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				    if(modulo == "1"){
				    	setTimeout("location.href='hojasc'", 5000);
				    } else {
				    	setTimeout("location.href='hojasg'", 5000);
				    }

				});
			  }
			}
		});
		return false;
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR ACTUALIZACION DE HOJA EVOLUTIVA CONSULTORIO */













/*  FUNCION PARA VALIDAR REGISTRO DE REMISIONES CONSULTORIO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#saveremision").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			remision: { required: true },
			formula: { required: false },
			observacionformula: { required: false },
			ordenes: { required: false },
			observacionorden: { required: false },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			remision: { required: "Ingrese Remision del Paciente" },
			formula: { required: "Ingrese Dx para F&oacute;rmula M&eacute;dica" },
			observacionformula: { required: "Ingrese Observaci&oacute;n de F&oacute;rmula M&eacute;dica" },
			ordenes: { required: "Ingrese Dx para &Oacute;rden M&eacute;dica" },
			observacionorden: { required: "Ingrese Observaci&oacute;n de &Oacute;rden M&eacute;dica" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#saveremision").serialize();
		var formulario = $('#formulario').val();
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();
	
        if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;

	    } else { 

		$.ajax({

		type : 'POST',
		url  : formulario+'.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR FORMULAS MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR ORDENES MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==4){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA APERTURA MEDICA, DEBE DE REALIZAR UNA PARA EL CONTROL DE HISTORIAS MEDICAS ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				$("#saveremision")[0].reset();
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
                $("#tabla3").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Fórmula Médica: </label><input type="hidden" name="idcieformula[]" id="idcieformula"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="formula[]" id="formula" onKeyUp="this.value=this.value.toUpperCase(); autocompletarformula(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Fórmula Médica"><textarea class="form-control" name="observacionformula[]" id="observacionformula" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Fórmula Médica" title="Ingrese Observación de Fórmula Médica" rows="2"></textarea></div></td></tr></tbody>');
                $("#tabla4").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Orden Médica: </label><input type="hidden" name="idcieorden[]" id="idcieorden"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="ordenes[]" id="ordenes" onKeyUp="this.value=this.value.toUpperCase(); autocompletarordenes(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Orden Médica"><textarea class="form-control" name="observacionorden[]" id="observacionorden" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Orden Médica" title="Ingrese Observación de Orden Médica" rows="2"></textarea></div></td></tr></tbody>');
			    $("#btn-submit").attr('disabled', false);
				$('#muestracitasxdia').html("");
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE REMISIONES CONSULTORIO */

/*  FUNCION PARA VALIDAR ACTUALIZACION DE REMISIONES CONSULTORIO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updateremision").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			remision: { required: true },
			formula: { required: false },
			observacionformula: { required: false },
			ordenes: { required: false },
			observacionorden: { required: false },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			remision: { required: "Ingrese Remision del Paciente" },
			formula: { required: "Ingrese Dx para F&oacute;rmula M&eacute;dica" },
			observacionformula: { required: "Ingrese Observaci&oacute;n de F&oacute;rmula M&eacute;dica" },
			ordenes: { required: "Ingrese Dx para &Oacute;rden M&eacute;dica" },
			observacionorden: { required: "Ingrese Observaci&oacute;n de &Oacute;rden M&eacute;dica" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#updateremision").serialize();
		var formulario = $('#formulario').val();
		var modulo = $('#modulo').val();
		var codremision = $('#codremision').val();
		var codpaciente = $('#codpaciente').val();

		$.ajax({

		type : 'POST',
		url  : formulario+'.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR FORMULAS MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR ORDENES MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==4){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE NO TIENE UNA APERTURA MEDICA, DEBE DE REALIZAR UNA PARA EL CONTROL DE HISTORIAS MEDICAS ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				    if(modulo == "1"){
				    	setTimeout("location.href='remisionesc'", 5000);
				    } else {
				    	setTimeout("location.href='remisionesg'", 5000);
				    }

				});
			  }
			}
		});
		return false;
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR ACTUALIZACION DE REMISIONES CONSULTORIO */












/*  FUNCION PARA VALIDAR REGISTRO DE FORMULAS MEDICAS CONSULTORIO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#saveformulamedica").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			remision: { required: false },
			formula: { required: true },
			observacionformula: { required: true },
			ordenes: { required: false },
			observacionorden: { required: false },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			remision: { required: "Ingrese Remision del Paciente" },
			formula: { required: "Ingrese Dx para F&oacute;rmula M&eacute;dica" },
			observacionformula: { required: "Ingrese Observaci&oacute;n de F&oacute;rmula M&eacute;dica" },
			ordenes: { required: "Ingrese Dx para &Oacute;rden M&eacute;dica" },
			observacionorden: { required: "Ingrese Observaci&oacute;n de &Oacute;rden M&eacute;dica" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#saveformulamedica").serialize();
		var formulario = $('#formulario').val();
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();
	
        if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;

	    } else { 

		$.ajax({

		type : 'POST',
		url  : formulario+'.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR FORMULAS MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR ORDENES MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==4){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA APERTURA MEDICA, DEBE DE REALIZAR UNA PARA EL CONTROL DE HISTORIAS MEDICAS ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				$("#saveformulamedica")[0].reset();
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
                $("#tabla3").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Fórmula Médica: </label><input type="hidden" name="idcieformula[]" id="idcieformula"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="formula[]" id="formula" onKeyUp="this.value=this.value.toUpperCase(); autocompletarformula(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Fórmula Médica"><textarea class="form-control" name="observacionformula[]" id="observacionformula" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Fórmula Médica" title="Ingrese Observación de Fórmula Médica" rows="2"></textarea></div></td></tr></tbody>');
                $("#tabla4").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Orden Médica: </label><input type="hidden" name="idcieorden[]" id="idcieorden"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="ordenes[]" id="ordenes" onKeyUp="this.value=this.value.toUpperCase(); autocompletarordenes(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Orden Médica"><textarea class="form-control" name="observacionorden[]" id="observacionorden" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Orden Médica" title="Ingrese Observación de Orden Médica" rows="2"></textarea></div></td></tr></tbody>');
			    $("#btn-submit").attr('disabled', false);
				$('#muestracitasxdia').html("");
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE FORMULAS MEDICAS CONSULTORIO */

/*  FUNCION PARA VALIDAR ACTUALIZACION DE FORMULAS MEDICAS CONSULTORIO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updateformulamedica").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			remision: { required: false },
			formula: { required: true },
			observacionformula: { required: true },
			ordenes: { required: false },
			observacionorden: { required: false },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			remision: { required: "Ingrese Remision del Paciente" },
			formula: { required: "Ingrese Dx para F&oacute;rmula M&eacute;dica" },
			observacionformula: { required: "Ingrese Observaci&oacute;n de F&oacute;rmula M&eacute;dica" },
			ordenes: { required: "Ingrese Dx para &Oacute;rden M&eacute;dica" },
			observacionorden: { required: "Ingrese Observaci&oacute;n de &Oacute;rden M&eacute;dica" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#updateformulamedica").serialize();
		var formulario = $('#formulario').val();
		var modulo = $('#modulo').val();
		var codformulam = $('#codformulam').val();
		var codpaciente = $('#codpaciente').val();

		$.ajax({

		type : 'POST',
		url  : formulario+'.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR FORMULAS MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR ORDENES MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==4){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE NO TIENE UNA APERTURA MEDICA, DEBE DE REALIZAR UNA PARA EL CONTROL DE HISTORIAS MEDICAS ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				    if(modulo == "1"){
				    	setTimeout("location.href='formulasmedicasc'", 5000);
				    } else {
				    	setTimeout("location.href='formulasmedicasg'", 5000);
				    }

				});
			  }
			}
		});
		return false;
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR ACTUALIZACION DE FORMULAS MEDICAS CONSULTORIO */












/*  FUNCION PARA VALIDAR REGISTRO DE ORDENES MEDICAS CONSULTORIO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#saveordenmedica").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			remision: { required: false },
			formula: { required: false },
			observacionformula: { required: false },
			ordenes: { required: true },
			observacionorden: { required: true },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			remision: { required: "Ingrese Remision del Paciente" },
			formula: { required: "Ingrese Dx para F&oacute;rmula M&eacute;dica" },
			observacionformula: { required: "Ingrese Observaci&oacute;n de F&oacute;rmula M&eacute;dica" },
			ordenes: { required: "Ingrese Dx para &Oacute;rden M&eacute;dica" },
			observacionorden: { required: "Ingrese Observaci&oacute;n de &Oacute;rden M&eacute;dica" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#saveordenmedica").serialize();
		var formulario = $('#formulario').val();
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();
	
        if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;

	    } else { 

		$.ajax({

		type : 'POST',
		url  : formulario+'.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR FORMULAS MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR ORDENES MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==4){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA APERTURA MEDICA, DEBE DE REALIZAR UNA PARA EL CONTROL DE HISTORIAS MEDICAS ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				$("#saveordenmedica")[0].reset();
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
                $("#tabla3").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Fórmula Médica: </label><input type="hidden" name="idcieformula[]" id="idcieformula"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="formula[]" id="formula" onKeyUp="this.value=this.value.toUpperCase(); autocompletarformula(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Fórmula Médica"><textarea class="form-control" name="observacionformula[]" id="observacionformula" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Fórmula Médica" title="Ingrese Observación de Fórmula Médica" rows="2"></textarea></div></td></tr></tbody>');
                $("#tabla4").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Orden Médica: </label><input type="hidden" name="idcieorden[]" id="idcieorden"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="ordenes[]" id="ordenes" onKeyUp="this.value=this.value.toUpperCase(); autocompletarordenes(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Orden Médica"><textarea class="form-control" name="observacionorden[]" id="observacionorden" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Orden Médica" title="Ingrese Observación de Orden Médica" rows="2"></textarea></div></td></tr></tbody>');
			    $("#btn-submit").attr('disabled', false);
				$('#muestracitasxdia').html("");
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE ORDENES MEDICAS CONSULTORIO */

/*  FUNCION PARA VALIDAR ACTUALIZACION DE ORDENES MEDICAS CONSULTORIO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updateordenmedica").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			remision: { required: false },
			formula: { required: false },
			observacionformula: { required: false },
			ordenes: { required: true },
			observacionorden: { required: true },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			remision: { required: "Ingrese Remision del Paciente" },
			formula: { required: "Ingrese Dx para F&oacute;rmula M&eacute;dica" },
			observacionformula: { required: "Ingrese Observaci&oacute;n de F&oacute;rmula M&eacute;dica" },
			ordenes: { required: "Ingrese Dx para &Oacute;rden M&eacute;dica" },
			observacionorden: { required: "Ingrese Observaci&oacute;n de &Oacute;rden M&eacute;dica" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#updateordenmedica").serialize();
		var formulario = $('#formulario').val();
		var modulo = $('#modulo').val();
		var codorden = $('#codorden').val();
		var codpaciente = $('#codpaciente').val();

		$.ajax({

		type : 'POST',
		url  : formulario+'.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR FORMULAS MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR ORDENES MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==4){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE NO TIENE UNA APERTURA MEDICA, DEBE DE REALIZAR UNA PARA EL CONTROL DE HISTORIAS MEDICAS ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				    if(modulo == "1"){
				    	setTimeout("location.href='ordenesmedicasc'", 5000);
				    } else {
				    	setTimeout("location.href='ordenesmedicasg'", 5000);
				    }

				});
			  }
			}
		});
		return false;
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR ACTUALIZACION DE ORDENES MEDICAS CONSULTORIO */











/*  FUNCION PARA VALIDAR REGISTRO DE FORMULAS TERAPIAS CONSULTORIO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#saveformulaterapia").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			terapiasrespiratorias: { required: false },
			terapiasfisicas: { required: false },
			micronebulizaciones: { required: false },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			terapiasrespiratorias: { required: "Ingrese Series DX" },
			terapiasfisicas: { required: "Ingrese Series DX" },
			micronebulizaciones: { required: "Ingrese Micronebulizaciones" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#saveformulaterapia").serialize();
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();

	   	var valor1 = $('#terapiasrespiratorias').val();
	   	var valor2 = $('#terapiasfisicas').val();
	   	var valor3 = $('#micronebulizaciones').val();
	
        if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;

	    } else if (valor1=="" && valor2=="" && valor3=="") {
	 
	            swal("Oops", "POR FAVOR DEBE DE INGRESAR AL MENOS UN TIPO DE TERAPIA!", "error");
				return false;
	    } else { 

		$.ajax({

		type : 'POST',
		url  : 'forformulaterapia.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA FORMULA DE TERAPIA EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				$("#saveformulaterapia")[0].reset();
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
			    $("#btn-submit").attr('disabled', false);
				$('#muestracitasxdia').html("");
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE FORMULAS TERAPIAS CONSULTORIO */

/*  FUNCION PARA VALIDAR ACTUALIZACION DE FORMULAS TERAPIAS CONSULTORIO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updateformulaterapia").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			terapiasrespiratorias: { required: false },
			terapiasfisicas: { required: false },
			micronebulizaciones: { required: false },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			terapiasrespiratorias: { required: "Ingrese Series DX" },
			terapiasfisicas: { required: "Ingrese Series DX" },
			micronebulizaciones: { required: "Ingrese Micronebulizaciones" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#updateformulaterapia").serialize();
		var codformula = $('#codformula').val();
		var codpaciente = $('#codpaciente').val();

	   	var valor1 = $('#terapiasrespiratorias').val();
	   	var valor2 = $('#terapiasfisicas').val();
	   	var valor3 = $('#micronebulizaciones').val();
	
        if (valor1=="" && valor2=="" && valor3=="") {
	 
	            swal("Oops", "POR FAVOR DEBE DE INGRESAR AL MENOS UN TIPO DE TERAPIA!", "error");
				return false;
	    
	    } else { 

		$.ajax({

		type : 'POST',
		url  : 'forformulaterapia.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA FORMULA DE TERAPIA EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});			
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
			    setTimeout("location.href='formulasterapias'", 5000);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR ACTUALIZACION DE FORMULAS TERAPIAS CONSULTORIO */











/*  FUNCION PARA VALIDAR REGISTRO DE SOLICITUD EXAMENES CONSULTORIO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#savesolicitudexamenes").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			cie: { required: true },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			cie: { required: "Realice la búsqueda de Cie 10" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#savesolicitudexamenes").serialize();
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();

	    var idcie = $('#idcie').val();
	
        if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;

	    } else if (idcie=="") {
	 
	            swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DE DX CORRECTAMENTE!", "error");
				return false;

	    } else if ($('input[type=checkbox]:checked').length === 0) {
	 
	            swal("Oops", "POR FAVOR DEBE DE SELECCIONAR AL MENOS UN TIPO DE EXAMEN A SOLICITAR!", "error");
				return false;

	    } else { 

		$.ajax({

		type : 'POST',
		url  : 'forsolicitudexamen.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA SOLICITUD DE EXAMEN EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				$("#savesolicitudexamenes")[0].reset();
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
			    $("#btn-submit").attr('disabled', false);
				$('#muestracitasxdia').html("");
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE SOLICITUD EXAMENES CONSULTORIO */

/*  FUNCION PARA VALIDAR ACTUALIZACION DE SOLICITUD EXAMENES CONSULTORIO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updatesolicitudexamenes").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			cie: { required: true },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			cie: { required: "Realice la búsqueda de Cie 10" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#updatesolicitudexamenes").serialize();
		var codexamen = $('#codexamen').val();
		var codpaciente = $('#codpaciente').val();

	   	var idcie = $('#idcie').val();
	
        if (idcie=="") {
	 
	            swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DE DX CORRECTAMENTE!", "error");
				return false;

	    } else if ($('input[type=checkbox]:checked').length === 0) {
	 
	            swal("Oops", "POR FAVOR DEBE DE SELECCIONAR AL MENOS UN TIPO DE EXAMEN A SOLICITAR!", "error");
				return false;
				
	    } else {  

		$.ajax({

		type : 'POST',
		url  : 'forsolicitudexamen.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA SOLICITUD DE EXAMEN EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});			
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
			    setTimeout("location.href='solicitudexamenes'", 5000);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR ACTUALIZACION DE SOLICITUD EXAMENES CONSULTORIO */














/*  FUNCION PARA VALIDAR REGISTRO DE CRIOCAUTERIZACIONES */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#savecriocauterizacion").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			motivoconsulta: { required: true, },
			atenproced: { required: true },
			presuntivo: { required: true },
			observacionpresuntivo: { required: true },
			definitivo: { required: true },
			observaciondefinitivo: { required: true },
			tratamiento: { required: true },
			remision: { required: false },
			formula: { required: false },
			observacionformula: { required: false },
			ordenes: { required: false },
			observacionorden: { required: false },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			motivoconsulta:{ required: "Por favor Ingrese Motivo de Consulta" },
			atenproced:{ required: "Ingrese Atencion o Procedimiento del Paciente" },
			tratamiento: { required: "Ingrese Conducta o Tratamiento" },
			remision: { required: "Ingrese Remision del Paciente" },
			formula: { required: "Ingrese Dx para F&oacute;rmula M&eacute;dica" },
			observacionformula: { required: "Ingrese Observaci&oacute;n de F&oacute;rmula M&eacute;dica" },
			ordenes: { required: "Ingrese Dx para &Oacute;rden M&eacute;dica" },
			observacionorden: { required: "Ingrese Observaci&oacute;n de &Oacute;rden M&eacute;dica" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#savecriocauterizacion").serialize();
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();
	
        if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;

	    } else { 

		$.ajax({

		type : 'POST',
		url  : 'forcriocauterizacion.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX PRESUNTIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX DEFINITIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==4){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR FORMULAS MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==5){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR ORDENES MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}   
			else if(data==6){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE NO TIENE UNA APERTURA MEDICA, DEBE DE REALIZAR UNA PARA EL CONTROL DE HISTORIAS MEDICAS ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				$("#savecriocauterizacion")[0].reset();
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
				$("#tabla").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Dx Presuntivo: <span class="symbol required"></span></label><input type="hidden" name="idciepresuntivo[]" id="idciepresuntivo"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="presuntivo[]" id="presuntivo" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Presuntivo" autocomplete="off" required="" aria-required="true"><textarea class="form-control" name="observacionpresuntivo[]" id="observacionpresuntivo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Dx Presuntivo" title="Ingrese Observación de Dx Presuntivo" rows="2" required="" aria-required="true"></textarea></div></td></tr></tbody>');
                $("#tabla2").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Dx Definitivo: <span class="symbol required"></span></label><input type="hidden" name="idciedefinitivo[]" id="idciedefinitivo"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="definitivo[]" id="definitivo" onKeyUp="this.value=this.value.toUpperCase(); autocompletar2(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Definitivo" autocomplete="off" required="" aria-required="true"><textarea class="form-control" name="observaciondefinitivo[]" id="observaciondefinitivo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Dx Definitivo" title="Ingrese Observación de Dx Definitivo" rows="2" required="" aria-required="true"></textarea></div></td></tr></tbody>');
                $("#tabla3").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Fórmula Médica: </label><input type="hidden" name="idcieformula[]" id="idcieformula"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="formula[]" id="formula" onKeyUp="this.value=this.value.toUpperCase(); autocompletarformula(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Fórmula Médica"><textarea class="form-control" name="observacionformula[]" id="observacionformula" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Fórmula Médica" title="Ingrese Observación de Fórmula Médica" rows="2"></textarea></div></td></tr></tbody>');
                $("#tabla4").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Orden Médica: </label><input type="hidden" name="idcieorden[]" id="idcieorden"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="ordenes[]" id="ordenes" onKeyUp="this.value=this.value.toUpperCase(); autocompletarordenes(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Orden Médica"><textarea class="form-control" name="observacionorden[]" id="observacionorden" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Orden Médica" title="Ingrese Observación de Orden Médica" rows="2"></textarea></div></td></tr></tbody>');
			    $("#btn-submit").attr('disabled', false);
				$('#muestracitasxdia').html("");
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE CRIOCAUTERIZACIONES */

/*  FUNCION PARA VALIDAR ACTUALIZACION DE CRIOCAUTERIZACIONES */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updatecriocauterizacion").validate({
		rules:
	    {
			numeropaciente: { required: false },
			codmedico: { required: false },
			motivoconsulta: { required: true, },
			atenproced: { required: true },
			presuntivo: { required: true },
			observacionpresuntivo: { required: true },
			definitivo: { required: true },
			observaciondefinitivo: { required: true },
			tratamiento: { required: true },
			remision: { required: false },
			formula: { required: false },
			observacionformula: { required: false },
			ordenes: { required: false },
			observacionorden: { required: false },
	    },
        messages:
	    {
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			motivoconsulta:{ required: "Por favor Ingrese Motivo de Consulta" },
			atenproced:{ required: "Ingrese Atencion o Procedimiento del Paciente" },
			observaciondefinitivo: { required: "Ingrese Observaci&oacute;n de Dx Definitivo" },
			tratamiento: { required: "Ingrese Conducta o Tratamiento" },
			remision: { required: "Ingrese Remision del Paciente" },
			formula: { required: "Ingrese Dx para F&oacute;rmula M&eacute;dica" },
			observacionformula: { required: "Ingrese Observaci&oacute;n de F&oacute;rmula M&eacute;dica" },
			ordenes: { required: "Ingrese Dx para &Oacute;rden M&eacute;dica" },
			observacionorden: { required: "Ingrese Observaci&oacute;n de &Oacute;rden M&eacute;dica" },
        },
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#updatecriocauterizacion").serialize();
		var codcriocauterizacion = $('#codcriocauterizacion').val();
		var codpaciente = $('#codpaciente').val();

		$.ajax({

		type : 'POST',
		url  : 'forcriocauterizacion.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX PRESUNTIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX DEFINITIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==4){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR FORMULAS MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==5){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR ORDENES MEDICAS REPETIDAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			}   
			else if(data==6){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE NO TIENE UNA APERTURA MEDICA, DEBE DE REALIZAR UNA PARA EL CONTROL DE HISTORIAS MEDICAS ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				    setTimeout("location.href='criocauterizaciones'", 5000);
				});
			  }
			}
		});
		return false;
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR ACTUALIZACION DE CRIOCAUTERIZACIONES */









/*  FUNCION PARA VALIDAR REGISTRO DE COLPOSCOPIAS */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#savecolposcopia").validate({
		rules:
		{
			numeropaciente: { required: false },
			codmedico: { required: false },
			impresiondiagnostica: { required: true },
			observacionesimpresion: { required: true },
			otros: { required: true },
			biopsia: { required: true },
		},
		messages:
		{
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			impresiondiagnostica:{ required: "Ingrese Resultado" },
			observacionesimpresion:{ required: "Ingrese Observaciones" },
			otros:{ required: "Ingrese Otros" },
			biopsia:{ required: "Ingrese Sitio de Biopsia" },
		},
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#savecolposcopia").serialize();
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();
	
        if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;

	    } else { 

		$.ajax({

		type : 'POST',
		url  : 'forcolposcopia.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA COLPOSCOPIA EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				$("#savecolposcopia")[0].reset();
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
			    $("#btn-submit").attr('disabled', false);
				$('#muestracitasxdia').html("");
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE COLPOSCOPIA */

/*  FUNCION PARA VALIDAR ACTUALIZACION DE COLPOSCOPIA */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updatecolposcopia").validate({
		rules:
		{
			numeropaciente: { required: false },
			codmedico: { required: false },
			impresiondiagnostica: { required: true },
			observacionesimpresion: { required: true },
			otros: { required: true },
			biopsia: { required: true },
		},
		messages:
		{
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			impresiondiagnostica:{ required: "Ingrese Resultado" },
			observacionesimpresion:{ required: "Ingrese Observaciones" },
			otros:{ required: "Ingrese Otros" },
			biopsia:{ required: "Ingrese Sitio de Biopsia" },
		},
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#updatecolposcopia").serialize();
		var codcolposcopia = $('#codcolposcopia').val();
		var codpaciente = $('#codpaciente').val();

		$.ajax({

		type : 'POST',
		url  : 'forcolposcopia.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA COLPOSCOPIA EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
			    setTimeout("location.href='colposcopias'", 5000);

				});
			  }
			}
		});
		return false;
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR ACTUALIZACION DE COLPOSCOPIAS */
















/*  FUNCION PARA VALIDAR REGISTRO DE ECOGRAFIAS */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#saveecografia").validate({
		rules:
		{
			numeropaciente: { required: false },
			codmedico: { required: false },
			procedimiento: { required: false },
			diagnostico: { required: true },
		},
		messages:
		{
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			procedimiento:{ required: "Ingrese Procedimiento" },
			diagnostico:{ required: "Ingrese Descripción Ecográfica" },
		},
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#saveecografia").serialize();
		var formData = new FormData($("#saveecografia")[0]);
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();
	
        if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;

	    } else { 
		
		$.ajax({
		type : 'POST',
		url  : 'forecografia.php',
		data : formData,
		//necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> LOS ARCHIVOS CARGADOS NO SON IMAGENES ACEPTADAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}  
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA ECOGRAFIA EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});

			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				/*$("#save").html('<center> &nbsp; '+data+' </center>');*/
				$("#saveecografia")[0].reset();
				$("#tabla_ecografia").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label alert-link">Imagen Ecográfica: </label><br><input type="file" class="form-control" data-original-title="Subir Ecografias" data-rel="tooltip" placeholder="Suba su Ecografia" name="file[]" id="file"/><small><p>Para Subir la Imagen debe tener en cuenta:<br> * La Imagen debe ser extension.jpeg,jpg,png,gif<br> * La imagen no debe ser mayor de 200 KB</p></small></div></td></tr></tbody>');
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
			    $("#btn-submit").attr('disabled', false);
				$('#muestracitasxdia').html("");
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE ECOGRAFIAS */

/*  FUNCION PARA VALIDAR ACTUALIZACION DE ECOGRAFIAS */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updateecografia").validate({
		rules:
		{
			numeropaciente: { required: false },
			codmedico: { required: false },
			procedimiento: { required: false },
			diagnostico: { required: true },
		},
		messages:
		{
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			procedimiento:{ required: "Ingrese Procedimiento" },
			diagnostico:{ required: "Ingrese Descripción Ecográfica" },
		},
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#updateecografia").serialize();
		var formData = new FormData($("#updateecografia")[0]);
		var codecografia = $('#codecografia').val();
		var codpaciente = $('#codpaciente').val();

		$.ajax({
		type : 'POST',
		url  : 'forecografia.php',
	    async : false,
		data : formData,
		//necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> LOS ARCHIVOS CARGADOS NO SON IMAGENES ACEPTADAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});
			}  
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA ECOGRAFIA EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});

			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
			    setTimeout("location.href='ecografias'", 5000);

				});
			  }
			}
		});
		return false;
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR ACTUALIZACION DE ECOGRAFIAS */














/*  FUNCION PARA VALIDAR REGISTRO DE EXAMENES */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#savelaboratorio").validate({
		rules:
		{
			numeropaciente: { required: false },
			codmedico: { required: false },
		},
		messages:
		{
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
		},
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#savelaboratorio").serialize();
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();

		var valor1 = $('#hematocrito').val();
		var valor2 = $('#hemoglobina').val();
		var valor3 = $('#leucocitos').val();
		var valor4 = $('#neutrofilos').val();
		var valor5 = $('#linfocitos').val();
		var valor6 = $('#eosinofilos').val();
		var valor7 = $('#monositos').val();
		var valor8 = $('#basofilos').val();
		var valor9 = $('#cayados').val();
		var valor10 = $('#plaquetas').val();
		var valor11 = $('#reticulositos').val();
		var valor12 = $('#vsg').val();
		var valor13 = $('#pt').val();
		var valor14 = $('#ptt').val();
		var valor15 = $('#clasifgrupo').val();
		var valor16 = $('#clasifrh').val();
		var valor17 = $('#observacioneshematologia').val();
		var valor18 = $('#glucosa').val();
		var valor19 = $('#colesteroltotal').val();
		var valor20 = $('#colesterolhdl').val();
		var valor21 = $('#colesterolldl').val();
		var valor22 = $('#trigliceridos').val();
		var valor23 = $('#acidourico').val();
		var valor24 = $('#nitrogenoureico').val();
		var valor25 = $('#creatinina').val();
		var valor26 = $('#proteinastotales').val();
		var valor27 = $('#albumina').val();
		var valor28 = $('#globulina').val();
		var valor29 = $('#bilirrubinatotal').val();
		var valor30 = $('#bilirrubinadirecta').val();
		var valor31 = $('#bilirrubinaindirecta').val();
		var valor32 = $('#fosfatasaalcalina').val();
		var valor33 = $('#tgo').val();
		var valor34 = $('#tgp').val();
		var valor35 = $('#amilasa').val();
		var valor36 = $('#observacionesquimica').val();
		var valor37 = $('#colorquimico').val();
		var valor38 = $('#aspectoquimico').val();
		var valor39 = $('#phquimico').val();
		var valor40 = $('#densidadquimico').val();
		var valor41 = $('#proteinaquimico').val();
		var valor42 = $('#glucosaquimico').val();
		var valor43 = $('#cetonaquimico').val();
		var valor44 = $('#bilirrubinaquimico').val();
		var valor45 = $('#urobilinogenoquimico').val();
		var valor46 = $('#sangrequimico').val();
		var valor47 = $('#leucocitosquimico').val();
		var valor48 = $('#nitritosquimico').val();
		var valor49 = $('#celulasepibajas').val();
		var valor50 = $('#celulasepialtas').val();
		var valor51 = $('#bacteriasmicroscopico').val();
		var valor52 = $('#leucocitosmicroscopico').val();
		var valor53 = $('#hematiesmicroscopico').val();
		var valor54 = $('#cristalesmicroscopico').val();
		var valor55 = $('#cilindrosmicroscopico').val();
		var valor56 = $('#mocomicroscopico').val();
		var valor57 = $('#observacionesuroanalisis').val();
		var valor58 = $('#pruebaembarazo').val();
		var valor59 = $('#rprsisfilis').val();
		var valor60 = $('#ratest').val();
		var valor61 = $('#astos').val();
		var valor62 = $('#observacionesinmunologia').val();
		var valor63 = $('#phfresco').val();
		var valor64 = $('#celulasfresco').val();
		var valor65 = $('#testaminafresco').val();
		var valor66 = $('#hongosfresco').val();
		var valor67 = $('#trichomonafresco').val();
		var valor68 = $('#leucitofresco').val();
		var valor69 = $('#hematiesfresco').val();
		var valor70 = $('#basilosgranpositivo').val();
		var valor71 = $('#basilosgrannegativo').val();
		var valor72 = $('#cocobacilogran').val();
		var valor73 = $('#diplococogran').val();
		var valor74 = $('#blastoconidiasgran').val();
		var valor75 = $('#pseudomiceliogran').val();
		var valor76 = $('#pmngran').val();
		var valor77 = $('#observacionesfrotis').val();
		var valor78 = $('#colorparasitologia').val();
		var valor79 = $('#consistenciaparasitologia').val();
		var valor80 = $('#phparasitologia').val();
		var valor81 = $('#sangreocultaparasitologia').val();
		var valor82 = $('#azucaresparasitologia').val();
		var valor83 = $('#almidonesparasitologia').val();
		var valor84 = $('#hongosparasitologia').val();
		var valor85 = $('#trichomonaparasitologia').val();
		var valor86 = $('#iodamoebaparasitologia').val();
		var valor87 = $('#otrosparasitologia').val();
		var valor88 = $('#kohmicro').val();
		var valor89 = $('#baciloscopiamicro').val();
	
        if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;
	 
	    } else if (valor1=="" && valor2=="" && valor3=="" && valor4=="" && valor5=="" && valor6=="" && valor7=="" && valor8=="" && valor9=="" && valor10=="" && valor11=="" && valor12=="" && valor13=="" && valor14=="" && valor15=="" && valor16=="" && valor17=="" && valor18=="" && valor19=="" && valor20=="" && valor21=="" && valor22=="" && valor23=="" && valor24=="" && valor25=="" && valor26=="" && valor27=="" && valor28=="" && valor29=="" && valor30=="" && valor31=="" && valor32=="" && valor33=="" && valor34=="" && valor35=="" && valor36=="" && valor37=="" && valor38=="" && valor39=="" && valor40=="" && valor41=="" && valor42=="" && valor43=="" && valor44=="" && valor45=="" && valor46=="" && valor47=="" && valor48=="" && valor49=="" && valor50=="" && valor51=="" && valor52=="" && valor53=="" && valor54=="" && valor55=="" && valor56=="" && valor57=="" && valor58=="" && valor59=="" && valor60=="" && valor61=="" && valor62=="" && valor63=="" && valor64=="" && valor65=="" && valor66=="" && valor67=="" && valor68=="" && valor69=="" && valor70=="" && valor71=="" && valor72=="" && valor73=="" && valor74=="" && valor75=="" && valor76=="" && valor77=="" && valor78=="" && valor79=="" && valor80=="" && valor81=="" && valor82=="" && valor83=="" && valor84=="" && valor85=="" && valor86=="" && valor87=="" && valor88=="" && valor89=="") {
	 
	 
			swal("Oops", "POR FAVOR DEBE DE INGRESAR AL MENOS UN TIPO DE EXAMEN DE LABORATORIO!", "error");
			return false;
	 
	    } else { 

		$.ajax({
		type : 'POST',
		url  : 'forlaboratorio.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UN EXAMEN EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				$("#savelaboratorio")[0].reset();
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
			    $("#btn-submit").attr('disabled', false);
				$('#muestracitasxdia').html("");
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE EXAMENES */

/*  FUNCION PARA VALIDAR ACTUALIZACION DE EXAMENES */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updatelaboratorio").validate({
		rules:
		{
			numeropaciente: { required: false },
			codmedico: { required: false },
		},
		messages:
		{
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
		},
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#updatelaboratorio").serialize();
		var codlaboratorio = $('#codlaboratorio').val();

		var valor1 = $('#hematocrito').val();
		var valor2 = $('#hemoglobina').val();
		var valor3 = $('#leucocitos').val();
		var valor4 = $('#neutrofilos').val();
		var valor5 = $('#linfocitos').val();
		var valor6 = $('#eosinofilos').val();
		var valor7 = $('#monositos').val();
		var valor8 = $('#basofilos').val();
		var valor9 = $('#cayados').val();
		var valor10 = $('#plaquetas').val();
		var valor11 = $('#reticulositos').val();
		var valor12 = $('#vsg').val();
		var valor13 = $('#pt').val();
		var valor14 = $('#ptt').val();
		var valor15 = $('#clasifgrupo').val();
		var valor16 = $('#clasifrh').val();
		var valor17 = $('#observacioneshematologia').val();
		var valor18 = $('#glucosa').val();
		var valor19 = $('#colesteroltotal').val();
		var valor20 = $('#colesterolhdl').val();
		var valor21 = $('#colesterolldl').val();
		var valor22 = $('#trigliceridos').val();
		var valor23 = $('#acidourico').val();
		var valor24 = $('#nitrogenoureico').val();
		var valor25 = $('#creatinina').val();
		var valor26 = $('#proteinastotales').val();
		var valor27 = $('#albumina').val();
		var valor28 = $('#globulina').val();
		var valor29 = $('#bilirrubinatotal').val();
		var valor30 = $('#bilirrubinadirecta').val();
		var valor31 = $('#bilirrubinaindirecta').val();
		var valor32 = $('#fosfatasaalcalina').val();
		var valor33 = $('#tgo').val();
		var valor34 = $('#tgp').val();
		var valor35 = $('#amilasa').val();
		var valor36 = $('#observacionesquimica').val();
		var valor37 = $('#colorquimico').val();
		var valor38 = $('#aspectoquimico').val();
		var valor39 = $('#phquimico').val();
		var valor40 = $('#densidadquimico').val();
		var valor41 = $('#proteinaquimico').val();
		var valor42 = $('#glucosaquimico').val();
		var valor43 = $('#cetonaquimico').val();
		var valor44 = $('#bilirrubinaquimico').val();
		var valor45 = $('#urobilinogenoquimico').val();
		var valor46 = $('#sangrequimico').val();
		var valor47 = $('#leucocitosquimico').val();
		var valor48 = $('#nitritosquimico').val();
		var valor49 = $('#celulasepibajas').val();
		var valor50 = $('#celulasepialtas').val();
		var valor51 = $('#bacteriasmicroscopico').val();
		var valor52 = $('#leucocitosmicroscopico').val();
		var valor53 = $('#hematiesmicroscopico').val();
		var valor54 = $('#cristalesmicroscopico').val();
		var valor55 = $('#cilindrosmicroscopico').val();
		var valor56 = $('#mocomicroscopico').val();
		var valor57 = $('#observacionesuroanalisis').val();
		var valor58 = $('#pruebaembarazo').val();
		var valor59 = $('#rprsisfilis').val();
		var valor60 = $('#ratest').val();
		var valor61 = $('#astos').val();
		var valor62 = $('#observacionesinmunologia').val();
		var valor63 = $('#phfresco').val();
		var valor64 = $('#celulasfresco').val();
		var valor65 = $('#testaminafresco').val();
		var valor66 = $('#hongosfresco').val();
		var valor67 = $('#trichomonafresco').val();
		var valor68 = $('#leucitofresco').val();
		var valor69 = $('#hematiesfresco').val();
		var valor70 = $('#basilosgranpositivo').val();
		var valor71 = $('#basilosgrannegativo').val();
		var valor72 = $('#cocobacilogran').val();
		var valor73 = $('#diplococogran').val();
		var valor74 = $('#blastoconidiasgran').val();
		var valor75 = $('#pseudomiceliogran').val();
		var valor76 = $('#pmngran').val();
		var valor77 = $('#observacionesfrotis').val();
		var valor78 = $('#colorparasitologia').val();
		var valor79 = $('#consistenciaparasitologia').val();
		var valor80 = $('#phparasitologia').val();
		var valor81 = $('#sangreocultaparasitologia').val();
		var valor82 = $('#azucaresparasitologia').val();
		var valor83 = $('#almidonesparasitologia').val();
		var valor84 = $('#hongosparasitologia').val();
		var valor85 = $('#trichomonaparasitologia').val();
		var valor86 = $('#iodamoebaparasitologia').val();
		var valor87 = $('#otrosparasitologia').val();
		var valor88 = $('#kohmicro').val();
		var valor89 = $('#baciloscopiamicro').val();
	
        if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;
	 
	    } else if (valor1=="" && valor2=="" && valor3=="" && valor4=="" && valor5=="" && valor6=="" && valor7=="" && valor8=="" && valor9=="" && valor10=="" && valor11=="" && valor12=="" && valor13=="" && valor14=="" && valor15=="" && valor16=="" && valor17=="" && valor18=="" && valor19=="" && valor20=="" && valor21=="" && valor22=="" && valor23=="" && valor24=="" && valor25=="" && valor26=="" && valor27=="" && valor28=="" && valor29=="" && valor30=="" && valor31=="" && valor32=="" && valor33=="" && valor34=="" && valor35=="" && valor36=="" && valor37=="" && valor38=="" && valor39=="" && valor40=="" && valor41=="" && valor42=="" && valor43=="" && valor44=="" && valor45=="" && valor46=="" && valor47=="" && valor48=="" && valor49=="" && valor50=="" && valor51=="" && valor52=="" && valor53=="" && valor54=="" && valor55=="" && valor56=="" && valor57=="" && valor58=="" && valor59=="" && valor60=="" && valor61=="" && valor62=="" && valor63=="" && valor64=="" && valor65=="" && valor66=="" && valor67=="" && valor68=="" && valor69=="" && valor70=="" && valor71=="" && valor72=="" && valor73=="" && valor74=="" && valor75=="" && valor76=="" && valor77=="" && valor78=="" && valor79=="" && valor80=="" && valor81=="" && valor82=="" && valor83=="" && valor84=="" && valor85=="" && valor86=="" && valor87=="" && valor88=="" && valor89=="") {
	 
	 
			swal("Oops", "POR FAVOR DEBE DE INGRESAR AL MENOS UN TIPO DE EXAMEN DE LABORATORIO!", "error");
			return false;
	 
	    } else { 

		$.ajax({

		type : 'POST',
		url  : 'forlaboratorio.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UN EXAMEN EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
			    setTimeout("location.href='laboratorios'", 5000);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR ACTUALIZACION DE EXAMENES */















/*  FUNCION PARA VALIDAR REGISTRO DE RADIOLOGIA */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#saveradiologia").validate({
		rules:
		{
			numeropaciente: { required: false },
			codmedico: { required: false },
			tipoestudio: { required: false },
			diagnostico: { required: true },
		},
		messages:
		{
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			tipoestudio:{ required: "Ingrese Tipo de Estudio" },
			diagnostico:{ required: "Ingrese Diagnóstico" },
		},
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#saveradiologia").serialize();
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();
	
        if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;

	    } else { 

		$.ajax({

		type : 'POST',
		url  : 'forradiologia.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA LECTURA RX EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				$("#saveradiologia")[0].reset();
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
			    $("#btn-submit").attr('disabled', false);
			    $("#tipoestudio").attr('disabled', true);
			    $("#diagnostico").attr('disabled', true);
			    $("#BotonPlantilla").attr('disabled', true);
				$('#muestracitasxdia').html("");
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE RADIOLOGIA */

/*  FUNCION PARA VALIDAR ACTUALIZACION DE RADIOLOGIA */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updateradiologia").validate({
		rules:
		{
			numeropaciente: { required: false },
			codmedico: { required: false },
			tipoestudio: { required: false },
			diagnostico: { required: true },
		},
		messages:
		{
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			tipoestudio:{ required: "Ingrese Tipo de Estudio" },
			diagnostico:{ required: "Ingrese Diagnóstico" },
		},
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#updateradiologia").serialize();
		var codradiologia = $('#codradiologia').val();
		var codpaciente = $('#codpaciente').val();

		$.ajax({

		type : 'POST',
		url  : 'forradiologia.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA LECTURA RX EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
			    setTimeout("location.href='radiologias'", 5000);

				});
			  }
			}
		});
		return false;
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR ACTUALIZACION DE RADIOLOGIA */
















/*  FUNCION PARA VALIDAR REGISTRO DE TERAPIAS */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#saveterapia").validate({
		rules:
		{
			numeropaciente: { required: false },
			codmedico: { required: false },
			diagnostico: { required: true },
			observaciones: { required: true },
		},
		messages:
		{
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			diagnostico:{ required: "Ingrese Diagnóstico" },
			observaciones:{ required: "Seleccione Médico" },
		},
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#saveterapia").serialize();
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();
	
        if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;

	    } else { 

		$.ajax({

		type : 'POST',
		url  : 'forterapia.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> LAS FECHAS DE TERAPIAS NO PUEDEN SER IGUALES, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}  
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> LAS FECHAS DE TERAPIAS NO PUEDEN REPETIRSE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			}
			else if(data==4){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA TERAPIA EN PROCESO ACTUALMENTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				$("#saveterapia")[0].reset();
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
			    $("#btn-submit").attr('disabled', false);
			    $("#observaciones").attr('disabled', true);
				$('#muestracitasxdia').html("");
				$("#muestra_ciclos").load("funciones.php?BuscaFormularioTerapias=si&codsucursal="+codsucursal+"&codmedico="+codmedico+"&codpaciente="+codpaciente);
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE TERAPIAS */

/*  FUNCION PARA VALIDAR ACTUALIZACION DE TERAPIAS */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updateterapia").validate({
		rules:
		{
			numeropaciente: { required: false },
			codmedico: { required: false },
			diagnostico: { required: true },
			observaciones: { required: true },
		},
		messages:
		{
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			diagnostico:{ required: "Ingrese Diagnóstico" },
			observaciones:{ required: "Seleccione Médico" },
		},
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#updateterapia").serialize();
		var codterapia = $('#codterapia').val();
		var codpaciente = $('#codpaciente').val();

		$.ajax({

		type : 'POST',
		url  : 'forterapia.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				});
			}   
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> LAS FECHAS DE TERAPIAS NO PUEDEN SER IGUALES, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			} 
			else if(data==3){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA TERAPIA EN PROCESO ACTUALMENTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);

				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
			    setTimeout("location.href='terapias'", 5000);

				});
			  }
			}
		});
		return false;
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR ACTUALIZACION DE TERAPIAS */

























/* FUNCION JQUERY PARA VALIDAR REGISTRO DE ODONTOLOGIA */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#saveodontologia").validate({
		rules:
		{
			numeropaciente: { required: false },
			codmedico: { required: false },
			motivo_consulta: { required: true },
			problema_actual: { required: true },
			observaciones_antecedentes: { required: false },
			presion_arterial: { required: true },
			frecuencia_cardiaca: { required: true },
			temperatura: { required: true },
			frecuencia_respiratoria: { required: true },
			observaciones_examen: { required: false },
			observaciones_planes: { required: false },
			presuntivo: { required: false },
			definitivo: { required: false },
			diagnostico: { required: true },
			procedimientos: { required: true },
			prescripciones: { required: true },
		},
		messages:
		{
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			motivo_consulta: { required: "Ingrese Motivo de Consulta" },
			problema_actual: { required: "Ingrese Enfermedad" },
			observaciones_antecedentes: { required: "Ingrese Observaciones" },
			presion_arterial: { required: "Ingrese Presion Arterial" },
			frecuencia_cardiaca: { required: "Ingrese Frecuencia Cardiaca" },
			temperatura: { required: "Ingrese Temperatura" },
			frecuencia_respiratoria: { required: "Ingrese Frecuencia Respiratoria" },
			observaciones_examen: { required: "Ingrese Observaciones" },
			observaciones_planes: { required: "Ingrese Observaciones" },
			diagnostico: { required: "Ingrese Diagnostico" },
			procedimientos: { required: "Ingrese Procedimientos" },
			prescripciones: { required: "Ingrese Prescripciones" },
		},
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#saveodontologia").serialize();
		var formData = new FormData($("#saveodontologia")[0]);
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();

		var codpaciente2 = $('#paciente').val();
		var estados = $('#estados').val();
	
	    if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;

	    } else if (estados=="") {
				
			swal("Oops", "POR FAVOR DEBE DE AGREGAR REFERENCIAS DE ODONTOGRAMA AL PACIENTE!", "error");
			return false;
	 
	    } else {

		$.ajax({
		type : 'POST',
		url  : 'forodontologia.php',
	    async : false,
		data : formData,
		//necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				
				});
			} 
			else if(data==2){

			    $("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE REGISTRAR REFERENCIAS DE TRATAMIENTOS AL ODONTOGRAMA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				
				});
			}
			else if(data==3){
									
				$("#save").fadeIn(1000, function(){
									
			    var n = noty({
                text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX PRESUNTIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                theme: 'defaultTheme',
                layout: 'center',
                type: 'warning',
                timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
								 
				}); 															
			}
        	else if(data==4){
									
				$("#save").fadeIn(1000, function(){
									
			    var n = noty({
                text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX DEFINITIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                theme: 'defaultTheme',
                layout: 'center',
                type: 'warning',
                timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
								 
				}); 															
			}
			else if(data==5){

			    $("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UNA APERTURA ODONTOLOGICA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'error',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				
				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });

				$("#saveodontologia")[0].reset();
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
				$("#tabla").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label">Dx Presuntivo: <span class="symbol required"></span></label><input type="hidden" name="idciepresuntivoingreso[]" id="idciepresuntivoingreso"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="presuntivoingreso[]" id="presuntivoingreso" onKeyUp="this.value=this.value.toUpperCase(); autocompletarpresingreso(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Presuntivo" autocomplete="off"></div></td></tr></tbody>');
				$("#tabla2").html('<tbody><tr><td><div class="form-group has-feedback"><label class="control-label">Dx Definitivo: <span class="symbol required"></span></label><input type="hidden" name="idciedefinitivoingreso[]" id="idciedefinitivoingreso"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="definitivoingreso[]" id="definitivoingreso" onKeyUp="this.value=this.value.toUpperCase(); autocompletardefingreso(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Definitivo" autocomplete="off"></div></td></tr></tbody>');
				$("#guarda").attr('disabled', true);
				$("#agrega").attr('disabled', true);
				$("#tablaTratamiento").html("");
				cargarDientes("seccionDientes", "dientes.php", '', '0', '0');
			    $("#btn-submit").attr('disabled', false);
				$('#muestracitasxdia').html("");
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);

				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE ODONTOLOGIA */

/* FUNCION JQUERY PARA VALIDAR REGISTRO DE HOJA EVOLUTIVA */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#savehojaodontologia").validate({
		rules:
		{
			numeropaciente: { required: false },
			codmedico: { required: false },
			diagnostico: { required: true },
			procedimientos: { required: true },
			prescripciones: { required: true },
		},
		messages:
		{
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			diagnostico: { required: "Ingrese Diagnostico" },
			procedimientos: { required: "Ingrese Procedimientos" },
			prescripciones: { required: "Ingrese Prescripciones" },
		},
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#savehojaodontologia").serialize();
		var formData = new FormData($("#savehojaodontologia")[0]);
		var codverifica = $('#verifica_busqueda').val();
		var codsucursal = $('#sucursal_busqueda').val();
		var codespecialidad = $('#especialidad_busqueda').val();
		var codmedico = $('#medico_busqueda').val();
		var fecha = $("#fecha_busqueda").val();
		var codpaciente = $('#codpaciente').val();
		var estados = $('#estados').val();
	
	    if (estados=="") {
				
			swal("Oops", "POR FAVOR DEBE DE AGREGAR REFERENCIAS DE ODONTOGRAMA AL PACIENTE!", "error");
			return false;
	 
	    } else if (codpaciente == "" || codpaciente == 0){
	 
			swal("Oops", "POR FAVOR REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE!", "error");
			return false;

	    } else {

		$.ajax({
		type : 'POST',
		url  : 'forhojaodontologia.php',
	    async : false,
		data : formData,
		//necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE REGISTRAR REFERENCIAS DE TRATAMIENTOS AL ODONTOGRAMA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				
				});
			} 
			else if(data==3){

			    $("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE NO TIENE HISTORIA ODONTOLOGICA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'error',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				
				});
			} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				$("#savehojaodontologia")[0].reset();
				$("#codcita").val("");
				$("#codpaciente").val("");
				$("#verifica_busqueda").val("");
				$("#sucursal_busqueda").val("");
				$("#especialidad_busqueda").val("");
				$("#medico_busqueda").val("");
				$("#fecha_busqueda").val("");
			    $("#guarda").attr('disabled', true);
				$("#agrega").attr('disabled', true);
				$("#tablaTratamiento").html("");
				cargarDientes("seccionDientes", "dientes.php", '', '0', '0');
			    $("#btn-submit").attr('disabled', false);
				$('#muestracitasxdia').html("");
				$("#muestracitasxdia").load("consultas.php?BuscaCitasxDia=si&codverifica="+codverifica+"&codsucursal="+codsucursal+"&codespecialidad="+codespecialidad+"&codmedico="+codmedico+"&fecha="+fecha);				
				});
			  }
			}
		});
		return false;
	    }
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE HOJA EVOLUTIVA */

/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE ODONTOLOGIA */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updateodontologia").validate({
		rules:
		{
			numeropaciente: { required: false },
			codmedico: { required: false },
			motivo_consulta: { required: true },
			problema_actual: { required: true },
			observaciones_antecedentes: { required: false },
			presion_arterial: { required: true },
			frecuencia_cardiaca: { required: true },
			temperatura: { required: true },
			frecuencia_respiratoria: { required: true },
			observaciones_examen: { required: false },
			observaciones_planes: { required: false },
			presuntivo: { required: false },
			definitivo: { required: false },
			diagnostico: { required: true },
			procedimientos: { required: true },
			prescripciones: { required: true },
		},
		messages:
		{
			numeropaciente:{ required: "Realice la Busqueda de Paciente" },
			codmedico:{ required: "Seleccione Médico" },
			motivo_consulta: { required: "Ingrese Motivo de Consulta" },
			problema_actual: { required: "Ingrese Enfermedad" },
			observaciones_antecedentes: { required: "Ingrese Observaciones" },
			presion_arterial: { required: "Ingrese Presion Arterial" },
			frecuencia_cardiaca: { required: "Ingrese Frecuencia Cardiaca" },
			temperatura: { required: "Ingrese Temperatura" },
			frecuencia_respiratoria: { required: "Ingrese Frecuencia Respiratoria" },
			observaciones_examen: { required: "Ingrese Observaciones" },
			observaciones_planes: { required: "Ingrese Observaciones" },
			diagnostico: { required: "Ingrese Diagnostico" },
			procedimientos: { required: "Ingrese Procedimientos" },
			prescripciones: { required: "Ingrese Prescripciones" },
		},
	    submitHandler: function(form) {	

		var data = $("#updateodontologia").serialize();
		var formData = new FormData($("#updateodontologia")[0]);
		var cododontologia = $('input#cododontologia').val();
		var codpaciente = $('#paciente').val();
		var estados = $('#estados').val();
	
	    if (estados=="") {
				
			swal("Oops", "POR FAVOR DEBE DE AGREGAR REFERENCIAS DE ODONTOGRAMA AL PACIENTE!", "error");
			return false;
	 
	    } else {

        $.ajax({
		type : 'POST',
		url  : 'forodontologia.php',
	    async : false,
		data : formData,
		//necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
		beforeSend: function()
        {	
        	$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
        },
        success :  function(data)
        {						
        	if(data==1){

        		$("#save").fadeIn(1000, function(){

        		var n = noty({
        		text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
        		theme: 'defaultTheme',
        		layout: 'center',
        		type: 'warning',
        		timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
			    });

        	}  
        	else if(data==2){

			    $("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE REGISTRAR REFERENCIAS DE TRATAMIENTOS AL ODONTOGRAMA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
				
				});
			}
        	else if(data==3){
									
				$("#save").fadeIn(1000, function(){
									
			    var n = noty({
                text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX PRESUNTIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                theme: 'defaultTheme',
                layout: 'center',
                type: 'warning',
                timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
								 
				}); 															
			}
        	else if(data==4){
									
				$("#save").fadeIn(1000, function(){
									
			    var n = noty({
                text: "<span class='fa fa-warning'></span> NO DEBE DE EXISTIR DX DEFINITIVOS REPETIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                theme: 'defaultTheme',
                layout: 'center',
                type: 'warning',
                timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
								 
				}); 															
			} else {

        		$("#save").fadeIn(1000, function(){

        			var n = noty({
        			text: '<center> '+data+' </center>',
        			theme: 'defaultTheme',
        			layout: 'center',
        			type: 'information',
        			timeout: 5000 });
        			$("#btn-update").attr('disabled', false);
				    setTimeout("location.href='odontologias'", 5000);	
                      
        			});
        		}
        	}
        });
        return false;
           }
        }
	   /* form submit */
    }); 	   
});
/*  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE ODONTOLOGIA */

















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE CONSENTIMIENTO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#saveconsentimiento").validate({
		rules:
		{
			codsucursal: { required: true },
			codespecialidad: { required: true },
			codmedico: { required: true },
			tipoconsentimiento: { required: true },
			search_paciente: { required: true },
			procedimiento: { required: true },
			anestesia: { required: true },
			enfermedad: { required: true },
			observaciones: { required: true },
			doctestigo: { required: true },
			nombretestigo: { required: true },
			nofirmapaciente: { required: false },
		},
		messages:
		{
			codsucursal: { required: "Seleccione Sucursal" },
			codespecialidad: { required: "Seleccione Especialidad" },
			codmedico: { required: "Seleccione Médico" },
			tipoconsentimiento: { required: "Seleccione Tipo Consentimiento" },
			search_paciente: { required: "Realice la Búsqueda del Paciente" },
			procedimiento: { required: "Ingrese Procedimiento" },
			anestesia: { required: "Ingrese Anestesia" },
			enfermedad: { required: "Ingrese Enfermedad" },
			observaciones: { required: "Ingrese Observaciones" },
			doctestigo: { required: "Ingrese Nº de Documento" },
			nombretestigo: { required: "Ingrese Nombre de Testigo" },
			nofirmapaciente: { required: "Ingrese Motivo No Firma" },
		},
	    errorElement: "span",
		submitHandler: function(form) {

		var data = $("#saveconsentimiento").serialize();

		$.ajax({

		type : 'POST',
		url  : 'forconsentimiento.php',
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
		{						
			if(data==1){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});
			}  
			else if(data==2){

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UN CONSENTIMIENTO EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'warning',
				timeout: 5000 });
			    $("#btn-submit").attr('disabled', false);
				});

        	} else {

				$("#save").fadeIn(1000, function(){

				var n = noty({
				text: '<center> '+data+' </center>',
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 5000 });
				$("#saveconsentimiento")[0].reset();
				$("#muestra_detalles").html("");
				$("#codpaciente").val("");
			    $("#btn-submit").attr('disabled', false);
				});
			  }
			}
		});
		return false;
	}
	   /* form submit */
    }); 	   
});
/*  FUNCION PARA VALIDAR REGISTRO DE CONSENTIMIENTO */

/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONSENTIMIENTO */	 	 
$('document').ready(function()
{ 
	/* validation */
	$("#updateconsentimiento").validate({
		rules:
		{
			procedimiento: { required: true },
			anestesia: { required: true },
			enfermedad: { required: true },
			observaciones: { required: true },
			doctestigo: { required: true },
			nombretestigo: { required: true },
			nofirmapaciente: { required: false },
		},
		messages:
		{
			procedimiento: { required: "Ingrese Procedimiento" },
			anestesia: { required: "Ingrese Anestesia" },
			enfermedad: { required: "Ingrese Enfermedad" },
			observaciones: { required: "Ingrese Observaciones" },
			doctestigo: { required: "Ingrese Nº de Documento" },
			nombretestigo: { required: "Ingrese Nombre de Testigo" },
			nofirmapaciente: { required: "Ingrese Motivo No Firma" },
		},
	    errorElement: "span",
	    submitHandler: function(form) {	

		var data = $("#updateconsentimiento").serialize();
		var codconsentimiento = $('input#codconsentimiento').val();

        $.ajax({

        type : 'POST',
        url  : 'forconsentimiento.php?codconsentimiento='+codconsentimiento,
        data : data,
        beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
        success :  function(data)
        {						
        	if(data==1){

        		$("#save").fadeIn(1000, function(){

        		var n = noty({
        		text: "<span class='fa fa-warning'></span> REALICE LA BUSQUEDA DEL PACIENTE CORRECTAMENTE, VERIFIQUE NUEVAMENTE POR FAVOR...!",
        		theme: 'defaultTheme',
        		layout: 'center',
        		type: 'warning',
        		timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
        		});

        	}  
        	else if(data==2){

        		$("#save").fadeIn(1000, function(){

        		var n = noty({
        		text: "<span class='fa fa-warning'></span> ESTE PACIENTE YA TIENE UN CONSENTIMIENTO EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
        		theme: 'defaultTheme',
        		layout: 'center',
        		type: 'warning',
        		timeout: 5000 });
			    $("#btn-update").attr('disabled', false);
        		});

        	} else {

        		$("#save").fadeIn(1000, function(){

        			var n = noty({
        			text: '<center> '+data+' </center>',
        			theme: 'defaultTheme',
        			layout: 'center',
        			type: 'information',
        			timeout: 5000 });
        			$("#btn-update").attr('disabled', false);
				    setTimeout("location.href='consentimientos'", 5000);	
        			});
        		}
        	}
        });
        return false;
        }
	   /* form submit */
    }); 	   
});
/*  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONSENTIMIENTO */