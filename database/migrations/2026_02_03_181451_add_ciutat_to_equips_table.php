<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('equips', function (Blueprint $table) {
            $table->string('ciutat')->after('nom'); // Añade la columna después del nombre
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equips', function (Blueprint $table) {
            //
        });
    }
};
