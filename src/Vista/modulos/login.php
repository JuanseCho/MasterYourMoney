<div class="container containerLogin pt-5" style="margin-top: 15vh;">

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
            <span class="span"> <a data-bs-toggle="modal" data-bs-target="#recuperarContraseña">Forgot password?</a></span>
        </div>
        <button type="submit" class="button-submit">Sign In</button>
        <p class="p">¿No tienes una cuenta? <a class="span" href="register">Regístrate</a></p>


        </p>


    </form>
</div>

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


<!-- The Modal -->
<div class="modal" id="recuperarContraseña">
    <div class="modal-dialog">
        <div class="modal-content">


            <!-- form restablecer contraseña -->
            <form id="recuperar_Contrasena" class="form">
                <h4>
                    <img src="src/Vista/img/5.png" style="width: 20%; height: auto;">
                    Master Your Money
                </h4>
                <p style="text-align: center;">Para recuperar su contraseña, le enviaremos un código a su correo electrónico</p>

                <div class="flex-column">
                    <label for="txt-email">Email:</label>
                    <input type="email" class="form-control inputForm" id="txt_emailCambiarContraseña" placeholder="Email">
                </div>

                <button type="submit" class="button-submit">enviar</button>
                <p class="p">¿ya tienes una cuenta? <a class="span" href="login">Iniciar sesión</a></p>
            </form>

        </div>
    </div>
</div>

<!-- formulario para validar codigo -->
<div class="modal" id="validarCodigo">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- form restablecer contraseña -->
            <form id="validar_Codigo" class="form">
            <h4>
                    <img src="src/Vista/img/5.png" style="width: 20%; height: auto;">
                    Master Your Money
                </h4>
                <!-- espan para mostrar el correo  -->
                <p style="text-align: center;">se ha enviado el codigo a <span id="correo" style="font-size: larger;"></span></p>
                
                <div class="flex-column">
                    <label for="txt-email">Codigo:</label>
                    <input type="text" class="form-control inputForm" id="txt_codigo" placeholder="Codigo">
                </div>

                <button type="submit" class="button-submit">enviar</button>
                <p class="p">¿ya tienes una cuenta? <a class="span" href="login">Iniciar sesión</a></p>
            </form>
        </div>
    </div>
</div>