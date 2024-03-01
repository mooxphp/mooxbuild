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
        Schema::create('sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity');
            $table->unsignedBigInteger('user_id');

            $table->index('last_activity');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
