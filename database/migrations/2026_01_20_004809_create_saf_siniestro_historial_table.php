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
        Schema::create('saf_siniestro_historial', function (Blueprint $table) {
            $table->id('id_historial');
            $table->unsignedBigInteger('siniestro_id');
            $table->unsignedBigInteger('usuario_id');
            $table->string('estado_anterior')->nullable();
            $table->string('estado_nuevo');
            $table->text('observacion')->nullable();
            $table->timestamps();

            $table->foreign('siniestro_id')
                ->references('id_siniestro')
                ->on('saf_siniestro')
                ->onDelete('cascade');

            $table->foreign('usuario_id')
                ->references('id_usuario')
                ->on('saf_usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saf_siniestro_historial');
    }
};
