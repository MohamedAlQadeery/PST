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
        //all permissions
        //     $permissions = array('all', 'create-product', 'update-product', 'delete-product', 'index-product', 'create-user', 'index-user', 'request-product',
        //     'create-category', 'update-category', 'delete-category', 'index-category', 'cashier', 'show-invoice', 'index-invoice', 'delete-invoice', 'delete-shop', 'update-shop', 'index-shop', 'index-role',
        //     'update-role', 'delete-role', 'create-role', 'settings', 'index-contactus', 'delete-contactus', 'create-contactus', 'show-contactus',
        //     'index-usertransaction', 'create-usertransaction', 'update-usertransaction', 'delete-usertransaction',
        //     'index-usercontactus', 'delete-usercontactus', 'create-usercontactus', 'show-usercontactus',
        // );

        //     foreach ($permissions as $permission) {
        //         Permission::create([
        //             'name' => $permission,
        //         ]);
        //     }

        //permissions for sellers to assign it for him and other sub workers
        // $sellers_permissions = array('create-shopproducts', 'update-shopproducts', 'index-shopproducts', 'delete-shopproducts',
        // 'create-subworkers',  'index-subworkers',  'update-subworkers',
        //   'delete-subworkers',  'shopcashier',  'index-shopinvoice',
        //    'delete-shopinvoice',  'index-transactions',  'update-transactions',
        //    'create-transactions',  'delete-transactions',  'all-shoppermissions',
        //    'create-shoproles', 'update-shoproles', 'update-shoproles', 'index-shoproles',
        //    'index-usermessage', 'create-usermessage', 'edit-usermessage', 'delete-usermessage',
        // );

        // $sellers_permissions = array('pay-usertransaction', 'status-usertransaction');
        // foreach ($sellers_permissions as $permission) {
        //     Permission::create([
        //         'name' => $permission,
        //         'type' => 1,
        //     ]);
        // }

        // $role = Role::create(['name' => 'admin']);

        // $role->givePermissionTo('all');

        // $role = Role::create(['name' => 'صاحب المتجر']);
        // $role->givePermissionTo('all-shoppermissions');
    }
}
