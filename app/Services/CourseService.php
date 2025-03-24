<?php

namespace App\Services;

use App\Interface\BaseRepositoryInterface;
use App\Models\Course;

class CourseService
{
    protected $courseRepository;

    public function __construct(BaseRepositoryInterface $courseRepo)
    {
        $this->courseRepository = $courseRepo;
    }

    /**
     * Get all courses.
     */
    public function getAllCourses()
    {
        return $this->courseRepository->getAll();
    }

    /**
     * Get a specific course by ID.
     */
    public function getCourseById($id)
    {
        return $this->courseRepository->getById($id);
    }

    /**
     * Create a new course.
     */
    public function createCourse(array $data)
    {
        // Business logic can be added here
        // For example, checking if the course already exists

        return $this->courseRepository->create($data);
    }

    /**
     * Update a course by ID.
     */
    public function updateCourse($id, array $data)
    {
        // Business logic can be added here (e.g., validation, logging, etc.)

        return $this->courseRepository->update($id, $data);
    }

    /**
     * Delete a course by ID.
     */
    public function deleteCourse($id)
    {
        return $this->courseRepository->delete($id);
    }
}
