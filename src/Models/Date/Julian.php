<?php

namespace IslamicNetwork\Calendar\Models\Date;

use DateTime;
use IslamicNetwork\Calendar\Helpers;
use IslamicNetwork\Calendar\Models\Mathematical\Calculator;
use IslamicNetwork\Calendar\Types;

class Julian
{
    /**
     * @var float Julian Date Number
     */
    private float $date;


    /**
     * @param float $date
     */
    public function __construct(float $date)
    {
        $this->date = $date;
    }

    /**
     * Astronomical Julian to Gregorian Converter
     * @return DateTime
     */
    public function toGregorian(): DateTime
    {
        $jgc = Helpers\Date::offsetBetweenJulianAndGregorian($this->date);
        $b = $this->date + $jgc + 1524;
        $c = floor(($b - 122.1) / 365.25);
        $d = floor(365.25 * $c);
        $month = floor(($b - $d) / 30.6001);
        $day = ($b - $d) - floor(30.6001 * $month);
        $year = 0;

        Helpers\Date::adjustFromJulian($month, $year, $c);

        return DateTime::createFromFormat('d-m-Y', $day. '-' . $month . '-' . $year);
    }

    /**
     * Astronomical Julian to Hijri Converter
     * @param array $data Astronomical Data set from Data\Astronomical
     * @param int $lunations The lunation number to add to the data for the method
     * @return Types\Hijri\Date
     */
    public function toHijri(array $data, int $lunations, string $method): Types\Hijri\Date
    {
        $mcjdn = Helpers\Date::modifiedJulianDate($this->date);

        // The MCJDN of the start of the lunations in the Umm al-Qura calendar are stored in Data\Astronomincal::ummAlQura()
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i] > $mcjdn) {
                break;
            }
        }

        // Compute and output the Umm al-Qura calendar date
        $iln = $i + $lunations;
        $ii = floor(($iln - 1) / 12);
        $iy = $ii + 1;
        $im = $iln - 12 * $ii;
        $id = $mcjdn - $data[$i - 1] + 1;
        $ml = $data[$i] - $data[$i - 1];
        //$ilunnum = $iln;

        return Helpers\Date::hijriFormatted($id, $im, $iy, $ml, $this->toGregorian(), $method);
    }

    /**
     * Mathematical Julian to Hijri Calculation
     * @param int $adjustment +/- number of days from the Julian date before converting to Hijri
     * @param DateTime $gd Original gregorian date used to create the Julian Date for this object's constructor
     * @return Types\Hijri\Date
     */
    public function toHijriMathematical(DateTime $gd, int $adjustment = 0): Types\Hijri\Date
    {
        $l = $this->date + $adjustment - 1948440 + 10632;
        $n = Helpers\Date::intPart(($l - 1) / 10631);
        $l = $l - 10631 * $n + 354;
        $j = (Helpers\Date::intPart((10985 - $l) / 5316)) * (Helpers\Date::intPart((50 * $l) / 17719)) + (Helpers\Date::intPart($l / 5670)) * (Helpers\Date::intPart((43 * $l) / 15238));
        $l = $l - (Helpers\Date::intPart((30 - $j) / 15)) * (Helpers\Date::intPart((17719 * $j) / 50))-(Helpers\Date::intPart($j / 16)) * (Helpers\Date::intPart((15238 * $j) / 43)) + 29;
        $m = Helpers\Date::intPart((24 * $l) / 709);
        $d = $l - Helpers\Date::intPart((709 * $m) / 24);
        $y = 30 * $n + $j-30;

        return Helpers\Date::hijriFormatted($d, $m, $y, 30, $this->toGregorian(), Calculator::ID);

    }





}