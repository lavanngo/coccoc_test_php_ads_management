<?php
require __DIR__ . '/vendor/autoload.php';
global $config;
use App\Application\Order;
use App\Models\Product\Product;

$order = new Order();

$product = new Product(10, 3, 1, 2, 1, '');
$grossPrice1 = $order->buyProductOnAmazon($product);
var_dump($grossPrice1);

// fee by weight = product weight x weight coefficient
// fee by dimension = width x height x depth x dimension
// $rs = $order->buyProductOnAmazon($product);

// $order->addProduct($product);
// $gp = $order->getGrossPrice();

// var_dump($gp);
