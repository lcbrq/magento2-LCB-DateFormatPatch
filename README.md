# LCB_DateFormatPatch

Yet another patch for "Invalid input datetime format of value" +00201717  problem in Magento 2.  

Problem can originate from not strict IntlDateFormatter behaviour returning either 'dd.MM.y' or 'dd.MM.yyyy' short pattern depending on the ICU Data version.  

```php
<?php

date_default_timezone_set("Europe/Warsaw");
locale_set_default('en_US_POSIX');

$format = (new \IntlDateFormatter(
        'pl_PL', \IntlDateFormatter::SHORT, \IntlDateFormatter::NONE
        ))->getPattern();

echo $format;
```

Result can be dd.MM.y or dd.MM.yyyy where Magento does accept dd.MM.y for datetime elements.  
