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
        Schema::create('national_assets', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('serial')->nullable();
            $table->string('typeNA');
            $table->foreignId('classification_id')->constrained()->onUpdate('cascade');
            $table->text('description')->nullable();
            $table->foreignId('department_id')->constrained()->onUpdate('cascade');
            $table->string('responsible_for_use');
            $table->string('status');
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('national_assets');
    }
};
