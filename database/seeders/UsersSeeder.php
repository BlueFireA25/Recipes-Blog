<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Sebastián',
            'email' => 'sebastian.castroa25@gmail.com',
            'password' => Hash::make('sebas123'),
            'webpage' => 'http://google.com',
        ]);

        $user2 = User::create([
            'name' => 'Juan',
            'email' => 'juan@gmail.com',
            'password' => Hash::make('juan123'),
            'webpage' => 'http://google.com',
        ]);
    }
}
