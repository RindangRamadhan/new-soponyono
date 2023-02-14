<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UidRequest extends FormRequest
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
                'id' => 'required|unique:uids,id',
                'name' => 'required|unique:uids,name',
            ];
        } else {
            $rules = [
                'name' => 'required|unique:uids,name,' . $this->route('uid'),
            ];
        }

        return $rules;
    }
}
