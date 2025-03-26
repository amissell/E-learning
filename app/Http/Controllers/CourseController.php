<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CourseService;

use App\Models\course;

class CourseController extends Controller
{
  protected $courseService;

  public function __construct(CourseService $courseService)
  {
      $this->courseService = $courseService;
  }

  public function index()
  {
      try {
          $courses = $this->courseService->getAllCourses();
          return response()->json($courses);
      } catch (\Exception $e) {
          return response()->json(['error' => $e->getMessage()], 400);
      }
  }

  public function show($id)
  {
      try {
          $course = $this->courseService->getCourseDetails($id);
          return response()->json($course);
      } catch (\Exception $e) {
          return response()->json(['error' => $e->getMessage()], 404);
      }
  }

  public function store(Request $request)
  {
      try {
          $request->validate([
              'name' => 'required|string|max:255',
              'description' => 'required|string',
              'duration' => 'required|integer',
              'level' => 'required|string',
              'tags' => 'array|exists:tags,id', 
          ]);
          $course = $this->courseService->createCourse($request->all());
          return response()->json($course, 201);
      } catch (\Exception $e) {
          return response()->json(['error' => $e->getMessage()], 400);
      }
  }

  public function update($id, Request $request)
  {
      try {
          $request->validate([
              'name' => 'sometimes|string|max:255',
              'description' => 'sometimes|string',
              'duration' => 'sometimes|integer',
              'level' => 'sometimes|string',
              'tags' => 'sometimes|array|exists:tags,id',
          ]);

          $course = $this->courseService->updateCourse($id, $request->all());
          return response()->json($course);
      } catch (\Exception $e) {
          return response()->json(['error' => $e->getMessage()], 400);
      }
  }

  public function destroy($id)
  {
      try {
          $this->courseService->deleteCourse($id);
          return response()->json(['message' => 'Course deleted successfully']);
      } catch (\Exception $e) {
          return response()->json(['error' => $e->getMessage()], 400);
      }
  }

  public function search(Request $request)
{
    $query = $request->input('search');

    if (!$query) {
        return response()->json(['message' => 'No search query provided'], 400);
    }

    $courses = Course::where('', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->get();

    return response()->json($courses);
}
}
