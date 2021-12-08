<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Document;
use App\Models\Task;

class Departament extends Model
{
    use HasFactory;

    // Retorna la relacion entre un Departamento y un Usuario
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Retorna la relacion entre un Departamento y un Usuario
    public function tasks()
    {
        return $this->hasMany(User::class);
    }


    //  Retorna la relacion entre un Departamento y sus documentos
    // public function documents()
    // {
    //     return $this->hasMany(Document::class);
    // }

    protected $fillable = [
        'name'
    ];
}
