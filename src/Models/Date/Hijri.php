<?php

namespace IslamicNetwork\Calendar\Models\Date;

use IslamicNetwork\Calendar\Helpers;

class Hijri
{
    /**
     * @var string Hijri Date dd-mm-yyyy
     */
    private string $date;

    public function __construct(string $date)
    {
        $this->date = $date;
    }

    public function toJulian(): float
    {
        $d = explode("-", $this->date);
        $y = (int) $d[2];
        $m = (int) $d[1];
        $d = (int) $d[0];

       return Helpers\Date::intPart((11 * $y + 3) / 30) + 354 * $y + 30 * $m - Helpers\Date::intPart(($m - 1) / 2) + $d + 1948440 - 385;
    }



}