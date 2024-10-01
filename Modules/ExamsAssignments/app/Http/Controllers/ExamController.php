<?php

namespace Modules\ExamsAssignments\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\ExamsAssignments\Models\Exam;
use Modules\CourseManagement\Models\Subject;
use Modules\ExamsAssignments\Models\Question;
use Modules\ExamsAssignments\Models\StudentAnswer;
use Modules\ExamsAssignments\Http\Requests\ExamRequests\StoreExamRequest;
use Modules\ExamsAssignments\Http\Requests\ExamRequests\UpdateExamRequest;

class ExamController extends Controller
{
    /**
     * Summary of store
     * @param \Modules\ExamsAssignments\Http\Requests\ExamRequests\StoreExamRequest $request
     * @param mixed $subjectId
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(StoreExamRequest $request, $subjectId)
    {
        $subject = Subject::findOrFail($subjectId);
        $exam = $subject->exams()->create($request->validated());
        return response()->json($exam, 201);
    }


    /**
     * Summary of index
     * @param mixed $subjectId
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index($subjectId)
    {
        $exams = Exam::where('subject_id', $subjectId)->get();
        return response()->json($exams);
    }


    /**
     * Summary of show
     * @param \Modules\ExamsAssignments\Models\Exam $exam
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function show(Exam $exam)
    {
        $exam->load('questions');
        return response()->json($exam);
    }

    /**
     * Summary of update
     * @param \Modules\ExamsAssignments\Http\Requests\ExamRequests\UpdateExamRequest $request
     * @param \Modules\ExamsAssignments\Models\Exam $exam
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function update(UpdateExamRequest $request, Exam $exam)
    {
        $exam->update(array_filter($request->validated()));
        return response()->json($exam);
    }

    /**
     * Summary of destroy
     * @param \Modules\ExamsAssignments\Models\Exam $exam
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return response()->json(null, 204);
    }
    
    
    /**
     * Summary of submitAnswers
     * @param \Illuminate\Http\Request $request
     * @param mixed $examId
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function submitAnswers(Request $request, $examId)
    {
        $user = Auth::user();

        // Check if the user is a student
        if ($user->role !== 'student') {
            return response()->json(['message' => 'Only students can submit answers'], 403);
        }

        // Validate the incoming request
        $request->validate([
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:questions,id',
            'answers.*.answer' => 'required|string',
        ]);

        // Loop through each answer and save it
        foreach ($request->answers as $answerData) {
            $question = Question::findOrFail($answerData['question_id']);

            // Ensure the question belongs to the given exam
            if ($question->exam_id !== $examId) {
                return response()->json(['message' => 'Invalid question for this exam'], 400);
            }

            // Create or update the student's answer
            StudentAnswer::updateOrCreate(
                [
                    'student_id' => $user->id,
                    'exam_id' => $examId,
                    'question_id' => $question->id,
                ],
                [
                    'answer' => $answerData['answer']
                ]
            );
        }

        return response()->json(['message' => 'Answers submitted successfully'], 200);
    }
}
