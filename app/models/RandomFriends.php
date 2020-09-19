<?php


namespace Models;


use Core\Model;
use GuzzleHttp;

class RandomFriends extends Model
{
    public static function index()
    {

        $client = new GuzzleHttp\Client();
        $url = self::vkAPI();

        $res = $client->request('GET', $url);

        $json = $res->getBody();
        //self::addSession($json['response']['items']);

        return json_decode($json, true);
    }


    public static function vkAPI()
    {
        $array = [
            'user_id' => '192938350',
            'order' => 'random',
            'count' => '10',
            'fields' => 'photo_200_orig,country,city'
        ];

        $token = '&access_token=' . env(API_KEY);

        return 'https://api.vk.com/method/friends.get?' . http_build_query($array) . $token . '&v=5.124';
    }

    public static function addSession($friends)
    {
        session_start();
        $_SESSION['friends'] = "$friends";
    }
}
