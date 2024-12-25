<?php
namespace IslamicNetwork\Calendar\Tests\Unit;

use IslamicNetwork\Calendar\Models\Astronomical\Diyanet;
use IslamicNetwork\Calendar\Models\Mathematical\Calculator;
use IslamicNetwork\Calendar\Types\Hijri\Date;
use PHPUnit\Framework\TestCase;


class MathematicalTest extends TestCase
{

    public function testGtoH()
    {
        $x = new Calculator();
        $y = $x->gToH('14-02-2025');
        $this->assertInstanceOf(Date::class, $y);
        $this->assertEquals($y->year, 1446);
        $this->assertEquals($y->day->number, 15);
        $this->assertEquals($y->day->en, 'Al Juma\'a');
        $this->assertEquals($y->month->number, 8);
        $this->assertEquals($y->month->days, 30);
        $this->assertEquals($y->month->en, 'Shaʿbān');
    }

    public function testHtoG()
    {
        $x = new Diyanet();
        $y = $x->hToG('15-08-1446');
        $this->assertEquals($y->format('Y'), 2025);
        $this->assertEquals($y->format('m'), 2);
        $this->assertEquals($y->format('d'), 14);

    }


}