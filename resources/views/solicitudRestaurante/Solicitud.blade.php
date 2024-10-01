<x-guest-layout>
    <style>
    body.solicitud-body {
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f4f4f4;
    }

    /* Aseguramos que el formulario no quede pegado al header o footer */
    .solicitud-form-container {
        max-width: 1200px;
        /* Aumenta el ancho máximo */
        margin: 80px auto;
        /* Mantiene el margen superior */
        background: white;
        padding: 30px;
        /* Aumenta el padding interno */
        border-radius: 15px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        /* Opcional: aumenta el tamaño de la sombra */
    }



    element.style {
        margin-top: 20px;
    }



    .solicitud-header {
        text-align: center;
        color: #333;
        font-size: 24px;
        margin-bottom: 30px;
        font-weight: 500;
    }

    .solicitud-subtext {
        color: #666;
        text-align: center;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .solicitud-divider {
        border: 0;
        border-top: 1px solid #eaeaea;
        margin: 20px 0;
    }

    .solicitud-input,
    .solicitud-select {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0;
        display: inline-block;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        font-size: 14px;
        transition: all 0.3s ease-in-out;
    }

    .solicitud-input:focus,
    .solicitud-select:focus {
        background-color: #fff;
        border-color: #007bff;
        outline: none;
    }

    .solicitud-label {
        font-weight: bold;
        color: #333;
        display: inline-block;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .solicitud-button {
        background-color: #ec860a;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        width: 100%;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 20px;
    }

    .solicitud-button:hover {
        background-color: #a65c00;

    }

    .solicitud-cancel-button {
        background-color: #e11e00;
        color: white;
        padding: 12px;
        border-radius: 8px;
        width: 100%;
        font-size: 16px;
        cursor: pointer;
        margin-top: 10px;
        transition: background-color 0.3s ease;
    }

    .solicitud-cancel-button:hover {
        background-color: #b30e00;
    }

    .solicitud-row {
        display: flex;
        flex-direction: row;
        gap: 20px;
    }

    .solicitud-col-6 {
        flex: 1;
    }

    .solicitud-clearfix {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
    }

    /* Media queries para ajustar a dispositivos móviles */
    @media screen and (max-width: 600px) {
        .solicitud-form-container {
            padding: 20px;
            margin: 50px auto;
            /* Margen reducido para pantallas pequeñas */
        }

        .solicitud-header {
            font-size: 20px;
        }

        .solicitud-row {
            flex-direction: column;
        }
    }


    .accion-row {
        display: flex;
        justify-content: center;
        /* Centra los botones */
        margin-top: 20px;
        /* Espacio superior */
    }

    .accion-col-6 {
        flex: 1;
        /* Asegura que ambas columnas ocupen el mismo ancho */
        padding: 0 10px;
        /* Espaciado horizontal entre columnas */
    }

    .boton-cancelar {
        /* Estilos específicos para el botón de cancelar */
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .boton-registrar {
        /* Estilos específicos para el botón de registrar */
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
    </style>

    <div class="solicitud-form-container">
        <h1 class="solicitud-header">Solicitud de Restaurante</h1>

        <form action="{{ route('solicitudes.store') }}" method="POST">
            @csrf
            <p class="solicitud-subtext">Ingresa tus datos personales</p>
            <hr class="solicitud-divider">

            <div class="solicitud-row">
                <div class="solicitud-col-6">
                    <label for="solicitud-nombre" class="solicitud-label">Nombre</label>
                    <input type="text" placeholder="Ingresa tu nombre" name="nombre" id="solicitud-nombre"
                        class="solicitud-input" required>
                </div>
                <div class="solicitud-col-6">
                    <label for="solicitud-email" class="solicitud-label">Email</label>
                    <input type="email" placeholder="Ingresa tu Email" name="email" id="solicitud-email"
                        class="solicitud-input" required>
                </div>
            </div>

            <label for="solicitud-direccion" class="solicitud-label">Dirección</label>
            <input type="text" placeholder="Ingresa tu dirección" name="direccion" id="solicitud-direccion"
                class="solicitud-input" required>

            <label for="solicitud-telefono" class="solicitud-label">Teléfono</label>
            <input type="tel" placeholder="Ingresa tu número de teléfono" name="telefono" id="solicitud-telefono"
                class="solicitud-input" required>

            <div class="solicitud-row">
                <div class="solicitud-col-6">
                    <label for="solicitud-password" class="solicitud-label">Contraseña</label>
                    <input type="password" placeholder="Ingresa tu contraseña" name="password" id="solicitud-password"
                        class="solicitud-input" required>
                </div>
                <div class="solicitud-col-6">
                    <label for="solicitud-password-confirmation" class="solicitud-label">Repite la contraseña</label>
                    <input type="password" placeholder="Repite la contraseña" name="password_confirmation"
                        id="solicitud-password-confirmation" class="solicitud-input" required>
                </div>
            </div>
            <br><br>
            <p class="solicitud-subtext">Ingresa los datos de tu negocio</p>
            <hr class="solicitud-divider">

            <label for="solicitud-nombre-negocio" class="solicitud-label">Nombre del negocio</label>
            <input type="text" placeholder="Nombre del negocio" name="nombre_negocio" id="solicitud-nombre-negocio"
                class="solicitud-input" required>

            <label for="solicitud-categoria" class="solicitud-label">Categoría de su negocio</label>
            <select name="categoria_id" id="solicitud-categoria" class="solicitud-select" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
            <div class="solicitud-row">
                <div class="solicitud-col-6">
                    <label for="solicitud-hora-apertura" class="solicitud-label">Horario de apertura</label>
                    <input type="time" name="hora_apertura" id="solicitud-hora-apertura" class="solicitud-input"
                        required>
                </div>
                <div class="solicitud-col-6">
                    <label for="solicitud-hora-cierre" class="solicitud-label">Horario de cierre</label>
                    <input type="time" name="hora_cierre" id="solicitud-hora-cierre" class="solicitud-input" required>
                </div>
            </div>

            <div class="accion-row justify-center">
                <div class="accion-col-6">
                    <button type="button"
                        class="boton-cancelar bg-red-600 text-white w-full h-12 rounded-md shadow-md hover:bg-red-700 transition"
                        onclick="window.location.href='/'">Cancelar Solicitud</button>
                </div>
                <div class="accion-col-6">
                    <button type="submit"
                        class="boton-registrar bg-orange-500 text-white w-full h-12 rounded-md shadow-md hover:bg-orange-600 transition">Registrar
                        Restaurante</button>
                </div>
            </div>
        </form>
        <script>
            @if(session('success'))
                Swal.fire({
                    title: '¡Éxito!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            @endif

            @if(session('errors'))
                Swal.fire({
                    title: '¡Error!',
                    text: `@foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach`,
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            @endif
        </script>
    </div>
</x-guest-layout>