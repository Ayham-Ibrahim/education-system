<?php

namespace Modules\UserManagement\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\ExamsAssignments\Models\Grade;
use Modules\CourseManagement\Models\Subject;
// use Modules\UserManagement\Database\Factories\UserFactory;
use Modules\CourseManagement\Models\SchoolClass;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements JWTSubject
{
    use HasFactory;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'schoolClass_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // protected static function newFactory(): UserFactory
    // {
    //     // return UserFactory::new();
    // }

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    
    /**
     * subjects that teacher teach it
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teacherSubjects()
    {
        return $this->hasMany(Subject::class, 'teacher_id');
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class,'schoolClass_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject', 'student_id', 'subject_id');
    }


    public function grades(){
        return $this->hasMany(Grade::class,'student_id');
    }
}
