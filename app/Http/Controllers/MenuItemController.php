<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Auth;

class MenuItemController extends Controller
{
    /**
     * Obtener datos comunes para las vistas.
     *
     * @return array
     */
    private function getCommonData()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener el restaurante asociado al usuario
        $restaurante = $user->restaurante;

        if (!$restaurante) {
            return [
                'totalPlatos' => 0, // Si no hay restaurante, retornar 0
                'menuItems' => [],
            ];
        }

        // Obtener todos los platos del menú para el restaurante
        $menuItems = $restaurante->menuItems; // Asegúrate de que la relación esté definida en el modelo Restaurante
        $totalPlatos = $menuItems->count();

        return compact('menuItems', 'totalPlatos');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->getCommonData(); // Obtener datos comunes
        return view('menu.index', $data); // Pasar datos a la vista
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.nuevoplato');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048', // Validar que sea una imagen
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

        MenuItem::create([
            'restaurante_id' => Auth::user()->restaurante->id, // Obtener el ID del restaurante
            'nombre_producto' => $request->nombre_producto,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen_url' => $imagenUrl,
        ]);

        return redirect()->route('menu.index')->with('success', 'Plato registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        return view('menu.show', compact('menuItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        return view('menu.edit', compact('menuItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048', // Validar que sea una imagen
        ]);

        $menuItem = MenuItem::findOrFail($id);
        $imagenUrl = $menuItem->imagen_url; // Mantener la imagen anterior por defecto

        if ($request->hasFile('imagen')) {
            // Obtener el archivo de la nueva imagen
            $imagen = $request->file('imagen');
            // Definir la ruta donde se almacenará la imagen
            $rutaImagen = public_path('imagenes');

            // Generar un nombre único para la nueva imagen
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();

            // Mover la nueva imagen a la carpeta deseada
            $imagen->move($rutaImagen, $nombreImagen);

            // Actualizar la URL de la imagen
            $imagenUrl = 'imagenes/' . $nombreImagen;
        }

        // Actualizar los datos del plato
        $menuItem->update([
            'nombre_producto' => $request->nombre_producto,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen_url' => $imagenUrl,
        ]);

        return redirect()->route('menu.index')->with('success', 'Plato actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->delete();

        return redirect()->route('menu.index')->with('success', 'Plato eliminado correctamente.');
    }

    /**
     * Muestra el dashboard con el total de menús.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $data = $this->getCommonData(); // Obtener datos comunes
        return view('dashboard', $data); // Pasar datos a la vista
    }
}
