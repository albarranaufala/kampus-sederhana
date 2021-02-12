<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $studentId = $this->route('student');
        return [
            'name' => 'required|string|max:255',
            'credit' => 'required|integer',
            'username' => "required|string|unique:users,username,$studentId|max:255",
        ];
    }
}
