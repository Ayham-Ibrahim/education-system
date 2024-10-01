<?php

namespace Modules\ExamsAssignments\Http\Requests\AssignmentRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssignmentRequest extends FormRequest
{

    /**
     * Prepare the data for validation.
     */
    public function prepareForvalidation(){
        $subject = $this->route('subject');
        $this->merge([
            'subject_id' => $subject->id,
        ]);
    }

    

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:30',
            'description' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'due_date' => 'required|date',

       ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
