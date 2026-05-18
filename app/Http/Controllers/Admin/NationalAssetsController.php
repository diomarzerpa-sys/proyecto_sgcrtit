<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use App\Models\Department;
use App\Models\NationalAsset;
use Illuminate\Http\Request;

class NationalAssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $national_assets = NationalAsset::orderBy('code','asc')
            ->paginate();

        return view('admin.national_assets.index', compact('national_assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::orderBy('name','asc')
                                    ->get();

        $classifications = Classification::orderBy('name','asc')
                                    ->get();

        return view('admin.national_assets.create', compact('departments', 'classifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|regex:/^[0-9]+$/|size:7|unique:national_assets',
            'serial' => 'nullable|string',
            'typeNA' => 'required|string',
            'classification_id' => 'required|exists:classifications,id',
            'description' =>'nullable',
            'status' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'responsible_for_use' => 'required|string|min:5|max:250',
            'observations' => 'nullable'
        ]);

        $data['responsible_for_use']  = ucwords(strtolower($data['responsible_for_use']));

        NationalAsset::create($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Creacion del Bien Nacional: '.$data['code'],
            'text' => 'Se ha realizado con exito'
        ]);

        return redirect()->route('admin.national_assets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(NationalAsset $nationalAsset)
    {
        return view('admin.national_assets.show', compact('nationalAsset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NationalAsset $nationalAsset)
    {
        $departments = Department::orderBy('name','asc')
                                    ->get();

        $classifications = Classification::orderBy('name','asc')
                                    ->get();

        return view('admin.national_assets.edit', compact('nationalAsset', 'departments', 'classifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NationalAsset $nationalAsset)
    {
        $data = $request->validate([
            'code' => 'required|string|regex:/^[0-9]+$/|size:7|unique:national_assets,code,'.$nationalAsset->id,
            'serial' => 'nullable|string',
            'typeNA' => 'required|string',
            'classification_id' => 'required|exists:classifications,id',
            'description' =>'nullable',
            'status' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'responsible_for_use' => 'required|string|min:5|max:250',
            'observations' => 'nullable'
        ]);

        $data['responsible_for_use']  = ucwords(strtolower($data['responsible_for_use']));

        $nationalAsset->update($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'La Actualizacion del Bien Nacional: '.$data['code'],
            'text' => 'Se ha realizado con exito'
        ]);

        return redirect()->route('admin.national_assets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NationalAsset $nationalAsset)
    {
       //la eliminacion se realiza desde la tabla POWERGRID App/Livewire/NationalAssetsTable
    }
}
