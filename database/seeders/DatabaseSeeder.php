<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Only for testing purpose
        User::factory()->create([
            'name' => 'idesa',
            'email' => 'idesa@idesa.com',
            'password' => 'idesa123'
        ]);


        $this->call([
            AuthorSeeder::class,
            BookSeeder::class,
        ]);
    }
}
