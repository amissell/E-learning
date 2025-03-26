<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{
  public function getAllCourses()
  {
      return Course::with('tags')->get(); // Returns all courses with their associated tags
  }

  public function getCourseDetails($id)
  {
      return Course::with('tags')->findOrFail($id); // Retrieve course details along with tags
  }

  public function createCourse($data)
  {
      $course = Course::create([
          'name' => $data['name'],
          'description' => $data['description'],
          'duration' => $data['duration'],
          'level' => $data['level']
      ]);

      // Attach tags if provided
      if (isset($data['tags'])) {
          $course->tags()->sync($data['tags']);
      }

      return $course;
  }

  public function updateCourse($id, $data)
  {
      $course = Course::findOrFail($id);
      $course->update([
          'name' => $data['name'] ?? $course->name,
          'description' => $data['description'] ?? $course->description,
          'duration' => $data['duration'] ?? $course->duration,
          'level' => $data['level'] ?? $course->level
      ]);

      // Sync tags if provided
      if (isset($data['tags'])) {
          $course->tags()->sync($data['tags']);
      }

      return $course;
  }

  public function deleteCourse($id)
  {
      $course = Course::findOrFail($id);
      $course->tags()->detach(); // Detach tags first
      $course->delete(); // Then delete course

      return true;
  }
}
