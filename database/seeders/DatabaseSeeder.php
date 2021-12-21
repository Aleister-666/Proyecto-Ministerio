<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Departament;
use App\Models\State;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        Departament::create(['name' => 'Redes Populares']);
        Departament::create(['name' => 'MINHVHI']);
        Departament::create(['name' => 'Informatica']);

        Role::create(['name' => 'worker']);
        Role::create(['name' => 'coordinator']);
        Role::create(['name' => 'admin']);

        State::create(['name' => 'EN PROCESO']);
        State::create(['name' => 'CULMINADO']);

        $admin = User::create([
            'cedula' => '2629944',
            'email' => 'admin@gmail.com',
            'telefono' => '04269472830',
            'sex' => 'hombre',
            'password' => bcrypt('12345678'),
            'departament_id' => 3,
        ]);

        $admin->names()->create([
            'first_name' => 'Jose',
            'first_surname' => 'Torrealba',
            'second_name' => 'Andres',
            'second_surname' => 'Padrino'
        ]);

        $worker = User::create([
            'cedula' => '27840406',
            'email' => 'worker@gmail.com',
            'telefono' => '04121970191',
            'sex' => 'hombre',
            'password' => bcrypt('12345678'),
            'departament_id' => 1,
        ]);

        $worker->names()->create([
            'first_name' => 'Noheangel',
            'first_surname' => 'Rengifo',
            'second_name' => 'Junior',
            'second_surname' => 'Rengifo'
        ]);

        $admin->assignRole('admin');
        $worker->assignRole('worker');
    }
}
