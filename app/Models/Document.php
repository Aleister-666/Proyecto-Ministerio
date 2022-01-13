<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Client;
use App\Models\Departament;

class Document extends Model
{
    use HasFactory;

    // Retorna la relacion entre Documentos y usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
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
        'client_id'
    ];

    protected $attributes = [
        'title' => null,
        'description' => null
    ];
}
