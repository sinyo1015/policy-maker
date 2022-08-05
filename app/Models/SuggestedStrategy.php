<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestedStrategy extends Model
{
    use HasFactory;

    protected $fillable = [
        "label",
        "text",
        "category", //See App\Constants\Strategies\StrategyCategory
        "type", //See App\Constants\Strategies\StrategyType,
        "project_id"
    ];
}
