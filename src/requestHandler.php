<?php
/**
 * Created by PhpStorm.
 * User: paashaas
 * Date: 12/3/2018
 * Time: 22:30
 */

namespace Exchange;
use GuzzleHttp\Client;

class requestHandler
{

    public static  function downloadImage($url,$name,$extensions){
        $path = __DIR__.'/download/' . $name . $extensions;
        $file_path = fopen($path,'w');
        $client = new Client();
        $response = $client->get($url, ['save_to' => $file_path]);
        return $path;
    }

    public static function request(string $url = ''){
        $configs = include('config/config.php');
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $configs['base_url'],
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);


            $response = $client->request('GET', $url);


        return $response->getBody();

    }
}