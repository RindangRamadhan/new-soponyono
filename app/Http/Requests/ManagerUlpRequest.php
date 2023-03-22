<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerUlpRequest extends FormRequest
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
                'user_id' => 'required|unique:manager_ulps,user_id',
                'ulp_id' => 'required|unique:manager_ulps,ulp_id',
                'location' => 'required',
            ];
        } else {
            $rules = [
                'user_id' => 'required|unique:manager_ulps,user_id,' . $this->route('manager_ulp'),
                'ulp_id' => 'required|unique:manager_ulps,ulp_id,' . $this->route('manager_ulp'),
                'location' => 'required',
            ];
        }

        return $rules;
    }
}
