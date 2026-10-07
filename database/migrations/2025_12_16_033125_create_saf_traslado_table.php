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
        Schema::create('saf_traslado', function (Blueprint $table) {
            $table->bigIncrements('id_traslado');
            $table->unsignedBigInteger('recurso_id')->index('saf_traslado_recurso_id_foreign');
            $table->unsignedBigInteger('tipo_traslado_id')->index('saf_traslado_tipo_traslado_id_foreign');
            $table->date('fecha');
            $table->unsignedBigInteger('ubicacion_origen_id')->index('saf_traslado_ubicacion_origen_id_foreign');
            $table->unsignedBigInteger('ubicacion_destino_id')->index('saf_traslado_ubicacion_destino_id_foreign');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saf_traslado');
    }
};
