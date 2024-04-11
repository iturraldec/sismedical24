//FUNCION PARA AGREGAR Y ELIMINAR CAMPOS DINAMICAMENTE

    var cont=1;

    //FUNCION AGREGA CAPACIDAD
    function Add()  //Esta la funcion que agrega las filas segunda parte :
    {
        cont++;
        //autocompletar//
        var indiceFila=1;
        myNewRow = document.getElementById('tabla').insertRow(-1);
        myNewRow.id=indiceFila;
        myNewCell=myNewRow.insertCell(-1);
        myNewCell.innerHTML='<div class="form-group has-feedback"><div class="fileinput fileinput-new" data-provides="fileinput"><div class="form-group has-feedback"><label class="control-label">Archivo a Cargar: <span class="symbol required"></span></label><div class="input-group"><div class="form-control" data-trigger="fileinput"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg><span class="fileinput-filename"></span></div><span class="input-group-addon btn btn-success btn-file"><span class="fileinput-new"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg> Selecciona Archivo</span><span class="fileinput-exists"><i data-feather="image"></i> Cambiar</span><input type="file" class="btn btn-default" data-original-title="Subir Archivo" data-rel="tooltip" placeholder="Suba su Archivo" name="file[]" id="file" autocomplete="off" title="Buscar Archivo" required="" aria-required="true"></span><a href="#" class="input-group-addon btn btn-dark fileinput-exists" data-dismiss="fileinput"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg> Quitar</a></div><small><p>Para Subir el Archivo debe tener en cuenta:<br> * El Archivo a cargar debe ser extension.pdf,jpeg,jpg,png</p></small></div></div></div>';
        indiceFila++;
    }

    //FUNCION BORRAR CAPACIDAD
    function Delete() {
        var table = document.getElementById('tabla');
        if(table.rows.length > 1)
        {
           table.deleteRow(table.rows.length -1);
           cont--;
        }
    }

    /*################################### CIE 10 ###################################*/
    
    /*#################### PRESUNTIVO ####################*/
    function AddDxPresuntivo()  //Esta la funcion que agrega las filas segunda parte :
    {
    cont++;
    //autocompletar
    var indiceFila=1;

    myNewRow = document.getElementById('tabla').insertRow(0);
    myNewRow.id=indiceFila;
    myNewCell=myNewRow.insertCell(-1);
    myNewCell.innerHTML='<div class="form-group has-feedback"><label class="control-label alert-link">Dx Presuntivo:</label><input type="hidden" name="idciepresuntivo[]'+cont+'" id="idciepresuntivo'+cont+'"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="presuntivo[]'+cont+'" id="presuntivo'+cont+'" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Presuntivo" autocomplete="off"></div>';
    indiceFila++;
    }

    //FUNCION BORRAR DX PRESUNTIVO
    function DeleteDxPresuntivo() {
        var table = document.getElementById('tabla');
        if(table.rows.length > 1)
        {
            table.deleteRow(table.rows.length -1);
            cont--;
        }
    }
    /*#################### PRESUNTIVO ####################*/

    /*#################### DEFINITIVO ####################*/
    function AddDxDefinitivo()  //Esta la funcion que agrega las filas segunda parte :
    {
    cont++;
    //autocompletar
    var indiceFila=1;

    myNewRow = document.getElementById('tabla2').insertRow(0);
    myNewRow.id=indiceFila;
    myNewCell=myNewRow.insertCell(-1);
    myNewCell.innerHTML='<div class="form-group has-feedback"><label class="control-label alert-link">Dx Definitivo:</label><input type="hidden" name="idciedefinitivo[]'+cont+'" id="idciedefinitivo'+cont+'"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="definitivo[]'+cont+'" id="definitivo'+cont+'" onKeyUp="this.value=this.value.toUpperCase(); autocompletar2(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Definitivo" autocomplete="off"></div>';
    indiceFila++;
    }

    //FUNCION BORRAR DX DEFINITIVO
    function DeleteDxDefinitivo() {
        var table = document.getElementById('tabla2');
        if(table.rows.length > 1)
        {
            table.deleteRow(table.rows.length -1);
            cont--;
        }
    }
    /*#################### DEFINITIVO ####################*/

    /*################################### CIE 10 ###################################*/



    /*################################### FORMULAS Y ORDENES MEDICAS ###################################*/
    
    /*#################### FORMULAS MEDICAS ####################*/
    
    ///FUNCION AGREGAR FORMULA MEDICA
    function AddFormula()  //Esta la funcion que agrega las filas segunda parte :
    {
    cont++;
    //autocompletar
    var indiceFila=1;

    myNewRow = document.getElementById('tabla3').insertRow(0);
    myNewRow.id=indiceFila;
    myNewCell=myNewRow.insertCell(-1);
    myNewCell.innerHTML='<div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Fórmula Médica: <span class="symbol required"></span></label><input type="hidden" name="idcieformula[]'+cont+'" id="idcieformula'+cont+'"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="formula[]'+cont+'" id="formula'+cont+'" onKeyUp="this.value=this.value.toUpperCase(); autocompletarformula(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Fórmula Médica" required="" aria-required="true"><textarea class="form-control" name="observacionformula[]'+cont+'" id="observacionformula'+cont+'" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Fórmula Médica" title="Ingrese Observación de Fórmula Médica" rows="2" required="" aria-required="true"></textarea></div>';
    indiceFila++;
    }

    ///FUNCION BORRAR FORMULA MEDICA
    function DeleteFormula() {
        var table = document.getElementById('tabla3');
        if(table.rows.length > 1)
        {
            table.deleteRow(table.rows.length -1);
            cont--;
        }
    }
    /*#################### FORMULAS MEDICAS ####################*/


    /*#################### ORDENES MEDICAS ####################*/
    
    ///FUNCION AGREGAR ORDEN MEDICA
    function AddOrden()  //Esta la funcion que agrega las filas segunda parte :
    {
    cont++;
    //autocompletar
    var indiceFila=1;

    myNewRow = document.getElementById('tabla4').insertRow(0);
    myNewRow.id=indiceFila;
    myNewCell=myNewRow.insertCell(-1);
    myNewCell.innerHTML='<div class="form-group has-feedback"><label class="control-label alert-link">Nombre de Dx para Orden Médica: <span class="symbol required"></span></label><input type="hidden" name="idcieorden[]'+cont+'" id="idcieorden'+cont+'"/><input style="color:#000;font-weight:bold;" class="form-control" type="text" name="ordenes[]'+cont+'" id="ordenes'+cont+'" onKeyUp="this.value=this.value.toUpperCase(); autocompletarordenes(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx para Orden Médica" required="" aria-required="true"><textarea class="form-control" name="observacionorden[]'+cont+'" id="observacionorden'+cont+'" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Observación de Orden Médica" title="Ingrese Observación de Orden Médica" rows="2" required="" aria-required="true"></textarea></div>';
    indiceFila++;
    }

    ///FUNCION BORRAR ORDEN MEDICA
    function DeleteOrden() {
        var table = document.getElementById('tabla4');
        if(table.rows.length > 1)
        {
            table.deleteRow(table.rows.length -1);
            cont--;
        }
    }
    /*#################### ORDENES MEDICAS ####################*/

    /*################################### FORMULAS Y ORDENES MEDICAS ###################################*/




    /*################################### CIE 10 INGRESO ###################################*/

    /*#################### PRESUNTIVO ####################*/
    function Ingreso()
    {
    cont++;
    //autocompletar
    var indiceFila=1;
    myNewRow = document.getElementById('tabla').insertRow(-1);
    myNewRow.id=indiceFila;
    myNewCell=myNewRow.insertCell(-1);
    myNewCell.innerHTML='<div class="form-group has-feedback"><label class="control-label alert-link">Dx Presuntivo: <span class="symbol required"></span></label><input type="hidden" name="idciepresuntivoingreso[]'+cont+'" id="idciepresuntivoingreso'+cont+'"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="presuntivoingreso[]'+cont+'" id="presuntivoingreso'+cont+'" onKeyUp="this.value=this.value.toUpperCase(); autocompletarpresingreso(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Presuntivo" autocomplete="off" required="" aria-required="true"></div>';
    indiceFila++;
    }

    function DeleteDxPresuntivoIngreso() {
        var table = document.getElementById('tabla');
        if(table.rows.length > 1)
        {
            table.deleteRow(table.rows.length -1);
            cont--;
        }
    }
    /*#################### PRESUNTIVO ####################*/

    /*#################### DEFINITIVO ####################*/
    function AddDxDefinitivoIngreso()
    {
    cont++;
    //autocompletar
    var indiceFila=1;
    myNewRow = document.getElementById('tabla2').insertRow(-1);
    myNewRow.id=indiceFila;
    myNewCell=myNewRow.insertCell(-1);
    myNewCell.innerHTML='<div class="form-group has-feedback"><label class="control-label alert-link">Dx Definitivo: <span class="symbol required"></span></label><input type="hidden" name="idciedefinitivoingreso[]'+cont+'" id="idciedefinitivoingreso'+cont+'"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="definitivoingreso[]'+cont+'" id="definitivoingreso'+cont+'" onKeyUp="this.value=this.value.toUpperCase(); autocompletardefingreso(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Definitivo" autocomplete="off"></div>';
    indiceFila++;
    }

    function DeleteDxDefinitivoIngreso() {
        var table = document.getElementById('tabla2');
        if(table.rows.length > 1)
        {
            table.deleteRow(table.rows.length -1);
            cont--;
        }
    }
    /*#################### DEFINITIVO ####################*/

    /*################################### CIE 10 INGRESO ###################################*/



    /*################################### CIE 10 EGRESO ###################################*/

    /*#################### PRESUNTIVO ####################*/
    function AddDxPresuntivoEgreso()
    {
    cont++;
    //autocompletar
    var indiceFila=1;
    myNewRow = document.getElementById('tabla3').insertRow(-1);
    myNewRow.id=indiceFila;
    myNewCell=myNewRow.insertCell(-1);
    myNewCell.innerHTML='<div class="form-group has-feedback"><label class="control-label alert-link">Dx Presuntivo: <span class="symbol required"></span></label><input type="hidden" name="idciepresuntivoegreso[]'+cont+'" id="idciepresuntivoegreso'+cont+'"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="presuntivoegreso[]'+cont+'" id="presuntivoegreso'+cont+'" onKeyUp="this.value=this.value.toUpperCase(); autocompletarpresegreso(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Presuntivo" autocomplete="off" required="" aria-required="true"></div>';
    indiceFila++;
    }

    function DeleteDxPresuntivoEgreso() {
        var table = document.getElementById('tabla3');
        if(table.rows.length > 1)
        {
            table.deleteRow(table.rows.length -1);
            cont--;
        }
    }
    /*#################### PRESUNTIVO ####################*/

    /*#################### DEFINITIVO ####################*/
    function AddDxDefinitivoEgreso()
    {
    cont++;
    //autocompletar
    var indiceFila=1;
    myNewRow = document.getElementById('tabla4').insertRow(-1);
    myNewRow.id=indiceFila;
    myNewCell=myNewRow.insertCell(-1);
    myNewCell.innerHTML='<div class="form-group has-feedback"><label class="control-label alert-link">Dx Definitivo: <span class="symbol required"></span></label><input type="hidden" name="idciedefinitivoegreso[]'+cont+'" id="idciedefinitivoegreso'+cont+'"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="definitivoegreso[]'+cont+'" id="definitivoegreso'+cont+'" onKeyUp="this.value=this.value.toUpperCase(); autocompletardefegreso(this.name);" placeholder="Ingrese Nombre de Dx para tu Búsqueda" title="Ingrese Dx Definitivo" autocomplete="off" ></div>';
    indiceFila++;
    }

    function DeleteDxDefinitivoEgreso() {
        var table = document.getElementById('tabla4');
        if(table.rows.length > 1)
        {
            table.deleteRow(table.rows.length -1);
            cont--;
        }
    }
    /*#################### DEFINITIVO ####################*/

    /*################################### CIE 10 EGRESO ###################################*/




    /*################################### PLAN DE TRATAMIENTO ###################################*/
    //FUNCION AGREGA RECETA
    function AddReceta()  //Esta la funcion que agrega las filas segunda parte :
    {
    cont++;
    //autocompletar
    var indiceFila=1;
    myNewRow = document.getElementById('tabla5').insertRow(-1);
    myNewRow.id=indiceFila;
    myNewCell=myNewRow.insertCell(-1);
    myNewCell.innerHTML='<div class="row"><div class="col-md-6"><div class="form-group has-feedback2"><label class="control-label alert-link">Medicamento: <span class="symbol required"></span></label><textarea class="form-control" type="text" name="medicamento[]'+cont+'" id="medicamento'+cont+'" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Medicamento" rows="2" required="" aria-required="true"></textarea></div></div><div class="col-md-6"><div class="form-group has-feedback2"><label class="control-label alert-link">Posología: <span class="symbol required"></span></label><textarea class="form-control" type="text" name="posologia[]'+cont+'" id="posologia'+cont+'" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Posología" rows="2" required="" aria-required="true"></textarea></div></div></div>';
    indiceFila++;
    }

    //FUNCION BORRAR RECETA
    function DeleteReceta() {
        var table = document.getElementById('tabla5');
        if(table.rows.length > 1)
        {
            table.deleteRow(table.rows.length -1);
            cont--;
        }
    }
    /*################################### PLAN DE TRATAMIENTO ###################################*/


    /*################################### DIAGNOSTICO DE IMAGENOLOGIA ###################################*/
    //FUNCION AGREGA DX DIAGNOSTICO
    function AddDiagnostico()  //Esta la funcion que agrega las filas segunda parte :
    {
    cont++;
    //autocompletar
    var indiceFila=1;
    myNewRow = document.getElementById('tablacie').insertRow(-1);
    myNewRow.id=indiceFila;
    myNewCell=myNewRow.insertCell(-1);
    myNewCell.innerHTML='<div class="form-group has-feedback"><label class="control-label alert-link">Diagnóstico: <span class="symbol required"></span></label><input type="hidden" name="idcie[]'+cont+'" id="idcie'+cont+'"/><input style="color:#000;font-weight:bold;" type="text" class="form-control" name="cie[]'+cont+'" id="cie'+cont+'" onKeyUp="this.value=this.value.toUpperCase(); autocompletarcie(this.name);" placeholder="Ingrese Nombre de Diagnóstico" title="Ingrese Nombre de Diagnóstico" autocomplete="off" required="" aria-required="true"></div>';
    indiceFila++;
    }

    //FUNCION BORRAR DX DIAGNOSTICO
    function DeleteDiagnostico() {
        var table = document.getElementById('tablacie');
        if(table.rows.length > 1)
        {
            table.deleteRow(table.rows.length -1);
            cont--;
        }
    }
    /*################################### DIAGNOSTICO DE IMAGENOLOGIA ###################################*/

    /*################################### CICLO DE TERAPIAS ###################################*/
    //FUNCION AGREGA TERAPIA
    function AddTerapia()  //Esta la funcion que agrega las filas segunda parte :
    {
    cont++;
    //autocompletar
    var indiceFila=1;
    myNewRow = document.getElementById('tabla6').insertRow(-1);
    myNewRow.id=indiceFila;
    myNewCell=myNewRow.insertCell(-1);
    myNewCell.innerHTML='<div class="row"><div class="col-md-6"><div class="form-group has-feedback2"><label class="control-label">Atención/Actividad y/o Tratamiento: <span class="symbol required"></span></label><textarea class="form-control" type="text" name="tratamiento[]'+cont+'" id="tratamiento'+cont+'" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Tratamiento" title="Ingrese Atención/Actividad y/o Tratamiento" rows="2" required="" aria-required="true"></textarea></div></div><div class="col-md-6"><div class="form-group has-feedback2"><label class="control-label">Fecha / Hora de Terapia: <span class="symbol required"></span></label><input style="color:#000;font-weight:bold;" class="form-control calendario_terapia" type="text" name="fechaciclo[]'+cont+'" id="fechaciclo'+cont+'" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Fecha de Terapia" title="Ingrese Fecha de Terapia" required="" aria-required="true"></div></div></div>';
    indiceFila++;
    }

    //FUNCION BORRAR DX TERAPIA
    function DeleteTerapia() {
        var table = document.getElementById('tabla6');
        if(table.rows.length > 1)
        {
            table.deleteRow(table.rows.length -1);
            cont--;
        }
    }
    /*################################### CICLO DE TERAPIAS ###################################*/



    /*#################### IMAGENES ECOGRAFICAS ####################*/
    function AddDxImgEcografia()
    {
    cont++;
    //autocompletar
    var indiceFila=1;
    myNewRow = document.getElementById('tabla_ecografia').insertRow(-1);
    myNewRow.id=indiceFila;
    myNewCell=myNewRow.insertCell(-1);
    myNewCell.innerHTML='<div class="form-group has-feedback"><label class="control-label alert-link">Imagen Ecográfica: <span class="symbol required"></span></label><br><input type="file" class="form-control" data-original-title="Subir Ecografias" data-rel="tooltip" placeholder="Suba su Ecografia" name="file[]'+cont+'" id="file'+cont+'" title="Subir Ecografias" required="" aria-required="true"/><small><p>Para Subir la Imagen debe tener en cuenta:<br> * La Imagen debe ser extension.jpeg,jpg,png,gif<br> * La imagen no debe ser mayor de 200 KB</p></small></div>';
    indiceFila++;
    }

    function DeleteImgEcografia() {
        var table = document.getElementById('tabla_ecografia');
        if(table.rows.length > 1)
        {
            table.deleteRow(table.rows.length -1);
            cont--;
        }
    }
    /*#################### IMAGENES ECOGRAFICAS ####################*/



    ////////////FUNCION ASIGNA VALOR DE CONT PARA EL FOR DE MOSTRAR DATOS MP-MOD-TT////////
    function asigna()
    {
        valor=document.form.var_cont.value=cont;
    }