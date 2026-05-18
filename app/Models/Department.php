<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable=['name'];

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function staffs(){
        return $this->hasMany(Staff::class);
    }

    public function memos(){
        return $this->belongsTo(Memo::class);
    }

    public function manager(){
        return $this->hasOne(Manager::class);
        
        /* return $this->hasOne(Manager::class)->withDefault([
            'name' => 'Coordinador No Asignado', // Nombre por defecto para el gerente
            // Puedes añadir otros atributos por defecto si el modelo Manager los tiene
        ]);*/
    }

    public function national_assets(){
        return $this->hasOne(national_asset::class);
    }
}
