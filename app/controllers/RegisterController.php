<?php
require_once __DIR__ . '/../models/User.php'; // Memuat model User

class RegisterController {
    private $user;

    public function __construct($pdo) {
        $this->user = new User($pdo); // Inisialisasi model User
    }

    public function showRegisterForm() {
        require __DIR__ . '/../views/register.php'; // Memuat view registrasi tanpa layout
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validasi formulir
            $data = $_POST;

            if (!empty($data['username']) && !empty($data['password'])) {
                $this->user->create($data); // Menyimpan pengguna baru
                $_SESSION['success'] = "Registrasi berhasil! Silakan login."; // Pesan sukses
                header('Location: /?controller=login&action=showLoginForm'); // Alihkan ke halaman login
                exit;
            } else {
                $_SESSION['error'] = "Semua field harus diisi!";
                header('Location: /?controller=register&action=showRegisterForm'); // Kembali ke form
                exit;
            }
        }
    }
}
?>
