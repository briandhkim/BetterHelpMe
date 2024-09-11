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
        // Schema::create('answers', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignIdFor(Question::class)->constrained()->onDelete('cascade');
        //     $table->foreignIdFor(Response::class)->constrained()->onDelete('cascade');
        //     $table->string('input');
        //     $table->timestamps();
        // });

        DB::statement('
            CREATE TABLE IF NOT EXISTS answers(
                id BIGINT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                question_id BIGINT(20) UNSIGNED NOT NULL,
                response_id BIGINT(20) UNSIGNED NOT NULL,
                input VARCHAR(255) NOT NULL,
                created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                CONSTRAINT a_question_id_fk FOREIGN KEY (question_id) REFERENCES questions (id) ON DELETE CASCADE,
                CONSTRAINT a_response_id_fk FOREIGN KEY (response_id) REFERENCES responses (id) ON DELETE CASCADE
            );
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
