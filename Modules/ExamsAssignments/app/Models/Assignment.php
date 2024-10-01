<?php

namespace Modules\ExamsAssignments\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\ExamsAssignments\Models\Grade;
use Modules\CourseManagement\Models\Subject;
use Modules\ExamsAssignments\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ExamsAssignments\Database\Factories\AssignmentFactory;

class Assignment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title', 'description', 'subject_id', 'due_date'];

    // protected static function newFactory(): AssignmentFactory
    // {
    //     // return AssignmentFactory::new();
    // }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
