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
        Schema::create('wp_terms', function (Blueprint $table) {
            $table->bigIncrements('term_id');
            $table->string('name', 200);
            $table->string('slug', 200);
            $table->bigInteger('term_group')->default(0);

            $table->index('name');
            $table->index('slug');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wp_terms');
    }
};
