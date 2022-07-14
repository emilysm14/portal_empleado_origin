<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([

            'name' => 'Wilson',
            'email' => ('correo@correo.com'),
            'password' => Hash::make('12345678'),
            'url' => ('http://wilson.com'), 

        ]);


        $user2 = User::create([

            'name' => 'Juan',
            'email' => ('juan@correo.com'),
            'password' => Hash::make('12345678'),
            'url' => ('http://juan.com'), 

        ]);



    }
}
