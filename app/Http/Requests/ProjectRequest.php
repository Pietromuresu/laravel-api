<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            "name" => "required|max:50|min:3",
            "purpose" => "required|max:255|min:10",
            "description" => "required|min:20",
            "repository" => "required|max:255|min:3",
            "is_done" => "required",
            "project_manager" => "max:50",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Name is required",
            "name.max" => "Max length for Name is :max",
            "name.min" => "Minimum length for Name is :min",
            "purpose.required" => "Purpose is required",
            "purpose.max" => "Max length for Purpose is :max",
            "purpose.min" => "Minimum length for Purpose is :min",
            "description.required" => "Description is required",
            "description.min" => "Minimum length for Description is :min",
            "technologies.required" => "Technologies is required",
            "technologies.max" => "Max length for Technologies is :max",
            "technologies.min" => "Minimum length for Technologies is :min",
            "project_manager.max" => "Max length for Project manager is :max",
            "repository.required" => "Repository is required",
            "repository.max" => "Max length for Repository is :max",
            "repository.min" => "Minimum length for Repository is :min",
            "is_done" => "Specify if is completed or not.",
        ];
    }
}
