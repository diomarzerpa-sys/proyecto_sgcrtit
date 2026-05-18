<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    /** @use HasFactory<\Database\Factories\ToolFactory> */
    use HasFactory;

    protected $fillable = [
        'memo',
        'date_of_receipt',
        'classification_id',
        'department_id',
        'stock',
        'statusTool',
        'observationsTool',
    ];

    protected $casts = [
        'date_of_receipt' => 'datetime'
    ];

    public function classification(){
        return $this->belongsTo(Classification::class);
    }
    
}
