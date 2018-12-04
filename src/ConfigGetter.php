<?php
/**
 * Created by PhpStorm.
 * User: walter
 * Date: 04/12/2018
 * Time: 13:39
 */

namespace Exchange;


class ConfigGetter
{
    public static function getConfig(){
        return  include('config/config.php');
    }
}