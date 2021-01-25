<?php

namespace App\Models;

class Console extends ElectronicItem
{
    /**
     * Console constructor.
     * @param float $price
     * @param bool $wired
     */
    function __construct(float $price = 0.00, bool $wired = false)
    {
        parent::__construct($price, $wired);

        $this->type = self::ELECTRONIC_ITEM_CONSOLE;
        $this->extrasMax = 4;
    }
}
