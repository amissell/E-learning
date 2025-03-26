<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\course;
use App\Models\tag;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $course = Course::create([
        'name' => 'Web Development 101',
        'description' => 'Learn the basics of web development.',
        'duration' => 5,
        'level' => 'Beginner',
    ]);

    // Attach tags to the course
    $tags = Tag::whereIn('name', ['Laravel', 'PHP', 'Backend'])->pluck('id');
    $course->tags()->attach($tags);
}
}
