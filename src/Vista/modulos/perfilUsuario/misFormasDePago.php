<div class="container p-2 jsContainer">
    <div>
        <div class="row mt-4 mb-4 p-4">
            <div class="col-md-12">
                <div class="titulo_categoria">
                    <h2>
                        <p style="font-size: 2rem;">
                            <span style="color: blue; font-size: 2rem;">
                                Mis
                            </span>
                            Formas de pago
                        </p>
                    </h2>
                    <button class="btn">
                        Agregar Forma de pago
                    </button>
                </div>
            </div>
        </div>
        <hr size="5" color="#455181">
        <div class="row jsDivR p-4 ">
            <div class=" col-md-12 col-sm-12 col-lg-2  user-profile">
                <img class="col-md-2 user-profile-avatar" src="src\Vista\img\2.jpeg" />
                <i>Sebastian</i>
            </div>

            <div class="col-md-10 col-sm-12 col-lg-10  jsDiv">
                <button id="editBtn" style="display: none;">Editar</button>
                <table>
                    <thead>
                        <tr>
                            <th> Nombre </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr onclick="myFunction(event)">
                            <td>Nequi</td>
                        </tr>
                        <tr>
                            <td>Efectivo</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <script>
                function myFunction(e) {
                    document.getElementById('editBtn').style.display = 'block';
                }
            </script>
        </div>
    </div>
</div>