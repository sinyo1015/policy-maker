<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strategy extends Model
{
    use HasFactory;

    protected $fillable = [
        "player_id",
        "predefined_strategy_id",
        "strategy_action",
        "challanges",
        "timelines",
        "probability",
        "project_id"
    ];

    public function player()
    {
        return $this->hasOne(Player::class, "id", "player_id");
    }

    public function strategy()
    {
        return $this->hasOne(SuggestedStrategy::class, "id", "predefined_strategy_id");
    }
}
