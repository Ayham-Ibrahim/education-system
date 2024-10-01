<?php

namespace Modules\CourseManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\CourseManagement\Models\Subject;
use Modules\CourseManagement\Models\SchoolClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CourseManagement\Database\Factories\CourseFactory;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
       'name', 
       'schoolClass_id', 
    ];

    protected $with = ['subjects'];


   // A course belongs to a class
    public function class()
    {
        return $this->belongsTo(SchoolClass::class,'schoolClass_id');
    }


      // A course has many subjects
      public function subjects()
      {
          return $this->hasMany(Subject::class);
      }
    // protected static function newFactory(): CourseFactory
    // {
    //     // return CourseFactory::new();
    // }
}
