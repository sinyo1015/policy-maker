<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPolicies extends Model
{
    use HasFactory;

    protected $fillable = [
        "goal",
        "mechanism",
        "indicator",
        "priority",
        "comments",
        "is_more_research_needed",
        "agenda_id",
        "project_id"
    ];

    public function agenda()
    {
        return $this->hasOne(Agenda::class, "id", "agenda_id");
    }
}
