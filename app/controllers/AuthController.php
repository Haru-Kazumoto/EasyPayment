<?php
class AuthController extends Controller {
    public function login() {
        $error = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = User::findByEmail($_POST['email']);
            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: /?page=dashboard');
                exit;
            }
            $error = 'Email atau password salah';
        }
        
        $this->view('login', ['error' => $error], 'student');
    }
}
