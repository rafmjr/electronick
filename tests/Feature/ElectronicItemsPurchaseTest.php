<?php

namespace Tests\Feature;

use App\Models\Console;
use App\Models\Controller;
use App\Models\ElectronicItem;
use App\Models\ElectronicItems;
use App\Models\Microwave;
use App\Models\Television;
use PHPUnit\Framework\TestCase;

class ElectronicItemsPurchaseTest extends TestCase
{
    /** @test */
    public function it_the_sorts_item_by_price_and_outputs_total(): ElectronicItems
    {
        // given one console
        $console = new Console(499.99);
        $console->setExtras(array(new Controller, new Controller, new Controller(true), new Controller(true)));

        // given two televisions with different prices
        $tv = new Television(375.00);
        $tv->setExtras(array(new Controller, new Controller));

        $tvTwo = new Television(399.00);
        $tvTwo->setExtras(array(new Controller));

        // given one microwave
        $microwave = new Microwave(148.00);

        // given they are a set of electronic items
        $items = array($console, $tv, $tvTwo, $microwave);
        $electronicItems = new ElectronicItems($items);

        // when the method getSortedItems is called
        $sorted = $electronicItems->getSortedItems();

        // expect the items to be sorted by price
        $this->assertEquals(array($microwave, $tv, $tvTwo, $console), $sorted);

        // expect it outputs the total price
        $total = array_sum(array_map(function (ElectronicItem $item) { return $item->getPrice(); }, $items));
        $this->expectOutputString($total);
        $electronicItems->outputPrice();

        return $electronicItems;
    }

    /**
     * @test
     * @depends it_the_sorts_item_by_price_and_outputs_total
     */
    public function it_returns_price_for_console_and_controllers(ElectronicItems $electronicItems): void
    {
        // given the set of electronic items has at least one console
        $consoles = $electronicItems->getItemsByType(ElectronicItem::ELECTRONIC_ITEM_CONSOLE);
        $this->assertIsArray($consoles);
        $this->assertCount(1, $consoles);

        // let's use a sample to assert our expections
        list($console) = $consoles;
        $this->assertInstanceOf(Console::class, $console);

        // when someone asked for the console and its extras price
        $priceForConsoles = $electronicItems->getPriceByType(ElectronicItem::ELECTRONIC_ITEM_CONSOLE);

        // expect it returns their price
        $this->assertEquals($console->getPrice(), $priceForConsoles);
    }
}
