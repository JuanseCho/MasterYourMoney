<div class="container containerLogin">

    <form id="loginUsuarios" class="form">
        <div class="flex-column">
            <label for="txt-email">Email:</label>
            <input type="email" class="form-control inputForm" id="txt-email" placeholder="Email">
        </div>
        <div class="flex-column">
            <label for="txt-password">Password:</label>
            <input type="password" class="form-control inputForm" id="txt-password" placeholder="Contraseña">
        </div>
        <div class="flex-row">
            <div>
                <input type="checkbox">
                <label>Remember me </label>
            </div>
            <span class="span"> <a   data-bs-toggle="modal" data-bs-target="#restContraseña">Forgot password?</a></span>
        </div>
        <button type="submit" class="button-submit">Sign In</button>
        <p class="p">¿No tienes una cuenta? <a class="span" href="register">Regístrate</a></p>


        </p>


    </form>



    <!-- The Modal -->
    <div class="modal" id="restContraseña">
        <div class="modal-dialog">
            <div class="modal-content">


                <!-- form restablecer contraseña -->
                <form id="restablecerContrasena" class="form">
                    <div class="flex-column">
                        <label for="txt-email">Email:</label>
                        <input type="email" class="form-control inputForm" id="txt-emailR" placeholder="Email">
                    </div>
                    <!-- nueva contraseña -->
                    <div class="flex-column">
                        <label for="txt-password">Nueva contraseña:</label>
                        <input type="password" class="form-control inputForm" id="txt-passwordR" placeholder="Contraseña">
                    </div>
                    <!-- confirmar contraseña -->
                    <div class="flex-column">
                        <label for="txt-password">Confirmar contraseña:</label>
                        <input type="password" class="form-control inputForm" id="txt-passwordR2" placeholder="Contraseña">
                    </div>

                    <button type="submit" class="button-submit">Restablecer contraseña</button>
                    <p class="p">¿ya tienes una cuenta? <a class="span" href="login">Iniciar sesión</a></p>
                </form>

            </div>
        </div>
    </div>


</div>