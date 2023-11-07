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


    var formAgregarIngresoCapital = document.querySelectorAll('#formAgregarIngresoCapital');

    Array.prototype.slice.call(formAgregarIngresoCapital)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            form.classList.add('was-validated')
          } else {
            event.preventDefault();

            var fechaIngreso = new Date();
            var horaIngreso = new Date();
            var montoIngreso = $("#txt-montoIngreso").val();
            var capitalIngreso = $("#txt-capitalIngreso").val();
            var formaPagoIngreso = $("#txt-formaPagoIngreso").val();
            
            alert(fechaIngreso + " " + horaIngreso);

            var objData = new FormData();
            objData.append("regFechaIngreso", fechaIngreso);
            objData.append("regHoraIngreso", horaIngreso);
            objData.append("regMontoIngreso", montoIngreso);
            objData.append("regCapitalIngreso", capitalIngreso);
            objData.append("regFormaPagoIngreso", formaPagoIngreso);

            fetch('src/controladores/interfazUsoDiarioControl.php', {
              method: 'POST',
              body: objData
            }).then(response => response.json()).catch(error => {
              console.log(error);
            }).then(response => {
              if (response["codigo"] == "200") {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response["respuesta"],
                    showConfirmButton: false,
                    timer: 1000,
                    customClass: {
                        title: 'swal'
                    }
                });

              } else {
                  Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: response["mensaje"],
                      showConfirmButton: false,
                      timer: 1000
                  });
            }
            form.reset();
            $("#ventanaAgregarIngresoCapital").modal('toggle');
            // listarFormasPago();
            });

          }
        }, false)
      })

});