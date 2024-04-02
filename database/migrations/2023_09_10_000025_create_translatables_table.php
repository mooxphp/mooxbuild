<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('translatables', function (Blueprint $table) {
            $table->unsignedBigInteger('translation_id');
            $table->unsignedBigInteger('translatable_id');
            $table->string('translatable_type');

            $table->index('translatable_id');
            $table->index('translatable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translatables');
    }
};
