<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyConsequence extends Model
{
    use HasFactory;

    protected $fillable = [
        "description",
        "size_of_consequence",
        "timing_of_consequence",
        "consequence_id",
        "importance",
        "player_id",
        "project_id"
    ];

    public function player()
    {
        return $this->hasOne(Player::class, "id", "player_id");
    }

    public function consequence()
    {
        return $this->hasOne(Consequence::class, "id", "consequence_id");
    }
}
