<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;


use App\Models\User;
use App\Models\NamesUser;
use App\Models\Departament;

class UsersController extends Controller
{

    public function show()
    {
        $user = auth()->user();
        return view('users/show', compact('user'));
    }

    /**
     * Proporciona la vista correspondiente con el rol del usuario
     * @return [type] [description]
     */
    public function new()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $departaments = Departament::all();
            $roles = Role::where('name', '!=', 'admin')->get();

            return view('users/new', compact('departaments', 'roles', 'user'));   
        } else if ($user->hasRole('coordinator')) {
            $departament = $user->departament;
            $user_role = $user->getRoleNames()[0];
            $roles = Role::where('name', '!=', 'admin')
                ->where('name', '!=', $user_role)
                ->get();

            return view('users/new', compact('departament', 'roles', 'user'));
        } else {
        	return view('users/new');   
        }

    }

    /**
     * Crea un nuevo usuario 
     */
    public function create()
    {
        $this->validates_fields(auth()->user()->getRoleNames()[0]);

        $data_user = array_merge(request()->only('cedula', 'email', 'telefono', 'sex'),
                                                ['password' => bcrypt(request('password')),
                                                 'departament_id' => request('departament')]);

        $user = User::create($data_user);

        $data_names = request()->only('first_name', 'first_surname', 'second_name', 'second_surname');
        $data_names = $this->format_names($data_names);

        if ($user->names()->create($data_names)) {
            $user->assignRole(request()->role);
            
            return back()->with('success', 'Usuario Registrado');
        }

    }

    /**
     * Proporciona la vista adecuada dependiendo del rol del usuario actualmente loggeado
     */
    public function edit()
    {

        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $departaments = Departament::all();
            $role = Role::where('name', '=', $user->getRoleNames()[0])->get()[0];
            
            return view('users/edit', compact('departaments', 'role', 'user'));  
        } else if ($user->hasRole('coordinator')) {
            $departament = $user->departament;
            $role = Role::where('name', '=', $user->getRoleNames()[0])->get()[0];

            return view('users/edit', compact('departament', 'role', 'user'));
        } else {
            return view('users/edit', compact('user'));   
        }

    }

    /**
     * Actualiza los datos del usuario actualmente logeado
     */
    public function update()
    {

        $user = auth()->user();
        $this->validates_fields($user->getRoleNames()[0], $user->id);

        $data_names = request()->only('first_name', 'first_surname', 'second_name', 'second_surname');
        $data_names = $this->format_names($data_names);

        if ($user->hasRole(['admin', 'coordinator'])) {

            $data_user = array_merge(request()->only('cedula', 'email', 'telefono', 'sex'),
                                                    ['password' => bcrypt(request('password')),
                                                     'departament_id' => request('departament')]);
            
            $user->update($data_user);
            $user->names()->update($data_names);            
            $user->assignRole(request()->role);

        } else {
            $data_user = array_merge(request()->only('email', 'telefono', 'sex'),
                                                    ['password' => bcrypt(request('password'))]);

            $user->update($data_user);
            $user->names()->update($data_names);
        }

        return redirect()->route('workplace_path');

    }

    /**
     * Encuentra al usuario logeado actual y lo elimina junto con los archivos que halla subido
     */
    public function destroy()
    {
        $user = auth()->user();
        $departament = $user->departament->name;

        Storage::disk('departaments')->deleteDirectory("{$departament}/{$user->cedula}");
        auth()->user()->delete();
        auth()->logout();
        return redirect()->route('root_path');
    }

    /**
     * Metodo que realiza las validaciones de los datos para la creacion de nuevos usuarios.
     * dependiendo del rol o si existe un id se aplican unas validaciones u otras
     * @param  String $role rol del usuario, dependiendo del rol las validaciones cambian
     * @param  String $id   identificador del usuario, si existe las validaciones cambian
     */
    private function validates_fields($role, $id = '')
    {

        if ($role == "admin" || $role = "coordinator") {
            return $validates = request()->validate([
                "first_name" => ['required', 'string'],
                "first_surname" => ['required', 'string'],
                "second_name" => ['string', 'nullable'],
                "second_surname" => ['string', 'nullable'],
                "departament" => ['required'],
                "role" => ['required'],
                "cedula" => ['required', 'string', "unique:users,cedula,{$id}", 'min:7', 'max:8'],
                "email" => ['required', 'string', "unique:users,email,{$id}"],
                "telefono" => ['string', 'max:20', 'nullable'],
                "sex" => ['required', 'max:12'],
                "password" => ['required', 'min:8', 'max:30'],
                "password_confirmation" => ['required', 'same:password', 'min:8', 'max:30']
            ]);

        } else {
            return $validates = request()->validate([
                "first_name" => ['required', 'string'],
                "first_surname" => ['required', 'string'],
                "second_name" => ['string', 'nullable'],
                "second_surname" => ['string', 'nullable'],
                "email" => ['required', 'string', "unique:users,email,{id}"],
                "telefono" => ['string', 'max:20', 'nullable'],
                "sex" => ['required', 'max:12'],
                "password" => ['required', 'min:8', 'max:30'],
                "password_confirmation" => ['required', 'same:password', 'min:8', 'max:30']
            ]);
        }
        
    }

    /**
     * Metodo que formata los nombres de los usuarios nuevos creados, estableciendoles un formato
     * capitalize a los nombres.
     * @param  array $array Coleccion de los nombres y apellidos de los usuarios nuevos
     * @return array        Retorna un array con los nombres formateados en capitalize
     */
    private function format_names($array)
    {
        $format = function($value) {
            return ucfirst(strtolower($value));
        };

        return array_map($format, $array);
    }
}