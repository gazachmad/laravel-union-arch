<?php

namespace App\Modules\Shared\Model;

use Exception;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumber as LibphonenumberPhoneNumber;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class PhoneNumber
{
    private LibphonenumberPhoneNumber $phone;

    public function __construct(string $phone, string $default_region = "ID")
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phone_parsed = $phoneUtil->parse($phone, $default_region);
        } catch (NumberParseException $e) {
            throw new Exception('Invalid phone number given');
        }

        if ($phoneUtil->isValidNumber($phone_parsed)) {
            $this->phone = $phone_parsed;
        } else {
            throw new Exception('Invalid phone number given');
        }
    }

    public function __toString(): string
    {
        return $this->getFormatE164();
    }

    public function getFormatNational(): string
    {
        return str_replace(
            " ",
            "",
            PhoneNumberUtil::getInstance()->format($this->phone, PhoneNumberFormat::NATIONAL)
        );
    }

    public function getFormatE164(): string
    {
        return str_replace(
            " ",
            "",
            PhoneNumberUtil::getInstance()->format($this->phone, PhoneNumberFormat::E164)
        );
    }

    public function getRegion(): ?string
    {
        return PhoneNumberUtil::getInstance()->getRegionCodeForNumber($this->phone);
    }
}
