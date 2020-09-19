<?php


namespace Controllers;

use Core\Controller;
use Models\User;
use GuzzleHttp;

class VkapiController extends Controller
{
    public function setcode(){

        $this->view("viewFriends/viewFriends", [User::getToken()] );
    }
    public function exitAccount(){
        session_destroy();
        $this->view('main/index');
    }
}