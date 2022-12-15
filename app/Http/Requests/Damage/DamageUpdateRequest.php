<?php

namespace App\Http\Requests\Damage;

use App\Helper\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class DamageUpdateRequest extends FormRequest
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
        return [
            'customer_reference' => 'exists:customers,customer_reference',
/*
            'latitude' => 'required',
            'longitude' => 'required'*/
        ];
    }

    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException( ResponseHelper::returnError( 1003, $validator->errors()));
    }
}
