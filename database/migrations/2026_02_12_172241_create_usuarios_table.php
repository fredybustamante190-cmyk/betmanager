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
    Schema::create('usuarios', function (Blueprint $table) {
        $table->increments('id_usuario');
        $table->string('nombre_usuario', 50);
        $table->string('password', 255);
        $table->timestamp('fecha_registro')->useCurrent();
        $table->integer('apuestas_id_apuestas')->nullable();
        $table->integer('bitacora_respaldos_id_respaldo')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
