<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('clients', function (Blueprint $table) {
        $table->id();
        $table->string('rut_empresa', 20);
        $table->string('rubro', 255);
        $table->string('razon_social', 255);
        $table->string('telefono', 20)->nullable();
        $table->string('direccion', 255)->nullable();
        $table->string('nombre_contacto', 255);
        $table->string('email_contacto', 255);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('clients');
}
};