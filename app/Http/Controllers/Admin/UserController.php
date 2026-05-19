<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Staff;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name','asc')
            ->paginate();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3| max:250',
            'email' => 'required|string|lowercase|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Se añadió 'min:8' y 'confirmed'
            'password_confirmation' => 'required|string', // Se cambió de 'confirm-password'
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Creación de usuario: ' . $data['name']. ' asociado al correo '. $data['email'],
            'text' => 'Se ha realizado con éxito'
        ]);

        // Redirige a la vista de índice con los memos actualizados
        return redirect()->route('admin.users.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
{
    $rules = [
        'name' => 'required|string|min:3|max:250',
        'email' => 'required|string|lowercase|email|max:255|unique:users,email,' . $user->id,
        'roles' => 'required|exists:roles,id', 
    ];

    // Lógica condicional para la contraseña
    if ($request->filled('password') || $request->filled('password_confirmation')) {
        $rules['password'] = 'required|string|min:8|confirmed';
        $rules['password_confirmation'] = 'required|string';
    }

    $validatedData = $request->validate($rules); 

    // Actualizar los datos del usuario
    $user->name = $validatedData['name']; 
    $user->email = $validatedData['email']; 

    // Solo actualizamos la contraseña si fue validada y está presente
    if (isset($validatedData['password'])) { 
        // Usamos Hash::make (vía la función/helper de Laravel) que es el estándar moderno
        $user->password = transform($validatedData['password'], fn ($p) => bcrypt($p)); 
    }

    $user->save();

    // --- CORRECCIÓN AQUÍ ---
    // Envolvemos el ID del rol único en un array [] para que sync() no falle
    $user->roles()->sync([$validatedData['roles']]);
    // -----------------------

    session()->flash('swal', [
        'icon' => 'success',
        'title' => 'El usuario: ' . $user->name . ' asociado al correo ' . $user->email,
        'text' => 'Fue actualizado con éxito'
    ]);

    return redirect()->route('admin.users.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            // Intentar eliminar el cliente
            $user->delete();

            session()->flash('swal',[
                'icon' => 'success',
                'title' => 'Eliminación del usuario',
                'text' => 'Se ha eliminadoo con exito'
            ]);

            return redirect()->route('admin.users.index');

        } catch (QueryException $e) {
            // Capturar la excepción de la base de datos
            // El código de error '23000' es común para violaciones de integridad de datos (incluidas las claves foráneas)
            if ($e->getCode() == '23000') {

                session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación del usuario fallida',
                    'text' => 'Tiene elementos asociados a ella y no se puede eliminar'
                ]);

            return redirect()->route('admin.users.index');
                
            }

             // Para otros errores de base de datos no relacionados con claves foráneas, puedes manejarlos diferente
             session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación de usuario fallida',
                    'text' => 'Ocurrió un error inesperado al intentar eliminar el usuario: ' . $e->getMessage()
                ]);

            return redirect()->route('admin.users.index');

        } catch (\Exception $e) {
            // Capturar cualquier otra excepción genérica
            session()->flash('swal',[
                    'icon' => 'error',
                    'title' => 'Eliminación de usuario fallida',
                    'text' => 'Ocurrió un error inesperado: ' . $e->getMessage()
                ]);

                return redirect()->route('admin.users.index');
        }

    }
}
