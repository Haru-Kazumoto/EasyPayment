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

    // mengambil data lama untuk di fetch ke view
    public function show()
    {
        $class_id = $_GET['class_id'];

        try {
            if (!$class_id) {
                $this->error('ID Tidak ditemukan!', null, 400);
            }

            $class_data = Classes::find($class_id);

            if (!$class_data) {
                $this->error('Data tidak ditemukan!', null, 400);
            }

            $this->success('Data berhasil diambil', $class_data);
        } catch (\Exception $e) {
            $this->error('Gagal mengambil data: ' . $e->getMessage(), null, 500);
        }
    }

    // logika update
    public function update()
    {
        try {
            $id = $_GET['class_id'] ?? null;

            if (!$id) {
                $_SESSION['flash_error'] = 'ID kelas tidak ditemukan';
                
                $this->error("Id tidak ada");
            }

            // Ambil & trim data
            $name = $_POST['edit_name'] ?? '';
            $code = trim($_POST['edit_code'] ?? '');

            // Validasi
            $errors = [];

            if ($name === '') {
                $errors['edit_name'] = 'Nama kelas wajib diisi';
            }

            if ($code === '') {
                $errors['edit_code'] = 'Kode kelas wajib diisi';
            }

            if (!empty($errors)) {
                $_SESSION['flash_error'] = 'Validasi gagal';
                $_SESSION['flash_errors'] = $errors;

                $this->error("Validasi gagal");
            }

            $data = [
                'name' => $name,
                'code' => $code
            ];

            $updated = Classes::update($id, $data);

            if (!$updated) {
                throw new Exception('Gagal memperbarui data kelas');
            }

            $_SESSION['flash_success'] = 'Data kelas berhasil diperbarui';

            $this->success("Berhasil memperbarui data");
        } catch (Exception $e) {
            $_SESSION['flash_error'] = $e->getMessage();
            $this->error("Gagal memperbarui data: ".$e->getMessage(), null, 500);
        }
    }


    // logika delete, gak perlu fetch data karna langsung passing id
    public function delete(): void
    {
        $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

        if ($method !== 'DELETE') {
            header('Location: ' . url('classes'));
            exit;
        }

        $id = $_POST['id'] ?? null;

        if (!$id) {
            header('Location: ' . url('classes'));
            exit;
        }

        Classes::delete($id);

        header('Location: ' . url('classes'));
        exit;
    }
}
