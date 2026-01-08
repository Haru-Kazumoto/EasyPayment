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

    public function show()
    {
        $type_id = $this->getId($_GET['type_id']);

        try {
            if (!$type_id) {
                $this->error('ID Tidak ada!');
            }

            $type_data = BillTypes::findOne($type_id);

            if (!$type_data) {
                $this->error('Data tidak ditemukan!');
            }

            $this->success("Data ditemukan", $type_data);
        } catch (\Exception $e) {
            $this->error("Gagal mengambil data: " . $e->getMessage(), null, 500);
        }
    }

    public function update()
    {
        $type_id = $this->getId($_GET['type_id']);

        try {
            if (!$type_id) {
                $this->error('ID Tidak ada!');
            }

            // get the body
            $name = $_POST['edit_name'] ?? '';
            $code = trim($_POST['edit_code'] ?? '');
            $description = $_POST['edit_description'] ?? '';

            // error validation bags
            $errors = [];

            if ($name === '') {
                $errors['edit_name'] = 'Nama jenis tagihan wajib diisi';
            }

            if ($code === '') {
                $errors['edit_code'] = 'Kode jenis tagihan wajib diisi';
            }

            if (!empty($errors)) {
                $_SESSION['flash_error'] = 'Validasi gagal';
                $_SESSION['flash_errors'] = $errors;

                $this->error("Validasi gagal");
            }

            $data = [
                'name' => $name,
                'code' => $code,
                'description' => $description
            ];

            $updated = BillTypes::update($data, $type_id);

            if (!$updated) {
                throw new Exception('Gagal memperbarui data kelas');
            }

            $_SESSION['flash_success'] = 'Data berhasil diperbarui!';

            $this->success($_SESSION['flash_success']);
        } catch (\Exception $e) {
            $this->error("Gagal memperbarui data: " . $e->getMessage(), null, 500);
        }
    }

    public function delete()
    {
        $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

        if ($method !== 'DELETE') {
            header('Location: ' . url('bill-types'));
            exit;
        }

        $id = $_POST['id'] ?? null;

        if (!$id) {
            header('Location: ' . url('bill-types'));
            exit;
        }

        BillTypes::delete($id);
        
        $_SESSION['flash_success'] = 'Data berhasil dihapus!';

        header('Location: ' . url('bill-types'));
        exit;
    }

    private function getId(int $id)
    {
        return isset($id) ? (int) $id : null;
    }
}
