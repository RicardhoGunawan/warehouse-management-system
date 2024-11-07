<?php
require_once __DIR__ . '/../models/Ruangan.php'; // Memuat model Ruangan

class RuanganController
{
    private $ruangan;

    public function __construct($pdo)
    {
        $this->ruangan = new Ruangan($pdo); // Inisialisasi model Ruangan
    }

    public function index()
    {
        $data['ruangan'] = $this->ruangan->getAll(); // Mengambil semua data ruangan
        $data['page_title'] = "Daftar Ruangan"; // Menetapkan judul halaman
        extract($data); // Mengubah array menjadi variabel lokal
        
        $view = __DIR__ . '/../views/ruangan/index.php'; // Menetapkan view untuk ditampilkan
        require __DIR__ . '/../views/layouts/main.php'; // Memuat layout
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ruangan->create($_POST); // Proses penyimpanan ruangan
            $_SESSION['success'] = "Ruangan berhasil ditambahkan!";
            header('Location: /?controller=ruangan&action=index'); // Redirect setelah penyimpanan
            exit; // Pastikan keluar setelah redirect
        } else {
            $data['page_title'] = "Tambah Ruangan"; // Menetapkan judul untuk halaman tambah
            $view = __DIR__ . '/../views/ruangan/create.php'; // Menetapkan view untuk ditampilkan
            require __DIR__ . '/../views/layouts/main.php'; // Memuat layout
        }
    }

    public function edit($id)
    {
        // Mengambil ruangan berdasarkan ID
        $data['ruangan'] = $this->ruangan->find($id);

        // Jika ruangan tidak ditemukan, redirect ke halaman index
        if (!$data['ruangan']) {
            $_SESSION['error'] = "Ruangan tidak ditemukan!";
            header('Location: /?controller=ruangan&action=index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ruangan->update($id, $_POST); // Proses pembaruan ruangan
            $_SESSION['success'] = "Ruangan berhasil diperbarui!";
            header('Location: /?controller=ruangan&action=index'); // Redirect setelah pembaruan
            exit; // Pastikan keluar setelah redirect
        } else {
            $data['page_title'] = "Edit Ruangan"; // Menetapkan judul untuk halaman edit
            $view = __DIR__ . '/../views/ruangan/edit.php'; // Menetapkan view untuk ditampilkan
            require __DIR__ . '/../views/layouts/main.php'; // Memuat layout
        }
    }

    public function delete($id)
    {
        $this->ruangan->delete($id); // Menghapus ruangan berdasarkan ID
        $_SESSION['success'] = "Ruangan berhasil dihapus!";
        header('Location: /?controller=ruangan&action=index'); // Redirect ke halaman ruangan setelah berhasil
        exit; // Pastikan untuk keluar setelah redirect
    }
}
