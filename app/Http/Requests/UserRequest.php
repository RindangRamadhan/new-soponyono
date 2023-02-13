<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                'user_name' => 'required|unique:users,user_name',
                'rbm_code' => 'required|unique:users,rbm_code',
                'name' => 'required',
                'type' => 'required',
                'uid_id' => 'required',
                'up3_id' => 'required',
                'ulp_id' => 'required',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|same:password',
            ];
        } else {
            $rules = [
                'user_name' => 'required|unique:users,user_name,' . $this->route('user'),
                'rbm_code' => 'required|unique:users,rbm_code,' . $this->route('user'),
                'name' => 'required',
                'type' => 'required',
                'uid_id' => 'required',
                'up3_id' => 'required',
                'ulp_id' => 'required',
            ];
        }

        return $rules;
    }
}
