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
        Schema::table('saf_usuario', function (Blueprint $table) {
            $table->foreign(['cargo_id'])->references(['id_cargo'])->on('saf_cargo')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['empleado_id'])->references(['id_empleado'])->on('saf_empleado')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['rol_id'])->references(['id_rol'])->on('saf_rol')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saf_usuario', function (Blueprint $table) {
            $table->dropForeign('saf_usuario_cargo_id_foreign');
            $table->dropForeign('saf_usuario_empleado_id_foreign');
            $table->dropForeign('saf_usuario_rol_id_foreign');
        });
    }
};
