<?php
namespace App\Model\ShippingService\ShippingFee;

use App\Model\Product\Product;
use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorType;

class Calculator
{

    private $calculatorTypes = [];
    private $product;

    public function addCalculatorType(CalculatorType $objCalculator)
    {

        $this->calculatorTypes[] = $objCalculator;
    }

    public function getCalculatorTypes()
    {
        return $this->calculatorTypes;
    }

    public function setCalculatorTypes($calculatorTypes)
    {
        $this->calculatorTypes = $calculatorTypes;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function calculate(): Float
    {
        $shippingFees = [0];
        if ($this->product instanceof Product) {
            foreach ($this->calculatorTypes as $calculator) {
                $calculator->setProduct($this->product);
                $shippingFees[] = $calculator->calculate();
            }
        }
        // var_dump($shippingFees);
        return max($shippingFees);
    }

}
