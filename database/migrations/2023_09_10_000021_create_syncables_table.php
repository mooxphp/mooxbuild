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
        Schema::create('syncables', function (Blueprint $table) {
            $table->unsignedBigInteger('platform_id');
            $table->unsignedBigInteger('platformable_id');
            $table->string('platformable_type');

            $table->index('platformable_id');
            $table->index('platformable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syncables');
    }
};
