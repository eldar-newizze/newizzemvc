<?php


namespace Controllers;


use Core\Controller;
use Models\Country;

class AnyCountryController extends Controller
{
    public function getInfo($temp, $temp2, $temp3)
    {
        $this->view('Country/country', Country::getInfo($temp3));
    }

}