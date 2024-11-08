<?php
require_once __DIR__ . '/../models/User.php'; // Memuat model User

class LoginController {
    private $user;

    public function __construct($pdo) {
        $this->user = new User($pdo); // Inisialisasi model User
    }

    public function showLoginForm() {
        require __DIR__ . '/../views/login.php'; // Menetapkan tampilan login tanpa layout
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userData = $this->user->findByUsername($username); // Mencari pengguna berdasarkan username
            if ($userData && password_verify($password, $userData['password'])) {
                // Set session jika login berhasil
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['username'] = $username;
                header('Location: /?controller=dashboard&action=index'); // Alihkan ke dashboard
                exit;
            } else {
                $_SESSION['error'] = "Username atau Password salah!";
                header('Location: /?controller=login&action=showLoginForm'); // Kembali ke form login
                exit;
            }
        }
    }

    public function logout() {
        session_start();
        session_unset(); // Menghapus session
        session_destroy(); // Menghancurkan session
        header('Location: /?controller=login&action=showLoginForm'); // Kembali ke login
        exit;
    }
}
?>
