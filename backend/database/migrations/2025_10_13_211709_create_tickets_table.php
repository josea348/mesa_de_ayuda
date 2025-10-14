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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->unsignedBigInteger('categoria');
            $table->enum('prioridad', ['Baja', 'Media', 'Alta'])->default('Media');
            $table->enum('estado', ['Abierto', 'En progreso', 'Cerrado'])->default('Abierto');
            $table->integer('solicitante');
            $table->integer('asignado')->nullable();
            $table->timestamp('fechas')->useCurrent();
            $table->timestamp('fechas_actualizacion')->useCurrent()->useCurrentOnUpdate();

            // Relaciones opcionales (si las tienes)
            $table->foreign('categoria')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('solicitante')->references('identificacion')->on('users')->onDelete('cascade');
            $table->foreign('asignado')->references('identificacion')->on('users')->onDelete('set null');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
