<!DOCTYPE html>
<html>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
}

* {
    box-sizing: border-box
}

/* Full-width input fields */
input[type=text],
input[type=password],
input[type=tel],
select {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus,
input[type=password]:focus,
input[type=tel]:focus,
select:focus {
    background-color: #ddd;
    outline: none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
    background-color: #04AA6D;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity: 1;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn,
.signupbtn {
    float: left;
    width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {

    .cancelbtn,
    .signupbtn {
        width: 100%;
    }
}
</style>

<body>

    <form action="{{ route('register') }}" method="POST" style="border:1px solid #ccc">
        @csrf
        <!-- Token de seguridad para formularios en Laravel -->
        <div class="container">
            <h1>Registro</h1>
            <p>Por favor, llena este formulario para crear una cuenta.</p>
            <hr>

            <!-- Campo Nombre -->
            <label for="nombre"><b>Nombre</b></label>
            <input type="text" placeholder="Ingresa tu nombre" name="nombre" required>

            <!-- Campo Email -->
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Ingresa tu Email" name="email" required>

            <!-- Campo Dirección -->
            <label for="direccion"><b>Dirección</b></label>
            <input type="text" placeholder="Ingresa tu dirección" name="direccion" required>

            <!-- Campo Teléfono -->
            <label for="telefono"><b>Teléfono</b></label>
            <input type="tel" placeholder="Ingresa tu número de teléfono" name="telefono" required>

            <!-- Campo Vehículo -->
            <label for="vehiculo"><b>Vehículo</b></label>
            <select name="vehiculo" required>
                <option value="ninguno">Ninguno</option>
                <option value="moto">Moto</option>
                <option value="bicicleta">Bicicleta</option>
            </select>

            <!-- Campo Rol -->
            <!-- Campo Rol -->
            <label for="rol"><b>Rol</b></label>
            <select name="rol" required>
                <option value="cliente">Cliente</option>
                <option value="repartidor">Repartidor</option>
                <option value="restaurante">Restaurante</option>
            </select>


            <!-- Campo Contraseña -->
            <label for="psw"><b>Contraseña</b></label>
            <input type="password" placeholder="Ingresa tu contraseña" name="password" required>

            <!-- Confirmar Contraseña -->
            <label for="psw-repeat"><b>Repite la contraseña</b></label>
            <input type="password" placeholder="Repite la contraseña" name="password_confirmation" required>

            <label>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Recordarme
            </label>

            <p>Al crear una cuenta aceptas nuestros <a href="#" style="color:dodgerblue">Términos & Privacidad</a>.</p>

            <div class="clearfix">
                <button type="button" class="cancelbtn">Cancelar</button>
                <button type="submit" class="signupbtn">Registrar</button>
            </div>
        </div>
    </form>

</body>

</html>