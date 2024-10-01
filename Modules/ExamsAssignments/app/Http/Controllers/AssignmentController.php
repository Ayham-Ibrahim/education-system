<?php

namespace Modules\ExamsAssignments\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\CourseManagement\Models\Subject;
use Modules\ExamsAssignments\Models\Assignment;
use Modules\ExamsAssignments\Http\Requests\AssignmentRequests\StoreAssignmentRequest;
use Modules\ExamsAssignments\Http\Requests\AssignmentRequests\UpdateAssignmentRequest;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($subjectId)
    {
        $assignments = Assignment::where('subject_id', $subjectId)->get();
        return response()->json($assignments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssignmentRequest $request,Subject $subject)
    {
        // $subject = Subject::findOrFail($subjectId);
        $assignment = $subject->assignments()->create($request->validated());
        return response()->json($assignment, 201);

    }

    /**
     * Show the specified resource.
     */
    public function show(Assignment $assignment)
    {
        $assignment->load('questions');
        return response()->json($assignment); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssignmentRequest $request,Assignment $assignment)
    {
        $assignment->update(array_filter($request->validated()));
        return response()->json($assignment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        
        $assignment->delete();
        return response()->json('deleted seccessfully');
    }
}
