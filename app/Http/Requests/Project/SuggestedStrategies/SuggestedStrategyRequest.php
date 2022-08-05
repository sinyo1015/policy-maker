<?php

namespace App\Http\Requests\Project\SuggestedStrategies;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class SuggestedStrategyRequest extends BaseRequest
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
            "strategy_type" => "Jenis strategi",
            "support_type" => "Jenis dukungan strategi",
            "label" => "Label strategi",
            "contents" => "Isi strategi"
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
            "strategy_type" => "required|numeric",
            "support_type" => "required|numeric",
            "label" => "required|string",
            "contents" => "required|string"
        ];
    }
}
