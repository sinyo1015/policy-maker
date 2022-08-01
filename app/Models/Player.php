<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "details",
        "sector_id",
        "level_id",
        "position",
        "power",
        "project_id"
    ];

    public function level()
    {
        return $this->belongsTo(LevelName::class, "level_id");
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, "sector_id");
    }
}
