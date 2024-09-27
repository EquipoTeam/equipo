<?php
require __DIR__ . '/autoload.php';
MercadoPago\SDK::setAccessToken('APP_USR-5959642236873039-091810-c073949605a6638308d3458a68510ce6-1987542569');
$preference = new MercadoPago\Preference();
$preference->back_urls = array(
    "success" => "pagoExitoso.html",
    "failure" => "pagoFallido.html",
    "pending" => "pagoPendiente.html",
);

$item = new MercadoPago\Item();
$item->id = 1;
$item->title = 'Mouse ROG';
$item->description = 'ROG Gladius II Core';
$item->quantity = 1;
$item->unit_price = 735.24;
$item->currency_id = 'MXN';
$preference->items = array($item);
$preference->save();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercado Libre</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../static/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <link rel="stylesheet" href="../../static/css/login.css">
    <link rel="icon" href="../static/img/logo.png" type="image/x-icon">

</head>
<body>
<header>
        <div class="container-hero">
          <div class="container hero">
                <div class="container-logo">
                    <img src="../static/img/logo.png" class="logoempresa">
                    <h4><a href="/">DARK COMPUTERS</a></h4> 
                </div>
                <div class="container-user text-white">
                    <i class="fa-solid fa-user" color-white></i>            
                    <i class="fa-solid fa-cart-shopping" color-white></i>
                    <a class="btn btn-secondary" href="{{ url_for('logout') }}">Cerrar Sesion</a>  
                </div>
            </div>
        </div>   
    </header>

    <!--BARRA DE NAVEGACION-->
    <nav class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-between py-3 mb-4 border-bottom">
            
          <div class="d-flex flex-grow-1">
                          
            <ul class="nav col-12 col-md-auto mb-2 mb-md-0 flex-grow-1 justify-content-start">
              <li><a href="home.html" class="nav-link px-2">Inicio</a></li>
              <li><a href="Monitores.html" class="nav-link px-2">Monitores</a></li>
              <li><a href="#" class="nav-link px-2">Teclados</a></li>
              <li><a href="#" class="nav-link px-2">Motherboards</a></li>
              <li><a href="#" class="nav-link px-2">Graficas</a></li>
              <li><a href="#" class="nav-link px-2">Sobre Nosotros</a></li>
            </ul>
          </div>
          
           <div>
          <form class="col-12 col-lg-auto mb-3 mb-lg-0" role="search">
            <input type="search" class="form-control form-control-dark text-white" placeholder="Buscar..." aria-label="Buscar">
          </form>
        </div>

        <button type="button" class="btn btn-outline-primary search-button-margin">Buscar</button>

        </header>
      </nav>

    <script src="https://sdk.mercadopago.com/js/v2.1"></script>
    <script>
        const mp = new MercadoPago('APP_USR-ed388c85-2b78-4745-a773-3f62bef10b94', {
            locale: 'es-MX'
        });

        const checkout = mp.checkout({
            preference: {
                id: '<?php echo $preference->id; ?>'
            },
            render: {
                container: 'btn.pagar',
                label: 'Pagar',
            }
        });
    </script>
    <!--PRODUCTO I-->

    <div class="card-product d-flex align-items-center">
    <div class="container-img me-3">
        <img src="../static/img/MOUSE I.png" alt="ROG Gladius II Core" class="img-fluid"/>
        <span class="discount">-15%</span>
    </div>
    <div class="info text-white text-center">
        <h3 class="display-6">ROG Gladius II Core</h3>
        <a class="btn btn-danger rounded-pill px-4 py-3 mb-2" href="<?php echo $preference->init_point; ?>">Pagar Ahora</a>
        <H1 class="price fs-4">$735.24</H1>
    </div>
</div>


    <footer class="footer">
        <div class="container container-footer">
        <div class="menu-footer">
        <div class="contact-info">
            <p class="title-footer">Informacion de Contacto</p>
        <ul>
            <li>
                Carr. Monterrey - Saltillo Km. 61.5, 
                Bosques de Santa Catarina, 66359 Cdad. Santa Catarina, N.L.
            </li>
            <li>Telefono: 81-23-37-76-21</li>
            <li>Fax: 55522300</li>
            <li>Email UTSC: 22094@virtual.utsc.edu.mx</li>
        </ul>
        <div class="social-icons">
            <span class="Facebook"><i class="bi bi-facebook"></i></span>
            <span class="Twitter"><i class="bi bi-twitter-x"></i></span>
            <span class="Youtube"><i class="bi bi-youtube"></i></span>
            <span class="Twitch"><i class="bi bi-twitch"></i></span>
            <span class="Instagram"><i class="bi bi-instagram"></i></span>
            <span class="WhatsApp"><i class="bi bi-whatsapp"></i></span>
        </div>
        </div>
        <div class="information">
            <p class="title-footer">Informacion</p>
                <ul>
                    <li><a href="#">Acerca de Nosotros</a></li>
                    <li><a href="#">Informacion Delivery</a></li>
                    <li><a href="#">Politicas de Privacidad</a></li>
                    <li><a href="#">Terminos y Condiciones</a></li>
                    <li><a href="#">Contactanos</a></li>
                </ul>
        </div>

        <div class="my-account">
            <p class="title-footer">Mi cuenta</p>
            <ul>
                <li><a href="#">Mi Cuenta</a></li>
                <li><a href="#">Historial de Ordenes</a></li>
                <li><a href="#">Listas de Deseos </a></li>
                <li><a href="#">Boletin</a></li>
                <li><a href="#">Reembolsos</a></li>
            </ul>
        </div>

         <div class="newsletter">
            <p class="title-footer">Boletin Informativo</p>

        <div class="content">
            <p>
            Suscribete a Nuestros boletines ahora y 
            mantente al dia con nuevos Perifericos y ofertas exclusivas de ROG
            </p>
            <button>Suscribete</button>
        </div>
        </div>
        </div>
        <div class="copyright">
            <p>
             Desarrollado por Equipo1 &copy; 2024
             </p>

            <img src="../static/img/TIPO DE PAGOS.png" alt="Pagos">
        </div>
        </div>
        </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></body>
    <script src="https://kit.fontawesome.com/fe98ca4959.js" crossorigin="anonymous"></script>

</body>
</html>
