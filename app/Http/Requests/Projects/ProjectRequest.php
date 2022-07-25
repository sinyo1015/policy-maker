<?php

namespace App\Http\Requests\Projects;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class ProjectRequest extends BaseRequest
{

    public function __construct()
    {
        parent::__construct();
    }

    public function attributes()
    {
        return [
            "project_name" => "Nama Proyek",
            "analyst_name" => "Nama Analis",
            "client_name" => "Nama Klien",
            "description" => "Keterangan Proyek",
            "policy_date" => "Tanggal Kebijakan",
            "analysis_date" => "Tanggal Analisis",
            "implementation_period_labels" => "Impl"
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
            "project_name" => "required|string",
            "analyst_name" => "nullable|string",
            "client_name" => "nullable|string",
            "description" => "nullable|string",
            "policy_date" => "nullable|string|date",
            "analysis_date" => "nullable|string|date",
            "implementation_period_labels" => "nullable|array"
        ];
    }
}
