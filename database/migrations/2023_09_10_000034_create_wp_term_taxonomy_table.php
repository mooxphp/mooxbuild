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
        Schema::create('wp_term_taxonomy', function (Blueprint $table) {
            $table->bigIncrements('term_taxonomy_id');
            $table->unsignedBigInteger('term_id')->default(0);
            $table->string('taxonomy', 32);
            $table->longText('description');
            $table->unsignedBigInteger('parent')->default(0);
            $table->bigInteger('count')->default(0);

            $table->index('taxonomy');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wp_term_taxonomy');
    }
};
