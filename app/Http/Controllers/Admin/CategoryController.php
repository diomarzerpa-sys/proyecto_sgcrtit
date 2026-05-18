<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('department_id','asc')
                        ->paginate();
                          
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::orderBy('name','asc')
                                    ->get();

        return view('admin.categories.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'department_id' => 'required|exists:departments,id'
        ]);

        Category::create($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Creacion de categoria administrativa',
            'text' => 'La categoria '.$data['name'].' se ha creado con exito'
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $departments = Department::orderBy('name','asc')
                                    ->get();

        return view('admin.categories.edit', compact('category', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $departments = Department::orderBy('name','asc')
                                    ->get();

        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'department_id' => 'required|exists:departments,id'
        ]);

        $category->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Edicion de categorias',
            'text' => 'Se ha actualizado con exito'
        ]);

        return view('admin.categories.edit', compact('category', 'departments'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
         try {
            // Intentar eliminar el cliente
            session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Eliminación de la categoria',
            'text' => 'La categoria '.$category['name'].' se ha eliminadoo con exito'
        ]);

        $category->delete();

        return redirect()->route('admin.categories.index');

        } catch (QueryException $e) {
            // Capturar la excepción de la base de datos
            // El código de error '23000' es común para violaciones de integridad de datos (incluidas las claves foráneas)
            if ($e->getCode() == '23000') {

                session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación de Unidad Administrativa',
                    'text' => 'La Unidad tiene elementos asociados a ella y no se puede eliminar'
                ]);

            return redirect()->route('admin.categories.index');
                
            }

             // Para otros errores de base de datos no relacionados con claves foráneas, puedes manejarlos diferente
             session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación de Unidad Administrativa',
                    'text' => 'Ocurrió un error inesperado al intentar eliminar la categoria: ' . $e->getMessage()
                ]);

            return redirect()->route('admin.categories.index');

        } catch (\Exception $e) {
            // Capturar cualquier otra excepción genérica
            session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación de Unidad Administrativa',
                    'text' => 'Ocurrió un error inesperado: ' . $e->getMessage()
                ]);

                return redirect()->route('admin.categories.index');
        }
        
    }
}
