$(function () {

    'use strict'

    //---------------------Login--------------------------------------------------------------------------------

    var forms = document.querySelectorAll('#registroUsuarios');
    Array.prototype.slice.call(forms).forEach(function (form) {

        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                form.classList.add('was-validated')
            } else {
                event.preventDefault()
                let nombres = $("#txt-nombres").val();
                let apellidos = $("#txt-apellidos").val();
                let email = $("#txt-email").val();
                let password = $("#txt-password").val();
                let telefono = $("#txt-telefono").val();

                let objData = new FormData();
                objData.append("registro_Nombres", nombres);
                objData.append("registro_Apellidos", apellidos);
                objData.append("registro_Email", email);
                objData.append("registro_Password", password);
                objData.append("registro_Telefono", telefono);

                fetch('src/controladores/registroControl.php', {
                    method: 'POST',
                    body: objData
                }).then(response => response.json()).catch(error => {
                    console.error(error);
                }).then(response => {
                    if (response["codigo"] == "200") {
                        window.location = response["ruta"];
                    } else {
                        alert(response["mensaje"]);
                    }
                });

            }
        }, false)
    })


    // funcion para recuperar contraseña

    var forms = document.querySelectorAll('#restablecerContrasena');
    Array.prototype.slice.call(forms).forEach(function (form) {

        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                form.classList.add('was-validated')
            } else {
                event.preventDefault()
                let email = $("#txt-emailR").val();
                let password = $("#txt-passwordR").val();
                let passwordConirm = $("#txt-passwordR2").val();
                // validar que sean iguales las contraseñas
                if (password != passwordConirm) {
                    Swal.fire({
                        title: 'las contraseñas no coinciden ',
                        text: "Por favor ingrese nuevamente las contraseñas",
                        icon: 'warning',
                        confirmButtonColor: '#2F8BE6',
                        confirmButtonText: 'Entiendo',

                    })
                    return;
                }


                let objData = new FormData();
                objData.append("restablecer_Email", email);
                objData.append("restablecer_Password", password);

                fetch('src/controladores/registroControl.php', {

                    method: 'POST',
                    body: objData
                }).then(response => response.json()).catch(error => {
                    console.error(error);
                }).then(response => {
                    if (response["codigo"] == "200") {

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response["mensaje"],
                            showConfirmButton: false,
                            timer: 4000,
                            customClass: {
                                title: 'swal'
                            }
                        })


                        window.location = response["ruta"];
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response["mensaje"],
                            showConfirmButton: false,
                            timer: 4000,
                            customClass: {
                                title: 'swal'
                            }
                        })
                    }
                    // cerrar modal
                    $("#restContraseña").modal("hide");
                });

            }
        }, false)
    })

    // funcion para recuperar contraseña

    var forms = document.querySelectorAll('#recuperar_Contrasena');
    Array.prototype.slice.call(forms).forEach(function (form) {

        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                form.classList.add('was-validated')
            } else {
                event.preventDefault()
                let email = $("#txt_emailCambiarContraseña").val();

                let objData = new FormData();
                objData.append("recuperar_Email", email);

                fetch('src/controladores/registroControl.php', {
                    method: 'POST',
                    body: objData
                }).then(response => response.json()).catch(error => {
                    console.error(error);
                }).then(response => {

                    if (response["codigo"] == "200") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 8000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal.stopTimer)
                              toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                          })
                          
                          Toast.fire({
                            icon: 'success',
                            title: 'revisa tu correo electronico y valida el codigo'
                          })
                        //cerrar modal
                        $("#recuperarContraseña").modal("hide");
                        //colocar el correo en el span del modal validarCodigo
                        $("#correo").html(email);
                        // abrir modal validarCodigo
                         $('#validarCodigo').modal({
                            backdrop: 'static',
                            keyboard: false  // también previene el cierre con la tecla escape
                          });$("#validarCodigo").modal("show");
                       

                          
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response["mensaje"],
                            showConfirmButton: false,
                            timer: 3000,
                            customClass: {
                                title: 'swal'
                            }
                        })
                    }
                });
            }
        }, false)
    })

    
    var forms = document.querySelectorAll('#validar_Codigo');
    Array.prototype.slice.call(forms).forEach(function (form) {

        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                form.classList.add('was-validated')
            } else {
                event.preventDefault()
                let codigo = $("#txt_codigo").val();

                let objData = new FormData();
                objData.append("validar_Codigo", codigo);

                fetch('src/controladores/registroControl.php', {
                    method: 'POST',
                    body: objData
                }).then(response => response.json()).catch(error => {
                    console.error(error);
                }).then(response => {

                    if (response["codigo"] == "200") {
                        //cerrar modal
                        $("#validarCodigo").modal("hide");
                        // abrir modal validarCodigo
                        $("#restContraseña").modal("show");
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response["mensaje"],
                            showConfirmButton: false,
                            timer: 2000,
                            customClass: {
                                title: 'swal'
                            }
                        })
                    }
                });
            }
        }, false)
    })


})