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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
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
            $table->string('created_by_user_id');
            $table->string('created_by_user_name');
            $table->string('edited_by_user_id');
            $table->string('edited_by_user_name');
            $table->unsignedBigInteger('language_id')->nullable();
            $table->unsignedBigInteger('translation_id')->nullable();
            $table->timestamp('published_at')->nullable();

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
        Schema::dropIfExists('posts');
    }
};
