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

    public function create()
    {
        $this->validates_fields(auth()->user()->getRoleNames()[0]);

        $data_user = array_merge(request()->only('cedula', 'email', 'telefono', 'sex'),
                                                ['password' => bcrypt(request('password')),
                                                 'departament_id' => request('departament')]);

        $user = User::create($data_user);

        $data_names = request()->only('first_name', 'first_surname', 'second_name', 'second_surname');
        $data_names = $this->capitalize($data_names);

        if ($user->names()->create($data_names)) {
            $user->assignRole(request()->role);
            
            return back()->with('success', 'Usuario Registrado');
        }

    }

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

    public function update()
    {

        $user = auth()->user();
        $this->validates_fields($user->getRoleNames()[0], $user->id);

        $data_names = request()->only('first_name', 'first_surname', 'second_name', 'second_surname');
        $data_names = $this->capitalize($data_names);

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

    public function destroy()
    {
        $user = auth()->user();
        $departament = $user->departament->name;

        Storage::disk('departaments')->deleteDirectory("{$departament}/{$user->cedula}");
        auth()->user()->delete();
        auth()->logout();
        return redirect()->route('root_path');
    }

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

    private function capitalize($array)
    {
        $capitalize = function($v) {
            return ucfirst($v);
        };
        return array_map($capitalize, $array);
    }
}