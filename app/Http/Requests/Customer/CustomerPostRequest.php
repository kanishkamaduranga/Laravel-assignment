<?php

namespace App\Http\Requests\Customer;

use App\Helper\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerPostRequest extends FormRequest
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
            'customer_reference' => 'required|unique:customers,customer_reference',
            'name'      => 'required',
            'email'     => 'required|email|unique:customers,email',
        ];
    }

    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException( ResponseHelper::returnError( 1003, $validator->errors()));
    }
}
