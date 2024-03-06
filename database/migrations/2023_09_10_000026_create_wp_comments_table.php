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
        Schema::create('wp_comments', function (Blueprint $table) {
            $table->bigIncrements('comment_ID');
            $table->unsignedBigInteger('comment_post_ID')->default(0);
            $table->text('comment_author');
            $table->string('comment_author_email');
            $table->string('comment_author_url');
            $table->string('comment_author_IP');
            $table->dateTime('comment_date');
            $table->dateTime('comment_date_gmt');
            $table->text('comment_content');
            $table->integer('comment_karma')->default(0);
            $table->string('comment_approved')->default('1');
            $table->string('comment_agent');
            $table->string('comment_type')->default('comment');
            $table->unsignedBigInteger('comment_parent')->default(0);
            $table->unsignedBigInteger('user_id')->default(0);

            $table->index('comment_post_ID');
            $table->index('comment_author_email');
            $table->index('comment_parent');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wp_comments');
    }
};
