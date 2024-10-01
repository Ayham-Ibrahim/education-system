<?php

namespace Modules\ExamsAssignments\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\UserManagement\Models\User;
use Modules\ExamsAssignments\Models\Exam;
use Modules\ExamsAssignments\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ExamsAssignments\Database\Factories\StudentAnswerFactory;

class StudentAnswer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['student_id', 'exam_id', 'question_id', 'answer'];

    // protected static function newFactory(): StudentAnswerFactory
    // {
    //     // return StudentAnswerFactory::new();
    // }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
