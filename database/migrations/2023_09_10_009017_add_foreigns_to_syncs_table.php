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
        Schema::table('syncs', function (Blueprint $table) {
            $table
                ->foreign('source_platform_id')
                ->references('id')
                ->on('platforms')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('target_platform_id')
                ->references('id')
                ->on('platforms')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('syncs', function (Blueprint $table) {
            $table->dropForeign(['source_platform_id']);
            $table->dropForeign(['target_platform_id']);
        });
    }
};
