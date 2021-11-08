<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRequest extends FormRequest
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
                'required',
            ],

            'last_name' => [
                'required',
            ],

            'username' => [
                'required',
                'regex:/^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}$/',
                'unique:' . User::class
            ],

            'email' => [
                'required',
                'email',
                'unique:' . User::class
            ],

            'password' => [
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
