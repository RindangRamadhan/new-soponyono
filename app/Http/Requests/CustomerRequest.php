<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
                'id' => 'required|unique:customers,id',
                'name' => 'required',
                'uid_id' => 'required',
                'up3_id' => 'required',
                'ulp_id' => 'required',
                'tarif' => 'required',
                'power' => 'required',
                'substation' => 'required',
                'class' => 'required',
            ];
        } else {
            $rules = [
                'id' => 'required|unique:customers,id,' . $this->route('customer'),
                'name' => 'required',
                'uid_id' => 'required',
                'up3_id' => 'required',
                'ulp_id' => 'required',
                'tarif' => 'required',
                'power' => 'required',
                'substation' => 'required',
                'class' => 'required',
            ];
        }

        return $rules;
    }
}
