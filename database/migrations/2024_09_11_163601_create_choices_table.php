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
        // Schema::create('choices', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('value');
        //     $table->string('label');
        //     $table->foreignIdFor(Question::class)->constrained()->onDelete('cascade');
        //     $table->timestamps();
        // });

        DB::statement('
            CREATE TABLE IF NOT EXISTS choices (
                id BIGINT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                value VARCHAR(255) NOT NULL,
                label VARCHAR(255) NOT NULL,
                question_id BIGINT(20) UNSIGNED NOT NULL,
                created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                CONSTRAINT c_question_id_fk FOREIGN KEY (question_id) REFERENCES questions (id) ON DELETE CASCADE
            );
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};
