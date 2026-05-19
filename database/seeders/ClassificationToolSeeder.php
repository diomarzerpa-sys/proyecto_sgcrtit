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

        // --- Datos de ClassificationToolSeeder.php original (Tool) ---
        $toolData = [
            ['type' => 'Tool', 'name' => 'Patch panel CAT5E 24 puertos', 'brand' => 'Slampro', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Patch panel CAT6 24 puertos', 'brand' => 'Slampro', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Patch panel CAT6 24 puertos', 'brand' => 'Tren Drut', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Jetdirect 200M', 'brand' => 'HP', 'model' => 'J6039C'],
            ['type' => 'Tool', 'name' => 'Probador de Red', 'brand' => 'ENGINDOT', 'model' => 'CT03'],
            ['type' => 'Tool', 'name' => 'Multimetro Digital', 'brand' => 'KOBATEX', 'model' => 'DF830D'],
            ['type' => 'Tool', 'name' => 'Probador de Red', 'brand' => 'Quest', 'model' => 'TCT141'],
            ['type' => 'Tool', 'name' => 'Probador de Red', 'brand' => 'Slampro', 'model' => 'XT-468'],
            ['type' => 'Tool', 'name' => 'Probador de Red', 'brand' => 'Good Reverse', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Cargador de pilas 9 voltios', 'brand' => 'Ebl', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Chicharra Telefonica', 'brand' => 'Progresive Electronics', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Antenas Inalambricas', 'brand' => 'D-LINK', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Soplador', 'brand' => 'MIYAKOLISA', 'model' => '50B510'],
            ['type' => 'Tool', 'name' => 'Soplador', 'brand' => 'Perfect', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Soplador', 'brand' => 'Run', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Remachador', 'brand' => 'Stanley', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Remachador', 'brand' => 'Stanley', 'model' => '69-646'],
            ['type' => 'Tool', 'name' => 'Remachador', 'brand' => 'Stanley', 'model' => 'Mr77'],
            ['type' => 'Tool', 'name' => 'Pinza', 'brand' => 'Brave', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Base para Segeta', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Crimpeadora', 'brand' => 'Proskit', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Juego de llaves Nº 5,7,9', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Juego de (13) llaves allen hexagonal', 'brand' => 'Pretul', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Pinza', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Tool', 'name' => 'Destornillador', 'brand' => 'S/M', 'model' => 'Dado'],
            ['type' => 'Tool', 'name' => 'Destornillador', 'brand' => 'Brufer', 'model' => 'Tor'],
            ['type' => 'Tool', 'name' => 'Destornillador', 'brand' => 'Brufer', 'model' => 'Pala Corta'],
            ['type' => 'Tool', 'name' => 'Destornillador', 'brand' => 'Stanley', 'model' => 'Estrella'],
            ['type' => 'Tool', 'name' => 'Destornillador', 'brand' => 'Pretul', 'model' => 'Estrella'],
            ['type' => 'Tool', 'name' => 'Succionador de Estaño', 'brand' => 'S/M', 'model' => 'S/M'],
        ];
        

        // Remover duplicados en memoria conservando sólo los elementos únicos
        $uniqueData = $this->removeDuplicates($toolData);

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