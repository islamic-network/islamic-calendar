<?php

namespace IslamicNetwork\Calendar\Types\Hijri;

class Date
{
    public Day $day;
    public int $year;
    public Month $month;
    public array $holidays = [];

    public function __construct(Day $day, Month $month, int $year, array $holidays)
    {
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
        $this->holidays = $holidays;
    }
}