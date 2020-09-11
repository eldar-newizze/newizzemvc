<?php

namespace Controllers;

use Core\Controller;
use Models\User;

class MainController extends Controller
{
    public function index()
    {
        $a = 'sdfsdf';
        $this->view('home/index', []);
    }

    public function one()
    {
        $this->view('home/index', ['obj' => User::one()]);
    }

    public function two()
    {
        $this->view('home/index', ['obj' => User::two()]);
    }

    public function three()
    {
        $this->view('home/index', ['obj' => User::three()]);
    }
}
