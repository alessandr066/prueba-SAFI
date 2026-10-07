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
        Schema::create('saf_empleado', function (Blueprint $table) {
            $table->bigIncrements('id_empleado');
            $table->string('nombres');
            $table->string('apellidos');
            $table->unsignedBigInteger('cargo_id')->index('saf_empleado_cargo_id_foreign');
            $table->unsignedBigInteger('estado_id')->index('saf_empleado_estado_id_foreign');
            $table->date('fecha_ingreso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saf_empleado');
    }
};
