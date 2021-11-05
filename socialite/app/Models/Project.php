<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable=[
        'nama', 'no_telp', 'nama_project', 'tim', 'deadline', 'progress', 'waktu'
    ];
    public function tasks(){
        return $this->hasMany(Task::class,'project_id');
    }
}


