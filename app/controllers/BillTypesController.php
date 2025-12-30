<?php
class BillTypesController extends Controller 
{
    public function index()
    {
        $types = BillTypes::getAll();

        $this->view('bill-types',[
            'bill_types' => $types
        ],'admin');
    }

    public function create()
    {
        $errors = [
            'error_code' => $_SESSION['error_code'] ?? null
        ];

        unset($_SESSION['error_code']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'code' => $_POST['code'] ?? '',
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? ''
            ];

            $response_create = BillTypes::create($data);

            if($response_create === false){
                $_SESSION['error_code'] = "Kode tagihan sudah ada";
                $_SESSION['old_data'] = $data;
                header('Location: ' . url('bill-types/create'));
                exit;
            }

            header('Location: ' . url('bill-types'));
            exit;
        }

        $this->view('bill-types', [
            'errors' => $errors,
            'old_data' => $_SESSION['old_data'] ?? []
        ], 'admin');

        unset($_SESSION['old_data']);
    }
}