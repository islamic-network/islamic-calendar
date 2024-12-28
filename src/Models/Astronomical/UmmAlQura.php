<?php

namespace IslamicNetwork\Calendar\Models\Astronomical;

use DateTime;
use IslamicNetwork\Calendar\Data\Astronomical;

class UmmAlQura extends Calculator
{
    public const ID = 'UAQ';
    public const NAME = 'Umm al-Qura';
    public const DESCRIPTION = 'The Umm Al-Qura Calender based on astronomical data provided by the Umm al-Qura University in Makkah, Saudi Arabia. Strictly speaking, this calendar is intended for civil purposes only. Please keep in mind that the first visual sighting of the lunar crescent (hilāl) can occur up to two days after the date predicted by the Umm al-Qura calendar.';
    public const VALIDITY_PERIOD = '1356 AH (14 March 1937 CE) to 1500 AH (16 November 2077 CE)';

    public function __construct()
    {
        $this->validGregorianFrom = DateTime::createFromFormat('d-m-Y', '14-03-1937');
        $this->validGregorianTo = DateTime::createFromFormat('d-m-Y', '16-11-2077');
        // Hijri dates don't work with DateTime, but we are just using these here to size comparison.
        $this->validHijriFrom = DateTime::createFromFormat('d-m-Y', '01-01-1356');
        $this->validHijriTo = DateTime::createFromFormat('d-m-Y', '30-12-1500');
        $this->data = Astronomical::ummAlQura();
        $this->lunations = 16260;
    }

}