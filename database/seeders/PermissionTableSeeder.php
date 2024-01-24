<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo các module và gán giá trị 'parents' là 0
        $modules = [
            'Permission Module',
            'User Module',
            'Role Module',
        ];

        foreach ($modules as $module) {
            $slug = Str::slug($module, '-');
            Permission::create(['name' => $slug, 'show_name' => $module, 'parents' => 0]);
        }

        // Tạo các quyền và gán giá trị 'parents' dựa trên tên module
        $permissions = [
            'user-menu',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'role-menu',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'permission-menu',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
        ];

        $show = [
            'User Menu',
            'User List',
            'User Create',
            'User Edit',
            'User Delete',

            'Role Menu',
            'Role List',
            'Role Create',
            'Role Edit',
            'Role Delete',

            'Permission Menu',
            'Permission List',
            'Permission Create',
            'Permission Edit',
            'Permission Delete',
        ];

        foreach ($permissions as $index => $permission) {
            $slug = Str::slug($permission, '-');
            Permission::create([
                'name' => $slug,
                'show_name' => $show[$index],
                'parents' => $this->getParentModuleId($slug),
            ]);
        }
    }

    private function getParentModuleId($permission)
    {
        if (str_starts_with($permission, 'user')) {
            return Permission::where('name', 'user-module')->value('id');
        } elseif (str_starts_with($permission, 'role')) {
            return Permission::where('name', 'role-module')->value('id');
        } elseif (str_starts_with($permission, 'permission')) {
            return Permission::where('name', 'permission-module')->value('id');
        }

        return null;
    }
}
