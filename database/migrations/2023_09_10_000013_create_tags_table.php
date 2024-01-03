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
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('uid');
            $table->string('title');
            $table->string('slug');
            $table->text('content')->nullable();
            $table->json('data')->nullable();
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('weight')->nullable();
            $table->string('model')->nullable();
            $table->string('created_by_user_id');
            $table->string('created_by_user_name');
            $table->string('edited_by_user_id');
            $table->string('edited_by_user_name');
            $table->unsignedBigInteger('language_id')->nullable();
            $table->unsignedBigInteger('translation_id')->nullable();
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
