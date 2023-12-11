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
        Schema::table('revisionables', function (Blueprint $table) {
            $table
                ->foreign('revision_id')
                ->references('id')
                ->on('revisions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('revisionables', function (Blueprint $table) {
            $table->dropForeign(['revision_id']);
        });
    }
};
