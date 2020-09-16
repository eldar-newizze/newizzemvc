<?php

namespace Models;

use Core\Model;
use GuzzleHttp;

class User extends Model
{
    public static function getUserInfo($userId)
    {
        $vk_api = env('VK_API');
        $answer = ['userId' => $userId];

        $client = new GuzzleHttp\Client(['http_errors' => false]);
        $res = $client->request('GET',
            "https://api.vk.com/method/friends.get?user_id={$userId}&v=5.124&order=name&count=10&fields=city,photo,country&access_token={$vk_api}");
        if($res->getStatusCode() == 200) {
            $rez = json_decode($res->getBody(), JSON_PRETTY_PRINT);

            $rez = $rez["response"]["items"];
            foreach ($rez as $item) {
                if($item['country']['title'] !== NULL) {
                    $country = $client->request('GET',
                        "https://restcountries.eu/rest/v2/name/{$item['country']['title']}");
                    if ($country->getStatusCode() == 200) {
                        $country = json_decode($country->getBody(), JSON_PRETTY_PRINT);
                    }
                }

                array_push($answer,
                    [
                        'id' => $item['id'],
                        'first_name' => $item['first_name'],
                        'last_name' => $item['last_name'],
                        'photo' => $item['photo'],
                        'city' => $item['city']['title'],
                        'country' => $country
                    ]);
            }
        } else {
            array_push($answer, ['error' => 'Упс, ошибочка']);
        }

        return ($answer);
    }
}
