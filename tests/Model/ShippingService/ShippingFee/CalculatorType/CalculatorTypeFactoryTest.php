<?php
namespace Tests\Model\ShippingService\ShippingFee\CalculatorType;

use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorByDimension;
use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorByProductType;
use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorByWeight;
use App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorTypeFactory;
use App\Model\ShippingService\ShippingFee\Exception\InvalidArgumentShippingFeeConfigException;
use PHPUnit\Framework\TestCase;

class CalculatorTypeFactoryTest extends TestCase
{

    protected $shippingCalculatorsConfig;

    protected function setUp(): void
    {
        global $config;
        $this->shippingCalculatorsConfig = $config['Shipping']['ShippingFeeCalculators'];
    }

    public function testCannotCreateShippingFeeObjectWithArgumentIsEmpty()
    {
        $this->expectException(InvalidArgumentShippingFeeConfigException::class);
        $shippingFeeObject = CalculatorTypeFactory::createCalculatorType([]);
    }

    public function testCannotCreateShippingFeeObjectWithClassNotFound()
    {
        $this->expectException(InvalidArgumentShippingFeeConfigException::class);
        $shippingFeeConfig = [
            'Class' => 'App\Model\ShippingService\ClassNotFound',
            'Coefficients' => 1,
        ];
        $shippingFeeObject = CalculatorTypeFactory::createCalculatorType($shippingFeeConfig);
    }

    public function testCreateShippingFeeByDimension()
    {
        $calculatorByDimension = CalculatorTypeFactory::createCalculatorType($this->shippingCalculatorsConfig['CalculatorByDimension']);
        $this->assertInstanceOf(CalculatorByDimension::class, $calculatorByDimension);
    }

    public function testCreateShippingFeeByWeight()
    {
        $calculatorByWeight = CalculatorTypeFactory::createCalculatorType($this->shippingCalculatorsConfig['CalculatorByWeight']);
        $this->assertInstanceOf(CalculatorByWeight::class, $calculatorByWeight);
    }

    public function testCreateShippingFeeByProductType()
    {
        $calculatorByProductType = CalculatorTypeFactory::createCalculatorType($this->shippingCalculatorsConfig['CalculatorByProductType']);
        $this->assertInstanceOf(CalculatorByProductType::class, $calculatorByProductType);
    }
}
