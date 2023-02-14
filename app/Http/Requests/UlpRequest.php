<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UlpRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];

        if ($this->isMethod('POST')) {
            $rules = [
                'id' => 'required|unique:ulps,id',
                'name' => 'required|unique:ulps,name',
                'up3_id' => 'required',
            ];
        } else {
            $rules = [
                'name' => 'required|unique:ulps,name,' . $this->route('ulp'),
                'up3_id' => 'required',
            ];
        }

        return $rules;
    }
}
