<?php

namespace Modules\ExamsAssignments\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\UserManagement\Models\User;
use Modules\ExamsAssignments\Models\Exam;
use Modules\ExamsAssignments\Models\Assignment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ExamsAssignments\Database\Factories\GradeFactory;

class Grade extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['exam_id', 'assignment_id', 'student_id', 'grade'];

    // protected static function newFactory(): GradeFactory
    // {
    //     // return GradeFactory::new();
    // }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

}
