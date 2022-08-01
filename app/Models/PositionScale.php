<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionScale extends Model
{
    use HasFactory;

    protected $fillable = [
        "ps_dh", //Deny High
        "ps_dmh", //Deny Medium High
        "ps_dml", //Deny Medium Low
        "ps_dlh", //Deny Low High
        "ps_dll", //Deny Low Low
        "ps_nh", //Neutral High 
        "ps_nl", //Neutral Low
        "ps_sll", //Support Low Low
        "ps_slh", //Support Low High
        "ps_sml", //Support Medium Low
        "ps_smh", //Support Medium High
        "ps_sh", //Support High,
        "project_id"
    ];
}
