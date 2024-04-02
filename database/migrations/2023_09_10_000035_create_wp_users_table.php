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
        Schema::create('wp_users', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('user_login', 60);
            $table->string('user_pass');
            $table->string('user_nicename', 50);
            $table->string('user_email', 100);
            $table->string('user_url', 100);
            $table->dateTime('user_registered');
            $table->string('user_activation_key');
            $table->integer('user_status')->default(0);
            $table->string('display_name');
            $table->boolean('spam')->default(0);
            $table->boolean('deleted')->default(0);

            $table->index('user_login');
            $table->index('user_nicename');
            $table->index('user_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wp_users');
    }
};
