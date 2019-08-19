<?php
namespace App\Model\ShippingService\ShippingFee\CalculatorType;

interface CalculatorTypeInterface
{
    public function calculate(): float;
    public function getcoefficient(): float;
    public function isValid(): bool;
}
