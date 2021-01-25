<?php

namespace App\Models;

use App\Models\ElectronicItem;
use App\Traits\ValidatesItems;

class ElectronicItems
{
    use ValidatesItems;

    /**
     * @var array
     */
    private $items = array();

    /**
     * @param array $items
     * @throws \App\Exceptions\UnexpectedItemType
     */
    public function __construct(array $items)
    {
        $this->validate($items, ElectronicItem::class);
        $this->items = $items;
    }

    /**
     * Returns the items depending on the sorting type requested
     *
     * @return array
     */
    public function getSortedItems(): array
    {
        // avoid any undesidered mutations
        $sorted = array_values($this->items);

        // callback to compare items while avoiding merge items with the same price
        $callback = function (ElectronicItem $itemA, ElectronicItem $itemB) {
            if ($itemA->getPrice() > $itemB->getPrice()) {
                return 1;
            } else if ($itemA->getPrice() < $itemB->getPrice()) {
                return -1;
            }
            return 0;
        };

        // sort the items and return the value
        usort($sorted, $callback);
        return $sorted;
    }

    /**
     * Returns the items depending on the type requested
     *
     * @param string $type
     * @return bool|array
     */
    public function getItemsByType(string $type)
    {
        if (!in_array($type, ElectronicItem::getTypes())) {
            return false;
        }

        $callback = function ($item) use ($type) {
            return $item->getType() == $type;
        };

        return array_filter($this->items, $callback);
    }

    /**
     * Outputs the total price for items
     *
     * @return void
     */
    public function outputPrice(): void
    {
        $totalPrice = array_reduce($this->items, function($carry, ElectronicItem $item) {
            return $carry + $item->getPrice();
        }, 0);

        echo $totalPrice;
    }

    /**
     * Returns the price for a given ElectronicItem type
     *
     * @param string $type
     * @return bool|float total price for items of the specified type or false when missing
     */
    public function getPriceByType(string $type)
    {
        $items = $this->getItemsByType($type);

        if (is_array($items)) {
            $total = 0.00;
            foreach ($items as $item) {
                $total += $item->getPrice();
            }

            return $total;
        }

        return false;
    }
}
