<?php
class Barang
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        // Mengambil semua data barang beserta nama kategori, lorong, supplier, dan ruangan
        $stmt = $this->db->prepare("
            SELECT 
                b.*, 
                l.nama_lorong, 
                s.nama_supplier AS nama_suppliers, 
                r.nama_ruangan,
                c.category_name 
            FROM barang b
            LEFT JOIN lorong l ON b.lorong_id = l.id
            LEFT JOIN suppliers s ON b.supplier_id = s.id
            LEFT JOIN ruangan r ON b.ruangan_id = r.id
            LEFT JOIN categories c ON b.category_id = c.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getStockByCategory()
    {
        $stmt = $this->db->prepare("
        SELECT 
            c.category_name, 
            SUM(b.stok) AS total_stock 
        FROM barang b 
        JOIN categories c ON b.category_id = c.id 
        GROUP BY c.category_name
    ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO barang (nama, stok, expire_date, supplier_id, lorong_id, ruangan_id, category_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['nama'],
            $data['stok'],
            $data['expire_date'],
            $data['supplier_id'],
            $data['lorong_id'],
            $data['ruangan_id'],
            $data['category_id']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("
            UPDATE barang 
            SET 
                nama = ?, 
                stok = ?, 
                expire_date = ?, 
                supplier_id = ?, 
                lorong_id = ?, 
                ruangan_id = ?, 
                category_id = ? 
            WHERE id = ?
        ");
        $stmt->execute([
            $data['nama'],
            $data['stok'],
            $data['expire_date'],
            $data['supplier_id'],
            $data['lorong_id'],
            $data['ruangan_id'],
            $data['category_id'],
            $id
        ]);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM barang WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getSuppliers()
    {
        $stmt = $this->db->prepare("SELECT * FROM suppliers");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLorong()
    {
        $stmt = $this->db->prepare("SELECT * FROM lorong");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRuangan()
    {
        $stmt = $this->db->prepare("SELECT * FROM ruangan");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menambahkan metode ini untuk mengambil kategori
    public function getCategories()
    {
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM barang WHERE id = ?");
        $stmt->execute([$id]);
    }
}
