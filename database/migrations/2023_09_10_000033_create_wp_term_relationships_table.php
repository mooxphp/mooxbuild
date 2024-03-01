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
        Schema::create('wp_term_relationships', function (Blueprint $table) {
            $table->bigIncrements('object_id');
            $table->unsignedBigInteger('term_taxonomy_id');
            $table->integer('term_order');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wp_term_relationships');
    }
};
