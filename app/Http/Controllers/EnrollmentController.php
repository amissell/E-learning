<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnrollmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function enroll(Request $request, $courseId)
    {
        $user = Auth::user();

        // dd($user->getRoleNames()); 

        if (!$user->hasRole('student')) {
            return response()->json(['message' => 'You are not authorized to enroll in courses.'], 403);
        }

        $course = Course::findOrFail($courseId);

        if ($user->courses->contains($course)) {
            return response()->json(['message' => 'You are already enrolled in this course.'], 400);
        }

        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'pending'
        ]);

        return response()->json(['message' => 'You have successfully enrolled in the course.'], 200);
    }
}
