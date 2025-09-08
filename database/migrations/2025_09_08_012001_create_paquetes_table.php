<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('paquetes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('camionero_id')->constrained('camioneros')->onDelete('cascade');
            $table->foreignId('estado_id')->constrained('estados_paquetes')->onDelete('restrict');
            $table->string('direccion', 100);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('paquetes');
    }
};
