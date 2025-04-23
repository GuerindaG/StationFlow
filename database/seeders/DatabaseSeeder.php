<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class DatabaseSeeder extends Seeder
{
    public function run() 
    {
        User::firstOrCreate(
            ['email' => 'guerindagohoue@gmail.com'],
            [
                'name' => 'Administrateur',
                'telephone'=> '0190388922',
                'password' => Hash::make('Gg242502**'),
                'role' => 'admin',
            ]
        );
    }
    
}
