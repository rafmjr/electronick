<?php

namespace App\Models;

abstract class ElectronicItem
{
    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    const ELECTRONIC_ITEM_TELEVISION = 'television';
    const ELECTRONIC_ITEM_CONTROLLER = 'controller';

    /**
     * [$types description]
     * @var array
     */
    private static $types = array(
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_MICROWAVE,
        self::ELECTRONIC_ITEM_TELEVISION,
    );

    /**
     * [$price description]
     * @var float
     */
    protected $price;

    /**
     * [$wired description]
     * @var bool
     */
    protected $wired;

    /**
     * [$type description]
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $extras = array();

    /**
     * [$extrasMax description]
     * @var [type]
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

    public function setExtras(array $extras): void
    {
        // TODO: validate array's content and size and throw domain exception
        $this->extras = $extras;
    }

    public function getExtras(): array
    {
        return $this->extras;
    }

    public function maxExtras(int $max): void
    {
        $this->extrasMax = $max;
    }

    public function getExtrasMaximum(): int
    {
        return $this->extrasMax;
    }
}
