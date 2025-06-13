<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('stock_journaliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id')->constrained()->onDelete('cascade');
            $table->foreignId('produit_id')->constrained()->onDelete('cascade');
            $table->date('date'); // Date du jour pour lequel le stock est enregistré
            $table->decimal('stock_finale', 10, 2); // Stock à la fin de cette journée
            $table->timestamps();

            // S'assurer qu'il n'y a qu'une seule entrée d'historique de stock par produit, station et date
            $table->unique(['station_id', 'produit_id', 'date'], 'unique_daily_stock');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_journaliers');
    }
};
