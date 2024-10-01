<?php

namespace Modules\CourseManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\UserManagement\Models\User;
use Modules\CourseManagement\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CourseManagement\Database\Factories\SchoolClassFactory;

class SchoolClass extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
    ];

    // protected static function newFactory(): SchoolClassFactory
    // {
    //     // return SchoolClassFactory::new();
    // }


    /**
     * Summary of students
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany(User::class,'schoolClass_id');
    }

    // Each class has one course
    public function course()
    {
        return $this->hasOne(Course::class);
    }
}
