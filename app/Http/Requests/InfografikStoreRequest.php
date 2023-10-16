<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfografikStoreRequest extends FormRequest
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
            'judul' => 'required',
            'slug' => 'required|unique:infografik,slug',
            'group_id' => 'required',
            'tipe' => 'required',
            // 'gambar' => 'required|mimes:jpeg,png,jpg|max:2048',
            // 'gambar' => 'mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Judul infografik wajib diisi!',
            'group_id.required' => 'Kategori wajib dipilih!',
            'slug.required' => 'Slug wajib diisi!',
            'slug.unique' => 'Slug sudah ada!',
            'gambar.required' => 'Gambar infografik wajib diupload!',
            'gambar.mimes' => 'Gambar infografik harus berformat jpeg, jpg, png',
            'gambar.max' => 'Gambar maksimal 2MB',
        ];
    }
}
