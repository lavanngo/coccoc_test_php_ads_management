<?php
namespace App\Model\Order;

use App\Model\Product\Product;
use App\Model\ShippingService\ShippingFee\Calculator;
use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorTypeFactory;

/**
 * @package    App\Model\Order
 * @author     NgoLV <lavanngo@gmail.com>
 * @version    2019-08-19
 */
class OrderItem
{
    /**
     * Product to buy.
     * @var Product $product
     */
    private $product;
    private $shippingFee = 0;
    private $itemPrice = 0;
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->initPriceAndFee();
    }

    private function initPriceAndFee()
    {
        $this->shippingFee = $this->calculateShippingFee();
        $this->itemPrice = $this->product->getAmazonPrice() + $this->shippingFee;
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;
        $this->initPriceAndFee();
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getShippingFee(): float
    {
        return (float) $this->shippingFee;
    }

    public function setShippingFee($shippingFee)
    {
        $this->shippingFee = $shippingFee;
    }

    public function getItemPrice(): float
    {
        return (float) $this->itemPrice;
    }

    public function setItemPrice($itemPrice)
    {
        $this->itemPrice = $itemPrice;
    }

    private function calculateShippingFee(): float
    {
        global $config;
        $shippingFeeCalculators = $config['Shipping']['ShippingFeeCalculators'];
        $calculator = new Calculator();
        foreach ($shippingFeeCalculators as $calculatorTypeConfig) {
            $calculatorType = CalculatorTypeFactory::createCalculatorType($calculatorTypeConfig);
            if ($calculatorType) {
                $calculator->addCalculatorType($calculatorType);
            }
        }
        $calculator->setProduct($this->product);
        $this->shippingFee = $calculator->calculate();
        return $this->shippingFee;
    }

}
