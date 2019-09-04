<?php

namespace IslamicNetwork\IslamicCalendar\Models;
use IslamicNetwork\IslamicCalendar\Models\Month;

class Date
{

    public $date;
    public $format = 'DD-MM-YY';
    public int $day;
    public object $weekday;
    public object $month;
    public int $year;
    public object $designation;
    public array $holidays;



}