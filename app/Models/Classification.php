<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    /** @use HasFactory<\Database\Factories\ClassificationFactory> */
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'brand',
        'model'
    ];

    public function national_assets(){
        return $this->hasMany(NationalAsset::class);
    }
}
