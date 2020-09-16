<?php


namespace Controllers;

use Core\Controller;
use Models\User;

class APIController extends Controller
{
    public function getUserInfo($class, $method, $userId) {
        $this->view('main/api', [User::getUserInfo($userId)]);
    }
}