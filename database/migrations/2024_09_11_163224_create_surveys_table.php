<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('surveys', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title');
        //     $table->timestamps();
        // });

        DB::statement('
            CREATE TABLE IF NOT EXISTS surveys (
                id BIGINT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                title VARCHAR(255) NOT NULL,
                created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            );
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
