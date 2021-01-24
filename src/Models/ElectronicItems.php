<?php

namespace App\Models;

class ElectronicItems
{
    /**
     * @var array
     */
    private $items = array();

    /**
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Returns the items depending on the sorting type requested
     *
     * @param string $type
     * @return array
     */
    public function getSortedItems(): array
    {
        $sorted = array();
        foreach ($this->items as $item) {
            $sorted[($item->getPrice() * 100)] = $item;
        }
        ksort($sorted, SORT_NUMERIC);

        return array_values($sorted);
    }

    /**
     * Returns the items depending on the type requested
     *
     * @param string $type
     * @return mixed
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
        echo array_reduce($this->items, function($carry, ElectronicItem $item) {
            return $carry + $item->getPrice();
        }, 0);
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
