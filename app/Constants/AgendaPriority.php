<?php

namespace App\Constants;

class AgendaPriority
{
    public const LOW = 0;
    public const MODERATE = 1;
    public const HIGH = 2;

    public const REVERSE = [
        self::LOW => "Prioritas Rendah",
        self::MODERATE => "Prioritas Menengah",
        self::HIGH => "Prioritas Tinggi"
    ];

    public static function message($type)
    {
        switch($type){
            case self::LOW:
                return "Prioritas Rendah";
            case self::MODERATE:
                return "Prioritas Menengah";
            case self::HIGH:
                return "Prioritas Tinggi";
            default:
                return "";
        }
    }
}