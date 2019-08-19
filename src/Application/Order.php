<?php
namespace App\Application;

use App\Model\Product\Product;

class Order
{
    /*
     *
     */
    public function buyProductsOnAmazon(array $products)
    {
        $order = new App\Model\Order\Order();
        foreach ($products as $product) {
            if (!($product instanceof Product)) {
                $orderItem = new OrderItem($product);
                $order->addItem($orderItem);
            }
        }
        return $order->getGrossPrice();
    }

    public function buyProductOnAmazon(Product $product)
    {
        $order = new App\Model\Order\Order();
        $orderItem = new OrderItem($product);
        $order->addItem($orderItem);
        return $order->getGrossPrice();
    }
}
