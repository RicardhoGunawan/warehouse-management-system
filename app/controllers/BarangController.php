<?php
require_once __DIR__ . '/../models/Barang.php';  // Memuat model Barang
require_once __DIR__ . '/../models/Supplier.php'; // Memuat model Supplier jika ada
require_once __DIR__ . '/../models/Lorong.php';   // Memuat model Lorong jika ada
require_once __DIR__ . '/../models/Ruangan.php';   // Memuat model Ruangan jika ada

class BarangController
{
    private $barang;
    private $supplier;
    private $lorong;
    private $ruangan;

    public function __construct($pdo)
    {
        $this->barang = new Barang($pdo);
        $this->supplier = new Supplier($pdo); // Inisialisasi model Supplier
        $this->lorong = new Lorong($pdo);     // Inisialisasi model Lorong
        $this->ruangan = new Ruangan($pdo);   // Inisialisasi model Ruangan
    }

    public function index()
    {
        $data['barang'] = $this->barang->getAll(); // Mengambil semua data barang
        $data['page_title'] = "Daftar Barang"; // Menetapkan judul halaman
        extract($data); // Mengubah array menjadi variabel lokal

        $view = __DIR__ . '/../views/barang/index.php'; // Menetapkan view untuk ditampilkan
        require __DIR__ . '/../views/layouts/main.php'; // Memuat layout
    }

    // Contoh di BarangController.php
    public function create()
    {
        $suppliers = $this->barang->getSuppliers();
        $lorong = $this->barang->getLorong();
        $ruangan = $this->barang->getRuangan();
        $categories = $this->barang->getCategories(); // Ambil data kategori

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->barang->create($_POST);
            $_SESSION['success'] = "Barang berhasil ditambahkan!";
            header('Location: /?controller=barang&action=index');
            exit;
        } else {
            $data['page_title'] = "Tambah Barang";
            $data['suppliers'] = $suppliers;
            $data['lorong'] = $lorong;
            $data['ruangan'] = $ruangan;
            $data['categories'] = $categories; // Menyimpan data kategori ke view
            $view = __DIR__ . '/../views/barang/create.php';
            require __DIR__ . '/../views/layouts/main.php';
        }
    }

    public function edit($id)
    {
        $data['barang'] = $this->barang->find($id);
        if (!$data['barang']) {
            $_SESSION['error'] = "Barang tidak ditemukan!";
            header('Location: /?controller=barang&action=index');
            exit;
        }

        $suppliers = $this->barang->getSuppliers();
        $lorong = $this->barang->getLorong();
        $ruangan = $this->barang->getRuangan();
        $categories = $this->barang->getCategories(); // Ambil data kategori

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->barang->update($id, $_POST);
            $_SESSION['success'] = "Barang berhasil diperbarui!";
            header('Location: /?controller=barang&action=index');
            exit;
        } else {
            $data['page_title'] = "Edit Barang";
            $data['suppliers'] = $suppliers;
            $data['lorong'] = $lorong;
            $data['ruangan'] = $ruangan;
            $data['categories'] = $categories; // Menyimpan data kategori ke view
            $view = __DIR__ . '/../views/barang/edit.php';
            require __DIR__ . '/../views/layouts/main.php';
        }
    }


    public function delete($id)
    {
        $this->barang->delete($id);
        $_SESSION['success'] = "Barang berhasil dihapus!"; // Notifikasi sukses
        header('Location: /?controller=barang&action=index');
        exit;
    }

}
