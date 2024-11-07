<?php
class Category {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo; // Menginisialisasi database
    }

    public function getAll() {
        // Mengambil semua data kategori
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        // Menambahkan kategori baru ke dalam database
        $stmt = $this->db->prepare("INSERT INTO categories (category_name, description) VALUES (?, ?)");
        $stmt->execute([$data['category_name'], $data['description']]); // Menyimpan data
    }

    public function update($id, $data) {
        // Memperbarui data kategori berdasarkan ID
        $stmt = $this->db->prepare("UPDATE categories SET category_name = ?, description = ? WHERE id = ?");
        $stmt->execute([$data['category_name'], $data['description'], $id]);
    }

    public function delete($id) {
        // Menghapus kategori berdasarkan ID
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function find($id) {
        // Mencari kategori berdasarkan ID
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
