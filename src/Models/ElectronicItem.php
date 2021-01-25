<?php

namespace App\Models;

use App\Exceptions\ExtrasMaximumSizeReached;
use App\Traits\ValidatesItems;

abstract class ElectronicItem
{
    use ValidatesItems;

    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    const ELECTRONIC_ITEM_TELEVISION = 'television';
    const ELECTRONIC_ITEM_CONTROLLER = 'controller';

    /**
     * @var array
     */
    private static $types = array(
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_MICROWAVE,
        self::ELECTRONIC_ITEM_TELEVISION,
        self::ELECTRONIC_ITEM_CONTROLLER,
    );

    /**
     * @var float
     */
    protected $price;

    /**
     * @var bool
     */
    protected $wired;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $extras = array();

    /**
     * @var int
     */
    protected $extrasMax = -1;

    function __construct(float $price = 0.00, bool $wired = false)
    {
        $this->price = $price;
        $this->wired = $wired;
    }

    public static function getTypes(): array
    {
        return self::$types;
    }

    public function setWired(bool $wired): void
    {
        $this->wired = $wired;
    }

    public function getWired(): bool
    {
        return $this->wired;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param array $extras
     * @throws \App\Exceptions\ExtrasMaximumSizeReached
     * @throws \App\Exceptions\UnexpectedItemType
     */
    public function setExtras(array $extras): void
    {
        if ($this->extrasMax > 0 && count($extras) > $this->extrasMax) {
            throw new ExtrasMaximumSizeReached($this->extrasMax, $extras);
        }

        $this->validate($extras, self::class);

        $this->extras = $extras;
    }

    public function getExtras(): array
    {
        return $this->extras;
    }

    /**
     * @param int $max
     * @throws \App\Exceptions\ExtrasMaximumSizeReached
     */
    public function maxExtras(int $max): void
    {
        if (count($this->extras) > $max) {
            throw new ExtrasMaximumSizeReached($max, $this->extras);
        }

        $this->extrasMax = $max;
    }

    public function getExtrasMaximum(): int
    {
        return $this->extrasMax;
    }
}
