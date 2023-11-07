$(document).ready(function () {
    listarAhorros();
    tablaAhorros = null;

    // Función para agregar Ahorros
    const forms = document.querySelectorAll("#formAhorros");
    Array.from(forms).forEach((form) => {
        form.addEventListener("submit", (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add("was-validated");
            } else {
                event.preventDefault();
                let fecha = $("#fecha").val();
                let descripcion = $("#descripcion").val();
                let monto = $("#monto").val();
                let objData = new FormData();
                objData.append("fecha", fecha);
                objData.append("descripcion", descripcion);
                objData.append("monto", monto);

                fetch("src/controladores/ahorrosControl.php", {
                    method: "POST",
                    body: objData,
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then((response) => {
                        if (response["codigo"] == "200") {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response["mensaje"],
                                showConfirmButton: false,
                                timer: 1000,
                                customClass: {
                                    title: 'swal'
                                }
                            });
                            // cerrar modal 
                            $("#btn_Cerrar_Modal_Ahorros").click();

                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: response["mensaje"],
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                        $("#fecha").val("");
                        $("#descripcion").val("");
                        $("#monto").val("");

                        listarAhorros();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        });
    });

    // Función para listar Ahorros
    function listarAhorros() {
        var objData = new FormData();
        objData.append("listarAhorros", "ok");
        fetch("src/controladores/ahorrosControl.php", {
            method: "POST",
            body: objData,
        })
            .then((response) => {

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then((response) => {
                cargarDatos(response);
            })
            .catch((error) => {
                console.log(error);
            });
    }

    // Función para cargar datos en la tabla
    function cargarDatos(response) {
        var dataSet = [];
        response.forEach(listarDatosA);
        function listarDatosA(item, index) {
            var btnEditar = `<button class="btnEditar" data-id="${item.id}">Editar</button>`;
            var btnEliminar = `<button class="btnEliminar" data-id="${item.id}">Eliminar</button>`;

            dataSet.push([item.fecha, item.descripcion, item.monto, btnEditar, btnEliminar]);
        }
        if (tablaAhorros != null) {
            $("#tablaahorros").dataTable().fnDestroy();
        }
        tablaAhorros = $("#tablaahorros").DataTable({
            data: dataSet,
            // Resto del código de inicialización de DataTables
        });

        // Controladores de eventos para los botones de editar y eliminar
        $('.btnEditar').click(function () {
            var id = $(this).data('id');
            // Código para manejar la edición
        });

        $('.btnEliminar').click(function () {
            var id = $(this).data('id');
            // Código para manejar la eliminación
        });
    }














});