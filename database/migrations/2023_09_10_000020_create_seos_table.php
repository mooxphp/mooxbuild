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
        Schema::create('seos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seoable_id');
            $table->string('seoable_type');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('twitter_card')->nullable();
            $table->string('twitter_site')->nullable();
            $table->string('twitter_creator')->nullable();
            $table->json('schema_markup')->nullable();
            $table->string('breadcrumb_title')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('redirect_url')->nullable();
            $table->json('focus_keyphrases')->nullable();
            $table->string('focus_keyphrase')->nullable();
            $table->json('seo_scores')->nullable();
            $table->decimal('seo_score')->nullable();
            $table->decimal('readability_score')->nullable();
            $table->string('fav_icon')->nullable();
            $table->string('app_icon')->nullable();
            $table->string('app_color')->nullable();
            $table->json('web_manifest')->nullable();
            $table->boolean('noindex')->nullable();
            $table->boolean('nofollow')->nullable();

            $table->index('seoable_id');
            $table->index('seoable_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
