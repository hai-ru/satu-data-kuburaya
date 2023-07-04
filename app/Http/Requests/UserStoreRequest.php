<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|same:confirm-password',
            'roles' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah pernah dipakai',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah pernah dipakai',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal :min karakter',
            'password.same' => 'Password tidak sama dengan Konfirmasi Password',
            'roles.required' => 'Peran wajib dipilih',
        ];
    }
}
