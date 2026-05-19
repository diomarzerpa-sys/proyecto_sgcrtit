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
        // --- Datos de ClassificationComponentSeeder.php original (Componentes) ---
        $componentData = [
            ['type' => 'Processor', 'name' => 'Core I5', 'brand' => 'Intel', 'model' => '3450 - 3.10 GHZ'],
            ['type' => 'Processor', 'name' => 'Core I3', 'brand' => 'Intel', 'model' => '2120 - 3.30 GHZ'],
            ['type' => 'Processor', 'name' => 'Dual Core', 'brand' => 'Intel', 'model' => 'E550 - 2.80 GHZ'],
            ['type' => 'Processor', 'name' => 'Celeron', 'brand' => 'Intel', 'model' => '420 - 1.60 GHZ'],
            ['type' => 'Processor', 'name' => 'Pentium', 'brand' => 'Intel', 'model' => 'G2020 - 2.90 GHZ'],
            ['type' => 'Processor', 'name' => 'Semprom', 'brand' => 'AMD', 'model' => '145'],
            ['type' => 'Hardisk', 'name' => 'Disco Duro', 'brand' => 'Wester Digital', 'model' => 'Wd1600aajs'],
            ['type' => 'Video_card', 'name' => 'Tarjeta de Video', 'brand' => 'Nvidia', 'model' => ' 7200 GS'],
            ['type' => 'Audio_card', 'name' => 'Tarjeta', 'brand' => 'Intel', 'model' => 'ALC662'],
            ['type' => 'Motherboard', 'name' => 'Tarjeta Madre', 'brand' => 'Esc', 'model' => 'H77H2-EM'],
            ['type' => 'SO', 'name' => '7 Home', 'brand' => 'Windows', 'model' => '32 Bit'],
            ['type' => 'SO', 'name' => '7 Home', 'brand' => 'Windows', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '7 Pro', 'brand' => 'Windows', 'model' => '32 Bit'],
            ['type' => 'SO', 'name' => '7 Pro', 'brand' => 'Windows', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '7 Ultimate', 'brand' => 'Windows', 'model' => '32 Bit'],
            ['type' => 'SO', 'name' => '7 Ultimate', 'brand' => 'Windows', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '10 Home', 'brand' => 'Windows', 'model' => '32 Bit'],
            ['type' => 'SO', 'name' => '10 Home', 'brand' => 'Windows', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '10 Pro', 'brand' => 'Windows', 'model' => '32 Bit'],
            ['type' => 'SO', 'name' => '10 Pro', 'brand' => 'Windows', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '10 LSTB', 'brand' => 'Windows', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '10 LSTC', 'brand' => 'Windows', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '11 Home', 'brand' => 'Windows', 'model' => '32 Bit'],
            ['type' => 'SO', 'name' => '11 Home', 'brand' => 'Windows', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '11 Pro', 'brand' => 'Windows', 'model' => '32 Bit'],
            ['type' => 'SO', 'name' => '11 Pro', 'brand' => 'Windows', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '11 LSTB', 'brand' => 'Windows', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '11 LSTC', 'brand' => 'Windows', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => 'Ubuntu', 'brand' => 'Ubuntu', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => 'KUbuntu', 'brand' => 'Ubuntu', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => 'XUbuntu', 'brand' => 'Ubuntu', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => 'LUbuntu', 'brand' => 'Ubuntu', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => 'Ubuntu Studio', 'brand' => 'Ubuntu', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '12 - Bookworm', 'brand' => 'Debian', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '11 - Bullseye', 'brand' => 'Debian', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '10 - BUSTER', 'brand' => 'Debian', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '9 - Stretch', 'brand' => 'Debian', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '8 - Jessie', 'brand' => 'Debian', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '7 - Wheezy', 'brand' => 'Debian', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '22 - Wilma', 'brand' => 'Linux Mint', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '21 - Vanessa', 'brand' => 'Linux Mint', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '20 - Ulyana', 'brand' => 'Linux Mint', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '19 - Tara', 'brand' => 'Linux Mint', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '18 - Sarah', 'brand' => 'Linux Mint', 'model' => '64 Bit'],
            ['type' => 'SO', 'name' => '24.11', 'brand' => 'Pfsense', 'model' => 'Stable'],
            ['type' => 'SO', 'name' => '2.1.9', 'brand' => 'Ipcop', 'model' => 'Stable'],
            ['type' => 'OF', 'name' => '2021', 'brand' => 'Microsoft Office', 'model' => 'Professional Plus'],
            ['type' => 'OF', 'name' => '2019', 'brand' => 'Microsoft Office', 'model' => 'Professional Plus'],
            ['type' => 'OF', 'name' => '2016', 'brand' => 'Microsoft Office', 'model' => 'Professional Plus'],
            ['type' => 'OF', 'name' => '2013', 'brand' => 'Microsoft Office', 'model' => 'Professional Plus'],
            ['type' => 'OF', 'name' => '2010', 'brand' => 'Microsoft Office', 'model' => 'Professional Plus'],
            ['type' => 'OF', 'name' => 'LTSC', 'brand' => 'Microsoft Office', 'model' => 'Professional Plus'],
            ['type' => 'OF', 'name' => '6.1', 'brand' => 'Libre Office', 'model' => 'LGPL v3 + y MPL'],
            ['type' => 'OF', 'name' => '6.0', 'brand' => 'Libre Office', 'model' => 'LGPL v3 + y MPL'],
            ['type' => 'OF', 'name' => '5.4', 'brand' => 'Libre Office', 'model' => 'LGPL v3 + y MPL'],
            ['type' => 'OF', 'name' => '5.3', 'brand' => 'Libre Office', 'model' => 'LGPL v3 + y MPL'],
            ['type' => 'OF', 'name' => '5.2', 'brand' => 'Libre Office', 'model' => 'LGPL v3 + y MPL'],
            ['type' => 'OF', 'name' => '5.1', 'brand' => 'Libre Office', 'model' => 'LGPL v3 + y MPL'],
            ['type' => 'OF', 'name' => '5.0', 'brand' => 'Libre Office', 'model' => 'LGPL v3 + y MPL'],
            ['type' => 'OF', 'name' => '4.4', 'brand' => 'Libre Office', 'model' => 'LGPL v3 + y MPL'],
            ['type' => 'OF', 'name' => '4.3', 'brand' => 'Libre Office', 'model' => 'LGPL v3 + y MPL'],
            ['type' => 'OF', 'name' => '4.2', 'brand' => 'Libre Office', 'model' => 'LGPL v3 + y MPL'],
            ['type' => 'OF', 'name' => '4.1', 'brand' => 'Libre Office', 'model' => 'LGPL v3 + y MPL'],
            ['type' => 'OF', 'name' => '4.0', 'brand' => 'Libre Office', 'model' => 'LGPL v3 + y MPL'],
            ['type' => 'OF', 'name' => '2024', 'brand' => 'Wps', 'model' => '64 Bit'],
            ['type' => 'OF', 'name' => '2020', 'brand' => 'Wps', 'model' => '64 Bit'],
            ['type' => 'OF', 'name' => '2019', 'brand' => 'Wps', 'model' => '64 Bit'],
            ['type' => 'OF', 'name' => 'WEB', 'brand' => 'Only Office', 'model' => 'ONLINE'],
            ['type' => 'NV', 'name' => 'Navegador', 'brand' => 'Firefox', 'model' => '136'],
            ['type' => 'NV', 'name' => 'Navegador', 'brand' => 'Chrome', 'model' => '115'],
            ['type' => 'NV', 'name' => 'Navegador', 'brand' => 'Edge', 'model' => '115'],
            ['type' => 'NV', 'name' => 'Navegador', 'brand' => 'Opera', 'model' => 'GX 120'],
        ];

        // Remover duplicados en memoria conservando sólo los elementos únicos
        $uniqueData = $this->removeDuplicates($componentData);

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