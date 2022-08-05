<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyInterest extends Model
{
    use HasFactory;

    protected $fillable = [
        "player_id",
        "interest_id",
        "interest",
        "priority",
        "project_id"
    ];

    public function player()
    {
        return $this->hasOne(Player::class, "id", "player_id");
    }

    public function interest()
    {
        return $this->hasOne(Interest::class, "id", "interest_id");
    }
}
