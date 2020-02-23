<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $permissions = array('all', 'create-product', 'update-product', 'delete-product', 'index-product', 'create-user', 'edit-user');
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }

        $role = Role::create(['name' => 'المدير العام']);
        $role->givePermissionTo('all');
    }
}
