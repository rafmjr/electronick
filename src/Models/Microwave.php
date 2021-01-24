<?php

namespace App\Models;

class Microwave extends ElectronicItem
{
    function __construct(float $price = 0.00, bool $wired = false)
    {
        parent::__construct($price, $wired);

        $this->type = self::ELECTRONIC_ITEM_MICROWAVE;
        $this->extrasMax = 0;
    }
}
