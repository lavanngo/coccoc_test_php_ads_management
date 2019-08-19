<?php
namespace App\Model\ShippingService\ShippingFee\CalculatorType;

use App\Model\Product\Product;

/**
 * @package    App\Model\ShippingService\ShippingFee
 * @author     NgoLV <lavanngo@gmail.com>
 * @version    2019-08-19
 */
class CalculatorByProductType extends CalculatorType
{
    public function calculate(): Float
    {
        if ($this->isValid()) {
            $this->shippingFee = $this->getCoefficient();
        }
        return $this->shippingFee;
    }

    public function getCoefficient(): Float
    {
        $coefficient = 0;
        if (!empty($this->coefficients['ProductTypes']) && isset($this->coefficients['ProductTypes'][$this->product->getProductType()])) {
            $coefficient = $this->coefficients['ProductTypes'][$this->product->getProductType()];
        }
        return $coefficient;
    }

    public function isValid(): bool
    {
        $result = true;
        if (!($this->product instanceof Product)) {
            $result = false;
        }
        if (empty($this->product->getProductType())) {
            $result = false;

        }
        return $result;
    }
}
