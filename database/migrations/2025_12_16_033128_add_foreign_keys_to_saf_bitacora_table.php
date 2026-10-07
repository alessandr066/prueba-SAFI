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
        Schema::table('saf_bitacora', function (Blueprint $table) {
            $table->foreign(['accion_id'], 'fk_bitacora_accion')->references(['id_accion'])->on('saf_accion')->onUpdate('no action')->onDelete('set null');
            $table->foreign(['usuario_id'], 'fk_bitacora_usuario')->references(['id_usuario'])->on('saf_usuario')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saf_bitacora', function (Blueprint $table) {
            $table->dropForeign('fk_bitacora_accion');
            $table->dropForeign('fk_bitacora_usuario');
        });
    }
};
