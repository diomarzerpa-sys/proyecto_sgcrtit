<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use App\Models\Department;
use App\Models\Tool;
use App\Models\Staff; // Asegúrate de importar el modelo Staff
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth; // Importa el facade Auth

// Asegúrate de que tu modelo User use el trait Spatie\Permission\Traits\HasRoles
// Ejemplo: use Spatie\Permission\Traits\HasRoles; en tu modelo User

class ToolController extends Controller
{
    /**
     * Muestra una lista de los recursos.
     */
    public function index()
    {
        // 1. Obtener el usuario autenticado y su ID
        $user = Auth::user(); // Usamos el facade Auth para consistencia y claridad
        $userId = $user->id;

        // 2. Recuperar la información del personal vinculada a este usuario (si existe)
        $loggedInStaff = Staff::where('user_id', $userId)->first();

        // 3. Inicializar variables que se pasarán a la vista
        $tools = new Collection(); // Inicializamos como una colección vacía
        $userHasDepartment = false; // Bandera para indicar si se encontraron herramientas por departamento
        $userRoleName = null; // Variable para almacenar el nombre del rol del usuario

        // 4. Obtener el nombre del rol del usuario
        if ($user && $user->roles->isNotEmpty()) {
            $userRoleName = $user->roles->first()->name;
        }

        // 5. Aplicar la lógica de filtrado basada en el rol del usuario
        switch ($userRoleName) {
            case 'Admin':
                // Si el rol es 'Admin', queremos TODAS las herramientas.
                $tools = Tool::orderBy('classification_id', 'asc')->paginate();
                $userHasDepartment = true; // Los administradores siempre tienen acceso a todos los datos
                break;

            case 'Coord':
            case 'Normal':
                // Si el rol es 'Coord' o 'Normal', solo queremos las herramientas de SU departamento.
                if ($loggedInStaff && $loggedInStaff->department_id) {
                    $departmentId = $loggedInStaff->department_id;

                    $tools = Tool::where('department_id', $departmentId)
                                 ->orderBy('classification_id', 'asc')
                                 ->paginate();
                    $userHasDepartment = true;
                } else {
                    // Si el usuario 'Coord'/'Normal' no tiene información de personal o departamento,
                    // la colección '$tools' seguirá vacía, y '$userHasDepartment' se quedará en false.
                    $userHasDepartment = false;
                }
                break;

            default:
                // Para cualquier otro rol (o si el usuario no tiene rol asignado),
                // no se muestra ninguna herramienta. Las variables '$tools' y '$userHasDepartment'
                // permanecerán con sus valores iniciales (colección vacía y false).
                $userHasDepartment = false;
                break;
        }

        // 6. Retornar la vista con los datos procesados
        return view('admin.tools.index', compact('tools', 'userRoleName', 'userHasDepartment'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        $ClassificationTools = Classification::where('type', 'Tool')
            ->get();

        $departments = Department::orderBy('name', 'asc')
            ->get();

        return view('admin.tools.create', compact('ClassificationTools', 'departments'));
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'memo' => 'required|string|max:255',
            'date_of_receipt' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'selected_tools' => 'required|array',
            'selected_tools.*.id' => 'required|exists:classifications,id',
            'selected_tools.*.stock' => 'required|integer|min:1',
            'selected_tools.*.statusTool' => 'required|string|in:Optimo,Regular,Deteriorado,Averiado,Chatarra,No Operativo',
            'selected_tools.*.observations' => 'nullable|string|max:1000',
        ]);

        $memo = $validatedData['memo'];
        $dateOfReceipt = $validatedData['date_of_receipt'];
        $departmentID = $validatedData['department_id'];

        // Accede a las herramientas seleccionadas así:
        $selectedTools = $validatedData['selected_tools'] ?? [];

        foreach ($selectedTools as $toolData) {
            Tool::create([
                'memo' => $memo,
                'date_of_receipt' => $dateOfReceipt,
                'department_id' => $departmentID,
                'classification_id' => $toolData['id'],
                'stock' => $toolData['stock'],
                'statusTool' => $toolData['statusTool'],
                'observationsTool' => $toolData['observations'] ?? null,
            ]);
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Las Herramientas y Consumibles',
            'text' => 'Fueron agregados con éxito'
        ]);

        return redirect()->route('admin.tools.index');
    }

    /**
     * Muestra el recurso especificado.
     */
    public function show(Tool $tool)
    {
        //
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     */
    public function edit(Tool $tool)
    {
        $ClassificationTools = Classification::where('type', 'Tool')
            ->get();

        return view('admin.tools.edit', compact('tool', 'ClassificationTools'));
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     */
    public function update(Request $request, Tool $tool)
    {
        $data = $request->validate([
            'memo' => 'required|string|max:255',
            'date_of_receipt' => 'required|date',
            'classification_id' => 'required|exists:classifications,id',
            'stock' => 'required|integer|min:1',
            'statusTool' => 'required|string|in:Optimo,Regular,Deteriorado,Averiado,Chatarra,No Operativo',
            'observationsTool' => 'nullable|string|max:1000',
        ]);

        $tool->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Modificación de la herramienta',
            'text' => 'Se ha realizado con éxito'
        ]);

        return redirect()->route('admin.tools.index');
    }

    /**
     * Elimina el recurso especificado del almacenamiento.
     */
    public function destroy(Tool $tool)
    {
        try {
            $tool->delete();

            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Eliminación de la Herramienta',
                'text' => 'La Herramienta ' . $tool->name . ' se ha eliminado con éxito'
            ]);

            return redirect()->route('admin.tools.index');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                session()->flash('swal', [
                    'icon' => 'error',
                    'title' => 'Eliminación de Herramienta Fallida',
                    'text' => 'Tiene elementos asociados a ella y no se puede eliminar'
                ]);
                return redirect()->route('admin.tools.index');
            }

            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Eliminación de Herramienta Fallida',
                'text' => 'Ocurrió un error inesperado al intentar eliminar la categoría: ' . $e->getMessage()
            ]);
            return redirect()->route('admin.tools.index');
        } catch (\Exception $e) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Eliminación de la Herramienta Fallida',
                'text' => 'Ocurrió un error inesperado: ' . $e->getMessage()
            ]);
            return redirect()->route('admin.tools.index');
        }
    }
}