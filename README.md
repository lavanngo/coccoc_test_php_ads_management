# Cốc Cốc Test PHP Ads Management

There is a shipping service. It helps Vietnamese buy products on Amazon website. We need to calculate a gross price for an order (contains many items).

<p align="center">
 <a href="https://packagist.org/packages/phpunit/phpunit" rel="nofollow"><img src="https://camo.githubusercontent.com/9b3807037c636145c1db553fb23335eea8561acd/68747470733a2f2f696d672e736869656c64732e696f2f7061636b61676973742f762f706870756e69742f706870756e69742e7376673f7374796c653d666c61742d737175617265" alt="Latest Stable Version" data-canonical-src="https://img.shields.io/packagist/v/phpunit/phpunit.svg?style=flat-square" style="max-width:100%;"></a>
<a href="https://php.net/" rel="nofollow"><img src="https://camo.githubusercontent.com/c34ea040b7fc6a695365456cedaca2ce45d0e084/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f7068702d253345253344253230372e322d3838393242462e7376673f7374796c653d666c61742d737175617265" alt="Minimum PHP Version" data-canonical-src="https://img.shields.io/badge/php-%3E%3D%207.2-8892BF.svg?style=flat-square" style="max-width:100%;"></a>
</p>

## Installation
<p>You need using <a href="https://getcomposer.org/" rel="nofollow">Composer</a> to install. Download and install Composer by following the official instructions.</p>
<p>Open PowerShell Windows your project's directory and run below bellow command:</p>
<pre><code>composer install</code></pre>

## Usage
<p>Add an order item to an order. </p>
<pre><code>
$order = new App\Model\Order\Order();
$product = new Product(10, 3, 1, 2, 1, '');
$orderItem = new OrderItem($product);
$order->addItem($orderItem);

$shippingFee = $orderItem->getShippingFee();
$grossPrice = order->getGrossPrice();

</code></pre>

## Testing
<p>Open PowerShell Windows your project's directory and run below bellow command:</p>
<pre><code> .\vendor\bin\phpunit .\tests\</code></pre>
