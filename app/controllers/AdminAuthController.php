<?php


namespace Controllers;

use Core\Controller;
use Models\User;

class AdminAuthController extends Controller
{
    protected $defaultTemplate = 'default/admin_auth_layout';

    public function registration()
    {
        $this->view('admin/auth/registration', []);
    }

    public function login()
    {
        $this->view('admin/auth/login', []);
    }

    public function logout()
    {
        logout();
        redirect('/admin-auth/login');
    }

    public function registrationStore()
    {
        if (isset($_POST['name']) && isset($_POST['login']) && isset($_POST['password'])) {
            $name = $_POST['name'];
            $login = htmlspecialchars($_POST['login']);
            $password = md5($_POST['password']);
            $findUser = User::findOne('users', ' login = ? ', [$login]);
            if ($findUser) {
                return redirect('/admin-auth/registration',
                    ['key' => 'error', 'message' => 'This user already exist!']);
            }
            $user = User::dispense('users');
            $user->name = $name;
            $user->login = $login;
            $user->password = $password;
            if ($id = User::store($user)) {
                setAuth([
                    'id' => $id,
                    'name' => $name,
                    'login' => $login
                ]);
                return redirect('/admin');
            }
        }
        return back(['key' => 'error', 'message' => 'Empty data!']);
    }

    public function loginStore()
    {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = md5($_POST['password']);
            $findUser = User::findOne('users', ' login = ? and password = ? ', [$login, $password]);
            if ($findUser) {
                setAuth([
                    'id' => $findUser->id,
                    'name' => $findUser->name,
                    'login' => $findUser->login,
                ]);
                return redirect('/admin');
            } else {
                return redirect('/admin-auth/login', ['key' => 'error', 'message' => 'Login or password are incorrect!']);
            }
        }
    }
}
