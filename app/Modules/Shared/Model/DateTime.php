<?php

namespace App\Modules\Shared\Model;

use DateTime as GlobalDateTime;
use DateTimeZone;

class DateTime extends GlobalDateTime
{
    public function __construct(string $datetime = 'now', DateTimeZone|null $timezone = null)
    {
        $timezone ??= new DateTimeZone(config('app.timezone'));

        parent::__construct($datetime, $timezone);

        $this->setTimezone($timezone);

        return $this;
    }
}
