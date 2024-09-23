<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yummy</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Inicio.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@9/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        min-height: 100%;
        display: flex;
        flex-direction: column;
    }

    body {
        padding-top: 60px;
        flex: 1;
    }

    .header {
        background-color: #F87013;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .logo {
        display: flex;
        align-items: center;
    }

    .logo-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .logo-text {
        font-size: 1.75rem;
        font-weight: 700;
        color: #fff;
    }

    .auth-links {
        display: flex;
        gap: 10px;
        margin-left: auto;
        /* Alinear a la derecha */
    }

    .auth-link {
        background-color: #ff6f00;
        color: #fff;
        text-decoration: none;
        padding: 10px 15px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .auth-link:hover {
        background-color: #c95a05;
        transform: translateY(-2px);
    }

    .dropdown-menu {
        border: none;
        /* Sin borde */
    }

    .footer {
        background-color: #F87013;
        color: white;
        text-align: center;
        padding: 20px;
        margin-top: auto;
    }

    .hero-banner {
        margin-top: 60px;
    }

    .featured-categories,
    .promotions {
        padding: 20px;
    }

    .no-border {
        border: none;
    }
    </style>
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="{{ asset('images/Logo_Blanco__1.png') }}" alt="Logo" class="logo-img">
            <a href="#" class="logo-text">Yummy</a>
        </div>

        <nav class="auth-links" x-data="{ open: false }">
            <a href="{{ route('login') }}" class="auth-link">Iniciar Sesion</a>
            <a href="{{ route('Registrosolicitud') }}"
                class="auth-link">{{ __('Solicitud de registro de restaurantes') }}</a>

            <div class="dropdown">
                <button class="auth-link dropdown-toggle no-border" id="dropdownMenuButton" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Registrar como
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Usuario</a></li>
                    <li><a class="dropdown-item" href="#">Repartidor</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="content">
        <section class="hero-banner">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slide-wrapper">
                            <div class="slide-content">
                                <div class="promo-content">
                                    <h1>70% de ahorro en Sushi</h1>
                                    <p>Bonificación de $300 + Envío en horas</p>
                                    <p>Compra mínima $1,999</p>
                                    <a href="" class="cta-button">Usar Código: WMVYL</a>
                                </div>
                                <div class="promo-image">
                                    <img src="{{ asset('images/promotion1.jpeg') }}" alt="Promo 1" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-wrapper">
                            <div class="slide-content">
                                <div class="promo-content">
                                    <h1>Descuento Especiales</h1>
                                    <p>Hasta un 50% en etiquetas seleccionadas</p>
                                    <a href="/promo" class="cta-button">Aprovecha</a>
                                </div>
                                <div class="promo-image">
                                    <img src="{{ asset('images/promotion2.png') }}" alt="Promo 2" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-wrapper">
                            <div class="slide-content">
                                <div class="promo-content">
                                    <h1>Pizza a $199</h1>
                                    <p>Más de 20 variedades para elegir</p>
                                    <a href="/promo" class="cta-button">Comprar Ahora</a>
                                </div>
                                <div class="promo-image">
                                    <img src="{{ asset('images/pizza.jpg') }}" alt="Promo 3" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <section class="featured-categories">
            <h2>Categorías Destacadas</h2>
            <div class="categories-grid">
                <div class="category-card">
                    <img src="{{ asset('images/salad.jpg') }}" alt="Categoría 1" />
                    <h3>Vinos Tintos</h3>
                </div>
                <div class="category-card">
                    <img src="{{ asset('images/tacos.jpg') }}" alt="Categoría 2" />
                    <h3>Vinos Blancos</h3>
                </div>
                <div class="category-card">
                    <img src="{{ asset('images/comida_banner.jpg') }}" alt="Categoría 3" />
                    <h3>Licor</h3>
                </div>
            </div>
        </section>

        <section class="promotions">
            <h2>Promociones</h2>
            <div class="promotions-grid">
                <div class="promotion-card">
                    <img src="{{ asset('images/promotion1.jpeg') }}" alt="Promoción 1" />
                    <div class="promotion-info">
                        <h3>Oferta Especial</h3>
                        <p>Compra 2 y lleva 3er a mitad de precio</p>
                    </div>
                </div>
                <div class="promotion-card">
                    <img src="{{ asset('images/promotion2.png') }}" alt="Promoción 2" />
                    <div class="promotion-info">
                        <h3>Descuentos en Bebidas</h3>
                        <p>Descuentos del 30% en toda la tienda</p>
                    </div>
                </div>
                <div class="promotion-card">
                    <img src="{{ asset('images/pizza.jpg') }}" alt="Promoción 3" />
                    <div class="promotion-info">
                        <h3>Pizza Familiar</h3>
                        <p>Compra 1 y obtén 2ª pizza a 50% de descuento</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        @include('footer.footer')
    </footer>

    <script src="https://unpkg.com/swiper@9/swiper-bundle.min.js"></script>
    <script>
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
        },
    });

    document.querySelector('.hamburger-menu').addEventListener('click', function() {
        document.querySelector('.menu').classList.toggle('open');
    });
    </script>
</body>

</html>