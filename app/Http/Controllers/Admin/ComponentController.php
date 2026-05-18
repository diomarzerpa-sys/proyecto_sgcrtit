<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use App\Models\Component;
use App\Models\NationalAsset;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $components = Component::orderBy('code','asc')
            ->paginate();

        return view('admin.components.index', compact('components'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $processors = Classification::where('type', 'processor')->get();
        $harddisks = Classification::where('type', 'hardisk')->get();
        $motherboards = Classification::where('type', 'motherboard')->get();
        $videocards = Classification::where('type', 'video_card')->get();
        $audiocards = Classification::where('type', 'audio_card')->get();

        $sos = Classification::where('type', 'so')->get();
        $ofimatics = Classification::where('type', 'of')->get();
        $navegators = Classification::where('type', 'nv')->get();

        return view('admin.components.create', compact('processors','harddisks','motherboards','videocards','audiocards', 'sos', 'ofimatics','navegators'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|regex:/^[0-9]+$/|size:7|exists:national_assets|unique:components', 
            'motherboard_id' => 'nullable|exists:classifications,id',
            'mac_address' => 'nullable|string',
            'processor_id' => 'nullable|exists:classifications,id',
            'ram' => 'nullable|string',
            'harddisk_id' => 'nullable|exists:classifications,id',
            'video_card_id' => 'nullable|exists:classifications,id',
            'audio_card_id' => 'nullable|exists:classifications,id',
            'sos' => 'nullable|array',
            'sos.*' => 'exists:classifications,id',
            'ofimatics' => 'nullable|array',
            'ofimatics.*' => 'exists:classifications,id',
            'navegators' => 'nullable|array',
            'navegators.*' => 'exists:classifications,id'
        ]);

        $national_asset = NationalAsset::where('code', $data['code'])->select('classification_id')->first();

        // To access the ID:
        $classificationId = $national_asset ? $national_asset->classification_id : null;

         // 2. Consultar la clasificación del bien nacional
        $classification = Classification::find($classificationId);

        // Verificar si la clasificación existe y si su nombre está entre los permitidos
        if (!in_array(strtolower($classification->name), ['laptop', 'servidor', 'cpu'])) {
            // Si no pertenece a las clasificaciones permitidas, redirigir de nuevo a la página de creación
            // y mostrar un mensaje de error.
            return redirect()->back()->withInput($request->all())->with([
                    'swal' => [
                        'icon' => 'error',
                        'title' => 'Error de Clasificación', // Changed title to be more relevant
                        'text' => 'El bien nacional debe estar clasificado como Laptop, Servidor o CPU para ser registrado.'
                    ]
                ]);
        }

        $component = Component::create($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Especificacion realizada con exito',
            'text' => 'El bien nacional '.$data['code'].' fue agregado correctamente'
        ]);

        return redirect()->route('admin.components.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Component $component)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Component $component)
    {
        $data_component = $component;
        $processors = Classification::where('type', 'processor')->get();
        $harddisks = Classification::where('type', 'hardisk')->get();
        $motherboards = Classification::where('type', 'motherboard')->get();
        $videocards = Classification::where('type', 'video_card')->get();
        $audiocards = Classification::where('type', 'audio_card')->get();

        $sos = Classification::where('type', 'so')->get();
        $ofimatics = Classification::where('type', 'of')->get();
        $navegators = Classification::where('type', 'nv')->get();

        return view('admin.components.edit', compact('data_component','processors','harddisks','motherboards','videocards','audiocards', 'sos', 'ofimatics','navegators'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Component $component)
    {
        $data = $request->validate([
            'code' => 'required|string|regex:/^[0-9]+$/|size:7|exists:national_assets|unique:components,code,'.$component->id, 
            'motherboard_id' => 'nullable|exists:classifications,id',
            'mac_address' => 'nullable|string',
            'processor_id' => 'nullable|exists:classifications,id',
            'ram' => 'nullable|string',
            'harddisk_id' => 'nullable|exists:classifications,id',
            'video_card_id' => 'nullable|exists:classifications,id',
            'audio_card_id' => 'nullable|exists:classifications,id',
            'sos' => 'nullable|array',
            'sos.*' => 'exists:classifications,id',
            'ofimatics' => 'nullable|array',
            'ofimatics.*' => 'exists:classifications,id',
            'navegators' => 'nullable|array',
            'navegators.*' => 'exists:classifications,id'
        ]);

        $national_asset = NationalAsset::where('code', $data['code'])->select('classification_id')->first();

        // To access the ID:
        $classificationId = $national_asset ? $national_asset->classification_id : null;

         // 2. Consultar la clasificación del bien nacional
        $classification = Classification::find($classificationId);

        // Verificar si la clasificación existe y si su nombre está entre los permitidos
        if (!in_array(strtolower($classification->name), ['laptop', 'servidor', 'cpu'])) {
            // Si no pertenece a las clasificaciones permitidas, redirigir de nuevo a la página de creación
            // y mostrar un mensaje de error.
            return redirect()->back()->withInput($request->all())->with([
                    'swal' => [
                        'icon' => 'error',
                        'title' => 'Error de Clasificación', // Changed title to be more relevant
                        'text' => 'El bien nacional debe estar clasificado como Laptop, Servidor o CPU para ser registrado.'
                    ]
                ]);
        }

        $component->update($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Especificacion realizada con exito',
            'text' => 'El bien nacional '.$data['code'].' fue actualizado correctamente'
        ]);

        return redirect()->route('admin.components.index');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Component $component)
    {
        //ELMINACION SE REALIZA EN EL CONTROLADOR DE LA TABLA POWERGRID: COMPONENTV2TABLE
    }
}
