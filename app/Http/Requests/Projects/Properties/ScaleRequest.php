<?php

namespace App\Http\Requests\Projects\Properties;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ScaleRequest extends BaseRequest
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
            "type" => "Tipe",
            "payload" => "Isi",

            "ps_dh" => "Penolakan Tinggi", //Deny High
            "ps_dmh" => "Penolakan Medium-besar", //Deny Medium High
            "ps_dml" => "Penolakan Medium-kecil", //Deny Medium Low
            "ps_dlh" => "Penolakan Rendah-besar", //Deny Low High
            "ps_dll" => "Penolakan Rendah-kecil", //Deny Low Low
            "ps_nh" => "Netral-besar", //Neutral High 
            "ps_nl" => "Netral-kecil", //Neutral Low
            "ps_sll" => "Dukungan Rendah-kecil", //Support Low Low
            "ps_slh" => "Dukungan Rendah-besar", //Support Low High
            "ps_sml" => "Dukungan Medium-kecil", //Support Medium Low
            "ps_smh" => "Dukungan Medium-besar", //Support Medium High
            "ps_sh" => "Sangat Mendukung", //Support High,

            "pw_l" => "Kekuatan Rendah",
            "pw_ml" => "Kekuatan Menengah-kecil",
            "pw_mh" => "Kekuatan Menengah-besar",
            "pw_h" => "Kekuatan Tinggi",
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
            "ps_dh" => "required|numeric", //Deny High
            "ps_dmh" => "required|numeric", //Deny Medium High
            "ps_dml" => "required|numeric", //Deny Medium Low
            "ps_dlh" => "required|numeric", //Deny Low High
            "ps_dll" => "required|numeric", //Deny Low Low
            "ps_nh" => "required|numeric", //Neutral High 
            "ps_nl" => "required|numeric", //Neutral Low
            "ps_sll" => "required|numeric", //Support Low Low
            "ps_slh" => "required|numeric", //Support Low High
            "ps_sml" => "required|numeric", //Support Medium Low
            "ps_smh" => "required|numeric", //Support Medium High
            "ps_sh" => "required|numeric", //Support High,

            "pw_l" => "required|numeric",
            "pw_ml" => "required|numeric",
            "pw_mh" => "required|numeric",
            "pw_h" => "required|numeric",
        ];
    }
}
