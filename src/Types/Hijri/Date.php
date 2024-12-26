<?php

namespace IslamicNetwork\Calendar\Types\Hijri;

class Date
{
    public Day $day;
    public int $year;
    public Month $month;
    public string $method;
    public array $holidays = [];

    public function __construct(Day $day, Month $month, int $year, string $method, array $holidays)
    {
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
        $this->method = $method;
        $this->holidays = $holidays;
    }
}