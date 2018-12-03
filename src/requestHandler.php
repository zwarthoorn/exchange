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

    public static function request(string $url = ''):string{
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://httpbin.org',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);


            $response = $client->request('GET', $url);


        return $response->getBody();

    }
}