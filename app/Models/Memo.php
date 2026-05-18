<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    /** @use HasFactory<\Database\Factories\MemoFactory> */
    use HasFactory;

    protected $fillable=[
        'nro_control',
        'date_created',
        'title',
        'category_id',
        'addressed_to',
        'department_id',
        'content',
        'user_id'
    ];

    protected $casts = [
        'date_created' => 'datetime'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function departments(){
        return $this->belongsToMany(Department::class);
    }

    public function category(){
         return $this->belongsTo(Category::class); // Relación con la tabla "categories"
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'user_id', 'user_id');
    }

}
