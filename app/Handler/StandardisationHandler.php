<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

/**
 * Class StandardisationHandler
 */
class StandardisationHandler
{
    /**
     * @param $phoneNumber
     * @param $countryCode
     *
     * @return string
     */
    public function handle($phoneNumber, $countryCode): string
    {
        $phoneNumberUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneNumber = preg_replace('/\D/', '', $phoneNumber);
            $numberProto = $phoneNumberUtil->parse($phoneNumber, $countryCode);

            if (!$phoneNumberUtil->isValidNumber($numberProto)) {
                return $phoneNumber;
            }

            return $phoneNumberUtil->format($numberProto, PhoneNumberFormat::E164);
        } catch (Exception $e) {
            //Нужно в лог добавить информацию об ошибке
            return $phoneNumber;
        }
    }
}
