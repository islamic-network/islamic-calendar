<?php

namespace IslamicNetwork\Calendar\Models\Date;

use DateTime;
use IslamicNetwork\Calendar\Helpers\Date;

class Gregorian
{
    /**
     * @var DateTime Gregorian Date
     */
    private DateTime $date;

    public function __construct(DateTime $date)
    {
        $this->date = $date;
    }

    public function toJulian(): float
    {
        $y = $this->date->format('Y');
        $m = $this->date->format('m');
        $d = $this->date->format('d');

        Date::adjustFromGregorian($m, $y);
        $jgc = Date::offsetBetweenGregorianAndJulian($this->date);

        return  floor(365.25 * ($y + 4716)) + floor(30.6001 * ($m + 1)) + $d - $jgc - 1524;
    }





}