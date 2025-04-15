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
        Schema::create('stations', function (Blueprint $table) {
            $table->id();                         // auto-increment id
            $table->string('nom');                 // nom de la station
            $table->string('adresse');             // adresse de la station
            $table->string('type');                // type de station
            $table->double('latitude');            // latitude
            $table->double('longitude');           // longitude
            $table->string('statut')->default('active');  // statut de la station
            $table->date('dateCreation');          // date de création de la station
            $table->timestamps();                  // created_at, updated_at
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
