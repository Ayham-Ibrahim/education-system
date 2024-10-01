<?php

namespace Modules\LearningResources\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\CourseManagement\Models\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\LearningResources\Database\Factories\VideoFactory;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'subject_id',
        'title',
        'path',
    ];

    // protected static function newFactory(): VideoFactory
    // {
    //     // return VideoFactory::new();
    // }


    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
