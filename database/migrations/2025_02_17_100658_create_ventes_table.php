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
            $table->id();                             
            $table->foreignId('station_id')->constrained()->onDelete('cascade');  
            $table->foreignId('produit_id')->constrained()->onDelete('cascade');  
            $table->decimal('quantite', 10, 2);       
            $table->decimal('montant_total', 10, 2);   
            $table->timestamps();                     
            $table->softDeletes();
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
