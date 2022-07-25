<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class BaseRequest extends FormRequest
{
    public $validator = null;

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }

    public function errorMessages()
    {
        return Arr::flatten($this->validator->errors()->toArray());
    }
}