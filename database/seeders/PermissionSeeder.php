<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Insérer les permissions
        Permission::create(['name' => 'voir_rapport']);
        Permission::create(['name' => 'edit_profile']);
        Permission::create(['name' => 'ajouter_produit']);
    }
}
