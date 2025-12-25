<?php
class AuthController extends Controller
{
    public function login()
    {
        $this->redirectIfAuthenticated();

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($username === '' || $password === '') {
                $error = 'Username dan password harus diisi';
            } else {
                $user = User::findByUsername($username);

                if (!$user || !password_verify($password, $user['password'])) {
                    $error = 'Username atau password salah';
                } else {
                    $this->authenticate($user);
                    $this->redirectByRole($user['is_admin']);
                }
            }
        }

        $this->view('login', compact('error'), 'guest');
    }

    public function logout()
    {
        session_destroy();
        // unset($_SESSION['user']);
        // header('Location: ?page=login');
        // exit;
    }

    private function redirectIfAuthenticated()
    {
        if (!isset($_SESSION['user'])) {
            return;
        }

        $this->redirectByRole($_SESSION['user']['is_admin']);
    }

    private function authenticate(array $user)
    {
        session_regenerate_id(true);
        $_SESSION['user'] = $user;
    }

    private function redirectByRole(bool $isAdmin)
    {
        header(
            'Location: ?page=' . ($isAdmin ? 'dashboard-admin' : 'dashboard-student')
        );
        exit;
    }
}
