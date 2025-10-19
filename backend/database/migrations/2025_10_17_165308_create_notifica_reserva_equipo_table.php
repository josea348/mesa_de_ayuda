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
        Schema::create('notificacion_reserva_equipo', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('comentario');
            $table->unsignedBigInteger('res_equipo_id');
            $table->timestamps();

            $table->foreign('res_equipo_id')->references('id')->on('reservas_equipo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacion_reserva_equipo');
    }
};
