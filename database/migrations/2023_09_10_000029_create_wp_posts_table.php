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
        Schema::create('wp_posts', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->unsignedBigInteger('post_author')->default(0);
            $table->dateTime('post_date')->default('0000-00-00 00:00:00');
            $table->dateTime('post_date_gmt')->default('0000-00-00 00:00:00');
            $table->longText('post_content');
            $table->text('post_title');
            $table->text('post_excerpt');
            $table->string('post_status', 20)->default('publish');
            $table->string('comment_status', 20)->default('open');
            $table->string('ping_status', 20)->default('open');
            $table->string('post_password');
            $table->string('post_name', 200);
            $table->text('to_ping');
            $table->text('pinged');
            $table->dateTime('post_modified')->default('0000-00-00 00:00:00');
            $table
                ->dateTime('post_modified_gmt')
                ->default('0000-00-00 00:00:00');
            $table->longText('post_content_filtered');
            $table->unsignedBigInteger('post_parent')->default(0);
            $table->string('guid');
            $table->integer('menu_order')->default(0);
            $table->string('post_type', 20)->default('post');
            $table->string('post_mime_type', 100);
            $table->bigInteger('comment_count')->default(0);

            $table->index('post_author');
            $table->index('post_name');
            $table->index('post_parent');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wp_posts');
    }
};
