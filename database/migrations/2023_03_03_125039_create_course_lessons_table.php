<?php

use App\Models\CourseSection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_lessons', function (Blueprint $table) {
            $table->ulid('id');
            $table->foreignIdFor(CourseSection::class);
            $table->string('title');
            $table->longText('description');
            $table->string('file');
            $table->enum('file_type',['youtube','video','vimeo']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_lessons');
    }
};
