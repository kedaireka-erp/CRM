<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Sales']);
        Role::create(['name' => 'QC']);

        User::factory()->create([
            'name' => 'Budi',
            'email' => 'budi@mail.com',
        ])->assignRole('Admin');

        User::factory()->create([
            'name' => 'Susi Susanti',
            'email' => 'susi@mail.com',
        ])->assignRole("Sales");

        User::factory()->create([
            'name' => 'Herman Sihombing',
            'email' => 'herman@mail.com',
        ])->assignRole("QC");
    }
}
