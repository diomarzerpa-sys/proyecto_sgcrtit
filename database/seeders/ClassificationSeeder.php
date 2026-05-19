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

        // --- Fusionar todos los datos en un solo array ---
        $data = array_merge($mainData, $toolData, $componentData);

        // Remover duplicados en memoria conservando sólo los elementos únicos
        $uniqueData = $this->removeDuplicates($data);

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