<?php

namespace Modules\ExamsAssignments\Http\Requests\AssignmentRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssignmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:30',
            'description' => 'nullable|string|max:255',
            'subject_id' => 'nullable|exists:subjects,id',
            'due_date' => 'nullable|date',
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
