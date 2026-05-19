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
        $role1 = Role::create(['name' => 'Coord']);
        $role2 = Role::create(['name' => 'Normal']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$role0, $role1, $role2]);

        Permission::create(['name' => 'admin.staffs.index'])->syncRoles([$role0, $role1, $role2]);
        Permission::create(['name' => 'admin.staffs.create'])->syncRoles([$role0, $role1]);
        Permission::create(['name' => 'admin.staffs.edit'])->syncRoles([$role0, $role1]);
        Permission::create(['name' => 'admin.staffs.show'])->syncRoles([$role0, $role1, $role2]);
        Permission::create(['name' => 'admin.staffs.destroy'])->syncRoles([$role0, $role1]);

        Permission::create(['name' => 'admin.memos.index'])->syncRoles([$role0, $role1, $role2]);
        Permission::create(['name' => 'admin.memos.create'])->syncRoles([$role0, $role1]);
        Permission::create(['name' => 'admin.memos.edit'])->syncRoles([$role0, $role1]);
        Permission::create(['name' => 'admin.memos.show'])->syncRoles([$role0, $role1, $role2]);
        Permission::create(['name' => 'admin.memos.destroy'])->syncRoles([$role0, $role1]);
        Permission::create(['name' => 'admin.memos.print'])->syncRoles([$role0, $role1]);

        Permission::create(['name' => 'admin.projects.index'])->syncRoles([$role0, $role1, $role2]);
        Permission::create(['name' => 'admin.projects.create'])->syncRoles([$role0, $role1]);
        Permission::create(['name' => 'admin.projects.edit'])->syncRoles([$role0, $role1]);
        Permission::create(['name' => 'admin.projects.show'])->syncRoles([$role0, $role1, $role2]);
        Permission::create(['name' => 'admin.projects.destroy'])->syncRoles([$role0, $role1]);

        Permission::create(['name' => 'admin.national_assets.index'])->syncRoles([$role0, $role1, $role2]);
        Permission::create(['name' => 'admin.national_assets.create'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.national_assets.edit'])->syncRoles([$role0,]);
        Permission::create(['name' => 'admin.national_assets.show'])->syncRoles([$role0, $role1, $role2]);
        Permission::create(['name' => 'admin.national_assets.destroy'])->syncRoles([$role0]);

        Permission::create(['name' => 'admin.components.index'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.components.create'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.components.edit'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.components.destroy'])->syncRoles([$role0]);

        Permission::create(['name' => 'admin.tools.index'])->syncRoles([$role0, $role1, $role2]);
        Permission::create(['name' => 'admin.tools.create'])->syncRoles([$role0, $role1]);
        Permission::create(['name' => 'admin.tools.edit'])->syncRoles([$role0, $role1]);
        Permission::create(['name' => 'admin.tools.destroy'])->syncRoles([$role0]);

        //Permisos del area para departamentos
        Permission::create(['name' => 'admin.departments.index'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.departments.create'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.departments.edit'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.departments.destroy'])->syncRoles([$role0]);

        Permission::create(['name' => 'admin.categories.index'])->syncRoles([$role0, $role1]);
        Permission::create(['name' => 'admin.categories.create'])->syncRoles([$role0, $role1,]);
        Permission::create(['name' => 'admin.categories.edit'])->syncRoles([$role0, $role1]);
        Permission::create(['name' => 'admin.categories.destroy'])->syncRoles([$role0]);

        Permission::create(['name' => 'admin.classifications.index'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.classifications.create'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.classifications.edit'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.classifications.destroy'])->syncRoles([$role0]);

        Permission::create(['name' => 'admin.managers.index'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.managers.create'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.managers.edit'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.managers.destroy'])->syncRoles([$role0]);

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.users.create'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$role0]);
        Permission::create(['name' => 'admin.users.destroy'])->syncRoles([$role0]);
    }
}
