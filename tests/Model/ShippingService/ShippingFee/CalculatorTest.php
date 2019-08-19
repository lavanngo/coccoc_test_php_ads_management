<?php
namespace Tests\Model\ShippingService\ShippingFee;

use App\Model\Product\Product;
use App\Model\ShippingService\ShippingFee\Calculator;
use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorByDimension;
use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorByProductType;
use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorByWeight;
use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorTypeFactory;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{

    protected $shippingCalculatorsConfig;
    protected $shippingCalculator;
    protected $product;
    protected function setUp(): void
    {
        global $config;
        $this->shippingCalculatorsConfig = $config['Shipping']['ShippingFeeCalculators'];
        $this->shippingCalculator = new Calculator();
        $this->product = new Product(10, 1.5, 2.5, 2, 1, '');
    }

    public function testCreateCalculatorByWeight()
    {
        $calculatorByWeight = CalculatorTypeFactory::createCalculatorType($this->shippingCalculatorsConfig['CalculatorByWeight']);
        $this->assertInstanceOf(CalculatorByWeight::class, $calculatorByWeight);
        $this->shippingCalculator->setProduct($this->product);
        $this->shippingCalculator->addCalculatorType($calculatorByWeight);
        $this->assertCount(1, $this->shippingCalculator->getCalculatorTypes());
        return $this->shippingCalculator;
    }

    /**
     * @depends testCreateCalculatorByWeight
     * @group specification
     */
    public function testCalculateByWeightOnly(Calculator $shippingCalculator)
    {
        $shippingFee = $shippingCalculator->calculate();
        $this->assertEquals(16.5, $shippingFee);
        return $shippingCalculator;
    }

    /**
     * @depends testCalculateByWeightOnly
     */
    public function testAddCalculatorByDimensionToCalculator(Calculator $shippingCalculator)
    {
        $calculatorByDimension = CalculatorTypeFactory::createCalculatorType($this->shippingCalculatorsConfig['CalculatorByDimension']);
        $this->assertInstanceOf(CalculatorByDimension::class, $calculatorByDimension);
        $shippingCalculator->addCalculatorType($calculatorByDimension);
        $this->assertCount(2, $shippingCalculator->getCalculatorTypes());
        return $shippingCalculator;
    }

    /**
     * @depends testAddCalculatorByDimensionToCalculator
     */
    public function testCalculateByDimensionMoreThanByWeight(Calculator $shippingCalculator)
    {
        $shippingFee = $shippingCalculator->calculate();
        $this->assertEquals(55, $shippingFee);
        return $shippingCalculator;
    }

    /**
     * @depends testCalculateByDimensionMoreThanByWeight
     */
    public function testCreateCalculatorByProductType(Calculator $shippingCalculator)
    {
        $calculatorByProductType = CalculatorTypeFactory::createCalculatorType($this->shippingCalculatorsConfig['CalculatorByProductType']);
        $this->assertInstanceOf(CalculatorByProductType::class, $calculatorByProductType);
        $shippingCalculator->addCalculatorType($calculatorByProductType);
        $this->assertCount(3, $shippingCalculator->getCalculatorTypes());
        return $shippingCalculator;
    }

    /**
     * @depends testCreateCalculatorByProductType
     */
    public function testCalculatorByProductTypeIsMax(Calculator $shippingCalculator)
    {
        $product = new Product(10, 1, 1, 2, 1, 'diamond');
        $shippingCalculator->setProduct($product);
        $shippingFee = $shippingCalculator->calculate();
        $this->assertCount(3, $shippingCalculator->getCalculatorTypes());
        $this->assertEquals(25, $shippingFee);
        return $shippingCalculator;
    }

    /**
     * @depends testCreateCalculatorByProductType
     */
    public function testCalculatorByWeightIsMax(Calculator $shippingCalculator)
    {
        $product = new Product(10, 6, 2.5, 2, 1, '');
        $shippingCalculator->setProduct($product);
        $shippingFee = $shippingCalculator->calculate();
        $this->assertCount(3, $shippingCalculator->getCalculatorTypes());
        $this->assertEquals(66, $shippingFee);
        return $shippingCalculator;
    }

    /**
     * @depends testCreateCalculatorByProductType
     */
    public function testCalculatorByDimensionIsMax(Calculator $shippingCalculator)
    {
        $product = new Product(10, 1, 4, 2, 1, '');
        $shippingCalculator->setProduct($product);
        $shippingFee = $shippingCalculator->calculate();
        $this->assertCount(3, $shippingCalculator->getCalculatorTypes());
        $this->assertEquals(88, $shippingFee);
        return $shippingCalculator;
    }
}
