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
        Schema::table('saf_mantenimiento', function (Blueprint $table) {
            $table->foreign(['recurso_id'])->references(['id_recurso'])->on('saf_recurso')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['tecnico_id'])->references(['id_tecnico'])->on('saf_tecnico')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saf_mantenimiento', function (Blueprint $table) {
            $table->dropForeign('saf_mantenimiento_recurso_id_foreign');
            $table->dropForeign('saf_mantenimiento_tecnico_id_foreign');
        });
    }
};
