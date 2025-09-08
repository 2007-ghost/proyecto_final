<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('camioneros_camiones', function (Blueprint $table) {
            $table->unsignedBigInteger('camionero_id');
            $table->unsignedBigInteger('camion_id');

            $table->primary(['camionero_id', 'camion_id']);
            $table->foreign('camionero_id')->references('id')->on('camioneros')->onDelete('cascade');
            $table->foreign('camion_id')->references('id')->on('camiones')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('camioneros_camiones');
    }
};
