<?php

namespace App\Http\Controllers;

use App\Models\User; // Importar el modelo User
use App\Models\Restaurante; // Importar el modelo Restaurant
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;

class SolicitudController extends Controller
{
    public function index()
    {
        return view('solicitudRestaurante.notificacion');
    }

    public function create()
    {
        $categorias = Categoria::all(); // Cargar todas las categorías
        return view('solicitudRestaurante.Solicitud', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|regex:/^[\p{L}\s]+$/u',
            'email' => 'required|email|unique:users,email',
            'direccion' => 'required|string|min:15|max:255|regex:/^[\p{L}0-9\s#,.]+$/u',
            'telefono' => 'required|numeric|digits_between:10,10',
            'password' => 'required|string|confirmed|min:8',
            'nombre_negocio' => 'required|string|max:255|regex:/^[\p{L}\s]+$/u',
            'categoria_id' => 'required|exists:categorias,id',
            'horario_apertura' => 'required|date_format:H:i',
            'horario_cierre' => 'required|date_format:H:i|after:horario_apertura',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif',
        ], [
            'nombre.required' => 'El nombre es obligatorio. ',
            'nombre.regex' => 'El nombre debe de contener únicamente letras y espacios. ',
            'email.required' => 'El correo electrónico es obligatorio. ',
            'email.email' => 'El formato del correo electrónico no es válido. ',
            'email.unique' => 'El correo electrónico ya está en uso. ',
            'direccion.required' => 'La dirección es obligatoria. ',
            'direccion.regex' => 'La dirección debe contener únicamente letras, espacios y números. ',
            'direccion.min' => 'La dirección debe contener al menos 15 caracteres. ',
            'telefono.required' => 'El teléfono es obligatorio. ',
            'telefono.numeric' => 'El teléfono debe ser un número válido. ',
            'telefono.digits_between' => 'El teléfono debe contener únicamente 10 dígitos. ',
            'password.required' => 'La contraseña es obligatoria. ',
            'password.confirmed' => 'Las contraseñas no coinciden. ',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres. ',
            'nombre_negocio.required' => 'El nombre del negocio es obligatorio. ',
            'nombre_negocio.regex' => 'Coloca solo letras y espacios. ',
            'categoria_id.required' => 'La categoría es obligatoria. ',
            'horario_apertura.required' => 'La hora de apertura es obligatoria. ',
            'horario_cierre.required' => 'La hora de cierre es obligatoria. ',
            'hora_apertura.date_format' => 'Seleccione horarios válidos. ',
            'horario_apertura.date_format' => 'Seleccione horarios válidos. ',
            'horario_cierre.after' => 'El cierre del horario debe ser posterior a la apertura del horario.',
            'imagen.required' => 'La imagen es obligatoria. ',
            'imagen.image' => 'La imagen es obligatoria. ',
            'imagen.mimes' => 'Inserte archivos únicamente del tipo jpeg, png, jpg, gif. ',

        ]);

        

        
        $imagenUrl = null;
        if ($request->hasFile('imagen')) {
            // Obtener el archivo de la imagen
            $imagen = $request->file('imagen');
            // Definir la ruta donde se almacenará la imagen
            $rutaImagen = public_path('imagenes');
    
            // Generar un nombre único para la imagen
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
    
            // Mover la imagen a la carpeta deseada
            $imagen->move($rutaImagen, $nombreImagen);
    
            // Guardar la ruta de la imagen en la base de datos
            $imagenUrl = 'imagenes/' . $nombreImagen;
        }

        $user = User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
            'tipo' => 'restaurante',
        ]);
        // Crear un nuevo restaurante relacionado con el usuario
        Restaurante::create([
            'user_id' => $user->id,
            'nombre' => $request->nombre_negocio,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'categoria_id' => $request->categoria_id,
            'horario' => $request->horario_apertura . ' - ' . $request->horario_cierre,
            'imagen' => $imagenUrl, // Guardar la ruta de la imagen
            'estado' => 'Pendiente',
        ]);
    
        return redirect()->route('Registrosolicitud')->with('success', 'Solicitud realizada con éxito');
    }
}
