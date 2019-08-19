<?php
namespace App\Model\ShippingService\ShippingFee\CalculatorType;

use App\Model\Product\Product;

abstract class CalculatorTypeAbstract
{
    protected $product;
    protected $coefficients;
    protected $shippingFee = 0;

    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getcoefficients()
    {
        return $this->coefficients;
    }

    public function setcoefficients($coefficients)
    {
        $this->coefficients = $coefficients;
    }

    public function getcoefficient()
    {
        return $this->coefficients;
    }

    public function getShippingFee(): float
    {
        return $this->shippingFee;
    }

    public function setShippingFee($shippingFee)
    {
        $this->shippingFee = $shippingFee;
    }
}
