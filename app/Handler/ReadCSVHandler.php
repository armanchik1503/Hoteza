<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use League\Csv\Reader;

/**
 * Class ReadCSVHandler
 */
class ReadCSVHandler
{
    /**
     * @param \App\Handler\StandardisationHandler $standardisationHandler
     */
    public function __construct(
        private readonly StandardisationHandler $standardisationHandler
    ) {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $standardizedPhoneNumbers = [];
            $csv                      = Reader::createFromPath(storage_path('app/public/phones.csv'));
            $csv->setHeaderOffset(0);

            foreach ($csv as $record) {
                $phoneNumber = data_get($record, 'phone');
                $countryCode = data_get($record, 'country');

                $standardizedPhoneNumber    = $this->standardisationHandler->handle($phoneNumber, $countryCode);
                $standardizedPhoneNumbers[] = [
                    'number' => $standardizedPhoneNumber,
                    'code'   => $countryCode,
                ];
            }

            return $standardizedPhoneNumbers;
        } catch (Exception $e) {
            //Использование логирование если ошибка
        }

        return [];
    }
}
