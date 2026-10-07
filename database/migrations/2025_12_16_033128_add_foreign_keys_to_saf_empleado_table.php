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
        Schema::table('saf_empleado', function (Blueprint $table) {
            $table->foreign(['cargo_id'])->references(['id_cargo'])->on('saf_cargo')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['estado_id'])->references(['id_estado'])->on('saf_estado')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saf_empleado', function (Blueprint $table) {
            $table->dropForeign('saf_empleado_cargo_id_foreign');
            $table->dropForeign('saf_empleado_estado_id_foreign');
        });
    }
};
