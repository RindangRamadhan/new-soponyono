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
                'id_pel' => 'required|unique:customers,id_pel',
                'name' => 'required',
                'uid_id' => 'required',
                'up3_id' => 'required',
                'ulp_id' => 'required',
            ];
        } else {
            $rules = [
                'id_pel' => 'required|unique:customers,id_pel,' . $this->route('customer'),
                'name' => 'required',
                'uid_id' => 'required',
                'up3_id' => 'required',
                'ulp_id' => 'required',
            ];
        }

        return $rules;
    }
}
