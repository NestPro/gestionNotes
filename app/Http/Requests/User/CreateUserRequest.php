<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|string',
            'nationality' => 'required|string',
            'father_name' => 'required|string',
            'mother_name' => 'required|string',
            'phone_number' => 'required|string|unique:users',
            'address' => 'required|string',
            'annee' => 'required',
            'birthday' => 'required',
        ];
    }
}
