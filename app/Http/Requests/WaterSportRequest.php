<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class WaterSportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required',
            'description' => 'required',
            'harga' => 'required|integer',
            'minimal' => 'required|integer',
            'foto' => 'image|mimes:png,jpeg|max:5120'
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'harga' => str_replace(',', '', $this->harga)
        ]);
    }
}
