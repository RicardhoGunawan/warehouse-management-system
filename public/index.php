<?php
session_start();
require '../config/database.php'; // Menghubungkan ke database

// Definisikan controller dan action default
$controller = ucfirst(strtolower($_GET['controller'] ?? 'Login')); // Menggunakan ucfirst untuk controller
$action = strtolower($_GET['action'] ?? 'showLoginForm'); // Default ke form login
$id = $_GET['id'] ?? null;

// Cek apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    // Jika sudah login, arahkan ke dashboard
    $controller = ucfirst(strtolower($_GET['controller'] ?? 'Dashboard')); // Controller jika sudah login
    $action = strtolower($_GET['action'] ?? 'index'); // Action default ke index
} 

// Controller name
$controllerName = $controller . 'Controller'; // Controller berdasarkan parameter

// Memeriksa apakah file controller ada
if (file_exists("../app/controllers/$controllerName.php")) {
    require "../app/controllers/$controllerName.php"; // Memuat file controller
    
    // Buat objek controller dan panggil action
    $controllerObject = new $controllerName($pdo);
    
    // Jika ada id, panggil metode dengan parameter id
    if ($id) {
        $controllerObject->$action($id);
    } else {
        $controllerObject->$action(); // Memanggil method tanpa parameter
    }
} else {
    echo "Controller $controllerName tidak ditemukan!";
}
?>
