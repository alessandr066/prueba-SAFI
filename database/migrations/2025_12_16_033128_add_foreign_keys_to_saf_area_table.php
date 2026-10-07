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
        Schema::table('saf_area', function (Blueprint $table) {
            $table->foreign(['tipo_area_id'])->references(['id_tipo_area'])->on('saf_tipo_area')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['ubicacion_id'])->references(['id_ubicacion'])->on('saf_ubicacion')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saf_area', function (Blueprint $table) {
            $table->dropForeign('saf_area_tipo_area_id_foreign');
            $table->dropForeign('saf_area_ubicacion_id_foreign');
        });
    }
};
