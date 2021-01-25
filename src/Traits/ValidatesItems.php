<?php

namespace App\Traits;

use App\Exceptions\UnexpectedItemType;

trait ValidatesItems
{
    /**
     * Validates the items in the given array to be of the expected type
     *
     * @param array $items
     * @param string $expectedType
     * @throws \App\Exceptions\UnexpectedItemType
     */
    public function validate(array $items, string $expectedType): void
    {
        foreach ($items as $item) {
            if (!is_a($item, $expectedType)) {
                throw new UnexpectedItemType($item, $expectedType);
            }
        }
    }
}
