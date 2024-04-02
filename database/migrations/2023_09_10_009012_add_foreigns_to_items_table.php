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
        Schema::table('items', function (Blueprint $table) {
            $table
                ->foreign('main_category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('translation_id')
                ->references('id')
                ->on('items')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['main_category_id']);
            $table->dropForeign(['author_id']);
            $table->dropForeign(['translation_id']);
        });
    }
};
