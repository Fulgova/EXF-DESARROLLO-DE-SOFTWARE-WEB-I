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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Identificador único
            $table->string('sku')->unique(); // Código SKU único
            $table->string('nombre');
            $table->string('descripcion_corta', 255)->nullable();
            $table->text('descripcion_larga')->nullable();
            $table->string('imagen')->nullable(); // URL de la imagen
            $table->decimal('precio_neto', 10, 2); // precio sin impuestos
            $table->decimal('precio_venta', 10, 2); // precio con IVA (19%)
            $table->integer('stock_actual')->default(0);
            $table->integer('stock_minimo')->default(0);
            $table->integer('stock_bajo')->default(0);
            $table->integer('stock_alto')->default(0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};