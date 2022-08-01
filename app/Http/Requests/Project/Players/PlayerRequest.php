<?php

namespace App\Http\Requests\Project\Players;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends BaseRequest
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
            "name" => "Nama Pihak",
            "details" => "Informasi Tambahan",
            "sector" => "Sektor",
            "level" => "Level",
            "position_scale" => "Posisi Pihak",
            "power_scale" => "Kekuatan Pihak"
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
            "name" => "required|string",
            "details" => "nullable|string",
            "sector" => "required|numeric",
            "level" => "required|numeric",
            "position_scale" => "required|numeric",
            "power_scale" => "required|numeric"
        ];
    }
}
