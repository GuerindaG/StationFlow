<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Categorie;
use App\Models\Paiement;
use App\Models\Produit;
use App\Models\User;
use Carbon\Carbon;
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
                'name' => 'GOHOUE',
                'prenom' => 'Guérinda',
                'telephone' => '0190388922',
                'naissance' => Carbon::createFromFormat('d/m/Y', '25/02/2005')->format('Y-m-d'),
                'password' => Hash::make('Gg242502**'),
                'role' => User::ROLE_ADMIN
            ]
        );
        User::firstOrCreate(
            ['email' => 'ulrichdodji@gmail.com'],
            [
                'name' => 'ATROKPO',
                'prenom' => 'Ulrich',
                'telephone' => '0195458316',
                'naissance' => Carbon::createFromFormat('d/m/Y', '10/07/2005')->format('Y-m-d'),
                'password' => Hash::make('AET10072005'),
                'role' => User::ROLE_ADMIN
            ]
        );
        Paiement::firstOrCreate(
            ['nom' => 'Ticket Valeur'],
        );
        Paiement::firstOrCreate(
            ['nom' => 'JNP Pass'],
        );
        Paiement::firstOrCreate(
            ['nom' => 'Espèce'],
        );
        $this->call([
            ProduitsSeeder::class,
        ]);
    }

}
