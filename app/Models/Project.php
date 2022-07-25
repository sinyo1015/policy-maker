<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "analyst_name",
        "client_name",
        "policy_date",
        "analysis_date",
        "description",
    ];

    public function labels()
    {
        return $this->hasMany(ProjectImplPeriodLabels::class);
    }
}
