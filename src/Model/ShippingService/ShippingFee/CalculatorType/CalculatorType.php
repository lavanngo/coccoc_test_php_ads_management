<?php
namespace App\Model\ShippingService\ShippingFee\CalculatorType;

use App\Model\Product\Product;
use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorTypeAbstract;

/**
 * @package    App\Model\ShippingService\ShippingFee
 * @author     NgoLV <lavanngo@gmail.com>
 * @version    2019-08-19
 */
class CalculatorType extends CalculatorTypeAbstract
{
    public function calculate(): float
    {
        return 0;
    }

    public function getcoefficient(): float
    {
        return $this->getcoefficients();
    }

    public function isValid(): bool
    {
        $result = true;
        if (!($this->product instanceof Product)) {
            $result = false;
        }
        return $result;
    }

}
