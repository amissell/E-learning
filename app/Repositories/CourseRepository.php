<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\Course;
use App\Interface\BaseRepositoryInterface;

class CourseRepository implements BaseRepositoryInterface
{
    /**
     * Get all courses.
     */
    public function getAll()
    {
        return Course::all();
    }

    /**
     * Get a course by its ID.
     */
    public function getById($id)
    {
        return Course::find($id);
    }

    /**
     * Create a new course.
     */
    public function create(array $data)
    {
        // Create the course
        $course = Course::create($data);

        if (isset($data['tags'])) {
            $course->tags()->sync($data['tags']);
        }

        return $course;
    }

    /**
     * Update an existing course.
     */
    public function update($id, array $data)
    {
        $course = Course::find($id);
        if ($course) {
            $course->update($data);

            if (isset($data['tags'])) {
                $course->tags()->sync($data['tags']);
            }
            return $course;
        }
        return null;
    }

    /**
     * Delete a course by ID.
     */
    public function delete($id)
    {
        $course = Course::find($id);
        if ($course) {
            $course->delete();
            return true;
        }
        return false;
    }
}
