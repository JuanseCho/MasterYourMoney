<div class="container-fluid">

    <!-- Perfil de usuario -->
    <section class="perfil-usuario mt-5 mb-5">
        <div class="contenedor-perfil">
            <div class="portada-perfil" style="background-image: url(src/Vista/img/FondoPerfil1.jpg);">
                <div class="sombra"></div>
                <div class="avatar-perfil">
                    <img src="src/Vista/img/DefaultAvatar.png" alt="Avatar" id="avatar-img">
                    <label for="file-input" class="cambiar-foto">
                        <i class="fas fa-camera"></i>
                        <span>Cambiar foto</span>
                    </label>
                    <input type="file" id="file-input" style="display: none;" accept="image/*">
                </div>

                <div class="datos-perfil">
                    <h4 class="titulo-usuario"></h4>

                    <button class="btnU" id="update-button">
                        <i class="bi bi-pen"></i>
                        Editar
                    </button>
                </div>
            </div>
        </div>
    </section>

</div>
