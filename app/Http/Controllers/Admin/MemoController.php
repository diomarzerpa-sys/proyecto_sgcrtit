<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use App\Models\Memo;
use App\Models\Staff;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MemoController extends Controller
{
    /**
     * Muestra una lista de los recursos.
     */
    public function index()
    {
        // 1. Obtener el usuario autenticado y su ID
        $user = auth()->user();
        $userId = $user->id;

        // 2. Recuperar la información del personal vinculada a este usuario (si existe)
        // Esto es útil para roles 'Coord' o 'Normal' que necesitan saber su departamento.
        $loggedInStaff = Staff::where('user_id', $userId)->first();

        // 3. Inicializar variables que se pasarán a la vista
        $memos = new Collection();
        $userHasDepartment = false;
        $userRoleName = null;

        // 4. Obtener el nombre del rol del usuario
        if ($user && $user->roles->isNotEmpty()) {
            $userRoleName = $user->roles->first()->name;
        }

        // 5. Aplicar la lógica de filtrado basada en el rol del usuario
        switch ($userRoleName) {
            case 'Admin':
                $memos = Memo::with(['departments.manager.staff', 'staff.department'])
                    ->orderBy('nro_control', 'asc')
                    ->paginate();
                $userHasDepartment = true;
                break;

            case 'Coord':
            case 'Normal':
                if ($loggedInStaff && $loggedInStaff->department_id) {
                    $departmentId = $loggedInStaff->department_id;
                    $memos = Memo::whereHas('departments', function ($query) use ($departmentId) {
                        $query->where('departments.id', $departmentId);
                    })
                        ->with(['departments.manager.staff', 'staff.department'])
                        ->orderBy('nro_control', 'asc')
                        ->paginate();
                    $userHasDepartment = true;
                } else {
                    $userHasDepartment = false;
                }
                break;

            default:
                $userHasDepartment = false;
                break;
        }

        // 6. Retornar la vista con los datos procesados
        return view('admin.memos.index', compact('memos', 'userRoleName', 'userHasDepartment'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
        public function create()
    {
        // Obtener el ID del usuario autenticado
        $user = auth()->user();

        // 1. Recuperar la información del personal vinculada al usuario
        $staff = Staff::where('user_id', $user->id)->first();
        // Verificar si se encontró el personal y su departamento
        if (!$staff || !$staff->department_id) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error de Acceso',
                'text' => 'Su usuario no está vinculado a un departamento. No se puede crear un memorándum.',
            ]);
            return redirect()->route('admin.memos.index');
        }

        // Obtener el departamento del usuario autenticado
        $userDepartment = $staff->department;

        // 2. Generar el número de control dinámicamente
        // Tomar las primeras 3 letras del nombre del departamento y convertirlas a mayúsculas
        $departmentInitials = strtoupper(substr($userDepartment->name, 0, 3));

        // Obtener el año actual
        $currentYear = date('Y');

        // Encontrar el último memo con el mismo prefijo para el departamento
        $lastMemo = Memo::where('nro_control', 'like', "BO-{$departmentInitials}-{$currentYear}%")
            ->orderBy('nro_control', 'desc')
            ->first();

        // Determinar el nuevo correlativo
        $correlative = $lastMemo
            ? intval(substr($lastMemo->nro_control, -3)) + 1
            : 1;

        // Formatear el correlativo con ceros a la izquierda (ej. 001, 010, 100)
        $controlNumber = "BO-{$departmentInitials}-{$currentYear}" . sprintf("%03d", $correlative);

        // 3. Obtener los departamentos para el formulario
        $departments = Department::orderBy('name', 'asc')->get();

        // 4. Obtener las categorías relacionadas al departamento del usuario
        $categories = Category::where('department_id', $userDepartment->id)
            ->orderBy('name', 'asc')
            ->get();

        // Retornar la vista de creación con los datos
        return view('admin.memos.create', compact('departments', 'controlNumber', 'categories', 'userDepartment'));
    }
    
    /**
     * Almacena un nuevo recurso en el almacenamiento.
     */
    public function store(Request $request)
    {
        // 1. Obtener el ID del usuario autenticado
        $userId = auth()->id();

        // 2. Recuperar la información del personal del usuario
        $staff = Staff::where('user_id', $userId)->first();
        $departmentId = $staff ? $staff->department_id : null;

        // 3. Validar los datos del formulario. Se añade una validación para el departamento del usuario
        $data = $request->validate([
            'nro_control' => [
                'required',
                'string',
                'max:255',
                // Se agrega una regla de validación 'unique' más robusta
                // que verifica que el número de control no exista en la tabla de memos.
                Rule::unique('memos', 'nro_control'),
            ],
            'date_created' => 'required|date',
            'category_id' => [
                'required',
                // Se añade una regla de validación para asegurar que la categoría pertenezca al departamento del usuario
                Rule::exists('categories', 'id')->where(function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                }),
            ],
            'title' => 'required|string|min:3|max:255',
            'content' => 'required',
            'departments' => 'required_without:addressed_to|array',
            'departments.*' => 'exists:departments,id',
            'addressed_to' => 'required_without:departments|nullable|string|max:255',
        ]);

        // 4. Se elimina la lógica de generación del número de control de aquí, ya que se genera en `create`.
        //    Ahora, el número de control es un campo que el usuario no puede modificar.

        // 5. Verificación de la existencia del manager y staff en los departamentos seleccionados
        if (isset($data['departments']) && is_array($data['departments'])) {
            foreach ($data['departments'] as $departmentId) {
                $department = Department::find($departmentId);

                if (!$department || !$department->manager || !$department->manager->staff) {
                    session()->flash('swal', [
                        'icon' => 'error',
                        'title' => 'Error al crear Memorandum',
                        'text' => 'Uno o más de los departamentos seleccionados no tienen un gerente o miembro de personal registrado.',
                    ]);
                    return redirect()->back()->withInput();
                }
            }
        }

        // 6. Asignar el ID del usuario creador
        $data['user_id'] = $userId;

        // 7. Crear el memorándum
        $memo = Memo::create($data);

        // 8. Sincronizar la relación muchos a muchos con los departamentos
        if (isset($data['departments'])) {
            $memo->departments()->sync($data['departments']);
        } else {
            $memo->departments()->sync([]);
        }

        // 9. Mostrar mensaje de éxito y redirigir
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Creación del memo: ' . $data['nro_control'] . ' fue exitosa',
            'text' => 'Se ha realizado con éxito',
        ]);

        return redirect()->route('admin.memos.index');
    }

    /**
     * Muestra el recurso especificado.
     */
    public function show(Memo $memo)
    {
        return view('admin.memos.show', compact('memo'));
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     */
    public function edit(Memo $memo)
    {
        // 1. Obtener el ID del usuario autenticado
        $user = auth()->user();

        // 2. Recuperar la información del personal vinculada al usuario
        $staff = Staff::where('user_id', $user->id)->first();
        $staffDepartmentId = $staff ? $staff->department_id : null;

        // 3. Obtener los departamentos para el formulario
        $departments = Department::orderBy('name', 'asc')->get();

        // 4. Obtener las categorías relacionadas al departamento del usuario
        $categories = Category::when($staffDepartmentId, function ($query, $departmentId) {
            return $query->where('department_id', $departmentId);
        })
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.memos.edit', compact('memo', 'categories', 'departments'));
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     */
    public function update(Request $request, Memo $memo)
    {
        // 1. Obtener el ID del usuario autenticado
        $userId = auth()->id();

        // 2. Recuperar la información del personal del usuario
        $staff = Staff::where('user_id', $userId)->first();
        $departmentId = $staff ? $staff->department_id : null;

        // 3. Validar los datos del formulario, incluyendo el número de control.
        $data = $request->validate([
            'nro_control' => [
                'required',
                'string',
                'max:255',
                // Se asegura que el número de control sea único, excepto para el memo actual.
                Rule::unique('memos', 'nro_control')->ignore($memo->id),
            ],
            'date_created' => 'required|date',
            'category_id' => [
                'required',
                // Se valida que la categoría pertenezca al departamento del usuario.
                Rule::exists('categories', 'id')->where(function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                }),
            ],
            'title' => 'required|string|min:3|max:255',
            'content' => 'required',
            'departments' => 'required_without:addressed_to|array',
            'departments.*' => 'exists:departments,id',
            'addressed_to' => 'required_without:departments|nullable|string|max:255',
        ]);

        // 4. Verificación de la existencia del manager y staff en los departamentos seleccionados
        if (isset($data['departments']) && is_array($data['departments'])) {
            foreach ($data['departments'] as $departmentId) {
                $department = Department::find($departmentId);

                if (!$department || !$department->manager || !$department->manager->staff) {
                    session()->flash('swal', [
                        'icon' => 'error',
                        'title' => 'Error al actualizar Memorandum',
                        'text' => 'Uno o más de los departamentos seleccionados no tienen un gerente o miembro de personal registrado.',
                    ]);
                    return redirect()->back()->withInput();
                }
            }
        }

        // 5. Asignar el ID del usuario que realiza la actualización
        $data['user_id'] = $userId;

        // 6. Actualizar el memorándum con los nuevos datos
        $memo->update($data);

        // 7. Sincronizar la relación muchos a muchos con los departamentos
        if (isset($data['departments'])) {
            $memo->departments()->sync($data['departments']);
        } else {
            $memo->departments()->sync([]);
        }

        // 8. Mostrar mensaje de éxito y redirigir
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'La edición del memo: ' . $data['nro_control'] . ' fue exitosa',
            'text' => 'Se ha actualizado con éxito',
        ]);

        return redirect()->route('admin.memos.index');
    }

    /**
     * Elimina el recurso especificado del almacenamiento.
     */
    public function destroy(Memo $memo)
    {
        $name = $memo->nro_control;
        $memo->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Eliminación del Memorandum',
            'text' => 'El memo ' . $name . ' se ha eliminado con éxito',
        ]);

        return redirect()->route('admin.memos.index');
    }

    public function exportPdf($id)
    {
        // 1. Recuperar el memorándum y el personal que lo creó
        $memo = Memo::with('staff')->find($id);

        if (!$memo) {
            abort(404, 'Memorándum no encontrado.');
        }

        // 2. Recuperar el personal creador a través de la relación
        $staff = $memo->staff;

        // 3. Define las opciones de Dompdf
        $dompdfOptions = [
            'isPhpEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'Arial',
            'logOutputFile' => storage_path('logs/dompdf.log'),
            'chroot' => public_path(),
            'showWarnings' => true,
        ];

        // 4. Cargar la vista con los datos
        $pdf = Pdf::loadView('admin.memos.print', compact('memo', 'staff'));

        // 5. Pasar las opciones a Dompdf
        $pdf->setOptions($dompdfOptions);

        // 6. Devolver el PDF para ser visualizado en el navegador
        return $pdf->stream('memorandum-' . $memo->nro_control . '.pdf');
    }
}