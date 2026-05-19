<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role0 = Role::firstOrCreate(['name' => 'Admin']);
        $role1 = Role::firstOrCreate(['name' => 'Coord']);
        $role2 = Role::firstOrCreate(['name' => 'Normal']);

        Permission::firstOrCreate(['name' => 'dashboard'])->syncRoles([$role0, $role1, $role2]);

        Permission::firstOrCreate(['name' => 'admin.staffs.index'])->syncRoles([$role0, $role1, $role2]);
        Permission::firstOrCreate(['name' => 'admin.staffs.create'])->syncRoles([$role0, $role1]);
        Permission::firstOrCreate(['name' => 'admin.staffs.edit'])->syncRoles([$role0, $role1]);
        Permission::firstOrCreate(['name' => 'admin.staffs.show'])->syncRoles([$role0, $role1, $role2]);
        Permission::firstOrCreate(['name' => 'admin.staffs.destroy'])->syncRoles([$role0, $role1]);

        Permission::firstOrCreate(['name' => 'admin.memos.index'])->syncRoles([$role0, $role1, $role2]);
        Permission::firstOrCreate(['name' => 'admin.memos.create'])->syncRoles([$role0, $role1]);
        Permission::firstOrCreate(['name' => 'admin.memos.edit'])->syncRoles([$role0, $role1]);
        Permission::firstOrCreate(['name' => 'admin.memos.show'])->syncRoles([$role0, $role1, $role2]);
        Permission::firstOrCreate(['name' => 'admin.memos.destroy'])->syncRoles([$role0, $role1]);
        Permission::firstOrCreate(['name' => 'admin.memos.print'])->syncRoles([$role0, $role1]);

        Permission::firstOrCreate(['name' => 'admin.projects.index'])->syncRoles([$role0, $role1, $role2]);
        Permission::firstOrCreate(['name' => 'admin.projects.create'])->syncRoles([$role0, $role1]);
        Permission::firstOrCreate(['name' => 'admin.projects.edit'])->syncRoles([$role0, $role1]);
        Permission::firstOrCreate(['name' => 'admin.projects.show'])->syncRoles([$role0, $role1, $role2]);
        Permission::firstOrCreate(['name' => 'admin.projects.destroy'])->syncRoles([$role0, $role1]);

        Permission::firstOrCreate(['name' => 'admin.national_assets.index'])->syncRoles([$role0, $role1, $role2]);
        Permission::firstOrCreate(['name' => 'admin.national_assets.create'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.national_assets.edit'])->syncRoles([$role0,]);
        Permission::firstOrCreate(['name' => 'admin.national_assets.show'])->syncRoles([$role0, $role1, $role2]);
        Permission::firstOrCreate(['name' => 'admin.national_assets.destroy'])->syncRoles([$role0]);

        Permission::firstOrCreate(['name' => 'admin.components.index'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.components.create'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.components.edit'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.components.destroy'])->syncRoles([$role0]);

        Permission::firstOrCreate(['name' => 'admin.tools.index'])->syncRoles([$role0, $role1, $role2]);
        Permission::firstOrCreate(['name' => 'admin.tools.create'])->syncRoles([$role0, $role1]);
        Permission::firstOrCreate(['name' => 'admin.tools.edit'])->syncRoles([$role0, $role1]);
        Permission::firstOrCreate(['name' => 'admin.tools.destroy'])->syncRoles([$role0]);

        //Permisos del area para departamentos
        Permission::firstOrCreate(['name' => 'admin.departments.index'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.departments.create'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.departments.edit'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.departments.destroy'])->syncRoles([$role0]);

        Permission::firstOrCreate(['name' => 'admin.categories.index'])->syncRoles([$role0, $role1]);
        Permission::firstOrCreate(['name' => 'admin.categories.create'])->syncRoles([$role0, $role1,]);
        Permission::firstOrCreate(['name' => 'admin.categories.edit'])->syncRoles([$role0, $role1]);
        Permission::firstOrCreate(['name' => 'admin.categories.destroy'])->syncRoles([$role0]);

        Permission::firstOrCreate(['name' => 'admin.classifications.index'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.classifications.create'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.classifications.edit'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.classifications.destroy'])->syncRoles([$role0]);

        Permission::firstOrCreate(['name' => 'admin.managers.index'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.managers.create'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.managers.edit'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.managers.destroy'])->syncRoles([$role0]);

        Permission::firstOrCreate(['name' => 'admin.users.index'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.users.create'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.users.edit'])->syncRoles([$role0]);
        Permission::firstOrCreate(['name' => 'admin.users.destroy'])->syncRoles([$role0]);
    }
}
