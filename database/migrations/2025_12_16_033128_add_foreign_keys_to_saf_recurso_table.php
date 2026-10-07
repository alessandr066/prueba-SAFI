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
        Schema::table('saf_recurso', function (Blueprint $table) {
            $table->foreign(['empleado_asignado'])->references(['id_empleado'])->on('saf_empleado')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['estado_id'])->references(['id_estado'])->on('saf_estado')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['producto_id'])->references(['id_producto'])->on('saf_producto')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['ubicacion_id'])->references(['id_ubicacion'])->on('saf_ubicacion')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saf_recurso', function (Blueprint $table) {
            $table->dropForeign('saf_recurso_empleado_asignado_foreign');
            $table->dropForeign('saf_recurso_estado_id_foreign');
            $table->dropForeign('saf_recurso_producto_id_foreign');
            $table->dropForeign('saf_recurso_ubicacion_id_foreign');
        });
    }
};
