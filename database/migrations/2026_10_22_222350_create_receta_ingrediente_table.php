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
        Schema::create('receta_ingrediente', function (Blueprint $table) {
    $table->id();
    $table->foreignId('receta_id')->constrained('recetas')->onDelete('cascade');
    $table->foreignId('ingrediente_id')->constrained('ingredientes')->onDelete('cascade');
    $table->decimal('cantidad', 8, 2);
    $table->string('unidad_medida');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receta_ingrediente');
    }
};
