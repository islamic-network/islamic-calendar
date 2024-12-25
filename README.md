# Islamic / Hijri Calendar Calculation Library

This PHP library is an enhancement on the existing Hijri Calculations in the Al Adhan API (https://aladhan.com). It adds newer calculation methods
and unit tests leaves from for additional calculation methods to be added.

It will be replacing the current calculation in the API from January 1, 2025 onwards.

## Supported Methods

This library supports the follwoing methods for calculating the Hijri Date from a Gregorian Date:

* The existing mathematical method used on the aladhan.com API
* The **Umm Al Qura** astronomical calculation method. This method only works (as of this writing, as the data gets enhanced more years may be supported) from 1356 AH to 2077 AH).
* The **Diyanet astronomincal** calculation method. This method only works (as of this writing, as the data gets enhanced more years may be supported) from 1318 AH to 1449 AH).

### Method Credits
Both the Umm Al Qura and Diyanet calendars are based on the work Robert Harry van Gent at https://webspace.science.uu.nl/~gent0113/islam/ and Tariq Alomaireeni at https://github.com/talomaireeni/Umm-Al-Qura-Calendar/tree/master?tab=readme-ov-file.

## Installation

```
composer require 
```

## License
Apache 2.0

