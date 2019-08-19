<?php
namespace Tests\Model\ShippingService\ShippingFee\CalculatorType;

use App\Model\Product\Product;
use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorByProductType;
use PHPUnit\Framework\TestCase;

class CalculatorByProductTypeTest extends TestCase
{

    protected $calculatorType;

    protected function setUp(): void
    {

    }

    private function initObject()
    {
        global $config;
        $calculatorTypeConfig = $config['Shipping']['ShippingFeeCalculators']['CalculatorByProductType'];
        $this->calculatorType = new CalculatorByProductType();
        $this->calculatorType->setCoefficients($calculatorTypeConfig['Coefficients']);
    }

    public function testShippingFeeIsZero()
    {
        $this->initObject();
        $product = new Product(10, 0, 1, 2, 1, 'zero');
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
        $this->assertEquals(0, $shippingFee);

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
        $product = new Product(10, 1, 1, 2, 1, 'smart_phone');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertIsFloat($shippingFee);
        $this->assertEquals(15, $shippingFee);

        $this->initObject();
        $product = new Product(10, 1, 2, 2, 1, 'diamond');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertIsFloat($shippingFee);
        $this->assertEquals(25, $shippingFee);
    }
}
