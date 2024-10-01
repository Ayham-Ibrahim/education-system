<?php

namespace Modules\ExamsAssignments\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\ExamsAssignments\Models\Question;
use Modules\ExamsAssignments\Models\StudentAnswer;

class ExamController extends Controller
{
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
