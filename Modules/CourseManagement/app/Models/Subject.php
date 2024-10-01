<?php

namespace Modules\CourseManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\UserManagement\Models\User;
use Modules\ExamsAssignments\Models\Exam;
use Modules\LearningResources\Models\File;
use Modules\CourseManagement\Models\Course;
use Modules\LearningResources\Models\Video;
use Modules\ExamsAssignments\Models\Assignment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CourseManagement\Database\Factories\SubjectFactory;

class Subject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'course_id',
        'teacher_id',
    ];

    /**
    * Summary of course
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Summary of teacher
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher() {
        return $this->belongsTo(User::class,'teacher_id');
    }



    // Many students can enroll in a subject (many-to-many)
    public function students()
    {
        return $this->belongsToMany(User::class, 'student_subject','subject_id', 'student_id');
    }

    /**
     * Summary of videos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    /**
     * Summary of files
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }



    public function exams()
    {
        return $this->hasMany(Exam::class);
    }



    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

}
