<?php


namespace Models;


use Core\Model;
use GuzzleHttp;
class Country extends Model
{
    public static function getInfo($temp)
    {
        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', "https://restcountries.eu/rest/v2/name/{$temp}");
        if ($res->getStatusCode() == 200) {
            $res = json_decode($res->getBody(), true);
            return $res[0];
        }
    }

}