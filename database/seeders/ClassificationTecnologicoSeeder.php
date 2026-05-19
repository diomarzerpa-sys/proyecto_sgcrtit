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
            ['type' => 'Tecnologico', 'name' => 'Servidor', 'brand' => 'VIT', 'model' => 'Np3020m3-01'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'VIT', 'model' => '190lm00006'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'VIT', 'model' => 'Dok-K5313'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'VIT', 'model' => 'Dok-M696'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'CDP', 'model' => 'B-Avr1005'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'CDP', 'model' => 'B-Avr1006'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'VIT', 'model' => '215lm00019'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'HP', 'model' => 'Sk-1688'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'YBT', 'model' => 'No Tiene'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'Arawak', 'model' => '4a50b1'],
            ['type' => 'Tecnologico', 'name' => 'Cornetas', 'brand' => 'Genius', 'model' => 'Sp-Q065'],
            ['type' => 'Tecnologico', 'name' => 'Cpu', 'brand' => 'TCL', 'model' => 'B7400'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'LG', 'model' => 'E1942ca'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'TCL', 'model' => 'M-Uae96'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'Xerox', 'model' => '3550'],
            ['type' => 'Tecnologico', 'name' => 'Ups', 'brand' => 'Avtek', 'model' => 'Upsksmt'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'HP', 'model' => 'No Tiene'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'TCL', 'model' => 'No Tiene'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'HP', 'model' => 'No Tiene'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'Siragon', 'model' => 'C1700f'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'IBM', 'model' => '6518-41e'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'HP', 'model' => '55502'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'HP', 'model' => 'Ku-0316'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'VIT', 'model' => 'Jme-7050'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'VIT', 'model' => 'Kb-2971'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'XPX', 'model' => 'Kbx21'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'TCL', 'model' => 'Jme-7010'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'Genius', 'model' => 'K639'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'HP', 'model' => 'Kb-0316'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'IBM', 'model' => 'Kb-0225'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'Siragon', 'model' => 'No Tiene'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'Benq', 'model' => 'P010'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'Soneview', 'model' => 'Svk-752'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'Logic', 'model' => 'Kb-3802p5pa'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'HP', 'model' => 'Mo42kc'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'HP', 'model' => 'Vc066'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'Benq', 'model' => 'Po-10'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'Siragon', 'model' => 'No Tiene'],
            ['type' => 'Tecnologico', 'name' => 'Camara', 'brand' => 'Logitech', 'model' => 'Hd720p'],
            ['type' => 'Tecnologico', 'name' => 'Camara', 'brand' => 'P', 'model' => 'Dis-Dne700361rv'],
            ['type' => 'Tecnologico', 'name' => 'Camara', 'brand' => 'Mercury', 'model' => 'No Tiene'],
            ['type' => 'Tecnologico', 'name' => 'Video Beam', 'brand' => 'Epson', 'model' => 'H430a'],
            ['type' => 'Tecnologico', 'name' => 'Escaner', 'brand' => 'HP', 'model' => 'Fcls D-0408'],
            ['type' => 'Tecnologico', 'name' => 'Escaner', 'brand' => 'HP', 'model' => '3670'],
            ['type' => 'Tecnologico', 'name' => 'Ups', 'brand' => 'APC', 'model' => 'Be500u'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'Genius', 'model' => 'Net Scroll 120'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'GS', 'model' => 'Mo28u0'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'IBM', 'model' => 'Mu29j'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'FC', 'model' => 'Msu0718t'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'XPX', 'model' => 'Msk20'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'Dell', 'model' => 'Muvom1'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'CDP', 'model' => 'E-Avr-1008'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'CDP', 'model' => 'E-Avr-1006'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'CDP', 'model' => 'No Tiene'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'Soneview', 'model' => 'Avr-1000m'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'Avtek', 'model' => 'Upsvksmt'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'Interclone', 'model' => 'I-Avr-1005'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'Soneview', 'model' => 'Svk-760'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'Logitech', 'model' => 'No Tiene'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'Ricoh', 'model' => 'Cio 450'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'Risograph', 'model' => 'Cr1610ui'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'Canon', 'model' => 'Np7130'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'Minolta', 'model' => 'Ad-10'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'HP', 'model' => 'Color Laserjet 5550dn'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'Lenovo', 'model' => 'Lj1900'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'HP', 'model' => 'Laserjet 3030'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'HP', 'model' => 'Laserjet P2015dn'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'HP', 'model' => 'Laserjet P1102w'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'HP', 'model' => 'Photosmart D110'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'HP', 'model' => 'Psc 1410 Aio'],
            ['type' => 'Tecnologico', 'name' => 'Escaner', 'brand' => 'HP', 'model' => 'Scanjel 5590'],
            ['type' => 'Tecnologico', 'name' => 'Escaner', 'brand' => 'HP', 'model' => 'Scanjel G3030'],
            ['type' => 'Tecnologico', 'name' => 'Cpu', 'brand' => 'HP', 'model' => 'Dx2000mt'],
            ['type' => 'Tecnologico', 'name' => 'Cpu', 'brand' => 'Siragon', 'model' => '1210VS-925-PD'],
            ['type' => 'Tecnologico', 'name' => 'Cpu', 'brand' => 'VIT', 'model' => '2600'],
            ['type' => 'Tecnologico', 'name' => 'Cpu', 'brand' => 'VIT', 'model' => 'E2120-02'],
            ['type' => 'Tecnologico', 'name' => 'Cpu', 'brand' => 'VIT', 'model' => 'C2664'],
            ['type' => 'Tecnologico', 'name' => 'Cpu', 'brand' => 'VIT', 'model' => '2910-01'],
            ['type' => 'Tecnologico', 'name' => 'Cpu', 'brand' => 'XPX', 'model' => 'S/M'],
            ['type' => 'Tecnologico', 'name' => 'Cpu', 'brand' => 'S/M', 'model' => 'S/M'],
            ['type' => 'Tecnologico', 'name' => 'Escaner', 'brand' => 'HP', 'model' => 'Scanjel G3010'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'HP', 'model' => 'Q7286A'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'HP', 'model' => 'COLA-1802-05'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'HP', 'model' => 'Psc 1400'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'HP', 'model' => 'E709a'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'LG', 'model' => '19EN335A'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'Samsung', 'model' => '933SN'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'TCL', 'model' => '787A'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'VIT', 'model' => 'L1780L'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'VIT', 'model' => 'TFT19W80PS'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'VIT', 'model' => 'V1780B'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'VIT', 'model' => 'V1780L'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'S/M', 'model' => '19EN33SA'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'Genius', 'model' => 'S/M'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'IBM', 'model' => 'MO28U0'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'Lenovo', 'model' => 'S/M'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'Soneview', 'model' => 'MO507'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'Tech', 'model' => 'BW-35'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'VIT', 'model' => 'C412'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'VIT', 'model' => 'MSUO718T'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'VIT', 'model' => 'S/M'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'VIT', 'model' => 'VC066'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'Arawak', 'model' => '4A5AB1'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'Arawak', 'model' => 'MASOB'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'Arawak', 'model' => 'PCG12005'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'Kenclan', 'model' => 'EB500'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'Soneview', 'model' => 'AVR-600M'],
            ['type' => 'Tecnologico', 'name' => 'Router', 'brand' => 'Tplink', 'model' => 'TL-WR940N'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'Fundabit', 'model' => 'JME-7010'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'IBM', 'model' => 'SK-8820'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'Soneview', 'model' => 'KB S3000'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'VIT', 'model' => 'JME-7010'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'VIT', 'model' => 'KB-2771'],
            ['type' => 'Tecnologico', 'name' => 'Telefax', 'brand' => 'Panasony', 'model' => 'KX-FHD35J'],
            ['type' => 'Tecnologico', 'name' => 'Ups', 'brand' => 'Emerald', 'model' => 'PWX-500'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'IBM', 'model' => 'S/M'],
            ['type' => 'Tecnologico', 'name' => 'Cpu', 'brand' => 'VIT', 'model' => 'B1500'],
            ['type' => 'Tecnologico', 'name' => 'Cpu', 'brand' => 'VIT', 'model' => 'VIT-E2120-02'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'HP', 'model' => 'DESKJET3050'],
            ['type' => 'Tecnologico', 'name' => 'Impresora', 'brand' => 'HP', 'model' => 'DESKJETD2660'],
            ['type' => 'Tecnologico', 'name' => 'Teclado', 'brand' => 'IBM', 'model' => 'KB-0225'],
            ['type' => 'Tecnologico', 'name' => 'Mouse', 'brand' => 'TCL', 'model' => 'VSE96'],
            ['type' => 'Tecnologico', 'name' => 'Regulador', 'brand' => 'Kode', 'model' => 'K-AVR1006'],
            ['type' => 'Tecnologico', 'name' => 'Escaner', 'brand' => 'HP', 'model' => 'L1985A'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'VIT', 'model' => 'V215EWD-B'],
            ['type' => 'Tecnologico', 'name' => 'Monitor', 'brand' => 'IBM', 'model' => '6546-0AEA'],
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