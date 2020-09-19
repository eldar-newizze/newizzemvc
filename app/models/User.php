<?php

namespace Models;

use Core\Model;
use GuzzleHttp;

class User extends Model
{
    public static function getToken() {
        try {
            $client = new GuzzleHttp\Client();
            $res = $client->request('GET',"https://api.vk.com/method/users.get?v=5.124&access_token={$_SESSION['access_token']}&fields=photo_50");
            $res = json_decode($res->getBody(), true);
            $_SESSION['first_name'] = $res['response'][0]['first_name'];
            $_SESSION['photo_50'] = $res['response'][0]['photo_50'];
            try {
                $res = $client->request('GET', "https://api.vk.com/method/friends.get?v=5.124&access_token={$_SESSION['access_token']}&count=10&fields=domain,city,country,photo_200&lang=en");
                $res = json_decode($res->getBody(), true);
                return $res;
            }catch (\Exception $e){
                echo "ПРОБЛЕМЫ С ДРУЗЬЯМИ????<br>";
                echo $e;
            }
        }catch (\Exception $e){
            echo "Ты ХТО????<br>";
            echo $e;
        }

    }

}
