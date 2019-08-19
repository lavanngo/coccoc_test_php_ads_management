<?php
namespace App\Model\ShippingService\ShippingFee\CalculatorType;

use App\Model\Product\Product;

class CalculatorByDimension extends CalculatorType
{

    public function calculate(): float
    {

        if ($this->isValid()) {
            $this->shippingFee = $this->product->getWidth() * $this->product->getHeight() * $this->product->getDepth() * $this->getcoefficient();

        };

        return $this->shippingFee;
    }

    public function isValid(): bool
    {
        $result = true;
        if (!($this->product instanceof Product)) {
            $result = false;
        }
        if (empty($this->product->getWidth()) || empty($this->product->getHeight()) || empty($this->product->getDepth())) {
            $result = false;

        }
        return $result;
    }
}
