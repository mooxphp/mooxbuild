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
        Schema::create('revisionables', function (Blueprint $table) {
            $table->unsignedBigInteger('revision_id');
            $table->unsignedBigInteger('revisionable_id');
            $table->string('revisionable_type');

            $table->index('revisionable_id');
            $table->index('revisionable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revisionables');
    }
};
