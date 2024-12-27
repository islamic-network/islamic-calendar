<?php

namespace IslamicNetwork\Calendar\Models\Astronomical;

use DateTime;
use IslamicNetwork\Calendar\Models\Date\Gregorian;
use IslamicNetwork\Calendar\Models\Date\Hijri;
use IslamicNetwork\Calendar\Models\Date\Julian;
use IslamicNetwork\Calendar\Types;

class Calculator
{

    /**
     * @var array Method Data from Data\Astronomincal
     */
    protected array $data;

    /**
     * @var int
     */
    protected int $lunations;

    /**
     * Get Hijri Date from Gregorian Date
     * @param string $d Gregorian date string in the format dd-mm-yyyy
     * @return Types\Hijri\Date
     */
    public function gToH(string $d): Types\Hijri\Date
    {
        $d = DateTime::createFromFormat('d-m-Y', $d);

        $gd = new Gregorian($d);
        $jd = new Julian($gd->toJulian());

        return $jd->toHijri($this->data, $this->lunations, static::ID);

    }

    /**
     * Get Gregorian Date from Hijri Date
     * @param string $d Hijri date string in the format dd-mm-yyyy
     * @return DateTime
     */
    public function hToG(string $d): DateTime
    {
        $hd = new Hijri($d);
        $jd = new Julian($hd->toJulian());

        return $jd->toGregorian();

    }
}