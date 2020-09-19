<?php


namespace Controllers;

use Core\Controller;

class AdminController extends Controller
{
    protected $defaultTemplate = 'default/admin_layout';

    public function __construct()
    {
        if (!isAuth()) {
            redirect('/admin-auth/login');
        }
    }

        public function index()
    {
        $this->view('admin/dashboard');
    }


}
