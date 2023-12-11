<div class="container containerLogin pt-5" style="margin-top: 8vh;">

    <form id="registroUsuarios" class="form">
        <div class="flex-column">
            <label for="txt-nombres">Nombres:</label>
            <input class="form-control" type="text" id="txt-nombres" placeholder="Nombres">
        </div>

        <div class="flex-column">
            <label for="txt-apellidos">Apellidos:</label>
            <input class="form-control" type="text" id="txt-apellidos" placeholder="Apellidos">
        </div>
        <div class="flex-column">
            <label for="txt-email">Email:</label>
            <input class="form-control" type="email" id="txt-email" placeholder="Email">
        </div>
        <div class="flex-column">
            <label for="txt-password">Contraseña:</label>
            <input class="form-control" type="password" id="txt-password" placeholder="Contraseña">
        </div>
        <div class="flex-column">
            <label for="txt-telefono">Telefono:</label>
            <input class="form-control" type="text" id="txt-telefono" placeholder="Telefono">
        </div>

        <div class="flex-row">
            <div>
                <input type="checkbox">
                <label>Remember me </label>
            </div>
        </div>
        <button type="submit" class="button-submit">Registrarse</button>
        <p class="p">¿ya tienes una cuenta? <a class="span" href="login">Iniciar sesión</a></p>

    </form>
</div>