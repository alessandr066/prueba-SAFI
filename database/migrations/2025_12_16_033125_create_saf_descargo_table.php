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
        Schema::create('saf_descargo', function (Blueprint $table) {
            $table->bigIncrements('id_descargo');
            $table->unsignedBigInteger('recurso_id')->index('saf_descargo_recurso_id_foreign');
            $table->unsignedBigInteger('tipo_descargo_id')->index('saf_descargo_tipo_descargo_id_foreign');
            $table->date('fecha');
            $table->text('motivo')->nullable();
            $table->timestamps();
            $table->text('observaciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saf_descargo');
    }
};
