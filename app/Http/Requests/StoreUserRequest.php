<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'unique:users,email'],
            'phone'=>['required','size:10','regex:/^([0-9\s\-\+\(\)]*)$/'],
            'password'=>['required', 'min:8', 'string', 'confirmed'],
            'role'=>['required'],
            'is_active'=>['required'],
            'colour_pallate'=>['required', 'string', 'size:6'],
            'image'=>['required','image','mimes:jpeg,png,jpg,gif'],
        ];
    }
}
