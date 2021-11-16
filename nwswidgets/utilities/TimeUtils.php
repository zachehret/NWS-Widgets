<?php

namespace nwswidgets\data\utilities;

class TimeUtils
{
    public const MINUTES_01 = 60;
    public const MINUTES_05 = self::MINUTES_01 * 5;
    public const MINUTES_10 = self::MINUTES_01 * 10;
    public const MINUTES_15 = self::MINUTES_01 * 15;
    public const MINUTES_30 = self::MINUTES_01 * 30;
    public const MINUTES_45 = self::MINUTES_01 * 45;
    public const HOURS_1 = self::MINUTES_01 * 60;
    public const HOURS_2 = self::HOURS_1 * 2;
    public const HOURS_3 = self::HOURS_1 * 3;
    public const HOURS_6 = self::HOURS_1 * 6;
    public const HOURS_12 = self::HOURS_1 * 12;
    public const HOURS_18 = self::HOURS_1 * 18;
    public const DAYS_1 = self::HOURS_1 * 24;
    public const DAYS_7 = self::HOURS_1 * 7;
    public const DAYS_14 = self::HOURS_1 * 14;
    public const DAYS_30 = self::HOURS_1 * 30;

    public function minutes(int $minutes) : int {
        return $minutes * self::MINUTES_01;
    }
    public function hours(int $hours) : int {
        return $hours * self::HOURS_1;
    }
    public function days(int $days) : int {
        return $days * self::DAYS_1;
    }
    public function weeks(int $weeks) : int {
        return $weeks * 7 * self::DAYS_1;
    }
}