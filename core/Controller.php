<?php

namespace Core;

class Controller
{
    protected $defaultTemplate = 'default/layout';

    public function view($view, $data = [])
    {
        $path = $this->getViewPath($view);
        if (file_exists($path)) {
            ob_start();
            extract($data);
            require $path;
            $tmp = ob_get_clean();
            echo $this->defaultTemplate(['content' => $tmp]);
        }
    }

    public function defaultTemplate($tmp)
    {
        $path = $this->getViewPath($this->defaultTemplate);
        if (file_exists($path)) {
            ob_start();
            extract($tmp);
            require $path;
            return ob_get_clean();
        }
    }

    private function getViewPath($path)
    {
        return __DIR__.'/../views/'.$path.'.php';
    }
}
