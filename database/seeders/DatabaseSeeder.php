<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create items']);
        Permission::create(['name' => 'edit items']);
        Permission::create(['name' => 'delete items']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'admin']);

        $role2 = Role::create(['name' => 'staff']);
        $role2->givePermissionTo('create items');
        $role2->givePermissionTo('edit items');


        $user = User::factory()->create([
            'name' => 'Wildan Tamma Faza Chair',
            'email' => 'wildantfc@gmail.com',
        ]);
        $user->assignRole($role1);

        $user1 = User::factory()->create([
            'name' => 'Abigail Ahza Gatan',
            'email' => 'abigail@gmail.com',
        ]);
        $user1->assignRole($role2);

        Item::factory()->count(5)->create();

    }
}
