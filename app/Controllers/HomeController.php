<?php
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $mensaje = "Bienvenido a la Prueba Técnica KAWAK 🎯";
        $this->view('home/index', ['mensaje' => $mensaje]);
    }

   

    public function auth()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === 'admin' && $password === '1234') {
               header('Location: /document_crud/public/dashboard');
                exit;
            //  $this->view('dashboard/index', ['username' => $username]);
        } else {
            echo "Usuario o contraseña incorrectos";
        }
    }
}