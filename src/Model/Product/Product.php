<?php
namespace App\Model\Product;

/**
 * @package    App\Model\Product
 * @author     NgoLV <lavanngo@gmail.com>
 * @version    2019-08-19
 */
class Product
{
    private $amazonPrice;
    private $weight;
    private $width;
    private $height;
    private $depth;
    private $productType;

    public function __construct($amazonPrice, $weight, $width, $height, $depth, $productType)
    {
        $this->amazonPrice = $amazonPrice;
        $this->weight = $weight;
        $this->width = $width;
        $this->height = $height;
        $this->depth = $depth;
        $this->productType = $productType;
    }

    public function getAmazonPrice(): float
    {
        return (float) $this->amazonPrice;
    }

    public function setAmazonPrice($amazonPrice)
    {
        $this->amazonPrice = $amazonPrice;
    }

    public function getWeight(): float
    {
        return (float) $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getWidth(): float
    {
        return (float) $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getHeight(): float
    {
        return (float) $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }
    public function getDepth(): float
    {
        return (float) $this->depth;
    }

    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    public function getProductType()
    {
        return $this->productType;
    }

    public function setProductType($productType)
    {
        $this->productType = $productType;
    }

}
