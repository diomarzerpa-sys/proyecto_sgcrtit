<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::orderBy('name','asc')
            ->paginate();

        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:4|max:255|unique:departments'
        ]);

        Department::create($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Creacion de Unidad Administrativa',
            'text' => 'La Unidad '.$data['code'].' se ha creado con exito'
        ]);

        return redirect()->route('admin.departments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $data = $request->validate([
            'name' => 'required|string|min:4|max:255|unique:departments,name,' . $department->id
        ]);

        $department->update($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Modificacion de Unidad Administrativa',
            'text' => 'La Unidad se ha actualizado con exito'
        ]);

        return redirect()->route('admin.departments.edit', $department);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            // Intentar eliminar el cliente
            $department->delete();

            session()->flash('swal',[
                'icon' => 'success',
                'title' => 'Eliminación de Unidad Administrativa',
                'text' => 'La Unidad se ha eliminadoo con exito'
            ]);

            return redirect()->route('admin.departments.index');

        } catch (QueryException $e) {
            // Capturar la excepción de la base de datos
            // El código de error '23000' es común para violaciones de integridad de datos (incluidas las claves foráneas)
            if ($e->getCode() == '23000') {

                session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación de Unidad Administrativa',
                    'text' => 'La Unidad tiene elementos asociados a ella y no se puede eliminar'
                ]);

            return redirect()->route('admin.departments.index');
                
            }

             // Para otros errores de base de datos no relacionados con claves foráneas, puedes manejarlos diferente
             session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación de Unidad Administrativa',
                    'text' => 'Ocurrió un error inesperado al intentar eliminar la unidad: ' . $e->getMessage()
                ]);

            return redirect()->route('admin.departments.index');

        } catch (\Exception $e) {
            // Capturar cualquier otra excepción genérica
            session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación de Unidad Administrativa',
                    'text' => 'Ocurrió un error inesperado: ' . $e->getMessage()
                ]);

                return redirect()->route('admin.departments.index');
        }

    }
}
