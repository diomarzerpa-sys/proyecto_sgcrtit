<?php

namespace Database\Seeders;

use App\Models\Classification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Opcional: Descomenta la siguiente línea si deseas vaciar la tabla antes de sembrar
        // Classification::truncate();

        // --- Datos de ClassificationSeeder.php original (Mobiliario y Tecnologico) ---
        $mainData = [
            ['type' => 'Mobiliario', 'name' => 'Escritorio', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Mesa Computadora', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Silla Ergonomica', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Mesa Pupitre', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Archivo 4 Gavetas', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Silla con posa brazo', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Armario', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Cornetas', 'brand' => 'Delux', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Meson de Reuniones', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Silla de Meson', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Silla', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Armario para Servidores', 'brand' => 'LINKBASIG', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Estante Patch Panel', 'brand' => 'HUBBELL', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Estante', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Silla de Oficina', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Meson de Soporte', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Escalera', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Mesa de Soportes', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Mesa Escritorio Soporte', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Filtro De Agua', 'brand' => 'General E', 'model' => 'S/M'],
            ['type' => 'Mobiliario', 'name' => 'Pizarra Acrilica', 'brand' => 'S/M', 'model' => 'S/M'],
        ];

        // Remover duplicados en memoria conservando sólo los elementos únicos
        $uniqueData = $this->removeDuplicates($mainData);

        // Insertar los datos limpios de una sola vez
        if (!empty($uniqueData)) {
            Classification::insert($uniqueData);
            $this->command->info('Classification database seeded successfully with ' . count($uniqueData) . ' unique entries.');
        } else {
            $this->command->comment('No new unique entries to insert into Classification.');
        }
    }

    /**
     * Filtra el array de entrada eliminando los duplicados basándose en sus valores estructurados.
     *
     * @param array $data El array original con posibles duplicados.
     * @return array El array filtrado listo para inserción masiva.
     */
    protected function removeDuplicates(array $data): array
    {
        $seen = [];
        $filtered = [];
        $duplicateCount = 0;

        foreach ($data as $item) {
            ksort($item); 
            $itemString = json_encode($item);

            if (!isset($seen[$itemString])) {
                $seen[$itemString] = true;
                $filtered[] = $item;
            } else {
                $duplicateCount++;
            }
        }

        if ($duplicateCount > 0) {
            // Muestra un aviso en la consola de Artisan avisando cuántos limpió
            echo "Aviso: Se encontraron y removieron {$duplicateCount} elementos duplicados antes de insertar.\n";
        }

        return $filtered;
    }
}