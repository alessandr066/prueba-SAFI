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
        Schema::create('saf_recurso', function (Blueprint $table) {
            $table->bigIncrements('id_recurso');
            $table->string('codigo', 100)->unique('codigo');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->date('fecha_ingreso');
            $table->unsignedBigInteger('producto_id')->index('saf_recurso_producto_id_foreign');
            $table->unsignedBigInteger('estado_id')->index('saf_recurso_estado_id_foreign');
            $table->unsignedBigInteger('ubicacion_id')->index('saf_recurso_ubicacion_id_foreign');
            $table->unsignedBigInteger('empleado_asignado')->index('saf_recurso_empleado_asignado_foreign');
            $table->date('fecha_adquisicion');
            $table->decimal('valor_recurso', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saf_recurso');
    }
};
