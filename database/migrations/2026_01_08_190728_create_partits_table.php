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
        Schema::create('partits', function (Blueprint $table) {
            $table->id();
            // Relaciones con equipos (local y visitante)
            $table->foreignId('local_id')->constrained('equips');
            $table->foreignId('visitant_id')->constrained('equips');
            // Relación con estadi
            $table->foreignId('estadi_id')->constrained('estadis');
            
            $table->dateTime('data');
            $table->integer('jornada');
            $table->integer('gols_local')->default(0);
            $table->integer('gols_visitant')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partits');
    }
};
