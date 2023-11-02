<div class="container-fluid">
    <h1 class="display-1">Master Your Money</h1>
    <h1>Configuracion de administrador</h1>
    <div class="container">
        <h3>Usuarios</h3>
        <table id="tablaUsuarios" class="table table-striped">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>john@example.com</td>
                    <td>john@example.com</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="EditarUsuario">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Editar Insumos</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class="needs-validation" id="formEditarUsuarios" novalidate>
                    <div class="mb-3 mt-3">
                        <label for="edit-name" class="form-label">Nombres:</label>
                        <input type="text" class="form-control" id="edit-nombres" placeholder="Enter Nombres" required>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please select a valid state.</div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="edit-apellidos" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="edit-apellidos" placeholder="Enter Apellidos" required>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please select a valid state.</div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="edit-email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="edit-email" placeholder="Enter Email" required>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please select a valid state.</div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="edit-email" class="form-label">Telefono:</label>
                        <input type="number" class="form-control" id="edit-telefono" placeholder="Enter Telefono" required>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please select a valid state.</div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btnEditarUsuario">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>