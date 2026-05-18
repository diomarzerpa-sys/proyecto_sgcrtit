<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    /** @use HasFactory<\Database\Factories\ManagerFactory> */
    use HasFactory;

    protected $fillable = [
        'department_id',
        'staff_id'
    ];

    public function department()
        {
            return $this->belongsTo(Department::class);
        }

    public function staff()
        {
            return $this->belongsTo(Staff::class);
            
            /* return $this->belongsTo(Staff::class)->withDefault([
            'name' => 'Coordinador No Asignado', // Nombre por defecto para el gerente
            // Puedes añadir otros atributos por defecto si el modelo Manager los tiene
        ]);*/
        }
}
