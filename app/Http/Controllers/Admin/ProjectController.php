<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use App\Models\Project;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection; // Importar Collection para una correcta sugerencia de tipo

class ProjectController extends Controller
{
    /**
     * Muestra una lista del recurso.
     */
    public function index()
    {
        // 1. Obtener el usuario autenticado y su ID
        $user = auth()->user();
        $userId = $user->id;

        // 2. Recuperar la información del personal vinculada a este usuario (si existe)
        $loggedInStaff = Staff::where('user_id', $userId)->first();

        // 3. Inicializar variables que se pasarán a la vista
        $projects = new Collection(); // Inicializar con una colección vacía
        $userHasDepartment = false; // Bandera para indicar si se encontraron proyectos por departamento.
        $userRoleName = null; // Variable para almacenar el nombre del rol del usuario.

        // 4. Obtener el nombre del rol del usuario
        if ($user && $user->roles->isNotEmpty()) {
            $userRoleName = $user->roles->first()->name;
        }

        // 5. Aplicar la lógica de filtrado basada en el rol del usuario
        switch ($userRoleName) {
            case 'Admin':
                // Si el rol es 'Admin', queremos TODOS los proyectos.
                $projects = Project::orderBy('id', 'asc')->paginate();
                $userHasDepartment = true; // Los administradores siempre tienen acceso a los proyectos.
                break;

            case 'Coord':
            case 'Normal':
                // Si el rol es 'Coord' o 'Normal', solo queremos proyectos de SU departamento.
                if ($loggedInStaff && $loggedInStaff->department_id) {
                    $departmentId = $loggedInStaff->department_id;

                    // Filtrar proyectos por su departamento asociado
                    $projects = Project::where('department_id', $departmentId)
                        ->orderBy('id', 'asc')
                        ->paginate();
                    $userHasDepartment = true; // Establecer la bandera en verdadero porque se encontró un departamento.
                } else {
                    $userHasDepartment = false; // Si no hay personal o departamento, no se muestran proyectos.
                }
                break;

            default:
                // Para cualquier otro rol (o si el usuario no tiene un rol asignado),
                // no se muestran proyectos.
                $userHasDepartment = false;
                break;
        }

        // 6. Retornar la vista con los datos procesados
        return view('admin.projects.index', compact('projects', 'userRoleName', 'userHasDepartment'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();
        // Obtener el nombre del rol del usuario
        $userRoleName = $user && $user->roles->isNotEmpty() ? $user->roles->first()->name : null;

        // Obtener los datos necesarios para el formulario de creación de proyectos, pasando el rol del usuario
        $formData = $this->getFormDataForProjectForm($userRoleName);

        return view('admin.projects.create', $formData);
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3|max:250',
            'category_id' => 'required|exists:categories,id',
            'department_id' => 'required|exists:departments,id',
            'date_start' => 'required|date',
            'date_finish' => 'nullable|date',
            'content' => 'required',
            'status' => 'required',
            'staffs' => 'required|array',
            'staffs.*' => 'exists:staff,id'
        ]);

        // Crear el proyecto
        $project = Project::create($data);

        // Sincronizar la relación muchos a muchos con el personal
        // Si 'staffs' no está establecido (por ejemplo, si el campo es opcional y no se envió),
        // asegurar que la relación esté vacía.
        $project->staffs()->sync($data['staffs'] ?? []);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Creación del proyecto: ' . $data['title'] . ' fue exitosa',
            'text' => 'Se ha realizado con éxito'
        ]);

        // Redirigir a la vista de índice con los proyectos actualizados
        return redirect()->route('admin.projects.index');
    }

    /**
     * Muestra el recurso especificado.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     */
    public function edit(Project $project)
    {
        // Obtener el usuario autenticado
        $user = auth()->user();
        // Obtener el nombre del rol del usuario
        $userRoleName = $user && $user->roles->isNotEmpty() ? $user->roles->first()->name : null;

        // Obtener los datos necesarios para el formulario de edición de proyectos, pasando el rol del usuario
        $formData = $this->getFormDataForProjectForm($userRoleName);

        return view('admin.projects.edit', array_merge(compact('project'), $formData));
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3|max:250',
            'category_id' => 'required|exists:categories,id',
            'department_id' => 'required|exists:departments,id', // Validación de department_id añadida
            'date_start' => 'required|date',
            'date_finish' => 'nullable|date',
            'content' => 'required',
            'status' => 'required',
            'staffs' => 'required|array',
            'staffs.*' => 'exists:staff,id'
        ]);

        // Actualizar el proyecto
        $project->update($data);

        // Sincronizar la relación muchos a muchos con el personal
        // Si 'staffs' no está establecido, asegurar que la relación esté vacía.
        $project->staffs()->sync($data['staffs'] ?? []);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Modificación del proyecto: ' . $data['title'] . ' fue exitosa',
            'text' => 'Se ha realizado con éxito'
        ]);

        // Redirigir a la vista de índice con los proyectos actualizados
        return redirect()->route('admin.projects.index');
    }

    /**
     * Elimina el recurso especificado del almacenamiento.
     */
    public function destroy(Project $project)
    {
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Eliminación del Proyecto',
            'text' => 'El proyecto ' . $project['id'] . ' se ha eliminado con exito'
        ]);

        $project->delete();

        return redirect()->route('admin.projects.index');
    }

    /**
     * Método auxiliar para obtener datos comunes del formulario para las vistas de creación/edición de proyectos.
     *
     * @param string|null $userRoleName El nombre del rol del usuario autenticado.
     * @return array
     */
    private function getFormDataForProjectForm(?string $userRoleName): array
    {
        // Recuperar todos los departamentos registrados
        $departments = Department::orderBy('name', 'asc')->get();

        // Recuperar el ID del usuario autenticado
        $userId = auth()->user()->id;

        // Recuperar el personal vinculado a este usuario
        $staff = Staff::where('user_id', $userId)->first();

        // Si el personal no está vinculado a un departamento, esto podría ser un problema
        $staffDepartmentId = $staff ? $staff->department_id : null;

        // Recuperar solo las categorías relacionadas con el departamento al que pertenece el personal
        $categories = Category::when($staffDepartmentId, function ($query, $departmentId) {
            return $query->where('department_id', $departmentId);
        })
            ->orderBy('name', 'asc')
            ->get();

        // Recuperar miembros del personal según el rol del usuario
        $staffs = new Collection(); // Inicializar con una colección vacía
        switch ($userRoleName) {
            case 'Admin':
                // Si el rol es 'Admin', obtener todo el personal
                $staffs = Staff::orderBy('document_id', 'asc')->get();
                break;
            case 'Coord':
            case 'Normal':
                // Si el rol es 'Coord' o 'Normal', obtener el personal de su departamento
                if ($staffDepartmentId) {
                    $staffs = Staff::where('department_id', $staffDepartmentId)
                        ->orderBy('document_id', 'asc')
                        ->get();
                }
                break;
            default:
                // Para cualquier otro rol, no se muestra personal por defecto
                break;
        }

        return compact('departments', 'categories', 'staffs');
    }
}
