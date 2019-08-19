<?php
require __DIR__ . '/vendor/autoload.php';
global $config;
use App\Application\Order;
use App\Model\Product\Product;

$order = new Order();

$product = new Product(10, 3, 1, 2, 1, '');
$grossPrice = $order->buyProductOnAmazon($product);
echo "<pre>";
echo "calculate gross fee with product, expacted gross price is 43:";
var_dump($product);
echo "</pre> gross Price = {$grossPrice}";

echo "<br/>=======================<br/><br/><br/>";
$products = [];
$product = new Product(10, 3, 1, 2, 1, '');
$products[] = $product;
$product = new Product(15, 1, 1, 2, 1, '');
$products[] = $product;

$grossPrice = $order->buyProductsOnAmazon($products);
echo "<pre>";
echo "calculate gross fee with 2 products, expacted gross price is 80 :";
var_dump($products);
echo "</pre> gross Price = {$grossPrice}";

echo "<br/>=======================<br/><br/><br/>";
$products = [];
$product = new Product(10, 3, 1, 2, 1, '');
$products[] = $product;
$product = new Product(15, 1, 1, 2, 1, '');
$products[] = $product;
$product = new Product(33, 1, 1, 1, 1, 'diamond');
$products[] = $product;

$grossPrice = $order->buyProductsOnAmazon($products);
echo "<pre>";
echo "calculate gross fee with 3 products, expacted gross price is 138 :";
var_dump($products);
echo "</pre> gross Price = {$grossPrice}";
