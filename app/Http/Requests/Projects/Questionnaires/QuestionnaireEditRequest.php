<?php

namespace App\Http\Requests\Projects\Questionnaires;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class QuestionnaireEditRequest extends BaseRequest
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
            "questionnaire" => "Konten Kuisioner",
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
            "questionnaire_id" => "required|numeric",
            "questionnaire" => "required|string",
            "type" => "required|numeric"
        ];
    }
}
