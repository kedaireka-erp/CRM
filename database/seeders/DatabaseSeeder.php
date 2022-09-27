<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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
        
        $permission1 = Permission::create(['name' => 'add-kontak']);
        $permission2 = Permission::create(['name' => 'edit-kontak']);
        $permission3 = Permission::create(['name' => 'delete-kontak']);
        $permission4 = Permission::create(['name' => 'add-ncr']);
        $permission5 = Permission::create(['name' => 'edit-ncr']);
        $permission6 = Permission::create(['name' => 'delete-ncr']);
        $permission7 = Permission::create(['name' => 'add-memo']);
        $permission8 = Permission::create(['name' => 'edit-memo']);
        $permission9 = Permission::create(['name' => 'delete-memo']);

        $role1 = Role::create(['name' => 'Admin']);

        $role1->givePermissionTo($permission1);
        $role1->givePermissionTo($permission2);
        $role1->givePermissionTo($permission3);
        $role1->givePermissionTo($permission4);
        $role1->givePermissionTo($permission5);
        $role1->givePermissionTo($permission6);
        $role1->givePermissionTo($permission7);
        $role1->givePermissionTo($permission8);
        $role1->givePermissionTo($permission9);

        $role2 = Role::create(['name' => 'Sales']);

        $role2->givePermissionTo($permission1);
        $role2->givePermissionTo($permission2);
        $role2->givePermissionTo($permission3);
        $role2->givePermissionTo($permission4);
        $role2->givePermissionTo($permission5);
        $role2->givePermissionTo($permission7);
        $role2->givePermissionTo($permission8);

        $role3 = Role::create(['name' => 'QC']);

        $role3->givePermissionTo($permission5);

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
