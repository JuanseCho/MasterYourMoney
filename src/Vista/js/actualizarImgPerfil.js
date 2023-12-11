
$(document).ready(function () {
    listarImagen();

    $(document).on("change", "#file-input", function () {
        var files = this.files;
        var element;
        var supportedImages = ["image/jpeg", "image/png", "image/gif"];
        var seEncontraronElementoNoValidos = false;

        for (var i = 0; i < files.length; i++) {
            element = files[i];

            if (supportedImages.indexOf(element.type) != -1) {
                createPreview(element);
                $("#update-button").show();
            } else {
                seEncontraronElementoNoValidos = true;
            }
        }

        if (seEncontraronElementoNoValidos) {
            showMessage("Se encontraron archivos no válidos.");
        } else {
            showMessage("La imagen se subió correctamente.");
        }
    });

    $("#update-button").click(function () {
        actualizarImagen();
    });

    function actualizarImagen() {
        let archivo = document.getElementById('file-input').files[0];

        var objData = new FormData();
        objData.append("file", archivo);
        fetch("src/controladores/registroControl.php", {
            method: "POST",
            body: objData,
        }).then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        }).then((response) => {
            listarImagen();
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'actualizado correctamente'
            })
            $("#update-button").hide();

        }).catch((error) => {
            console.error('Error en la solicitud:', error);
        });
    }
    // funcion para listar la imagen en el perfil de usuario
    function listarImagen() {


        var objData = new FormData();
        objData.append("listarImagen", "ok");
        fetch("src/controladores/registroControl.php", {
            method: "POST",
            body: objData,
        }).then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        }).then((response) => {

            cargarImagen(response);

        }).catch((error) => {
            console.error('Error en la solicitud:', error);

        });
    }

    function cargarImagen(response) {
        console.log(response);
        var img = document.getElementById('avatar-img');
        var titulo = document.querySelector('.titulo-usuario');
        var imagen = response.datosUsuario[0].imgPerfil_URL;
        var nombre_usuario = response.datosUsuario[0].nombre_usuario;
        titulo.innerHTML = nombre_usuario;
        img.src = imagen;



    }
});

function clearPreviews() {
    $(".image-container").remove();
}

function createPreview(file) {
    var imgCodified = URL.createObjectURL(file);
    var imgContainer = $('<div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12 image-container"> <figure> <img src="' + imgCodified + '" alt="Foto del usuario"> <figcaption> <i class="icon-cross"></i> </figcaption> </figure> </div>');

    clearPreviews();
    $(imgContainer).insertBefore("#add-photo-container");

    // Actualiza la imagen en el perfil de usuario
    $("#avatar-img").attr("src", imgCodified);

    // Muestra el botón de actualización después de insertar la previsualización
    $("#update-button").show();
}