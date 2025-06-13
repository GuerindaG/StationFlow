<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id')->constrained()->onDelete('cascade');
            $table->foreignId('produit_id')->constrained()->onDelete('cascade');
            $table->decimal('qte_actuelle', 10, 2)->default(0);
            $table->timestamps();

            // S'assurer qu'il n'y a qu'une seule entrée de stock par produit et par station
            $table->unique(['station_id', 'produit_id']);
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
