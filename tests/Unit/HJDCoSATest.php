<?php
namespace IslamicNetwork\Calendar\Tests\Unit;

use IslamicNetwork\Calendar\Models\Astronomical\HighJudiciaryCouncilOfSaudiArabia;
use IslamicNetwork\Calendar\Types\Hijri\Date;
use PHPUnit\Framework\TestCase;
use Exception;

class HJDCoSATest extends TestCase
{

    public function testGtoH()
    {
        $x = new HighJudiciaryCouncilOfSaudiArabia();
        $y = $x->gToH('14-02-2025');
        $this->assertInstanceOf(Date::class, $y);
        $this->assertEquals($y->year, 1446);
        $this->assertEquals($y->day->number, 15);
        $this->assertEquals($y->day->en, 'Al Juma\'a');
        $this->assertEquals($y->month->number, 8);
        $this->assertEquals($y->month->days, 29);
        $this->assertEquals($y->month->en, 'Shaʿbān');

        $y = $x->gToH('14-2-2025');
        $this->assertInstanceOf(Date::class, $y);
        $this->assertEquals($y->year, 1446);
        $this->assertEquals($y->day->number, 15);
        $this->assertEquals($y->day->en, 'Al Juma\'a');
        $this->assertEquals($y->month->number, 8);
        $this->assertEquals($y->month->days, 29);
        $this->assertEquals($y->month->en, 'Shaʿbān');

        $this->expectException(Exception::class);
        $y = $x->hToG('15-08-1155');

        $this->expectException(Exception::class);
        $y = $x->hToG('15-08-2236');
    }

    public function testGtoHOnAdjustedDate()
    {
        $x = new HighJudiciaryCouncilOfSaudiArabia();
        $y = $x->gToH('17-05-2018'); // This is the adjusted date for Ramadan 1, the calculated date is 16-May-2018.
        $this->assertInstanceOf(Date::class, $y);
        $this->assertEquals($y->year, 1439);
        $this->assertEquals($y->day->number, 1);
        $this->assertEquals($y->month->number, 9);

        $x = new HighJudiciaryCouncilOfSaudiArabia();
        $y = $x->gToH('17-5-2018'); // This is the adjusted date for Ramadan 1, the calculated date is 16-May-2018.
        $this->assertInstanceOf(Date::class, $y);
        $this->assertEquals($y->year, 1439);
        $this->assertEquals($y->day->number, 1);
        $this->assertEquals($y->month->number, 9);
    }


    public function testHtoG()
    {
        $x = new HighJudiciaryCouncilOfSaudiArabia();
        $y = $x->hToG('15-8-1446');
        $this->assertEquals($y->format('Y'), 2025);
        $this->assertEquals($y->format('m'), 2);
        $this->assertEquals($y->format('d'), 14);

        $this->expectException(Exception::class);
        $y = $x->hToG('15-08-1200');

        $this->expectException(Exception::class);
        $y = $x->hToG('15-08-1566');

    }

    public function testHtoGAdjustedDate()
    {
        $x = new HighJudiciaryCouncilOfSaudiArabia();
        $y = $x->hToG('01-09-1439');
        $this->assertEquals($y->format('Y'), 2018);
        $this->assertEquals($y->format('m'), 5);
        $this->assertEquals($y->format('d'), 17);

    }
}