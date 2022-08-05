<?php

namespace App\Http\Requests\Project\Consequences;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ConsequenceRequest extends BaseRequest
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
            "description" => "Deskripsi Konsekuensi",
            "impact" => "Dampak Konsekuensi",
            "timing" => "Timing Konsekuensi",
            "target" => "Pelaku yang terdampak",
            "type" => "Jenis Konsekuensi",
            "importance" => "Tingkat Kepentingan",
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
            "description" => "required|string",
            "impact" => "required|string",
            "timing" => "required|string",
            "target" => "required|numeric",
            "type" => "required|numeric",
            "importance" => "required|numeric",
        ];
    }
}
