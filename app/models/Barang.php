<?php
class Barang
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll($limit = 10, $offset = 0)
    {
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
        LIMIT :limit OFFSET :offset
    ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM barang");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
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
        // Jika kategori adalah Food (ID 1), mengisi expire_date
        $expire_date = null; // Inisialisasi expire_date
        if (isset($data['category_id']) && $data['category_id'] == '2') {
            $expire_date = $data['expire_date']; // Mengisi expire_date untuk makanan
        }

        $stmt = $this->db->prepare("
            INSERT INTO barang (nama, stok, expire_date, supplier_id, lorong_id, ruangan_id, category_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['nama'],
            $data['stok'],
            $expire_date,  // Hanya mengisi jika kategori adalah Food
            $data['supplier_id'],
            $data['lorong_id'],
            $data['ruangan_id'],
            $data['category_id']
        ]);
    }

    public function update($id, $data)
    {
        // Jika kategori adalah Food (ID 1), mengisi expire_date
        $expire_date = null; // Inisialisasi expire_date
        if (isset($data['category_id']) && $data['category_id'] == '2') {
            $expire_date = $data['expire_date']; // Mengisi expire_date untuk makanan
        }

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
            $expire_date,  // Hanya mengisi jika kategori adalah Food
            $data['supplier_id'],
            $data['lorong_id'],
            $data['ruangan_id'],
            $data['category_id'],
            $id  // ID yang diupdate
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
