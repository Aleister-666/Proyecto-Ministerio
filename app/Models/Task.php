<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

////////////////////////////////////////////////////////////////
// Aqui van los modelos relacionados a las tareas del sistema //
////////////////////////////////////////////////////////////////
use App\Models\State;
use App\Models\Departament;
use App\Models\User;

/////////////////////////////////////////////////////////////////////////
// Aqui colocamos todas las tareas que se podra realizar en el sistema //
/////////////////////////////////////////////////////////////////////////

use App\Models\GmvvRequest;


class Task extends Model
{
    use HasFactory;

    /**
     * Retorna el estado que actualmente posee una tarea
     * @return Relationship Task-State Object
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Retorna el departamento al cual pertenece una tarea
     * @return Relationship Task-Departament Object
     */
    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }

    /**
     * Renorna el usuario al cual pertenece una tarea
     * @return Relationship Task-User Object
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    
    public function gmvv_requests()
    {
        return $this->hasMany(GmvvRequest::class);
    }

    protected $fillable = [
        'state_id',
        'departament_id',
        'user_id'
    ];
}
