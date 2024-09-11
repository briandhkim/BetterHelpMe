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
        // Schema::create('responses', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignIdFor(Survey::class)->constrained()->onDelete('cascade');
        //     $table->timestamps();
        // });

        DB::statement('
            CREATE TABLE IF NOT EXISTS responses (
                id BIGINT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                survey_id BIGINT(20) UNSIGNED NOT NULL,
                created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                CONSTRAINT r_survey_id_fk FOREIGN KEY (survey_id) REFERENCES surveys(id) ON DELETE CASCADE
            );
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
