<?php

namespace Modules\CourseManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSubjectRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    public function prepareForvalidation(){
        $course = $this->route('course');
        $this->merge([
            'course_id' => $course->id,
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
       return [
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|integer|exists:users,id', 
            'course_id' => 'required|exists:courses,id', 
        ];
    }

}
