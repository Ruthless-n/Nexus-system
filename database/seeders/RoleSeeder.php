<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $gestor = Role::create(['name' => 'gestor']);
        $colaborador = Role::create(['name' => 'colaborador']);

        Permission::create(['name' => 'ver relatorios']);
        Permission::create(['name' => 'gerenciar unidades']);
        Permission::create(['name' => 'gerenciar colaboradores']);

        $admin->givePermissionTo(Permission::all());
        $gestor->givePermissionTo(['gerenciar unidades', 'gerenciar colaboradores']);
    }
}
