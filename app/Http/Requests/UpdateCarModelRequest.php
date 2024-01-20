<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\CarModel;

class UpdateCarModelRequest extends FormRequest
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
        $rules =  [
            'name' => 'required|regex:/^[A-Za-z _-]+$/|unique:car_makes,name,'.\Illuminate\Http\Request::segment(2)
        ];

        return $rules;
    }
}
