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
        Schema::table('saf_traslado', function (Blueprint $table) {
            $table->foreign(['recurso_id'])->references(['id_recurso'])->on('saf_recurso')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['tipo_traslado_id'])->references(['id_tipo_traslado'])->on('saf_tipo_traslado')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['ubicacion_destino_id'])->references(['id_ubicacion'])->on('saf_ubicacion')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['ubicacion_origen_id'])->references(['id_ubicacion'])->on('saf_ubicacion')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saf_traslado', function (Blueprint $table) {
            $table->dropForeign('saf_traslado_recurso_id_foreign');
            $table->dropForeign('saf_traslado_tipo_traslado_id_foreign');
            $table->dropForeign('saf_traslado_ubicacion_destino_id_foreign');
            $table->dropForeign('saf_traslado_ubicacion_origen_id_foreign');
        });
    }
};
