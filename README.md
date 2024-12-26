# Islamic / Hijri Calendar Calculation Library

This typed PHP library is an enhancement on the existing Hijri Calculations in the Al Adhan API (https://aladhan.com). It adds new calculation methods
and unit tests leaves room for additional calculation methods to be added.

It will be replacing the current calculation in the API from January 1, 2025 onwards.

## Supported Methods

This library supports the following methods for calculating the Hijri Date from a Gregorian Date:

* The existing mathematical method used on the aladhan.com API. *This is the only method that accepts an adjustment parameter.*
* The **Umm Al Qura** astronomical calculation method. This method only works (as of this writing, as the data gets enhanced more years may be supported) from 1356 AH to 2077 AH.
* The **High Judiciary Council of Saudi Arabia** calulcation method. This method is based on the Umm al-Qura calendar, but the dates for the months of Muḥarram, Ramaḍān, Shawwāl and Dhu ʾl-Ḥijja are adjusted after reported sightings of the lunar crescent announced by the Majlis al-Qadāʾ al-Aʿlā (High Judiciary Council of Saudi Arabia). Please also see https://webspace.science.uu.nl/~gent0113/islam/ummalqura_adjust.htm for more details.
* The **Diyanet astronomical** calculation method. This method only works (as of this writing, as the data gets enhanced more years may be supported) from 1318 AH to 1449 AH.

### Method Credits
Both the Umm Al Qura and Diyanet calendars are based on the work Robert Harry van Gent at https://webspace.science.uu.nl/~gent0113/islam/ and Tariq Alomaireeni at https://github.com/talomaireeni/Umm-Al-Qura-Calendar/tree/master?tab=readme-ov-file.

## Installation

```
composer require islamic-network/calendar
```

## Usage
Instantiate the Appropriate class for the method you are interested in.

### Umm al Qura

```php
use IslamicNetwork\Calendar\Models\Astronomical\UmmAlQura;

// This will become the default method in the AlAdhan API in 2025
$uaq = new UmmAlQura();
/**
* @var $hijriDate \IslamicNetwork\Calendar\Types\Hijri\Date
 */
$h = $uaq->gToH('14-02-2025');

/**
* @var $g DateTime
 */
$g = $uaq->hToG('15-08-1446');

// Access the typed hijri date object.
$h->day->number;
$h->month->number;

// And the standard DateTime object for the gregorian date
$g->format('Y-m-d');

```

### High Judiciary Council of Saudi Arabia

**This will become the default method in the AlAdhan API in 2025.**

```php
use IslamicNetwork\Calendar\Models\Astronomical\HighJudiciaryCouncilOfSaudiArabia;

// This will become the default method in the AlAdhan API in 2025
$hjcosa = new \IslamicNetwork\Calendar\Models\Astronomical\HighJudiciaryCouncilOfSaudiArabia();
/**
* @var $hijriDate \IslamicNetwork\Calendar\Types\Hijri\Date
 */
$h = $hjcosa->gToH('14-02-2025');

/**
* @var $g DateTime
 */
$g = $hjcosa->hToG('15-08-1446');

// Access the typed hijri date object.
$h->day->number;
$h->month->number;

// And the standard DateTime object for the gregorian date
$g->format('Y-m-d');

```

### Diyanet
```php
use IslamicNetwork\Calendar\Models\Astronomical\Diyanet;

$diyanet = new Diyanet();
/**
* @var $hijriDate \IslamicNetwork\Calendar\Types\Hijri\Date
 */
$h = $diyanet->gToH('14-02-2025');

/**
* @var $g DateTime
 */
$g = $diyanet->hToG('15-08-1446');

// Access the typed hijri date object.
$h->day->number;
$h->month->number;

// And the standard DateTime object for the gregorian date
$g->format('Y-m-d');

```

### Mathematical

This is the method used in the AlAdhan API prior to 2025.

```php
use IslamicNetwork\Calendar\Models\Mathematical\Calculator;

// This is the method used in the AlAdhan API prior to 2025
$mathematical = new Calculator();
/**
* @var $hijriDate \IslamicNetwork\Calendar\Types\Hijri\Date
 */
$h = $mathematical->gToH('14-02-2025');
// OR 
$h = $mathematical->gToH('14-02-2025', 1); // to adjust the resulting hijri date forward by 1 day

/**
* @var $g DateTime
 */
$g = $mathematical->hToG('15-08-1446');

// Access the typed hijri date object.
$h->day->number;
$h->month->number;

// And the standard DateTime object for the gregorian date
$g->format('Y-m-d');
```

## Run Unit Tests

```
vendor/bin/phpunit tests/
```

## License
Apache 2.0

