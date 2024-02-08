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
        Schema::table('content_elements', function (Blueprint $table) {
            $table
                ->foreign('theme_id')
                ->references('id')
                ->on('themes')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('content_elements', function (Blueprint $table) {
            $table->dropForeign(['theme_id']);
        });
    }
};
