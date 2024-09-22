<x-guest-layout>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        .form-container {
            width: 60%;
            margin: auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        input[type=text],
        input[type=email],
        input[type=time],
        input[type=password],
        input[type=tel],
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f1f1f1;
        }

        input:focus,
        select:focus {
            background-color: #ddd;
            outline: none;
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-col {
            flex: 1;
        }

        hr {
            border: 1px solid #f1f1f1;
            margin: 25px 0;
        }

        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
        }

        button:hover {
            background-color: #039f64;
        }

        .cancelbtn {
            background-color: #e11e00;
        }

        .signupbtn {
            background-color: #e18f00;
        }

        .clearfix {
            display: flex;
            justify-content: space-between;
        }

        @media screen and (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }

            .clearfix {
                flex-direction: column;
            }

            .cancelbtn, .signupbtn {
                width: 100%;
            }
        }
    </style>

    <form action="{{ route('solicitudes.store') }}" method="POST">
        @csrf
        <div class="form-container">
            <center><h1>Solicitud de Restaurante</h1></center>

            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div style="color: green; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <p>Ingresa tus datos personales.</p>
            <hr>

            <div class="form-row">
                <div class="form-col">
                    <label for="nombre"><b>Nombre</b></label>
                    <input type="text" placeholder="Ingresa tu nombre" name="nombre" id="nombre" required>
                </div>
                <div class="form-col">
                    <label for="email"><b>Email</b></label>
                    <input type="email" placeholder="Ingresa tu Email" name="email" id="email" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label for="direccion"><b>Dirección</b></label>
                    <input type="text" placeholder="Ingresa tu dirección" name="direccion" id="direccion" required>
                </div>
                <div class="form-col">
                    <label for="telefono"><b>Teléfono</b></label>
                    <input type="tel" placeholder="Ingresa tu número de teléfono" name="telefono" id="telefono" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label for="password"><b>Contraseña</b></label>
                    <input type="password" placeholder="Ingresa tu contraseña" name="password" id="password" required>
                </div>
                <div class="form-col">
                    <label for="password_confirmation"><b>Repite la contraseña</b></label>
                    <input type="password" placeholder="Repite la contraseña" name="password_confirmation" id="password_confirmation" required>
                </div>
            </div>

            <p>Ingresa los datos de tu negocio.</p>
            <hr>

            <label for="nombre_negocio"><b>Nombre del negocio</b></label>
            <input type="text" placeholder="Nombre del negocio" name="nombre_negocio" id="nombre_negocio" required>

            <label for="categoria"><b>Categoría de su negocio</b></label>
            <select name="categoria" id="categoria" required>
                <option value="pizza">Pizza</option>
                <option value="sushi">Sushi</option>
                <option value="pasteleria">Pastelería</option>
                <option value="cafe">Cafetería</option>
            </select>

            <div class="form-row">
                <div class="form-col">
                    <label for="hora_apertura"><b>Horario de apertura</b></label>
                    <input type="time" name="hora_apertura" id="hora_apertura" required>
                </div>
                <div class="form-col">
                    <label for="hora_cierre"><b>Horario de cierre</b></label>
                    <input type="time" name="hora_cierre" id="hora_cierre" required>
                </div>
            </div>

            <div class="clearfix">
                <a href="/"><button type="button" class="cancelbtn">Cancelar</button></a>
                <button type="submit" class="signupbtn">Registrar</button>
            </div>
        </div>
    </form>
</x-guest-layout>
