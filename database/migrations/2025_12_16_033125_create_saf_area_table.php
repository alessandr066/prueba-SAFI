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
        Schema::create('saf_area', function (Blueprint $table) {
            $table->bigIncrements('id_area');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('tipo_area_id')->index('saf_area_tipo_area_id_foreign');
            $table->unsignedBigInteger('ubicacion_id')->index('saf_area_ubicacion_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saf_area');
    }
};
