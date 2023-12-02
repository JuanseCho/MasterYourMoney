<div class="container pt-5 ">
    <div class="row justify-content-center text-center">
        <a href="Capital" class="col-lg-2 col-md-4 col-sm-6 col-xs-12 mb-3 card-responsive">
            <div class="card ">
                <div class="img-section">
                    <img src="src/Vista/img/billetera.png" alt="">
                </div>
                <div class="card-desc">
                    <div class="card-header">
                        <h3>Capital</h3>
                        <div class="card-menu">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                    <div class="card-time"> <span>$ </span> 6.000.000</div>
                </div>
            </div>
        </a>
        <a href="Ahorro" class="col-lg-2 col-md-4 col-sm-6 col-xs-12 mb-3 card-responsive">
            <div class="card ">
                <div class="img-section">

                    <img src="src/Vista/img/hucha.png" alt="">
                </div>
                <div class="card-desc">
                    <div class="card-header">
                        <h3>Ahorro</h3>
                        <div class="card-menu">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                    <div class="card-time"> <span>$ </span> 6.000.000</div>

                </div>
            </div>
        </a>
        <a href="misPresupuestos" class="col-lg-2 col-md-4 col-sm-6 col-xs-12 mb-3 card-responsive">
            <div class="card ">
                <div class="img-section">

                    <img src="src/Vista/img/presupuesto.png" alt="">
                </div>
                <div class="card-desc">
                    <div class="card-header">
                        <h3>Presupuesto</h3>
                        <div class="card-menu">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                    <div class="card-time"> <span>$ </span> 6.000.000</div>

                </div>
            </div>
        </a>

        <a href="Gastos" class="col-lg-2 col-md-4 col-sm-6 col-xs-12 mb-3 card-responsive">
            <div class="card ">
                <div class="img-section">

                    <img src="src/Vista/img/gastos.png" alt="">
                </div>
                <div class="card-desc">
                    <div class="card-header">
                        <h3>Gastos</h3>
                        <div class="card-menu">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                    <div class="card-time"> <span>$ </span> 6.000.000</div>

                </div>
            </div>
        </a>
        <a href="misFormasDePago" class="col-lg-2 col-md-4 col-sm-6 col-xs-12 mb-3 card-responsive">
            <div class="card ">
                <div class="img-section">

                    <img src="src/Vista/img/formaDePago.png" alt="">
                </div>
                <div class="card-desc">
                    <div class="card-header">
                        <h3>Formas de pago</h3>
                        <div class="card-menu">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                    <div class="card-time"> <span>$ </span> 6.000.000</div>

                </div>
            </div>
        </a>

    </div>

</div>
<script>
$(document).ready(function(){
    $(".card-responsive").each(function(){
        // Obtén la ruta del enlace de la carta
        var cartaRuta = $(this).attr("href").trim();

        // Obtén la ruta actual de la aplicación
        var rutaActual = window.location.pathname.trim();

        // Verifica si la carta apunta a la ruta actual
        if (rutaActual.includes(cartaRuta)) {
            $(this).hide();
        }
    });
});
</script>