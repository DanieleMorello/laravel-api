<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:150'],
            'description' => 'required',
            'project_image' => ['required', 'image', 'max:955'],
            'project_live_url' => ['nullable', 'max:255'],
            'project_source_code' => ['nullable', 'max:255'],
            'project_id' => ['exists:projects,id'],
            'technologies' => ['exists:technologies,id']
        ];
    }
}
