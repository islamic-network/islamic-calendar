<?php

namespace IslamicNetwork\Calendar\Models\Astronomical;

use IslamicNetwork\Calendar\Data\Astronomical;

class Diyanet extends Calculator
{
    public function __construct()
    {
        $this->data = Astronomical::diyanet();
        $this->lunations = 15804;
    }

}