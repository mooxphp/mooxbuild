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
        Schema::create('wp_commentmeta', function (Blueprint $table) {
            $table->bigIncrements('meta_id');
            $table->unsignedBigInteger('comment_id')->default(0);
            $table->string('meta_key');
            $table->longText('meta_value');

            $table->index('comment_id');
            $table->index('meta_key');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wp_commentmeta');
    }
};
