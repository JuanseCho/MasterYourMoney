$(function (){

    var tablaUsuarios = null;
    listarUsuarios();
    
    function listarUsuarios() {
        var objData = new FormData();
        objData.append("listarDatos", "ok");
        fetch('src/controladores/controlListarUsuarios.php', {
            method: 'POST',
            body: objData
        }).then(response => response.json()).catch(error => {
            console.log(error);
        }).then(response => {
            cargarUsuarios(response);
        });

        function cargarUsuarios(response) {
            console.log(response);
            var dataSet = [];
            response.forEach(listarDatos);
        
            function listarDatos(item, index) {
                var objBotones = '<div>';
                objBotones += '<button id="btnEditar" type="button" class="btn btn-small btn-warning" usuario="' + item.idusuario + '"nombres="' + item.nombres + '"apellidos="' + item.apellidos + '"email="' + item.email + '"telefono="' + item.telefono + '" data-bs-toggle="modal" data-bs-target="#EditarUsuario"><i class="fa-solid fa-pen-to-square"></i></button>';
                objBotones += '<button id="btnEliminar" type="button" class="btn btn-small btn-danger" usuario="' + item.idusuario + '"><i class="fa-solid fa-trash"></i></button>';
                objBotones += '</div>';
                dataSet.push([item.nombres, item.apellidos,item.email,item.telefono,objBotones]);
            }

            if (tablaUsuarios != null) {
                $("#tablaUsuarios").dataTable().fnDestroy();
            }

            tablaUsuarios = $("#tablaUsuarios").DataTable({
                data: dataSet
            });
        }
    }

    $("#tablaUsuarios").on("click", "#btnEditar", function () {
        var idusuario = $(this).attr('usuario');
        var nombres = $(this).attr('nombres');
        var apellidos = $(this).attr('apellidos');
        var email = $(this).attr('email');
        var telefono = $(this).attr('telefono');
    
    
        $("#edit-nombres").val(nombres);
        $("#edit-apellidos").val(apellidos);
        $("#edit-email").val(email);
        $("#edit-telefono").val(telefono);
        $("#btnEditarUsuario").attr("usuario", idusuario);
    
      })
    
      var formularioEditar = document.querySelectorAll('#formEditarUsuarios');
    
      // Bucle sobre ellos y evitar el envío
      Array.prototype.slice.call(formularioEditar)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
              form.classList.add('was-validated')
            } else {
              event.preventDefault();
              var nombres = $("#edit-nombres").val();
              var apellidos = $("#edit-apellidos").val();
              var email = $("#edit-email").val();
              var telefono = $("#edit-telefono").val();
              var idUsuario = $("#btnEditarUsuario").attr("usuario");
    
              var objData = new FormData();
              objData.append("editNombres", nombres);
              objData.append("editApellidos", apellidos);
              objData.append("editEmail", email);
              objData.append("editTelefono", telefono);
              objData.append("editId", idUsuario);
    
              fetch('src/controladores/controlListarUsuarios.php', {
                method: 'POST',
                body: objData
              }).then(response => response.json()).catch(error => {
                console.log(error);
              }).then(response => {
                alert(response["mensaje"]);
                $("#EditarUsuario").modal('toggle');
                listarUsuarios();
              });
    
            }
          }, false)
        })
    
      $("#tablaUsuarios").on("click", "#btnEliminar", function () {
        var idusuario = $(this).attr('usuario');
        var objData = new FormData();
        objData.append("idEliminarUsuario", idusuario);
    
        fetch('src/controladores/controlListarUsuarios.php', {
          method: 'POST',
          body: objData
        }).then(response => response.json()).catch(error => {
          console.log(error);
        }).then(response => {
          alert(response["mensaje"]);
          listarUsuarios();
        });
      })












})