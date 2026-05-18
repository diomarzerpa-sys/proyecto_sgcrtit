<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;

class ClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classifications = Classification::orderBy('type','asc')
            ->paginate();

        return view('admin.classifications.index', compact('classifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.classifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'type' => 'required|string',
        'name' => [
            'required',
            'string',
            'max:250',
            /* Regla de unicidad compuesta
                 Indica que estamos validando la unicidad en la tabla classifications.
                ->where(function ($query) use ($request) { ... }): Esta es la parte clave. Permite agregar condiciones adicionales a la consulta de unicidad.
                $query->where('brand', $request->brand): Le dice a Laravel que, además de verificar la unicidad del name, también debe asegurarse de que el brand del registro existente coincida con el brand que se está intentando guardar.
                ->where('model', $request->model): Y, de manera similar, que el model del registro existente también coincida.

            En resumen, esta regla dirá: "El name debe ser único solo si el brand y el model también son los mismos que los que intentas insertar".
            */

            Rule::unique('classifications')->where(function ($query) use ($request) {
                return $query->where('brand', $request->brand)
                             ->where('model', $request->model);
                    }),
                ],
                'brand' => 'required|string|max:250',
                'model' => 'required|string|max:250',
            ]);

        $data['name']  = ucfirst(strtolower($data['name']));
        $data['brand']  = ucfirst(strtolower($data['brand']));
        $data['model']  = ucfirst(strtolower($data['model']));

        Classification::create($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Creacion de clase de Bien',
            'text' => 'Se ha creado con exito'
        ]);

        return redirect()->route('admin.classifications.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classification $classification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classification $classification)
    {
        return view('admin.classifications.edit', compact('classification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classification $classification)
    {
         $data = $request->validate([
            'type' => 'required|string',
            'name' => [
                'required',
                'string',
                'max:250',
                // Regla de unicidad compuesta para UPDATE
                Rule::unique('classifications')->where(function ($query) use ($request) {
                    return $query->where('brand', $request->brand)
                                 ->where('model', $request->model);
                })->ignore($classification->id), // <--- ¡Esta es la clave para el update!
            ],
            'brand' => 'required|string|max:250',
            'model' => 'required|string|max:250',
        ]);

        $data['name']  = ucfirst(strtolower($data['name']));
        $data['brand']  = ucfirst(strtolower($data['brand']));
        $data['model']  = ucfirst(strtolower($data['model']));

        $classification->update($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Actualizacion de clase',
            'text' => 'Se ha creado con exito'
        ]);

        return redirect()->route('admin.classifications.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classification $classification)
    {
        try {
            // Intentar eliminar el cliente
            $classification->delete();

            session()->flash('swal',[
                'icon' => 'success',
                'title' => 'Eliminación de Clasificacion',
                'text' => 'Se ha realizado con exito'
            ]);

            return redirect()->route('admin.classifications.index');

        } catch (QueryException $e) {
            // Capturar la excepción de la base de datos
            // El código de error '23000' es común para violaciones de integridad de datos (incluidas las claves foráneas)
            if ($e->getCode() == '23000') {

                session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación de clasificacion de bien',
                    'text' => 'La clase tiene elementos asociados a ella y no se puede eliminar'
                ]);

            return redirect()->route('admin.classifications.index');
                
            }

             // Para otros errores de base de datos no relacionados con claves foráneas, puedes manejarlos diferente
             session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación de clasificacion de bien',
                    'text' => 'Ocurrió un error inesperado al intentar eliminar la clase: ' . $e->getMessage()
                ]);

            return redirect()->route('admin.classifications.index');

        } catch (\Exception $e) {
            // Capturar cualquier otra excepción genérica
            session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación de Unidad Administrativa',
                    'text' => 'Ocurrió un error inesperado: ' . $e->getMessage()
                ]);

                return redirect()->route('admin.classifications.index');
        }
    
    }
}
