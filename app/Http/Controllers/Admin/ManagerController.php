<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Manager;
use App\Models\Staff;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managers = Manager::orderBy('id','asc')
            ->paginate();

        return view('admin.managers.index', compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::orderBy('name','asc')
                                    ->get();

        $staffs = Staff::orderBy('name','asc')
                                    ->get();

        return view('admin.managers.create', compact('departments', 'staffs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'department_id' => 'required|unique:managers|exists:departments,id',
            'staff_id' => 'required|unique:managers|exists:staff,id'
        ]);

        Manager::create($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Asignacion de responsable',
            'text' => 'Se ha asignado con exito'
        ]);

        return redirect()->route('admin.managers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manager $manager)
    {
        $departments = Department::orderBy('name','asc')
                                    ->get();

        $staffs = Staff::orderBy('name','asc')
                                    ->get();

        return view('admin.managers.edit', compact('manager', 'departments', 'staffs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manager $manager)
    {

        $data = $request->validate([
            'department_id' => 'required|exists:departments,id|unique:managers,department_id,'.$manager->id,
            'staff_id' => 'required|exists:staff,id|unique:managers,staff_id,'.$manager->id
        ]);

        $manager->update($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Actualización de responsable',
            'text' => 'Se ha actualizado con exito'
        ]);

        return redirect()->route('admin.managers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manager $manager)
    {
        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Eliminación del responsable con exito',
            'text' => 'El responsable del area '.$manager->department->name.' se ha eliminadoo con exito'
        ]);

        $manager->delete();

        return redirect()->route('admin.managers.index');
    }
}
