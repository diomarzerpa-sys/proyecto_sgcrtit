<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\NationalAsset;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Obtener la información del personal vinculada al usuario
        $loggedInStaff = Staff::where('user_id', $user->id)->first();
        $departmentId = $loggedInStaff ? $loggedInStaff->department_id : null;

        // Inicializar los contadores
        $personalCount = 0;
        $totalBienesNacionales = 0;
        $duplicateBienesCount = 0;
        $sinBienBienesCount = 0;

        // Contar el personal del departamento del usuario actual
        // Esto solo se ejecuta si el usuario tiene un departamento asignado
        if ($departmentId) {
            $personalCount = Staff::where('department_id', $departmentId)->count();
        }

        // --- Lógica de permisos para los conteos de bienes ---

        // Si el usuario es un 'Admin', se realizan los conteos de forma global.
        if ($user->hasRole('Admin')) {
            $totalBienesNacionales = NationalAsset::count();
            $duplicateBienesCount = NationalAsset::where('code', 'like', 'Duplicate_%')->count();
            $sinBienBienesCount = NationalAsset::where('code', 'like', 'Sin_Bien_%')->count();
        } 
        // Si el usuario no es 'Admin' y tiene un departamento asignado,
        // se realizan los conteos filtrando por el departamento.
        elseif ($departmentId) {
            $totalBienesNacionales = NationalAsset::where('department_id', $departmentId)->count();
            $duplicateBienesCount = NationalAsset::where('department_id', $departmentId)
                                                ->where('code', 'like', 'Duplicate_%')
                                                ->count();
            $sinBienBienesCount = NationalAsset::where('department_id', $departmentId)
                                              ->where('code', 'like', 'Sin_Bien_%')
                                              ->count();
        }
        // Si el usuario no es 'Admin' y no tiene departamento, las variables permanecen en 0.

        // Pasar los datos a la vista
        return view('dashboard', compact(
            'personalCount',
            'totalBienesNacionales',
            'duplicateBienesCount',
            'sinBienBienesCount'
        ));
    }
}
