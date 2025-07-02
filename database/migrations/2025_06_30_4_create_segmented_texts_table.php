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
        Schema::create('segmented_texts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paper_id')->constrained();
            $table->string('original_segmented_text');
            $table->string('translated_segmented_text');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('segmented_texts');
    }
};
