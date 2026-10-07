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
        Schema::create('saf_usuario', function (Blueprint $table) {
            $table->bigIncrements('id_usuario');
            $table->unsignedBigInteger('empleado_id')->index('saf_usuario_empleado_id_foreign');
            $table->unsignedBigInteger('rol_id')->index('saf_usuario_rol_id_foreign');
            $table->string('username');
            $table->string('password');
            $table->unsignedBigInteger('cargo_id')->index('saf_usuario_cargo_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saf_usuario');
    }
};
