<?php
/**
 * Created by PhpStorm.
 * User: paashaas
 * Date: 12/3/2018
 * Time: 22:35
 */

namespace Exchange;
use Exchange\requestHandler;

class itemsModel
{

    protected $name;

    protected $id;

    protected $store;

    protected $price;

    public function get(){
        $response = requestHandler::request('names.json');
    }

    public function getWithPrice(){

    }
}