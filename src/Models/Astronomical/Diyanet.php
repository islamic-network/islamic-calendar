<?php

namespace IslamicNetwork\Calendar\Models\Astronomical;

use IslamicNetwork\Calendar\Data\Astronomical;

class Diyanet extends Calculator
{
    public function __construct()
    {
        $this->data = Astronomical::diyanet();
        $this->lunations = 15804;
        $this->id = "DIYANET";
        $this->name = "Diyanet İşleri Başkanlığı";
        $this->description = "The Islamic Calendar of Tukey based on astronomical data provided by Turkish Presidency of Religious Affairs (Diyanet İşleri Başkanlığı.";
        $this->validityPeriod = '1 Muharram 1318 AH (1 May 1900) to 29 Şaban 1449 AH (26 January 2028)';
    }

}