<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); // Identificador único
            $table->string('rut_empresa')->unique(); // Rut de la empresa
            $table->string('rubro'); // Giro o rubro de la empresa
            $table->string('razon_social'); // Razón social
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('nombre_contacto'); // Persona de contacto
            $table->string('email_contacto')->unique(); // Email de contacto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
