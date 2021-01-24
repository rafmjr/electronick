<?php

namespace App\Models;

abstract class ElectronicItem
{
    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    const ELECTRONIC_ITEM_TELEVISION = 'television';

    /**
     * [$types description]
     * @var array
     */
    private static $types = array(
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_MICROWAVE,
        self::ELECTRONIC_ITEM_TELEVISION,
    );

    // TODO: encapsulate these properties
    /**
     * [$price description]
     * @var float
     */
    public $price;

    /**
     * [$wired description]
     * @var bool
     */
    public $wired;

    /**
     * [$type description]
     * @var string
     */
    private $type;

    /**
     * TODO: can this be an instance of ElectronicItems?
     * [$extras description]
     * @var array
     */
    protected $extras;

    /**
     * [$extras_limit description]
     * @var [type]
     */
    protected $extras_limit;

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
        $this->extras_limit = $max;
    }

    public function getExtrasMaximum(): int
    {
        return $this->extras_limit;
    }
}
