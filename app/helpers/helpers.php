<?php
if (!function_exists('env')) {
    function env($param)
    {
        if (isset($_ENV[$param])) {
            return $_ENV[$param];
        }
    }
}

if (!function_exists('basePath')) {
    function basePath($file = '')
    {
        return __DIR__.'../../'.$file;
    }
}

if (!function_exists('publicPath')) {
    function publicPath($file = '')
    {
        return basePath().'public/'.$file;
    }
}

if (!function_exists('isAuth')) {
    function isAuth()
    {
        return isset($_SESSION['auth']['id'])
            ? true
            : false;
    }
}

if (!function_exists('auth')) {
    function auth()
    {
        if (isAuth()) {
            return (object)[
                'id' => $_SESSION['auth']['id'],
                'name' => $_SESSION['auth']['name'],
                'login' => $_SESSION['auth']['login'],
            ];
        }
        return null;
    }
}

if (!function_exists('setAuth')) {
    function setAuth($data)
    {
        $_SESSION['auth']['id'] = $data['id'];
        $_SESSION['auth']['name'] = $data['name'];
        $_SESSION['auth']['login'] = $data['login'];
    }
}

if (!function_exists('logout')) {
    function logout()
    {
        if (isset($_SESSION['auth'])) {
            unset($_SESSION['auth']);
        }
    }
}

if (!function_exists('redirect')) {
    function redirect($path, $flash = [])
    {
        if ($flash) {
            setFlash($flash['key'], $flash['message']);
        }
        header('Location: ' . $path);
    }
}

if (!function_exists('back')) {
    function back($flash = [])
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            if ($flash) {
                setFlash($flash['key'], $flash['message']);
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}

if (!function_exists('setFlash')) {
    function setFlash($key, $message)
    {
        if ($message) {
            $_SESSION['flash'][$key] = $message;
        }
    }
}

if (!function_exists('getFlash')) {
    function getFlash($key)
    {
        if (isset($_SESSION['flash'][$key])) {
            $msg = $_SESSION['flash'][$key];
            unset($_SESSION['flash']);
            return $msg;
        }
        return false;
    }
}
