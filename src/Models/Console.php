<?php

namespace App\Models;

class Console extends ElectronicItem
{
    function __construct(float $price = 0.00, bool $wired = false)
    {
        parent::__construct($price, $wired);

        $this->type = self::ELECTRONIC_ITEM_CONSOLE;
        $this->extrasMax = 4;
    }
}
