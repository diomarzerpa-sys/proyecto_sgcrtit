<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Department;
use App\Models\Staff;
use App\Models\User;
use Spatie\Permission\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Cargar roles y permisos (Ya protegido con firstOrCreate)
        $this->call(RoleSeeder::class);

        // 2. Crear usuarios administradores usando firstOrCreate para evitar el error 'Duplicate entry'
        $userAdmin = User::firstOrCreate(
            ['email' => 'diomar@gmail.com'], // Condición de búsqueda única
            [
                'name' => 'Diomar',
                'password' => bcrypt('123456789')
            ]
        );
        // Le asignamos el rol solo si no lo tiene asignado ya
        if (!$userAdmin->hasRole('Admin')) {
            $userAdmin->assignRole('Admin');
        }

        $userCoord = User::firstOrCreate(
            ['email' => 'JC@gmail.com'], // Condición de búsqueda única
            [
                'name' => 'Jhoaley Cruz',
                'password' => bcrypt('123456789')
            ]
        );
        if (!$userCoord->hasRole('Coord')) {
            $userCoord->assignRole('Coord');
        }

        // 3. Cargar Departamentos y Categorías estructurales
        $this->call(DepartamentSeeder::class);
        $this->call(CategorySeeder::class);

        // 4. Crear Staff fijo de forma segura
        // Buscamos si ya existe por su documento de identidad
        $staff1 = Staff::firstOrCreate(
            ['document_id' => '21008127'],
            [
                'name' => 'Diomar Jacinto',
                'last_name' => 'Zerpa Michelangelli',
                'entry_date' => '2018-01-18',
                'address' => 'Casco Historico',
                'phone' => '04128763362',
                'user_id' => $userAdmin->id,
                'department_id' => 21
            ]
        );

        $user1 = User::find($staff1->user_id);
        if ($user1 && $user1->is_vinculed != 1) {
            $user1->is_vinculed = 1;
            $user1->save();
        }

        $staff2 = Staff::firstOrCreate(
            ['document_id' => '15347727'],
            [
                'name' => 'Jhoaley Alnaldo',
                'last_name' => 'Cruz',
                'entry_date' => '2016-11-18',
                'address' => 'La Sabanita',
                'phone' => '04128763362',
                'user_id' => $userCoord->id,
                'department_id' => 21
            ]
        );

        $user2 = User::find($staff2->user_id);
        if ($user2 && $user2->is_vinculed != 1) {
            $user2->is_vinculed = 1;
            $user2->save();
        }

        /////////////////////////////////_______________CREACION DE STAFFS DE PRUEBA______________///////////////////////////////

        $numberOfModelsToCreate = 20;

        $availableUserIds = User::where('is_vinculed', false)->pluck('id')->toArray();

        $neededNewUsers = $numberOfModelsToCreate - count($availableUserIds);
        if ($neededNewUsers > 0) {
            User::factory($neededNewUsers)->create();
            $availableUserIds = User::where('is_vinculed', false)->pluck('id')->toArray();
        }

        shuffle($availableUserIds);
        $selectedUserIds = array_slice($availableUserIds, 0, $numberOfModelsToCreate);

        foreach ($selectedUserIds as $userId) {
            Staff::factory()->create([
                'user_id' => $userId,
                'name' => fake()->name(),
                'last_name' => fake()->name(),
                'document_id' => fake()->unique()->numerify('########'),
                'entry_date' => fake()->dateTimeBetween('2022-01-01', '2025-12-31'),
                'address' => fake()->text(100),
                'phone' => fake()->phoneNumber(),
                'department_id' => Department::all()->random()->id ?? 1
            ]);

            User::where('id', $userId)->update(['is_vinculed' => true]);
        }

        ///////////////////////////////////// ____________LLAMADAS FINALES (Aquí están tus clasificaciones)____________________//////////////////////////////
        
        // Al estar todo el archivo blindado contra duplicados, el flujo llegará libremente hasta aquí abajo:
        $this->call(ClassificationSeeder::class);

        $this->call(National_AssetsSeeder::class);
    }
}