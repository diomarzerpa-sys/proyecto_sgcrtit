<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Livewire\Volt\Volt;

// ==========================================
// 1. RUTAS PÚBLICAS Y DE INFRAESTRUCTURA (ZONA SEGURA)
// ==========================================

Route::redirect('/', 'login')->name('home');

Route::get('/inicializar-sistema-bienes', function () {
    set_time_limit(60);

    // Array de datos incrustado directamente para evitar fallos de autoloading en Render
    $allDatas = [
        [ 'code' => '0096140', 'serial' => 'NO TIENE', 'typeNA' => 'Mobiliario', 'classification_id' => 1, 'status' => 'Optimo', 'description' => 'MATERIAL: MADERA COLOR: MARRON', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '111487', 'serial' => 'A000909161', 'typeNA' => 'Tecnologico', 'classification_id' => 22, 'status' => 'Optimo', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'YENNIFER RODRIGUEZ', 'observations' => ''],
        [ 'code' => '0057919', 'serial' => 'B26CCBA001151', 'typeNA' => 'Tecnologico', 'classification_id' => 23, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'YENNIFER RODRIGUEZ', 'observations' => ''],
        [ 'code' => '0096112', 'serial' => 'KB0205K14397A', 'typeNA' => 'Tecnologico', 'classification_id' => 24, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'YENNIFER RODRIGUEZ', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => 'MSC228K17284A', 'typeNA' => 'Tecnologico', 'classification_id' => 25, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'YENNIFER RODRIGUEZ', 'observations' => ''],
        [ 'code' => '0063904', 'serial' => '05051-1226883', 'typeNA' => 'Tecnologico', 'classification_id' => 26, 'status' => 'Optimo', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'YENNIFER RODRIGUEZ', 'observations' => ''],
        [ 'code' => '0063533', 'serial' => '5827700040', 'typeNA' => 'Tecnologico', 'classification_id' => 74, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'YENNIFER RODRIGUEZ', 'observations' => ''],
        [ 'code' => '0040902', 'serial' => 'A000909098', 'typeNA' => 'Tecnologico', 'classification_id' => 22, 'status' => 'Optimo', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'DIOMAR ZERPA', 'observations' => ''],
        [ 'code' => '0040854', 'serial' => 'D73EBBA000569', 'typeNA' => 'Tecnologico', 'classification_id' => 28, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'DIOMAR ZERPA', 'observations' => ''],
        [ 'code' => '0040861', 'serial' => 'D73EBBA000553', 'typeNA' => 'Tecnologico', 'classification_id' => 28, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'DIOMAR ZERPA', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => 'KBDD02K10555A', 'typeNA' => 'Tecnologico', 'classification_id' => 24, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'DIOMAR ZERPA', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => 'MSE901K11305A', 'typeNA' => 'Tecnologico', 'classification_id' => 25, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'DIOMAR ZERPA', 'observations' => ''],
        [ 'code' => '0084720', 'serial' => '05051-1227921', 'typeNA' => 'Tecnologico', 'classification_id' => 26, 'status' => 'Optimo', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'DIOMAR ZERPA', 'observations' => ''],
        [ 'code' => '0040913', 'serial' => 'A000909105', 'typeNA' => 'Tecnologico', 'classification_id' => 22, 'status' => 'Optimo', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '111453', 'serial' => 'D73EBBA000448', 'typeNA' => 'Tecnologico', 'classification_id' => 28, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0040849', 'serial' => 'D73EBBA000913', 'typeNA' => 'Tecnologico', 'classification_id' => 28, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0084970', 'serial' => 'C0507125473', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => 'MSD925K11055A', 'typeNA' => 'Tecnologico', 'classification_id' => 25, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0063530', 'serial' => '080811-12905166', 'typeNA' => 'Tecnologico', 'classification_id' => 27, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => '04113311000064DNN', 'typeNA' => 'Tecnologico', 'classification_id' => 30, 'status' => 'Optimo', 'description' => 'MATERIAL: METAL COLOR: GRIS', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0040900', 'serial' => 'A000923988', 'typeNA' => 'Tecnologico', 'classification_id' => 22, 'status' => 'Optimo', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0040850', 'serial' => 'D73EBBA000105', 'typeNA' => 'Tecnologico', 'classification_id' => 28, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => 'KBE915K11814A', 'typeNA' => 'Tecnologico', 'classification_id' => 24, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => 'MSE822K10366A', 'typeNA' => 'Tecnologico', 'classification_id' => 25, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0018570', 'serial' => '2077001016459', 'typeNA' => 'Tecnologico', 'classification_id' => 31, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0064925', 'serial' => 'ZF631A038327', 'typeNA' => 'Tecnologico', 'classification_id' => 32, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: Gris y Negro', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0076120', 'serial' => '070670PJ0175', 'typeNA' => 'Tecnologico', 'classification_id' => 33, 'status' => 'Optimo', 'description' => 'MATERIAL: METAL COLOR: GRIS', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0044588', 'serial' => '207NDZJ2Y853', 'typeNA' => 'Tecnologico', 'classification_id' => 34, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0064750', 'serial' => 'C0506086641', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => 'LZ824AP009H', 'typeNA' => 'Tecnologico', 'classification_id' => 35, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: GRIS', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0084907', 'serial' => '05041-1223252', 'typeNA' => 'Tecnologico', 'classification_id' => 26, 'status' => 'Optimo', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0061128', 'serial' => 'VMASS4699', 'typeNA' => 'Tecnologico', 'classification_id' => 36, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: BLANCO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0064920', 'serial' => '2006090025', 'typeNA' => 'Tecnologico', 'classification_id' => 37, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO Y METAL COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0063405', 'serial' => '05041-1224377', 'typeNA' => 'Tecnologico', 'classification_id' => 26, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0018579', 'serial' => '212077001016453', 'typeNA' => 'Tecnologico', 'classification_id' => 31, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0018599', 'serial' => '212077001016490', 'typeNA' => 'Tecnologico', 'classification_id' => 31, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0018578', 'serial' => '212077001016491', 'typeNA' => 'Tecnologico', 'classification_id' => 31, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0018603', 'serial' => '212077001016936', 'typeNA' => 'Tecnologico', 'classification_id' => 31, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0018575', 'serial' => '212077001016954', 'typeNA' => 'Tecnologico', 'classification_id' => 31, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0018601', 'serial' => '212077001016438', 'typeNA' => 'Tecnologico', 'classification_id' => 31, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0018604', 'serial' => '212077001016435', 'typeNA' => 'Tecnologico', 'classification_id' => 31, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0018607', 'serial' => '212077001016432', 'typeNA' => 'Tecnologico', 'classification_id' => 31, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0084958', 'serial' => 'C050686301', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0063287', 'serial' => 'C0507125537', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0063295', 'serial' => 'C0507123043', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0063848', 'serial' => 'C0507125266', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0063275', 'serial' => 'C0507125268', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0063267', 'serial' => 'C0507122228', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0063263', 'serial' => 'C0507125524', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0063283', 'serial' => 'C0507124374', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0063291', 'serial' => 'C05006086609', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => 'NO TIENE', 'serial' => 'M57623C12046', 'typeNA' => 'Tecnologico', 'classification_id' => 38, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => 'NO TIENE', 'serial' => 'LZ822AP03J3', 'typeNA' => 'Tecnologico', 'classification_id' => 38, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0076191', 'serial' => 'NO TIENE', 'typeNA' => 'Tecnologico', 'classification_id' => 39, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0040863', 'serial' => 'D73EBBA000558', 'typeNA' => 'Tecnologico', 'classification_id' => 28, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0084625', 'serial' => 'NO TIENE', 'typeNA' => 'Tecnologico', 'classification_id' => 40, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0064161', 'serial' => 'LD67194C1310716', 'typeNA' => 'Tecnologico', 'classification_id' => 41, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0064157', 'serial' => 'LD67194C1311294', 'typeNA' => 'Tecnologico', 'classification_id' => 41, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0064140', 'serial' => 'LD67204C1320933', 'typeNA' => 'Tecnologico', 'classification_id' => 41, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0064165', 'serial' => 'LD67194C1311902', 'typeNA' => 'Tecnologico', 'classification_id' => 41, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0064203', 'serial' => 'LD67204C1320948', 'typeNA' => 'Tecnologico', 'classification_id' => 41, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0064186', 'serial' => 'LD67204C1321548', 'typeNA' => 'Tecnologico', 'classification_id' => 41, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0064197', 'serial' => 'LD67204C1321541', 'typeNA' => 'Tecnologico', 'classification_id' => 41, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => 'NO TIENE', 'serial' => 'SSRP835', 'typeNA' => 'Tecnologico', 'classification_id' => 42, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => 'NO TIENE', 'serial' => 'SSRP019', 'typeNA' => 'Tecnologico', 'classification_id' => 42, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => 'NO TIENE', 'serial' => 'CNCS010CS', 'typeNA' => 'Tecnologico', 'classification_id' => 43, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => 'NO TIENE', 'serial' => 'CNCS010148', 'typeNA' => 'Tecnologico', 'classification_id' => 43, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => 'NO TIENE', 'serial' => 'CNC4520QGM', 'typeNA' => 'Tecnologico', 'classification_id' => 43, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => 'NO TIENE', 'serial' => 'CNC4520QGS', 'typeNA' => 'Tecnologico', 'classification_id' => 43, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0044537', 'serial' => 'CNC5170HYM', 'typeNA' => 'Tecnologico', 'classification_id' => 43, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0064193', 'serial' => 'LD67194C1320889', 'typeNA' => 'Tecnologico', 'classification_id' => 41, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0064206', 'serial' => 'LD67194C134894', 'typeNA' => 'Tecnologico', 'classification_id' => 41, 'status' => 'Averiado', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0096120', 'serial' => 'BBAVLOMGA15BY', 'typeNA' => 'Tecnologico', 'classification_id' => 44, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0062852', 'serial' => 'C0507122334', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0064910', 'serial' => 'KB7608B10203A', 'typeNA' => 'Tecnologico', 'classification_id' => 45, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0045638', 'serial' => 'KB7608B11814A', 'typeNA' => 'Tecnologico', 'classification_id' => 45, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0084133', 'serial' => 'C0507124375', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0045440', 'serial' => 'KB7608B12038A', 'typeNA' => 'Tecnologico', 'classification_id' => 45, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0084012', 'serial' => 'C0507125214', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0084954', 'serial' => 'C0506086347', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0045636', 'serial' => 'KB7608B12159A', 'typeNA' => 'Tecnologico', 'classification_id' => 45, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0045319', 'serial' => 'KB7608B11022A', 'typeNA' => 'Tecnologico', 'classification_id' => 45, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0062838', 'serial' => 'KB7608B10225A', 'typeNA' => 'Tecnologico', 'classification_id' => 45, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0045802', 'serial' => 'KB7608B12363A', 'typeNA' => 'Tecnologico', 'classification_id' => 45, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0044762', 'serial' => 'KBAB16Q46131A', 'typeNA' => 'Tecnologico', 'classification_id' => 46, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => 'NO TIENE', 'serial' => 'KB0519Q41932A', 'typeNA' => 'Tecnologico', 'classification_id' => 46, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0043445', 'serial' => 'C0507124415', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0063460', 'serial' => 'KBXJ08005', 'typeNA' => 'Tecnologico', 'classification_id' => 47, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0064706', 'serial' => 'C0507122334', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0095974', 'serial' => 'KBA919Q46093A', 'typeNA' => 'Tecnologico', 'classification_id' => 46, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0043350', 'serial' => 'C057126329', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0045714', 'serial' => 'KB7608B11957A', 'typeNA' => 'Tecnologico', 'classification_id' => 45, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0045532', 'serial' => 'KB7608B112055A', 'typeNA' => 'Tecnologico', 'classification_id' => 45, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0084930', 'serial' => 'C0507124130', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0084916', 'serial' => 'C0507122407', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'NINGUNA'],
        [ 'code' => '0064931', 'serial' => '80700248', 'typeNA' => 'Tecnologico', 'classification_id' => 48, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO CON GRIS', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0064249', 'serial' => 'NO TIENE', 'typeNA' => 'Tecnologico', 'classification_id' => 52, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO CON GRIS', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0064096', 'serial' => 'NO TIENE', 'typeNA' => 'Tecnologico', 'classification_id' => 52, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO CON GRIS', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0064720', 'serial' => 'KB8824Q1525A', 'typeNA' => 'Tecnologico', 'classification_id' => 46, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'CAJA 4'],
        [ 'code' => '0095766', 'serial' => 'KBAB16Q76028A', 'typeNA' => 'Tecnologico', 'classification_id' => 46, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'CAJA 4'],
        [ 'code' => '0064931', 'serial' => '8070090', 'typeNA' => 'Tecnologico', 'classification_id' => 46, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO CON GRIS', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'CAJA 4'],
        [ 'code' => 'NO TIENE', 'serial' => 'KBAB16044719A', 'typeNA' => 'Tecnologico', 'classification_id' => 46, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'CAJA 4'],
        [ 'code' => 'NO TIENE', 'serial' => 'KB060900', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'CAJA 1'],
        [ 'code' => '0083881', 'serial' => 'NO TIENE', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'CAJA 1'],
        [ 'code' => '0064949', 'serial' => '80700395', 'typeNA' => 'Tecnologico', 'classification_id' => 48, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0064311', 'serial' => 'NO TIENE', 'typeNA' => 'Tecnologico', 'classification_id' => 52, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'CAJA 5'],
        [ 'code' => '0084276', 'serial' => 'NO TIENE', 'typeNA' => 'Tecnologico', 'classification_id' => 52, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => 'CAJA 5'],
        [ 'code' => 'NO TIENE', 'serial' => 'BE01678', 'typeNA' => 'Tecnologico', 'classification_id' => 62, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: GRIS Y NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0043186', 'serial' => 'BE01359', 'typeNA' => 'Tecnologico', 'classification_id' => 62, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: GRIS Y NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0043190', 'serial' => 'BE01462', 'typeNA' => 'Tecnologico', 'classification_id' => 62, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: GRIS Y NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => 'BE01297', 'typeNA' => 'Tecnologico', 'classification_id' => 62, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: GRIS Y NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => 'BE01945', 'typeNA' => 'Tecnologico', 'classification_id' => 62, 'status' => 'Optimo', 'description' => 'MATERIAL: PLASTICO COLOR: GRIS Y NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0084545', 'serial' => '1222265', 'typeNA' => 'Tecnologico', 'classification_id' => 26, 'status' => 'Regular', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0084789', 'serial' => '1222314', 'typeNA' => 'Tecnologico', 'classification_id' => 26, 'status' => 'Regular', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0084553', 'serial' => '1215905', 'typeNA' => 'Tecnologico', 'classification_id' => 74, 'status' => 'Regular', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0064714', 'serial' => 'NO TIENE', 'typeNA' => 'Tecnologico', 'classification_id' => 75, 'status' => 'Regular', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0064754', 'serial' => 'NO TIENE', 'typeNA' => 'Tecnologico', 'classification_id' => 75, 'status' => 'Regular', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0063529', 'serial' => 'NO TIENE', 'typeNA' => 'Tecnologico', 'classification_id' => 75, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0063521', 'serial' => '12906691', 'typeNA' => 'Tecnologico', 'classification_id' => 27, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0064214', 'serial' => '71302258', 'typeNA' => 'Tecnologico', 'classification_id' => 76, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0063523', 'serial' => '1205162', 'typeNA' => 'Tecnologico', 'classification_id' => 27, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => '71300366', 'typeNA' => 'Tecnologico', 'classification_id' => 76, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0064879', 'serial' => '071302550', 'typeNA' => 'Tecnologico', 'classification_id' => 76, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0063535', 'serial' => 'NO TIENE', 'typeNA' => 'Tecnologico', 'classification_id' => 27, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0064872', 'serial' => '071302576', 'typeNA' => 'Tecnologico', 'classification_id' => 76, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0064880', 'serial' => 'NO TIENE', 'typeNA' => 'Tecnologico', 'classification_id' => 76, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0064873', 'serial' => '071302294', 'typeNA' => 'Tecnologico', 'classification_id' => 76, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0064920', 'serial' => '2006090025', 'typeNA' => 'Tecnologico', 'classification_id' => 77, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0063005', 'serial' => '050411224377', 'typeNA' => 'Tecnologico', 'classification_id' => 26, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0018576', 'serial' => '212077001016453', 'typeNA' => 'Tecnologico', 'classification_id' => 31, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0018599', 'serial' => '212077001016440', 'typeNA' => 'Tecnologico', 'classification_id' => 31, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0018578', 'serial' => '212077001016451', 'typeNA' => 'Tecnologico', 'classification_id' => 31, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0064855', 'serial' => '071301785', 'typeNA' => 'Tecnologico', 'classification_id' => 76, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0064866', 'serial' => '071300454', 'typeNA' => 'Tecnologico', 'classification_id' => 76, 'status' => 'Regular', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'POR ASIGNAR', 'observations' => ''],
        [ 'code' => '0084056', 'serial' => 'NO TIENE', 'typeNA' => 'Mobiliario', 'classification_id' => 5, 'status' => 'No Operativo', 'description' => 'MATERIAL: METAL COLOR: MARRON', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => 'FALTA UNA MANILLA EN GAVETA'],
        [ 'code' => '0084059', 'serial' => 'NO TIENE', 'typeNA' => 'Mobiliario', 'classification_id' => 10, 'status' => 'Optimo', 'description' => 'MATERIAL: CUERO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0084977', 'serial' => 'NO TIENE', 'typeNA' => 'Mobiliario', 'classification_id' => 13, 'status' => 'Optimo', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0085263', 'serial' => 'NO TIENE', 'typeNA' => 'Mobiliario', 'classification_id' => 7, 'status' => 'Optimo', 'description' => 'MATERIAL: METAL Y VIDRIO COLOR: NEGRO', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0096114', 'serial' => 'NO TIENE', 'typeNA' => 'Mobiliario', 'classification_id' => 21, 'status' => 'Optimo', 'description' => 'MATERIAL: MADERA', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => '0096115', 'serial' => 'NO TIENE', 'typeNA' => 'Mobiliario', 'classification_id' => 11, 'status' => 'Optimo', 'description' => 'MATERIAL: MADERA', 'department_id' => '21', 'responsible_for_use' => 'JHOALEY CRUZ', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => 'MS7623CL0893A', 'typeNA' => 'Tecnologico', 'classification_id' => 25, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '15', 'responsible_for_use' => 'IGOR ARAYA', 'observations' => 'PANTALLA DETERIORADA'],
        [ 'code' => '0076083', 'serial' => '076070ZZ0733', 'typeNA' => 'Tecnologico', 'classification_id' => 33, 'status' => 'OPTIMO', 'description' => 'MATERIAL: METAL COLOR: GRIS', 'department_id' => '15', 'responsible_for_use' => 'IGOR ARAYA', 'observations' => ''],
        [ 'code' => '0083351', 'serial' => 'C0507124372', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '15', 'responsible_for_use' => 'IGOR ARAYA', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => '80700412', 'typeNA' => 'Tecnologico', 'classification_id' => 133, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '39', 'responsible_for_use' => 'Dra. Iliana Hernandez', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => 'MSAB22Q14333A', 'typeNA' => 'Tecnologico', 'classification_id' => 121, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '39', 'responsible_for_use' => 'Dra. Iliana Hernandez', 'observations' => ''],
        [ 'code' => '0043883', 'serial' => '120301-040001331', 'typeNA' => 'Tecnologico', 'classification_id' => 27, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '39', 'responsible_for_use' => 'Dra. Iliana Hernandez', 'observations' => ''],
        [ 'code' => '0062049', 'serial' => 'A000418470', 'typeNA' => 'Tecnologico', 'classification_id' => 99, 'status' => 'OPTIMO', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '1', 'responsible_for_use' => 'PLANIFICACIÓN', 'observations' => ''],
        [ 'code' => '0043111', 'serial' => 'KBC712K11670A', 'typeNA' => 'Tecnologico', 'classification_id' => 24, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '1', 'responsible_for_use' => 'PLANIFICACIÓN', 'observations' => ''],
        [ 'code' => '0013190', 'serial' => 'MS723C10333A', 'typeNA' => 'Tecnologico', 'classification_id' => 123, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '1', 'responsible_for_use' => 'PLANIFICACIÓN', 'observations' => ''],
        [ 'code' => '0045362', 'serial' => '05041-1220151', 'typeNA' => 'Tecnologico', 'classification_id' => 26, 'status' => 'OPTIMO', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '1', 'responsible_for_use' => 'PLANIFICACIÓN', 'observations' => ''],
        [ 'code' => '0076176', 'serial' => 'HM010807120429', 'typeNA' => 'Tecnologico', 'classification_id' => 109, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: GRIS', 'department_id' => '1', 'responsible_for_use' => 'Profesores', 'observations' => ''],
        [ 'code' => '0076120', 'serial' => '070670PJ0175', 'typeNA' => 'Tecnologico', 'classification_id' => 33, 'status' => 'OPTIMO', 'description' => 'MATERIAL: METAL COLOR: GRIS', 'department_id' => '1', 'responsible_for_use' => 'Profesores', 'observations' => ''],
        [ 'code' => '0064954', 'serial' => '80700621', 'typeNA' => 'Tecnologico', 'classification_id' => 48, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: GRIS', 'department_id' => '1', 'responsible_for_use' => 'Profesores', 'observations' => ''],
        [ 'code' => 'NO TIENE', 'serial' => 'P0508017915', 'typeNA' => 'Tecnologico', 'classification_id' => 56, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '1', 'responsible_for_use' => 'Profesores', 'observations' => ''],
        [ 'code' => '0013091', 'serial' => '05051-1226881', 'typeNA' => 'Tecnologico', 'classification_id' => 26, 'status' => 'OPTIMO', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '1', 'responsible_for_use' => 'Profesores', 'observations' => ''],
        [ 'code' => '111455', 'serial' => 'D73EBBA000402', 'typeNA' => 'Tecnologico', 'classification_id' => 28, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '16', 'responsible_for_use' => 'NEVERLY ', 'observations' => ''],
        [ 'code' => '0023718', 'serial' => 'MXD53806ZF', 'typeNA' => 'Tecnologico', 'classification_id' => 94, 'status' => 'OPTIMO', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '16', 'responsible_for_use' => 'NEVERLY ', 'observations' => ''],
        [ 'code' => '0064578', 'serial' => 'C0507122377', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '16', 'responsible_for_use' => 'NEVERLY ', 'observations' => ''],
        [ 'code' => '0013385', 'serial' => '380022000378', 'typeNA' => 'Tecnologico', 'classification_id' => 67, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '16', 'responsible_for_use' => 'NEVERLY ', 'observations' => ''],
        [ 'code' => '0084525', 'serial' => '05041-1220714', 'typeNA' => 'Tecnologico', 'classification_id' => 26, 'status' => 'OPTIMO', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '16', 'responsible_for_use' => 'NEVERLY ', 'observations' => ''],
        [ 'code' => '0057932', 'serial' => 'B26CCBA001132', 'typeNA' => 'Tecnologico', 'classification_id' => 23, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '16', 'responsible_for_use' => 'ANA MEJIAS', 'observations' => ''],
        [ 'code' => '0076106', 'serial' => '070670GE6642', 'typeNA' => 'Tecnologico', 'classification_id' => 33, 'status' => 'OPTIMO', 'description' => 'MATERIAL: METAL COLOR: GRIS', 'department_id' => '16', 'responsible_for_use' => 'ANA MEJIAS', 'observations' => ''],
        [ 'code' => '0083922', 'serial' => 'C0500712298', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '16', 'responsible_for_use' => 'ANA MEJIAS', 'observations' => ''],
        [ 'code' => '0013386', 'serial' => 'MSC715K13383A', 'typeNA' => 'Tecnologico', 'classification_id' => 25, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '16', 'responsible_for_use' => 'ANA MEJIAS', 'observations' => ''],
        [ 'code' => '0018572', 'serial' => '212077001016457', 'typeNA' => 'Tecnologico', 'classification_id' => 126, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '16', 'responsible_for_use' => 'ANA MEJIAS', 'observations' => ''],
        [ 'code' => '111451', 'serial' => 'D73EBBA00044', 'typeNA' => 'Tecnologico', 'classification_id' => 94, 'status' => 'OPTIMO', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '26', 'responsible_for_use' => 'Sr. Emiro Martinez', 'observations' => ''],
        [ 'code' => '0043164', 'serial' => 'MXD538077N', 'typeNA' => 'Tecnologico', 'classification_id' => 94, 'status' => 'DETERIORADO', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '26', 'responsible_for_use' => 'Sr. Emiro Martinez', 'observations' => ''],
        [ 'code' => '0074719', 'serial' => 'A59C6BA018999', 'typeNA' => 'Tecnologico', 'classification_id' => 111, 'status' => 'OPTIMO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '26', 'responsible_for_use' => 'Sr. Emiro Martinez', 'observations' => ''],
        [ 'code' => '0084942', 'serial' => 'MXD53807JL', 'typeNA' => 'Tecnologico', 'classification_id' => 94, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0064198', 'serial' => 'LD67204C1220896', 'typeNA' => 'Tecnologico', 'classification_id' => 41, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: PLASTICO COLOR: GRIS', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0063716', 'serial' => 'CD507122623', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0096572', 'serial' => 'PC508010000', 'typeNA' => 'Tecnologico', 'classification_id' => 56, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0063901', 'serial' => '5051-122568', 'typeNA' => 'Tecnologico', 'classification_id' => 26, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0024020', 'serial' => 'MXD6160629', 'typeNA' => 'Tecnologico', 'classification_id' => 94, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0064165', 'serial' => 'LD67194C1311902', 'typeNA' => 'Tecnologico', 'classification_id' => 41, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: PLASTICO COLOR: GRIS', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0082542', 'serial' => 'CD50712226', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0096617', 'serial' => 'P0512029601', 'typeNA' => 'Tecnologico', 'classification_id' => 56, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0063257', 'serial' => 'MXD53806XX', 'typeNA' => 'Tecnologico', 'classification_id' => 94, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0064169', 'serial' => 'LD672O4C1320938', 'typeNA' => 'Tecnologico', 'classification_id' => 41, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: PLASTICO COLOR: GRIS', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0082904', 'serial' => 'CD507133382', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0096718', 'serial' => 'P0507005329', 'typeNA' => 'Tecnologico', 'classification_id' => 56, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0084319', 'serial' => '0541-1224998', 'typeNA' => 'Tecnologico', 'classification_id' => 26, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0021353', 'serial' => 'MXD53806', 'typeNA' => 'Tecnologico', 'classification_id' => 94, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: METAL COLOR: NEGRO', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0064170', 'serial' => 'LD67194C1311308', 'typeNA' => 'Tecnologico', 'classification_id' => 41, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: PLASTICO COLOR: GRIS', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => ''],
        [ 'code' => '0063263', 'serial' => 'CD507125524', 'typeNA' => 'Tecnologico', 'classification_id' => 29, 'status' => 'OPERATIVO', 'description' => 'MATERIAL: PLASTICO COLOR: NEGRO', 'department_id' => '43', 'responsible_for_use' => 'Arnaldo Gutiérrez ', 'observations' => '']
    ];

    $totalRegistros = count($allDatas);
    $offset = request('offset', 0);
    $limit = 20;
    
    $loteActual = array_slice($allDatas, $offset, $limit);

    if (empty($loteActual)) {
        return response()->json([
            'status' => 'success',
            'message' => "¡Proceso finalizado con éxito! Se inyectaron un total de $totalRegistros registros de Bienes Nacionales en producción."
        ]);
    }

    $controlA = session('seeder_control_A', 1);
    $controlB = session('seeder_control_B', 1);
    $seedcontrol = session('seeder_seedcontrol', []);

    foreach ($loteActual as $data) {
        if ($data['code'] == 'NO TIENE') {
            $data['code'] = 'Sin_Bien_' . $controlA;
            App\Models\NationalAsset::create($data);
            $controlA++;
        } else {
            if (in_array($data['code'], $seedcontrol)) {
                $data['observations'] = $data['observations'] . ' //Fue registrado con un bien duplicado, SINCERAR, antiguo bien: ' . $data['code'];
                $data['code'] = 'Duplicate_' . $controlB;
                App\Models\NationalAsset::create($data);
                $controlB++;
            } else {
                $seedcontrol[] = $data['code'];
                App\Models\NationalAsset::create($data);
            }
        }
    }

    session(['seeder_control_A' => $controlA]);
    session(['seeder_control_B' => $controlB]);
    session(['seeder_seedcontrol' => $seedcontrol]);

    $siguienteOffset = $offset + $limit;
    $porcentaje = min(100, round(($siguienteOffset / $totalRegistros) * 100));
    $siguienteUrl = url("/inicializar-sistema-bienes?offset={$siguienteOffset}");
    
    return response("
        <html>
        <head>
            <meta http-equiv='refresh' content='1;url={$siguienteUrl}'>
            <style>
                body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f4f6f9; margin: 0; }
                .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; max-width: 400px; width: 100%; }
                .progress-bar { background: #e0e0e0; border-radius: 4px; height: 20px; width: 100%; margin-top: 15px; overflow: hidden; }
                .progress { background: #2563eb; height: 100%; width: {$porcentaje}%; transition: width 0.3s; }
            </style>
        </head>
        <body>
            <div class='card'>
                <h2 style='color: #1e3a8a;'>Poblando Bienes Nacionales</h2>
                <p>Insertados registros del <b>{$offset}</b> al <b>" . min($totalRegistros, $siguienteOffset) . "</b> de {$totalRegistros}</p>
                <div class='progress-bar'><div class='progress'></div></div>
                <p style='color: #666; font-size: 13px; margin-top: 15px;'>Procesando lote de datos de manera segura...</p>
            </div>
        </body>
        </html>
    ");
});


// ==========================================
// 2. RUTAS PROTEGIDAS Y DE AUTENTICACIÓN
// ==========================================

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';