<?php

namespace App\Http\Requests\Project\Interests;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class InterestRequest extends BaseRequest
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
            "player" => "Pihak",
            "interest" => "Interest",
            "interest_type" => "Tipe Interest",
            "priority" => "Prioritas"
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
            "player" => "required|numeric",
            "interest" => "required|string",
            "interest_type" => "required|numeric",
            "priority" => "required|numeric"
        ];
    }
}
