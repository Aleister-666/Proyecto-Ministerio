<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use App\Models\NamesUser;
use App\Models\Departament;
use App\Models\Task;
use App\Models\Client;
use App\Models\Document;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    // Retorna la relacion entre un Usuario y sus Nombres
    public function names()
    {
        return $this->hasOne(NamesUser::class);
    }

    //  Retorna la relacion entre un Usuario y el Departamento al que pertenece
    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'cedula',
        'email',
        'password',
        'sex',
        'telefono',
        'departament_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
