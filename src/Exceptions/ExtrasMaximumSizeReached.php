<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ExtrasMaximumSizeReached extends Exception
{
    /**
     * ExtrasMaximumSizeReached constructor.
     * @param int $max
     * @param array $items
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(int $max, array $items, string $message = '', int $code = 0, Throwable $previous = null)
    {
        if (empty($message)) {
            $size = count($items);
            $message = "Maximum number of extra items reached. Limit is {$max}, {$size} given.";
        }

        parent::__construct($message, $code, $previous);
    }
}
