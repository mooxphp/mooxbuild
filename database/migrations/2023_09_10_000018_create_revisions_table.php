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
        Schema::create('revisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('revname')->nullable();
            $table->text('revcomment')->nullable();
            $table->dateTime('revretention')->nullable();
            $table->unsignedBigInteger('uid');
            $table->unsignedBigInteger('main_category_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->text('short')->nullable();
            $table->text('content')->nullable();
            $table->json('data')->nullable();
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('language_id')->nullable();
            $table->unsignedBigInteger('translation_id')->nullable();
            $table->json('categories')->nullable();
            $table->json('tags')->nullable();
            $table->json('fields')->nullable();

            $table->index('uid');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revisions');
    }
};
