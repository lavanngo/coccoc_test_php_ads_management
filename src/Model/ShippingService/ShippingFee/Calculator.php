<?php
namespace App\Model\ShippingService\ShippingFee;

use App\Model\Product\Product;
use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorType;

/**
 * @package    App\Model\ShippingService\ShippingFee
 * @author     NgoLV <lavanngo@gmail.com>
 * @version    2019-08-19
 */
class Calculator
{

    /**
     * List calculator Types.
     * @var array $calculatorTypes
     */
    private $calculatorTypes = [];

    /**
     * Product to calculate shipping fee.
     * @var Product $product
     */
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
        return max($shippingFees);
    }

}
