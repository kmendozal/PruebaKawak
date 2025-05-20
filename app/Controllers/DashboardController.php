<?php

namespace App\Controllers;

use App\Models\Document;

use App\Core\Controller;


class DashboardController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Document();
    }

    public function index()
    {
        $documentos = $this->model->all();

        $this->view('dashboard/index', ['data' => $documentos]);
    }

    public function buscar()
    {
        $mensaje = "Bienvenido al Dashboard";
        $this->view('dashboard/buscar', ['data' => $mensaje]);
    }

       public function buscarAction()
    {
        $documento= $_POST["codigo"];
        $busqueda =  $this->model->findCod($documento);
        $this->view('dashboard/buscar', ['data' => $busqueda]);

   
    }


    public function creacion()
    {
        $procesos =  $this->model->getProcesos();
        $tipos =  $this->model->getTipos();
        $arrayData = ["procesos" => $procesos, "tipos" => $tipos];

        $this->view('dashboard/creacion', ['arrayData' => $arrayData]);
    }

    public function creacionAction()
    {

        $creacion =  $this->model->create($_POST);
        header('Location: /document_crud/public/dashboard');
    }


    public function editar()
    {
        $id = $_GET['id'] ?? '';
        $editarModel =  $this->model->find($id);
        $procesos =  $this->model->getProcesos();
        $tipos =  $this->model->getTipos();
        $arrayData = ["procesos" => $procesos, "tipos" => $tipos, "documento" => $editarModel];


        $this->view('dashboard/editar', ['data' => $arrayData]);
    }

    public function EditarAction()
    {
        $id = $_POST['DOC_ID'];
        $edicion =  $this->model->update($id,$_POST);
        header('Location: /document_crud/public/dashboard');
    }

    public function eliminar()
    {
        $id = $_GET['id'] ?? '';
        $documentos = $this->model->delete($id);

        header('Location: /document_crud/public/dashboard');
    }
}
