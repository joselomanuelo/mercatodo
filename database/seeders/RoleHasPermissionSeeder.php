<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $this->createAdminRolePermissions();
    }

    private function createAdminRolePermissions(): void
    {
        $role = Role::findByName('admin');
        $role->syncPermissions(Permission::all());
    }
}
