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
        Schema::create('saf_bitacora', function (Blueprint $table) {
            $table->bigIncrements('id_bitacora');
            $table->unsignedBigInteger('usuario_id')->index('saf_bitacora_usuario_id_foreign');
            $table->unsignedBigInteger('accion_id')->nullable()->index('saf_bitacora_accion_id_foreign');
            $table->unsignedBigInteger('registro_id')->nullable()->index();
            $table->dateTime('fecha')->useCurrent();
            $table->string('ip', 45)->nullable();
            $table->string('modulo')->nullable();
            $table->longText('datos_anteriores')->nullable();
            $table->longText('datos_nuevos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saf_bitacora');
    }
};
