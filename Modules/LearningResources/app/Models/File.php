<?php

namespace Modules\LearningResources\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\CourseManagement\Models\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\LearningResources\Database\Factories\FileFactory;

class File extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'subject_id',
        'title',
        'path',
        'type',
    ];

    // protected static function newFactory(): FileFactory
    // {
    //     // return FileFactory::new();
    // }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
