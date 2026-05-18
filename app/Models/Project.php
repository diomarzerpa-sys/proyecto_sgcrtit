<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable=[
        'title',
        'category_id',
        'department_id',
        'date_start',
        'date_finish',
        'content',
        'status',
    ];

    protected $casts = [
        'date_start' => 'datetime',
        'date_finish' => 'datetime'
    ];

    public function staffs(){
        return $this->belongsToMany(Staff::class);
    }

    public function category(){
         return $this->belongsTo(Category::class); // Relación con la tabla "categories"
    }

    public function departments(){
        return $this->belongsToMany(Department::class);
    }
}
