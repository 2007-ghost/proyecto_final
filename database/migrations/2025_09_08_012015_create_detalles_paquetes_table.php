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
        Schema::create('detalles_paquetes', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->foreignId('paquete_id')
                ->constrained('paquetes')
                ->cascadeOnDelete();

            $table->foreignId('tipo_mercancia_id')
                ->constrained('tipo_mercancia')
                ->restrictOnDelete();

            // Atributos adicionales
            $table->string('dimension', 45);
            $table->string('peso', 45);
            $table->date('fecha_entrega');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_paquetes');
    }
};
