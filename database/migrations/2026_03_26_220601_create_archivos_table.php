<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');   // nombre del archivo guardado
            $table->date('fecha');      // fecha de subida
            $table->time('hora');       // hora de subida
            $table->timestamps();       // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archivos');
    }
};
