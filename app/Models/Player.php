<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "alt_name",
        "details",
        "sector_id",
        "level_id",
        "position",
        "power",
        "project_id",
        "pos_x",
        "pos_y"
    ];

    public function level()
    {
        return $this->belongsTo(LevelName::class, "level_id");
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, "sector_id");
    }

    public function oops()
    {
        return $this->hasMany(OpportunityObstacle::class, "player_id", "id");
    }
}
