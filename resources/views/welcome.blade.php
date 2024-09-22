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
        margin-left: 10px;
        position: relative;
        transition: color 0.3s, transform 0.3s;
    }

    .logo-text::before {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background: #fff;
        transform: scaleX(0);
        transition: transform 0.3s;
        transform-origin: bottom right;
    }

    .logo-text:hover {
        color: #ffe0b2;
        transform: scale(1.05);
    }

    .logo-text:hover::before {
        transform: scaleX(1);
    }

    .auth-links {
        display: flex;
        gap: 10px;
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

    .hamburger-menu {
        background: none;
        border: none;
        font-size: 24px;
        color: white;
        cursor: pointer;
        display: none;
        transition: color 0.3s ease;
    }

    .hamburger-menu:hover {
        color: #ffe0b2;
    }

    .menu {
        display: none;
        flex-direction: column;
        gap: 10px;
        position: absolute;
        top: 60px;
        right: 0;
        background-color: #F87013;
        padding: 20px;
        width: 250px;
        height: calc(100vh - 60px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1001;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    }

    .menu.open {
        display: flex;
        transform: translateX(0);
    }

    @media (max-width: 768px) {
        .hamburger-menu {
            display: block;
        }

        .auth-links {
            display: none;
        }
    }

    @media (min-width: 769px) {
        .hamburger-menu {
            display: none;
        }

        .menu {
            display: flex;
        }
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
    </style>
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="{{ asset('images/Logo_Blanco__1.png') }}" alt="Logo" class="logo-img">
            <a href="#" class="logo-text">Yummy</a>
        </div>

        <nav class="auth-links">
            <a href="{{ route('login') }}" class="auth-link">Iniciar Sesion</a>
            <a href="{{ route('Registrosolicitud') }}"
                class="text-white auth-link">{{ __('Solicitud de registro de restaurantes') }}</a>
        </nav>

        <button class="hamburger-menu">&#9776;</button>

        <div class="menu">
            <!-- Menú lateral con enlaces adicionales si es necesario -->
        </div>
    </header>

    <main class="content">
        <!-- Banner principal -->
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
                                    <img src="{{ asset('images/promotion2.jpeg') }}" alt="Promo 2" />
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