<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;

class NamesClient extends Model
{
    use HasFactory;

    // Retorna la relacion entre los Nombres de cliente y un cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    protected $fillable = [
        'first_name',
        'first_surname',
        'second_name',
        'second_surname',
    ];
}
