<?php

namespace App\Http\Requests\Project\Strategies;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class StrategyRequest extends BaseRequest
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
            "player_id" => "Pihak",
            "selected_strategy_id" => "Pilihan strategi",
            "strategy_actions" => "Definisi aksi",
            "challanges" => "Analisa tantangan",
            "timelines" => "Analisa linimasa",
            "probability" => "Probabilitas kesuksesan"
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
            "player_id" => "required|numeric",
            "selected_strategy_id" => "required|numeric",
            "strategy_actions" => "nullable|string",
            "challanges" => "nullable|string",
            "timelines" => "nullable|string",
            "probability" => "required|numeric"
        ];
    }
}
