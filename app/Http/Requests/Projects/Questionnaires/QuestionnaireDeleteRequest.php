<?php

namespace App\Http\Requests\Projects\Questionnaires;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class QuestionnaireDeleteRequest extends BaseRequest
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
        return [
            "questionnaire_id" => "Kuisioner",
            "type" => "Tipe Kuisioner"
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
            "questionnaire_id" => "required|string",
            "type" => "required|string"
        ];
    }
}
