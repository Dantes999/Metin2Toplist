<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@server.de',
            'email_verified_at' => now(),
            'password' => Hash::make('Bbc@32188'), // Securely hash the password
            'admin' => 1, // Set as admin user
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
