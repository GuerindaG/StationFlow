<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('rccm')->nullable();
            $table->string('ifu')->nullable();
            $table->string('adresse');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('contact')->nullable();
            $table->enum('statut', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('gerant_id');
            $table->timestamps();

            $table->foreign('gerant_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
