<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpportunityObstacle extends Model
{
    use HasFactory;

    protected $fillable = [
        "opportunity",
        "obstacle",
        "comments",
        "is_more_research_needed",
        "player_id",
        "project_id"
    ];

    public function player()
    {
        return $this->hasOne(Player::class, "id", "player_id");
    }
}
