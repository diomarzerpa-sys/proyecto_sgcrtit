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
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            // Columnas para almacenar los IDs de clasificación
            // Es buena práctica usar 'unsignedBigInteger' si la clave primaria es 'bigIncrements' (que es lo que hace $table->id())
            $table->unsignedBigInteger('motherboard_id')->nullable(); // nullables si un componente no es obligatorio
            $table->string('mac_address')->nullable();
            $table->unsignedBigInteger('processor_id')->nullable();
            $table->string('ram')->nullable();
            $table->unsignedBigInteger('harddisk_id')->nullable();
            $table->unsignedBigInteger('video_card_id')->nullable();
            $table->unsignedBigInteger('audio_card_id')->nullable();
            $table->json('sos')->nullable();
            $table->json('ofimatics')->nullable();
            $table->json('navegators')->nullable();

            // Definir las claves foráneas
            // onDelete('set null') es útil si quieres que los componentes queden sin clasificación si esta se elimina
            // o onDelete('cascade') si quieres que los componentes se eliminen si su clasificación padre es eliminada
            $table->foreign('motherboard_id')->references('id')->on('classifications')->onDelete('RESTRICT');
            $table->foreign('processor_id')->references('id')->on('classifications')->onDelete('RESTRICT');
            $table->foreign('harddisk_id')->references('id')->on('classifications')->onDelete('RESTRICT');
            $table->foreign('video_card_id')->references('id')->on('classifications')->onDelete('RESTRICT');
            $table->foreign('audio_card_id')->references('id')->on('classifications')->onDelete('RESTRICT');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
