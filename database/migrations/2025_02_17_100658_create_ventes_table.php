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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();                             // Identifiant unique de la vente
            $table->foreignId('station_id')->constrained()->onDelete('cascade');  // Clé étrangère vers la station
            $table->foreignId('produit_id')->constrained()->onDelete('cascade');  // Clé étrangère vers le produit
            $table->decimal('quantite', 10, 2);       // Quantité du produit vendu
            $table->decimal('montant_total', 10, 2);   // Montant total de la vente (quantité * prix)
            $table->date('date_vente');                // Date de la vente
            $table->timestamps();                     // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
