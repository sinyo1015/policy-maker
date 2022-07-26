<?php

namespace App\Http\Requests\Policies;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class PolicyRequest extends BaseRequest
{
    public function attributes()
    {
        return [
            "goal" => "Tujuan",
            "mechanism" => "Mekanisme",
            "indicator" => "Indikator",
            "priority" => "Prioritas",
            "comments" => "Komentar",
            "is_more_research_needed" => "Perlu investivigasi lebih lanjut",
            "agenda_id" => "Agenda",
            "project_id" => "Proyek"
        ];
    }

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
            "goal" => "required|string",
            "mechanism" => "required|string",
            "indicator" => "required|string",
            "priority" => "nullable|string",
            "comments" => "nullable|string",
            "is_more_research_needed" => "nullable|string",
            "agenda_id" => "nullable|string",
            "project_id" => "required|string"
        ];
    }
}
