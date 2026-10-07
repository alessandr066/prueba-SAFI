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
        Schema::table('saf_solicitud_peticion', function (Blueprint $table) {
            $table->foreign(['usuario_id'])->references(['id_usuario'])->on('saf_usuario')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saf_solicitud_peticion', function (Blueprint $table) {
            $table->dropForeign('saf_solicitud_peticion_usuario_id_foreign');
        });
    }
};
