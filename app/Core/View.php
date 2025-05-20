<?php
namespace App\Core;

class View
{
    public static function render(string $view, array $data = [])
    {
        extract($data);
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';

        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo "Vista no encontrada: $viewPath";
        }
    }
}