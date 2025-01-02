<?php

namespace IslamicNetwork\Calendar\Models\Date;

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

    public function toJulian(int $adjustJulian = 0): float
    {
        $d = explode("-", $this->date);
        $y = (int) $d[2];
        $m = (int) $d[1];
        $d = (int) $d[0];

        return (int) ((11 * $y + 3) / 30) + 354 * $y +
            30 * $m - (int) (($m - 1) / 2) + $d + 1948440 - 385 + $adjustJulian;
    }



}