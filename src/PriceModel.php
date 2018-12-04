<?php
/**
 * Created by PhpStorm.
 * User: walter
 * Date: 04/12/2018
 * Time: 13:59
 */

namespace Exchange;

use Exchange\requestHandler;
use Exchange\ConfigGetter;

class PriceModel
{
    protected $buyPriceAvr;

    protected $buyQuantity;

    protected $sellPriceAvr;

    protected $sellQuantity;

    protected $overalAverage;

    protected $overalQuantity;

    protected $ts;

    protected $overallPrice;

    protected $buyingPrice;

    protected $sellingPrice;

    /**
     * @return mixed
     */
    public function getOverallPrice()
    {
        return $this->overallPrice;
    }

    /**
     * @param mixed $overallPrice
     */
    public function setOverallPrice($overallPrice)
    {
        $this->overallPrice = $overallPrice;
    }

    /**
     * @return mixed
     */
    public function getBuyingPrice()
    {
        return $this->buyingPrice;
    }

    /**
     * @param mixed $buyingPrice
     */
    public function setBuyingPrice($buyingPrice)
    {
        $this->buyingPrice = $buyingPrice;
    }

    /**
     * @return mixed
     */
    public function getSellingPrice()
    {
        return $this->sellingPrice;
    }

    /**
     * @param mixed $sellingPrice
     */
    public function setSellingPrice($sellingPrice)
    {
        $this->sellingPrice = $sellingPrice;
    }



    /**
     * @return mixed
     */
    public function getTs()
    {
        return $this->ts;
    }

    /**
     * @param mixed $ts
     */
    public function setTs($ts)
    {
        $this->ts = $ts;
    }



    /**
     * @return mixed
     */
    public function getBuyPriceAvr()
    {
        return $this->buyPriceAvr;
    }

    /**
     * @param mixed $buyPriceAvr
     */
    public function setBuyPriceAvr($buyPriceAvr)
    {
        $this->buyPriceAvr = $buyPriceAvr;
    }

    /**
     * @return mixed
     */
    public function getBuyQuantity()
    {
        return $this->buyQuantity;
    }

    /**
     * @param mixed $buyQuantity
     */
    public function setBuyQuantity($buyQuantity)
    {
        $this->buyQuantity = $buyQuantity;
    }

    /**
     * @return mixed
     */
    public function getSellPriceAvr()
    {
        return $this->sellPriceAvr;
    }

    /**
     * @param mixed $sellPriceAvr
     */
    public function setSellPriceAvr($sellPriceAvr)
    {
        $this->sellPriceAvr = $sellPriceAvr;
    }

    /**
     * @return mixed
     */
    public function getSellQuantity()
    {
        return $this->sellQuantity;
    }

    /**
     * @param mixed $sellQuantity
     */
    public function setSellQuantity($sellQuantity)
    {
        $this->sellQuantity = $sellQuantity;
    }

    /**
     * @return mixed
     */
    public function getOveralAverage()
    {
        return $this->overalAverage;
    }

    /**
     * @param mixed $overalAverage
     */
    public function setOveralAverage($overalAverage)
    {
        $this->overalAverage = $overalAverage;
    }

    /**
     * @return mixed
     */
    public function getOveralQuantity()
    {
        return $this->overalQuantity;
    }

    /**
     * @param mixed $overalQuantity
     */
    public function setOveralQuantity($overalQuantity)
    {
        $this->overalQuantity = $overalQuantity;
    }


    public static function getPriceRange(int $itemId,bool $asArray = false){
        $config = ConfigGetter::getConfig();

        $response = requestHandler::request($config['item_price'].$itemId.'.json');

        $items = json_decode($response,true);

        if ($asArray){
            return $items;
        }else{
            $prices = [];
            foreach ($items as $item){
                $priceObject = new PriceModel();

                $priceObject->setTs($item['ts']);
                $priceObject->setOverallPrice($item['overallPrice']);
                $priceObject->setOveralQuantity($item['overallQuantity']);
                $priceObject->setBuyingPrice($item['buyingPrice']);
                $priceObject->setBuyQuantity($item['buyingQuantity']);
                $priceObject->setSellingPrice($item['sellingPrice']);
                $priceObject->setSellQuantity($item['sellingQuantity']);

                $prices[] = $priceObject;
            }
            return $prices;
        }
    }
    public static function getSpecificPrice(int $itemId,bool $asArray = false){
        $config = ConfigGetter::getConfig();

        $response = requestHandler::request($config['item_price'].$itemId.'.json');

        $items = json_decode($response,true);

        $item = end($items);

        if ($asArray){
            return $items;
        }else{

            $priceObject = new PriceModel();

            $priceObject->setTs($item['ts']);
            $priceObject->setOverallPrice($item['overallPrice']);
            $priceObject->setOveralQuantity($item['overallQuantity']);
            $priceObject->setBuyingPrice($item['buyingPrice']);
            $priceObject->setBuyQuantity($item['buyingQuantity']);
            $priceObject->setSellingPrice($item['sellingPrice']);
            $priceObject->setSellQuantity($item['sellingQuantity']);

            $price = $priceObject;
            return $price;
        }
    }
}