<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'Budi',
            'email' => 'budi@mail.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Susi Susanti',
            'email' => 'susi@mail.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Herman Sihombing',
            'email' => 'herman@mail.com',
        ]);
    }
}
