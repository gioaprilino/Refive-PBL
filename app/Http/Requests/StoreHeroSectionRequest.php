<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHeroSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'heading' => 'required|string|max:255',
            'achievement' => 'required|string|max:255',
            'subheading' => 'required|string|max:255',
            'path_video'=> 'required|string|max:255',
            'banner' => 'required|image|mimes:png,jpg,jpeg',
        ];
    }
}
