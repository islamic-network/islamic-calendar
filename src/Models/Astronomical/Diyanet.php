<?php

namespace IslamicNetwork\Calendar\Models\Astronomical;

use DateTime;
use IslamicNetwork\Calendar\Data\Astronomical;

class Diyanet extends Calculator
{
    public const ID = 'DIYANET';
    public const NAME = 'Diyanet İşleri Başkanlığı';
    public const DESCRIPTION = 'The Islamic Calendar of Tukey based on astronomical data provided by Turkish Presidency of Religious Affairs (Diyanet İşleri Başkanlığı.';
    public const VALIDITY_PERIOD = '1 Muharram 1318 AH (1 May 1900) to 29 Şaban 1449 AH (26 January 2028)';
    public function __construct()
    {
        $this->validGregorianFrom = DateTime::createFromFormat('d-m-Y', '01-05-1900');
        $this->validGregorianTo = DateTime::createFromFormat('d-m-Y', '26-01-2028');
        // Hijri dates don't work with DateTime, but we are just using these here to size comparison.
        $this->validHijriFrom = DateTime::createFromFormat('d-m-Y', '01-01-1318');
        $this->validHijriTo = DateTime::createFromFormat('d-m-Y', '29-08-1449');
        $this->data = Astronomical::diyanet();
        $this->lunations = 15804;
    }

}