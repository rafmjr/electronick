<?php

namespace App\Models;

class Television extends ElectronicItem
{
    /**
     * Television constructor.
     * @param float $price
     * @param bool $wired
     */
    function __construct(float $price = 0.00, bool $wired = true)
    {
        parent::__construct($price, $wired);

        $this->type = self::ELECTRONIC_ITEM_TELEVISION;
    }
}
