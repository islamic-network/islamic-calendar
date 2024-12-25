<?php

namespace IslamicNetwork\Calendar\Models\Astronomical;

use IslamicNetwork\Calendar\Data\Astronomical;

class UmmAlQura extends Calculator
{
    public function __construct()
    {
        $this->data = Astronomical::ummAlQura();
        $this->lunations = 16260;
    }

}