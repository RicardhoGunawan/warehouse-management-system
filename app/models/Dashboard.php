<?php
class Dashboard {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function countBarang() {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total_barang FROM barang");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_barang'];
    }

    public function countSuppliers() {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total_suppliers FROM suppliers");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_suppliers'];
    }

    public function countLorong() {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total_lorong FROM lorong");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_lorong'];
    }

    public function countRuangan() {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total_ruangan FROM ruangan");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_ruangan'];
    }

    public function getBarangExpiringSoon($days = 30) {
        $stmt = $this->db->prepare("SELECT * FROM barang WHERE expire_date <= DATE_ADD(NOW(), INTERVAL ? DAY)");
        $stmt->execute([$days]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
