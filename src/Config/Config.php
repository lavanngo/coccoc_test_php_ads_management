<?php
global $config;
$config = [];
$config['version'] = "1.0";
$config['Shipping'] = [
    'ShippingFeeCalculators' => [
        'CalculatorByWeight' => [
            'Class' => 'App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorByWeight',
            'Coefficients' => 11,
        ],
        'CalculatorByDimension' => [
            'Class' => 'App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorByDimension',
            'Coefficients' => 11,
        ],
        'CalculatorByProductType' => [
            'Class' => 'App\Model\ShippingService\ShippingFee\CalculatorType\CalculatorByProductType',
            'Coefficients' => [
                'ProductTypes' => [
                    'smart_phone' => 15,
                    'diamond' => 25,
                    'zero' => 0,
                ],
            ],
        ],

    ],
];
