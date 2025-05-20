<?php
namespace App\Core;

class Controller
{
    protected function view(string $view, array $data = [])
    {
        View::render($view, $data);
    }
}