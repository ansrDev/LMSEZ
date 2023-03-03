<?php

use App\Models\CourseDiscussion;
use App\Models\CourseLesson;
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
        Schema::create('course_discussions', function (Blueprint $table) {
            $table->ulid('id');
            $table->foreignIdFor(CourseLesson::class);
            $table->foreignIdFor(CourseDiscussion::class,'parent_id')->nullable();
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_discussions');
    }
};
