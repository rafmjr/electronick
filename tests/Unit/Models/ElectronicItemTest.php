<?php

namespace Tests\Unit\Models;

use App\Exceptions\ExtrasMaximumSizeReached;
use App\Exceptions\UnexpectedItemType;
use App\Models\Console;
use App\Models\Controller;
use App\Models\Television;
use PHPUnit\Framework\TestCase;

class ElectronicItemTest extends TestCase
{
    /** @test */
    public function it_limits_the_number_of_extras_when_adding_extras(): void
    {
        // given an instance of ElectronicItem
        $console = new Console;

        // and given a maximum of extras has been established
        $console->maxExtras(2);

        // expect an exception to be thrown
        $this->expectException(ExtrasMaximumSizeReached::class);

        // when adding more extras than allowed
        $console->setExtras(array(new Controller, new Controller, new Controller));
    }

    /** @test */
    public function it_limits_the_number_of_extras_when_setting_max(): void
    {
        // given an instance of ElectronicItem
        $console = new Console;

        // and given it has already been given a set of extras
        $console->setExtras(array(new Controller, new Controller, new Controller));

        // expect an exception to be thrown
        $this->expectException(ExtrasMaximumSizeReached::class);

        // when establishing a maximum of extras lower than their current count
        $console->maxExtras(2);
    }

    /** @test */
    public function it_validates_extras_to_be_electronic_items(): void
    {
        // given an instance of electronic item
        $television = new Television;

        // expect an exception to be thrown
        $this->expectException(UnexpectedItemType::class);

        // when a one of the elements given to setExtras is not an instance of ElectronicItem
        $television->setExtras(array(new Controller(), array()));
    }
}
