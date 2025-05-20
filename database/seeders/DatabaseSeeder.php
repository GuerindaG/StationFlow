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
        Categorie::firstOrCreate(
            [
                'nom' => 'Produits blancs',
                'description' => 'qfghgldjkh'
            ],
        );
        Categorie::firstOrCreate(
            [
                'nom' => 'Lubrifiants',
                'description' => 'qfghgldjkh'
            ],
        );
        Categorie::firstOrCreate(
            [
                'nom' => 'Gaz et accessoires',
                'description' => 'qfghgldjkh'
            ],
        );
        // Exemple de récupération des ID de catégorie selon leur nom
        $carburantId = Categorie::where('nom', 'Produits blancs')->value('id'); // exemple
        $gazId = Categorie::where('nom', 'Gaz et accessoires')->value('id'); // si elle existe
        $lubrifiantId = Categorie::where('nom', 'Lubrifiants')->value('id'); // si elle existe

        $produits = [
            [
                'nom' => 'Essence',
                'description' => 'Carburant pour véhicules à essence',
                'categorie_id' => $carburantId,
                'prix_unitaire' => 700,
            ],
            [
                'nom' => 'Gazoil',
                'description' => 'Carburant pour moteurs diesel',
                'categorie_id' => $carburantId,
                'prix_unitaire' => 650,
            ],
            [
                'nom' => '3kg',
                'description' => 'Bouteille de gaz 3kg',
                'categorie_id' => $gazId,
                'prix_unitaire' => 2500,
            ],
            [
                'nom' => '6kg',
                'description' => 'Bouteille de gaz 6kg',
                'categorie_id' => $gazId,
                'prix_unitaire' => 5000,
            ],
            [
                'nom' => '9kg',
                'description' => 'Bouteille de gaz 9kg',
                'categorie_id' => $gazId,
                'prix_unitaire' => 8000,
            ],
            [
                'nom' => 'FAT1',
                'description' => 'Produit spécial FAT1',
                'categorie_id' => $carburantId,
                'prix_unitaire' => 1000,
            ],
        ];

        // Ajouter les lubrifiants 1 à 10
        for ($i = 1; $i <= 10; $i++) {
            $produits[] = [
                'nom' => "Lubrifiant $i",
                'description' => "Lubrifiant moteur type $i",
                'categorie_id' => $lubrifiantId,
                'prix_unitaire' => 1200 + ($i * 100),
            ];
        }

        foreach ($produits as $data) {
            Produit::firstOrCreate(
                ['nom' => $data['nom']],
                [
                    'description' => $data['description'],
                    'categorie_id' => $data['categorie_id'],
                    'prix_unitaire' => $data['prix_unitaire'],
                ]
            );
        }

    }

}
