<?php
namespace Tests\Application;

use App\Application\Order;
use App\Model\Product\Product;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testbuyOneProductOnAmazonExpectedGrossPriceIs43()
    {
        $order = new Order();
        $product = new Product(10, 3, 1, 2, 1, '');
        $grossPrice = $order->buyProductOnAmazon($product);
        $this->assertEquals(43, $grossPrice);
    }

    public function testbuyTwoProductOnAmazonExpectedGrossPriceIs80()
    {
        $products = [];
        $product = new Product(10, 3, 1, 2, 1, '');
        $products[] = $product;
        $product = new Product(15, 1, 1, 2, 1, '');
        $products[] = $product;

        $order = new Order();
        $grossPrice = $order->buyProductsOnAmazon($products);
        $this->assertEquals(80, $grossPrice);
    }

    public function testbuyThreeProductOnAmazonExpectedGrossPriceIs138()
    {
        $products = [];
        $product = new Product(10, 3, 1, 2, 1, '');
        $products[] = $product;
        $product = new Product(15, 1, 1, 2, 1, '');
        $products[] = $product;
        $product = new Product(33, 1, 1, 1, 1, 'diamond');
        $products[] = $product;

        $order = new Order();
        $grossPrice = $order->buyProductsOnAmazon($products);
        $this->assertEquals(138, $grossPrice);
    }

}
