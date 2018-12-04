<?php
/**
 * Created by PhpStorm.
 * User: paashaas
 * Date: 12/3/2018
 * Time: 22:35
 */

namespace Exchange;
use Exchange\requestHandler;
use Exchange\ConfigGetter;
use Exchange\PriceModel;

class itemsModel
{

    protected $name;

    protected $id;

    protected $store;

    protected $price;

    protected $isMembers;

    protected $image;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }



    /**
     * @return mixed
     */
    public function getisMembers()
    {
        return $this->isMembers;
    }

    /**
     * @param mixed $isMembers
     */
    public function setIsMembers($isMembers)
    {
        $this->isMembers = $isMembers;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param mixed $store
     */
    public function setStore($store)
    {
        $this->store = $store;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    public static function get(bool $asArray = false,bool $withImages){
        $config = ConfigGetter::getConfig();

        $response = requestHandler::request($config['names_url']);

        $items = json_decode($response,true);

        if ($asArray){
            return $items;
        }else{
            $newItems = [];
            foreach ($items as $key=>$item){
                $itemObject = new itemsModel();
                $itemObject->setName($item['name']);
                $itemObject->setId((int)$key);
                $itemObject->setStore((int)$item['store']);
                if ($withImages){
                    $url = $config['img_url'].$key.'.png';
                    $fileName = $item['name'];

                    $path = requestHandler::downloadImage($url,$fileName,'.png');
                    $itemObject->setImage($path);
                }

                $newItems[] = $itemObject;
            }
        }

        return $newItems;
    }


    public static function getWithPrice($asArray = false ,bool $withImages){
        $config = ConfigGetter::getConfig();

        $response = requestHandler::request($config['names_withPrice']);

        $items = json_decode($response,true);

        if ($asArray){
            return $items;
        }else{
            $newItems = [];
            foreach ($items as $key=>$item){


                $itemObject = new itemsModel();
                $itemObject->setName($item['name']);
                $itemObject->setId((int)$key);
                $itemObject->setStore((int)$item['sp']);
                $itemObject->setIsMembers($item['members']);
                if ($withImages){
                    $url = $config['img_url'].$key.'.png';
                    $fileName = $item['name'];

                    $path = requestHandler::downloadImage($url,$fileName,'.png');
                    $itemObject->setImage($path);
                }


                $priceObject = new PriceModel();
                $priceObject->setBuyPriceAvr($item['buy_average']);
                $priceObject->setBuyQuantity($item['buy_quantity']);
                $priceObject->setSellPriceAvr($item['sell_average']);
                $priceObject->setSellQuantity($item['sell_quantity']);
                $priceObject->setOveralAverage($item['overall_average']);
                $priceObject->setOveralQuantity($item['overall_quantity']);

                $itemObject->setPrice($priceObject);

                $newItems[] = $itemObject;
            }
        }

        return $newItems;
    }
}