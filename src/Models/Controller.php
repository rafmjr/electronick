<?php

namespace App\Models;

class Controller extends ElectronicItem
{
    function __construct(bool $wired = false)
    {
        parent::__construct(0.00, $wired);

        $this->type = self::ELECTRONIC_ITEM_CONTROLLER;
        $this->extrasMax = 0;
    }
}
