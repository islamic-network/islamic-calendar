<?php

namespace IslamicNetwork\Calendar\Models\Mathematical;

use DateTime;
use IslamicNetwork\Calendar\Models\Date\Gregorian;
use IslamicNetwork\Calendar\Models\Date\Hijri;
use IslamicNetwork\Calendar\Models\Date\Julian;
use IslamicNetwork\Calendar\Types;

class Calculator
{
    public const ID = 'MATHEMATICAL';

    public const NAME = 'Mathematical calculator based on a calculation written by Layth A. Ibraheem';

    public const DESCRIPTION = 'This has been the default calendar used by the AlAdhan API until January 2025. It is purely mathematical does not keep track of the number of days in a month, so adjusting it to match the actual hilaal sightings is not possible. It still works if you are happy wth some inconsistencies, but is no longer the default calendar. This calendar allows for adjustments.';

    public const  VALIDITY_PERIOD = 'No restrictions';

    /**
     * Get Hijri Date from Gregorian Date
     * @param string $d Gregorian date string in the format dd-mm-yyyy
     * @param int $adjustment +/- days for hijri calclation
     * @return Types\Hijri\Date
     */
    public function gToH(string $d, int $adjustment = 0): Types\Hijri\Date
    {
        $d = DateTime::createFromFormat('d-m-Y', $d);

        $gd = new Gregorian($d);
        $jd = new Julian($gd->toJulian());

        return $jd->toHijriMathematical($d, $adjustment);

    }

    /**
     * Get Gregorian Date from Hijri Date
     * @param string $d Hijri date string in the format dd-mm-yyyy
     * @param int $adjustment +/- days for gregorian calclation
     * @return void
     */
    public function hToG(string $d, int $adjustment = 0): DateTime
    {
        $hd = new Hijri($d);
        $jd = new Julian($hd->toJulian($adjustment));

        return $jd->toGregorian();

    }
}