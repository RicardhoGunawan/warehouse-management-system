<?php
session_start();
require '../config/database.php';


$controller = ucfirst(strtolower($_GET['controller'] ?? 'Dashboard')); // Menggunakan ucfirst untuk controller
$action = strtolower($_GET['action'] ?? 'index'); // Menggunakan strtolower untuk action
$id = $_GET['id'] ?? null;

$controllerName = $controller . 'Controller'; // Controller berdasarkan parameter

// Memeriksa apakah file controller ada
if (file_exists("../app/controllers/$controllerName.php")) {
    require "../app/controllers/$controllerName.php";
    $controllerObject = new $controllerName($pdo);
    // Jika ada id, panggil metode dengan parameter id
    if ($id) {
        $controllerObject->$action($id);
    } else {
        $controllerObject->$action();
    }
} else {
    echo "Controller $controllerName tidak ditemukan!";

}
