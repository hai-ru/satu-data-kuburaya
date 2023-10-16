<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderStoreRequest extends FormRequest
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
            'slug' => 'required|unique:slider,slug',
            'gambar' => 'required|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Judul slider wajib diisi',
            'slug.required' => 'Slug wajib diisi!',
            'slug.unique' => 'Slug sudah ada!',
            'gambar.required' => 'Gambar slider wajib diupload',
            'gambar.image' => 'Slider wajib berupa gambar',
            'gambar.mimes' => 'Gambar slider harus berformat jpeg, jpg, png',
            'gambar.max' => 'Gambar maksimal 2MB',
        ];
    }
}
