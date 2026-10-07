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
        Schema::table('saf_descargo', function (Blueprint $table) {
            $table->foreign(['recurso_id'])->references(['id_recurso'])->on('saf_recurso')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['tipo_descargo_id'])->references(['id_tipo_descargo'])->on('saf_tipo_descargo')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saf_descargo', function (Blueprint $table) {
            $table->dropForeign('saf_descargo_recurso_id_foreign');
            $table->dropForeign('saf_descargo_tipo_descargo_id_foreign');
        });
    }
};
