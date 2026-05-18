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
        $this->call(RoleSeeder::class);

        // User::factory(10)->create();

        User::create([
            'name' => 'Diomar',
            'email' => 'diomar@gmail.com',
            'password' => bcrypt('123456789')
        ])->assignRole('Admin');

        User::create([
            'name' => 'Jhoaley Cruz',
            'email' => 'JC@gmail.com',
            'password' => bcrypt('123456789')
        ])->assignRole('Coord');

        $this->call(DepartamentSeeder::class);
        $this->call(CategorySeeder::class);

        $staff=Staff::create([
            'name' => 'Diomar Jacinto',
            'last_name' => 'Zerpa Michelangelli',
            'document_id' => '21008127',
            'entry_date' => '2018-01-18',
            'address' => 'Casco Historico',
            'phone' => '04128763362',
            'user_id' => 1,
            'department_id' => 21
        ]);

        $user = User::find($staff->user_id);
        $user->is_vinculed = 1;
        $user->save();

        $staff=Staff::create([
            'name' => 'Jhoaley Alnaldo',
            'last_name' => 'Cruz',
            'document_id' => '15347727',
            'entry_date' => '2016-11-18',
            'address' => 'La Sabanita',
            'phone' => '04128763362',
            'user_id' => 2,
            'department_id' => 21
        ]);

        $user = User::find($staff->user_id);
        $user->is_vinculed = 1;
        $user->save();

        /////////////////////////////////_______________CREACION DE STAFFS______________///////////////////////////////

        // 1. Define cuántos registros de YourModel quieres crear.
        $numberOfModelsToCreate = 20; // Por ejemplo, queremos crear 20

        // 2. Obtener una lista de IDs de usuarios que aún NO están vinculados (is_vinculed = false).
        // Así, nos aseguramos de no vincular al mismo usuario dos veces en esta ejecución,
        // o a usuarios que ya fueron "vinculados" por otro proceso.
        $availableUserIds = User::where('is_vinculed', false)->pluck('id')->toArray();

        // 3. Si no hay suficientes usuarios "no vinculados" para la cantidad de modelos que queremos crear,
        // crea más usuarios nuevos para asegurar que tienes IDs disponibles.
        $neededNewUsers = $numberOfModelsToCreate - count($availableUserIds);
        if ($neededNewUsers > 0) {
            User::factory($neededNewUsers)->create(); // Los nuevos usuarios tendrán is_vinculed = false por defecto.
            // Recargar la lista de IDs disponibles, incluyendo los nuevos
            $availableUserIds = User::where('is_vinculed', false)->pluck('id')->toArray();
        }

        // 4. Mezclar los IDs para que la asignación sea aleatoria y seleccionar solo los que necesitamos.
        shuffle($availableUserIds);
        $selectedUserIds = array_slice($availableUserIds, 0, $numberOfModelsToCreate);

        // 5. Iterar sobre los IDs de usuario seleccionados para crear tus modelos y actualizar los usuarios.
        foreach ($selectedUserIds as $userId) {
            // Crea un registro de YourModel, asignándole el user_id único
            Staff::factory()->create([
                'user_id' => $userId,
                'name' => fake()->name(),
            'last_name' => fake()->name(),
            'document_id' => fake()->unique()->numerify('########'),
            'entry_date' => fake()->dateTimeBetween('2022-01-01', '2025-12-31'),
            'address' => fake()->text(100),
            'phone' => fake()->phoneNumber(),
            'department_id' => Department::all()->random()->id
            ]);

            // **Actualiza el campo is_vinculed a true para el usuario correspondiente**
            User::where('id', $userId)->update(['is_vinculed' => true]);
        }

    ///////////////////////////////////// ____________FIN____________________//////////////////////////////
        
        $this->call(ClassificationSeeder::class);

        $this->call(National_AssetsSeeder::class);

    }
}
