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
        Schema::create('saf_mantenimiento', function (Blueprint $table) {
            $table->bigIncrements('id_mantenimiento');
            $table->unsignedBigInteger('recurso_id')->index('saf_mantenimiento_recurso_id_foreign');
            $table->unsignedBigInteger('tipo_mantenimiento_id');
            $table->unsignedBigInteger('tecnico_id')->index('saf_mantenimiento_tecnico_id_foreign');
            $table->text('descripcion')->nullable();
            $table->date('fecha');
            $table->timestamps();
            $table->string('estado', 20)->default('pendiente');
            $table->date('fecha_fin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saf_mantenimiento');
    }
};
