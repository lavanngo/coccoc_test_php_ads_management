<?php
namespace Tests\Order;

use App\Model\Order\OrderItem;
use App\Model\Product\Product;
use PHPUnit\Framework\TestCase;

class OrderItemTest extends TestCase
{

    protected $orderItem;

    public function testShippingFeeByWeightIsMax()
    {
        $product = new Product(10, 6, 1, 2, 1, '');
        $this->orderItem = new OrderItem($product);
        // test shipping fee
        $this->assertEquals(66, $this->orderItem->getShippingFee());
        // test item price
        $this->assertEquals(76, $this->orderItem->getItemPrice());
    }

    public function testShippingFeeByDimensionIsMax()
    {
        $product = new Product(25, 1, 1, 2, 1, '');
        $this->orderItem = new OrderItem($product);
        // test shipping fee
        $this->assertEquals(22, $this->orderItem->getShippingFee());
        // test item price
        $this->assertEquals(47, $this->orderItem->getItemPrice());
    }

    public function testShippingFeeByProductTypeIsMax()
    {
        $product = new Product(25, 1, 1, 2, 1, 'diamond');
        $this->orderItem = new OrderItem($product);
        // test shipping fee
        $this->assertEquals(25, $this->orderItem->getShippingFee());
        // test item price
        $this->assertEquals(50, $this->orderItem->getItemPrice());
    }

}
