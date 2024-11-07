<?php
require_once __DIR__ . '/config/database.php';

// Memuat semua controller dengan __DIR__ untuk memastikan jalur yang benar
require_once __DIR__ . '/app/controllers/DashboardController.php';
require_once __DIR__ . '/app/controllers/BarangController.php';
require_once __DIR__ . '/app/controllers/SupplierController.php';
require_once __DIR__ . '/app/controllers/LorongController.php';
require_once __DIR__ . '/app/controllers/RuanganController.php';

// Mendapatkan controller dan action dari URL
$controller = $_GET['controller'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

// Menampilkan controller dan action untuk debugging
echo "Controller: $controller<br>";
echo "Action: $action<br>";

// Routing berdasarkan controller yang dipilih
switch ($controller) {
    case 'dashboard':
        $controller = new DashboardController($pdo);
        break;
    case 'barang':
        $controller = new BarangController($pdo); // Pastikan nama kelas sesuai
        break;
    case 'supplier':
        $controller = new SupplierController($pdo);
        break;
    case 'lorong':
        $controller = new LorongController($pdo);
        break;
    case 'ruangan':
        $controller = new RuanganController($pdo);
        break;
    default:
        die("Controller tidak ditemukan!");
}

// Memastikan method yang diminta ada di dalam controller
if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    die("Action tidak ditemukan!");
}
?>
