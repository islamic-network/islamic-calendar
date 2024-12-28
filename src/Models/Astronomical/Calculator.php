<?php

namespace IslamicNetwork\Calendar\Models\Astronomical;

use DateTime;
use IslamicNetwork\Calendar\Models\Date\Gregorian;
use IslamicNetwork\Calendar\Models\Date\Hijri;
use IslamicNetwork\Calendar\Models\Date\Julian;
use IslamicNetwork\Calendar\Types;
use Exception;

class Calculator
{

    /**
     * @var array Method Data from Data\Astronomincal
     */
    protected array $data;

    /**
     * @var int
     */
    protected int $lunations;

    protected DateTime $validGregorianFrom;

    protected DateTime $validGregorianTo;

    protected DateTime $validHijriFrom;

    protected DateTime $validHijriTo;


    /**
     * @throws Exception
     */
    public function verifyGregorianInputDate(DateTime $inputDate): void
    {
        if ($inputDate < $this->validGregorianFrom) {
            throw new Exception('Gregorian date must be after ' . $this->validGregorianFrom->format('r'));
        }

        if ($inputDate > $this->validGregorianTo) {
            throw new Exception('Gregorian date must be before ' . $this->validGregorianTo->format('r'));
        }

    }

    /**
     * @throws Exception
     */
    public function verifyHijriInputDate(string $inputDate): void
    {
        // Hijri Dates don't really work with the timestamp creation, but we can force that over here
        $inputDate = DateTime::createFromFormat('d-m-Y', $inputDate);
        if ($inputDate < $this->validHijriFrom) {
            throw new Exception('Hijri date must be after ' . $this->validHijriFrom->format('d-m-Y'));
        }

        if ($inputDate > $this->validHijriTo) {
            throw new Exception('Hijri date must be before ' . $this->validHijriTo->format('d-m-Y'));
        }

    }

    /**
     * Get Hijri Date from Gregorian Date
     * @param string $d Gregorian date string in the format dd-mm-yyyy
     * @return Types\Hijri\Date
     * @throws Exception
     */
    public function gToH(string $d): Types\Hijri\Date
    {
        $d = DateTime::createFromFormat('d-m-Y', $d);
        $this->verifyGregorianInputDate($d);

        $gd = new Gregorian($d);
        $jd = new Julian($gd->toJulian());

        return $jd->toHijri($this->data, $this->lunations, static::ID);

    }

    /**
     * Get Gregorian Date from Hijri Date
     * @param string $d Hijri date string in the format dd-mm-yyyy
     * @return DateTime
     */
    public function hToG(string $d): DateTime
    {
        $this->verifyHijriInputDate($d);
        $hd = new Hijri($d);
        $jd = new Julian($hd->toJulian());

        return $jd->toGregorian();

    }
}