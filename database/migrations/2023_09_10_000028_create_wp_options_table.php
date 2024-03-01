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
        Schema::create('wp_options', function (Blueprint $table) {
            $table->bigIncrements('option_id');
            $table->string('option_name', 191);
            $table->longText('option_value');
            $table->string('autoload')->default('20');

            $table->index('option_name');
            $table->index('autoload');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wp_options');
    }
};
