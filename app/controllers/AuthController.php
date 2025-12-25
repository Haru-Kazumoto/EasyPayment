<?php
class AuthController extends Controller
{
    public function login()
    {
        // Jika sudah login, redirect ke dashboard sesuai role
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['is_admin']) {
                header('Location: ?page=dashboard-admin');
            } else {
                header('Location: ?page=dashboard-student');
            }
            exit;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Validasi input
            if (empty($username) || empty($password)) {
                $error = 'Username dan password harus diisi';
            } else {
                $user = User::findByUsername($username);

                if ($user && password_verify($password, $user['password'])) {
                    // Login berhasil
                    $_SESSION['user'] = $user;

                    // Redirect berdasarkan role
                    if ($user['is_admin']) {
                        header('Location: ?page=dashboard-admin');
                    } else {
                        header('Location: ?page=dashboard-student');
                    }
                    exit;
                } else {
                    $error = 'Username atau password salah';
                }
            }
        }

        $this->view('login', [
            'error' => $error,
        ], 'guest');
    }

    public function logout()
    {
        session_destroy();
        header('Location: ?page=login');
        exit;
    }
}
