<?php

namespace IslamicNetwork\Calendar\Types\Hijri;

class Day
{
    public int $number;
    public string $en;

    public string $ar;

    public function __construct(int $number, string $en, string $ar)
    {
        $this->number = $number;
        $this->en = $en;
        $this->ar = $ar;
    }
}