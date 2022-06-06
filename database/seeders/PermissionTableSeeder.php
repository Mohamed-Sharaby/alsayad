<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::updateOrCreate(['email'=>'admin@admin.com'],[
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '123456',
            'password' => \Hash::make('123456'),
            'is_active' => 1,
        ]);
        $permissions = [
            'Show Admins',
            'Create Admins',
            'Edit Admins',
            'Delete Admins',

            'Show Roles',
            'Create Roles',
            'Edit Roles',
            'Delete Roles',

            'Show Clients',
            'Create Clients',
            'Edit Clients',
            'Delete Clients',

            'Show Units',
            'Create Units',
            'Edit Units',
            'Delete Units',

            'Show Materials',
            'Create Materials',
            'Edit Materials',
            'Delete Materials',

            'Show Cooking',
            'Create Cooking',
            'Edit Cooking',
            'Delete Cooking',

            'Show Categories',
            'Create Categories',
            'Edit Categories',
            'Delete Categories',

            'Show Products',
            'Create Products',
            'Edit Products',
            'Delete Products',

            'Show StorageInvoices',
            'Create StorageInvoices',
            'Edit StorageInvoices',
            'Delete StorageInvoices',

            'Show Inventory',
            'Create Inventory',
            'Delete Inventory',

            'Show ExpensesItems',
            'Create ExpensesItems',
            'Edit ExpensesItems',
            'Delete ExpensesItems',

            'Show Expenses',
            'Create Expenses',
            'Edit Expenses',
            'Delete Expenses',

            'Show Suppliers',
            'Create Suppliers',
            'Edit Suppliers',
            'Delete Suppliers',

            'Show RestaurantInvoices',
            'Create RestaurantInvoices',
            'Edit RestaurantInvoices',
            'Delete RestaurantInvoices',

            'Show SalesInvoices',
            'Create SalesInvoices',
            'Edit SalesInvoices',
            'Delete SalesInvoices',

            'Show Salaries',
            'Create Salaries',
            'Edit Salaries',
            'Delete Salaries',

            'Show Settings',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission],['name' => $permission, 'guard_name' => 'web']);
        }

        $role = Role::updateOrCreate(['name'=> 'Super Admin'],['name' => 'Super Admin', 'guard_name' => 'web']);
        $role->syncPermissions($permissions);
        $admin->assignRole('Super Admin');
    }
}
