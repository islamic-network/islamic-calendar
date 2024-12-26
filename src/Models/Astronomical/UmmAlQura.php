<?php

namespace IslamicNetwork\Calendar\Models\Astronomical;

use IslamicNetwork\Calendar\Data\Astronomical;

class UmmAlQura extends Calculator
{
    public function __construct()
    {
        $this->data = Astronomical::ummAlQura();
        $this->lunations = 16260;
        $this->id = 'UAQ';
        $this->name = 'Umm al-Qura';
        $this->description ='The Umm Al-Qura Calender based on astronomical data provided by the Umm al-Qura University in Makkah, Saudi Arabia. Strictly speaking, this calendar is intended for civil purposes only. Please keep in mind that the first visual sighting of the lunar crescent (hilāl) can occur up to two days after the date predicted by the Umm al-Qura calendar.';
        $this->validityPeriod = '1356 AH (14 March 1937 CE) to 1500 AH (16 November 2077 CE)';
    }

}