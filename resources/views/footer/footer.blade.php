<style>
/* Estilos globales */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.main-container {
    flex: 1;
    /* Permite que el contenedor principal ocupe el espacio disponible */
    display: flex;
    flex-direction: column;
}

/* Estilos del Footer */
.default-footer {
    background-color: #ff6f00;
    color: #fff;
    padding: 20px 0;
    width: 100%;
    position: relative;
    /* Asegura que el footer se posicione correctamente */
    bottom: 0;
}

.footer-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
}

.footer-section {
    flex: 1;
    margin: 10px;
    min-width: 200px;
}

.footer-section h4 {
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 10px;
}

.footer-section ul li a {
    color: #fff;
    text-decoration: none;
    transition: color 0.3s;
}

.footer-section ul li a:hover {
    color: #004a99;
}

.footer-section p {
    margin: 5px 0;
}

.social-icons a {
    margin-right: 10px;
    color: #fff;
    text-decoration: none;
    transition: color 0.3s;
}

.social-icons a:hover {
    color: #004a99;
}

.footer-bottom {
    text-align: center;
    margin-top: 20px;
    border-top: 1px solid #444;
    padding-top: 10px;
}

/* Responsividad */
@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        align-items: center;
    }

    .footer-section {
        margin: 20px 0;
        text-align: center;
    }
}
</style>

<footer class="default-footer">
    <div class="footer-container">
        <div class="footer-section">
            <h4>Enlaces rápidos</h4>
            <ul>
                <li><a href="/inicio">Inicio</a></li>
                <li><a href="/sobre-nosotros">Sobre Nosotros</a></li>
                <li><a href="/menu">Menu</a></li>
                <li><a href="/contacto">Contacto</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Contacto</h4>
            <p>YUMMY Delivery</p>
            <p>Ocosingo, Chiapas, México</p>
            <p>Teléfono: +52 961 123 4567</p>
            <p>Email: contacto@yummy.com</p>
        </div>
        <div class="footer-section">
            <h4>Síguenos</h4>
            <div class="social-icons">
                <a href="https://facebook.com" target="_blank">Facebook</a>
                <a href="https://twitter.com" target="_blank">Twitter</a>
                <a href="https://instagram.com" target="_blank">Instagram</a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <a href="{{ route('terminos') }}">Términos y condiciones.</a> <br>
        <a href="{{ route('aviso_privacidad') }}">Aviso de privacidad.</a>
        <p>&copy; 2024 YUMMY. Todos los derechos reservados.</p>
    </div>
</footer>