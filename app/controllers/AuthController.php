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
        
        /**
         * view punya 3 parameter sekarang
         * 1. nama view
         * 2. data yang dikirim ke view
         * 3. layout yang dipakai
         * default layout adalah 'user'
         * kita mau ganti layoutnya jadi 'student'
         * karena halaman login ini untuk student
         * jadi kita panggil layout student
         * jangan lupa buat layout student di views/layouts/student.php
         * dan isinya bisa di copy dari layout guest
         * 
         * jadi layout itu utamanya isian dari header, footer, dan navigasi
         * biar gak perlu nulis berulang-ulang di tiap view
         * jadi di layout kita panggil $content yang isinya adalah view yang kita panggil
         */
        $this->view('login', ['error' => $error], 'student');
    }
}
