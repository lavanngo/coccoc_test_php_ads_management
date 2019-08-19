<?php
namespace App\Model\ShippingService\ShippingFee\CalculatorType;

use App\Model\Product\Product;

/**
 * @package    App\Model\ShippingService\ShippingFee
 * @author     NgoLV <lavanngo@gmail.com>
 * @version    2019-08-19
 */
class CalculatorByWeight extends CalculatorType
{
    public function calculate(): Float
    {
        if ($this->isValid()) {
            $this->shippingFee = $this->product->getWeight() * $this->getcoefficient();
        }
        return $this->shippingFee;
    }

    public function isValid(): bool
    {
        $result = true;
        if (!($this->product instanceof Product)) {
            $result = false;
        }
        if (empty($this->product->getWeight())) {
            $result = false;
        }
        return $result;
    }

}
