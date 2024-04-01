$(function() {
  $(".calendario").flatpickr({
    allowInput: true,
    dateFormat: "d-m-Y"});
});

$('body').on('focus',".calendario2", function(){
    $(this).flatpickr({
       enableTime: false,
       dateFormat: "d-m-Y"
    });
});

$(function() {
  $(".fnacimiento").flatpickr({
    maxDate: "today",
    allowInput: true,
    dateFormat: "d-m-Y",
    static : true
  });
});

$(function() {
  $(".fecha_limite").flatpickr({
    maxDate: "today",
    allowInput: true,
    dateFormat: "d-m-Y"
  });
});


$(function() {
  $("#fnacpaciente").flatpickr({
    maxDate: "today",
    allowInput: true,
    dateFormat: "d-m-Y",
    static : true
  });
});

$(function() {
  $("#desde").flatpickr({
    allowInput: true,
    dateFormat: "d-m-Y"});
});

$(function() {
  $("#hasta").flatpickr({
    allowInput: true,
    dateFormat: "d-m-Y"});
});

$(function() {
  $("#fecha").flatpickr({ 
    dateFormat: "d-m-Y",
    static : true });
});

$(function() {
  $("#fecha_dictado").flatpickr({ 
    allowInput: true,
    dateFormat: "d-m-Y"});
});

$('body').on('focus',".tiempo_hora", function(){
    $(this).flatpickr({
       enableTime: true,
       noCalendar: true,
       dateFormat: "H:i",
       defaultDate: ""
    });
});

$('body').on('focus',"#fecha_hora", function(){
    $(this).flatpickr({
       enableTime: true,
       dateFormat: "d-m-Y H:i"
    });
});

$('body').on('focus',".calendario_terapia", function(){
    $(this).flatpickr({
       enableTime: true,
       dateFormat: "d-m-Y H:i",
       defaultDate: ""
    });
});

$(function() {
  $(".hora_modal").flatpickr({ 
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    defaultDate: "",
    static : true 
  });
});

/*$("#dpFecha").flatpickr({locale: "es"})
$("#dpFecha2").flatpickr({
    locale: "es",
    dateFormat: "d/m/Y",
    maxDate: (new Date()).setFullYear((new Date()).getFullYear() - 18)
})
$("#dpFecha3").flatpickr({
    locale: "es",
    dateFormat: "d/m/Y",
    maxDate: "today"
})
$("#dpFecha4")
    .flatpickr({
        locale: "es",
        dateFormat: "d/m/Y",
        minDate: "today"
    })
    .setDate("today")
$("#dpFecha5").flatpickr({
    locale: "es",
    dateFormat: "d/m/Y",
    disable: [function (date) {
        var dia = date.getDate()
 
        return ([15, 30].indexOf(dia) == -1)
    }]
})
$("#dpFecha6").flatpickr({
    locale: "es",
    dateFormat: "d/m/Y",
    disable: [function (date) {
        var diaSemana = date.getDay()
 
        return ([6, 0].indexOf(diaSemana) != -1)
    }]
})*/


/*$('body').on('focus',"#inicio_anestesia", function(){
    $(this).flatpickr({
       enableTime: true,
       noCalendar: true,
       dateFormat: "H:i",
       defaultDate: ""
    });
});

$('body').on('focus',"#final_anestesia", function(){
    $(this).flatpickr({
       enableTime: true,
       noCalendar: true,
       dateFormat: "H:i",
       defaultDate: ""
    });
});

$('body').on('focus',"#inicio_cirugia", function(){
    $(this).flatpickr({
       enableTime: true,
       noCalendar: true,
       dateFormat: "H:i",
       defaultDate: ""
    });
});

$('body').on('focus',"#final_cirugia", function(){
    $(this).flatpickr({
       enableTime: true,
       noCalendar: true,
       dateFormat: "H:i",
       defaultDate: ""
    });
});

$('body').on('focus',"#llegada_paciente", function(){
    $(this).flatpickr({
       enableTime: true,
       noCalendar: true,
       dateFormat: "H:i",
       defaultDate: ""
    });
});

$('body').on('focus',"#salida_paciente", function(){
    $(this).flatpickr({
       enableTime: true,
       noCalendar: true,
       dateFormat: "H:i",
       defaultDate: ""
    });
});

$('body').on('focus',"#final_cirugia", function(){
    $(this).flatpickr({
       enableTime: true,
       noCalendar: true,
       dateFormat: "H:i",
       defaultDate: ""
    });
});*/