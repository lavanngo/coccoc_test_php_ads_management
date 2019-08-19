<?php
namespace Tests\Order;

use App\Model\Order\Order;
use App\Model\Order\OrderItem;
use App\Model\Product\Product;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{

    protected function setUp(): void
    {

    }

    public function testOrderHasOneItemAndGrossPriceIs76()
    {
        $order = new Order();
        $product = new Product(10, 3, 1, 2, 1, '');
        $orderItem = new OrderItem($product);
        $order->addItem($orderItem);
        // test shipping fee
        $this->assertEquals(33, $orderItem->getShippingFee());
        // test gross price
        $this->assertEquals(43, $order->getGrossPrice());
    }

    public function testOrderHasTwoItemsAndGrossPriceCalculateShippingFeeByWeight()
    {
        $order = new Order();

        $product = new Product(10, 3, 1, 2, 1, '');
        $orderItem = new OrderItem($product);
        $order->addItem($orderItem);
        // test shipping fee
        $this->assertEquals(33, $orderItem->getShippingFee());
        // test item price
        $this->assertEquals(43, $orderItem->getItemPrice());
        // test gross price
        $this->assertEquals(43, $order->getGrossPrice());

        $product = new Product(20, 2.5, 1, 2, 1, '');
        $orderItem = new OrderItem($product);
        $order->addItem($orderItem);
        // test shipping fee
        $this->assertEquals(27.5, $orderItem->getShippingFee());
        // test item price
        $this->assertEquals(47.5, $orderItem->getItemPrice());
        // test gross price
        $this->assertEquals(90.5, $order->getGrossPrice());
    }

    public function testOrderHasTwoItemsAndGrossPriceCalculateShippingFeeByDimension()
    {
        $order = new Order();

        $product = new Product(10, 1, 1, 2, 1, '');
        $orderItem = new OrderItem($product);
        $order->addItem($orderItem);
        // test shipping fee
        $this->assertEquals(22, $orderItem->getShippingFee());
        // test item price
        $this->assertEquals(32, $orderItem->getItemPrice());
        // test gross price
        $this->assertEquals(32, $order->getGrossPrice());

        $product = new Product(20, 2, 1, 3.5, 1, '');
        $orderItem = new OrderItem($product);
        $order->addItem($orderItem);
        // test shipping fee
        $this->assertEquals(38.5, $orderItem->getShippingFee());
        // test item price
        $this->assertEquals(58.5, $orderItem->getItemPrice());
        // test gross price
        $this->assertEquals(90.5, $order->getGrossPrice());
    }

    public function testOrderHasTwoItemsAndGrossPriceCalculateShippingFeeByProductType()
    {
        $order = new Order();

        $product = new Product(100, 1, 1, 1, 1, 'smart_phone');
        $orderItem = new OrderItem($product);
        $order->addItem($orderItem);
        // test shipping fee
        $this->assertEquals(15, $orderItem->getShippingFee());
        // test item price
        $this->assertEquals(115, $orderItem->getItemPrice());
        // test gross price
        $this->assertEquals(115, $order->getGrossPrice());

        $product = new Product(520, 1, 1, 1, 1, 'diamond');
        $orderItem = new OrderItem($product);
        $order->addItem($orderItem);
        // test shipping fee
        $this->assertEquals(25, $orderItem->getShippingFee());
        // test item price
        $this->assertEquals(545, $orderItem->getItemPrice());
        // test gross price
        $this->assertEquals(660, $order->getGrossPrice());
    }

    public function testOrderHasThreeItemsAndGrossPriceCalculateShippingFeeByAllType()
    {
        $order = new Order();

        // item calculate shipping fee by weight
        $product = new Product(10, 3, 1, 2, 1, '');
        $orderItem = new OrderItem($product);
        $order->addItem($orderItem);
        // test shipping fee
        $this->assertEquals(33, $orderItem->getShippingFee());
        // test item price
        $this->assertEquals(43, $orderItem->getItemPrice());
        // test gross price
        $this->assertEquals(43, $order->getGrossPrice());

        // item calculate shipping fee by dimension
        $product = new Product(10, 1, 1, 2, 1, '');
        $orderItem = new OrderItem($product);
        $order->addItem($orderItem);
        // test shipping fee
        $this->assertEquals(22, $orderItem->getShippingFee());
        // test item price
        $this->assertEquals(32, $orderItem->getItemPrice());
        // test gross price
        $this->assertEquals(75, $order->getGrossPrice());

        // item calculate shipping fee by product type
        $product = new Product(100, 1, 1, 1, 1, 'smart_phone');
        $orderItem = new OrderItem($product);
        $order->addItem($orderItem);
        // test shipping fee
        $this->assertEquals(15, $orderItem->getShippingFee());
        // test item price
        $this->assertEquals(115, $orderItem->getItemPrice());
        // test gross price
        $this->assertEquals(190, $order->getGrossPrice());
    }

}
