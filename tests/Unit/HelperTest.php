<?php

use PHPUnit\Framework\TestCase;


$tz = reset(iterator_to_array(IntlTimeZone::createEnumeration('GB')));
$formatter = IntlDateFormatter::create(
    'en_GB',
    IntlDateFormatter::FULL,
    IntlDateFormatter::FULL,
    $tz,
    IntlDateFormatter::GREGORIAN,
    'd M Y'
);

$cal = IntlCalendar::createInstance($tz, '@calendar=islamic-civil');
$cal->set(IntlCalendar::FIELD_MONTH, 8); //9th month, Ramadan
$cal->set(IntlCalendar::FIELD_DAY_OF_MONTH, 1); //1st day
$cal->clear(IntlCalendar::FIELD_HOUR_OF_DAY);
$cal->clear(IntlCalendar::FIELD_MINUTE);
$cal->clear(IntlCalendar::FIELD_SECOND);
$cal->clear(IntlCalendar::FIELD_MILLISECOND);

echo "In this islamic year, Ramadan started/will start on:\n\t",
$formatter->format($cal), "\n";

//Itʼs the formatterʼs timezone that is used:
$formatter->setTimeZone('Asia/Abu Dhabi');
echo "After changing timezone:\n\t",
$formatter->format($cal), "\n";

class HelperTest extends TestCase
{

    public function testOne()
    {

    }


}