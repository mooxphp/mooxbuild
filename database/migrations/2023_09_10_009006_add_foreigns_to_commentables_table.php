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
        Schema::table('commentables', function (Blueprint $table) {
            $table
                ->foreign('comment_id')
                ->references('id')
                ->on('comments')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commentables', function (Blueprint $table) {
            $table->dropForeign(['comment_id']);
        });
    }
};
