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
        $stmt = $this->db->prepare("INSERT INTO ruangan (nama_ruangan) VALUES (?)");
        $stmt->execute([$data['nama_ruangan']]);
    }

    public function update($id, $data) {
        // Memperbarui data ruangan di database
        $stmt = $this->db->prepare("UPDATE ruangan SET nama_ruangan = ? WHERE id = ?");
        $stmt->execute([$data['nama_ruangan'], $id]);
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
}
?>
