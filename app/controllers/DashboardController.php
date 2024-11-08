<?php
require_once __DIR__ . '/../models/Dashboard.php';  // Memuat model Dashboard
require_once __DIR__ . '/../models/Barang.php';     // Memuat model Barang
require_once __DIR__ . '/../models/Ruangan.php';    // Memuat model Ruangan

class DashboardController
{
    private $dashboard;
    private $barang;
    private $ruangan;

    public function __construct($pdo)
    {
        $this->dashboard = new Dashboard($pdo);
        $this->barang = new Barang($pdo);
        $this->ruangan = new Ruangan($pdo);
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

        // Ambil data stok per kategori dan siapkan untuk Chart.js
        $stockByCategory = $this->barang->getStockByCategory();
        $data['stock_by_category'] = [
            'labels' => array_column($stockByCategory, 'category_name'),
            'data' => array_column($stockByCategory, 'total_stock')
        ];

        // Data penggunaan ruangan untuk Chart.js
        $usageData = $this->ruangan->getUsageCount();
        $data['ruangan_usage'] = [
            'labels' => ['Used', 'Unused'],
            'data' => [
                isset($usageData['used_count']) ? $usageData['used_count'] : 0,
                isset($usageData['unused_count']) ? $usageData['unused_count'] : 0
            ]
        ];
        
        


        // Mengubah array menjadi variabel
        extract($data);

        $view = __DIR__ . '/../views/dashboard/index.php';
        require __DIR__ . '/../views/layouts/main.php';
    }
}
?>