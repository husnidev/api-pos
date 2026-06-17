<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            'category.view',
            'category.create',
            'category.update',
            'category.delete',

            'product.view',
            'product.create',
            'product.update',
            'product.delete',

            'transaction.view',
            'transaction.create',

            'user.manage',

            'report.view'
        ];

        foreach ($permissions as $permission)
        {
            Permission::firstOrCreate([
                'name'=>$permission
            ]);
        }

        $owner = Role::firstOrCreate([
            'name'=>'owner'
        ]);

        $admin = Role::firstOrCreate([
            'name'=>'admin'
        ]);

        $cashier = Role::firstOrCreate([
            'name'=>'cashier'
        ]);

        $owner->givePermissionTo(
            Permission::all()
        );

        $admin->givePermissionTo([
            'category.view',
            'category.create',
            'category.update',
            'category.delete',
            'product.view',
            'product.create',
            'product.update',
            'product.delete',
            'transaction.view',
            'user.manage'
        ]);

        $cashier->givePermissionTo([
            'product.view',
            'transaction.create'
        ]);
    }
}
