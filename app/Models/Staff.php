<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    /** @use HasFactory<\Database\Factories\StaffFactory> */
    use HasFactory;

    protected $fillable=[
        'name',
        'last_name',
        'document_id',
        'entry_date',
        'address',
        'phone',
        'observations',
        'user_id',
        'department_id'
    ];

    protected $casts = [
        'entry_date' => 'datetime'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function manager(){
        return $this->hasOne(Manager::class);
    }

    public function projects(){
        return $this->belongsToMany(Project::class);
    }
}
