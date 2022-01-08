<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Semogaberkah'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('Semogaberkah'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::create([
            'name' => 'guest',
            'email' => 'guest@gmail.com',
            'password' => Hash::make('Semogaberkah'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Roles::create([
            'status' => 'ADMIN',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Roles::create([
            'status' => 'STAFF',
            'user_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Roles::create([
            'status' => 'GUEST',
            'user_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
