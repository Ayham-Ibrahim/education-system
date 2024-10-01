<?php

namespace Modules\ExamsAssignments\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\ExamsAssignments\Models\Exam;
use Modules\ExamsAssignments\Models\Assignment;
use Modules\ExamsAssignments\Models\StudentAnswer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ExamsAssignments\Database\Factories\QuestionFactory;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['type', 'question','grade', 'options','answer','exam_id', 'assignment_id'];

    // protected static function newFactory(): QuestionFactory
    // {
    //     // return QuestionFactory::new();
    // }


    protected function casts(): array
    {
        return [
            'options' => 'array',
        ];
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }


    public function studentAnsers(){
        return $this->hasMany(StudentAnswer::class);
    }
}
