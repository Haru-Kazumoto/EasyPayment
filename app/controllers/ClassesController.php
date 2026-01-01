<?php

class ClassesController extends Controller
{
 
    public function index(): void
    {
        $classes = Classes::getAll();

        $this->view('classes',['classes' =>$classes],'admin');
    }

    public function create()
    {
        $this->view('create-classes',[],'admin');
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'code' => $_POST['code'] ?? '',
                'name' => $_POST['name'] ?? '',
            ];

             Classes::create($data);

            header('Location: ' . url('classes'));
            exit;
        }
    }
}
 
