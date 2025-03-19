<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\Enrollment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
  public function enroll($courseId)
  {
      $user = Auth::user();

      // Check if course exists
      $course = Course::findOrFail($courseId);

      // Check if user is already enrolled
      if (Enrollment::where('user_id', $user->id)->where('course_id', $courseId)->exists()) {
          return response()->json(['message' => 'Already enrolled'], 400);
      }

      // Create enrollment
      $enrollment = Enrollment::create([
          'user_id' => $user->id,
          'course_id' => $course->id,
          'status' => 'pending'
      ]);

      return response()->json(['message' => 'Enrollment request submitted', 'enrollment' => $enrollment], 201);
  }

  // List all enrollments for a course (Admin/Mentor)
  public function listEnrollments($courseId)
  {
      $course = Course::findOrFail($courseId);
      $enrollments = Enrollment::where('course_id', $courseId)->with('user')->get();

      return response()->json($enrollments);
  }

  // Update enrollment status (Admin/Mentor)
  public function updateEnrollment($id, Request $request)
  {
      $request->validate(['status' => 'required|in:pending,accepted,rejected']);

      $enrollment = Enrollment::findOrFail($id);
      $enrollment->status = $request->status;
      $enrollment->save();

      return response()->json(['message' => 'Enrollment updated successfully', 'enrollment' => $enrollment]);
  }

  // Delete enrollment
  public function deleteEnrollment($id)
  {
      $enrollment = Enrollment::findOrFail($id);
      $enrollment->delete();

      return response()->json(['message' => 'Enrollment deleted successfully']);
  }
}
