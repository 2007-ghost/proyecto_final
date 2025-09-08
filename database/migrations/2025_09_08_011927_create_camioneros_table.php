<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('camioneros', function (Blueprint $table) {
            $table->id();
            $table->string('documento', 10)->unique();
            $table->string('nombre', 45);
            $table->string('apellido', 45);
            $table->date('fecha_nacimiento');
            $table->string('licencia', 10)->unique();
            $table->string('telefono', 15);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('camioneros');
    }
};
