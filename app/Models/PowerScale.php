<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PowerScale extends Model
{
    use HasFactory;

    protected $fillable = [
        "pw_l",
        "pw_ml",
        "pw_mh",
        "pw_h",
        "project_id"
    ];
}
