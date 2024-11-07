<?php
require_once __DIR__ . '/../models/Lorong.php'; // Memuat model Lorong

class LorongController
{
    private $lorong;

    public function __construct($pdo)
    {
        $this->lorong = new Lorong($pdo); // Inisialisasi model Lorong
    }

    public function index()
    {
        $data['lorong'] = $this->lorong->getAll(); // Mengambil semua data lorong
        $data['page_title'] = "Daftar Lorong"; // Menetapkan judul halaman
        extract($data); // Mengubah array menjadi variabel lokal
        
        $view = __DIR__ . '/../views/lorong/index.php'; // Menetapkan view untuk ditampilkan
        require __DIR__ . '/../views/layouts/main.php'; // Memuat layout
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->lorong->create($_POST); // Proses penyimpanan lorong
            $_SESSION['success'] = "Lorong berhasil ditambahkan!";
            header('Location: /?controller=lorong&action=index'); // Redirect setelah penyimpanan
            exit; // Pastikan keluar setelah redirect
        } else {
            $data['page_title'] = "Tambah Lorong"; // Menetapkan judul untuk halaman tambah
            $view = __DIR__ . '/../views/lorong/create.php'; // Menetapkan view untuk ditampilkan
            require __DIR__ . '/../views/layouts/main.php'; // Memuat layout
        }
    }

    public function edit($id)
    {
        // Mengambil lorong berdasarkan ID
        $data['lorong'] = $this->lorong->find($id);

        // Jika lorong tidak ditemukan, redirect ke halaman index
        if (!$data['lorong']) {
            $_SESSION['error'] = "Lorong tidak ditemukan!";
            header('Location: /?controller=lorong&action=index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->lorong->update($id, $_POST); // Proses pembaruan lorong
            $_SESSION['success'] = "Lorong berhasil diperbarui!";
            header('Location: /?controller=lorong&action=index'); // Redirect setelah pembaruan
            exit; // Pastikan keluar setelah redirect
        } else {
            $data['page_title'] = "Edit Lorong"; // Menetapkan judul untuk halaman edit
            $view = __DIR__ . '/../views/lorong/edit.php'; // Menetapkan view untuk ditampilkan
            require __DIR__ . '/../views/layouts/main.php'; // Memuat layout
        }
    }

    public function delete($id)
    {
        $this->lorong->delete($id); // Menghapus lorong berdasarkan ID
        $_SESSION['success'] = "Lorong berhasil dihapus!";
        header('Location: /?controller=lorong&action=index'); // Redirect ke halaman lorong setelah berhasil
        exit; // Pastikan untuk keluar setelah redirect
    }
}
