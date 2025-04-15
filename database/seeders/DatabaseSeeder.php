<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Permission;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Appeler les seeders dédiés pour les rôles et les permissions
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}
