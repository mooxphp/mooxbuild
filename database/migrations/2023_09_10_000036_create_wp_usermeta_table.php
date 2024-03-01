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
        Schema::create('wp_usermeta', function (Blueprint $table) {
            $table->bigIncrements('umeta_id');
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('meta_key')->nullable();
            $table->longText('meta_value')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wp_usermeta');
    }
};
