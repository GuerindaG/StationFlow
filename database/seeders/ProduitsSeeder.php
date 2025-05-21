<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Database\Seeder;

class ProduitsSeeder extends Seeder
{
    public function run()
    {
        // Récupération ou création des catégories
        $ProduitBlancsId = Categorie::firstOrCreate(
            ['nom' => 'Produits blancs'],
            ['description' => 'Produits carburants pour moteurs et mécanismes']
        )->id;
        $lubrifiantId = Categorie::firstOrCreate(
            ['nom' => 'Lubrifiants'],
            ['description' => 'Produits lubrifiants pour moteurs et mécanismes']
        )->id;

        $gazId = Categorie::firstOrCreate(
            ['nom' => 'Gaz et accessoires'],
            ['description' => 'Recharges de gaz et équipements associés']
        )->id;

        $ProduitBlancs = [
            [
                'nom' => 'Essence',
                'prix_achat' => 750,
                'prix_vente' => 650,
                'viscosite' => 'Essence',
                'categorie_id' => $ProduitBlancsId
            ],
            [
                'nom' => 'Gasoil',
                'prix_achat' => 650,
                'prix_vente' => 750,
                'viscosite' => 'Gasoil',
                'categorie_id' => $ProduitBlancsId
            ],
        ];

        $lubrifiants = [
            [
                'nom' => 'INJECTOR ESS',
                'prix_achat' => 4250,
                'prix_vente' => 5000,
                'viscosite' => 'Ess',
                'categorie_id' => $lubrifiantId
            ],
            [
                'nom' => 'INJECTOR GAS',
                'prix_achat' => 4250,
                'prix_vente' => 5000,
                'viscosite' => 'Gas',
                'categorie_id' => $lubrifiantId
            ],
            [
                'nom' => 'VUL 660X (30L)',
                'prix_achat' => 70000,
                'prix_vente' => 75000,
                'viscosite' => '15w40',
                'categorie_id' => $lubrifiantId
            ],
            [
                'nom' => 'Vul HD50 (5L)',
                'prix_achat' => 15325,
                'prix_vente' => 17500,
                'viscosite' => null,
                'categorie_id' => $lubrifiantId
            ],
            [
                'nom' => 'Vul HD40 (5L)',
                'prix_achat' => 15475,
                'prix_vente' => 17500,
                'viscosite' => null,
                'categorie_id' => $lubrifiantId
            ],
            [
                'nom' => 'VULCAN GREEN (5L)',
                'prix_achat' => 21250,
                'prix_vente' => 25000,
                'viscosite' => null,
                'categorie_id' => $lubrifiantId
            ],
            [
                'nom' => 'Prot ultra+ (4L)',
                'prix_achat' => 13720,
                'prix_vente' => 16000,
                'viscosite' => '10w40',
                'categorie_id' => $lubrifiantId
            ],
            [
                'nom' => 'Protec flex (4L)',
                'prix_achat' => 22000,
                'prix_vente' => 25000,
                'viscosite' => '5w30',
                'categorie_id' => $lubrifiantId
            ],
        ];

        $produitsGaz = [
            [
                'nom' => 'Recharge de 12,5 kg',
                'prix_achat' => 9725,
                'prix_vente' => 10000,
                'viscosite' => null,
                'categorie_id' => $gazId
            ],
            [
                'nom' => 'Recharge de 06 kg',
                'prix_achat' => 4370,
                'prix_vente' => 4500,
                'viscosite' => null,
                'categorie_id' => $gazId
            ],
            [
                'nom' => 'Tuyaux 1,5 cm',
                'prix_achat' => 1100,
                'prix_vente' => 1400,
                'viscosite' => null,
                'categorie_id' => $gazId
            ],
            [
                'nom' => 'Detendeur 12,5 kg sans logo',
                'prix_achat' => 3250,
                'prix_vente' => 3500,
                'viscosite' => null,
                'categorie_id' => $gazId
            ],
            [
                'nom' => 'Supports SL',
                'prix_achat' => 4800,
                'prix_vente' => 5000,
                'viscosite' => null,
                'categorie_id' => $gazId
            ],
        ];

        // Fusion des tableaux de produits
        $tousProduits = array_merge($lubrifiants, $produitsGaz,$ProduitBlancs);

        // Insertion des produits
        foreach ($tousProduits as $produit) {
            Produit::firstOrCreate(
                ['nom' => $produit['nom']],
                $produit
            );
        }

        $this->command->info(count($tousProduits) . ' produits JNP ont été créés avec succès.');
    }
}