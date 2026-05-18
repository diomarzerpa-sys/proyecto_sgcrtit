<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert([
            ['name' => 'Socio Académica'],
            ['name' => 'PFG Salud Pública'],
            ['name' => 'PFG Gestión Ambiental'],
            ['name' => 'PNF Enfermería'],
            ['name' => 'PFG Estudios Políticos Y Gobierno'],
            ['name' => 'PFG Acuicultura Y Pesca'],
            ['name' => 'PFG Comunicación Social'],
            ['name' => 'PFG  Agro Ecología'],
            ['name' => 'PFG Informática para la Gestión Social'],
            ['name' => 'PFG Arquitectura'],
            ['name' => 'Cultura'],
            ['name' => 'PFG Gestión Social para el Desarrollo Local'],
            ['name' => 'PFG Estudios Jurídicos'],
            ['name' => 'Centro De Idiomas'],
            ['name' => 'Apoyo Socio - Administrativo'],
            ['name' => 'Talento Humano'],
            ['name' => 'Consultoría Jurídica'],
            ['name' => 'Producción y Recreación de Saberes'],
            ['name' => 'Comunicación y Proyección Universitaria'],
            ['name' => 'Dirección Del EGRKV'],
            ['name' => 'Tecnología de Información y Telecomunicaciones'],
            ['name' => 'CRISE'],
            ['name' => 'Sala Situacional'],
            ['name' => 'Salud Integral'],
            ['name' => 'SIHO'],
            ['name' => 'Seguridad Integral'],
            ['name' => 'Deporte'],
            ['name' => 'Desarrollo y Mantenimiento de Planta Física'],
            ['name' => 'Servicios Generales'],
            ['name' => 'Biblioteca'],
            ['name' => 'Comedor'],
            ['name' => 'Ingreso-Prosecución y Egreso Estudiantil'],
            ['name' => 'Bienestar Estudiantil'],
            ['name' => 'Transporte'],
            ['name' => 'Subsecretaria'],
            ['name' => 'Desempeño Estudiantil'],
            ['name' => 'Coordinación De Sede'],
            ['name' => 'PFG Ingenieria y Gestión Minera'],
            ['name' => 'Postgrado'],
            ['name' => 'PFG Enfermería Regional'],
            ['name' => 'Centro de Estudios CEPEC'],
            ['name' => 'Psicologia'],
            ['name' => 'Laboratorio 11 de Informatica'],
            ['name' => 'Laboratorio 12 de Informatica'],
        ]);
    }
}
