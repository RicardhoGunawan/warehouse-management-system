<?php
require_once __DIR__ . '/../models/Dashboard.php';  // Memuat model Dashboard
require_once __DIR__ . '/../models/Barang.php';  // Memuat model Dashboard
class DashboardController
{
    private $dashboard;
    private $barang;


    public function __construct($pdo)
    {
        $this->dashboard = new Dashboard($pdo);
        $this->barang = new Barang($pdo);

    }

    public function index()
    {
        $data = [
            'total_barang' => $this->dashboard->countBarang(),
            'total_suppliers' => $this->dashboard->countSuppliers(),
            'total_lorong' => $this->dashboard->countLorong(),
            'total_ruangan' => $this->dashboard->countRuangan(),
            'barang_expiring_soon' => $this->dashboard->getBarangExpiringSoon()
        ];
        $data['page_title'] = "Dashboard";

        // Mengambil data stok per kategori dan menyiapkannya untuk Chart.js
        $stockByCategory = $this->barang->getStockByCategory();
        $data['stock_by_category'] = [
            'labels' => array_column($stockByCategory, 'category_name'),
            'data' => array_column($stockByCategory, 'total_stock')
        ];

        // Mengubah array menjadi variabel
        extract($data);

        $view = __DIR__ . '/../views/dashboard/index.php';
        require __DIR__ . '/../views/layouts/main.php';
    }




}
