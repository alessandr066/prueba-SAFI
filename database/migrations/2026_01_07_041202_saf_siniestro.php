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
        Schema::create('saf_siniestro', function (Blueprint $table) {
            $table->bigIncrements('id_siniestro');

            $table->unsignedBigInteger('recurso_id');
            $table->date('fecha_siniestro');
            $table->string('tipo'); // Daño, Robo, Pérdida, Destrucción
            $table->text('descripcion');

            $table->string('estado')->default('Pendiente');
            // Pendiente, En revisión, Devuelto, En revisión decano, Aprobado, Rechazado

            $table->text('observacion_revision')->nullable();
            $table->string('archivo')->nullable();

            $table->unsignedBigInteger('usuario_id'); // quien reporta
            $table->timestamps();

            $table->foreign('recurso_id')->references('id_recurso')->on('saf_recurso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
