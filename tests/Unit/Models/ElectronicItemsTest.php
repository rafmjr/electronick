<?php

namespace Tests\Unit\Models;

use App\Exceptions\UnexpectedItemType;
use App\Models\Console;
use App\Models\Controller;
use App\Models\ElectronicItem;
use App\Models\ElectronicItems;
use App\Models\Microwave;
use App\Models\Television;
use PHPUnit\Framework\TestCase;

class ElectronicItemsTest extends TestCase
{
    /**
     * @var array
     */
    protected $itemsArray;

    /**
     * @var \App\Models\ElectronicItems
     */
    protected $electronicItems;

    public function setUp(): void
    {
        parent::setUp();

        // given a set of electronic items with the following components:
        $this->itemsArray = array(
            // one console
            new Console(3.00),

            // one microwave
            new Microwave(1.00),

            // two televisions
            new Television(2.00),
            new Television(2.00),
        );

        $this->electronicItems = new ElectronicItems($this->itemsArray);
    }

    /** @test */
    public function it_returns_items_by_type(): void
    {
        // when it is asked for items of type television
        $televisions = $this->electronicItems->getItemsByType(ElectronicItem::ELECTRONIC_ITEM_TELEVISION);

        // expect its return value to be an array of electronic items
        $this->assertIsArray($televisions);

        // expect the count matches the number of televisions added to the set
        $this->assertCount(2, $televisions);

        foreach ($televisions as $television) {
            // assert each item is at least a subclass of ElectronicItem in order to avoid coupling between types and
            // the classes, allowing for multiple types of televisions
            $this->assertInstanceOf(ElectronicItem::class, $television);
            // all of the electronic items in that array are of the type requested
            $this->assertEquals(ElectronicItem::ELECTRONIC_ITEM_TELEVISION, $television->getType());
        }
    }

    /** @test */
    public function it_returns_empty_array_when_it_doesnt_contain_items_of_a_type()
    {
        // when it is asked for items of type controller
        $controllers = $this->electronicItems->getItemsByType(ElectronicItem::ELECTRONIC_ITEM_CONTROLLER);

        // expect it to return false, as it was not given any controllers during setup
        $this->assertEmpty($controllers);
    }

    /** @test */
    public function it_returns_false_when_it_is_asked_for_an_undefined_type()
    {
        // when it is asked for items of type controller
        $result = $this->electronicItems->getItemsByType('some undefined type');

        // expect it to return false, as it was not given any controllers during setup
        $this->assertFalse($result);
    }

    /** @test */
    public function it_sorts_items_by_price(): void
    {
        // when it is asked to sort items by price
        $sorted = $this->electronicItems->getSortedItems();

        // expect it to return the same amount of sorted items as the original items
        $this->assertCount(count($this->itemsArray), $sorted);

        // expect the items to be sorted by their price in ascending order
        $expected = array($this->itemsArray[1], $this->itemsArray[2], $this->itemsArray[3], $this->itemsArray[0]);
        $this->assertEquals($expected, $sorted);
    }

    /** @test */
    public function it_outputs_total_price_for_items(): void
    {
        $total = array_sum(array_map(function (ElectronicItem $item) { return $item->getPrice(); }, $this->itemsArray));
        $this->expectOutputString($total);
        $this->electronicItems->outputPrice();
    }

    /** @test */
    public function it_validates_given_items_to_be_electronic_items(): void
    {
        // expect an exception to be thrown
        $this->expectException(UnexpectedItemType::class);

        // when a one of the elements given to the constructor is not an instance of ElectronicItem
        new ElectronicItems(array(1, 2, 3));;
    }
}
