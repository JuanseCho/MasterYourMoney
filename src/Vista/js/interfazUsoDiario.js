$(function () {

    var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    var date = new Date();
    var day = date.getDate();
    var month = months[date.getMonth()];
    var year = date.getFullYear();
    document.querySelector('.barraFecha').innerHTML = '<div class="d-flex flex-row">';
    document.querySelector('.barraFecha').innerHTML += '<div>'+ day + ' de ' + month + ' de ' + year+'</div>';
    document.querySelector('.barraFecha').innerHTML += '<a href="#myModal" data-toggle="modal"><img src="src/Vista/img/calendario.png" alt="" style="width:28px;" class="ms-3"></a>';

    var dayNumber = date.getDay();
    
    var dayNames = [
        'Domingo',
        'Lunes',
        'Martes',
        'Miércoles',
        'Jueves',
        'Viernes',
        'Sábado'
      ];

    var dayName = dayNames[dayNumber];

    document.querySelector('.nombreDia').innerHTML = dayName;

});