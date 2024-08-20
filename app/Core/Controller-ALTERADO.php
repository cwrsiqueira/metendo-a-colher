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
            die("Página não existe.");
        }
    }

    public function loadViewInTemplate($viewName, $viewData = [])
    {
        extract($viewData);
        $viewPath = __DIR__ . '/../views/' . $viewName . '.php';
        require $viewPath;
    }
}
