<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Handler\ReadCSVHandler;
use Illuminate\Http\JsonResponse;

/**
 * Class StandardisationController
 */
class StandardisationController
{
    /**
     * @param \App\Handler\ReadCSVHandler $handler
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function standardisationNumber(ReadCSVHandler $handler): JsonResponse
    {
        return response()->json(['standardized_phone_numbers' => $handler->handle()]);
    }
}
