<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

////////////////////////////////////////////////////////////////
// Aqui van los modelos relacionados a las tareas del sistema //
////////////////////////////////////////////////////////////////
use App\Models\Departament;
use App\Models\User;
use App\Models\Client;

/////////////////////////////////////////////////////////////////////////
// Aqui colocamos todas las tareas que se podra realizar en el sistema //
/////////////////////////////////////////////////////////////////////////

use App\Models\GmvvRequest;


class Task extends Model
{
    use HasFactory;

    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function gmvv_request()
    {
        return $this->hasMany(GmvvRequest::class);
    }

    protected $fillable = [
        'type',
        'departament_id',
        'user_id',
        'client_id'
    ];
}
