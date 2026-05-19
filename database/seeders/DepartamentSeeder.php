<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'Socio Académica',
            'PFG Salud Pública',
            'PFG Gestión Ambiental',
            'PNF Enfermería',
            'PFG Estudios Políticos Y Gobierno',
            'PFG Acuicultura Y Pesca',
            'PFG Comunicación Social',
            'PFG  Agro Ecología',
            'PFG Informática para la Gestión Social',
            'PFG Arquitectura',
            'Cultura',
            'PFG Gestión Social para el Desarrollo Local',
            'PFG Estudios Jurídicos',
            'Centro De Idiomas',
            'Apoyo Socio - Administrativo',
            'Talento Humano',
            'Consultoría Jurídica',
            'Producción y Recreación de Saberes',
            'Comunicación y Proyección Universitaria',
            'Dirección Del EGRKV',
            'Tecnología de Información y Telecomunicaciones',
            'CRISE',
            'Sala Situacional',
            'Salud Integral',
            'SIHO',
            'Seguridad Integral',
            'Deporte',
            'Desarrollo y Mantenimiento de Planta Física',
            'Servicios Generales',
            'Biblioteca',
            'Comedor',
            'Ingreso-Prosecución y Egreso Estudiantil',
            'Bienestar Estudiantil',
            'Transporte',
            'Subsecretaria',
            'Desempeño Estudiantil',
            'Coordinación De Sede',
            'PFG Ingenieria y Gestión Minera',
            'Postgrado',
            'PFG Enfermería Regional',
            'Centro de Estudios CEPEC',
            'Psicologia',
            'Laboratorio 11 de Informatica',
            'Laboratorio 12 de Informatica'
        ];

        foreach ($departments as $name) {
            Department::firstOrCreate(['name' => $name]);
        }
    }
}