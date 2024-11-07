<?php
class Supplier {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getAll() {
        // Mengambil semua data supplier
        $stmt = $this->db->prepare("SELECT * FROM suppliers");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        // Menyimpan supplier baru ke dalam database
        $stmt = $this->db->prepare("INSERT INTO suppliers (nama_supplier, alamat, telepon, company_name) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['nama_supplier'], $data['alamat'], $data['telepon'], $data['company_name']]);
    }

    public function update($id, $data) {
        // Memperbarui data supplier di database
        $stmt = $this->db->prepare("UPDATE suppliers SET nama_supplier = ?, alamat = ?, telepon = ?, company_name = ? WHERE id = ?");
        $stmt->execute([$data['nama_supplier'], $data['alamat'], $data['telepon'], $data['company_name'], $id]);
    }

    public function delete($id) {
        // Menghapus supplier berdasarkan ID
        $stmt = $this->db->prepare("DELETE FROM suppliers WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function find($id) {
        // Mengambil supplier berdasarkan ID
        $stmt = $this->db->prepare("SELECT * FROM suppliers WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
