<?php

namespace App\Http\Requests\Projects\Questionnaires;

use App\Http\Requests\BaseRequest;

class QuestionnaireRequest extends BaseRequest
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

    public function attributes()
    {
        return[
            "contents" => "Konten",
            "type" => "Tipe"
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "contents" => "required|string",
            "type" => "required|string"
        ];
    }
}
