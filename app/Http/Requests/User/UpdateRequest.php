<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => [
                'sometimes',
                'required',
            ],

            'last_name' => [
                'sometimes',
                'required',
            ],

            'username' => [
                'sometimes',
                'required',
                'regex:/^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}$/',
                Rule::unique(User::class)->ignore($this->user)
            ],

            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique(User::class)->ignore($this->user)
            ],

            'password' => [
                'sometimes',
                'required',
                Password::min(6)->mixedCase()->numbers(),
                'confirmed'
            ],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'first_name' => __('fields.first_name'),
            'last_name' => __('fields.last_name'),
            'username' => __('fields.username'),
            'email' => __('fields.email'),
            'password' => __('fields.password'),
        ];
    }
}
