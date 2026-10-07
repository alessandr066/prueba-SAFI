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
        Schema::create('saf_solicitud_peticion', function (Blueprint $table) {
            $table->bigIncrements('id_solicitud');
            $table->string('numero', 191)->unique();
            $table->date('fecha_peticion');
            $table->string('entidad');
            $table->string('tipo_peticion');
            $table->string('responsable');
            $table->text('descripcion');
            $table->string('estado')->default('Pendiente');
            $table->string('archivo')->nullable();
            $table->unsignedBigInteger('usuario_id')->index('saf_solicitud_peticion_usuario_id_foreign');
            $table->timestamps();
            $table->text('observacion_inicial')->nullable();
            $table->text('observacion_revision')->nullable();
            $table->unsignedBigInteger('jefe_id')->nullable();
            $table->unsignedBigInteger('decano_id')->nullable();

            $table->text('observacion_jefe')->nullable();
            $table->text('observacion_decano')->nullable();

            $table->timestamp('fecha_revision_jefe')->nullable();
            $table->timestamp('fecha_revision_decano')->nullable();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saf_solicitud_peticion');
    }
};
