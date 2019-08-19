<?php
namespace App\Model\ShippingService\ShippingFee\CalculatorType;

use App\Model\Product\Product;

/**
 * @package    App\Model\ShippingService\ShippingFee
 * @author     NgoLV <lavanngo@gmail.com>
 * @version    2019-08-19
 */
abstract class CalculatorTypeAbstract
{
    /**
     * Product to calculate shipping fee.
     * @var Product $product
     */
    protected $product;

    /**
     * coefficients to calculate shipping fee,default loading from config.
     * @var $coefficients
     */
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
