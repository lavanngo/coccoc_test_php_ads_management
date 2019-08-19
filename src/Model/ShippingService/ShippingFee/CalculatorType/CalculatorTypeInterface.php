<?php
namespace App\Model\ShippingService\ShippingFee\CalculatorType;

/**
 * @package    App\Model\ShippingService\ShippingFee
 * @author     NgoLV <lavanngo@gmail.com>
 * @version    2019-08-19
 */
interface CalculatorTypeInterface
{
    public function calculate(): float;
    public function getcoefficient(): float;
    public function isValid(): bool;
}
