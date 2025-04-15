<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('approvisionnements', function (Blueprint $table) {
            $table->id();                             // Identifiant unique de l'approvisionnement
            $table->foreignId('station_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la station
            $table->foreignId('produit_id')->constrained()->onDelete('cascade'); // Clé étrangère vers le produit
            $table->decimal('qte_appro', 10, 2);       // Quantité de produit approvisionnée
            $table->decimal('prix_unitaire', 10, 2);   // Prix unitaire du produit
            $table->decimal('montant_total', 10, 2);   // Montant total de l'approvisionnement
            $table->date('date_approvisionnement');    // Date de l'approvisionnement
            $table->timestamps();                     // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvisionnements');
    }
};
