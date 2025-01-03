<?php

namespace IslamicNetwork\Calendar\Models\Astronomical;

use DateTime;
use IslamicNetwork\Calendar\Data\Astronomical;
use IslamicNetwork\Calendar\Helpers\Calendar;
use IslamicNetwork\Calendar\Helpers\Date;
use IslamicNetwork\Calendar\Models\Date\Gregorian;
use IslamicNetwork\Calendar\Models\Date\Hijri;
use IslamicNetwork\Calendar\Models\Date\Julian;
use IslamicNetwork\Calendar\Types;

class HighJudiciaryCouncilOfSaudiArabia extends Calculator
{
    public const ID = 'HJCoSA';
    public const NAME = 'Majlis al-Qadāʾ al-Aʿlā (High Judiciary Council of Saudi Arabia)';
    public const DESCRIPTION = 'This calendar is based on the Umm al-Qura calendar, but the dates for the months of Muḥarram, Ramaḍān, Shawwāl and Dhu ʾl-Ḥijja are adjusted after reported sightings of the lunar crescent announced by the Majlis al-Qadāʾ al-Aʿlā (High Judiciary Council of Saudi Arabia). Please also see https://webspace.science.uu.nl/~gent0113/islam/ummalqura_adjust.htm for more details.';
    public const VALIDITY_PERIOD = '1356 AH (14 March 1937 CE) to 1500 AH (16 November 2077 CE)';

    /**
     * @var array Actual Crescent Sightings in KSA
     */
    public array $adjustments;

    /**
     * @var array|int[]|string[] Calculated from $this->adjustments in the constuctor
     */
    public array $reverseAdjustments = [];

    public function __construct()
    {
        $this->validGregorianFrom = DateTime::createFromFormat('d-m-Y', '14-03-1937');
        $this->validGregorianTo = DateTime::createFromFormat('d-m-Y', '16-11-2077');
        // Hijri dates don't work with DateTime, but we are just using these here to size comparison.
        $this->validHijriFrom = DateTime::createFromFormat('d-m-Y', '01-01-1356');
        $this->validHijriTo = DateTime::createFromFormat('d-m-Y', '30-12-1500');
        $this->adjustments = Calendar::getHJCoSALunarSightings();
        $this->reverseAdjustments = array_flip($this->adjustments);
        $this->data = Astronomical::ummAlQura();
        $this->lunations = 16260;
    }

    /**
     * Get Hijri Date from Gregorian Date
     * @param string $d Gregorian date string in the format dd-mm-yyyy
     * @return Types\Hijri\Date
     * @throws \Exception
     */
    public function gToH(string $d): Types\Hijri\Date
    {
        $d = DateTime::createFromFormat('d-m-Y', $d);
        $this->verifyGregorianInputDate($d);

        $adjusted = $this->adjustGregorian($d);

        if ($adjusted === null) {
            $gd = new Gregorian($d);
            $jd = new Julian($gd->toJulian());

            return $jd->toHijri($this->data, $this->lunations, self::ID);
        }

        return $adjusted;
    }

    /**
     * Get Gregorian Date from Hijri Date
     * @param string $d Hijri date string in the format dd-mm-yyyy
     * @return DateTime
     * @throws \Exception
     */
    public function hToG(string $d, int $adjustJulian = 0): DateTime
    {
        $this->verifyHijriInputDate($d);
        $adjusted = $this->adjustHijri($d);

        if ($adjusted === null) {
            $hd = new Hijri($d);
            $jd = new Julian($hd->toJulian($adjustJulian));

            return $jd->toGregorian();
        }

        return $adjusted;

    }

    /**
     * Returns the adjusted hijri date as per $this->adjustments
     * @param DateTime $d
     * @return Types\Hijri\Date|null
     */
    protected function adjustGregorian(DateTime $d): ?Types\Hijri\Date
    {
        if (isset($this->adjustments[$d->format('d-m-Y')])) {
            $hd = explode('-', $this->adjustments[$d->format('d-m-Y')]);
            // Use a middle date (7th) in the month to make sure we get the correct month as sightings usually adjust the beginning date of a hijri month
            $refHijriDateForMonthDays = 7 . '-' . $hd[1] . '-' . $hd[2];
            $h = new Hijri($refHijriDateForMonthDays);
            $jd = new Julian($h->toJulian());
            $refH = $jd->toHijri($this->data, $this->lunations, self::ID);

            return Date::hijriFormatted($hd[0], $hd[1], $hd[2], $refH->month->days, $d, self::ID);
        }

        return null;
    }

    /**
     * @param string $d Hijri date string 'dd-mm-yyyy'
     * @return DateTime|null
     */
    protected function adjustHijri(string $d): ?DateTime
    {
        $hd = explode('-', $d);

        // Make sure the day has 2 characters
        if ((int) $hd[0] < 10 && strlen($hd[0]) === 1) {
            $hd[0] = '0' . $hd[0];
        }

        // Make sure the month has 2 characters
        if ((int) $hd[1] < 10 && strlen($hd[1]) === 1) {
            $hd[1] = '0' . $hd[1];
        }

        $hd = implode('-', [$hd[0], $hd[1], $hd[2]]);

        if (isset($this->reverseAdjustments[$hd])) {
            return DateTime::createFromFormat('d-m-Y', $this->reverseAdjustments[$hd]);
        }

        return null;
    }


}