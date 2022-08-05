<?php

namespace App\Http\Requests\Project\OpportunityObstacles;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class OpportunityObstacleRequest extends BaseRequest
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
            "opportunity" => "Kesempatan",
            "obstacle" => "Rintangan",
            "comments" => "Komentar"
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
            "opportunity" => "required|string",
            "obstacle" => "required|string",
            "comments" => "required|string"
        ];
    }
}
