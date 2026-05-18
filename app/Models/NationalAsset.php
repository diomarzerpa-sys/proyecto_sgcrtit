<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NationalAsset extends Model
{
    protected $fillable=[
        'code',
        'serial',
        'typeNA',
        'classification_id',
        'description',
        'department_id',
        'responsible_for_use',
        'status',
        'observations',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function classification(){
        return $this->belongsTo(Classification::class);
    }
}
