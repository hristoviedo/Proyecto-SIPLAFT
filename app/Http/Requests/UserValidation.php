<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidation extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users',
            'role_id' => 'required|integer|confirmed',
            'company_id' => 'required|integer|confirmed',
            'active' => 'required|boolean|confirmed',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required_with:password|same:password|string|min:8|confirmed',
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'El campo nombre es requerido',
        'email.required'  => 'El campo correo electrónico es requerido',
        'role_id.required' => 'El campo role de usuario es requerido',
        'company_id.required'  => 'El campo Empresa a la que pertenece es requerido',
        'active.required' => 'El campo activo es requerido',
        'password.required'  => 'El campo contraseña es requerido',
        'password_confirmation.required'  => 'Las contraseñas no coinciden',
    ];
}
}
