<?php
class BillTypesController extends Controller
{
    public function index()
    {
        $types = BillTypes::getAll();

        $this->view('bill-types', [
            'bill_types' => $types
        ], 'admin');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'code' => $_POST['code'] ?? '',
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? ''
            ];

            BillTypes::create($data);

            header('Location: ' . url('bill-types'));
            exit;
        }
    }
}
