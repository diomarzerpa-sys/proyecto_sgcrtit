<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // 1. Obtener el usuario autenticado y su ID
        $user = auth()->user();
        $userId = $user->id; // Obtenemos el ID directamente del objeto $user

        // 2. Recuperar la información del personal vinculada a este usuario (si existe)
        // Esto es útil para roles 'Coord' o 'Normal' que necesitan saber su departamento.
        $loggedInStaff = Staff::where('user_id', $userId)->first();

        // 3. Inicializar variables que se pasarán a la vista
        // Por defecto, la colección de staffs estará vacía.
        $staffs = new Collection();
        $userHasDepartment = false; // Bandera para indicar si se encontraron staffs por departamento.
        $userRoleName = null; // Variable para almacenar el nombre del rol del usuario.

        // 4. Obtener el nombre del rol del usuario
        // Spatie Laravel Permission asume que tu modelo User usa el trait HasRoles.
        if ($user && $user->roles->isNotEmpty()) {
            $userRoleName = $user->roles->first()->name; // Recupera el nombre del primer rol.
        }

        // 5. Aplicar la lógica de filtrado basada en el rol del usuario
        // Usamos un 'switch' para manejar los diferentes casos de roles de forma limpia.
        switch ($userRoleName) {
            case 'Admin':
                // Si el rol es 'Admin', queremos TODOS los staffs.
                // No necesitamos ninguna restricción de departamento.
                $staffs = Staff::orderBy('document_id', 'asc')->paginate();
                // Opcional: Podrías establecer $userHasDepartment a true aquí si quieres
                // que la vista se comporte como si siempre hubiera datos para un admin.
                $userHasDepartment = true;
                break;

            case 'Coord':
            case 'Normal':
                // Si el rol es 'Coord' o 'Normal', solo queremos los staffs de SU departamento.
                // Primero, verificamos si el usuario actual tiene información de personal vinculada
                // y, más importante, si esa información incluye un 'department_id'.
                if ($loggedInStaff && $loggedInStaff->department_id) {
                    $departmentId = $loggedInStaff->department_id;
                    // Recuperamos los staffs cuyo 'department_id' coincide con el del usuario logeado.
                    $staffs = Staff::where('department_id', $departmentId)
                        ->orderBy('document_id', 'asc')
                        ->paginate();
                    $userHasDepartment = true; // Establecemos la bandera a true porque se encontró un departamento.
                } else {
                    // Si el usuario 'Coord'/'Normal' no tiene información de personal o departamento,
                    // la colección '$staffs' seguirá vacía, y '$userHasDepartment' se quedará en false.
                    // Esto significa que no se mostrará ningún staff para ellos.
                    $userHasDepartment = false;
                }
                break;

            default:
                // Para cualquier otro rol (o si el usuario no tiene rol asignado),
                // no se muestra ningún staff. Las variables '$staffs' y '$userHasDepartment'
                // permanecerán con sus valores iniciales (colección vacía y false).
                $userHasDepartment = false;
                break;
        }

        // 6. Retornar la vista con los datos procesados
        // Se pasan 'staffs', 'userHasDepartment' y 'userRoleName' a la vista.
        return view('admin.staffs.index', compact('staffs', 'userHasDepartment', 'userRoleName'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('is_vinculed', '=', false)
            ->get();

        $departments = Department::all();
        
        return view('admin.staffs.create', compact('users', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|unique:staff|exists:users,id',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'document_id' => 'required|string|max:15',
            'entry_date' => 'required',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|min:11|max:15',
            'department_id' => 'required|exists:departments,id',
            'observations' => 'nullable'
        ]);
        
        Staff::create($data);

        $user = User::find($data['user_id']);
        $user->is_vinculed = 1;
        
        $user->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Creación ficha tecnica',
            'text' => 'Se ha actualizado con exito'
        ]);

        $staffs = Staff::orderBy('name','asc')
            ->paginate();

        return view('admin.staffs.index', compact('staffs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        return view('admin.staffs.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        $departments = Department::all();
        $users = User::all();

        return view('admin.staffs.edit', compact('staff', 'departments','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id|unique:staff,user_id,'.$staff->id,
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'document_id' => 'required|string|max:15',
            'entry_date' => 'required',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|min:11|max:15',
            'department_id' => 'required|exists:departments,id',
            'observations' => 'nullable'
        ]);

        if($data['user_id']!=$staff->user_id)
        {
            $user = User::find($staff->user_id);
            $user->is_vinculed = 0;
            $user->save();
        }

        $user = User::find($data['user_id']);
        $user->is_vinculed = 1;
        $user->save();

        $staff->update($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Modificacion de la ficha tecnica',
            'text' => 'Se ha actualizado con exito'
        ]);

        $departments = Department::all();
        $users = User::all();

        return redirect()->route('admin.staffs.edit', compact('staff','departments', 'users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        try {
            // Intentar eliminar el cliente
            $user = User::find($staff->user_id);
            $user->is_vinculed = 0;
            $user->save();

            $staff->delete();

            session()->flash('swal',[
                'icon' => 'success',
                'title' => 'Eliminación de la ficha tecnica',
                'text' => 'El personal fue eliminadoo con exito'
            ]);

            return redirect()->route('admin.staffs.index');

        } catch (QueryException $e) {
            // Capturar la excepción de la base de datos
            // El código de error '23000' es común para violaciones de integridad de datos (incluidas las claves foráneas)
            if ($e->getCode() == '23000') {

                session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación Fallida',
                    'text' => 'El Personal a eliminar tiene informacion vinculada a ella'
                ]);

            return redirect()->route('admin.staffs.index');
                
            }

             // Para otros errores de base de datos no relacionados con claves foráneas, puedes manejarlos diferente
             session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación de Ficha Tecnica',
                    'text' => 'Ocurrió un error inesperado al intentar eliminar el cliente: ' . $e->getMessage()
                ]);

            return redirect()->route('admin.staffs.index');

        } catch (\Exception $e) {
            // Capturar cualquier otra excepción genérica
            session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación de Ficha Tecnica',
                    'text' => 'Ocurrió un error inesperado: ' . $e->getMessage()
                ]);

            return redirect()->route('admin.staffs.index');
        }
    
    }
}
