<?php
namespace Tests\ShippingService;

use App\Model\Product\Product;
use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorByDimension;
use PHPUnit\Framework\TestCase;

class CalculatorByDimensionTest extends TestCase
{

    protected $calculatorType;
    protected function setUp(): void
    {

    }

    private function initObject()
    {
        global $config;
        $calculatorTypeConfig = $config['Shipping']['ShippingFeeCalculators']['CalculatorByDimension'];
        $this->calculatorType = new CalculatorByDimension();
        $this->calculatorType->setCoefficients($calculatorTypeConfig['Coefficients']);
    }

    public function testShippingFeeIsZero()
    {
        $this->initObject();
        $product = new Product(10, 5, 0, 2, 1, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertEquals(0, $shippingFee);

        $this->initObject();
        $product = new Product(10, 5, 1, 0, 1, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertEquals(0, $shippingFee);

        $this->initObject();
        $product = new Product(10, 5, 1, 2, 0, '');
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
        $this->assertEquals(11, $shippingFee);

        $this->initObject();
        $product = new Product('', '', 2, 1, 1, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertEquals(22, $shippingFee);

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
        $product = new Product(10, 5, 1, 2, 1, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertIsFloat($shippingFee);
        $this->assertEquals(22, $shippingFee);

        $this->initObject();
        $product = new Product(10, 5, 2, 2, 1, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertIsFloat($shippingFee);
        $this->assertEquals(44, $shippingFee);

        $this->initObject();
        $product = new Product(10, 5, 2, 2, 1.5, '');
        $this->calculatorType->setProduct($product);
        $shippingFee = $this->calculatorType->calculate();
        $this->assertIsFloat($shippingFee);
        $this->assertEquals(66, $shippingFee);
    }

    // public function testShippingFeeByWeightAmazonPriceIsZero()
    // {
    //     $order = new Order();
    //     $product = new Product(0, 5, 1, 2, 1, '');
    //     $order->addProduct($product);
    //     $grossPrice = $order->getGrossPrice();

    //     $this->assertIsFloat($grossPrice);
    //     $this->assertEquals(55, $grossPrice);
    // }

    // public function testShippingFeeByWeight1()
    // {
    //     $order = new Order();
    //     $product = new Product(20, 5, 1, 2, 1, '');
    //     $order->addProduct($product);
    //     $grossPrice = $order->getGrossPrice();

    //     $this->assertIsFloat($grossPrice);
    //     $this->assertEquals(75, $grossPrice);
    // }

    // public function testShippingFeeByWeight2()
    // {
    //     $order = new Order();
    //     $product = new Product(20, 5.5, 1, 2, 1, '');
    //     $order->addProduct($product);
    //     $grossPrice = $order->getGrossPrice();

    //     $this->assertIsFloat($grossPrice);
    //     $this->assertEquals(80.5, $grossPrice);
    // }
}
