<?php
class BillsController extends Controller
{
    public function index()
    {
        $this->view('bills', [], 'student');
    }

    public function indexAdmin()
    {
        $this->view('admin-bills', [
            'bills' => Bill::getAll()
        ], 'admin');
    }

    public function create()
    {
        $this->view('create-bills', [
            'types' => BillTypes::getAll()
        ], 'admin');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bill_data = [
                'title'         => $_POST['title'],
                'subtitle'      => $_POST['subtitle'],
                'amount'        => $_POST['amount'],
                'due_date'      => $_POST['due_date'],
                'admin_id'      => auth()->id,
                'type_id'       => $_POST['type_id'],
                'academic_year' => $_POST['academic_year']
            ];

            $db = Database::getInstance()->pdo();

            $db->beginTransaction();

            try {
                Bill::create($bill_data);

                $_SESSION['flash_success'] = 'Berhasil menambahkan tagihan!';


                $db->commit();

                header('Location: ' . url('admin-bills'));
                exit;
            } catch (\Exception $e) {
                $db->rollback();

                throw $e;
            }
        }
    }

    public function edit()
    {
        $this->view('edit-bills', [
            'bill' => Bill::findOne($_GET['id']),
            'types' => BillTypes::getAll()
        ], 'admin');
    }

    public function update()
    {
        $bill_id = $this->getId($_GET['bill_id']);

        try {
            if (!$bill_id) {
                $this->error("ID Tidak Ada!");
            }

            // get request body
            $data = [
                'title' => $_POST['title'],
                'subtitle' => $_POST['subtitle'],
                'amount' => $_POST['amount'],
                'due_date' => $_POST['due_date'],
                'type_id' => $_POST['type_id'],
            ];
            $errors = [];

            if ($data['title'] === '') {
                $errors['title'] = 'Judul tagihan harus diisi';
            }
            if ($data['subtitle'] === '') {
                $errors['subtitle'] = 'Deskripsi tagihan harus diisi';
            }
            if ($data['amount'] === '') {
                $errors['amount'] = 'Jumlah tagihan harus diisi';
            }
            if ($data['due_date'] === '') {
                $errors['due_date'] = 'Tanggal jatuh tempo tagihan harus diisi';
            }
            if ($data['type_id'] === '') {
                $errors['type_id'] = 'Tipe tagihan harus diisi';
            }

            if (!empty($errors)) {
                $_SESSION['flash_error'] = 'Validasi gagal';
                $_SESSION['flash_errors'] = $errors;

                $this->error("Validasi gagal");
            }

            $updated = Bill::update($data, $bill_id);

            if (!$updated) {
                throw new Exception('Gagal memperbarui data tagihan');
            }

            $_SESSION['flash_success'] = 'Data tagihan berhasil diperbarui';

            $this->success($_SESSION['flash_success']);
        } catch (\Exception $e) {
            $_SESSION['flash_error'] = $e->getMessage();
            $this->error('Gagal memperbarui data: ' . $e->getMessage(), null, 500);
        }
    }

    public function delete(): void
    {
        $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

        if ($method !== 'DELETE') {
            header('Location: ' . url('admin-bills'));
            exit;
        }

        $id = $_POST['id'] ?? null;

        if (!$id) {
            header('Location: ' . url('admin-bills'));
            exit;
        }

        Bill::delete($id);

        header('Location: ' . url('admin-bills'));
        exit;
    }

    private function getId(int $id)
    {
        return isset($id) ? (int) $id : null;
    }
}
