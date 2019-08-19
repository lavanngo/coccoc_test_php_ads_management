<?php
namespace App\Application;

use App\Model\Order\Order as OrderModel;
use App\Model\Order\OrderItem;
use App\Model\Product\Product;

/**
 * @package    App\Application
 * @author     NgoLV <lavanngo@gmail.com>
 * @version    2019-08-19
 */
class Order
{
    /**
     * @param array $products list product to buy
     * @return float gross price
     */
    public function buyProductsOnAmazon(array $products)
    {
        $order = new OrderModel();
        foreach ($products as $product) {
            if ($product instanceof Product) {
                $orderItem = new OrderItem($product);
                $order->addItem($orderItem);
            }
        }
        return $order->getGrossPrice();
    }

    /**
     * @param Product $product product to buy
     * @return float gross price
     */
    public function buyProductOnAmazon(Product $product)
    {
        $order = new OrderModel();
        $orderItem = new OrderItem($product);
        $order->addItem($orderItem);
        return $order->getGrossPrice();
    }
}
