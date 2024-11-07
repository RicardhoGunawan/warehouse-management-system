<?php
class Lorong {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getAll() {
        // Mengambil semua data lorong
        $stmt = $this->db->prepare("SELECT * FROM lorong");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        // Menyimpan lorong baru ke dalam database
        $stmt = $this->db->prepare("INSERT INTO lorong (nama_lorong) VALUES (?)");
        $stmt->execute([$data['nama_lorong']]);
    }

    public function update($id, $data) {
        // Memperbarui data lorong di database
        $stmt = $this->db->prepare("UPDATE lorong SET nama_lorong = ? WHERE id = ?");
        $stmt->execute([$data['nama_lorong'], $id]);
    }

    public function delete($id) {
        // Menghapus lorong berdasarkan ID
        $stmt = $this->db->prepare("DELETE FROM lorong WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function find($id) {
        // Mengambil lorong berdasarkan ID
        $stmt = $this->db->prepare("SELECT * FROM lorong WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
