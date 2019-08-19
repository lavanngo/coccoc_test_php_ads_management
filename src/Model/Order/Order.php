<?php
namespace App\Model\Order;

use App\Model\Order\OrderItem;
use App\Model\Product\Product;

/**
 * @package    App\Model\Order
 * @author     NgoLV <lavanngo@gmail.com>
 * @version    2019-08-19
 */
class Order
{
    /**
     * Product to calculate shipping fee.
     * @var array items to buy
     */
    private $items = [];

    public function addProduct(Product $product)
    {
        $item = new OrderItem($product);
        $this->items[] = $item;
    }

    public function addItem(OrderItem $item)
    {
        $this->items[] = $item;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }

    public function getGrossPrice(): float
    {
        $result = 0;
        foreach ($this->items as $item) {
            $result += $item->getItemPrice();
        }
        return $result;
    }

}
