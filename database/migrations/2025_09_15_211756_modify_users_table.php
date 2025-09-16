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
        Schema::table('users', function (Blueprint $table) {
            //Campos solicitados
            $table->string('rut');
            $table->renameColumn('name', 'nombre');
            $table->string('apellido');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //Elimina los campos agregados
            $table->dropColumn(['rut', 'nombre', 'apellido']);
        });
    }
};