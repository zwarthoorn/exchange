<?php
/**
 * Created by PhpStorm.
 * User: paashaas
 * Date: 12/3/2018
 * Time: 22:02
 */

namespace Exchange;



class Api
{
    protected $config;

    /*
     * get the names of all the items in game
     * with images will make it slow becouse of the image download speed
     */
    public static function getNames(bool $withPrice = false,bool $withImages = false, bool $asArray = false) {

        if (!$withPrice){
           return itemsModel::get($asArray,$withImages);
        }else{
            return itemsModel::getWithPrice($asArray,$withImages);
        }

    }
    public static function getImageByItemId($itemId,$name = null,$extension = '.png'){
        $config = ConfigGetter::getConfig();

        $url = $config['img_url'].$itemId.'.png';
        $fileName = $itemId;
        if ($name) $fileName = $name;

        $path = requestHandler::downloadImage($url,$fileName,$extension);

        return $path;
    }

    public static function getPriceRangeItem($itemId){

    }

    public static function getPriceItem($itemId){

    }

}