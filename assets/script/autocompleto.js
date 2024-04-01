/*####################### CIE 10 #######################*/

/*####################### CIE 10 #######################*/
$(function() {
  $("#cie").autocomplete({
    source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
      select: function(event, ui) {  
      $('#idcie').val(ui.item.idcie);
    }  
  });
});

function autocompletarcie(contador){
  contador = contador.replace("cie[]", "");
  $("#cie"+contador).autocomplete({
  source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
    select: function(event, ui) {  
      $('#idcie'+contador).val(ui.item.idcie);
    }  
  });
}

/*####################### CIE 10 #######################*/ 

/*####################### PRESUNTIVO #######################*/
$(function() {
  $("#presuntivo").autocomplete({
    source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
      select: function(event, ui) {  
      $('#idciepresuntivo').val(ui.item.idcie);
    }  
  });
});

function autocompletar(contador){
  contador = contador.replace("presuntivo[]", "");
  $("#presuntivo"+contador).autocomplete({
  source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
    select: function(event, ui) {  
      $('#idciepresuntivo'+contador).val(ui.item.idcie);
    }  
  });
}
/*####################### PRESUNTIVO #######################*/    

/*####################### DEFINITIVO #######################*/
$(function() {
  $("#definitivo").autocomplete({
    source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
      select: function(event, ui) {  
        $('#idciedefinitivo').val(ui.item.idcie);
    }  
  });
});

function autocompletar2(contador){
  contador = contador.replace("definitivo[]", "");
  $("#definitivo"+contador).autocomplete({
  source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
    select: function(event, ui) {  
      $('#idciedefinitivo'+contador).val(ui.item.idcie);
    }  
  });
}
/*####################### DEFINITIVO #######################*/

/*####################### CIE 10 #######################*/



/*####################### CIE 10 FORMULAS Y ORDENES MEDICAS #######################*/ 

/*####################### FORMULAS MEDICAS #######################*/
$(function() {
  $("#formula").autocomplete({
    source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
      select: function(event, ui) {  
      $('#idcieformula').val(ui.item.idcie);
    }  
  });
});

function autocompletarformula(contador){
  contador = contador.replace("formula[]", "");
  $("#formula"+contador).autocomplete({
  source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
    select: function(event, ui) {  
      $('#idcieformula'+contador).val(ui.item.idcie);
    }  
  });
}
/*####################### FORMULAS MEDICAS #######################*/    

/*####################### ORDENES MEDICAS #######################*/
$(function() {
  $("#ordenes").autocomplete({
    source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
      select: function(event, ui) {  
        $('#idcieorden').val(ui.item.idcie);
    }  
  });
});

function autocompletarordenes(contador){
  contador = contador.replace("ordenes[]", "");
  $("#ordenes"+contador).autocomplete({
  source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
    select: function(event, ui) {  
      $('#idcieorden'+contador).val(ui.item.idcie);
    }  
  });
}
/*####################### ORDENES MEDICAS #######################*/

/*####################### CIE 10 FORMULAS Y ORDENES MEDICAS #######################*/




/*####################### CIE 10 DE INGRESO #######################*/

/*####################### PRESUNTIVO #######################*/
$(function() {
  $("#presuntivoingreso").autocomplete({
    source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
      select: function(event, ui) {  
      $('#idciepresuntivoingreso').val(ui.item.idcie);
    }  
  });
});

function autocompletarpresingreso(contador){
  contador = contador.replace("presuntivoingreso[]", "");
  $("#presuntivoingreso"+contador).autocomplete({
  source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
    select: function(event, ui) {  
      $('#idciepresuntivoingreso'+contador).val(ui.item.idcie);
    }  
  });
}
/*####################### PRESUNTIVO #######################*/

/*####################### DEFINITIVO #######################*/
$(function() {
  $("#definitivoingreso").autocomplete({
    source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
      select: function(event, ui) {  
        $('#idciedefinitivoingreso').val(ui.item.idcie);
    }  
  });
});

function autocompletardefingreso(contador){
  contador = contador.replace("definitivoingreso[]", "");
  $("#definitivoingreso"+contador).autocomplete({
  source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
    select: function(event, ui) {  
      $('#idciedefinitivoingreso'+contador).val(ui.item.idcie);
    }  
  });
}
/*####################### DEFINITIVO #######################*/

/*####################### CIE 10 DE INGRESO #######################*/




/*####################### CIE 10 DE EGRESO #######################*/

/*####################### PRESUNTIVO #######################*/
$(function() {
  $("#presuntivoegreso").autocomplete({
    source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
      select: function(event, ui) {  
      $('#idciepresuntivoegreso').val(ui.item.idcie);
    }  
  });
});

function autocompletarpresegreso(contador){
  contador = contador.replace("presuntivoegreso[]", "");
  $("#presuntivoegreso"+contador).autocomplete({
  source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
    select: function(event, ui) {  
      $('#idciepresuntivoegreso'+contador).val(ui.item.idcie);
    }  
  });
}
/*####################### PRESUNTIVO #######################*/

/*####################### DEFINITIVO #######################*/
$(function() {
  $("#definitivoegreso").autocomplete({
    source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
      select: function(event, ui) {  
        $('#idciedefinitivoegreso').val(ui.item.idcie);
    }  
  });
});

function autocompletardefegreso(contador){
  contador = contador.replace("definitivoegreso[]", "");
  $("#definitivoegreso"+contador).autocomplete({
  source: "class/busqueda_autocompleto.php?Busqueda_Cie10=si",
    minLength: 1,
    select: function(event, ui) {  
      $('#idciedefinitivoegreso'+contador).val(ui.item.idcie);
    }  
  });
}
/*####################### DEFINITIVO #######################*/

/*####################### CIE 10 DE EGRESO #######################*/



$(function() {
  $("#search_paciente").autocomplete({
    source: "class/busqueda_autocompleto.php?Busqueda_Pacientes=si",
    minLength: 1,
    select: function(event, ui) { 
      $('#codpaciente').val(ui.item.codpaciente);
      $('#numeropaciente').val(ui.item.cedpaciente);
      $('#historia_paciente').val(ui.item.numerohistoria);
      $('#cedula_paciente').val(ui.item.cedpaciente);
      $('#nombre_paciente').val(ui.item.nompaciente);
      $('#apellido_paciente').val(ui.item.apepaciente);
      $('#grupo_sanguineo').val(ui.item.gruposapaciente);
    }  
  });
});


$(function() {
  $("#search_medico").autocomplete({
    source: "class/busqueda_autocompleto.php?Busqueda_Medicos=si",
    minLength: 1,
    select: function(event, ui) { 
      $('#codmedico').val(ui.item.codmedico);
    }  
  });
});