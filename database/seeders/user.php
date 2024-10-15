<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class user extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nama' => 'andrea rossi',
            'email' => 'andrea.rossi0507@gmail.com',
            'password' => Hash::make('andrea'),
            'role' => '2',
            'foto' => 'andrea.png',
            'status' => '1',
        ]);
    }
}
