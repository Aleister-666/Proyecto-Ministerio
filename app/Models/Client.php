<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\NamesClient;
use App\Models\Task;

class Client extends Model
{
    use HasFactory;

    // Retorna la relacion entre un Cliente y sus Nombres
    public function names()
    {
        return $this->hasOne(NamesClient::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    protected $fillable = [
        'cedula',
        'email',
        'sex',
        'telefono',
    ];
}
