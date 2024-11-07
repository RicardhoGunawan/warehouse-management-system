<?php
require_once __DIR__ . '/../models/Category.php'; // Memuat model Category

class CategoryController
{
    private $category;

    public function __construct($pdo) {
        $this->category = new Category($pdo); // Inisialisasi model Category
    }

    public function index() {
        $data['categories'] = $this->category->getAll(); // Mengambil semua kategori
        $data['page_title'] = "Daftar Kategori"; // Menetapkan judul halaman
        extract($data);
        $view = __DIR__ . '/../views/category/index.php'; // Menetapkan view untuk ditampilkan
        require __DIR__ . '/../views/layouts/main.php'; // Memuat layout
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->category->create($_POST); // Proses penyimpanan kategori
            $_SESSION['success'] = "Kategori berhasil ditambahkan!"; // Pesan sukses
            header('Location: /?controller=category&action=index'); // Redirect setelah penyimpanan
            exit; // Pastikan keluar setelah redirect
        } else {
            $data['page_title'] = "Tambah Kategori"; // Menetapkan judul untuk halaman tambah
            $view = __DIR__ . '/../views/category/create.php'; // Menetapkan view untuk ditampilkan
            require __DIR__ . '/../views/layouts/main.php'; // Memuat layout
        }
    }

    public function edit($id) {
        $data['category'] = $this->category->find($id); // Mengambil kategori berdasarkan ID

        if (!$data['category']) {
            $_SESSION['error'] = "Kategori tidak ditemukan!";
            header('Location: /?controller=category&action=index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->category->update($id, $_POST); // Proses pembaruan kategori
            $_SESSION['success'] = "Kategori berhasil diperbarui!"; // Pesan sukses
            header('Location: /?controller=category&action=index');
            exit; // Pastikan keluar setelah redirect
        } else {
            $data['page_title'] = "Edit Kategori"; // Menetapkan judul untuk halaman edit
            $view = __DIR__ . '/../views/category/edit.php'; // Menetapkan view untuk ditampilkan
            require __DIR__ . '/../views/layouts/main.php'; // Memuat layout
        }
    }

    public function delete($id) {
        $this->category->delete($id); // Menghapus kategori berdasarkan ID
        $_SESSION['success'] = "Kategori berhasil dihapus!"; // Pesan sukses
        header('Location: /?controller=category&action=index'); // Redirect ke halaman kategori setelah berhasil
        exit; // Pastikan untuk keluar setelah redirect
    }
}
?>
