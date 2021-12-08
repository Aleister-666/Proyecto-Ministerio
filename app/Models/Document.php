<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Departament;

class Document extends Model
{
    use HasFactory;

    // Retorna la relacion entre Documentos y usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Retorna la relacion entre Documentos y Departamentos
    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }

    public function extension()
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION);
    }

    protected $fillable = [
        'title',
        'description',
        'file_name',
        'file_path',
        'user_id',
        'departament_id'
    ];
}
