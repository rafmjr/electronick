<?php

namespace App\Models;

class ElectronicItems
{
    /**
     * [$items description]
     * @var array
     */
    private $items = array();

    /**
     * [__construct description]
     * @param array $items [description]
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Returns the items depending on the sorting type requested
     *
     * @return array
     */
    public function getSortedItems($type)
    {
        $sorted = array();
        return ksort($sorted, SORT_NUMERIC);
    }

    /**
     * [getItemsByType description]
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    public function getItemsByType($type)
    {
        // FIXME: $types access is private
        if (in_array($type, ElectronicItem::$types)) {
            $callback = function ($item) use ($type) {
                return $item->type == $type;
            };
        }

        $items = array_filter($this->items, $callback);
        return false;
    }
}
