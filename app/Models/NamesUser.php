<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class NamesUser extends Model
{
    use HasFactory;

    // Retorna la relacion entre los Nombres de Usuario y un Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'first_name',
        'first_surname',
        'second_name',
        'second_surname',
    ];
}
