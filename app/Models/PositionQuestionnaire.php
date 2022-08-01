<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionQuestionnaire extends Model
{
    use HasFactory;

    protected $fillable = [
        "questionnaire",
        "project_id"
    ];  
}
