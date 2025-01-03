<?php

namespace IslamicNetwork\Calendar\Helpers;

use DateTime;
use IslamicNetwork\Calendar\Types;

class Date
{

    /**
     * @param DateTime $gregorianDate
     * @return float
     */
    public static function offsetBetweenGregorianAndJulian(Datetime $gregorianDate): float
    {
        $y = $gregorianDate->format('Y');
        $a = floor($y / 100.);

        return $a - floor($a / 4.) - 2;
    }

    /**
     * @param float $julianDate
     * @return float
     */
    public static function offsetBetweenJulianAndGregorian(float $julianDate): float
    {
        $a = floor(($julianDate- 1867216.25) / 36524.25);

        return $a - floor($a / 4.) + 1;
    }

    public static function adjustFromGregorian(int &$m, int &$y): void
    {
        if ($m < 3) {
            $y -= 1;
            $m += 12;
        }
    }

    public static function adjustFromJulian(int &$m, int &$y, int &$c): void
    {
        if ($m > 13) {
            $c += 1;
            $m -= 12;
        }

        $m -= 1;
        $y = $c - 4716;
    }

    /**
     * @param float $cjd Chronological Julian Date Number
     * @return float Modified Chronological Julian Date Number
     */
    public static function modifiedJulianDate(float $cjd): float
    {
        return $cjd - 2400000;
    }

    /**
     * @param $floatNum
     * @return float
     */
    public static function intPart($floatNum): float
    {
        if ($floatNum< -0.0000001) {
            return ceil($floatNum-0.0000001);
        }

        return floor($floatNum+0.0000001);
    }

    public static function hijriFormatted(int $day, int $month, int $year, int $monthLength, DateTime $gregorianDate, string $method): Types\Hijri\Date
    {
        $mx = Calendar::getIslamicMonths()[$month];
        $hwd = Calendar::hijriWeekdays($gregorianDate->format('l'));
        $hijriMonth = new Types\Hijri\Month($mx['number'], $mx['en'], $mx['ar'], $monthLength);
        $hijriDay = new Types\Hijri\Day($day, $hwd['en'], $hwd['ar']);

        return new Types\Hijri\Date($hijriDay, $hijriMonth, $year, $method, Calendar::getHijriHolidays($day, $month));
    }

}