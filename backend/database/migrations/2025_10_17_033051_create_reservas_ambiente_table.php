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
        Schema::create('reservas_ambiente', function (Blueprint $table) {
            $table->id();
            $table->integer('usuario_id');
            $table->unsignedBigInteger('ambiente_id');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->enum('estado', ['Pendiente','Confirmado','Cancelada','completada']);
            $table->timestamps();

            $table->foreign('usuario_id')->references('identificacion')->on('users')->onDelete('cascade');
            $table->foreign('ambiente_id')->references('id')->on('ambiente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas_ambiente');
    }
};
