<?php

namespace App\Core;

class Controller
{
    public function loadTemplate($viewName, $viewData = [])
    {
        $templatePath = __DIR__ . '/../views/template.php';
        if (file_exists($templatePath)) {
            require_once $templatePath;
        } else {
            require __DIR__ . '/../views/erro.php';
            exit;
        }
    }

    public function loadViewInTemplate($viewName, $viewData = [])
    {
        extract($viewData);
        $viewPath = __DIR__ . '/../views/' . $viewName . '.php';
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            require __DIR__ . '/../views/erro.php';
            exit;
        }
    }
}
