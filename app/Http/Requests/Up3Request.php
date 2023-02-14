<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Up3Request extends FormRequest
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
                'id' => 'required|unique:up3s,id',
                'name' => 'required|unique:up3s,name',
                'uid_id' => 'required',
            ];
        } else {
            $rules = [
                'name' => 'required|unique:up3s,name,' . $this->route('up3'),
                'uid_id' => 'required',
            ];
        }

        return $rules;
    }
}
