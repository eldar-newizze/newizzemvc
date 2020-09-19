<?php

namespace Controllers;

use Core\Controller;
use Models\User;

class MainController extends Controller
{
    public function index()
    {

        $this->view('main/index', []);
    }
}
