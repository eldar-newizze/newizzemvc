<?php


namespace Controllers;



use Models\RandomFriends;

class RandomFriendsController extends \Core\Controller
{
    public function index()
    {
        $data = RandomFriends::index();
        //var_dump($data);
        $this->view('randomFriend',$data);
    }
}