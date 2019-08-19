<?php
namespace Tests\ShippingService;

use App\Model\Product\Product;
use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorByWeight;
use PHPUnit\Framework\TestCase;

class CalculatorByWeightTest extends TestCase
{

    protected $calculatorType;

    protected function setUp(): void
    {

    }

    private function initObject()
    {
        global $config;
        $calculatorTypeConfig = $config['Shipping']['ShippingFeeCalculators']['CalculatorByWeight'];
        $this->calculatorType = new CalculatorByWeight();
        $this->calculatorType->setCoefficients($calculatorTypeConfig['Coefficients']);
    }

    public function testShippingFeeIsZero()
    {
        $this->initObject();
        $product = new Product(10, 0, 1, 2, 1, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertEquals(0, $shippingFee);

        $this->initObject();
        $product = new Product(10, '', 1, 0, 1, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertEquals(0, $shippingFee);
    }

    public function testProductFieldsAreEmpty()
    {
        $this->initObject();
        $product = new Product('', '', '', '', '', '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertEquals(0, $shippingFee);

        $this->initObject();
        $product = new Product('', 5, 1, 1, 1, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertEquals(55, $shippingFee);

        $this->initObject();
        $product = new Product('', '', 2, 1, 1, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertEquals(0, $shippingFee);

        $this->initObject();
        $product = new Product('', '', '', 1, 1, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertEquals(0, $shippingFee);

        $this->initObject();
        $product = new Product('', '', '', '', 1, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertEquals(0, $shippingFee);

        $this->initObject();
        $product = new Product('', '', '', '', '', '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertEquals(0, $shippingFee);
    }

    public function testShippingFeesAreCorrect()
    {

        $this->initObject();
        $product = new Product(10, 2, 1, 2, 1, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertIsFloat($shippingFee);
        $this->assertEquals(22, $shippingFee);

        $this->initObject();
        $product = new Product(10, 1, 2, 2, 1, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertIsFloat($shippingFee);
        $this->assertEquals(11, $shippingFee);

        $this->initObject();
        $product = new Product(10, 1.5, 2, 2, 1.5, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertIsFloat($shippingFee);
        $this->assertEquals(16.5, $shippingFee);
    }
}
