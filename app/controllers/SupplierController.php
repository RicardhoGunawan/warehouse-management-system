<?php
require_once __DIR__ . '/../models/Supplier.php'; // Memuat model Supplier

class SupplierController
{
    private $supplier;

    public function __construct($pdo)
    {
        $this->supplier = new Supplier($pdo); // Inisialisasi model Supplier
    }

    public function index()
    {
        $data['suppliers'] = $this->supplier->getAll(); // Mengambil semua data supplier
        $data['page_title'] = "Daftar Supplier"; // Menetapkan judul halaman
        extract($data); // Mengubah array menjadi variabel lokal
        
        $view = __DIR__ . '/../views/supplier/index.php'; // Menetapkan view untuk ditampilkan
        require __DIR__ . '/../views/layouts/main.php'; // Memuat layout
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->supplier->create($_POST); // Proses penyimpanan supplier
            $_SESSION['success'] = "Supplier berhasil ditambahkan!"; // Notifikasi sukses
            header('Location: /?controller=supplier&action=index'); // Redirect setelah penyimpanan
            exit; // Pastikan keluar setelah redirect
        } else {
            $data['page_title'] = "Tambah Supplier"; // Menetapkan judul untuk halaman tambah
            $view = __DIR__ . '/../views/supplier/create.php'; // Menetapkan view untuk ditampilkan
            require __DIR__ . '/../views/layouts/main.php'; // Memuat layout
        }
    }

    public function edit($id)
    {
        // Mengambil supplier berdasarkan ID
        $data['supplier'] = $this->supplier->find($id);

        // Jika supplier tidak ditemukan, redirect ke halaman index
        if (!$data['supplier']) {
            $_SESSION['error'] = "Supplier tidak ditemukan!";
            header('Location: /?controller=supplier&action=index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->supplier->update($id, $_POST); // Proses pembaruan supplier
            $_SESSION['success'] = "Supplier berhasil diperbarui!"; // Notifikasi sukses
            header('Location: /?controller=supplier&action=index'); // Redirect setelah pembaruan
            exit; // Pastikan untuk keluar setelah redirect
        } else {
            $data['page_title'] = "Edit Supplier"; // Menetapkan judul untuk halaman edit
            $view = __DIR__ . '/../views/supplier/edit.php'; // Menetapkan view untuk ditampilkan
            require __DIR__ . '/../views/layouts/main.php'; // Memuat layout
        }
    }

    public function delete($id)
    {
        $this->supplier->delete($id); // Menghapus supplier berdasarkan ID
        $_SESSION['success'] = "Supplier berhasil dihapus!"; // Notifikasi sukses
        header('Location: /?controller=supplier&action=index'); // Redirect ke halaman supplier setelah berhasil
        exit;
    }
}
