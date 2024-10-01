<?php

namespace Modules\CourseManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Modules\CourseManagement\Models\Course;
use Modules\CourseManagement\Transformers\CourseResource;
use Modules\CourseManagement\Http\Requests\AddSubjectRequest;
use Modules\CourseManagement\Http\Requests\CourseRequests\StoreCourseRequest;
use Modules\CourseManagement\Http\Requests\CourseRequests\UpdateCourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return ApiResponseService::success($courses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();
        $course = Course::create($data);
        return ApiResponseService::success(new CourseResource($course),"created successfully",201);
    }

    /**
     * Show the specified resource.
     */
    public function show(Course $course)
    {
        $course->load('subjects');
        return ApiResponseService::success($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->validated();
        $course->update(array_filter($data));
        return ApiResponseService::success($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json("course deleted");
    }


    // Add subjects to a course
    public function addSubject(AddSubjectRequest $request,Course $course)
    {
        // $course = Course::findOrFail($courseId);
        $subject = $course->subjects()->create($request->validated());
        return ApiResponseService::success(new CourseResource($course),'operation success',201);

    }
}
