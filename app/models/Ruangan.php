<?php
class Ruangan {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getAll() {
        // Mengambil semua data ruangan
        $stmt = $this->db->prepare("SELECT * FROM ruangan");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        // Menyimpan ruangan baru ke dalam database
        $stmt = $this->db->prepare("INSERT INTO ruangan (nama_ruangan, is_used) VALUES (?, ?)");
        $stmt->execute([$data['nama_ruangan'], $data['is_used']]);
    }

    public function update($id, $data) {
        // Memperbarui data ruangan di database
        $stmt = $this->db->prepare("UPDATE ruangan SET nama_ruangan = ?, is_used = ? WHERE id = ?");
        $stmt->execute([$data['nama_ruangan'], $data['is_used'], $id]);
    }

    public function delete($id) {
        // Menghapus ruangan berdasarkan ID
        $stmt = $this->db->prepare("DELETE FROM ruangan WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function find($id) {
        // Mengambil ruangan berdasarkan ID
        $stmt = $this->db->prepare("SELECT * FROM ruangan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsageCount() {
        // Menghitung jumlah ruangan yang digunakan dan yang tidak digunakan
        $stmt = $this->db->prepare("SELECT 
                                        SUM(is_used = 1) AS used_count, 
                                        SUM(is_used = 0) AS unused_count 
                                    FROM ruangan");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
