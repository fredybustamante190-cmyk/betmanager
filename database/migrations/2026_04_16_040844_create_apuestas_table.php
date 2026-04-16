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
    Schema::create('apuestas', function (Blueprint $table) {
        $table->id();
        $table->string('nombre_apuesta');
        $table->string('tipo_apuesta');
        $table->decimal('monto', 10, 2);
        $table->date('fecha_apuesta');
        $table->string('estado')->default('pendiente');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::dropIfExists('apuestas');
}
};
