<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockJournaliersTable extends Migration
{
    public function up(): void
    {
        Schema::create('stock_journaliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id')->constrained()->onDelete('cascade');
            $table->foreignId('produit_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->decimal('stock_finale', 10, 2)->default(0);
            $table->timestamps();

            $table->unique(['station_id', 'produit_id', 'date'], 'unique_stock_journalier');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_journaliers');
    }
}
