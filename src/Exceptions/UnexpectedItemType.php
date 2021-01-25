<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class UnexpectedItemType extends Exception
{
    /**
     * UnexpectedItemType constructor.
     * @param $receivedItem
     * @param $expectedType
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($receivedItem, $expectedType, string $message = '', int $code = 0, Throwable $previous = null)
    {
        if (empty($message)) {
            $itemType = gettype($receivedItem);
            $message = "Unexpected item of type {$itemType} given. Item must be of type $expectedType";
        }

        parent::__construct($message, $code, $previous);
    }
}
