<?php

namespace IslamicNetwork\Calendar\Models\Astronomical;

use IslamicNetwork\Calendar\Data\Astronomical;

class Diyanet extends Calculator
{
    public const string ID = 'DIYANET';
    public const string NAME = 'Diyanet İşleri Başkanlığı';
    public const string DESCRIPTION = 'The Islamic Calendar of Tukey based on astronomical data provided by Turkish Presidency of Religious Affairs (Diyanet İşleri Başkanlığı.';
    public const string VALIDITY_PERIOD = '1 Muharram 1318 AH (1 May 1900) to 29 Şaban 1449 AH (26 January 2028)';
    public function __construct()
    {
        $this->data = Astronomical::diyanet();
        $this->lunations = 15804;
    }

}