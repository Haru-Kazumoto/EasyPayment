<?php

class ClassesController extends Controller
{

    public function index(): void
    {
        $classes = Classes::getAll();

        $this->view('classes', ['classes' => $classes], 'admin');
    }

    public function create()
    {
        $this->view('create-classes', [], 'admin');
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

    /**
     * silahkan lanjutkan untuk update dan delete
     * update dan delete ini harus passing id dari data yang dipilih
     * 
     * logika update:
     * ambil data dari id yang dipilih, fetch datanya, passing data lama ke view
     * kalau di submit pakai PATCH aja, jangan PUT
     * 
     * logika delete: 
     * delete data dari id yang dipilih, langsung DELETE aja gapapa.
     */

    // mengambil data lama untuk di fetch ke view
    public function edit() 
    {
        if (!isset($_GET['id'])) {
            header('Location: ' . url('classes'));
            exit;
        }

        $class = Classes::find($_GET['id']);

        if (!$class) {
            header('Location: ' . url('classes'));
            exit;
        }

        // passing data lama ke view
        $this->view('edit-classes',['classes' => $class],  'admin');

        }

    // logika update
    public function update() {}

    // logika delete, gak perlu fetch data karna langsung passing id
    public function delete() {}
}
