function eliminateDuplicates(arr) {
 var i,
     len=arr.length,
     out=[],
     obj={};

 for (i=0;i<len;i++) {
    obj[arr[i]]=0;
 }
 for (i in obj) {
    out.push(i);
 }
 return out;
}

function hoverTxtDiente(idTxtDiente)
{
	var idDiente=idTxtDiente.substring(3, 6);
	var css=
	{
		"box-shadow": "0px 0px 10px blue"
	}
	$("#"+idDiente).css(css);
}

function outTxtDiente(idTxtDiente)
{
	var idDiente=idTxtDiente.substring(3, 6);
	var css=
	{
		"box-shadow": "none"
	}
	$("#"+idDiente).css(css);
}

function seleccionarCara(idCaraDiente)
{
	
	$("#txtCaraTratada").val(idCaraDiente);

}

function seleccionarDiente(idDiente)
{
	$("#txtIdentificadorDienteGeneral").val(idDiente);
	$("#txtDienteTratado").val(idDiente);
}

function agregarTratamiento(diente, cara, estado)
{
	if(diente=="")
	{
		swal("Oops", "POR FAVOR DEBE DE SELECCIONAR EL DIENTE A TRATAR!", "error");
		return false;
	} 
	else if(cara=="")
	{
		swal("Oops", "POR FAVOR DEBE DE SELECCIONAR LA CARA DEL DIENTE A TRATAR!", "error");
		return false;
	} 
	
	else if(estado=="")
	{
		swal("Oops", "POR FAVOR DEBE DE SELECCIONAR UNA REFERENCIA PARA AGREGAR!", "error");
		return false;
	} 

	var agregarFila=true;

	$("#tablaTratamiento").find("tr").each(function(index, elemento) 
    {
    	var dienteAsignado;

    	if(!agregarFila)
    	{
    		return false;
    	}

        $(elemento).find("td").each(function(index2, elemento2)
        {
        	if(index2==0)
        	{
        		dienteAsignado=$(elemento2).text();
        	}
        	switch(index2)
        	{
					
				case 2:
        			var partesEstado=$(elemento2).text().split("-");
        			if(partesEstado[0]!="15" && partesEstado[0]!="16" && partesEstado[0]!="17" && partesEstado[0]!="18")
        			//if((partesEstado[1]==estado.split("-")[1]) && dienteAsignado==diente && cara!=cara)
        			{
        				if((partesEstado[1]==estado.split("-")[1]) && dienteAsignado==diente)
        				{
        					swal("Oops", "EL TRATAMIENTO YA FUE ASIGNADO !", "error");
        					agregarFila=false;
        				}
        			}
        		break;
        	}
        });
    });


	if(agregarFila)
	{
		var filaHtml="<tr class='text-dark alert-link'><td>"+diente+"</td><td>"+cara+"</td><td>"+estado+"</td><td><span class='text-danger' style='cursor: pointer;' onclick='quitarTratamiento(this);'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2 icon'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg></span></td></tr>";
        document.getElementById('txtDienteTratado').value = '';
        document.getElementById('txtCaraTratada').value = '';
        document.getElementById('cbxEstado').value = '';
        $("#tablaTratamiento > tbody").append(filaHtml);
		$("#divTratamiento").scrollTop($("#tablaTratamiento").height());
	}
}

function quitarTratamiento(elemento)
{
	$(elemento).parent().parent().remove();
}

function recuperarDatosTratamiento(callback)
{
	var codpaciente;
    var codsucursal;
	var estados="";

	codpaciente=$("#codpaciente").val();
    codsucursal=$("#codsucursal").val();

	$("#tablaTratamiento").find("tr").each(function(index, elemento) 
    {
        $(elemento).find("td").each(function(index2, elemento2)
        {
        	estados+=$(elemento2).text()+"_";
        });
    });

    //descripcion=$("#txtDescripcion").val();
    estados=estados.substring(0, estados.length-2);

    callback(codpaciente, codsucursal, estados);
}

var urlBase = function () {
        var loc = window.location;
        var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
		return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search).length - pathName.length));
    };


function guardarTratamiento()
{
	
	recuperarDatosTratamiento(function(codpaciente, codsucursal, estados)
	{
		var s = estados.split("__");
		var d = eliminateDuplicates(s);
		
		if(estados=="")
		{
			swal("Oops", "POR FAVOR DEBE DE AGREGAR REFERENCIAS DE ODONTOGRAMA AL PACIENTE!", "error");
			return false;
		}

		$.post("registrareferencias.php",
	    {
	    	
			codpaciente: codpaciente,
            codsucursal: codsucursal,
	    	estados: d
	    }, 
														  
														  
	    function(pagina)
	    {
			limpiarDatosTratamiento();
	    	var n = noty({
        		text: "<span class='fa fa-check-square-o'></span> REFERENCIAS AGREGADA EXITOSAMENTE",
        		theme: 'defaultTheme',
        		layout: 'center',
        		type: 'success',
        		timeout: 5000 });

	    	setTimeout(function()
	    	{
	    		$("#seccionPaginaAjax").html("");
	    	}, 7000);
			
	    }).done(function(){
        $("#divTratamiento").load("funciones.php?BuscaTablaTratamiento=si&codpaciente="+codpaciente+"&codsucursal="+codsucursal);
	    cargarDientes('seccionDientes', 'dientes.php', '', codpaciente, codsucursal);
	    });

	    setTimeout(function() { 
  
            //INICIO PARA REGISTRO DE IMAGEN  
            html2canvas($("#seccionDientes"), {
    
                onrendered: function(canvas) {
                theCanvas = canvas;
                //var cita = $('#cita').val();
                var paciente = $('#paciente').val();
                var sucursal = $('#sucursal').val();
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
	});
}

		
function limpiarDatosTratamiento()
{
	$("#txtIdentificadorDienteGeneral").val("DXX");
	$("#txtDienteTratado").val("");
	$("#txtCaraTratada").val("");
	$("#cbxEstado").val("");
}


function cargarDientes(idSeccion, url, estados, codpaciente, codsucursal)
{
	$.ajax(
    {
        url: url,
        type: "POST",
        data: {codpaciente: codpaciente, codsucursal: codsucursal, estados: estados},
        cache: true
    }).done(function(pagina) 
    {
        $("#"+idSeccion).html(pagina);
    });
}


function cargarTratamientos(idSeccion, url, codpaciente, codsucursal)
{
	$.ajax(
    {
        url: url,
        type: "POST",
        data: {codpaciente: codpaciente, codsucursal: codsucursal},
        cache: true
    }).done(function(pagina) 
    {
        $("#"+idSeccion).html(pagina);
    });
}

function prepararImpresion()
{
	$("body #seccionTablaTratamientos").css({"display": "none"});
	$("body #seccionRegistrarTratamiento").css({"display": "none"});
}

function terminarImpresion()
{
	$("body #seccionTablaTratamientos").css({"display": "inline-block"});
	$("body #seccionRegistrarTratamiento").css({"display": "inline-block"});
}