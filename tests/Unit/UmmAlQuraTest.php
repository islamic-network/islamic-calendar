<?php
namespace IslamicNetwork\Calendar\Tests\Unit;

use IslamicNetwork\Calendar\Models\Astronomical\UmmAlQura;
use IslamicNetwork\Calendar\Types\Hijri\Date;
use PHPUnit\Framework\TestCase;


class UmmAlQuraTest extends TestCase
{

    public function testGtoH()
    {
        $x = new UmmAlQura();
        $y = $x->gToH('14-02-2025');
        $this->assertInstanceOf(Date::class, $y);
        $this->assertEquals($y->year, 1446);
        $this->assertEquals($y->day->number, 15);
        $this->assertEquals($y->day->en, 'Al Juma\'a');
        $this->assertEquals($y->month->number, 8);
        $this->assertEquals($y->month->days, 29);
        $this->assertEquals($y->month->en, 'Shaʿbān');
    }

    public function testHtoG()
    {
        $x = new UmmAlQura();
        $y = $x->hToG('15-08-1446');
        $this->assertEquals($y->format('Y'), 2025);
        $this->assertEquals($y->format('m'), 2);
        $this->assertEquals($y->format('d'), 14);

    }


}