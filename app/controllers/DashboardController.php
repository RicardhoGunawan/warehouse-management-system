<?php
require_once __DIR__ . '/../models/Dashboard.php';  // Memuat model Dashboard
class DashboardController
{
    private $dashboard;

    public function __construct($pdo)
    {
        $this->dashboard = new Dashboard($pdo);
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
        $data['page_title'] = "Dashboard"; // Menetapkan judul halaman


        // Mengubah array menjadi variabel
        extract($data);

        $view = __DIR__ . '/../views/dashboard/index.php';
        require __DIR__ . '/../views/layouts/main.php';
    }



}
