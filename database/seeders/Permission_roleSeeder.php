<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\Permission_role;
use app\Models\Role;
use app\Models\Permission;

class Permission_roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $adminRole = Role::where('name', 'admin')->first();
    $gestionnaireRole = Role::where('name', 'gerant')->first();

    $adminPermissions = Permission::all(); // L'administrateur aura toutes les permissions
    $gestionnairePermissions = Permission::whereIn('name', ['voir_rapport'])->get(); // Permissions spécifiques pour gestionnaire

    $adminRole->permissions()->sync($adminPermissions);
    $gestionnaireRole->permissions()->sync($gestionnairePermissions);
}
}
