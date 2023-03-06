<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Course;
use App\Models\CourseLearn;
use App\Models\CourseLesson;
use App\Models\CourseResource;
use App\Models\CourseReview;
use App\Models\CourseSection;
use App\Models\Difficulty;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $difficulty = Difficulty::all();
        $users = User::all();

        Course::factory()
            ->state(new Sequence(
                fn (Sequence $sequence) => [(new Difficulty)->getForeignKey() => $difficulty->random()],
            ))
            ->has(
                CourseLearn::factory()
                    ->count(4),
                'learns'
            )
            ->has(
                CourseSection::factory()
                    ->count(4)
                    ->has(
                        CourseLesson::factory()
                            ->count(2)
                            ->has(
                                Comment::factory()
                                    ->count(2)
                                    ->state(new Sequence(
                                        fn (Sequence $sequence) => [
                                            'parent_id' => collect([null, Comment::first()?->id  ?? null])->random(),
                                            (new User())->getForeignKey() => $users->random()
                                        ],
                                    ))
                                    ->has(
                                        Like::factory()
                                            ->for($users->first()),
                                        'likes'
                                    ),
                                'comments'
                            )
                            ->has(
                                CourseResource::factory()->count(2),
                                'resources'
                            ),
                        'lessons'
                    ),
                'sections'
            )->has(
                CourseReview::factory()
                    ->state(new Sequence(
                        fn (Sequence $sequence) => [(new User())->getForeignKey() => $users->random()],
                    ))
                    ->count(5),
                'reviews'
            )
            ->count(5)
            ->create();
    }
}
