<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        // Usuario Administrador
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345'), 
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Usuario Votante
        DB::table('users')->insert([
            'name' => 'Votante',
            'email' => 'votante@example.com',
            'password' => Hash::make('12345'), 
            'role' => 'votante',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
